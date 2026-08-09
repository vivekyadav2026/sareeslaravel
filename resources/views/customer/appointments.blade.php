@extends('layouts.app')

@section('title', 'Bridal Consultations — RANISAHAB')

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
            
            <!-- Bridal Appointments Content -->
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
                    <!-- Left: Appointments History -->
                    <div class="col-lg-7">
                        <div class="dashboard-card">
                            <h4 class="font-display text-maroon mb-3 border-bottom pb-2" style="font-weight:700;">
                                <i class="fa-solid fa-calendar-check me-2 text-gold"></i>My Consultations
                            </h4>
                            
                            @if ($appointments->isEmpty())
                                <div class="text-center py-5">
                                    <i class="fa-regular fa-calendar-times text-muted mb-2" style="font-size:2.5rem;"></i>
                                    <p class="mb-0 text-muted">You have no upcoming or past bridal consultations. Request an exclusive trial session on the right.</p>
                                </div>
                            @else
                                <div class="d-grid gap-3">
                                    @foreach ($appointments as $app)
                                        <div class="p-3 border rounded position-relative">
                                            <!-- Status -->
                                            <span class="position-absolute top-0 end-0 m-3">
                                                @if($app->status === 'confirmed')
                                                    <span class="badge badge-luxury-success"><i class="fa-solid fa-circle-check me-1"></i> {{ $app->status }}</span>
                                                @elseif($app->status === 'pending')
                                                    <span class="badge badge-luxury-pending"><i class="fa-solid fa-clock me-1"></i> {{ $app->status }}</span>
                                                @else
                                                    <span class="badge badge-luxury-danger"><i class="fa-solid fa-circle-xmark me-1"></i> {{ $app->status }}</span>
                                                @endif
                                            </span>

                                            <h6 class="font-display text-dark mb-1" style="font-weight:700;">{{ $app->package->name ?? 'Custom Consultation' }}</h6>
                                            
                                            <!-- Date and Time -->
                                            <div class="text-gold-dark small mb-2" style="font-family:var(--font-label); font-weight:600;">
                                                <i class="fa-regular fa-clock me-1"></i> {{ $app->appointment_date->format('d M Y — h:i A') }}
                                            </div>

                                            @if($app->notes)
                                                <div class="p-2 bg-light rounded mt-2 border-start border-warning text-secondary" style="font-size:0.8rem; line-height:1.4;">
                                                    <strong>Boutique Note:</strong> {{ $app->notes }}
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Right: Request Consultation -->
                    <div class="col-lg-5">
                        <div class="dashboard-card">
                            <h4 class="font-display text-maroon mb-3 border-bottom pb-2" style="font-weight:700;">
                                <i class="fa-solid fa-circle-plus me-2 text-gold"></i>Book Consultation
                            </h4>
                            
                            <form action="{{ route('customer.appointments.store') }}" method="POST">
                                @csrf
                                
                                <div class="mb-3 luxury-input-group d-flex flex-column">
                                    <label for="bridal_package_id">Select Bridal Package</label>
                                    <select name="bridal_package_id" id="bridal_package_id" class="luxury-input form-select" required>
                                        <option value="">-- Choose a package --</option>
                                        @foreach ($packages as $pkg)
                                            <option value="{{ $pkg->id }}">{{ $pkg->name }} (₹{{ number_format($pkg->price, 0) }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 luxury-input-group d-flex flex-column">
                                    <label for="appointment_date">Consultation Date &amp; Time</label>
                                    <input type="datetime-local" name="appointment_date" id="appointment_date" class="luxury-input form-control" required>
                                    <small class="text-muted mt-1" style="font-size:0.68rem;"><i class="fa-solid fa-info-circle me-1"></i>Please choose a date at least 24 hours in advance.</small>
                                </div>

                                <div class="mb-4 luxury-input-group d-flex flex-column">
                                    <label for="notes">Styling Requirements / Notes</label>
                                    <textarea name="notes" id="notes" rows="4" class="luxury-input form-control" placeholder="Specify details like double dupatta preferences, color palettes you wish to match, or style trial requests..." style="font-size:0.8rem;"></textarea>
                                </div>

                                <button type="submit" class="btn-gold w-100 py-2">
                                    REQUEST APPOINTMENT <i class="fa-solid fa-envelope-open ms-1"></i>
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
