@extends('layouts.app')

@section('title', 'RANISAHAB ÔÇö Luxury Fashion for Every Woman | Sarees, Lehengas & Bridal Wear')

@section('content')
<!-- Hero Section -->
<section class="hero-slider-section py-4 py-lg-5">
  <div class="slider-arrow prev d-none d-lg-flex"><i class="fa-solid fa-chevron-left"></i></div>
  <div class="slider-arrow next d-none d-lg-flex"><i class="fa-solid fa-chevron-right"></i></div>
  <div class="hero-bg-overlay"></div>
  
  <div class="container position-relative">
    <div class="row align-items-center g-3 g-lg-4">
      
      <!-- Content Col -->
      <div class="col-lg-6 hero-content text-center text-lg-start">
        <p class="hero-eyebrow mb-1">Where Tradition Meets</p>
        <h1 class="hero-main-title mb-2">ROYAL ELEGANCE</h1>
        <p class="hero-sub-text mb-3">SAREES &nbsp;ÔÇó&nbsp; SUITS &nbsp;ÔÇó&nbsp; LEHENGAS &nbsp;ÔÇó&nbsp; BRIDAL</p>
        
        <div class="mb-3 mb-lg-4">
          <a href="{{ route('sarees') }}" class="btn btn-gold px-4 py-2"><i class="fa-solid fa-bag-shopping me-2"></i>EXPLORE COLLECTION</a>
        </div>
        
        <div class="hero-feature-row justify-content-center justify-content-lg-start">
          <span><i class="fa-solid fa-gem text-gold me-1"></i>100% PURE SILK</span>
          <span><i class="fa-solid fa-crown text-gold me-1"></i>EXCLUSIVE DESIGNS</span>
          <span><i class="fa-solid fa-truck-fast text-gold me-1"></i>PAN-INDIA SHIPPING</span>
        </div>
      </div>

      <!-- Image Col -->
      <div class="col-lg-6 hero-image-wrapper text-center text-lg-end mt-3 mt-lg-0">
        <div class="hero-img-box">
          <img src="{{ asset('images/hero_bride.png') }}" alt="RANISAHAB Bridal Wear" class="img-fluid hero-main-img">
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Category Section (4 Columns) -->
<section class="category-section">
  <div class="container">
    <div class="row g-3">
      <!-- Saree -->
      <div class="col-6 col-lg-3">
        <div class="cat-card-item">
          <img src="{{ asset('images/cat_saree.png') }}" alt="Sarees">
          <div class="cat-card-overlay">
            <h3>SAREES</h3>
            <span class="cat-card-price">STARTING Ôé╣1,000</span>
            <a href="{{ route('sarees') }}" class="btn btn-gold btn-sm">EXPLORE</a>
          </div>
        </div>
      </div>
      <!-- Suits -->
      <div class="col-6 col-lg-3">
        <div class="cat-card-item">
          <img src="{{ asset('images/cat_suit.png') }}" alt="Suits">
          <div class="cat-card-overlay">
            <h3>SUITS</h3>
            <span class="cat-card-price">STARTING Ôé╣1,000</span>
            <a href="{{ route('suits') }}" class="btn btn-gold btn-sm">EXPLORE</a>
          </div>
        </div>
      </div>
      <!-- Lehengas -->
      <div class="col-6 col-lg-3">
        <div class="cat-card-item">
          <img src="{{ asset('images/cat_lehenga.png') }}" alt="Lehengas">
          <div class="cat-card-overlay">
            <h3>LEHENGAS</h3>
            <span class="cat-card-price">STARTING Ôé╣1,000</span>
            <a href="{{ route('lehengas') }}" class="btn btn-gold btn-sm">EXPLORE</a>
          </div>
        </div>
      </div>
      <!-- Bridal Collection -->
      <div class="col-6 col-lg-3">
        <div class="cat-card-item">
          <img src="{{ asset('images/cat_bridal.png') }}" alt="Bridal Collection">
          <div class="cat-card-overlay">
            <h3>BRIDAL</h3>
            <span class="cat-card-price">COLLECTION</span>
            <a href="{{ route('bridal-collection') }}" class="btn btn-gold btn-sm">EXPLORE</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Our Exclusive Promise Section -->
<section class="promise-section">
  <div class="container">
    <div class="row align-items-center g-5">
      <!-- Media Left -->
      <div class="col-lg-5">
        <div class="promise-media-frame">
          <img src="{{ asset('images/promise_bride.png') }}" alt="One Design One Bride">
        </div>
      </div>
      <!-- Center Info -->
      <div class="col-lg-4">
        <p class="promise-header-eyebrow">OUR EXCLUSIVE PROMISE</p>
        <h2 class="promise-main-title">ONE DESIGN, ONE BRIDE</h2>
        <p class="promise-body-text">A custom bridal lehenga designed just for you. Once it's yours, it will never be created again for anyone else. Because you are one of a kind.</p>
        
        <div class="promise-icon-grid">
          <div>
            <div class="promise-icon-box"><i class="fa-solid fa-star"></i></div>
            <p class="promise-icon-label">100% EXCLUSIVE DESIGN</p>
          </div>
          <div>
            <div class="promise-icon-box"><i class="fa-solid fa-hand-sparkles"></i></div>
            <p class="promise-icon-label">MADE ONLY FOR YOU</p>
          </div>
          <div>
            <div class="promise-icon-box"><i class="fa-solid fa-certificate"></i></div>
            <p class="promise-icon-label">DESIGN CERTIFICATE PROVIDED</p>
          </div>
          <div>
            <div class="promise-icon-box"><i class="fa-solid fa-ban"></i></div>
            <p class="promise-icon-label">NEVER REPEATED EVER AGAIN</p>
          </div>
        </div>
      </div>
      <!-- Right Certificate Card Frame -->
      <div class="col-lg-3">
        <div class="certificate-card-frame">
          <img src="{{ asset('images/logo.png') }}" alt="RANISAHAB Logo" class="brand-logo-img logo-sm mb-2">
          <h4>EXCLUSIVE DESIGN CERTIFICATE</h4>
          <p class="mb-0">This design is specially created for you and will never be recreated for anyone else.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Bridal Packages Section -->
