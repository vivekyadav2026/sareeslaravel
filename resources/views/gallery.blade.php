@extends('layouts.app')

@section('title', 'Real Brides Gallery — RANISAHAB Luxury')

@section('content')
<div class="plp-page">

  <!-- Breadcrumb -->
  <div class="plp-breadcrumb">
    <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i></a>
    <span class="plp-bc-sep">/</span>
    <span>Gallery</span>
  </div>

  <!-- Page Header -->
  <div class="plp-header">
    <div class="plp-header-deco">
      <span class="plp-deco-line"></span>
      <i class="fa-solid fa-heart plp-deco-icon"></i>
      <span class="plp-deco-line"></span>
    </div>
    <h1 class="plp-page-title">REAL BRIDES</h1>
    <p class="plp-page-subtitle">Real Stories, Timeless Memories.</p>
  </div>

  <!-- Filter Tabs -->
  <div class="gallery-tab-bar">
    <button class="gallery-tab active" data-filter="all">ALL BRIDES</button>
    <button class="gallery-tab" data-filter="lehenga">LEHENGAS</button>
    <button class="gallery-tab" data-filter="saree">SAREES</button>
    <button class="gallery-tab" data-filter="video"><i class="fa-solid fa-play me-1"></i>VIDEOS</button>
  </div>

  <!-- Gallery Grid -->
  <div class="gallery-dark-grid">

    <div class="gallery-dark-item" data-cat="lehenga">
      <img src="{{ asset('images/hero_bride.png') }}" alt="Bride Story 1">
      <div class="gallery-dark-overlay">
        <span class="gallery-dark-tag">Bridal Lehenga</span>
      </div>
    </div>

    <div class="gallery-dark-item" data-cat="saree">
      <img src="{{ asset('images/promise_bride.png') }}" alt="Bride Story 2">
      <div class="gallery-dark-overlay">
        <span class="gallery-dark-tag">Silk Saree</span>
      </div>
    </div>

    <div class="gallery-dark-item" data-cat="lehenga">
      <img src="{{ asset('images/cat_bridal.png') }}" alt="Bride Story 3">
      <div class="gallery-dark-overlay">
        <span class="gallery-dark-tag">Royal Bridal</span>
      </div>
    </div>

    <div class="gallery-dark-item" data-cat="video">
      <img src="{{ asset('images/cat_lehenga.png') }}" alt="Bride Story 4">
      <div class="gallery-dark-overlay">
        <span class="gallery-dark-tag">Lehenga Story</span>
      </div>
      <div class="gallery-play-btn"><i class="fa-solid fa-play"></i></div>
    </div>

    <div class="gallery-dark-item" data-cat="lehenga">
      <img src="{{ asset('images/pkg_royal.png') }}" alt="Bride Story 5">
      <div class="gallery-dark-overlay">
        <span class="gallery-dark-tag">Royal Package</span>
      </div>
    </div>

    <div class="gallery-dark-item" data-cat="saree">
      <img src="{{ asset('images/pkg_gold.png') }}" alt="Bride Story 6">
      <div class="gallery-dark-overlay">
        <span class="gallery-dark-tag">Gold Package</span>
      </div>
    </div>

    <div class="gallery-dark-item" data-cat="lehenga">
      <img src="{{ asset('images/pkg_silver.png') }}" alt="Bride Story 7">
      <div class="gallery-dark-overlay">
        <span class="gallery-dark-tag">Silver Package</span>
      </div>
    </div>

    <div class="gallery-dark-item" data-cat="saree">
      <img src="{{ asset('images/cat_saree.png') }}" alt="Bride Story 8">
      <div class="gallery-dark-overlay">
        <span class="gallery-dark-tag">Banarasi Saree</span>
      </div>
    </div>

    <div class="gallery-dark-item" data-cat="lehenga">
      <img src="{{ asset('images/cat_bridal.png') }}" alt="Bride Story 9">
      <div class="gallery-dark-overlay">
        <span class="gallery-dark-tag">Bridal Couture</span>
      </div>
    </div>

    <div class="gallery-dark-item" data-cat="saree">
      <img src="{{ asset('images/hero_bride.png') }}" alt="Bride Story 10">
      <div class="gallery-dark-overlay">
        <span class="gallery-dark-tag">Wedding Saree</span>
      </div>
    </div>

    <div class="gallery-dark-item" data-cat="video">
      <img src="{{ asset('images/promise_bride.png') }}" alt="Bride Story 11">
      <div class="gallery-dark-overlay">
        <span class="gallery-dark-tag">Bridal Story</span>
      </div>
      <div class="gallery-play-btn"><i class="fa-solid fa-play"></i></div>
    </div>

    <div class="gallery-dark-item" data-cat="lehenga">
      <img src="{{ asset('images/pkg_royal.png') }}" alt="Bride Story 12">
      <div class="gallery-dark-overlay">
        <span class="gallery-dark-tag">Custom Lehenga</span>
      </div>
    </div>

  </div>

  <div class="plp-load-more">
    <button class="plp-load-more-btn">LOAD MORE STORIES <i class="fa-solid fa-chevron-down ms-2"></i></button>
  </div>

</div>
@endsection

@push('scripts')
// Gallery dynamic load more and tab filters coordination
document.addEventListener('DOMContentLoaded', function() {
  const tabs = document.querySelectorAll('.gallery-tab');
  const items = document.querySelectorAll('.gallery-dark-item');
  const loadMoreBtn = document.querySelector('.plp-load-more-btn');
  const itemsToShow = 8;
  let activeFilter = 'all';
  let currentVisibleCount = itemsToShow;

  function applyGalleryLayout() {
    let matchCount = 0;
    let visibleCount = 0;

    items.forEach(item => {
      const matchesFilter = (activeFilter === 'all' || item.dataset.cat === activeFilter);
      if (matchesFilter) {
        matchCount++;
        if (matchCount <= currentVisibleCount) {
          item.style.display = 'block';
          visibleCount++;
        } else {
          item.style.display = 'none';
        }
      } else {
        item.style.display = 'none';
      }
    });

    if (!loadMoreBtn) return;

    if (matchCount <= currentVisibleCount) {
      loadMoreBtn.parentElement.style.display = 'none';
    } else {
      loadMoreBtn.parentElement.style.display = 'block';
    }
  }

  tabs.forEach(tab => {
    tab.addEventListener('click', function() {
      tabs.forEach(t => t.classList.remove('active'));
      this.classList.add('active');
      activeFilter = this.dataset.filter;
      currentVisibleCount = itemsToShow; // reset visibility limit
      applyGalleryLayout();
    });
  });

  if (loadMoreBtn) {
    loadMoreBtn.addEventListener('click', function() {
      currentVisibleCount += itemsToShow;
      applyGalleryLayout();
    });
  }

  // Initial execution
  applyGalleryLayout();
});
</script>
@endpush
