@extends('layouts.app')

@section('title', 'RANISAHAB Royal Banarasi Silk Saree — Luxury Sarees Collection')

@section('content')
<div class="plp-page">

  <!-- Breadcrumb -->
  <div class="plp-breadcrumb">
    <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i></a>
    <span class="plp-bc-sep">/</span>
    <span>Sarees Collection</span>
  </div>

  <!-- Page Header -->
  <div class="plp-header">
    <div class="plp-header-deco">
      <span class="plp-deco-line"></span>
      <i class="fa-solid fa-crown plp-deco-icon"></i>
      <span class="plp-deco-line"></span>
    </div>
    <h1 class="plp-page-title">ROYAL SAREES</h1>
    <p class="plp-page-subtitle">Pure Silk, Pure Tradition, Pure You.</p>
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
      <p class="plp-filter-label">SAREE TYPE</p>
      <label class="plp-filter-check"><input type="checkbox" checked> Banarasi Silk <span>(56)</span></label>
      <label class="plp-filter-check"><input type="checkbox"> Kanjivaram <span>(34)</span></label>
      <label class="plp-filter-check"><input type="checkbox"> Chanderi <span>(22)</span></label>
      <label class="plp-filter-check"><input type="checkbox"> Organza <span>(18)</span></label>
    </div>
    <div class="plp-filter-section">
      <p class="plp-filter-label">OCCASION</p>
      <label class="plp-filter-check"><input type="checkbox" checked> Wedding &amp; Festive</label>
      <label class="plp-filter-check"><input type="checkbox"> Party &amp; Reception</label>
      <label class="plp-filter-check"><input type="checkbox"> Casual Wear</label>
    </div>
    <div class="plp-filter-section">
      <p class="plp-filter-label">PRICE RANGE</p>
      <label class="plp-filter-check"><input type="checkbox" checked> Under ₹5,000</label>
      <label class="plp-filter-check"><input type="checkbox"> ₹5,000 – ₹10,000</label>
      <label class="plp-filter-check"><input type="checkbox"> ₹10,000+</label>
    </div>
  </div>

  <!-- Product Grid -->
  <div class="plp-grid">

    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/cat_saree.png') }}" alt="Royal Banarasi Silk Saree" class="plp-card-img">
        <span class="plp-badge badge-best">BEST SELLER</span>
        <button class="plp-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Royal Banarasi Silk Saree</p>
        <p class="plp-card-price">₹3,999</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.9 <span class="plp-rating-count">(312)</span></span>
          <button class="plp-cart-btn"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/product_main.png') }}" alt="Maroon Zari Weaving Saree" class="plp-card-img">
        <span class="plp-badge badge-new">NEW ARRIVAL</span>
        <button class="plp-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Maroon Zari Weaving Saree</p>
        <p class="plp-card-price">₹4,499</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.8 <span class="plp-rating-count">(187)</span></span>
          <button class="plp-cart-btn"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/fabric_detail.png') }}" alt="Pure Katan Silk Saree" class="plp-card-img">
        <span class="plp-badge badge-excl">EXCLUSIVE</span>
        <button class="plp-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Pure Katan Silk Saree</p>
        <p class="plp-card-price">₹5,999</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.9 <span class="plp-rating-count">(143)</span></span>
          <button class="plp-cart-btn"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/hero_bride.png') }}" alt="Kanjivaram Wedding Saree" class="plp-card-img">
        <span class="plp-badge badge-best">BEST SELLER</span>
        <button class="plp-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Kanjivaram Wedding Saree</p>
        <p class="plp-card-price">₹7,499</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 5.0 <span class="plp-rating-count">(256)</span></span>
          <button class="plp-cart-btn"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/promise_bride.png') }}" alt="Organza Silk Bridal Saree" class="plp-card-img">
        <span class="plp-badge badge-new">NEW ARRIVAL</span>
        <button class="plp-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Organza Silk Bridal Saree</p>
        <p class="plp-card-price">₹6,299</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.7 <span class="plp-rating-count">(89)</span></span>
          <button class="plp-cart-btn"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/cat_bridal.png') }}" alt="Crimson Paithani Saree" class="plp-card-img">
        <button class="plp-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Crimson Paithani Saree</p>
        <p class="plp-card-price">₹8,999</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.8 <span class="plp-rating-count">(112)</span></span>
          <button class="plp-cart-btn"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/pkg_royal.png') }}" alt="Chanderi Silk Festive Saree" class="plp-card-img">
        <span class="plp-badge badge-excl">EXCLUSIVE</span>
        <button class="plp-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Chanderi Silk Festive Saree</p>
        <p class="plp-card-price">₹3,499</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.6 <span class="plp-rating-count">(74)</span></span>
          <button class="plp-cart-btn"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/pkg_gold.png') }}" alt="Gold Soft Silk Saree" class="plp-card-img">
        <span class="plp-badge badge-best">BEST SELLER</span>
        <button class="plp-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Gold Soft Silk Saree</p>
        <p class="plp-card-price">₹4,199</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.9 <span class="plp-rating-count">(198)</span></span>
          <button class="plp-cart-btn"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

  </div>

  <div class="plp-load-more">
    <button class="plp-load-more-btn">LOAD MORE SAREES <i class="fa-solid fa-chevron-down ms-2"></i></button>
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
