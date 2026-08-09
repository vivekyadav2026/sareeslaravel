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

  <!-- Filter Drawer -->
  <form id="filterDrawer" method="GET" action="{{ route('bridal-collection') }}" class="plp-filter-drawer {{ (request()->has('occasions') || request()->has('types') || request()->has('price') || request()->has('sort_by')) ? 'open' : '' }}">
    <input type="hidden" name="sort_by" id="sortByInput" value="{{ request('sort_by') }}">
    <div class="plp-filter-section">
      <p class="plp-filter-label">BRIDAL TYPE</p>
      <label class="plp-filter-check"><input type="checkbox" name="types[]" value="Lehenga" {{ is_array(request('types')) && in_array('Lehenga', request('types')) ? 'checked' : '' }} onchange="submitFilterForm()"> Bridal Lehenga</label>
      <label class="plp-filter-check"><input type="checkbox" name="types[]" value="Saree" {{ is_array(request('types')) && in_array('Saree', request('types')) ? 'checked' : '' }} onchange="submitFilterForm()"> Bridal Saree Set</label>
      <label class="plp-filter-check"><input type="checkbox" name="types[]" value="Couture" {{ is_array(request('types')) && in_array('Couture', request('types')) ? 'checked' : '' }} onchange="submitFilterForm()"> Custom Couture</label>
    </div>
    <div class="plp-filter-section">
      <p class="plp-filter-label">WORK</p>
      <label class="plp-filter-check"><input type="checkbox" name="occasions[]" value="Kundan" {{ is_array(request('occasions')) && in_array('Kundan', request('occasions')) ? 'checked' : '' }} onchange="submitFilterForm()"> Heavy Kundan &amp; Zari</label>
      <label class="plp-filter-check"><input type="checkbox" name="occasions[]" value="Gota" {{ is_array(request('occasions')) && in_array('Gota', request('occasions')) ? 'checked' : '' }} onchange="submitFilterForm()"> Antique Gota Patti</label>
      <label class="plp-filter-check"><input type="checkbox" name="occasions[]" value="Resham" {{ is_array(request('occasions')) && in_array('Resham', request('occasions')) ? 'checked' : '' }} onchange="submitFilterForm()"> Resham Embroidery</label>
    </div>
    <div class="plp-filter-section">
      <p class="plp-filter-label">PRICE RANGE</p>
      <label class="plp-filter-check"><input type="radio" name="price" value="" {{ !request('price') ? 'checked' : '' }} onchange="submitFilterForm()"> All Prices</label>
      <label class="plp-filter-check"><input type="radio" name="price" value="under_20000" {{ request('price') === 'under_20000' ? 'checked' : '' }} onchange="submitFilterForm()"> Under ₹20,000</label>
      <label class="plp-filter-check"><input type="radio" name="price" value="20000_40000" {{ request('price') === '20000_40000' ? 'checked' : '' }} onchange="submitFilterForm()"> ₹20,000 – ₹40,000</label>
      <label class="plp-filter-check"><input type="radio" name="price" value="above_40000" {{ request('price') === 'above_40000' ? 'checked' : '' }} onchange="submitFilterForm()"> ₹40,000+</label>
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
              <img src="{{ asset('images/cat_bridal.png') }}" alt="{{ $product->name }}" class="plp-card-img">
            @endif
          </a>

          @if ($product->is_best_seller)
            <span class="plp-badge badge-best">BEST SELLER</span>
          @elseif ($product->is_new_arrival)
            <span class="plp-badge badge-new">NEW ARRIVAL</span>
          @elseif ($product->is_featured)
            <span class="plp-badge badge-excl">EXCLUSIVE</span>
          @endif
          
          <button class="plp-wishlist-btn" onclick="toggleWishlist({{ $product->id }}, this)">
            <i class="@if(Auth::check() ? \App\Models\Wishlist::where('customer_id', auth()->user()->customer->id ?? 0)->where('product_id', $product->id)->exists() : in_array($product->id, session('wishlist', []))) fa-solid text-gold @else fa-regular @endif fa-heart"></i>
          </button>
        </div>
        <div class="plp-card-body">
          <p class="plp-card-name"><a href="{{ route('product.show', $product->slug) }}" class="text-white text-decoration-none">{{ $product->name }}</a></p>
          <p class="plp-card-price">₹{{ number_format($product->price, 0) }}</p>
          <div class="plp-card-footer">
            <span class="plp-rating"><i class="fa-solid fa-star"></i> {{ $product->average_rating }} <span class="plp-rating-count">({{ $product->reviews_count }})</span></span>
            <button class="plp-cart-btn" onclick="addToBag({{ $product->id }})"><i class="fa-solid fa-bag-shopping"></i></button>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12 text-center py-5">
        <p class="text-muted">No bridal wear items found matching your criteria.</p>
      </div>
    @endforelse
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
