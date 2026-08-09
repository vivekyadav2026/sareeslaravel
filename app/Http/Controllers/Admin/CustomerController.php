<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Address;
use App\Models\WalletTransaction;
use App\Models\Order;
use App\Models\Review;
use App\Models\Wishlist;
use Yajra\DataTables\Facades\DataTables;
use App\Models\AdminActivityLog;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Customer::select('customers.*');
            
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            return DataTables::of($query)
                ->addColumn('name', function($row) {
                    return $row->first_name . ' ' . $row->last_name;
                })
                ->addColumn('status', function($row) {
                    $class = $row->status === 'active' ? 'bg-success' : 'bg-danger';
                    return '<span class="badge ' . $class . '">' . ucfirst($row->status) . '</span>';
                })
                ->addColumn('action', function($row) {
                    $viewBtn = '<a href="' . route('admin.customers.show', $row->id) . '" class="btn btn-sm btn-light me-1 rounded-circle"><i class="fas fa-eye text-primary"></i></a>';
                    $blockClass = $row->status === 'active' ? 'text-danger' : 'text-success';
                    $blockIcon = $row->status === 'active' ? 'fa-ban' : 'fa-check';
                    $blockBtn = '<button class="btn btn-sm btn-light rounded-circle toggle-status" data-id="' . $row->id . '" data-status="' . $row->status . '"><i class="fas ' . $blockIcon . ' ' . $blockClass . '"></i></button>';
                    return $viewBtn . $blockBtn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('admin.customers.index');
    }

    public function show(Customer $customer)
    {
        $customer->load(['addresses', 'walletTransactions' => function($q) {
            $q->orderBy('created_at', 'desc');
        }]);

        $orders = Order::where('customer_id', $customer->id)->orderBy('created_at', 'desc')->get();
        $reviews = Review::with('product')->where('customer_id', $customer->id)->orderBy('created_at', 'desc')->get();
        $wishlist = Wishlist::with('product')->where('customer_id', $customer->id)->get();
        $referredCustomers = Customer::where('referred_by', $customer->id)->get();

        return view('admin.customers.show', compact('customer', 'orders', 'reviews', 'wishlist', 'referredCustomers'));
    }

    public function toggleStatus(Request $request, Customer $customer)
    {
        $newStatus = $customer->status === 'active' ? 'blocked' : 'active';
        $customer->update(['status' => $newStatus]);

        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'toggle_customer_status',
            'details' => "Changed customer {$customer->email} status to {$newStatus}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json(['success' => true, 'message' => "Customer is now {$newStatus}."]);
    }

    public function updateNotes(Request $request, Customer $customer)
    {
        $request->validate([
            'notes' => 'nullable|string'
        ]);

        $customer->update(['notes' => $request->notes]);

        return back()->with('success', 'Customer notes updated successfully.');
    }

    public function adjustWallet(Request $request, Customer $customer)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:deposit,withdrawal',
            'description' => 'required|string|max:255'
        ]);

        if ($request->type === 'withdrawal' && $customer->wallet_balance < $request->amount) {
            return back()->withErrors(['amount' => 'Insufficient wallet balance.']);
        }

        DB::transaction(function () use ($request, $customer) {
            $amount = $request->amount;
            if ($request->type === 'withdrawal') {
                $customer->decrement('wallet_balance', $amount);
            } else {
                $customer->increment('wallet_balance', $amount);
            }

            WalletTransaction::create([
                'customer_id' => $customer->id,
                'amount' => $amount,
                'type' => $request->type,
                'description' => $request->description,
            ]);

            AdminActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'adjust_wallet',
                'details' => "Adjusted wallet for customer {$customer->email} ({$request->type} of ₹{$amount})",
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        });

        return back()->with('success', 'Wallet adjusted successfully.');
    }

    public function adjustPoints(Request $request, Customer $customer)
    {
        $request->validate([
            'points' => 'required|integer',
            'description' => 'required|string|max:255'
        ]);

        if ($request->points < 0 && $customer->reward_points < abs($request->points)) {
            return back()->withErrors(['points' => 'Cannot deduct more points than customer holds.']);
        }

        $customer->increment('reward_points', $request->points);

        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'adjust_points',
            'details' => "Adjusted reward points for customer {$customer->email} (change of {$request->points} points)",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Reward points adjusted successfully.');
    }

}
