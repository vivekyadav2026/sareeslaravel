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
    <div class="position-relative d-inline-block">
      <select class="plp-filter-btn" id="sortSelect" onchange="applySorting(this.value)" style="appearance: none; -webkit-appearance: none; padding-right: 2.2rem; cursor: pointer; background: transparent; border: 1px solid rgba(255,255,255,0.15); color: #fff;">
        <option value="" style="background:#130f0c; color:#fff;">SORT BY</option>
        <option value="price_low_high" {{ request('sort_by') === 'price_low_high' ? 'selected' : '' }} style="background:#130f0c; color:#fff;">PRICE: LOW TO HIGH</option>
        <option value="price_high_low" {{ request('sort_by') === 'price_high_low' ? 'selected' : '' }} style="background:#130f0c; color:#fff;">PRICE: HIGH TO LOW</option>
        <option value="newest" {{ request('sort_by') === 'newest' ? 'selected' : '' }} style="background:#130f0c; color:#fff;">NEW ARRIVALS</option>
        <option value="popular" {{ request('sort_by') === 'popular' ? 'selected' : '' }} style="background:#130f0c; color:#fff;">MOST POPULAR</option>
      </select>
      <i class="fa-solid fa-chevron-down text-gold" style="position: absolute; right: 0.85rem; top: 50%; transform: translateY(-50%); pointer-events: none; font-size: 0.75rem;"></i>
    </div>
  </div>

  <!-- Filter Drawer (hidden by default on mobile) -->
  <form id="filterDrawer" method="GET" action="{{ route('lehengas') }}" class="plp-filter-drawer {{ (request()->has('occasions') || request()->has('types') || request()->has('price') || request()->has('sort_by')) ? 'open' : '' }}">
    <input type="hidden" name="sort_by" id="sortByInput" value="{{ request('sort_by') }}">
    <div class="plp-filter-section">
      <p class="plp-filter-label">OCCASION</p>
      <label class="plp-filter-check"><input type="checkbox" name="occasions[]" value="Bridal" {{ is_array(request('occasions')) && in_array('Bridal', request('occasions')) ? 'checked' : '' }} onchange="submitFilterForm()"> Bridal Lehenga</label>
      <label class="plp-filter-check"><input type="checkbox" name="occasions[]" value="Sangeet" {{ is_array(request('occasions')) && in_array('Sangeet', request('occasions')) ? 'checked' : '' }} onchange="submitFilterForm()"> Sangeet &amp; Reception</label>
      <label class="plp-filter-check"><input type="checkbox" name="occasions[]" value="Haldi" {{ is_array(request('occasions')) && in_array('Haldi', request('occasions')) ? 'checked' : '' }} onchange="submitFilterForm()"> Mehendi &amp; Haldi</label>
    </div>
    <div class="plp-filter-section">
      <p class="plp-filter-label">WORK TYPE</p>
      <label class="plp-filter-check"><input type="checkbox" name="types[]" value="Zardozi" {{ is_array(request('types')) && in_array('Zardozi', request('types')) ? 'checked' : '' }} onchange="submitFilterForm()"> Heavy Zardozi &amp; Zari</label>
      <label class="plp-filter-check"><input type="checkbox" name="types[]" value="Kundan" {{ is_array(request('types')) && in_array('Kundan', request('types')) ? 'checked' : '' }} onchange="submitFilterForm()"> Kundan &amp; Sequins</label>
      <label class="plp-filter-check"><input type="checkbox" name="types[]" value="Gotapatti" {{ is_array(request('types')) && in_array('Gotapatti', request('types')) ? 'checked' : '' }} onchange="submitFilterForm()"> Gotapatti Embroidery</label>
    </div>
    <div class="plp-filter-section">
      <p class="plp-filter-label">PRICE RANGE</p>
      <label class="plp-filter-check"><input type="radio" name="price" value="" {{ !request('price') ? 'checked' : '' }} onchange="submitFilterForm()"> All Prices</label>
      <label class="plp-filter-check"><input type="radio" name="price" value="under_15000" {{ request('price') === 'under_15000' ? 'checked' : '' }} onchange="submitFilterForm()"> Under ₹15,000</label>
      <label class="plp-filter-check"><input type="radio" name="price" value="15000_30000" {{ request('price') === '15000_30000' ? 'checked' : '' }} onchange="submitFilterForm()"> ₹15,000 – ₹30,000</label>
      <label class="plp-filter-check"><input type="radio" name="price" value="above_30000" {{ request('price') === 'above_30000' ? 'checked' : '' }} onchange="submitFilterForm()"> ₹30,000+</label>
    </div>
  </form>

  <!-- Product Grid -->
  <div class="plp-grid">
    @forelse ($products as $product)
      <div class="plp-card">
        <div class="plp-card-img-wrap">
          <a href="{{ route('product.show', $product->slug) }}">
            @if ($product->images && $product->images->isNotEmpty())
              <img src="{{ asset($product->images->first()->file_path) }}" alt="{{ $product->name }}" class="plp-card-img">
            @else
              <img src="{{ asset('images/cat_lehenga.png') }}" alt="{{ $product->name }}" class="plp-card-img">
            @endif
          </a>

          @if ($product->is_best_seller)
            <span class="plp-badge badge-best">BEST SELLER</span>
          @elseif ($product->is_new_arrival)
            <span class="plp-badge badge-new">NEW ARRIVAL</span>
          @elseif ($product->is_featured)
            <span class="plp-badge badge-excl">EXCLUSIVE</span>
          @endif
          
          <button class="plp-wishlist-btn" onclick="toggleWishlist({{ $product->id }}, this)" aria-label="Add to Wishlist">
            <i class="@if(Auth::check() ? \App\Models\Wishlist::where('customer_id', auth()->user()->customer->id ?? 0)->where('product_id', $product->id)->exists() : in_array($product->id, session('wishlist', []))) fa-solid text-gold @else fa-regular @endif fa-heart"></i>
          </button>
        </div>
        <div class="plp-card-body">
          <p class="plp-card-name"><a href="{{ route('product.show', $product->slug) }}" class="text-white text-decoration-none">{{ $product->name }}</a></p>
          <p class="plp-card-price">₹{{ number_format($product->price, 0) }}</p>
          <div class="plp-card-footer">
            <span class="plp-rating"><i class="fa-solid fa-star"></i> {{ $product->average_rating }} <span class="plp-rating-count">({{ $product->reviews_count }})</span></span>
            <button class="plp-cart-btn" onclick="addToBag({{ $product->id }})" aria-label="Add to Cart"><i class="fa-solid fa-bag-shopping"></i></button>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12 text-center py-5">
        <p class="text-muted">No lehengas found matching your criteria.</p>
      </div>
    @endforelse
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

function addToBag(productId) {
    fetch("{{ route('cart.add') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
        },
        body: JSON.stringify({ product_id: productId, quantity: 1 })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            showToast(data.message);
            const counter = document.getElementById('headerCartCount');
            if(counter) counter.innerText = data.cart_count;
        } else {
            alert(data.message);
        }
    })
    .catch(err => {
        console.error(err);
        showToast("Error adding item to bag. Please try again.");
    });
}

function toggleWishlist(productId, button) {
    fetch("{{ route('customer.wishlist.toggle') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            showToast(data.message);
            const icon = button.querySelector('i');
            if(data.action === 'added') {
                icon.classList.remove('fa-regular');
                icon.classList.add('fa-solid', 'text-gold');
            } else {
                icon.classList.remove('fa-solid', 'text-gold');
                icon.classList.add('fa-regular');
            }
        } else {
            window.location.href = "{{ route('customer.login') }}";
        }
    })
    .catch(err => {
        window.location.href = "{{ route('customer.login') }}";
    });
}

function submitFilterForm() {
    document.getElementById('filterDrawer').submit();
}

function applySorting(val) {
    document.getElementById('sortByInput').value = val;
    submitFilterForm();
}
</script>
@endpush
