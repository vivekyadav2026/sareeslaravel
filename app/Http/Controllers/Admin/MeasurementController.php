<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Measurement;
use App\Models\Customer;
use Yajra\DataTables\Facades\DataTables;
use App\Models\AdminActivityLog;

class MeasurementController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Measurement::with('customer')->select('measurements.*');
            return DataTables::of($query)
                ->addColumn('customer', function($row) {
                    return $row->customer ? $row->customer->first_name . ' ' . $row->customer->last_name . '<br><small class="text-muted">' . e($row->customer->email) . '</small>' : 'N/A';
                })
                ->addColumn('action', function($row) {
                    $showBtn = '<a href="' . route('admin.measurements.show', $row->id) . '" class="btn btn-sm btn-light me-1 rounded-circle"><i class="fas fa-eye text-primary"></i></a>';
                    $deleteBtn = '<button class="btn btn-sm btn-light rounded-circle delete-sheet" data-id="' . $row->id . '"><i class="fas fa-trash text-danger"></i></button>';
                    return $showBtn . $deleteBtn;
                })
                ->rawColumns(['customer', 'action'])
                ->make(true);
        }

        return view('admin.bridal.measurements_index');
    }

    public function show(Measurement $measurement)
    {
        $measurement->load('customer');
        return view('admin.bridal.measurements_show', compact('measurement'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('admin.bridal.measurements_create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'title' => 'required|string|max:255',
            'bust' => 'nullable|numeric|min:0',
            'waist' => 'nullable|numeric|min:0',
            'hips' => 'nullable|numeric|min:0',
            'shoulder' => 'nullable|numeric|min:0',
            'chest' => 'nullable|numeric|min:0',
            'sleeve_length' => 'nullable|numeric|min:0',
            'lehenga_length' => 'nullable|numeric|min:0',
            'blouse_length' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $measurement = Measurement::create($request->all());

        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create_measurement_sheet',
            'details' => "Created measurement sheet: {$measurement->title} for customer ID {$measurement->customer_id}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.measurements.index')->with('success', 'Measurement sheet logged successfully.');
    }

    public function destroy(Measurement $measurement)
    {
        $measurement->delete();
        return response()->json(['success' => true, 'message' => 'Measurement sheet deleted successfully.']);
    }
}
