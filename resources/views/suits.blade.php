@extends('layouts.app')

@section('title', 'Designer Suits & Anarkalis — RANISAHAB Luxury')
@section('meta_description', 'Discover luxurious designer suits, Anarkali suits, shararas, and straight cuts at RANISAHAB. Handcrafted outfits for weddings, parties, and festive occasions.')
@section('meta_keywords', 'designer suits, Anarkali suit, sharara suit, palazzo set, straight cut suit, wedding suits')

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
  <form id="filterDrawer" method="GET" action="{{ url()->current() }}" class="plp-filter-drawer {{ (request()->has('occasions') || request()->has('types') || request()->has('price') || request()->has('colors') || request()->has('fabrics') || request()->has('sizes') || request()->has('sort_by')) ? 'open' : '' }}">
    <input type="hidden" name="sort_by" id="sortByInput" value="{{ request('sort_by') }}">
    
    <div class="d-flex justify-content-between align-items-center w-100 pb-2 mb-3 border-bottom border-warning border-opacity-25">
      <span class="text-gold font-display fw-bold fs-6 text-uppercase" style="letter-spacing: 0.1em; color: #c9a24b !important;"><i class="fa-solid fa-sliders me-2"></i>COUTURE FILTERS</span>
      <a href="{{ url()->current() }}" class="small text-gold-light text-decoration-underline" style="font-size: 0.75rem;">Reset All</a>
    </div>

    <div class="row g-3 w-100 m-0">
      <!-- Price Range -->
      <div class="col-6 col-md-2 plp-filter-section">
        <p class="plp-filter-label">PRICE RANGE</p>
        <label class="plp-filter-check"><input type="radio" name="price" value="" {{ !request('price') ? 'checked' : '' }} onchange="submitFilterForm()"> All Prices</label>
        <label class="plp-filter-check"><input type="radio" name="price" value="under_5000" {{ request('price') === 'under_5000' ? 'checked' : '' }} onchange="submitFilterForm()"> Under ₹5,000</label>
        <label class="plp-filter-check"><input type="radio" name="price" value="5000_15000" {{ request('price') === '5000_15000' ? 'checked' : '' }} onchange="submitFilterForm()"> ₹5,000 – ₹15,000</label>
        <label class="plp-filter-check"><input type="radio" name="price" value="15000_30000" {{ request('price') === '15000_30000' ? 'checked' : '' }} onchange="submitFilterForm()"> ₹15,000 – ₹30,000</label>
        <label class="plp-filter-check"><input type="radio" name="price" value="above_30000" {{ request('price') === 'above_30000' ? 'checked' : '' }} onchange="submitFilterForm()"> ₹30,000+</label>
      </div>

      <!-- Color Swatches -->
      <div class="col-6 col-md-2 plp-filter-section">
        <p class="plp-filter-label">COLOUR</p>
        <div class="d-flex flex-wrap gap-2" style="max-width: 140px;">
          @foreach(['Red' => '#e31b23', 'Pink' => '#ff69b4', 'Blue' => '#0f52ba', 'Green' => '#008000', 'Gold' => '#ffd700', 'Maroon' => '#800000', 'Ivory' => '#fffff0', 'Yellow' => '#ffff00', 'Orange' => '#ffa500', 'Purple' => '#800080'] as $cName => $cHex)
            <label class="color-filter-swatch position-relative cursor-pointer" title="{{ $cName }}" style="display: inline-block; margin-bottom: 2px;">
              <input type="checkbox" name="colors[]" value="{{ $cName }}" {{ is_array(request('colors')) && in_array($cName, request('colors')) ? 'checked' : '' }} onchange="submitFilterForm()" style="display: none;">
              <span class="d-inline-block rounded-circle border {{ is_array(request('colors')) && in_array($cName, request('colors')) ? 'border-warning border-2 shadow' : 'border-secondary' }}" style="width: 22px; height: 22px; background-color: {{ $cHex }}; opacity: 0.95;">
                @if(is_array(request('colors')) && in_array($cName, request('colors')))
                  <i class="fa-solid fa-check text-dark text-center position-absolute" style="top:50%;left:50%;transform:translate(-50%,-50%);font-size:0.6rem;text-shadow:0 0 2px #fff;"></i>
                @endif
              </span>
            </label>
          @endforeach
        </div>
      </div>

      <!-- Fabric -->
      <div class="col-6 col-md-2 plp-filter-section">
        <p class="plp-filter-label">FABRIC</p>
        <label class="plp-filter-check"><input type="checkbox" name="fabrics[]" value="Silk" {{ is_array(request('fabrics')) && in_array('Silk', request('fabrics')) ? 'checked' : '' }} onchange="submitFilterForm()"> Silk / Handloom</label>
        <label class="plp-filter-check"><input type="checkbox" name="fabrics[]" value="Chanderi" {{ is_array(request('fabrics')) && in_array('Chanderi', request('fabrics')) ? 'checked' : '' }} onchange="submitFilterForm()"> Chanderi</label>
        <label class="plp-filter-check"><input type="checkbox" name="fabrics[]" value="Georgette" {{ is_array(request('fabrics')) && in_array('Georgette', request('fabrics')) ? 'checked' : '' }} onchange="submitFilterForm()"> Georgette</label>
        <label class="plp-filter-check"><input type="checkbox" name="fabrics[]" value="Organza" {{ is_array(request('fabrics')) && in_array('Organza', request('fabrics')) ? 'checked' : '' }} onchange="submitFilterForm()"> Organza</label>
        <label class="plp-filter-check"><input type="checkbox" name="fabrics[]" value="Velvet" {{ is_array(request('fabrics')) && in_array('Velvet', request('fabrics')) ? 'checked' : '' }} onchange="submitFilterForm()"> Velvet</label>
      </div>

      <!-- Occasion -->
      <div class="col-6 col-md-3 plp-filter-section">
        <p class="plp-filter-label">OCCASION</p>
        <label class="plp-filter-check"><input type="checkbox" name="occasions[]" value="Wedding" {{ is_array(request('occasions')) && in_array('Wedding', request('occasions')) ? 'checked' : '' }} onchange="submitFilterForm()"> Wedding &amp; Bridal</label>
        <label class="plp-filter-check"><input type="checkbox" name="occasions[]" value="Reception" {{ is_array(request('occasions')) && in_array('Reception', request('occasions')) ? 'checked' : '' }} onchange="submitFilterForm()"> Party &amp; Reception</label>
        <label class="plp-filter-check"><input type="checkbox" name="occasions[]" value="Festive" {{ is_array(request('occasions')) && in_array('Festive', request('occasions')) ? 'checked' : '' }} onchange="submitFilterForm()"> Festive Wear</label>
        <label class="plp-filter-check"><input type="checkbox" name="occasions[]" value="Casual" {{ is_array(request('occasions')) && in_array('Casual', request('occasions')) ? 'checked' : '' }} onchange="submitFilterForm()"> Casual Wear</label>
      </div>

      <!-- Size -->
      <div class="col-6 col-md-3 plp-filter-section">
        <p class="plp-filter-label">SIZE</p>
        <label class="plp-filter-check"><input type="checkbox" name="sizes[]" value="Free Size" {{ is_array(request('sizes')) && in_array('Free Size', request('sizes')) ? 'checked' : '' }} onchange="submitFilterForm()"> Free Size</label>
        <label class="plp-filter-check"><input type="checkbox" name="sizes[]" value="S" {{ is_array(request('sizes')) && in_array('S', request('sizes')) ? 'checked' : '' }} onchange="submitFilterForm()"> S (Small)</label>
        <label class="plp-filter-check"><input type="checkbox" name="sizes[]" value="M" {{ is_array(request('sizes')) && in_array('M', request('sizes')) ? 'checked' : '' }} onchange="submitFilterForm()"> M (Medium)</label>
        <label class="plp-filter-check"><input type="checkbox" name="sizes[]" value="L" {{ is_array(request('sizes')) && in_array('L', request('sizes')) ? 'checked' : '' }} onchange="submitFilterForm()"> L (Large)</label>
        <label class="plp-filter-check"><input type="checkbox" name="sizes[]" value="XL" {{ is_array(request('sizes')) && in_array('XL', request('sizes')) ? 'checked' : '' }} onchange="submitFilterForm()"> XL (Extra Large)</label>
      </div>
    </div>
  </form>

  <!-- Product Grid -->
  <div class="row g-3 g-md-4">
    @forelse ($products as $product)
      @include('partials.product_card', ['product' => $product])
    @empty
      <div class="col-12 text-center py-5">
        <p class="text-muted font-label">No suits found matching your criteria.</p>
      </div>
    @endforelse
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
