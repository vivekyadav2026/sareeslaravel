<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Appointment;
use App\Models\BridalPackage;
use App\Models\CustomDesignRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Models\AdminActivityLog;
use Illuminate\Support\Str;

class BridalController extends Controller
{
    public function appointmentsIndex(Request $request)
    {
        if ($request->ajax()) {
            $query = Appointment::with(['customer', 'package'])->select('appointments.*');

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            return DataTables::of($query)
                ->addColumn('customer', function($row) {
                    return $row->customer ? $row->customer->first_name . ' ' . $row->customer->last_name . '<br><small class="text-muted">' . e($row->customer->phone) . '</small>' : 'N/A';
                })
                ->addColumn('package', function($row) {
                    return $row->package->name ?? 'Custom Fitting / Styling';
                })
                ->addColumn('date', function($row) {
                    return $row->appointment_date->format('Y-m-d H:i');
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
                    $confirmBtn = $row->status === 'pending' ? '<button class="btn btn-sm btn-light me-1 rounded-circle action-confirm" data-id="' . $row->id . '"><i class="fas fa-check text-success"></i></button>' : '';
                    $rescheduleBtn = '<button class="btn btn-sm btn-light rounded-circle action-reschedule" data-id="' . $row->id . '" data-date="' . $row->appointment_date->format('Y-m-d\TH:i') . '"><i class="fas fa-calendar-alt text-warning"></i></button>';
                    return $confirmBtn . $rescheduleBtn;
                })
                ->rawColumns(['customer', 'status', 'action'])
                ->make(true);
        }

        return view('admin.bridal.appointments');
    }

    public function confirmAppointment(Appointment $appointment)
    {
        $appointment->update(['status' => 'confirmed']);
        return response()->json(['success' => true, 'message' => 'Appointment confirmed successfully.']);
    }

    public function rescheduleAppointment(Request $request, Appointment $appointment)
    {
        $request->validate(['appointment_date' => 'required|date']);
        $appointment->update([
            'appointment_date' => $request->appointment_date,
            'status' => 'confirmed',
        ]);
        return response()->json(['success' => true, 'message' => 'Appointment rescheduled successfully.']);
    }

    public function packagesIndex()
    {
        $packages = BridalPackage::all();
        return view('admin.bridal.packages', compact('packages'));
    }

    public function packagesStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
        ]);

        $featuresArr = $request->filled('features') ? array_map('trim', explode(',', $request->features)) : [];

        BridalPackage::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'description' => $request->description,
            'features' => $featuresArr,
            'is_active' => true,
        ]);

        return back()->with('success', 'Bridal package created successfully.');
    }

    public function packagesDestroy(BridalPackage $package)
    {
        $package->delete();
        return back()->with('success', 'Bridal package deleted successfully.');
    }

    public function designsIndex(Request $request)
    {
        if ($request->ajax()) {
            $query = CustomDesignRequest::with('customer')->select('custom_design_requests.*');

            return DataTables::of($query)
                ->addColumn('customer', function($row) {
                    return $row->customer ? $row->customer->first_name . ' ' . $row->customer->last_name . '<br><small class="text-muted">' . e($row->customer->email) . '</small>' : 'N/A';
                })
                ->addColumn('estimated_price', function($row) {
                    return $row->estimated_price ? '₹' . number_format($row->estimated_price, 2) : '<span class="text-muted">Not Quoted</span>';
                })
                ->addColumn('delivery_date', function($row) {
                    return $row->estimated_delivery_date ? $row->estimated_delivery_date->format('Y-m-d') : '<span class="text-muted">N/A</span>';
                })
                ->addColumn('status', function($row) {
                    $class = 'bg-secondary';
                    if ($row->status === 'approved') $class = 'bg-success';
                    elseif ($row->status === 'pending') $class = 'bg-warning text-dark';
                    elseif ($row->status === 'quotation_sent') $class = 'bg-info';
                    elseif ($row->status === 'in_production') $class = 'bg-primary';
                    return '<span class="badge ' . $class . '">' . ucfirst(str_replace('_', ' ', $row->status)) . '</span>';
                })
                ->addColumn('action', function($row) {
                    $quoteBtn = '<button class="btn btn-sm btn-light rounded-circle action-quote me-1" data-id="' . $row->id . '" data-price="' . $row->estimated_price . '" data-notes="' . e($row->admin_notes) . '" data-date="' . ($row->estimated_delivery_date ? $row->estimated_delivery_date->format('Y-m-d') : '') . '"><i class="fas fa-calculator text-warning"></i></button>';
                    $detailsBtn = '<button class="btn btn-sm btn-light rounded-circle action-details" data-details="' . e($row->design_details) . '"><i class="fas fa-eye text-primary"></i></button>';
                    return $quoteBtn . $detailsBtn;
                })
                ->rawColumns(['customer', 'estimated_price', 'delivery_date', 'status', 'action'])
                ->make(true);
        }

        return view('admin.bridal.designs');
    }

    public function sendQuotation(Request $request, CustomDesignRequest $design)
    {
        $request->validate([
            'estimated_price' => 'required|numeric|min:0',
            'estimated_delivery_date' => 'required|date',
            'admin_notes' => 'nullable|string',
        ]);

        $design->update([
            'estimated_price' => $request->estimated_price,
            'estimated_delivery_date' => $request->estimated_delivery_date,
            'admin_notes' => $request->admin_notes,
            'status' => 'quotation_sent',
        ]);

        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'send_bridal_quotation',
            'details' => "Sent quotation for custom request #{$design->id}: price = {$request->estimated_price}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json(['success' => true, 'message' => 'Quotation generated and saved successfully.']);
    }
}
