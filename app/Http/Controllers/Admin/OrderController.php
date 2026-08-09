<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use App\Models\Transaction;
use App\Models\OrderStatusLog;
use App\Models\OrderNote;
use Yajra\DataTables\Facades\DataTables;
use App\Models\AdminActivityLog;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Order::with('customer')->select('orders.*');

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }
            if ($request->filled('payment_status')) {
                $query->where('payment_status', $request->payment_status);
            }

            return DataTables::of($query)
                ->addColumn('customer', function($row) {
                    if ($row->customer) {
                        return $row->customer->first_name . ' ' . $row->customer->last_name . '<br><small class="text-muted">' . e($row->customer->email) . '</small>';
                    }
                    return '<span class="text-muted">Guest Checkout</span>';
                })
                ->addColumn('total', function($row) {
                    return '₹' . number_format($row->total, 2);
                })
                ->addColumn('date', function($row) {
                    return $row->created_at->format('Y-m-d H:i');
                })
                ->addColumn('status', function($row) {
                    $class = 'bg-secondary';
                    switch ($row->status) {
                        case 'new': $class = 'bg-light text-dark border'; break;
                        case 'pending': $class = 'bg-warning text-dark'; break;
                        case 'confirmed': $class = 'bg-info'; break;
                        case 'processing': $class = 'bg-teal text-white'; break;
                        case 'packed': $class = 'bg-primary'; break;
                        case 'shipped': $class = 'bg-indigo text-white'; break;
                        case 'delivered': $class = 'bg-success'; break;
                        case 'cancelled': $class = 'bg-danger'; break;
                        case 'returned': $class = 'bg-dark'; break;
                        case 'exchange': $class = 'bg-purple text-white'; break;
                        case 'refund': $class = 'bg-pink text-white'; break;
                    }
                    return '<span class="badge ' . $class . '">' . ucfirst($row->status) . '</span>';
                })
                ->addColumn('payment', function($row) {
                    $class = 'bg-secondary';
                    if ($row->payment_status === 'paid') {
                        $class = 'bg-success';
                    } elseif ($row->payment_status === 'unpaid') {
                        $class = 'bg-danger';
                    } elseif ($row->payment_status === 'refunded') {
                        $class = 'bg-dark';
                    }
                    return '<span class="badge ' . $class . '">' . ucfirst($row->payment_status) . '</span>';
                })
                ->addColumn('action', function($row) {
                    $viewBtn = '<a href="' . route('admin.orders.show', $row->id) . '" class="btn btn-sm btn-light me-1 rounded-circle"><i class="fas fa-eye text-primary"></i></a>';
                    $invoiceBtn = '<a href="' . route('admin.orders.invoice', $row->id) . '" target="_blank" class="btn btn-sm btn-light rounded-circle"><i class="fas fa-print text-warning"></i></a>';
                    return $viewBtn . $invoiceBtn;
                })
                ->rawColumns(['customer', 'status', 'payment', 'action'])
                ->make(true);
        }

        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $totalEarnings = Order::where('payment_status', 'paid')->sum('total');

        return view('admin.orders.index', compact('totalOrders', 'pendingOrders', 'deliveredOrders', 'totalEarnings'));
    }

    public function show(Order $order)
    {
        $order->load(['customer', 'items', 'orderNotes.user', 'statusLogs.user']);
        
        $billingAddress = Address::find($order->billing_address_id);
        $shippingAddress = Address::find($order->shipping_address_id);
        $transaction = Transaction::where('order_id', $order->id)->first();

        return view('admin.orders.show', compact('order', 'billingAddress', 'shippingAddress', 'transaction'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|in:new,pending,confirmed,processing,packed,shipped,delivered,cancelled,returned,exchange,refund',
            'payment_status' => 'required|string|in:unpaid,paid,partially_refunded,refunded',
            'tracking_number' => 'nullable|string|max:255',
            'courier_name' => 'nullable|string|max:255',
            'status_comment' => 'nullable|string|max:255',
        ]);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        $order->update([
            'status' => $newStatus,
            'payment_status' => $request->payment_status,
            'tracking_number' => $request->tracking_number,
            'courier_name' => $request->courier_name,
        ]);

        // If status changed, log in timeline
        if ($oldStatus !== $newStatus) {
            OrderStatusLog::create([
                'order_id' => $order->id,
                'status' => $newStatus,
                'changed_by' => auth()->id(),
                'comment' => $request->status_comment ?: "Status updated from {$oldStatus} to {$newStatus}.",
            ]);
        }

        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update_order',
            'details' => "Updated order {$order->order_number}: status = {$newStatus}, payment = {$request->payment_status}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.orders.show', $order->id)->with('success', 'Order updated successfully.');
    }

    public function addNote(Request $request, Order $order)
    {
        $request->validate([
            'note' => 'required|string',
            'is_customer_visible' => 'boolean',
        ]);

        OrderNote::create([
            'order_id' => $order->id,
            'note' => $request->note,
            'added_by' => auth()->id(),
            'is_customer_visible' => $request->has('is_customer_visible'),
        ]);

        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'add_order_note',
            'details' => "Added note to order {$order->order_number}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.orders.show', $order->id)->with('success', 'Order note added successfully.');
    }

    public function invoice(Order $order)
    {
        $order->load(['customer', 'items']);
        $billingAddress = Address::find($order->billing_address_id);
        $shippingAddress = Address::find($order->shipping_address_id);

        return view('admin.orders.invoice', compact('order', 'billingAddress', 'shippingAddress'));
    }

    public function packingSlip(Order $order)
    {
        $order->load(['customer', 'items']);
        $shippingAddress = Address::find($order->shipping_address_id);

        return view('admin.orders.packing_slip', compact('order', 'shippingAddress'));
    }

    public function shippingLabel(Order $order)
    {
        $order->load(['customer']);
        $shippingAddress = Address::find($order->shipping_address_id);

        return view('admin.orders.shipping_label', compact('order', 'shippingAddress'));
    }
}
