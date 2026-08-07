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
        <span class="dark-split-label">CRAFTED WITH LOVE</span>
        <h1 class="dark-split-title">PRESERVING<br>CENTURIES OF<br>ZARI ARTISTRY</h1>
        <p class="dark-split-text">Founded with a vision to make royal bridal fashion accessible without compromising quality, RANISAHAB collaborates directly with master handloom weavers in Varanasi, Jaipur, and Kanchipuram.</p>
        <p class="dark-split-text" style="margin-top:0.75rem;">Every saree, lehenga, and suit tells a story of meticulous zari weaving, pure silk fabrics, and authentic craftsmanship passed down through generations.</p>
      </div>
      <div class="dark-split-img-wrap">
        <div class="dark-split-img">
          <img src="{{ asset('images/fabric_detail.png') }}" alt="Zari Craftsmanship">
        </div>
      </div>
    </div>
  </div>

  <!-- Stats Row -->
  <div class="about-stats-row">
    <div class="about-stat-item">
      <span class="about-stat-number">10,000+</span>
      <span class="about-stat-label">Happy Brides</span>
    </div>
    <div class="about-stat-item">
      <span class="about-stat-number">300+</span>
      <span class="about-stat-label">Master Artisans</span>
    </div>
    <div class="about-stat-item">
      <span class="about-stat-number">25+</span>
      <span class="about-stat-label">Years of Heritage</span>
    </div>
    <div class="about-stat-item">
      <span class="about-stat-number">3</span>
      <span class="about-stat-label">Flagship Boutiques</span>
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
