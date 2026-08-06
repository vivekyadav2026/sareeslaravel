@extends('layouts.app')

@section('title', 'One Design, One Bride — Custom Lehenga Studio | RANISAHAB Luxury')

@section('content')
<!-- Studio Banner -->
<section class="bg-black text-ivory py-5">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <span class="label-title">BESPOKE BRIDAL COUTURE</span>
        <h1 class="font-display text-gold-light display-4 mb-3">ONE DESIGN, ONE BRIDE</h1>
        <p class="lead text-muted mb-4">Design your dream bridal outfit with RANISAHAB master couturiers. Once created for you, your design blueprint is retired and guaranteed never to be made for anyone else.</p>
        <a href="#customForm" class="btn btn-gold">START DESIGNING NOW</a>
      </div>
      <div class="col-lg-6 text-center text-lg-end">
        <img src="{{ asset('images/custom_studio.png') }}" alt="Custom Lehenga Studio" class="img-fluid rounded border border-warning shadow-lg">
      </div>
    </div>
  </div>
</section>

<!-- Custom Design Process -->
<section class="py-5 bg-ivory">
  <div class="container">
    <div class="section-title-wrapper text-center mb-5">
      <span class="motif">❖</span>
      <h2>HOW CUSTOM DESIGN WORKS</h2>
    </div>

    <div class="row g-4 text-center">
      <div class="col-md-3">
        <div class="p-4 border rounded bg-white h-100 shadow-sm">
          <div class="text-gold fs-1 mb-2"><i class="fa-solid fa-pencil-ruler"></i></div>
          <h5 class="font-display text-maroon">1. Design Consultation</h5>
          <p class="small text-muted mb-0">Share your vision, color preferences, and wedding theme with our lead designers.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="p-4 border rounded bg-white h-100 shadow-sm">
          <div class="text-gold fs-1 mb-2"><i class="fa-solid fa-scroll"></i></div>
          <h5 class="font-display text-maroon">2. Custom Sketch &amp; Swatch</h5>
          <p class="small text-muted mb-0">Receive high-fashion sketches and physical embroidery thread samples.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="p-4 border rounded bg-white h-100 shadow-sm">
          <div class="text-gold fs-1 mb-2"><i class="fa-solid fa-hands-holding-circle"></i></div>
          <h5 class="font-display text-maroon">3. Master Hand-Crafting</h5>
          <p class="small text-muted mb-0">Our heritage artisans spend over 300 hours hand-embroidering your piece.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="p-4 border rounded bg-white h-100 shadow-sm">
          <div class="text-gold fs-1 mb-2"><i class="fa-solid fa-award"></i></div>
          <h5 class="font-display text-maroon">4. Certificate &amp; Delivery</h5>
          <p class="small text-muted mb-0">Delivered in our luxury vault box with your Exclusive Design Certificate.</p>
        </div>
      </div>
    </div>

    <!-- Inquiry Form -->
    <div id="customForm" class="mt-5 p-4 rounded bg-white border shadow-sm mx-auto" style="max-width:720px;">
      <h4 class="font-display text-maroon text-center mb-3">REQUEST CUSTOM LEHENGA CONSULTATION</h4>
      <form class="row g-3">
        <div class="col-md-6"><input type="text" class="form-control form-control-luxury" placeholder="Full Name"></div>
        <div class="col-md-6"><input type="tel" class="form-control form-control-luxury" placeholder="Phone Number"></div>
        <div class="col-md-6"><input type="email" class="form-control form-control-luxury" placeholder="Email Address"></div>
        <div class="col-md-6"><input type="date" class="form-control form-control-luxury" placeholder="Wedding Date"></div>
        <div class="col-md-6">
          <select class="form-select form-control-luxury">
            <option>Estimated Budget Range</option>
            <option>₹25,000 – ₹50,000</option>
            <option>₹50,000 – ₹1,000,000</option>
            <option>₹1,00,000+</option>
          </select>
        </div>
        <div class="col-md-6">
          <select class="form-select form-control-luxury">
            <option>Preferred Fabric</option>
            <option>Pure Velvet</option>
            <option>Banarasi Silk</option>
            <option>Organza &amp; Net</option>
          </select>
        </div>
        <div class="col-12"><textarea class="form-control form-control-luxury" rows="3" placeholder="Describe your dream lehenga color, embroidery work, or inspiration ideas..."></textarea></div>
        <div class="col-12 text-center"><button class="btn btn-gold w-100 py-3" type="submit">SUBMIT CONSULTATION REQUEST</button></div>
      </form>
    </div>
  </div>
</section>
@endsection
