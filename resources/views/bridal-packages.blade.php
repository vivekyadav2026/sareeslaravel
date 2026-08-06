@extends('layouts.app')

@section('title', 'Bridal Packages — RANISAHAB Luxury')

@section('content')
<!-- Header Banner -->
<div class="bg-black text-ivory py-5">
  <div class="container text-center">
    <span class="motif text-gold">❖</span>
    <h1 class="font-display text-gold-light display-4 mb-2">CURATED BRIDAL PACKAGES</h1>
    <p class="lead text-muted mx-auto" style="max-width:650px;">Complete wedding solutions including bridal outfit, haldi saree, waterproof makeup, gift hamper, and accessories.</p>
  </div>
</div>

<section class="packages-section py-5">
  <div class="container">
    <div class="row g-4">
      <!-- Silver Package -->
      <div class="col-md-4">
        <div class="package-card">
          <div class="package-card-media">
            <img src="{{ asset('images/pkg_silver.png') }}" alt="Silver Package">
          </div>
          <div class="package-card-body">
            <p class="package-card-title">SILVER PACKAGE</p>
            <p class="package-price-tag">₹24,999</p>
            <ul class="package-feature-list">
              <li>Bridal Lehenga</li>
              <li>Waterproof Bridal Makeup</li>
              <li>Luxury Gift Hamper</li>
              <li>Exclusive Accessories</li>
            </ul>
            <a href="{{ route('checkout') }}" class="btn btn-gold w-100">BOOK PACKAGE NOW</a>
          </div>
        </div>
      </div>

      <!-- Gold Package -->
      <div class="col-md-4">
        <div class="package-card">
          <div class="package-card-media">
            <img src="{{ asset('images/pkg_gold.png') }}" alt="Gold Package">
          </div>
          <div class="package-card-body">
            <p class="package-card-title">GOLD PACKAGE</p>
            <p class="package-price-tag">₹39,999</p>
            <ul class="package-feature-list">
              <li>Bridal Lehenga</li>
              <li>Haldi Saree</li>
              <li>Waterproof Bridal Makeup</li>
              <li>Luxury Gift Hamper</li>
              <li>Exclusive Accessories</li>
            </ul>
            <a href="{{ route('checkout') }}" class="btn btn-gold w-100">BOOK PACKAGE NOW</a>
          </div>
        </div>
      </div>

      <!-- Royal Package -->
      <div class="col-md-4">
        <div class="package-card">
          <div class="package-card-media">
            <img src="{{ asset('images/pkg_royal.png') }}" alt="Royal Ranisahab Package">
          </div>
          <div class="package-card-body">
            <p class="package-card-title">ROYAL RANISAHAB PACKAGE</p>
            <p class="package-price-tag">₹59,999</p>
            <ul class="package-feature-list">
              <li>Custom Lehenga (Your Choice)</li>
              <li>Bridal Suit</li>
              <li>Haldi Saree</li>
              <li>Waterproof Bridal Makeup</li>
              <li>Luxury Gifts &amp; Accessories</li>
              <li>Premium Bridal Experience</li>
            </ul>
            <a href="{{ route('checkout') }}" class="btn btn-gold w-100">BOOK PACKAGE NOW</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
