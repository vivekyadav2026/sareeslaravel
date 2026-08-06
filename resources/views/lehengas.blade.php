@extends('layouts.app')

@section('title', 'Exclusive Lehengas Collection — RANISAHAB Luxury')

@section('content')
<!-- Breadcrumb & Page Banner -->
<div class="bg-black-soft text-ivory py-4 border-bottom border-secondary border-opacity-25 mb-4">
  <div class="container text-center">
    <p class="small text-gold label-title mb-1">ROYAL BRIDAL &amp; FESTIVE</p>
    <h1 class="font-display text-gold-light display-5 mb-2">EXCLUSIVE LEHENGAS COLLECTION</h1>
    <p class="small text-muted mb-0">Handcrafted bridal velvet lehengas, silk sangeet lehengas, and designer couture pieces starting at ₹1,000.</p>
  </div>
</div>

<div class="container pb-5">
  <div class="row g-4">
    <!-- Filter Sidebar Left -->
    <div class="col-lg-3">
      <div class="p-3 border rounded bg-white shadow-sm mb-4">
        <h6 class="font-display text-maroon mb-3 border-bottom pb-2" style="font-size:1.1rem;"><i class="fa-solid fa-filter me-2"></i>FILTER LEHENGAS</h6>
        
        <div class="mb-4">
          <p class="small fw-bold text-uppercase mb-2" style="font-family:var(--font-label);">Occasion</p>
          <div class="form-check small text-muted"><input class="form-check-input" type="checkbox" checked id="o1"><label class="form-check-label" for="o1">Bridal Lehenga (42)</label></div>
          <div class="form-check small text-muted"><input class="form-check-input" type="checkbox" id="o2"><label class="form-check-label" for="o2">Sangeet &amp; Reception (28)</label></div>
          <div class="form-check small text-muted"><input class="form-check-input" type="checkbox" id="o3"><label class="form-check-label" for="o3">Mehendi &amp; Haldi (19)</label></div>
        </div>

        <div class="mb-4">
          <p class="small fw-bold text-uppercase mb-2" style="font-family:var(--font-label);">Work Type</p>
          <div class="form-check small text-muted"><input class="form-check-input" type="checkbox" checked id="w1"><label class="form-check-label" for="w1">Heavy Zardozi &amp; Zari</label></div>
          <div class="form-check small text-muted"><input class="form-check-input" type="checkbox" id="w2"><label class="form-check-label" for="w2">Kundan &amp; Sequins</label></div>
          <div class="form-check small text-muted"><input class="form-check-input" type="checkbox" id="w3"><label class="form-check-label" for="w3">Gotapatti Embroidery</label></div>
        </div>
      </div>
    </div>

    <!-- Product Grid Right -->
    <div class="col-lg-9">
      <div class="row g-4">
        <!-- Item 1 -->
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-sm">
            <img src="{{ asset('images/cat_lehenga.png') }}" class="card-img-top" alt="Lehenga 1" style="height:280px;object-fit:cover;">
            <div class="card-body p-3 text-center">
              <span class="badge bg-maroon text-ivory mb-2" style="font-size:0.6rem;">Royal Bridal</span>
              <h6 class="font-display mb-1">RANISAHAB Crimson Velvet Bridal Lehenga</h6>
              <p class="text-maroon fw-bold mb-2">₹18,999 <span class="text-muted text-decoration-line-through small">₹35,000</span></p>
              <a href="{{ route('sarees') }}" class="btn btn-gold btn-sm w-100">VIEW DETAILS</a>
            </div>
          </div>
        </div>

        <!-- Item 2 -->
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-sm">
            <img src="{{ asset('images/hero_bride.png') }}" class="card-img-top" alt="Lehenga 2" style="height:280px;object-fit:cover;">
            <div class="card-body p-3 text-center">
              <span class="badge bg-maroon text-ivory mb-2" style="font-size:0.6rem;">One Design One Bride</span>
              <h6 class="font-display mb-1">RANISAHAB Custom Royal Heritage Lehenga</h6>
              <p class="text-maroon fw-bold mb-2">₹24,999 <span class="text-muted text-decoration-line-through small">₹45,000</span></p>
              <a href="{{ route('sarees') }}" class="btn btn-gold btn-sm w-100">VIEW DETAILS</a>
            </div>
          </div>
        </div>

        <!-- Item 3 -->
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-sm">
            <img src="{{ asset('images/pkg_gold.png') }}" class="card-img-top" alt="Lehenga 3" style="height:280px;object-fit:cover;">
            <div class="card-body p-3 text-center">
              <span class="badge bg-warning text-dark mb-2" style="font-size:0.6rem;">Haldi Special</span>
              <h6 class="font-display mb-1">RANISAHAB Mustard Yellow Haldi Lehenga</h6>
              <p class="text-maroon fw-bold mb-2">₹7,999 <span class="text-muted text-decoration-line-through small">₹14,999</span></p>
              <a href="{{ route('sarees') }}" class="btn btn-gold btn-sm w-100">VIEW DETAILS</a>
            </div>
          </div>
        </div>

        <!-- Item 4 -->
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-sm">
            <img src="{{ asset('images/pkg_silver.png') }}" class="card-img-top" alt="Lehenga 4" style="height:280px;object-fit:cover;">
            <div class="card-body p-3 text-center">
              <span class="badge bg-secondary text-white mb-2" style="font-size:0.6rem;">Reception Special</span>
              <h6 class="font-display mb-1">RANISAHAB Silver Sequined Reception Lehenga</h6>
              <p class="text-maroon fw-bold mb-2">₹12,499 <span class="text-muted text-decoration-line-through small">₹22,000</span></p>
              <a href="{{ route('sarees') }}" class="btn btn-gold btn-sm w-100">VIEW DETAILS</a>
            </div>
          </div>
        </div>

        <!-- Item 5 -->
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-sm">
            <img src="{{ asset('images/promise_bride.png') }}" class="card-img-top" alt="Lehenga 5" style="height:280px;object-fit:cover;">
            <div class="card-body p-3 text-center">
              <span class="badge bg-maroon text-ivory mb-2" style="font-size:0.6rem;">Exclusive Design</span>
              <h6 class="font-display mb-1">RANISAHAB Velvet Zari Ball Lehenga</h6>
              <p class="text-maroon fw-bold mb-2">₹21,999 <span class="text-muted text-decoration-line-through small">₹39,000</span></p>
              <a href="{{ route('sarees') }}" class="btn btn-gold btn-sm w-100">VIEW DETAILS</a>
            </div>
          </div>
        </div>

        <!-- Item 6 -->
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-sm">
            <img src="{{ asset('images/cat_bridal.png') }}" class="card-img-top" alt="Lehenga 6" style="height:280px;object-fit:cover;">
            <div class="card-body p-3 text-center">
              <span class="badge bg-danger text-white mb-2" style="font-size:0.6rem;">Traditional Red</span>
              <h6 class="font-display mb-1">RANISAHAB Royal Red Kundan Bridal Lehenga</h6>
              <p class="text-maroon fw-bold mb-2">₹16,999 <span class="text-muted text-decoration-line-through small">₹30,000</span></p>
              <a href="{{ route('sarees') }}" class="btn btn-gold btn-sm w-100">VIEW DETAILS</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
