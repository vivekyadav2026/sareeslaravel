@extends('layouts.app')

@section('title', 'Makeup Bookings — RANISAHAB')

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
            
            <!-- Makeup Bookings Content -->
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
                    <!-- Left: Bookings History -->
                    <div class="col-lg-7">
                        <div class="dashboard-card">
                            <h4 class="font-display text-maroon mb-3 border-bottom pb-2" style="font-weight:700;">
                                <i class="fa-solid fa-spa me-2 text-gold"></i>My Makeup Sessions
                            </h4>
                            
                            @if ($bookings->isEmpty())
                                <div class="text-center py-5">
                                    <i class="fa-solid fa-wand-magic-sparkles text-muted mb-2" style="font-size:2.5rem;"></i>
                                    <p class="mb-0 text-muted">You have no upcoming or past makeup bookings. Request a makeover session on the right.</p>
                                </div>
                            @else
                                <div class="d-grid gap-3">
                                    @foreach ($bookings as $booking)
                                        <div class="p-3 border rounded position-relative">
                                            <!-- Status -->
                                            <span class="position-absolute top-0 end-0 m-3">
                                                @if($booking->status === 'confirmed')
                                                    <span class="badge badge-luxury-success"><i class="fa-solid fa-circle-check me-1"></i> {{ $booking->status }}</span>
                                                @elseif($booking->status === 'pending')
                                                    <span class="badge badge-luxury-pending"><i class="fa-solid fa-clock me-1"></i> {{ $booking->status }}</span>
                                                @else
                                                    <span class="badge badge-luxury-danger"><i class="fa-solid fa-circle-xmark me-1"></i> {{ $booking->status }}</span>
                                                @endif
                                            </span>

                                            <h6 class="font-display text-dark mb-1" style="font-weight:700;">{{ $booking->service->name ?? 'Custom Makeover' }}</h6>
                                            
                                            <!-- Artist & Price Info -->
                                            <div class="text-secondary small mb-1">
                                                <i class="fa-solid fa-user-tie text-gold me-1"></i>Artist: <strong>{{ $booking->artist_name }}</strong>
                                            </div>
                                            <div class="text-secondary small mb-2">
                                                <i class="fa-solid fa-tags text-gold me-1"></i>Price: <strong>₹{{ number_format($booking->total_price, 2) }}</strong>
                                            </div>

                                            <!-- Date and Time -->
                                            <div class="text-gold-dark small mb-2" style="font-family:var(--font-label); font-weight:600;">
                                                <i class="fa-regular fa-clock me-1"></i> {{ $booking->booking_date->format('d M Y — h:i A') }}
                                            </div>

                                            @if($booking->notes)
                                                <div class="p-2 bg-light rounded mt-2 border-start border-warning text-secondary" style="font-size:0.8rem; line-height:1.4;">
                                                    <strong>Booking Note:</strong> {{ $booking->notes }}
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Right: Book Makeup Session -->
                    <div class="col-lg-5">
                        <div class="dashboard-card">
                            <h4 class="font-display text-maroon mb-3 border-bottom pb-2" style="font-weight:700;">
                                <i class="fa-solid fa-circle-plus me-2 text-gold"></i>Book Makeup Session
                            </h4>
                            
                            <form action="{{ route('customer.makeup-bookings.store') }}" method="POST">
                                @csrf
                                
                                <div class="mb-3 luxury-input-group d-flex flex-column">
                                    <label for="makeup_service_id">Select Makeup Service</label>
                                    <select name="makeup_service_id" id="makeup_service_id" class="luxury-input form-select" required>
                                        <option value="">-- Choose a service --</option>
                                        @foreach ($services as $srv)
                                            <option value="{{ $srv->id }}">{{ $srv->name }} (₹{{ number_format($srv->price, 0) }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 luxury-input-group d-flex flex-column">
                                    <label for="booking_date">Session Date &amp; Time</label>
                                    <input type="datetime-local" name="booking_date" id="booking_date" class="luxury-input form-control" required>
                                    <small class="text-muted mt-1" style="font-size:0.68rem;"><i class="fa-solid fa-info-circle me-1"></i>Makeup sessions require scheduling 48 hours in advance.</small>
                                </div>

                                <div class="mb-4 luxury-input-group d-flex flex-column">
                                    <label for="notes">Special Requirements / Draping Details</label>
                                    <textarea name="notes" id="notes" rows="4" class="luxury-input form-control" placeholder="Mention skin concerns, draping requirements (e.g. Gujarati style, South Indian style), or timing preferences..." style="font-size:0.8rem;"></textarea>
                                </div>

                                <button type="submit" class="btn-gold w-100 py-2">
                                    BOOK SESSION <i class="fa-solid fa-spa ms-1"></i>
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
