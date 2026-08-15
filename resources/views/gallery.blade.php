@extends('layouts.app')

@section('title', 'Real Brides Gallery — RANISAHAB Luxury')
@section('meta_description', 'View real stories and beautiful moments of RANISAHAB brides in our luxury sarees, suits, designer lehengas, and custom bridal wear.')
@section('meta_keywords', 'real brides, bridal gallery, ranisahab wedding look, customer stories, bridal couture gallery')

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
  <div class="gallery-tab-bar justify-content-center mb-4">
    <button class="gallery-tab active" data-filter="all">ALL BRIDES</button>
    <button class="gallery-tab" data-filter="lehenga">LEHENGAS</button>
    <button class="gallery-tab" data-filter="saree">SAREES</button>
    <button class="gallery-tab" data-filter="bridal">BRIDAL WEAR</button>
    <button class="gallery-tab" data-filter="suits">SUITS</button>
    <button class="gallery-tab" data-filter="video"><i class="fa-solid fa-play me-1"></i>VIDEOS</button>
  </div>

  <!-- Gallery Grid -->
  <div class="gallery-dark-grid">
    @forelse($galleries as $item)
      <div class="gallery-dark-item" data-cat="{{ strtolower($item->category) }}" data-is-video="{{ $item->is_video ? '1' : '0' }}" @if($item->is_video && $item->video_url) onclick="window.open('{{ $item->video_url }}', '_blank')" style="cursor:pointer;" @endif>
        @if(str_starts_with($item->image_path, 'http') || str_starts_with($item->image_path, '/storage/') || str_starts_with($item->image_path, 'images/'))
          <img src="{{ asset($item->image_path) }}" alt="{{ $item->title }}">
        @else
          <img src="{{ asset('/storage/' . $item->image_path) }}" alt="{{ $item->title }}">
        @endif
        <div class="gallery-dark-overlay">
          <span class="gallery-dark-tag">{{ $item->title }}</span>
        </div>
        @if($item->is_video)
          <div class="gallery-play-btn"><i class="fa-solid fa-play"></i></div>
        @endif
      </div>
    @empty
      <div class="col-12 text-center py-5 text-muted">
        <p class="font-label">No real bride stories available in gallery.</p>
      </div>
    @endforelse
  </div>

  <div class="plp-load-more mt-4 text-center">
    <button class="plp-load-more-btn">LOAD MORE STORIES <i class="fa-solid fa-chevron-down ms-2"></i></button>
  </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const tabs = document.querySelectorAll('.gallery-tab');
  const items = document.querySelectorAll('.gallery-dark-item');
  const loadMoreBtn = document.querySelector('.plp-load-more-btn');
  const itemsToShow = 8;
  let activeFilter = 'all';
  let currentVisibleCount = itemsToShow;

  function applyGalleryLayout() {
    let matchCount = 0;

    items.forEach(item => {
      const itemCat = (item.getAttribute('data-cat') || '').toLowerCase().trim();
      const isVideo = item.getAttribute('data-is-video') === '1' || itemCat === 'video';
      
      let matchesFilter = false;
      if (activeFilter === 'all') {
        matchesFilter = true;
      } else if (activeFilter === 'video') {
        matchesFilter = isVideo || itemCat === 'video';
      } else {
        matchesFilter = (itemCat === activeFilter);
      }

      if (matchesFilter) {
        matchCount++;
        if (matchCount <= currentVisibleCount) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      } else {
        item.style.display = 'none';
      }
    });

    if (loadMoreBtn && loadMoreBtn.parentElement) {
      if (matchCount <= currentVisibleCount) {
        loadMoreBtn.parentElement.style.display = 'none';
      } else {
        loadMoreBtn.parentElement.style.display = 'block';
      }
    }
  }

  tabs.forEach(tab => {
    tab.addEventListener('click', function(e) {
      e.preventDefault();
      tabs.forEach(t => t.classList.remove('active'));
      this.classList.add('active');
      activeFilter = (this.getAttribute('data-filter') || 'all').toLowerCase().trim();
      currentVisibleCount = itemsToShow;
      applyGalleryLayout();
    });
  });

  if (loadMoreBtn) {
    loadMoreBtn.addEventListener('click', function(e) {
      e.preventDefault();
      currentVisibleCount += itemsToShow;
      applyGalleryLayout();
    });
  }

  // Initial execution
  applyGalleryLayout();
});
</script>
@endpush
