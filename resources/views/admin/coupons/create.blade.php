@extends('layouts.admin')

@section('title', 'Add Coupon')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0 fw-bold">Create Coupon Campaign</h5>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger border-0 bg-danger bg-opacity-25 text-white rounded-3 mb-4">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.coupons.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="code" class="form-label fw-semibold">Coupon Code</label>
                        <input type="text" class="form-control font-monospace text-uppercase" id="code" name="code" value="{{ old('code') }}" placeholder="e.g. BRIDE2026" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="type" class="form-label fw-semibold">Discount Type</label>
                            <select name="type" id="type" class="form-select" required>
                                <option value="percentage" {{ old('type') === 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                <option value="fixed" {{ old('type') === 'fixed' ? 'selected' : '' }}>Fixed Amount (INR)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="value" class="form-label fw-semibold">Discount Value</label>
                            <input type="number" step="0.01" class="form-control" id="value" name="value" value="{{ old('value') }}" placeholder="e.g. 15 or 500" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="min_order_value" class="form-label fw-semibold">Minimum Order Value (INR)</label>
                            <input type="number" step="0.01" class="form-control" id="min_order_value" name="min_order_value" value="{{ old('min_order_value', '0') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="limit" class="form-label fw-semibold">Usage Limit (Max Uses)</label>
                            <input type="number" class="form-control" id="limit" name="limit" value="{{ old('limit') }}" placeholder="Leave blank for unlimited">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="start_date" class="form-label fw-semibold">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="end_date" class="form-label fw-semibold">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}">
                        </div>
                    </div>

                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" checked value="1">
                        <label class="form-check-label fw-semibold" for="is_active">Make Coupon Active Immediately</label>
                    </div>

                    <div class="d-flex justify-content-end gap-2 border-top pt-4">
                        <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Create Coupon</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
