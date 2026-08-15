@extends('layouts.app')

@section('title', 'Waterproof Bridal Makeup Services — RANISAHAB Luxury')
@section('meta_description', 'Book high-definition airbrush and waterproof bridal makeup services by senior celebrity artists at RANISAHAB. Perfect draping, styling, and premium lenses.')
@section('meta_keywords', 'bridal makeup, waterproof makeup, airbrush makeup, HD makeup artist, wedding draping, hairstyle booking')

@section('content')
<div class="plp-page">

  <!-- Breadcrumb -->
  <div class="plp-breadcrumb">
    <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i></a>
    <span class="plp-bc-sep">/</span>
    <span>Makeup Services</span>
  </div>

  <!-- Hero split -->
  <div class="dark-split-hero">
    <div class="dark-split-container">
      <div class="dark-split-content">
        <span class="dark-split-label">EXPERT BRIDAL ARTISTRY</span>
        <h1 class="dark-split-title">WATERPROOF<br>BRIDAL MAKEUP</h1>
        <p class="dark-split-text">Look picture-perfect from ceremony to reception. Our senior celebrity makeup artists use 100% HD &amp; Airbrush waterproof techniques tailored for your skin tone and wedding theme.</p>
        <div class="dark-split-actions">
          <a href="#bookingForm" class="bp-book-btn bp-book-featured" style="width:auto;padding:0.85rem 2rem;display:inline-flex;">BOOK ARTIST NOW</a>
          <a href="{{ route('contact') }}" class="dark-wa-btn"><i class="fa-brands fa-whatsapp"></i> WHATSAPP</a>
        </div>
      </div>
      <div class="dark-split-img-wrap">
        <div class="dark-split-img">
          <img src="{{ asset('images/makeup_artist.png') }}" alt="Bridal Makeup Artist">
        </div>
      </div>
    </div>
  </div>

  <!-- Makeup Packages -->
  <div class="dark-section-title">
    <span class="plp-deco-line" style="max-width:80px;"></span>
    <span class="dark-section-label">MAKEUP PACKAGES</span>
    <span class="plp-deco-line" style="max-width:80px;"></span>
  </div>

  <div class="bp-grid makeup-pkg-grid">
    @forelse($services as $index => $service)
      <div class="bp-card {{ $service->is_popular ? 'bp-card-featured' : '' }}">
        @if($service->is_popular)
          <div class="bp-popular-badge">⭐ MOST POPULAR</div>
        @endif
        <div class="bp-card-body" style="padding-top:1.5rem;">
          <div class="dark-pkg-icon {{ $service->is_popular ? 'dark-pkg-icon-gold' : ($index % 2 === 0 ? '' : 'dark-pkg-icon-purple') }}">
            <i class="fa-solid {{ $service->is_popular ? 'fa-crown' : ($index % 2 === 0 ? 'fa-star' : 'fa-gem') }}"></i>
          </div>
          <div class="bp-card-header">
            <div>
              <p class="bp-card-name">{{ $service->name }}</p>
              <p class="bp-card-tagline">{{ $service->description ?? 'Expert Bridal Artistry Package' }}</p>
            </div>
            <p class="bp-card-price">₹{{ number_format($service->price, 0) }}</p>
          </div>
          <ul class="bp-feature-list">
            @if($service->features)
              @foreach(explode("\n", $service->features) as $feat)
                @if(trim($feat))
                  <li><i class="fa-solid fa-check text-gold me-2"></i> {{ trim($feat) }}</li>
                @endif
              @endforeach
            @else
              <li><i class="fa-solid fa-check text-gold me-2"></i> High-definition 100% waterproof finish</li>
              <li><i class="fa-solid fa-check text-gold me-2"></i> Professional Hairstyling &amp; Draping</li>
              <li><i class="fa-solid fa-check text-gold me-2"></i> Premium Eyelashes &amp; Contact Lenses</li>
              <li><i class="fa-solid fa-clock text-gold me-2"></i> {{ $service->duration_minutes }} Mins Dedicated Artist Session</li>
            @endif
          </ul>
          <a href="#bookingForm" onclick="selectMakeupPackage('{{ $service->name }} (₹{{ number_format($service->price, 0) }})')" class="bp-book-btn {{ $service->is_popular ? 'bp-book-featured' : '' }}">RESERVE DATE <i class="fa-solid fa-arrow-right ms-1"></i></a>
        </div>
      </div>
    @empty
      <div class="col-12 text-center py-5 text-muted">
        <p class="font-label">No makeup packages registered at the moment. Please contact us via WhatsApp for custom bookings.</p>
      </div>
    @endforelse
  </div>

  <!-- Booking Form -->
  <div class="dark-form-wrap" id="bookingForm">
    <div class="dark-form-header">
      <i class="fa-solid fa-calendar-check dark-form-icon"></i>
      <h3 class="dark-form-title">BOOK YOUR BRIDAL MAKEUP ARTIST</h3>
      <p class="dark-form-subtitle">Fill in your details and we'll confirm your appointment within 24 hours.</p>
    </div>

    @if (session('success'))
      <div class="alert alert-success mx-4 my-2" style="background: rgba(40, 167, 69, 0.1); border: 1px solid var(--gold); color: #fff;">
        <i class="fa-solid fa-circle-check text-gold me-2"></i> {{ session('success') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger mx-4 my-2" style="background: rgba(220, 53, 69, 0.1); border: 1px solid red; color: #fff;">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('makeup-services.submit') }}" method="POST" class="dark-form-grid">
      @csrf

      @guest
        <input type="hidden" name="is_guest" value="1">
        <div class="dark-form-group">
          <label class="dark-label">Full Name <span class="text-danger">*</span></label>
          <input type="text" name="guest_name" class="dark-input" placeholder="e.g. Priya Sharma" required value="{{ old('guest_name') }}">
        </div>
        <div class="dark-form-group">
          <label class="dark-label">Phone Number <span class="text-danger">*</span></label>
          <input type="tel" name="guest_phone" class="dark-input" placeholder="+91 98765 43210" required value="{{ old('guest_phone') }}">
        </div>
        <div class="dark-form-group">
          <label class="dark-label">Email Address <span class="text-danger">*</span></label>
          <input type="email" name="guest_email" class="dark-input" placeholder="name@example.com" required value="{{ old('guest_email') }}">
        </div>
      @else
        <input type="hidden" name="is_guest" value="0">
      @endguest

      <div class="dark-form-group">
        <label class="dark-label">Wedding Date <span class="text-danger">*</span></label>
        <input type="date" name="booking_date" class="dark-input" required value="{{ old('booking_date') }}">
      </div>
      
      <div class="dark-form-group">
        <label class="dark-label">Select Package <span class="text-danger">*</span></label>
        <select name="makeup_package" id="makeup_package_select" class="dark-input dark-select" required>
          @foreach($services as $service)
            <option value="{{ $service->name }} (₹{{ number_format($service->price, 0) }})">{{ $service->name }} (₹{{ number_format($service->price, 0) }})</option>
          @endforeach
        </select>
      </div>

      <div class="dark-form-group dark-form-full">
        <label class="dark-label">Wedding Venue &amp; Additional Details</label>
        <textarea name="notes" class="dark-input dark-textarea" rows="3" placeholder="Venue location, city, timing, look preference...">{{ old('notes') }}</textarea>
      </div>
      
      <div class="dark-form-full">
        <button type="submit" class="bp-book-btn bp-book-featured" style="font-size:0.75rem;">SUBMIT BOOKING REQUEST <i class="fa-solid fa-arrow-right ms-2"></i></button>
      </div>
    </form>
  </div>

</div>
@endsection

@push('scripts')
<script>
  function selectMakeupPackage(val) {
      const select = document.getElementById('makeup_package_select');
      if (select) {
          select.value = val;
      }
  }
</script>
@endpush