<section id="packages" class="packages-section">
  <div class="container">
    <div class="section-title-wrapper">
      <span class="motif">ÔØû</span>
      <h2>BRIDAL PACKAGES</h2>
    </div>

    <div class="row g-4">
      <!-- Silver Package -->
      <div class="col-md-4">
        <div class="package-card">
          <div class="package-card-media">
            <img src="{{ asset('images/pkg_silver.png') }}" alt="Silver Package">
          </div>
          <div class="package-card-body">
            <p class="package-card-title">SILVER PACKAGE</p>
            <p class="package-price-tag">Ôé╣24,999</p>
            <ul class="package-feature-list">
              <li>Bridal Lehenga</li>
              <li>Waterproof Bridal Makeup</li>
              <li>Luxury Gift Hamper</li>
              <li>Exclusive Accessories</li>
            </ul>
            <a href="{{ route('checkout') }}" class="btn btn-gold w-100">BOOK NOW</a>
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
            <p class="package-price-tag">Ôé╣39,999</p>
            <ul class="package-feature-list">
              <li>Bridal Lehenga</li>
              <li>Haldi Saree</li>
              <li>Waterproof Bridal Makeup</li>
              <li>Luxury Gift Hamper</li>
              <li>Exclusive Accessories</li>
            </ul>
            <a href="{{ route('checkout') }}" class="btn btn-gold w-100">BOOK NOW</a>
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
            <p class="package-price-tag">Ôé╣59,999</p>
            <ul class="package-feature-list">
              <li>Custom Lehenga (Your Choice)</li>
              <li>Bridal Suit</li>
              <li>Haldi Saree</li>
              <li>Waterproof Bridal Makeup</li>
              <li>Luxury Gifts &amp; Accessories</li>
              <li>Premium Bridal Experience</li>
            </ul>
            <a href="{{ route('checkout') }}" class="btn btn-gold w-100">BOOK NOW</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Trust Banner -->
<div class="trust-strip-banner">
  <div class="container">
    <div class="row g-3">
      <div class="col-6 col-md-3">
        <div class="trust-item-col">
          <i class="fa-solid fa-truck-fast"></i>
          <span>FREE SHIPPING<small>ALL OVER INDIA</small></span>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="trust-item-col">
          <i class="fa-solid fa-lock"></i>
          <span>SECURE PAYMENT<small>100% SAFE</small></span>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="trust-item-col">
          <i class="fa-solid fa-rotate-left"></i>
          <span>EASY RETURNS<small>NO QUESTIONS ASKED</small></span>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="trust-item-col">
          <i class="fa-solid fa-clock"></i>
          <span>ON TIME DELIVERY<small>5-7 DAYS DELIVERY</small></span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Real Brides & Testimonials -->
<section id="gallery" class="gallery-testimonials-section">
  <div class="container">
    <div class="row g-5">
      <!-- Gallery Left -->
      <div class="col-lg-7">
        <div class="section-title-wrapper text-start mb-4">
          <span class="motif">ÔØû</span>
          <h2 style="font-size:1.8rem;">REAL BRIDES, REAL STORIES</h2>
        </div>
        <div class="gallery-grid-6">
          <div class="gallery-thumb-item"><img src="{{ asset('images/hero_bride.png') }}" alt="Bride 1"></div>
          <div class="gallery-thumb-item"><img src="{{ asset('images/promise_bride.png') }}" alt="Bride 2"></div>
          <div class="gallery-thumb-item"><img src="{{ asset('images/cat_bridal.png') }}" alt="Bride 3"></div>
          <div class="gallery-thumb-item">
            <img src="{{ asset('images/cat_lehenga.png') }}" alt="Bride 4">
            <div class="video-play-btn"><i class="fa-solid fa-circle-play"></i></div>
          </div>
          <div class="gallery-thumb-item"><img src="{{ asset('images/pkg_royal.png') }}" alt="Bride 5"></div>
          <div class="gallery-thumb-item"><img src="{{ asset('images/cat_saree.png') }}" alt="Bride 6"></div>
        </div>
        <div class="text-center text-lg-start mt-4">
          <a href="{{ route('gallery') }}" class="btn btn-gold btn-sm">VIEW MORE GALLERY</a>
        </div>
      </div>
      <!-- Testimonials Right -->
      <div class="col-lg-5">
        <div class="section-title-wrapper text-start mb-4">
          <h2 style="font-size:1.4rem;">WHAT OUR BEAUTIFUL CLIENTS SAY</h2>
        </div>
        <div class="testimonial-card-box">
          <div class="testimonial-stars">
            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
          </div>
          <p class="testimonial-quote">"RANISAHAB made my dream wedding outfit come true! The quality, the design, everything was perfect. I felt like a queen on my big day."</p>
          <p class="testimonial-author">ÔÇö Neha Sharma</p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
