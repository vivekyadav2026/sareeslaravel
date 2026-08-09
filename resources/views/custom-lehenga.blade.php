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

    <form action="{{ route('custom-lehenga.submit') }}" method="POST" enctype="multipart/form-data" class="dark-form-grid">
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
        <label class="dark-label">Preferred Fabric</label>
        <select name="fabric_preference" class="dark-input dark-select">
          <option value="">Select Fabric</option>
          <option>Pure Velvet</option>
          <option>Banarasi Silk</option>
          <option>Organza &amp; Net</option>
          <option>Chanderi Silk</option>
        </select>
      </div>

      <div class="dark-form-group">
        <label class="dark-label">Estimated Budget</label>
        <select name="budget_range" class="dark-input dark-select">
          <option value="">Select Budget Range</option>
          <option>₹25,000 – ₹50,000</option>
          <option>₹50,000 – ₹1,00,000</option>
          <option>₹1,00,000+</option>
        </select>
      </div>

      <div class="dark-form-group">
        <label class="dark-label">Upload Inspiration Sketch / Image</label>
        <input type="file" name="design_image" class="dark-input">
      </div>

      <div class="dark-form-group dark-form-full">
        <label class="dark-label">Describe Your Dream Lehenga <span class="text-danger">*</span></label>
        <textarea name="design_details" class="dark-input dark-textarea" rows="4" placeholder="Color, embroidery work, inspiration details, special sizing requirements..." required>{{ old('design_details') }}</textarea>
      </div>

      <div class="dark-form-full">
        <button type="submit" class="bp-book-btn bp-book-featured" style="font-size:0.75rem;">SUBMIT CONSULTATION REQUEST <i class="fa-solid fa-arrow-right ms-2"></i></button>
      </div>
    </form>
  </div>

</div>
@endsection
