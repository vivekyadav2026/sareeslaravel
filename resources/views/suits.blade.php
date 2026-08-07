@extends('layouts.app')

@section('title', 'Designer Suits & Anarkalis — RANISAHAB Luxury')

@section('content')
<div class="plp-page">

  <!-- Breadcrumb -->
  <div class="plp-breadcrumb">
    <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i></a>
    <span class="plp-bc-sep">/</span>
    <span>Suits Collection</span>
  </div>

  <!-- Page Header -->
  <div class="plp-header">
    <div class="plp-header-deco">
      <span class="plp-deco-line"></span>
      <i class="fa-solid fa-crown plp-deco-icon"></i>
      <span class="plp-deco-line"></span>
    </div>
    <h1 class="plp-page-title">DESIGNER SUITS</h1>
    <p class="plp-page-subtitle">Elegance Stitched in Every Thread.</p>
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
      <p class="plp-filter-label">SUIT TYPE</p>
      <label class="plp-filter-check"><input type="checkbox" checked> Anarkali Suits <span>(24)</span></label>
      <label class="plp-filter-check"><input type="checkbox"> Straight Cut Suits <span>(18)</span></label>
      <label class="plp-filter-check"><input type="checkbox"> Sharara &amp; Gharara <span>(15)</span></label>
      <label class="plp-filter-check"><input type="checkbox"> Palazzo Suits <span>(12)</span></label>
    </div>
    <div class="plp-filter-section">
      <p class="plp-filter-label">FABRIC</p>
      <label class="plp-filter-check"><input type="checkbox" checked> Pure Silk &amp; Georgette</label>
      <label class="plp-filter-check"><input type="checkbox"> Chanderi &amp; Organza</label>
      <label class="plp-filter-check"><input type="checkbox"> Velvet Embroidery</label>
    </div>
    <div class="plp-filter-section">
      <p class="plp-filter-label">PRICE RANGE</p>
      <label class="plp-filter-check"><input type="checkbox" checked> Under ₹5,000</label>
      <label class="plp-filter-check"><input type="checkbox"> ₹5,000 – ₹15,000</label>
      <label class="plp-filter-check"><input type="checkbox"> ₹15,000+</label>
    </div>
  </div>

  <!-- Product Grid -->
  <div class="plp-grid">

    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/cat_suit.png') }}" alt="Royal White Georgette Suit" class="plp-card-img">
        <span class="plp-badge badge-best">BEST SELLER</span>
        <button class="plp-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Royal White Georgette Suit</p>
        <p class="plp-card-price">₹3,499</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.8 <span class="plp-rating-count">(142)</span></span>
          <button class="plp-cart-btn"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/cat_bridal.png') }}" alt="Crimson Velvet Anarkali" class="plp-card-img">
        <span class="plp-badge badge-new">NEW ARRIVAL</span>
        <button class="plp-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Crimson Velvet Anarkali</p>
        <p class="plp-card-price">₹5,999</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.7 <span class="plp-rating-count">(86)</span></span>
          <button class="plp-cart-btn"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/hero_bride.png') }}" alt="Maroon Zardozi Sharara Set" class="plp-card-img">
        <span class="plp-badge badge-excl">EXCLUSIVE</span>
        <button class="plp-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Maroon Zardozi Sharara Set</p>
        <p class="plp-card-price">₹8,499</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.9 <span class="plp-rating-count">(63)</span></span>
          <button class="plp-cart-btn"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/pkg_gold.png') }}" alt="Mustard Silk Gota Suit" class="plp-card-img">
        <button class="plp-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Mustard Silk Gota Suit</p>
        <p class="plp-card-price">₹2,999</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.6 <span class="plp-rating-count">(54)</span></span>
          <button class="plp-cart-btn"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/pkg_silver.png') }}" alt="Silver Mirror Work Anarkali" class="plp-card-img">
        <span class="plp-badge badge-best">BEST SELLER</span>
        <button class="plp-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Silver Mirror Work Anarkali</p>
        <p class="plp-card-price">₹4,799</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.8 <span class="plp-rating-count">(97)</span></span>
          <button class="plp-cart-btn"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/cat_saree.png') }}" alt="Rose Silk Straight Suit" class="plp-card-img">
        <span class="plp-badge badge-new">NEW ARRIVAL</span>
        <button class="plp-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Rose Silk Straight Suit</p>
        <p class="plp-card-price">₹2,499</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.5 <span class="plp-rating-count">(38)</span></span>
          <button class="plp-cart-btn"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/promise_bride.png') }}" alt="Deep Blue Embroidered Suit" class="plp-card-img">
        <span class="plp-badge badge-excl">EXCLUSIVE</span>
        <button class="plp-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Deep Blue Embroidered Suit</p>
        <p class="plp-card-price">₹6,299</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.7 <span class="plp-rating-count">(71)</span></span>
          <button class="plp-cart-btn"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

    <div class="plp-card">
      <div class="plp-card-img-wrap">
        <img src="{{ asset('images/pkg_royal.png') }}" alt="Peach Organza Palazzo Suit" class="plp-card-img">
        <button class="plp-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
      </div>
      <div class="plp-card-body">
        <p class="plp-card-name">Peach Organza Palazzo Suit</p>
        <p class="plp-card-price">₹3,799</p>
        <div class="plp-card-footer">
          <span class="plp-rating"><i class="fa-solid fa-star"></i> 4.6 <span class="plp-rating-count">(49)</span></span>
          <button class="plp-cart-btn"><i class="fa-solid fa-bag-shopping"></i></button>
        </div>
      </div>
    </div>

  </div>

  <div class="plp-load-more">
    <button class="plp-load-more-btn">LOAD MORE SUITS <i class="fa-solid fa-chevron-down ms-2"></i></button>
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
