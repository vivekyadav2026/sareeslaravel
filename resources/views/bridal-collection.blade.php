@extends('layouts.app')

@section('title', 'Royal Bridal Collection — RANISAHAB Luxury')

@section('content')
<div class="plp-page">

  <!-- Breadcrumb -->
  <div class="plp-breadcrumb">
    <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i></a>
    <span class="plp-bc-sep">/</span>
    <span>Bridal Collection</span>
  </div>

  <!-- Page Header -->
  <div class="plp-header">
    <div class="plp-header-deco">
      <span class="plp-deco-line"></span>
      <i class="fa-solid fa-crown plp-deco-icon"></i>
      <span class="plp-deco-line"></span>
    </div>
    <h1 class="plp-page-title">ROYAL BRIDAL</h1>
    <p class="plp-page-subtitle">Your Dream, Crafted for Your Day.</p>
  </div>

  <!-- Filter & Sort Bar -->
  <div class="plp-filter-bar">
    <button class="plp-filter-btn" id="filterToggleBtn">
      <i class="fa-solid fa-sliders"></i> FILTER
    </button>
    <button class="plp-filter-btn">
      <i class="fa-solid fa-arrow-up-wide-short"></i> SORT BY
    </button>
  </div>

  <!-- Filter Drawer -->
  <div class="plp-filter-drawer" id="filterDrawer">
    <div class="plp-filter-section">
      <p class="plp-filter-label">BRIDAL TYPE</p>
      <label class="plp-filter-check"><input type="checkbox" checked> Bridal Lehenga <span>(38)</span></label>
      <label class="plp-filter-check"><input type="checkbox"> Bridal Saree Set <span>(22)</span></label>
      <label class="plp-filter-check"><input type="checkbox"> Custom Couture <span>(14)</span></label>
    </div>
    <div class="plp-filter-section">
      <p class="plp-filter-label">WORK</p>
      <label class="plp-filter-check"><input type="checkbox" checked> Heavy Kundan &amp; Zari</label>
      <label class="plp-filter-check"><input type="checkbox"> Antique Gota Patti</label>
      <label class="plp-filter-check"><input type="checkbox"> Resham Embroidery</label>
    </div>
    <div class="plp-filter-section">
      <p class="plp-filter-label">PRICE RANGE</p>
      <label class="plp-filter-check"><input type="checkbox"> Under ₹20,000</label>
      <label class="plp-filter-check"><input type="checkbox" checked> ₹20,000 – ₹40,000</label>
      <label class="plp-filter-check"><input type="checkbox"> ₹40,000+</label>
    </div>
  </div>

  <!-- Product Grid -->
  <div class="plp-grid">

    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/cat_bridal.png') }}" alt="Royal Red Kundan Lehenga" class="plp-card-img">
        <span class="plp-badge badge-excl">EXCLUSIVE</span>
        <button class="plp-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Royal Red Kundan Lehenga</p>
        <p class="plp-card-price">₹28,999</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.9 <span class="plp-rating-count">(178)</span></span>
          <button class="plp-cart-btn"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/hero_bride.png') }}" alt="Maroon Royal Heritage Lehenga" class="plp-card-img">
        <span class="plp-badge badge-best">BEST SELLER</span>
        <button class="plp-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Maroon Royal Heritage Lehenga</p>
        <p class="plp-card-price">₹34,999</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 5.0 <span class="plp-rating-count">(231)</span></span>
          <button class="plp-cart-btn"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/promise_bride.png') }}" alt="Crimson Velvet Drape Lehenga" class="plp-card-img">
        <span class="plp-badge badge-new">NEW ARRIVAL</span>
        <button class="plp-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Crimson Velvet Drape Lehenga</p>
        <p class="plp-card-price">₹39,999</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.9 <span class="plp-rating-count">(94)</span></span>
          <button class="plp-cart-btn"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/pkg_royal.png') }}" alt="Rose Gold Zari Bridal Set" class="plp-card-img">
        <span class="plp-badge badge-excl">EXCLUSIVE</span>
        <button class="plp-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Rose Gold Zari Bridal Set</p>
        <p class="plp-card-price">₹44,999</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.8 <span class="plp-rating-count">(67)</span></span>
          <button class="plp-cart-btn"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/cat_lehenga.png') }}" alt="Ivory Kundan Bridal Lehenga" class="plp-card-img">
        <span class="plp-badge badge-best">BEST SELLER</span>
        <button class="plp-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Ivory Kundan Bridal Lehenga</p>
        <p class="plp-card-price">₹32,999</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.9 <span class="plp-rating-count">(119)</span></span>
          <button class="plp-cart-btn"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/pkg_gold.png') }}" alt="Golden Zardozi Reception Lehenga" class="plp-card-img">
        <span class="plp-badge badge-new">NEW ARRIVAL</span>
        <button class="plp-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Golden Zardozi Reception Lehenga</p>
        <p class="plp-card-price">₹37,999</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.8 <span class="plp-rating-count">(53)</span></span>
          <button class="plp-cart-btn"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

  </div>

  <div class="plp-load-more">
    <button class="plp-load-more-btn">LOAD MORE BRIDAL <i class="fa-solid fa-chevron-down ms-2"></i></button>
  </div>

</div>
@endsection

@push('scripts')
<script>
const filterBtn = document.getElementById('filterToggleBtn');
const filterDrawer = document.getElementById('filterDrawer');
if (filterBtn && filterDrawer) {
  filterBtn.addEventListener('click', function() { filterDrawer.classList.toggle('open'); });
}
document.querySelectorAll('.plp-wishlist-btn').forEach(btn => {
  btn.addEventListener('click', function() {
    const icon = this.querySelector('i');
    icon.classList.toggle('fa-regular');
    icon.classList.toggle('fa-solid');
    icon.classList.toggle('text-gold');
  });
});
</script>
@endpush
