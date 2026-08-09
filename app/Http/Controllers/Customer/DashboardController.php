<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Customer;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use App\Models\Appointment;
use App\Models\BridalPackage;
use App\Models\MakeupBooking;
use App\Models\MakeupService;
use App\Models\CustomDesignRequest;
use App\Models\Measurement;
use App\Models\WalletTransaction;
use App\Models\Wishlist;
use App\Models\Product;

class DashboardController extends Controller
{
    private function getCustomer()
    {
        $user = Auth::user();
        if ($user->is_admin) {
            // Admin fall-back to prevent crashes when testing customer panel
            $customer = Customer::firstOrCreate(
                ['email' => $user->email],
                [
                    'user_id' => $user->id,
                    'first_name' => 'Admin',
                    'last_name' => 'Test',
                    'wallet_balance' => 9999.00,
                    'reward_points' => 999,
                    'status' => 'active'
                ]
            );
            return $customer;
        }

        // Standard user
        if (!$user->customer) {
            $names = explode(' ', $user->name, 2);
            Customer::create([
                'user_id' => $user->id,
                'first_name' => $names[0] ?? 'User',
                'last_name' => $names[1] ?? 'Customer',
                'email' => $user->email,
                'wallet_balance' => 0.00,
                'reward_points' => 0,
                'status' => 'active'
            ]);
            $user->load('customer');
        }

        return $user->customer;
    }

