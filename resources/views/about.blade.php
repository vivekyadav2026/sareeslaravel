@extends('layouts.app')

@section('title', 'About Us — RANISAHAB Heritage & Craftsmanship')

@section('content')
<div class="plp-page">

  <!-- Breadcrumb -->
  <div class="plp-breadcrumb">
    <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i></a>
    <span class="plp-bc-sep">/</span>
    <span>About Us</span>
  </div>

  <!-- Story Split -->
  <div class="dark-split-hero reverse">
    <div class="dark-split-container">
      <div class="dark-split-content">
        <span class="dark-split-label text-gold"><i class="fa-solid fa-sparkles me-1"></i> NEW AGE LUXURY BRIDAL HOUSE</span>
        <h1 class="dark-split-title">REDEFINING<br>BRIDAL COUTURE<br>&amp; HANDLOOM ZARI</h1>
        <p class="dark-split-text">Welcome to RANISAHAB — a fresh luxury bridal house launched with a vision to connect modern brides directly with master handloom weavers across Varanasi, Kanchipuram, and Jaipur.</p>
        <p class="dark-split-text" style="margin-top:0.75rem;">By eliminating traditional retail markups, we deliver 100% certified pure silk sarees, handcrafted lehengas, and bespoke bridal wear straight to your doorstep with guaranteed one-design exclusivity.</p>
      </div>
      <div class="dark-split-img-wrap">
        <div class="dark-split-img">
          <img src="{{ asset('images/about_heritage.png') }}" alt="RANISAHAB Heritage Zari Craftsmanship">
        </div>
      </div>
    </div>
  </div>

  <!-- Stats Row -->
  <div class="about-stats-row">
    <div class="about-stat-item">
      <span class="about-stat-number">100%</span>
      <span class="about-stat-label">Certified Pure Silk</span>
    </div>
    <div class="about-stat-item">
      <span class="about-stat-number">500+</span>
      <span class="about-stat-label">Handcrafted Designs</span>
    </div>
    <div class="about-stat-item">
      <span class="about-stat-number">50+</span>
      <span class="about-stat-label">Master Artisans</span>
    </div>
    <div class="about-stat-item">
      <span class="about-stat-number">25,000+</span>
      <span class="about-stat-label">Pincodes Delivery</span>
    </div>
  </div>

  <!-- 4 Pillars -->
  <div class="dark-section-title">
    <span class="plp-deco-line" style="max-width:80px;"></span>
    <span class="dark-section-label">OUR PILLARS</span>
    <span class="plp-deco-line" style="max-width:80px;"></span>
  </div>

  <div class="dark-steps-grid">
    <div class="dark-step-card">
      <div class="dark-step-icon"><i class="fa-solid fa-gem"></i></div>
      <h3 class="dark-step-title">100% Pure Fabrics</h3>
      <p class="dark-step-text">Certified silk, pure velvet, and genuine gold-silver zari weaving from heritage artisans.</p>
    </div>
    <div class="dark-step-card">
      <div class="dark-step-icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
      <h3 class="dark-step-title">Honest Pricing</h3>
      <p class="dark-step-text">Direct from artisan to bride with fully transparent, honest pricing — no hidden charges.</p>
    </div>
    <div class="dark-step-card">
      <div class="dark-step-icon"><i class="fa-solid fa-crown"></i></div>
      <h3 class="dark-step-title">One Design, One Bride</h3>
      <p class="dark-step-text">Custom bridal pieces with a certified design exclusivity — your design, retired after creation.</p>
    </div>
    <div class="dark-step-card">
      <div class="dark-step-icon"><i class="fa-solid fa-truck-fast"></i></div>
      <h3 class="dark-step-title">Pan-India Delivery</h3>
      <p class="dark-step-text">Insured express luxury packaging delivered right to your doorstep across 25,000+ pincodes.</p>
    </div>
  </div>

</div>
@endsection
