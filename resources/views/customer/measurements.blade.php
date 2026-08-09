@extends('layouts.app')

@section('title', 'Fitting Spec Sheet — RANISAHAB')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}?v={{ time() }}">
    <style>
        .spec-item-badge {
            background-color: var(--maroon);
            color: var(--gold-light);
            border-radius: 50%;
            width: 22px;
            height: 22px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            font-weight: bold;
            margin-right: 0.4rem;
        }
    </style>
@endpush

@section('content')
<div class="customer-dashboard-wrapper py-5">
    <div class="container">
        <div class="row">
            
            <!-- Sidebar -->
            <div class="col-lg-3 col-md-4 mb-4">
                @include('customer.layouts.sidebar')
            </div>
            
            <!-- Fitting Spec Sheet Content -->
            <div class="col-lg-9 col-md-8">
                
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <ul class="mb-0 list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li><i class="fa-solid fa-triangle-exclamation me-2"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <!-- Left: Sizing Inputs -->
                    <div class="col-lg-7 mb-4">
                        <div class="dashboard-card">
                            <h4 class="font-display text-maroon mb-3 border-bottom pb-2" style="font-weight:700;">
                                <i class="fa-solid fa-ruler-combined me-2 text-gold"></i>Tailor Fitting Specs
                            </h4>
                            
                            <form action="{{ route('customer.measurements.update') }}" method="POST">
                                @csrf
                                
                                <div class="mb-4 luxury-input-group d-flex flex-column">
                                    <label for="title">Fitting Specification Title</label>
                                    <input type="text" name="title" id="title" class="luxury-input form-control" value="{{ old('title', $measurements->title ?? 'My Royal Bridal Sizing Specs') }}" placeholder="e.g. Wedding Lehenga Measurements" required>
                                    <small class="text-muted mt-1" style="font-size:0.68rem;"><i class="fa-solid fa-circle-info me-1"></i>Give this sheet a label to reference it during consultations.</small>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="luxury-input-group d-flex flex-column">
                                            <label for="bust"><span class="spec-item-badge">1</span> Bust (inches)</label>
                                            <input type="number" step="0.01" name="bust" id="bust" class="luxury-input form-control" value="{{ old('bust', $measurements->bust ?? '') }}" placeholder="34.5">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="luxury-input-group d-flex flex-column">
                                            <label for="waist"><span class="spec-item-badge">2</span> Waist (inches)</label>
                                            <input type="number" step="0.01" name="waist" id="waist" class="luxury-input form-control" value="{{ old('waist', $measurements->waist ?? '') }}" placeholder="28.0">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="luxury-input-group d-flex flex-column">
                                            <label for="hips"><span class="spec-item-badge">3</span> Hips (inches)</label>
                                            <input type="number" step="0.01" name="hips" id="hips" class="luxury-input form-control" value="{{ old('hips', $measurements->hips ?? '') }}" placeholder="38.0">
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="luxury-input-group d-flex flex-column">
                                            <label for="shoulder"><span class="spec-item-badge">4</span> Shoulder (inches)</label>
                                            <input type="number" step="0.01" name="shoulder" id="shoulder" class="luxury-input form-control" value="{{ old('shoulder', $measurements->shoulder ?? '') }}" placeholder="14.5">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="luxury-input-group d-flex flex-column">
                                            <label for="chest"><span class="spec-item-badge">5</span> Chest (inches)</label>
                                            <input type="number" step="0.01" name="chest" id="chest" class="luxury-input form-control" value="{{ old('chest', $measurements->chest ?? '') }}" placeholder="33.0">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="luxury-input-group d-flex flex-column">
                                            <label for="sleeve_length"><span class="spec-item-badge">6</span> Sleeve (inches)</label>
                                            <input type="number" step="0.01" name="sleeve_length" id="sleeve_length" class="luxury-input form-control" value="{{ old('sleeve_length', $measurements->sleeve_length ?? '') }}" placeholder="12.0">
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <div class="luxury-input-group d-flex flex-column">
                                            <label for="lehenga_length"><span class="spec-item-badge">7</span> Lehenga Length (inches)</label>
                                            <input type="number" step="0.01" name="lehenga_length" id="lehenga_length" class="luxury-input form-control" value="{{ old('lehenga_length', $measurements->lehenga_length ?? '') }}" placeholder="41.5">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="luxury-input-group d-flex flex-column">
                                            <label for="blouse_length"><span class="spec-item-badge">8</span> Blouse Length (inches)</label>
                                            <input type="number" step="0.01" name="blouse_length" id="blouse_length" class="luxury-input form-control" value="{{ old('blouse_length', $measurements->blouse_length ?? '') }}" placeholder="14.0">
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4 border-warning border-opacity-25">
                                <h5 class="font-display text-gold-dark mb-3" style="font-weight:600;"><i class="fa-solid fa-scissors me-2"></i>Advanced Blouse &amp; Fit Parameters</h5>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="luxury-input-group d-flex flex-column">
                                            <label for="front_neck_depth"><span class="spec-item-badge">9</span> Front Neck (in)</label>
                                            <input type="number" step="0.01" name="front_neck_depth" id="front_neck_depth" class="luxury-input form-control" value="{{ old('front_neck_depth', $measurements->front_neck_depth ?? '') }}" placeholder="7.5">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="luxury-input-group d-flex flex-column">
                                            <label for="back_neck_depth"><span class="spec-item-badge">10</span> Back Neck (in)</label>
                                            <input type="number" step="0.01" name="back_neck_depth" id="back_neck_depth" class="luxury-input form-control" value="{{ old('back_neck_depth', $measurements->back_neck_depth ?? '') }}" placeholder="9.5">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="luxury-input-group d-flex flex-column">
                                            <label for="armhole"><span class="spec-item-badge">11</span> Armhole (in)</label>
                                            <input type="number" step="0.01" name="armhole" id="armhole" class="luxury-input form-control" value="{{ old('armhole', $measurements->armhole ?? '') }}" placeholder="16.0">
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <div class="luxury-input-group d-flex flex-column">
                                            <label for="wrist"><span class="spec-item-badge">12</span> Wrist (inches)</label>
                                            <input type="number" step="0.01" name="wrist" id="wrist" class="luxury-input form-control" value="{{ old('wrist', $measurements->wrist ?? '') }}" placeholder="6.5">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="luxury-input-group d-flex flex-column">
                                            <label for="ankle_length"><span class="spec-item-badge">13</span> Ankle Length (in)</label>
                                            <input type="number" step="0.01" name="ankle_length" id="ankle_length" class="luxury-input form-control" value="{{ old('ankle_length', $measurements->ankle_length ?? '') }}" placeholder="39.0">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 luxury-input-group d-flex flex-column">
                                    <label for="notes">Bespoke Fitting Notes</label>
                                    <textarea name="notes" id="notes" rows="4" class="luxury-input form-control" placeholder="Mention design alteration guidelines, preferred blouse lining fabric, cup padding details, or side zipper margin settings..." style="font-size:0.8rem;">{{ old('notes', $measurements->notes ?? '') }}</textarea>
                                </div>

                                <button type="submit" class="btn-gold py-2 px-4">
                                    SAVE SPECIFICATIONS <i class="fa-solid fa-save ms-1"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Right: Visual Reference Guide -->
                    <div class="col-lg-5">
                        <div class="dashboard-card h-100">
                            <h4 class="font-display text-maroon mb-3 border-bottom pb-2" style="font-weight:700;">
                                <i class="fa-solid fa-circle-question me-2 text-gold"></i>Fitting Guide
                            </h4>
                            
                            <div class="p-3 bg-light rounded text-secondary" style="font-size:0.78rem; line-height:1.6;">
                                <p class="mb-3 text-dark fw-bold"><i class="fa-solid fa-info-circle text-gold me-1"></i>How to measure yourself accurately:</p>
                                
                                <ul class="list-unstyled d-grid gap-3 mb-0">
                                    <li>
                                        <strong><span class="spec-item-badge">1</span> Bust:</strong> Measure around the fullest part of your bust while wearing a well-fitting, unpadded bra.
                                    </li>
                                    <li>
                                        <strong><span class="spec-item-badge">2</span> Waist:</strong> Measure around your natural waistline, which is generally the narrowest part of your torso.
                                    </li>
                                    <li>
                                        <strong><span class="spec-item-badge">3</span> Hips:</strong> Measure around the widest part of your hips/buttocks.
                                    </li>
                                    <li>
                                        <strong><span class="spec-item-badge">6</span> Sleeve Length:</strong> Measure from the edge of your shoulder bone down to your preferred sleeve hem.
                                    </li>
                                    <li>
                                        <strong><span class="spec-item-badge">7</span> Lehenga Length:</strong> Measure from where you wear your lehenga skirt (typically natural waist) down to the floor, accounting for the height of your bridal heels.
                                    </li>
                                    <li>
                                        <strong><span class="spec-item-badge">9 &amp; 10</span> Neck Depths:</strong> Measure from the center neck bone down to your desired cleavage line or back line.
                                    </li>
                                    <li>
                                        <strong><span class="spec-item-badge">11</span> Armhole:</strong> Measure around your shoulder socket where the sleeve attaches to the blouse bodice.
                                    </li>
                                    <li>
                                        <strong><span class="spec-item-badge">13</span> Ankle Length:</strong> Measure waist-to-ankle parameter, essential for custom length suits and petticoats.
                                    </li>
                                </ul>

                                <div class="mt-4 p-3 border border-warning border-opacity-25 rounded bg-warning bg-opacity-10 text-dark">
                                    <i class="fa-solid fa-phone-volume text-maroon me-2"></i>
                                    <strong>Need Assistance?</strong>
                                    <div class="mt-1 small text-muted">Schedule a quick 1-on-1 WhatsApp video consultation with our Master Tailor via the Consultations tab!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>
</div>
@endsection
