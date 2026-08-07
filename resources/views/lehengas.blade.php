@extends('layouts.app')

@section('title', 'Designer Lehengas Collection — RANISAHAB Luxury')

@section('content')

<!-- ===== DARK PRODUCT LISTING PAGE ===== -->
<div class="plp-page">

  <!-- Breadcrumb -->
  <div class="plp-breadcrumb">
    <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i></a>
    <span class="plp-bc-sep">/</span>
    <span>Lehenga Collection</span>
  </div>

  <!-- Page Header -->
  <div class="plp-header">
    <div class="plp-header-deco">
      <span class="plp-deco-line"></span>
      <i class="fa-solid fa-crown plp-deco-icon"></i>
      <span class="plp-deco-line"></span>
    </div>
    <h1 class="plp-page-title">DESIGNER LEHENGAS</h1>
    <p class="plp-page-subtitle">Timeless Elegance, Crafted for You.</p>
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

  <!-- Filter Drawer (hidden by default on mobile) -->
  <div class="plp-filter-drawer" id="filterDrawer">
    <div class="plp-filter-section">
      <p class="plp-filter-label">OCCASION</p>
      <label class="plp-filter-check"><input type="checkbox" checked> Bridal Lehenga <span>(42)</span></label>
      <label class="plp-filter-check"><input type="checkbox"> Sangeet &amp; Reception <span>(28)</span></label>
      <label class="plp-filter-check"><input type="checkbox"> Mehendi &amp; Haldi <span>(19)</span></label>
    </div>
    <div class="plp-filter-section">
      <p class="plp-filter-label">WORK TYPE</p>
      <label class="plp-filter-check"><input type="checkbox" checked> Heavy Zardozi &amp; Zari</label>
      <label class="plp-filter-check"><input type="checkbox"> Kundan &amp; Sequins</label>
      <label class="plp-filter-check"><input type="checkbox"> Gotapatti Embroidery</label>
    </div>
    <div class="plp-filter-section">
      <p class="plp-filter-label">PRICE RANGE</p>
      <label class="plp-filter-check"><input type="checkbox" checked> Under ₹15,000</label>
      <label class="plp-filter-check"><input type="checkbox"> ₹15,000 – ₹30,000</label>
      <label class="plp-filter-check"><input type="checkbox"> ₹30,000+</label>
    </div>
  </div>

  <!-- Product Grid -->
  <div class="plp-grid">

    <!-- Card 1 -->
    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/cat_lehenga.png') }}" alt="Royal Velvet Bridal Lehenga" class="plp-card-img">
        <span class="plp-badge badge-new">NEW ARRIVAL</span>
        <button class="plp-wishlist-btn" aria-label="Add to Wishlist"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Royal Velvet Bridal Lehenga</p>
        <p class="plp-card-price">₹24,999</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.9 <span class="plp-rating-count">(120)</span></span>
          <button class="plp-cart-btn" aria-label="Add to Cart"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/hero_bride.png') }}" alt="Rose Gold Zari Lehenga" class="plp-card-img">
        <span class="plp-badge badge-best">BEST SELLER</span>
        <button class="plp-wishlist-btn" aria-label="Add to Wishlist"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Rose Gold Zari Lehenga</p>
        <p class="plp-card-price">₹22,999</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.8 <span class="plp-rating-count">(98)</span></span>
          <button class="plp-cart-btn" aria-label="Add to Cart"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/promise_bride.png') }}" alt="Emerald Heritage Lehenga" class="plp-card-img">
        <span class="plp-badge badge-excl">EXCLUSIVE</span>
        <button class="plp-wishlist-btn" aria-label="Add to Wishlist"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Emerald Heritage Lehenga</p>
        <p class="plp-card-price">₹26,999</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.9 <span class="plp-rating-count">(76)</span></span>
          <button class="plp-cart-btn" aria-label="Add to Cart"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <!-- Card 4 -->
    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/cat_bridal.png') }}" alt="Red Royal Bridal Lehenga" class="plp-card-img">
        <button class="plp-wishlist-btn" aria-label="Add to Wishlist"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Red Royal Bridal Lehenga</p>
        <p class="plp-card-price">₹28,999</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.9 <span class="plp-rating-count">(134)</span></span>
          <button class="plp-cart-btn" aria-label="Add to Cart"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <!-- Card 5 -->
    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/pkg_royal.png') }}" alt="Crimson Kundan Lehenga" class="plp-card-img">
        <span class="plp-badge badge-new">NEW ARRIVAL</span>
        <button class="plp-wishlist-btn" aria-label="Add to Wishlist"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Crimson Kundan Lehenga</p>
        <p class="plp-card-price">₹19,999</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.7 <span class="plp-rating-count">(54)</span></span>
          <button class="plp-cart-btn" aria-label="Add to Cart"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <!-- Card 6 -->
    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/pkg_gold.png') }}" alt="Golden Zardozi Lehenga" class="plp-card-img">
        <span class="plp-badge badge-best">BEST SELLER</span>
        <button class="plp-wishlist-btn" aria-label="Add to Wishlist"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Golden Zardozi Lehenga</p>
        <p class="plp-card-price">₹31,999</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 5.0 <span class="plp-rating-count">(212)</span></span>
          <button class="plp-cart-btn" aria-label="Add to Cart"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <!-- Card 7 -->
    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/pkg_silver.png') }}" alt="Ivory Pearl Sangeet Lehenga" class="plp-card-img">
        <span class="plp-badge badge-excl">EXCLUSIVE</span>
        <button class="plp-wishlist-btn" aria-label="Add to Wishlist"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Ivory Pearl Sangeet Lehenga</p>
        <p class="plp-card-price">₹17,499</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.6 <span class="plp-rating-count">(43)</span></span>
          <button class="plp-cart-btn" aria-label="Add to Cart"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <!-- Card 8 -->
    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/fabric_detail.png') }}" alt="Maroon Velvet Haldi Lehenga" class="plp-card-img">
        <button class="plp-wishlist-btn" aria-label="Add to Wishlist"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Maroon Velvet Haldi Lehenga</p>
        <p class="plp-card-price">₹13,999</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.8 <span class="plp-rating-count">(88)</span></span>
          <button class="plp-cart-btn" aria-label="Add to Cart"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

  </div><!-- /.plp-grid -->

  <!-- Load More -->
  <div class="plp-load-more">
    <button class="plp-load-more-btn">LOAD MORE LEHENGAS <i class="fa-solid fa-chevron-down ms-2"></i></button>
  </div>

</div><!-- /.plp-page -->

@endsection

@push('scripts')
<script>
// Filter toggle for mobile
const filterBtn = document.getElementById('filterToggleBtn');
const filterDrawer = document.getElementById('filterDrawer');
if (filterBtn && filterDrawer) {
  filterBtn.addEventListener('click', function() {
    filterDrawer.classList.toggle('open');
  });
}

// Wishlist heart toggle
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
