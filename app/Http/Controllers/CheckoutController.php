<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;
use App\Models\Address;
use App\Models\Coupon;
use App\Models\OrderStatusLog;
use App\Services\RazorpayService;
use App\Services\ShiprocketService;

class CheckoutController extends Controller
{
    protected $razorpayService;
    protected $shiprocketService;

    public function __construct(RazorpayService $razorpayService, ShiprocketService $shiprocketService)
    {
        $this->razorpayService = $razorpayService;
        $this->shiprocketService = $shiprocketService;
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('sarees')->with('error', 'Your shopping bag is empty.');
        }

        $subtotal = collect($cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        // Gift wrapping charge
        $giftWrapCharge = session()->get('gift_wrap', false) ? 199.00 : 0.00;

        // Auto-populate customer info if logged in
        $customer = null;
        $defaultAddress = null;
        if (Auth::check()) {
            $user = Auth::user();
            $customer = $user->customer;
            if ($customer) {
                $defaultAddress = Address::where('customer_id', $customer->id)
                    ->where('is_default', true)
                    ->first() ?: Address::where('customer_id', $customer->id)->first();
            }
        }

        // Applied coupon discount
        $discount = 0;
        $couponCode = session()->get('coupon_code');
        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)->where('is_active', true)->first();
            if ($coupon) {
                if ($coupon->type === 'percentage') {
                    $discount = ($subtotal * $coupon->value) / 100;
                } else {
                    $discount = $coupon->value;
                }
            }
        }

        $tax = $subtotal * 0.18; // 18% GST
        $shipping = $subtotal >= 5000 ? 0.00 : 150.00;
        $total = $subtotal - $discount + $tax + $shipping + $giftWrapCharge;

        return view('checkout', compact('cart', 'subtotal', 'discount', 'tax', 'shipping', 'total', 'customer', 'defaultAddress', 'giftWrapCharge'));
    }

    public function updateGiftWrap(Request $request)
    {
        $request->validate(['gift_wrap' => 'required|boolean']);
        session()->put('gift_wrap', $request->gift_wrap);
        return response()->json(['success' => true]);
    }

    public function applyCoupon(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $coupon = Coupon::where('code', $request->code)->where('is_active', true)->first();
        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'Invalid or expired coupon code.']);
        }

        $cart = session()->get('cart', []);
        $subtotal = collect($cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        if ($coupon->min_order_value && $subtotal < $coupon->min_order_value) {
            return response()->json([
                'success' => false,
                'message' => 'Minimum purchase of ₹' . number_format($coupon->min_order_value, 2) . ' required to apply this coupon.'
            ]);
        }

        session()->put('coupon_code', $coupon->code);

        return response()->json([
            'success' => true,
            'message' => "Coupon '{$coupon->code}' applied successfully!",
            'code' => $coupon->code,
        ]);
    }

    public function removeCoupon()
    {
        session()->forget('coupon_code');
        return response()->json(['success' => true, 'message' => 'Coupon removed.']);
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:20',
            'payment_method' => 'required|in:cod,upi_razorpay',
        ]);

        // Enforce COD eligibility check on placement
        if ($request->payment_method === 'cod') {
            $pincodeCheck = $this->shiprocketService->checkPincodeServiceability($request->pincode);
            if (!$pincodeCheck['success'] || !$pincodeCheck['cod_available']) {
                return response()->json([
                    'success' => false,
                    'message' => isset($pincodeCheck['message']) ? $pincodeCheck['message'] : 'Cash on Delivery (COD) is not available for this pincode. Please choose online payment.'
                ]);
            }
        }

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return response()->json(['success' => false, 'message' => 'Your shopping bag is empty.']);
        }

        $subtotal = collect($cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        // Check if customer exists or create guest profile
        $customerId = null;
        if (Auth::check()) {
            $customer = Auth::user()->customer;
            if (!$customer) {
                $names = explode(' ', Auth::user()->name, 2);
                $customer = Customer::create([
                    'user_id' => Auth::user()->id,
                    'first_name' => $names[0] ?? 'User',
                    'last_name' => $names[1] ?? 'Customer',
                    'email' => Auth::user()->email,
                    'phone' => $request->phone,
                    'status' => 'active',
                ]);
            }
            $customerId = $customer->id;
        } else {
            $customer = Customer::where('email', $request->email)->first();
            if (!$customer) {
                $names = explode(' ', $request->name, 2);
                $customer = Customer::create([
                    'first_name' => $names[0] ?? 'Guest',
                    'last_name' => $names[1] ?? 'Customer',
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'status' => 'active',
                ]);
            }
            $customerId = $customer->id;
        }

        // Save shipping address inside Address table if it doesn't exist
        $addressExists = Address::where('customer_id', $customerId)
            ->where('address_line_1', $request->address)
            ->where('postal_code', $request->pincode)
            ->first();

        if (!$addressExists) {
            Address::create([
                'customer_id' => $customerId,
                'address_line_1' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->pincode,
                'country' => 'India',
                'is_default' => Address::where('customer_id', $customerId)->count() === 0
            ]);
        }

        // Discount calculations
        $discount = 0;
        $couponCode = session()->get('coupon_code');
        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)->where('is_active', true)->first();
            if ($coupon) {
                if ($coupon->type === 'percentage') {
                    $discount = ($subtotal * $coupon->value) / 100;
                } else {
                    $discount = $coupon->value;
                }
            }
        }

        $giftWrapCharge = session()->get('gift_wrap', false) ? 199.00 : 0.00;
        $tax = $subtotal * 0.18; // 18% GST
        $shipping = $subtotal >= 5000 ? 0.00 : 150.00;
        $total = $subtotal - $discount + $tax + $shipping + $giftWrapCharge;

        $orderNumber = 'RS-' . strtoupper(Str::random(10));

        $order = DB::transaction(function () use ($customerId, $orderNumber, $subtotal, $discount, $tax, $shipping, $total, $couponCode, $request, $cart) {
            $order = Order::create([
                'order_number' => $orderNumber,
                'customer_id' => $customerId,
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'payment_method' => $request->payment_method === 'cod' ? 'cod' : 'razorpay',
                'subtotal' => $subtotal,
                'discount' => $discount,
                'shipping_charge' => $shipping,
                'tax' => $tax,
                'total' => $total,
                'coupon_code' => $couponCode,
                'notes' => $request->payment_method === 'cod' ? 'Cash on delivery requested.' : 'Prepaid online payment processing.',
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_name' => $item['name'],
                    'product_sku' => $item['id'] . '-' . Str::random(4),
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['price'] * $item['quantity']
                ]);
            }

            OrderStatusLog::create([
                'order_id' => $order->id,
                'status' => 'pending',
                'comment' => 'Order created successfully.'
            ]);

            return $order;
        });

        // Handle Cash on delivery immediately
        if ($request->payment_method === 'cod') {
            // Allocate logistics delivery shipment
            $shipment = $this->shiprocketService->createShipment($order);
            if ($shipment['success']) {
                $order->update([
                    'tracking_number' => $shipment['tracking_number'],
                    'courier_name' => $shipment['courier_name'],
                    'shipping_status' => 'scheduled'
                ]);

                OrderStatusLog::create([
                    'order_id' => $order->id,
                    'status' => 'confirmed',
                    'comment' => "Logistics dispatched via {$shipment['courier_name']} (Tracking: {$shipment['tracking_number']})"
                ]);
            }

            session()->forget(['cart', 'coupon_code', 'gift_wrap']);
            session()->put('last_order_number', $order->order_number);

            return response()->json([
                'success' => true,
                'payment_required' => false,
                'redirect_url' => route('confirmation')
            ]);
        }

        // Initialize Razorpay details for online payments
        $razorpayOrder = $this->razorpayService->createOrder($total, $order->order_number);

        return response()->json([
            'success' => true,
            'payment_required' => true,
            'order_id' => $order->id,
            'razorpay_order_id' => $razorpayOrder['id'],
            'amount' => $razorpayOrder['amount'],
            'key_id' => $this->razorpayService->getKeyId(),
            'customer_name' => $request->name,
            'customer_email' => $request->email,
            'customer_phone' => $request->phone
        ]);
    }

    public function verifyPayment(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'razorpay_payment_id' => 'required_if:is_mock,0',
            'razorpay_order_id' => 'required_if:is_mock,0',
            'razorpay_signature' => 'required_if:is_mock,0',
        ]);

        $order = Order::findOrFail($request->order_id);

        $verified = true;
        if (!$this->razorpayService->isMockMode()) {
            $verified = $this->razorpayService->verifySignature(
                $request->razorpay_payment_id,
                $request->razorpay_order_id,
                $request->razorpay_signature
            );
        }

        if ($verified) {
            DB::transaction(function() use ($order) {
                $order->update([
                    'payment_status' => 'paid',
                    'status' => 'confirmed',
                    'notes' => 'Payment verified successfully via Razorpay.'
                ]);

                OrderStatusLog::create([
                    'order_id' => $order->id,
                    'status' => 'confirmed',
                    'comment' => 'Payment captured. Order is confirmed.'
                ]);
            });

            // Dispatch Shiprocket shipment allocation
            $shipment = $this->shiprocketService->createShipment($order);
            if ($shipment['success']) {
                $order->update([
                    'tracking_number' => $shipment['tracking_number'],
                    'courier_name' => $shipment['courier_name'],
                    'shipping_status' => 'scheduled'
                ]);

                OrderStatusLog::create([
                    'order_id' => $order->id,
                    'status' => 'confirmed',
                    'comment' => "Shipment scheduled via {$shipment['courier_name']} (Tracking: {$shipment['tracking_number']})"
                ]);
            }

            session()->forget(['cart', 'coupon_code', 'gift_wrap']);
            session()->put('last_order_number', $order->order_number);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Payment signature verification failed.']);
    }

    public function confirmation()
    {
        $orderNumber = session()->get('last_order_number');
        if (!$orderNumber) {
            return redirect()->route('home');
        }

        $order = Order::where('order_number', $orderNumber)->with('items')->firstOrFail();

        return view('confirmation', compact('order'));
    }

    public function track(Request $request)
    {
        $trackingNumber = $request->query('number');
        $trackingData = null;
        $order = null;

        if ($trackingNumber) {
            $trackingData = $this->shiprocketService->trackShipment($trackingNumber);
            $order = \App\Models\Order::where('tracking_number', $trackingNumber)->with('statusLogs')->first();
        }

        return view('tracking', compact('trackingNumber', 'trackingData', 'order'));
    }

    public function checkPincode(Request $request)
    {
        $request->validate(['pincode' => 'required|string']);
        $pincode = $request->pincode;
        
        $result = $this->shiprocketService->checkPincodeServiceability($pincode);
        return response()->json($result);
    }
}
