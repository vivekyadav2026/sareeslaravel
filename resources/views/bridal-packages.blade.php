@extends('layouts.app')

@section('title', 'Curated Bridal Packages — RANISAHAB Luxury')

@section('content')
<div class="plp-page">

  <!-- Breadcrumb -->
  <div class="plp-breadcrumb">
    <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i></a>
    <span class="plp-bc-sep">/</span>
    <span>Bridal Packages</span>
  </div>

  <!-- Page Header -->
  <div class="plp-header">
    <div class="plp-header-deco">
      <span class="plp-deco-line"></span>
      <i class="fa-solid fa-crown plp-deco-icon"></i>
      <span class="plp-deco-line"></span>
    </div>
    <h1 class="plp-page-title">BRIDAL PACKAGES</h1>
    <p class="plp-page-subtitle">Complete Wedding Solutions, Curated for You.</p>
  </div>

  <!-- Packages Grid -->
  <div class="bp-grid">

    <!-- Silver Package -->
    <div class="bp-card">
      <div class="bp-card-img-wrap">
        <img src="{{ asset('images/pkg_silver.png') }}" alt="Silver Bridal Package" class="bp-card-img">
        <span class="bp-tier-badge bp-silver">
          <i class="fa-solid fa-gem me-1"></i> SILVER
        </span>
      </div>
      <div class="bp-card-body">
        <div class="bp-card-header">
          <div>
            <p class="bp-card-name">Silver Bridal Package</p>
            <p class="bp-card-tagline">Perfect for an intimate celebration</p>
          </div>
          <p class="bp-card-price">₹24,999</p>
        </div>

        <ul class="bp-feature-list">
          <li><i class="fa-solid fa-check"></i> Bridal Lehenga (Designer Choice)</li>
          <li><i class="fa-solid fa-check"></i> Waterproof Bridal Makeup</li>
          <li><i class="fa-solid fa-check"></i> Luxury Gift Hamper</li>
          <li><i class="fa-solid fa-check"></i> Exclusive Accessories Set</li>
          <li><i class="fa-solid fa-xmark bp-cross"></i> Haldi Saree</li>
          <li><i class="fa-solid fa-xmark bp-cross"></i> Bridal Suit</li>
        </ul>

        <a href="{{ route('checkout') }}" class="bp-book-btn">
          BOOK PACKAGE NOW <i class="fa-solid fa-arrow-right ms-1"></i>
        </a>
        <p class="bp-whatsapp-link">
          <a href="#"><i class="fa-brands fa-whatsapp me-1"></i>Enquire on WhatsApp</a>
        </p>
      </div>
    </div>

    <!-- Gold Package -->
    <div class="bp-card bp-card-featured">
      <div class="bp-popular-badge">⭐ MOST POPULAR</div>
      <div class="bp-card-img-wrap">
        <img src="{{ asset('images/pkg_gold.png') }}" alt="Gold Bridal Package" class="bp-card-img">
        <span class="bp-tier-badge bp-gold">
          <i class="fa-solid fa-crown me-1"></i> GOLD
        </span>
      </div>
      <div class="bp-card-body">
        <div class="bp-card-header">
          <div>
            <p class="bp-card-name">Gold Bridal Package</p>
            <p class="bp-card-tagline">Most loved by our brides</p>
          </div>
          <p class="bp-card-price">₹39,999</p>
        </div>

        <ul class="bp-feature-list">
          <li><i class="fa-solid fa-check"></i> Bridal Lehenga (Designer Choice)</li>
          <li><i class="fa-solid fa-check"></i> Haldi Saree (Free)</li>
          <li><i class="fa-solid fa-check"></i> Waterproof Bridal Makeup</li>
          <li><i class="fa-solid fa-check"></i> Luxury Gift Hamper</li>
          <li><i class="fa-solid fa-check"></i> Exclusive Accessories Set</li>
          <li><i class="fa-solid fa-xmark bp-cross"></i> Custom Couture Lehenga</li>
        </ul>

        <a href="{{ route('checkout') }}" class="bp-book-btn bp-book-featured">
          BOOK PACKAGE NOW <i class="fa-solid fa-arrow-right ms-1"></i>
        </a>
        <p class="bp-whatsapp-link">
          <a href="#"><i class="fa-brands fa-whatsapp me-1"></i>Enquire on WhatsApp</a>
        </p>
      </div>
    </div>

    <!-- Royal Package -->
    <div class="bp-card">
      <div class="bp-card-img-wrap">
        <img src="{{ asset('images/pkg_royal.png') }}" alt="Royal Ranisahab Package" class="bp-card-img">
        <span class="bp-tier-badge bp-royal">
          <i class="fa-solid fa-star me-1"></i> ROYAL
        </span>
      </div>
      <div class="bp-card-body">
        <div class="bp-card-header">
          <div>
            <p class="bp-card-name">Royal RANISAHAB Package</p>
            <p class="bp-card-tagline">The ultimate bridal experience</p>
          </div>
          <p class="bp-card-price">₹59,999</p>
        </div>

        <ul class="bp-feature-list">
          <li><i class="fa-solid fa-check"></i> Custom Lehenga (Your Design)</li>
          <li><i class="fa-solid fa-check"></i> Bridal Suit Included</li>
          <li><i class="fa-solid fa-check"></i> Haldi Saree (Free)</li>
          <li><i class="fa-solid fa-check"></i> Waterproof Bridal Makeup</li>
          <li><i class="fa-solid fa-check"></i> Luxury Gifts &amp; Accessories</li>
          <li><i class="fa-solid fa-check"></i> Premium Bridal Experience</li>
        </ul>

        <a href="{{ route('checkout') }}" class="bp-book-btn">
          BOOK PACKAGE NOW <i class="fa-solid fa-arrow-right ms-1"></i>
        </a>
        <p class="bp-whatsapp-link">
          <a href="#"><i class="fa-brands fa-whatsapp me-1"></i>Enquire on WhatsApp</a>
        </p>
      </div>
    </div>

  </div>

  <!-- Reassurance Strip -->
  <div class="bp-trust-strip">
    <div class="bp-trust-item">
      <i class="fa-solid fa-shield-halved"></i>
      <span>100% Genuine Products</span>
    </div>
    <div class="bp-trust-item">
      <i class="fa-solid fa-truck-fast"></i>
      <span>Pan-India Delivery</span>
    </div>
    <div class="bp-trust-item">
      <i class="fa-solid fa-headset"></i>
      <span>Dedicated Bridal Concierge</span>
    </div>
    <div class="bp-trust-item">
      <i class="fa-solid fa-certificate"></i>
      <span>Exclusive Design Certificate</span>
    </div>
  </div>

</div>
@endsection
