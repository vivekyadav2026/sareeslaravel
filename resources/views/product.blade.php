@extends('layouts.app')

@section('title', 'RANISAHAB Royal Banarasi Silk Saree — Luxury Sarees Collection')
@section('meta_description', 'Discover luxury Banarasi silk sarees, Kanjivaram sarees, Chanderi, and Organza sarees at RANISAHAB. Handcrafted with traditional gold and silver zari borders.')
@section('meta_keywords', 'banarasi saree, kanjivaram saree, chanderi silk, organza saree, pure silk sarees, handloom sarees online')

@section('content')
<div class="plp-page">

  <!-- Breadcrumb -->
  <div class="plp-breadcrumb">
    <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i></a>
    <span class="plp-bc-sep">/</span>
    <span>{{ isset($searchQuery) ? 'Search Results' : 'Collection' }}</span>
  </div>

  <!-- Page Header -->
  <div class="plp-header">
    <div class="plp-header-deco">
      <span class="plp-deco-line"></span>
      <i class="fa-solid fa-crown plp-deco-icon"></i>
      <span class="plp-deco-line"></span>
    </div>
    <h1 class="plp-page-title">{{ isset($searchQuery) ? 'SEARCH RESULTS' : 'ROYAL COLLECTION' }}</h1>
    <p class="plp-page-subtitle">{{ isset($searchQuery) ? 'Showing results for: ' . $searchQuery : 'Pure Silk, Pure Tradition, Pure You.' }}</p>
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
  <form id="filterDrawer" method="GET" action="{{ route('sarees') }}" class="plp-filter-drawer {{ (request()->has('occasions') || request()->has('types') || request()->has('price') || request()->has('sort_by')) ? 'open' : '' }}">
    <input type="hidden" name="sort_by" id="sortByInput" value="{{ request('sort_by') }}">
    
    <div class="d-flex justify-content-between align-items-center w-100 pb-2 mb-3 border-bottom border-warning border-opacity-25">
      <span class="text-gold font-display fw-bold fs-6 text-uppercase" style="letter-spacing: 0.1em; color: #c9a24b !important;"><i class="fa-solid fa-sliders me-2"></i>COUTURE FILTERS</span>
      <a href="{{ route('sarees') }}" class="small text-gold-light text-decoration-underline" style="font-size: 0.75rem;">Reset All</a>
    </div>

    <div class="row g-3 w-100 m-0">
      <div class="col-6 col-md-4 plp-filter-section">
        <p class="plp-filter-label">SAREE TYPE</p>
        <label class="plp-filter-check"><input type="checkbox" name="types[]" value="Banarasi" {{ is_array(request('types')) && in_array('Banarasi', request('types')) ? 'checked' : '' }} onchange="submitFilterForm()"> Banarasi Silk</label>
        <label class="plp-filter-check"><input type="checkbox" name="types[]" value="Kanjivaram" {{ is_array(request('types')) && in_array('Kanjivaram', request('types')) ? 'checked' : '' }} onchange="submitFilterForm()"> Kanjivaram</label>
        <label class="plp-filter-check"><input type="checkbox" name="types[]" value="Chanderi" {{ is_array(request('types')) && in_array('Chanderi', request('types')) ? 'checked' : '' }} onchange="submitFilterForm()"> Chanderi</label>
        <label class="plp-filter-check"><input type="checkbox" name="types[]" value="Organza" {{ is_array(request('types')) && in_array('Organza', request('types')) ? 'checked' : '' }} onchange="submitFilterForm()"> Organza</label>
      </div>

      <div class="col-6 col-md-4 plp-filter-section">
        <p class="plp-filter-label">OCCASION</p>
        <label class="plp-filter-check"><input type="checkbox" name="occasions[]" value="Wedding" {{ is_array(request('occasions')) && in_array('Wedding', request('occasions')) ? 'checked' : '' }} onchange="submitFilterForm()"> Wedding &amp; Festive</label>
        <label class="plp-filter-check"><input type="checkbox" name="occasions[]" value="Party" {{ is_array(request('occasions')) && in_array('Party', request('occasions')) ? 'checked' : '' }} onchange="submitFilterForm()"> Party &amp; Reception</label>
        <label class="plp-filter-check"><input type="checkbox" name="occasions[]" value="Casual" {{ is_array(request('occasions')) && in_array('Casual', request('occasions')) ? 'checked' : '' }} onchange="submitFilterForm()"> Casual Wear</label>
      </div>

      <div class="col-12 col-md-4 plp-filter-section mt-3 mt-md-0">
        <p class="plp-filter-label">PRICE RANGE</p>
        <label class="plp-filter-check"><input type="radio" name="price" value="" {{ !request('price') ? 'checked' : '' }} onchange="submitFilterForm()"> All Prices</label>
        <label class="plp-filter-check"><input type="radio" name="price" value="under_5000" {{ request('price') === 'under_5000' ? 'checked' : '' }} onchange="submitFilterForm()"> Under ₹5,000</label>
        <label class="plp-filter-check"><input type="radio" name="price" value="5000_10000" {{ request('price') === '5000_10000' ? 'checked' : '' }} onchange="submitFilterForm()"> ₹5,000 – ₹10,000</label>
        <label class="plp-filter-check"><input type="radio" name="price" value="above_10000" {{ request('price') === 'above_10000' ? 'checked' : '' }} onchange="submitFilterForm()"> ₹10,000+</label>
      </div>
    </div>
  </form>

  <!-- Product Grid -->
  <div class="row g-3 g-md-4">
    @forelse ($products as $product)
      @include('partials.product_card', ['product' => $product])
    @empty
      <div class="col-12 text-center py-5">
        <p class="text-muted font-label">No sarees found matching your criteria.</p>
      </div>
    @endforelse
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

// Load More Products Functionality
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.plp-grid .plp-card');
    const loadMoreBtn = document.querySelector('.plp-load-more-btn');
    const itemsToShow = 8;
    let currentVisible = itemsToShow;

    if (!loadMoreBtn) return;

    if (cards.length <= itemsToShow) {
        loadMoreBtn.parentElement.style.display = 'none';
    } else {
        for (let i = itemsToShow; i < cards.length; i++) {
            cards[i].classList.add('d-none');
        }
    }

    loadMoreBtn.addEventListener('click', function() {
        let shownCount = 0;
        for (let i = currentVisible; i < cards.length; i++) {
            if (shownCount < itemsToShow) {
                cards[i].classList.remove('d-none');
                shownCount++;
            }
        }
        currentVisible += shownCount;

        if (currentVisible >= cards.length) {
            loadMoreBtn.parentElement.style.display = 'none';
        }
    });

    window.addEventListener('scroll', function() {
        if (loadMoreBtn.parentElement && loadMoreBtn.parentElement.style.display !== 'none') {
            const rect = loadMoreBtn.getBoundingClientRect();
            if (rect.top <= window.innerHeight + 250) {
                loadMoreBtn.click();
            }
        }
    }, { passive: true });
});
</script>
@endpush
