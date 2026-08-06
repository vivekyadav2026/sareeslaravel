@extends('layouts.app')

@section('title', 'Designer Suits & Anarkalis — RANISAHAB Luxury')

@section('content')
<!-- Breadcrumb & Page Banner -->
<div class="bg-black-soft text-ivory py-4 border-bottom border-secondary border-opacity-25 mb-4">
  <div class="container text-center">
    <p class="small text-gold label-title mb-1">EXCLUSIVE WEAR</p>
    <h1 class="font-display text-gold-light display-5 mb-2">DESIGNER SUITS &amp; ANARKALIS</h1>
    <p class="small text-muted mb-0">Handcrafted ethnic suits, heavy embroidered Anarkalis, and Sharara sets starting at ₹1,000.</p>
  </div>
</div>

<div class="container pb-5">
  <div class="row g-4">
    <!-- Filter Sidebar Left -->
    <div class="col-lg-3">
      <div class="p-3 border rounded bg-white shadow-sm mb-4">
        <h6 class="font-display text-maroon mb-3 border-bottom pb-2" style="font-size:1.1rem;"><i class="fa-solid fa-filter me-2"></i>FILTER SUITS</h6>
        
        <!-- Category Filter -->
        <div class="mb-4">
          <p class="small fw-bold text-uppercase mb-2" style="font-family:var(--font-label);">Suit Type</p>
          <div class="form-check small text-muted"><input class="form-check-input" type="checkbox" checked id="c1"><label class="form-check-label" for="c1">Anarkali Suits (24)</label></div>
          <div class="form-check small text-muted"><input class="form-check-input" type="checkbox" id="c2"><label class="form-check-label" for="c2">Straight Cut Suits (18)</label></div>
          <div class="form-check small text-muted"><input class="form-check-input" type="checkbox" id="c3"><label class="form-check-label" for="c3">Sharara &amp; Gharara (15)</label></div>
          <div class="form-check small text-muted"><input class="form-check-input" type="checkbox" id="c4"><label class="form-check-label" for="c4">Palazzo Suits (12)</label></div>
        </div>

        <!-- Fabric Filter -->
        <div class="mb-4">
          <p class="small fw-bold text-uppercase mb-2" style="font-family:var(--font-label);">Fabric</p>
          <div class="form-check small text-muted"><input class="form-check-input" type="checkbox" checked id="f1"><label class="form-check-label" for="f1">Pure Silk &amp; Georgette</label></div>
          <div class="form-check small text-muted"><input class="form-check-input" type="checkbox" id="f2"><label class="form-check-label" for="f2">Chanderi &amp; Organza</label></div>
          <div class="form-check small text-muted"><input class="form-check-input" type="checkbox" id="f3"><label class="form-check-label" for="f3">Velvet Embroidery</label></div>
        </div>

        <!-- Price Range -->
        <div>
          <p class="small fw-bold text-uppercase mb-2" style="font-family:var(--font-label);">Price Range</p>
          <input type="range" class="form-range" min="1000" max="25000" step="500" id="priceRange">
          <div class="d-flex justify-content-between small text-muted"><span>₹1,000</span><span>₹25,000</span></div>
        </div>
      </div>
    </div>

    <!-- Product Grid Right -->
    <div class="col-lg-9">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="small text-muted mb-0">Showing <strong>1 – 6</strong> of 69 Luxury Suits</p>
        <select class="form-select form-select-sm w-auto">
          <option>Sort by: Featured</option>
          <option>Price: Low to High</option>
          <option>Price: High to Low</option>
          <option>Newest Arrivals</option>
        </select>
      </div>

      <div class="row g-4">
        <!-- Item 1 -->
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-sm">
            <img src="{{ asset('images/cat_suit.png') }}" class="card-img-top" alt="Suit 1" style="height:260px;object-fit:cover;">
            <div class="card-body p-3 text-center">
              <span class="badge bg-light text-maroon border border-maroon mb-2" style="font-size:0.6rem;">Bestseller</span>
              <h6 class="font-display mb-1">RANISAHAB Royal White Georgette Suit</h6>
              <p class="text-maroon fw-bold mb-2">₹3,499 <span class="text-muted text-decoration-line-through small">₹6,999</span></p>
              <a href="{{ route('sarees') }}" class="btn btn-gold btn-sm w-100">VIEW DETAILS</a>
            </div>
          </div>
        </div>

        <!-- Item 2 -->
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-sm">
            <img src="{{ asset('images/cat_bridal.png') }}" class="card-img-top" alt="Suit 2" style="height:260px;object-fit:cover;">
            <div class="card-body p-3 text-center">
              <span class="badge bg-light text-maroon border border-maroon mb-2" style="font-size:0.6rem;">New Arrival</span>
              <h6 class="font-display mb-1">RANISAHAB Crimson Velvet Anarkali</h6>
              <p class="text-maroon fw-bold mb-2">₹5,999 <span class="text-muted text-decoration-line-through small">₹10,999</span></p>
              <a href="{{ route('sarees') }}" class="btn btn-gold btn-sm w-100">VIEW DETAILS</a>
            </div>
          </div>
        </div>

        <!-- Item 3 -->
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-sm">
            <img src="{{ asset('images/hero_bride.png') }}" class="card-img-top" alt="Suit 3" style="height:260px;object-fit:cover;">
            <div class="card-body p-3 text-center">
              <span class="badge bg-light text-maroon border border-maroon mb-2" style="font-size:0.6rem;">Bridal Special</span>
              <h6 class="font-display mb-1">RANISAHAB Maroon Zardozi Sharara Set</h6>
              <p class="text-maroon fw-bold mb-2">₹8,499 <span class="text-muted text-decoration-line-through small">₹14,999</span></p>
              <a href="{{ route('sarees') }}" class="btn btn-gold btn-sm w-100">VIEW DETAILS</a>
            </div>
          </div>
        </div>

        <!-- Item 4 -->
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-sm">
            <img src="{{ asset('images/pkg_gold.png') }}" class="card-img-top" alt="Suit 4" style="height:260px;object-fit:cover;">
            <div class="card-body p-3 text-center">
              <span class="badge bg-light text-maroon border border-maroon mb-2" style="font-size:0.6rem;">Haldi Special</span>
              <h6 class="font-display mb-1">RANISAHAB Mustard Silk Gota Suit</h6>
              <p class="text-maroon fw-bold mb-2">₹2,999 <span class="text-muted text-decoration-line-through small">₹5,999</span></p>
              <a href="{{ route('sarees') }}" class="btn btn-gold btn-sm w-100">VIEW DETAILS</a>
            </div>
          </div>
        </div>

        <!-- Item 5 -->
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-sm">
            <img src="{{ asset('images/pkg_silver.png') }}" class="card-img-top" alt="Suit 5" style="height:260px;object-fit:cover;">
            <div class="card-body p-3 text-center">
              <span class="badge bg-light text-maroon border border-maroon mb-2" style="font-size:0.6rem;">Partywear</span>
              <h6 class="font-display mb-1">RANISAHAB Silver Mirror Work Anarkali</h6>
              <p class="text-maroon fw-bold mb-2">₹4,799 <span class="text-muted text-decoration-line-through small">₹8,999</span></p>
              <a href="{{ route('sarees') }}" class="btn btn-gold btn-sm w-100">VIEW DETAILS</a>
            </div>
          </div>
        </div>

        <!-- Item 6 -->
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-sm">
            <img src="{{ asset('images/cat_saree.png') }}" class="card-img-top" alt="Suit 6" style="height:260px;object-fit:cover;">
            <div class="card-body p-3 text-center">
              <span class="badge bg-light text-maroon border border-maroon mb-2" style="font-size:0.6rem;">Festival Wear</span>
              <h6 class="font-display mb-1">RANISAHAB Rose Silk Straight Suit</h6>
              <p class="text-maroon fw-bold mb-2">₹2,499 <span class="text-muted text-decoration-line-through small">₹4,999</span></p>
              <a href="{{ route('sarees') }}" class="btn btn-gold btn-sm w-100">VIEW DETAILS</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
