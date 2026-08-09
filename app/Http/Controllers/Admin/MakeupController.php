<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MakeupService;
use App\Models\MakeupBooking;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class MakeupController extends Controller
{
    public function bookingsIndex(Request $request)
    {
        if ($request->ajax()) {
            $query = MakeupBooking::with(['customer', 'service'])->select('makeup_bookings.*');

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            return DataTables::of($query)
                ->addColumn('customer', function($row) {
                    return $row->customer ? $row->customer->first_name . ' ' . $row->customer->last_name . '<br><small class="text-muted">' . e($row->customer->email) . '</small>' : 'N/A';
                })
                ->addColumn('service', function($row) {
                    return $row->service->name ?? 'Custom Service';
                })
                ->addColumn('date', function($row) {
                    return $row->booking_date->format('Y-m-d H:i');
                })
                ->addColumn('price', function($row) {
                    return '₹' . number_format($row->total_price, 2);
                })
                ->addColumn('status', function($row) {
                    $class = 'bg-secondary';
                    if ($row->status === 'confirmed') $class = 'bg-success';
                    elseif ($row->status === 'pending') $class = 'bg-warning text-dark';
                    elseif ($row->status === 'completed') $class = 'bg-info';
                    elseif ($row->status === 'cancelled') $class = 'bg-danger';
                    return '<span class="badge ' . $class . '">' . ucfirst($row->status) . '</span>';
                })
                ->addColumn('action', function($row) {
                    if ($row->status === 'pending') {
                        return '<button class="btn btn-sm btn-light rounded-circle action-confirm-makeup" data-id="' . $row->id . '"><i class="fas fa-check text-success"></i></button>';
                    }
                    return '<span class="text-muted">N/A</span>';
                })
                ->rawColumns(['customer', 'status', 'action'])
                ->make(true);
        }

        return view('admin.makeup.bookings');
    }

    public function confirmBooking(MakeupBooking $booking)
    {
        $booking->update(['status' => 'confirmed']);
        return response()->json(['success' => true, 'message' => 'Makeup booking confirmed successfully.']);
    }

    public function servicesIndex()
    {
        $services = MakeupService::all();
        return view('admin.makeup.services', compact('services'));
    }

    public function servicesStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
        ]);

        MakeupService::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'duration_minutes' => $request->duration_minutes,
            'description' => $request->description,
            'features' => $request->features,
            'is_popular' => $request->has('is_popular'),
            'is_active' => true,
        ]);

        return back()->with('success', 'Makeup service package created successfully.');
    }

    public function servicesDestroy(MakeupService $service)
    {
        $service->delete();
        return back()->with('success', 'Makeup service deleted successfully.');
    }
}
