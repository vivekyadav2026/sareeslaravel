@extends('layouts.app')

@section('title', 'Waterproof Bridal Makeup Services — RANISAHAB Luxury')

@section('content')
<!-- Hero Section -->
<section class="bg-black text-ivory py-5">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <span class="label-title">EXPERT BRIDAL ARTISTRY</span>
        <h1 class="font-display text-gold-light display-4 mb-3">WATERPROOF BRIDAL MAKEUP</h1>
        <p class="lead text-muted mb-4">Look picture-perfect from ceremony to reception. Our senior celebrity makeup artists use 100% HD &amp; Airbrush waterproof techniques tailored for your skin.</p>
        <div class="d-flex gap-3">
          <a href="#bookingForm" class="btn btn-gold">BOOK ARTIST NOW</a>
          <a href="{{ route('contact') }}" class="btn btn-whatsapp"><i class="fa-brands fa-whatsapp fs-5 me-1"></i> INQUIRE ON WHATSAPP</a>
        </div>
      </div>
      <div class="col-lg-6">
        <img src="{{ asset('images/makeup_artist.png') }}" alt="Bridal Makeup" class="img-fluid rounded border border-warning shadow-lg">
      </div>
    </div>
  </div>
</section>

<!-- Makeup Packages Grid -->
<section class="py-5 bg-ivory">
  <div class="container">
    <div class="section-title-wrapper text-center mb-5">
      <span class="motif">❖</span>
      <h2>MAKEUP PACKAGES</h2>
    </div>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-4 text-center">
          <h4 class="font-display text-maroon mb-2">HD Bridal Makeup</h4>
          <p class="text-maroon fw-bold fs-3 mb-3">₹11,999</p>
          <ul class="list-unstyled text-muted small text-start mb-4">
            <li class="py-1"><i class="fa-solid fa-check text-gold me-2"></i>High-definition waterproof finish</li>
            <li class="py-1"><i class="fa-solid fa-check text-gold me-2"></i>Hairstyling &amp; Saree/Lehenga Draping</li>
            <li class="py-1"><i class="fa-solid fa-check text-gold me-2"></i>Premium Eyelashes &amp; Lenses</li>
          </ul>
          <a href="#bookingForm" class="btn btn-gold btn-sm">RESERVE DATE</a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-4 text-center border-warning">
          <span class="badge bg-maroon text-ivory position-absolute top-0 end-0 m-3 px-3 py-2" style="font-family:var(--font-label);font-size:0.6rem;">MOST POPULAR</span>
          <h4 class="font-display text-maroon mb-2">Airbrush Royal Makeup</h4>
          <p class="text-maroon fw-bold fs-3 mb-3">₹17,999</p>
          <ul class="list-unstyled text-muted small text-start mb-4">
            <li class="py-1"><i class="fa-solid fa-check text-gold me-2"></i>Flawless 24-Hour Airbrush Finish</li>
            <li class="py-1"><i class="fa-solid fa-check text-gold me-2"></i>Senior Celebrity Makeup Artist</li>
            <li class="py-1"><i class="fa-solid fa-check text-gold me-2"></i>Includes Pre-Bridal Skin Care Session</li>
            <li class="py-1"><i class="fa-solid fa-check text-gold me-2"></i>Hair Extensions &amp; Jewelry Setting</li>
          </ul>
          <a href="#bookingForm" class="btn btn-gold btn-sm">RESERVE DATE</a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-4 text-center">
          <h4 class="font-display text-maroon mb-2">Signature Ranisahab Package</h4>
          <p class="text-maroon fw-bold fs-3 mb-3">₹24,999</p>
          <ul class="list-unstyled text-muted small text-start mb-4">
            <li class="py-1"><i class="fa-solid fa-check text-gold me-2"></i>Full Wedding + Reception Makeup</li>
            <li class="py-1"><i class="fa-solid fa-check text-gold me-2"></i>2 Family Member Party Makeups Free</li>
            <li class="py-1"><i class="fa-solid fa-check text-gold me-2"></i>Luxury Touch-up Kit Included</li>
          </ul>
          <a href="#bookingForm" class="btn btn-gold btn-sm">RESERVE DATE</a>
        </div>
      </div>
    </div>

    <!-- Booking Form -->
    <div id="bookingForm" class="mt-5 p-4 rounded bg-white border shadow-sm mx-auto" style="max-width:700px;">
      <h4 class="font-display text-maroon text-center mb-3">BOOK YOUR BRIDAL MAKEUP ARTIST</h4>
      <form class="row g-3">
        <div class="col-md-6"><input type="text" class="form-control form-control-luxury" placeholder="Full Name"></div>
        <div class="col-md-6"><input type="tel" class="form-control form-control-luxury" placeholder="Phone Number"></div>
        <div class="col-md-6"><input type="date" class="form-control form-control-luxury"></div>
        <div class="col-md-6">
          <select class="form-select form-control-luxury">
            <option>Select Makeup Package</option>
            <option>HD Bridal Makeup (₹11,999)</option>
            <option>Airbrush Royal Makeup (₹17,999)</option>
            <option>Signature Ranisahab Package (₹24,999)</option>
          </select>
        </div>
        <div class="col-12"><textarea class="form-control form-control-luxury" rows="3" placeholder="Wedding venue location & additional details..."></textarea></div>
        <div class="col-12 text-center"><button class="btn btn-gold w-100 py-3" type="submit">SUBMIT BOOKING REQUEST</button></div>
      </form>
    </div>
  </div>
</section>
@endsection
