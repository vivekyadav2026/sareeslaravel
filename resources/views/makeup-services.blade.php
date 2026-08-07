@extends('layouts.app')

@section('title', 'Waterproof Bridal Makeup Services — RANISAHAB Luxury')

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

    <!-- HD Bridal -->
    <div class="bp-card">
      <div class="bp-card-body" style="padding-top:1.5rem;">
        <div class="dark-pkg-icon"><i class="fa-solid fa-star"></i></div>
        <div class="bp-card-header">
          <div>
            <p class="bp-card-name">HD Bridal Makeup</p>
            <p class="bp-card-tagline">Flawless high-definition finish</p>
          </div>
          <p class="bp-card-price">₹11,999</p>
        </div>
        <ul class="bp-feature-list">
          <li><i class="fa-solid fa-check"></i> High-definition waterproof finish</li>
          <li><i class="fa-solid fa-check"></i> Hairstyling &amp; Saree/Lehenga Draping</li>
          <li><i class="fa-solid fa-check"></i> Premium Eyelashes &amp; Lenses</li>
          <li><i class="fa-solid fa-xmark bp-cross"></i> Pre-Bridal Skin Session</li>
          <li><i class="fa-solid fa-xmark bp-cross"></i> Reception Makeup</li>
        </ul>
        <a href="#bookingForm" class="bp-book-btn">RESERVE DATE <i class="fa-solid fa-arrow-right ms-1"></i></a>
      </div>
    </div>

    <!-- Airbrush Royal -->
    <div class="bp-card bp-card-featured">
      <div class="bp-popular-badge">⭐ MOST POPULAR</div>
      <div class="bp-card-body" style="padding-top:1.5rem;">
        <div class="dark-pkg-icon dark-pkg-icon-gold"><i class="fa-solid fa-crown"></i></div>
        <div class="bp-card-header">
          <div>
            <p class="bp-card-name">Airbrush Royal Makeup</p>
            <p class="bp-card-tagline">24-hour flawless airbrush finish</p>
          </div>
          <p class="bp-card-price">₹17,999</p>
        </div>
        <ul class="bp-feature-list">
          <li><i class="fa-solid fa-check"></i> Flawless 24-Hour Airbrush Finish</li>
          <li><i class="fa-solid fa-check"></i> Senior Celebrity Makeup Artist</li>
          <li><i class="fa-solid fa-check"></i> Pre-Bridal Skin Care Session</li>
          <li><i class="fa-solid fa-check"></i> Hair Extensions &amp; Jewelry Setting</li>
          <li><i class="fa-solid fa-xmark bp-cross"></i> Reception Makeup</li>
        </ul>
        <a href="#bookingForm" class="bp-book-btn bp-book-featured">RESERVE DATE <i class="fa-solid fa-arrow-right ms-1"></i></a>
      </div>
    </div>

    <!-- Signature Package -->
    <div class="bp-card">
      <div class="bp-card-body" style="padding-top:1.5rem;">
        <div class="dark-pkg-icon dark-pkg-icon-purple"><i class="fa-solid fa-gem"></i></div>
        <div class="bp-card-header">
          <div>
            <p class="bp-card-name">Signature RANISAHAB</p>
            <p class="bp-card-tagline">Full wedding &amp; reception coverage</p>
          </div>
          <p class="bp-card-price">₹24,999</p>
        </div>
        <ul class="bp-feature-list">
          <li><i class="fa-solid fa-check"></i> Full Wedding + Reception Makeup</li>
          <li><i class="fa-solid fa-check"></i> 2 Family Member Party Makeups Free</li>
          <li><i class="fa-solid fa-check"></i> Luxury Touch-up Kit Included</li>
          <li><i class="fa-solid fa-check"></i> Premium Skin Care Pre-Session</li>
          <li><i class="fa-solid fa-check"></i> Celebrity Artist Assigned</li>
        </ul>
        <a href="#bookingForm" class="bp-book-btn">RESERVE DATE <i class="fa-solid fa-arrow-right ms-1"></i></a>
      </div>
    </div>

  </div>

  <!-- Booking Form -->
  <div class="dark-form-wrap" id="bookingForm">
    <div class="dark-form-header">
      <i class="fa-solid fa-calendar-check dark-form-icon"></i>
      <h3 class="dark-form-title">BOOK YOUR BRIDAL MAKEUP ARTIST</h3>
      <p class="dark-form-subtitle">Fill in your details and we'll confirm your appointment within 24 hours.</p>
    </div>
    <form class="dark-form-grid">
      <div class="dark-form-group">
        <label class="dark-label">Full Name</label>
        <input type="text" class="dark-input" placeholder="e.g. Priya Sharma">
      </div>
      <div class="dark-form-group">
        <label class="dark-label">Phone Number</label>
        <input type="tel" class="dark-input" placeholder="+91 98765 43210">
      </div>
      <div class="dark-form-group">
        <label class="dark-label">Wedding Date</label>
        <input type="date" class="dark-input">
      </div>
      <div class="dark-form-group">
        <label class="dark-label">Select Package</label>
        <select class="dark-input dark-select">
          <option>HD Bridal Makeup (₹11,999)</option>
          <option>Airbrush Royal Makeup (₹17,999)</option>
          <option>Signature RANISAHAB (₹24,999)</option>
        </select>
      </div>
      <div class="dark-form-group dark-form-full">
        <label class="dark-label">Wedding Venue &amp; Additional Details</label>
        <textarea class="dark-input dark-textarea" rows="3" placeholder="Venue location, city, timing..."></textarea>
      </div>
      <div class="dark-form-full">
        <button type="submit" class="bp-book-btn bp-book-featured" style="font-size:0.75rem;">SUBMIT BOOKING REQUEST <i class="fa-solid fa-arrow-right ms-2"></i></button>
      </div>
    </form>
  </div>

</div>
@endsection
