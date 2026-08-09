<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Coupon;
use Yajra\DataTables\Facades\DataTables;
use App\Models\AdminActivityLog;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $coupons = Coupon::select('coupons.*');
            return DataTables::of($coupons)
                ->addColumn('value', function($row) {
                    if ($row->type === 'percentage') {
                        return $row->value . '%';
                    }
                    return '₹' . number_format($row->value, 2);
                })
                ->addColumn('status', function($row) {
                    $class = $row->is_active ? 'bg-success' : 'bg-secondary';
                    $text = $row->is_active ? 'Active' : 'Inactive';
                    return '<span class="badge ' . $class . '">' . $text . '</span>';
                })
                ->addColumn('action', function($row) {
                    $editBtn = '<a href="' . route('admin.coupons.edit', $row->id) . '" class="btn btn-sm btn-light me-1 rounded-circle"><i class="fas fa-edit text-warning"></i></a>';
                    $deleteBtn = '<button class="btn btn-sm btn-light rounded-circle delete-coupon" data-id="' . $row->id . '"><i class="fas fa-trash text-danger"></i></button>';
                    return $editBtn . $deleteBtn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('admin.coupons.index');
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:coupons,code|max:255',
            'type' => 'required|string|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'min_order_value' => 'required|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'limit' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $coupon = Coupon::create(array_merge($request->all(), [
            'is_active' => $request->has('is_active'),
        ]));

        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create_coupon',
            'details' => "Created coupon code: {$coupon->code}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully.');
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code' => 'required|string|unique:coupons,code,' . $coupon->id . '|max:255',
            'type' => 'required|string|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'min_order_value' => 'required|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'limit' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $coupon->update(array_merge($request->all(), [
            'is_active' => $request->has('is_active'),
        ]));

        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update_coupon',
            'details' => "Updated coupon code: {$coupon->code}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully.');
    }

    public function destroy(Request $request, Coupon $coupon)
    {
        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete_coupon',
            'details' => "Deleted coupon code: {$coupon->code}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $coupon->delete();

        return response()->json(['success' => true, 'message' => 'Coupon deleted successfully.']);
    }
}