    public function index()
    {
        $customer = $this->getCustomer();
        
        $stats = [
            'orders_count'       => Order::where('customer_id', $customer->id)->count(),
            'wishlist_count'     => \App\Models\Wishlist::where('customer_id', $customer->id)->count(),
            'appointments_count' => Appointment::where('customer_id', $customer->id)->count(),
            'bookings_count'     => MakeupBooking::where('customer_id', $customer->id)->count(),
            'designs_count'      => CustomDesignRequest::where('customer_id', $customer->id)->count(),
        ];

        $recentOrders = Order::where('customer_id', $customer->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('customer.dashboard', compact('customer', 'stats', 'recentOrders'));
    }

    public function profile()
    {
        $customer = $this->getCustomer();
        return view('customer.profile', compact('customer'));
    }

    public function updateProfile(Request $request)
    {
        $customer = $this->getCustomer();

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        DB::transaction(function () use ($request, $customer) {
            $customer->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
            ]);

            Auth::user()->update([
                'name' => $request->first_name . ' ' . $request->last_name,
            ]);
        });

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password changed successfully.');
    }

    public function addresses()
    {
        $customer = $this->getCustomer();
        $addresses = Address::where('customer_id', $customer->id)->get();
        return view('customer.addresses', compact('customer', 'addresses'));
    }

    public function storeAddress(Request $request)
    {
        $customer = $this->getCustomer();

        $request->validate([
            'address_line_1' => ['required', 'string', 'max:255'],
            'address_line_2' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:100'],
            'is_default' => ['nullable', 'boolean'],
        ]);

        $isDefault = $request->has('is_default');

        if ($isDefault) {
            Address::where('customer_id', $customer->id)->update(['is_default' => false]);
        }

        Address::create([
            'customer_id' => $customer->id,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'is_default' => $isDefault,
        ]);

        return back()->with('success', 'Address added successfully.');
    }

    public function updateAddress(Request $request, Address $address)
    {
        $customer = $this->getCustomer();
        if ($address->customer_id !== $customer->id) {
            abort(403);
        }

        $request->validate([
            'address_line_1' => ['required', 'string', 'max:255'],
            'address_line_2' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:100'],
            'is_default' => ['nullable', 'boolean'],
        ]);

        $isDefault = $request->has('is_default');

        if ($isDefault) {
            Address::where('customer_id', $customer->id)->update(['is_default' => false]);
        }

        $address->update([
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'is_default' => $isDefault,
        ]);

        return back()->with('success', 'Address updated successfully.');
    }

    public function destroyAddress(Address $address)
    {
        $customer = $this->getCustomer();
        if ($address->customer_id !== $customer->id) {
            abort(403);
        }

        $address->delete();

        return back()->with('success', 'Address deleted successfully.');
    }

    public function setDefaultAddress(Address $address)
    {
        $customer = $this->getCustomer();
        if ($address->customer_id !== $customer->id) {
            abort(403);
        }

        Address::where('customer_id', $customer->id)->update(['is_default' => false]);
        $address->update(['is_default' => true]);

        return back()->with('success', 'Default address updated.');
    }

    public function orders()
    {
        $customer = $this->getCustomer();
        $orders = Order::where('customer_id', $customer->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('customer.orders', compact('customer', 'orders'));
    }

    public function showOrder($id)
    {
        $customer = $this->getCustomer();
        $order = Order::with(['items', 'orderNotes', 'statusLogs'])
            ->where('customer_id', $customer->id)
            ->where('id', $id)
            ->firstOrFail();

        return view('customer.order_detail', compact('customer', 'order'));
    }

    public function appointments()
    {
        $customer = $this->getCustomer();
        $appointments = Appointment::with('package')
            ->where('customer_id', $customer->id)
            ->orderBy('appointment_date', 'desc')
            ->get();

        $packages = BridalPackage::where('is_active', true)->get();

        return view('customer.appointments', compact('customer', 'appointments', 'packages'));
    }

    public function storeAppointment(Request $request)
    {
        $customer = $this->getCustomer();

        $request->validate([
            'bridal_package_id' => ['required', 'exists:bridal_packages,id'],
            'appointment_date' => ['required', 'date', 'after:today'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        Appointment::create([
            'customer_id' => $customer->id,
            'bridal_package_id' => $request->bridal_package_id,
            'appointment_date' => $request->appointment_date,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Bridal Consultation Appointment requested successfully! Our boutique assistant will contact you soon.');
    }

    public function makeupBookings()
    {
        $customer = $this->getCustomer();
        $bookings = MakeupBooking::with('service')
            ->where('customer_id', $customer->id)
            ->orderBy('booking_date', 'desc')
            ->get();

        $services = MakeupService::where('is_active', true)->get();

        return view('customer.makeup_bookings', compact('customer', 'bookings', 'services'));
    }

    public function storeMakeupBooking(Request $request)
    {
        $customer = $this->getCustomer();

        $request->validate([
            'makeup_service_id' => ['required', 'exists:makeup_services,id'],
            'booking_date' => ['required', 'date', 'after:today'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $service = MakeupService::find($request->makeup_service_id);

        MakeupBooking::create([
            'customer_id' => $customer->id,
            'makeup_service_id' => $request->makeup_service_id,
            'artist_name' => 'Assigned Designer Artist',
            'booking_date' => $request->booking_date,
            'status' => 'pending',
            'total_price' => $service->price,
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Makeup Booking requested successfully! We will confirm your session timing shortly.');
    }

    public function customDesigns()
    {
        $customer = $this->getCustomer();
        $requests = CustomDesignRequest::where('customer_id', $customer->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.custom_designs', compact('customer', 'requests'));
    }

    public function storeCustomDesign(Request $request)
    {
        $customer = $this->getCustomer();

        $request->validate([
            'fabric_preference' => ['nullable', 'string', 'max:255'],
            'budget_range' => ['nullable', 'string', 'max:255'],
            'design_details' => ['required', 'string', 'max:5000'],
            'design_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
        ]);

        $imagePath = null;
        if ($request->hasFile('design_image')) {
            // Store file in public/uploads/designs (public disk folder)
            $file = $request->file('design_image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/designs'), $filename);
            $imagePath = 'uploads/designs/' . $filename;
        }

        CustomDesignRequest::create([
            'customer_id' => $customer->id,
            'fabric_preference' => $request->fabric_preference,
            'budget_range' => $request->budget_range,
            'design_details' => $request->design_details,
            'image_path' => $imagePath,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Custom design request submitted successfully. Our designers are reviewing your specifications.');
    }

    public function measurements()
    {
        $customer = $this->getCustomer();
        $measurements = Measurement::where('customer_id', $customer->id)->first();
        return view('customer.measurements', compact('customer', 'measurements'));
    }

    public function updateMeasurements(Request $request)
    {
        $customer = $this->getCustomer();

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'bust' => ['nullable', 'numeric', 'min:0', 'max:200'],
            'waist' => ['nullable', 'numeric', 'min:0', 'max:200'],
            'hips' => ['nullable', 'numeric', 'min:0', 'max:200'],
            'shoulder' => ['nullable', 'numeric', 'min:0', 'max:200'],
            'chest' => ['nullable', 'numeric', 'min:0', 'max:200'],
            'sleeve_length' => ['nullable', 'numeric', 'min:0', 'max:200'],
            'lehenga_length' => ['nullable', 'numeric', 'min:0', 'max:200'],
            'blouse_length' => ['nullable', 'numeric', 'min:0', 'max:200'],
            'front_neck_depth' => ['nullable', 'numeric', 'min:0', 'max:200'],
            'back_neck_depth' => ['nullable', 'numeric', 'min:0', 'max:200'],
            'armhole' => ['nullable', 'numeric', 'min:0', 'max:200'],
            'wrist' => ['nullable', 'numeric', 'min:0', 'max:200'],
            'ankle_length' => ['nullable', 'numeric', 'min:0', 'max:200'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        Measurement::updateOrCreate(
            ['customer_id' => $customer->id],
            $request->all()
        );

        return back()->with('success', 'Fitting specifications updated successfully.');
    }



    public function wishlist()
    {
        if (Auth::check()) {
            $customer = $this->getCustomer();
            $wishlistItems = Wishlist::with(['product.images', 'product.category'])
                ->where('customer_id', $customer->id)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $customer = null;
            $wishlistIds = session()->get('wishlist', []);
            $products = \App\Models\Product::whereIn('id', $wishlistIds)
                ->with(['images', 'category'])
                ->get();

            $wishlistItems = collect();
            foreach ($products as $prod) {
                $item = new \stdClass();
                $item->product = $prod;
                $wishlistItems->push($item);
            }
        }

        return view('customer.wishlist', compact('customer', 'wishlistItems'));
    }

    public function toggleWishlist(Request $request)
    {
        $productId = $request->product_id;

        if (Auth::check()) {
            $customer = $this->getCustomer();
            $exists = Wishlist::where('customer_id', $customer->id)
                ->where('product_id', $productId)
                ->first();

            if ($exists) {
                $exists->delete();
                return response()->json(['success' => true, 'action' => 'removed', 'message' => 'Product removed from wishlist.']);
            } else {
                Wishlist::create([
                    'customer_id' => $customer->id,
                    'product_id' => $productId,
                ]);
                return response()->json(['success' => true, 'action' => 'added', 'message' => 'Product added to wishlist!']);
            }
        } else {
            $wishlist = session()->get('wishlist', []);
            if (in_array($productId, $wishlist)) {
                $wishlist = array_values(array_diff($wishlist, [$productId]));
                session()->put('wishlist', $wishlist);
                return response()->json(['success' => true, 'action' => 'removed', 'message' => 'Product removed from wishlist.']);
            } else {
                $wishlist[] = $productId;
                session()->put('wishlist', $wishlist);
                return response()->json(['success' => true, 'action' => 'added', 'message' => 'Product added to wishlist!']);
            }
        }
    }

    public function removeWishlist($id)
    {
        if (Auth::check()) {
            $customer = $this->getCustomer();
            Wishlist::where('customer_id', $customer->id)
                ->where('product_id', $id)
                ->delete();
        } else {
            $wishlist = session()->get('wishlist', []);
            $wishlist = array_values(array_diff($wishlist, [$id]));
            session()->put('wishlist', $wishlist);
        }

        return back()->with('success', 'Product removed from wishlist.');
    }
}
