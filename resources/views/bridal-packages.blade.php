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
  </div>  <!-- Packages Grid -->
  <div class="bp-grid">
    @foreach ($packages as $package)
      @php
        $isFeatured = \Illuminate\Support\Str::contains(strtolower($package->name), 'gold') || \Illuminate\Support\Str::contains(strtolower($package->name), 'silhouette');
        $tier = 'SILVER';
        $badgeClass = 'bp-silver';
        $icon = 'fa-gem';
        $image = 'images/pkg_silver.png';

        if (\Illuminate\Support\Str::contains(strtolower($package->name), 'gold') || \Illuminate\Support\Str::contains(strtolower($package->name), 'silhouette')) {
            $tier = 'GOLD';
            $badgeClass = 'bp-gold';
            $icon = 'fa-crown';
            $image = 'images/pkg_gold.png';
        } elseif (\Illuminate\Support\Str::contains(strtolower($package->name), 'royal') || \Illuminate\Support\Str::contains(strtolower($package->name), 'heritage') || \Illuminate\Support\Str::contains(strtolower($package->name), 'zardozi')) {
            $tier = 'ROYAL';
            $badgeClass = 'bp-royal';
            $icon = 'fa-star';
            $image = 'images/pkg_royal.png';
        }
      @endphp
      <div class="bp-card {{ $isFeatured ? 'bp-card-featured' : '' }}">
        @if ($isFeatured)
          <div class="bp-popular-badge">⭐ MOST POPULAR</div>
        @endif
        <div class="bp-card-img-wrap">
          <img src="{{ asset($image) }}" alt="{{ $package->name }}" class="bp-card-img">
          <span class="bp-tier-badge {{ $badgeClass }}">
            <i class="fa-solid {{ $icon }} me-1"></i> {{ $tier }}
          </span>
        </div>
        <div class="bp-card-body">
          <div class="bp-card-header">
            <div>
              <p class="bp-card-name">{{ $package->name }}</p>
              <p class="bp-card-tagline" style="font-size:0.75rem; color:rgba(255,255,255,0.65);">{{ \Illuminate\Support\Str::limit($package->description, 60) }}</p>
            </div>
            <p class="bp-card-price">₹{{ number_format($package->price, 0) }}</p>
          </div>

          <ul class="bp-feature-list">
            @if ($package->features && is_array($package->features))
              @foreach ($package->features as $feature)
                <li><i class="fa-solid fa-check"></i> {{ $feature }}</li>
              @endforeach
            @else
              <li><i class="fa-solid fa-check"></i> Luxury Bridal Lehenga</li>
              <li><i class="fa-solid fa-check"></i> Waterproof Makeup Session</li>
              <li><i class="fa-solid fa-check"></i> Designer Consultation & Fittings</li>
            @endif
          </ul>

          <form action="{{ route('cart.add-package') }}" method="POST" class="w-100 mt-2">
            @csrf
            <input type="hidden" name="package_id" value="{{ $package->id }}">
            <button type="submit" class="bp-book-btn {{ $isFeatured ? 'bp-book-featured' : '' }}">
              BOOK PACKAGE NOW <i class="fa-solid fa-arrow-right ms-1"></i>
            </button>
          </form>
          <p class="bp-whatsapp-link">
            <a href="https://wa.me/911234567890?text=I%20am%20interested%20in%20the%20{{ urlencode($package->name) }}" target="_blank">
              <i class="fa-brands fa-whatsapp me-1"></i>Enquire on WhatsApp
            </a>
          </p>
        </div>
      </div>
    @endforeach
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
