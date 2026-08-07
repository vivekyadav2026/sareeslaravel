@extends('layouts.app')

@section('title', 'One Design, One Bride — Custom Lehenga Studio | RANISAHAB Luxury')

@section('content')
<div class="plp-page">

  <!-- Breadcrumb -->
  <div class="plp-breadcrumb">
    <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i></a>
    <span class="plp-bc-sep">/</span>
    <span>Custom Lehenga Studio</span>
  </div>

  <!-- Hero Split -->
  <div class="dark-split-hero">
    <div class="dark-split-container">
      <div class="dark-split-content">
        <span class="dark-split-label">BESPOKE BRIDAL COUTURE</span>
        <h1 class="dark-split-title">ONE DESIGN,<br>ONE BRIDE</h1>
        <p class="dark-split-text">Design your dream bridal outfit with RANISAHAB master couturiers. Once created for you, your design blueprint is retired and guaranteed never to be made for anyone else.</p>
        <div class="dark-split-actions">
          <a href="#customForm" class="bp-book-btn bp-book-featured" style="width:auto;padding:0.85rem 2rem;display:inline-flex;">START DESIGNING NOW</a>
          <a href="{{ route('contact') }}" class="dark-wa-btn"><i class="fa-brands fa-whatsapp"></i> WHATSAPP</a>
        </div>
      </div>
      <div class="dark-split-img-wrap">
        <div class="dark-split-img">
          <img src="{{ asset('images/custom_studio.png') }}" alt="Custom Lehenga Studio">
        </div>
      </div>
    </div>
  </div>

  <!-- How it works -->
  <div class="dark-section-title">
    <span class="plp-deco-line" style="max-width:80px;"></span>
    <span class="dark-section-label">HOW CUSTOM DESIGN WORKS</span>
    <span class="plp-deco-line" style="max-width:80px;"></span>
  </div>

  <div class="dark-steps-grid">
    <div class="dark-step-card">
      <div class="dark-step-number">01</div>
      <div class="dark-step-icon"><i class="fa-solid fa-pencil"></i></div>
      <h3 class="dark-step-title">Design Consultation</h3>
      <p class="dark-step-text">Share your vision, color preferences, and wedding theme with our lead designers.</p>
    </div>
    <div class="dark-step-card">
      <div class="dark-step-number">02</div>
      <div class="dark-step-icon"><i class="fa-solid fa-scroll"></i></div>
      <h3 class="dark-step-title">Custom Sketch &amp; Swatch</h3>
      <p class="dark-step-text">Receive high-fashion sketches and physical embroidery thread samples for approval.</p>
    </div>
    <div class="dark-step-card">
      <div class="dark-step-number">03</div>
      <div class="dark-step-icon"><i class="fa-solid fa-hands"></i></div>
      <h3 class="dark-step-title">Master Hand-Crafting</h3>
      <p class="dark-step-text">Our heritage artisans spend over 300 hours hand-embroidering your unique piece.</p>
    </div>
    <div class="dark-step-card">
      <div class="dark-step-number">04</div>
      <div class="dark-step-icon"><i class="fa-solid fa-award"></i></div>
      <h3 class="dark-step-title">Certificate &amp; Delivery</h3>
      <p class="dark-step-text">Delivered in our luxury vault box with your Exclusive Design Certificate.</p>
    </div>
  </div>

  <!-- Consultation Form -->
  <div class="dark-form-wrap" id="customForm">
    <div class="dark-form-header">
      <i class="fa-solid fa-scissors dark-form-icon"></i>
      <h3 class="dark-form-title">REQUEST CUSTOM LEHENGA CONSULTATION</h3>
      <p class="dark-form-subtitle">Tell us about your dream design and we'll connect you with our master couturiers.</p>
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
        <label class="dark-label">Email Address</label>
        <input type="email" class="dark-input" placeholder="name@example.com">
      </div>
      <div class="dark-form-group">
        <label class="dark-label">Wedding Date</label>
        <input type="date" class="dark-input">
      </div>
      <div class="dark-form-group">
        <label class="dark-label">Estimated Budget</label>
        <select class="dark-input dark-select">
          <option>Select Budget Range</option>
          <option>₹25,000 – ₹50,000</option>
          <option>₹50,000 – ₹1,00,000</option>
          <option>₹1,00,000+</option>
        </select>
      </div>
      <div class="dark-form-group">
        <label class="dark-label">Preferred Fabric</label>
        <select class="dark-input dark-select">
          <option>Select Fabric</option>
          <option>Pure Velvet</option>
          <option>Banarasi Silk</option>
          <option>Organza &amp; Net</option>
          <option>Chanderi Silk</option>
        </select>
      </div>
      <div class="dark-form-group dark-form-full">
        <label class="dark-label">Describe Your Dream Lehenga</label>
        <textarea class="dark-input dark-textarea" rows="4" placeholder="Color, embroidery work, inspiration images, special requirements..."></textarea>
      </div>
      <div class="dark-form-full">
        <button type="submit" class="bp-book-btn bp-book-featured" style="font-size:0.75rem;">SUBMIT CONSULTATION REQUEST <i class="fa-solid fa-arrow-right ms-2"></i></button>
      </div>
    </form>
  </div>

</div>
@endsection
