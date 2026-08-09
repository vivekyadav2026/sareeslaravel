@extends('layouts.admin')

@section('title', 'Log Sizing Specs')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto mb-4">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold"><i class="fas fa-cut me-2 text-warning"></i> Log Fitting Measurement Specs</h5>
                <a href="{{ route('admin.measurements.index') }}" class="btn btn-sm btn-light rounded-pill"><i class="fas fa-undo me-2"></i> Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.measurements.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="customer_id" class="form-label fw-semibold">Select Customer</label>
                            <select name="customer_id" id="customer_id" class="form-select" required>
                                <option value="">Select a Client...</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }} ({{ $customer->phone }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="title" class="form-label fw-semibold">Sheet Label / Title</label>
                            <input type="text" class="form-control" name="title" id="title" required value="Standard Bridal Fitting" placeholder="e.g. Silk Lehenga Specs">
                        </div>
                    </div>

                    <h6 class="fw-bold text-warning text-uppercase mb-3 border-bottom pb-2">Measurement Form (Inches)</h6>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-4 col-6">
                            <label for="bust" class="form-label small">Bust</label>
                            <input type="number" step="0.01" name="bust" id="bust" class="form-control" placeholder="0.00">
                        </div>
                        <div class="col-md-4 col-6">
                            <label for="waist" class="form-label small">Waist</label>
                            <input type="number" step="0.01" name="waist" id="waist" class="form-control" placeholder="0.00">
                        </div>
                        <div class="col-md-4 col-6">
                            <label for="hips" class="form-label small">Hips</label>
                            <input type="number" step="0.01" name="hips" id="hips" class="form-control" placeholder="0.00">
                        </div>
                        <div class="col-md-4 col-6">
                            <label for="shoulder" class="form-label small">Shoulder Width</label>
                            <input type="number" step="0.01" name="shoulder" id="shoulder" class="form-control" placeholder="0.00">
                        </div>
                        <div class="col-md-4 col-6">
                            <label for="chest" class="form-label small">Chest</label>
                            <input type="number" step="0.01" name="chest" id="chest" class="form-control" placeholder="0.00">
                        </div>
                        <div class="col-md-4 col-6">
                            <label for="sleeve_length" class="form-label small">Sleeve Length</label>
                            <input type="number" step="0.01" name="sleeve_length" id="sleeve_length" class="form-control" placeholder="0.00">
                        </div>
                        <div class="col-md-4 col-6">
                            <label for="lehenga_length" class="form-label small">Lehenga Length</label>
                            <input type="number" step="0.01" name="lehenga_length" id="lehenga_length" class="form-control" placeholder="0.00">
                        </div>
                        <div class="col-md-4 col-6">
                            <label for="blouse_length" class="form-label small">Blouse Length</label>
                            <input type="number" step="0.01" name="blouse_length" id="blouse_length" class="form-control" placeholder="0.00">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="notes" class="form-label fw-semibold">Karigar Fitting & Customization Instructions</label>
                        <textarea class="form-control" name="notes" id="notes" rows="4" placeholder="Detail any double dupatta styling, neck depth, or border alterations..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-warning rounded-pill px-4 w-100 fw-bold">Log Measurement Specs</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
