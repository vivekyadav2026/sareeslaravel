@extends('layouts.app')

@section('title', 'Custom Designs — RANISAHAB')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}?v={{ time() }}">
@endpush

@section('content')
<div class="customer-dashboard-wrapper py-5">
    <div class="container">
        <div class="row">
            
            <!-- Sidebar -->
            <div class="col-lg-3 col-md-4 mb-4">
                @include('customer.layouts.sidebar')
            </div>
            
            <!-- Custom Designs Content -->
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
                    <!-- Left: Custom Design Requests History -->
                    <div class="col-lg-7">
                        <div class="dashboard-card">
                            <h4 class="font-display text-maroon mb-3 border-bottom pb-2" style="font-weight:700;">
                                <i class="fa-solid fa-scissors me-2 text-gold"></i>Bespoke Design Inquiries
                            </h4>
                            
                            @if ($requests->isEmpty())
                                <div class="text-center py-5">
                                    <i class="fa-solid fa-scissors text-muted mb-2" style="font-size:2.5rem;"></i>
                                    <p class="mb-0 text-muted">You have no custom boutique design requests. Propose a new custom bridal silhouette on the right.</p>
                                </div>
                            @else
                                <div class="d-grid gap-3">
                                    @foreach ($requests as $req)
                                        <div class="p-3 border rounded position-relative">
                                            <!-- Status -->
                                            <span class="position-absolute top-0 end-0 m-3">
                                                @if($req->status === 'quotation_sent')
                                                    <span class="badge badge-luxury-pending" style="background-color:rgba(197, 168, 128, 0.15); color:var(--gold-dark); border-color:var(--gold);"><i class="fa-solid fa-tags me-1"></i> Quote Sent</span>
                                                @elseif($req->status === 'pending')
                                                    <span class="badge badge-luxury-pending"><i class="fa-solid fa-clock me-1"></i> Under Review</span>
                                                @elseif($req->status === 'approved' || $req->status === 'completed')
                                                    <span class="badge badge-luxury-success"><i class="fa-solid fa-circle-check me-1"></i> {{ ucfirst($req->status) }}</span>
                                                @else
                                                    <span class="badge badge-luxury-pending" style="background-color:#eaeaea; color:#333;">{{ ucfirst($req->status) }}</span>
                                                @endif
                                            </span>

                                            <div class="text-muted small mb-2" style="font-family:var(--font-label);">
                                                SUBMITTED {{ $req->created_at->format('d M Y') }}
                                            </div>

                                            <p class="text-dark small mb-2" style="line-height:1.4;">
                                                <strong>Design Details:</strong> {{ $req->design_details }}
                                            </p>

                                            <div class="row g-2 mb-2 small text-secondary">
                                                @if($req->fabric_preference)
                                                    <div class="col-6"><strong>Fabric:</strong> {{ $req->fabric_preference }}</div>
                                                @endif
                                                @if($req->budget_range)
                                                    <div class="col-6"><strong>Budget:</strong> {{ $req->budget_range }}</div>
                                                @endif
                                            </div>

                                            <!-- Display Reference Image Uploaded -->
                                            @if($req->image_path)
                                                <div class="mt-2 mb-2">
                                                    <strong class="small d-block mb-1 text-secondary">Reference Sketch:</strong>
                                                    <a href="{{ asset($req->image_path) }}" target="_blank">
                                                        <img src="{{ asset($req->image_path) }}" alt="Reference design" class="design-preview-box">
                                                    </a>
                                                </div>
                                            @endif

                                            <!-- Estimations / Designer Quotation Info -->
                                            @if($req->estimated_price || $req->estimated_delivery_date || $req->admin_notes)
                                                <div class="mt-3 p-3 bg-light rounded border border-light-subtle">
                                                    <h6 class="font-display text-maroon mb-2" style="font-weight:700;"><i class="fa-solid fa-file-invoice-dollar text-gold me-1"></i>Designer Estimation Details</h6>
                                                    
                                                    @if($req->estimated_price)
                                                        <div class="small text-secondary mb-1">
                                                            Estimated Quote: <strong class="text-dark">₹{{ number_format($req->estimated_price, 2) }}</strong>
                                                        </div>
                                                    @endif

                                                    @if($req->estimated_delivery_date)
                                                        <div class="small text-secondary mb-1">
                                                            Delivery Spec: <strong class="text-dark">{{ $req->estimated_delivery_date->format('d M Y') }}</strong>
                                                        </div>
                                                    @endif

                                                    @if($req->admin_notes)
                                                        <div class="small text-secondary mt-2 border-top pt-2">
                                                            <strong>Stylist Notes:</strong> {{ $req->admin_notes }}
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Right: Propose New Custom Design -->
                    <div class="col-lg-5">
                        <div class="dashboard-card">
                            <h4 class="font-display text-maroon mb-3 border-bottom pb-2" style="font-weight:700;">
                                <i class="fa-solid fa-circle-plus me-2 text-gold"></i>New Custom Design
                            </h4>
                            
                            <form action="{{ route('customer.custom-designs.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="mb-3 luxury-input-group d-flex flex-column">
                                    <label for="fabric_preference">Preferred Fabric / Handloom</label>
                                    <input type="text" name="fabric_preference" id="fabric_preference" class="luxury-input form-control" placeholder="e.g. Kanchipuram Silk, Velvet border, Organza" value="{{ old('fabric_preference') }}">
                                </div>

                                <div class="mb-3 luxury-input-group d-flex flex-column">
                                    <label for="budget_range">Estimated Budget Range</label>
                                    <input type="text" name="budget_range" id="budget_range" class="luxury-input form-control" placeholder="e.g. ₹60,000 - ₹90,000" value="{{ old('budget_range') }}">
                                </div>

                                <div class="mb-3 luxury-input-group d-flex flex-column">
                                    <label for="design_details">Design Details &amp; Specifications</label>
                                    <textarea name="design_details" id="design_details" rows="5" class="luxury-input form-control" placeholder="Provide complete specifications: borders embroidery, neckline details, motifs style (e.g. peacock, floral), zardozi density, etc..." required style="font-size:0.8rem;"></textarea>
                                </div>

                                <div class="mb-4 luxury-input-group d-flex flex-column">
                                    <label for="design_image">Reference Design / Sketch Image</label>
                                    <input type="file" name="design_image" id="design_image" class="form-control luxury-input" accept="image/*">
                                    <small class="text-muted mt-1" style="font-size:0.68rem;"><i class="fa-solid fa-image me-1"></i>Upload JPG, PNG, or WebP. Max 4MB.</small>
                                </div>

                                <button type="submit" class="btn-gold w-100 py-2">
                                    SUBMIT SPECIFICATION <i class="fa-solid fa-scissors ms-1"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>
</div>
@endsection
