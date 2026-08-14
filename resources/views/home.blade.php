@extends('layouts.app')

@section('title', 'RANISAHAB — Luxury Fashion for Every Woman | Sarees, Lehengas & Bridal Wear')

@section('content')
<!-- Hero Banner Slider -->
<section class="hero-banner-slider">
  <div class="hero-banner-track" id="heroBannerTrack">
    <!-- Slide 1 -->
    <div class="hero-banner-slide active">
      <img src="{{ asset('images/slider_banner_1.png') }}" alt="Royal Sarees Collection">
    </div>
    <!-- Slide 2 -->
    <div class="hero-banner-slide">
      <img src="{{ asset('images/slider_banner_2.png') }}" alt="Bridal Lehenga Collection">
    </div>
    <!-- Slide 3 -->
    <div class="hero-banner-slide">
      <img src="{{ asset('images/slider_banner_3.png') }}" alt="Exclusive Collection">
    </div>
  </div>

  <!-- Prev / Next Controls -->
  <button class="hero-banner-arrow hero-banner-prev" id="heroBannerPrev" aria-label="Previous"><i class="fa-solid fa-chevron-left"></i></button>
  <button class="hero-banner-arrow hero-banner-next" id="heroBannerNext" aria-label="Next"><i class="fa-solid fa-chevron-right"></i></button>

  <!-- Dots -->
  <div class="hero-banner-dots">
    <span class="hero-banner-dot active" data-idx="0"></span>
    <span class="hero-banner-dot" data-idx="1"></span>
    <span class="hero-banner-dot" data-idx="2"></span>
  </div>
</section>

@push('scripts')
<script>
(function(){
  const slides = document.querySelectorAll('.hero-banner-slide');
  const dots   = document.querySelectorAll('.hero-banner-dot');
  const track  = document.getElementById('heroBannerTrack');
  let current  = 0;
  let timer;

  function goTo(idx) {
    const prev = current;
    current = (idx + slides.length) % slides.length;
    if (prev === current) return;

    // Fix the track height to the current active slide before transition
    track.style.height = slides[prev].offsetHeight + 'px';

    // Remove active from previous — it goes to absolute
    slides[prev].classList.remove('active');
    dots[prev].classList.remove('active');

    // Add active to new slide — it becomes relative and sets new height
    slides[current].classList.add('active');
    dots[current].classList.add('active');

    // After transition ends, release fixed height
    setTimeout(() => {
      track.style.height = '';
    }, 900);
  }

  function autoPlay() {
    timer = setInterval(() => goTo(current + 1), 5000);
  }

  function resetTimer() {
    clearInterval(timer);
    autoPlay();
  }

  document.getElementById('heroBannerNext').addEventListener('click', () => { goTo(current + 1); resetTimer(); });
  document.getElementById('heroBannerPrev').addEventListener('click', () => { goTo(current - 1); resetTimer(); });
  dots.forEach(d => d.addEventListener('click', () => { goTo(+d.dataset.idx); resetTimer(); }));

  autoPlay();
})();
</script>
@endpush



<!-- Shop by Category — Premium Dark 2x2 Grid -->
<section class="shop-by-category-section">
  <!-- Section Heading -->
  <div class="sbc-heading-wrapper">
    <span class="sbc-deco-line"></span>
    <span class="sbc-crown-icon"><i class="fa-solid fa-diamond"></i></span>
    <h2 class="sbc-heading">SHOP BY CATEGORY</h2>
    <span class="sbc-crown-icon"><i class="fa-solid fa-diamond"></i></span>
    <span class="sbc-deco-line"></span>
  </div>

  <!-- 2x2 Grid -->
  <div class="sbc-grid">
    <!-- Sarees -->
    <a href="{{ route('sarees') }}" class="sbc-card">
      <img src="{{ asset('images/cat_saree.png') }}" alt="Sarees Collection">
      <div class="sbc-card-overlay">
        <div class="sbc-card-text">
          <h3 class="sbc-card-title">SAREES</h3>
          <span class="sbc-shop-now">SHOP NOW <i class="fa-solid fa-chevron-right ms-1"></i></span>
        </div>
      </div>
    </a>

    <!-- Suits -->
    <a href="{{ route('suits') }}" class="sbc-card">
      <img src="{{ asset('images/cat_suit.png') }}" alt="Suits Collection">
      <div class="sbc-card-overlay">
        <div class="sbc-card-text">
          <h3 class="sbc-card-title">SUITS</h3>
          <span class="sbc-shop-now">SHOP NOW <i class="fa-solid fa-chevron-right ms-1"></i></span>
        </div>
      </div>
    </a>

    <!-- Lehengas -->
    <a href="{{ route('lehengas') }}" class="sbc-card">
      <img src="{{ asset('images/cat_lehenga.png') }}" alt="Lehengas Collection">
      <div class="sbc-card-overlay">
        <div class="sbc-card-text">
          <h3 class="sbc-card-title">LEHENGAS</h3>
          <span class="sbc-shop-now">SHOP NOW <i class="fa-solid fa-chevron-right ms-1"></i></span>
        </div>
      </div>
    </a>

    <!-- Bridal Collection -->
    <a href="{{ route('bridal-collection') }}" class="sbc-card">
      <img src="{{ asset('images/cat_bridal.png') }}" alt="Bridal Collection">
      <div class="sbc-card-overlay">
        <div class="sbc-card-text">
          <h3 class="sbc-card-title">BRIDAL<br>COLLECTION</h3>
          <span class="sbc-shop-now">SHOP NOW <i class="fa-solid fa-chevron-right ms-1"></i></span>
        </div>
      </div>
    </a>
  </div>
</section>

<!-- Our Exclusive Promise Section -->
<section class="promise-section">
  <div class="container">
    <div class="row align-items-center g-5">
      <!-- Media Left -->
      <div class="col-lg-5">
        <div class="promise-media-frame">
          <img src="{{ asset('images/promise_bride.png') }}" alt="One Design One Bride">
        </div>
      </div>
      <!-- Center Info -->
      <div class="col-lg-4">
        <p class="promise-header-eyebrow">OUR EXCLUSIVE PROMISE</p>
        <h2 class="promise-main-title">ONE DESIGN, ONE BRIDE</h2>
        <p class="promise-body-text">A custom bridal lehenga designed just for you. Once it's yours, it will never be created again for anyone else. Because you are one of a kind.</p>
        
        <div class="promise-icon-grid">
          <div>
            <div class="promise-icon-box"><i class="fa-solid fa-star"></i></div>
            <p class="promise-icon-label">100% EXCLUSIVE DESIGN</p>
          </div>
          <div>
            <div class="promise-icon-box"><i class="fa-solid fa-hand-sparkles"></i></div>
            <p class="promise-icon-label">MADE ONLY FOR YOU</p>
          </div>
          <div>
            <div class="promise-icon-box"><i class="fa-solid fa-certificate"></i></div>
            <p class="promise-icon-label">DESIGN CERTIFICATE PROVIDED</p>
          </div>
          <div>
            <div class="promise-icon-box"><i class="fa-solid fa-ban"></i></div>
            <p class="promise-icon-label">NEVER REPEATED EVER AGAIN</p>
          </div>
        </div>
      </div>
      <!-- Right Certificate Card Frame -->
      <div class="col-lg-3">
        <div class="certificate-card-frame">
          <img src="{{ asset('images/logo.png') }}" alt="RANISAHAB Logo" class="brand-logo-img logo-sm mb-2">
          <h4>EXCLUSIVE DESIGN CERTIFICATE</h4>
          <p class="mb-0">This design is specially created for you and will never be recreated for anyone else.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Infinite Scroll Royal Products Collection Section -->
<section id="home-infinite-products" class="pt-5 pb-2" style="background-color: #080706;">
  <div class="container">
    <div class="section-title-wrapper text-center mb-4">
      <span class="motif text-gold">❖</span>
      <h2 class="text-gold-light font-display fs-2 text-uppercase mb-1">ROYAL EXCLUSIVE COLLECTION</h2>
      <p class="text-white opacity-75 small font-label">Handcrafted Sarees, Lehengas &amp; Bridal Attire</p>
      <div style="width: 60px; height: 1px; background: rgba(201,162,75,0.3); margin: 0.8rem auto 0;"></div>
    </div>

    <!-- Product Grid Container -->
    <div class="row g-3 g-md-4" id="homeProductGrid">
      @foreach($initialProducts as $product)
        @include('partials.product_card', ['product' => $product])
      @endforeach
    </div>

    <!-- Loading Spinner & Load Trigger -->
    <div id="infiniteScrollSentinel" class="text-center py-2 my-1">
      @if($initialProducts->hasMorePages())
        <div id="infiniteLoader" class="d-none py-2">
          <div class="spinner-border text-gold me-2" role="status" style="width: 1.8rem; height: 1.8rem;"></div>
          <span class="text-gold-light small font-label ms-2" style="letter-spacing:0.1em;">LOADING MORE LUXURY CREATIONS...</span>
        </div>
      @else
        <p class="text-gold font-display text-center py-2 fs-6 fw-bold m-0" style="color: #c9a24b !important; letter-spacing: 0.12em; text-shadow: 0 0 10px rgba(201,162,75,0.35);">✦ YOU HAVE EXPLORED ALL OUR ROYAL CREATIONS ✦</p>
      @endif
    </div>
  </div>
</section>

<!-- Bridal Packages Section -->
<section id="packages" class="packages-section pt-3 pb-5">
  <div class="container">
    <div class="section-title-wrapper text-center mb-4">
      <span class="motif text-gold">❖</span>
      <h2 class="text-gold-light">BRIDAL PACKAGES</h2>
    </div>

    <!-- Dynamic Slider Wrapper -->
    <div class="home-pkg-slider-container position-relative px-md-4">
      
      <!-- Slider Arrows -->
      <button class="home-pkg-arrow prev-btn" id="homePkgPrevBtn" aria-label="Previous Package"><i class="fa-solid fa-chevron-left"></i></button>
      <button class="home-pkg-arrow next-btn" id="homePkgNextBtn" aria-label="Next Package"><i class="fa-solid fa-chevron-right"></i></button>

      <div class="home-pkg-track-wrapper">
        <div class="home-pkg-track" id="homePkgTrack">
          @foreach($packages as $package)
            @php
              // Map fallback images dynamically based on keywords
              $image = 'images/pkg_silver.png';
              if (\Illuminate\Support\Str::contains(strtolower($package->name), 'gold')) {
                  $image = 'images/pkg_gold.png';
              } elseif (\Illuminate\Support\Str::contains(strtolower($package->name), 'royal') || \Illuminate\Support\Str::contains(strtolower($package->name), 'ranisahab')) {
                  $image = 'images/pkg_royal.png';
              }
              $imageSrc = $package->image ? asset($package->image) : asset($image);
            @endphp
            
            <div class="package-card-slide">
              <div class="package-card h-100 d-flex flex-column">
                <div class="package-card-media" style="height:240px; overflow:hidden;">
                  <img src="{{ $imageSrc }}" alt="{{ $package->name }}" style="width:100%; height:100%; object-fit:cover; object-position:center top;">
                </div>
                <div class="package-card-body d-flex flex-column flex-grow-1">
                  <p class="package-card-title text-uppercase fw-bold text-gold mb-1">{{ $package->name }}</p>
                  <p class="package-price-tag fw-bold">₹{{ number_format($package->price, 0) }}</p>
                  
                  <ul class="package-feature-list mb-4 text-start">
                    @if($package->features && is_array($package->features))
                      @foreach($package->features as $feat)
                        <li><i class="fa-solid fa-check text-gold me-2"></i>{{ $feat }}</li>
                      @endforeach
                    @else
                      <li><i class="fa-solid fa-check text-gold me-2"></i>Custom Bridal Wear</li>
                      <li><i class="fa-solid fa-check text-gold me-2"></i>Makeup Session</li>
                      <li><i class="fa-solid fa-check text-gold me-2"></i>Fittings Consultation</li>
                    @endif
                  </ul>
                  
                  <div class="mt-auto">
                    <form action="{{ route('cart.add-package') }}" method="POST">
                      @csrf
                      <input type="hidden" name="package_id" value="{{ $package->id }}">
                      <button type="submit" class="btn btn-gold w-100">BOOK NOW</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <!-- Slide Indicators -->
      <div class="home-pkg-dots text-center mt-3" id="homePkgDots"></div>
    </div>

  </div>
</section>

<!-- Trust Banner -->
<div class="trust-strip-banner">
  <div class="container">
    <div class="row g-3">
      <div class="col-6 col-md-3">
        <div class="trust-item-col">
          <i class="fa-solid fa-truck-fast"></i>
          <span>FREE SHIPPING<small>ALL OVER INDIA</small></span>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="trust-item-col">
          <i class="fa-solid fa-lock"></i>
          <span>SECURE PAYMENT<small>100% SAFE</small></span>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="trust-item-col">
          <i class="fa-solid fa-rotate-left"></i>
          <span>EASY RETURNS<small>NO QUESTIONS ASKED</small></span>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="trust-item-col">
          <i class="fa-solid fa-clock"></i>
          <span>ON TIME DELIVERY<small>5-7 DAYS DELIVERY</small></span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Real Brides & Testimonials -->
<section id="gallery" class="gallery-testimonials-section">
  <div class="container">
    <div class="row g-5">
      <!-- Gallery Left -->
      <div class="col-lg-7">
        <div class="section-title-wrapper text-start mb-4">
          <span class="motif text-gold">❖</span>
          <h2 class="text-gold-light" style="font-size:1.8rem;">REAL BRIDES, REAL STORIES</h2>
        </div>
        <div class="gallery-grid-6">
          <div class="gallery-thumb-item"><img src="{{ asset('images/hero_bride.png') }}" alt="Bride 1"></div>
          <div class="gallery-thumb-item"><img src="{{ asset('images/promise_bride.png') }}" alt="Bride 2"></div>
          <div class="gallery-thumb-item"><img src="{{ asset('images/cat_bridal.png') }}" alt="Bride 3"></div>
          <div class="gallery-thumb-item">
            <img src="{{ asset('images/cat_lehenga.png') }}" alt="Bride 4">
            <div class="video-play-btn"><i class="fa-solid fa-circle-play"></i></div>
          </div>
          <div class="gallery-thumb-item"><img src="{{ asset('images/pkg_royal.png') }}" alt="Bride 5"></div>
          <div class="gallery-thumb-item"><img src="{{ asset('images/cat_saree.png') }}" alt="Bride 6"></div>
        </div>
        <div class="text-center text-lg-start mt-4">
          <a href="{{ route('gallery') }}" class="btn btn-gold btn-sm">VIEW MORE GALLERY</a>
        </div>
      </div>
      <!-- Testimonials Right -->
      <div class="col-lg-5">
        <div class="section-title-wrapper text-start mb-4">
          <h2 class="text-gold-light" style="font-size:1.4rem;">WHAT OUR BEAUTIFUL CLIENTS SAY</h2>
        </div>
        <div class="testimonial-card-box">
          <div class="testimonial-stars">
            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
          </div>
          <p class="testimonial-quote">"RANISAHAB made my dream wedding outfit come true! The quality, the design, everything was perfect. I felt like a queen on my big day."</p>
          <p class="testimonial-author">— Neha Sharma</p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const slides = document.querySelectorAll('.hero-slide');
  const dots = document.querySelectorAll('.slider-dot');
  const prevBtn = document.getElementById('heroPrevBtn');
  const nextBtn = document.getElementById('heroNextBtn');
  let currentSlide = 0;
  let slideInterval;

  function showSlide(index) {
    if (index >= slides.length) index = 0;
    if (index < 0) index = slides.length - 1;
    currentSlide = index;

    slides.forEach((slide, idx) => {
      if (idx === currentSlide) {
        slide.classList.remove('d-none');
        slide.classList.add('active', 'animate-fade-in');
      } else {
        slide.classList.add('d-none');
        slide.classList.remove('active', 'animate-fade-in');
      }
    });

    dots.forEach((dot, idx) => {
      if (idx === currentSlide) {
        dot.classList.add('active');
      } else {
        dot.classList.remove('active');
      }
    });
  }

  function nextSlide() {
    showSlide(currentSlide + 1);
  }

  function prevSlide() {
    showSlide(currentSlide - 1);
  }

  if (nextBtn) nextBtn.addEventListener('click', function() {
    nextSlide();
    resetTimer();
  });

  if (prevBtn) prevBtn.addEventListener('click', function() {
    prevSlide();
    resetTimer();
  });

  dots.forEach((dot, idx) => {
    dot.addEventListener('click', function() {
      showSlide(idx);
      resetTimer();
    });
  });

  function startTimer() {
    slideInterval = setInterval(nextSlide, 5000);
  }

  function resetTimer() {
    clearInterval(slideInterval);
    startTimer();
  }

  startTimer();
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const track = document.getElementById('homePkgTrack');
  const cards = document.querySelectorAll('.package-card-slide');
  const prevBtn = document.getElementById('homePkgPrevBtn');
  const nextBtn = document.getElementById('homePkgNextBtn');
  const dotsContainer = document.getElementById('homePkgDots');
  
  if (!track || cards.length === 0) return;

  let itemsPerPage = 3;
  if (window.innerWidth < 768) {
      itemsPerPage = 1;
  } else if (window.innerWidth < 992) {
      itemsPerPage = 2;
  }

  let currentIndex = 0;
  let maxIndex = Math.max(0, cards.length - itemsPerPage);

  function createDots() {
      if (!dotsContainer) return;
      dotsContainer.innerHTML = '';
      const pagesCount = cards.length - itemsPerPage + 1;
      if (pagesCount <= 1) return;
      
      for (let i = 0; i < pagesCount; i++) {
          const dot = document.createElement('span');
          dot.className = 'home-pkg-dot' + (i === currentIndex ? ' active' : '');
          dot.addEventListener('click', function() {
              goToSlide(i);
          });
          dotsContainer.appendChild(dot);
      }
  }

  function updateSlider() {
      if (cards[currentIndex]) {
          const offset = cards[currentIndex].offsetLeft;
          track.style.transform = `translateX(-${offset}px)`;
      }

      if (dotsContainer) {
          const dots = dotsContainer.querySelectorAll('.home-pkg-dot');
          dots.forEach((dot, idx) => {
              if (idx === currentIndex) {
                  dot.classList.add('active');
              } else {
                  dot.classList.remove('active');
              }
          });
      }

      if (prevBtn) prevBtn.style.opacity = currentIndex === 0 ? '0.3' : '1';
      if (nextBtn) nextBtn.style.opacity = currentIndex === maxIndex ? '0.3' : '1';
  }

  function goToSlide(idx) {
      currentIndex = Math.max(0, Math.min(idx, maxIndex));
      updateSlider();
  }

  if (prevBtn) {
      prevBtn.addEventListener('click', function() {
          if (currentIndex > 0) goToSlide(currentIndex - 1);
      });
  }

  if (nextBtn) {
      nextBtn.addEventListener('click', function() {
          if (currentIndex < maxIndex) goToSlide(currentIndex + 1);
      });
  }

  window.addEventListener('resize', function() {
      const oldItems = itemsPerPage;
      if (window.innerWidth < 768) {
          itemsPerPage = 1;
      } else if (window.innerWidth < 992) {
          itemsPerPage = 2;
      } else {
          itemsPerPage = 3;
      }

      if (oldItems !== itemsPerPage) {
          currentIndex = 0;
          maxIndex = Math.max(0, cards.length - itemsPerPage);
          createDots();
          updateSlider();
      }
  });

  createDots();
  updateSlider();

  // Enhanced Infinite Scroll Logic for Home Page Products
  let currentPage = 1;
  let hasMorePages = {{ $initialProducts->hasMorePages() ? 'true' : 'false' }};
  let isLoading = false;

  const sentinel = document.getElementById('infiniteScrollSentinel');
  const loader = document.getElementById('infiniteLoader');
  const productGrid = document.getElementById('homeProductGrid');

  function checkScrollAndLoad() {
      if (isLoading || !hasMorePages || !sentinel) return;
      const rect = sentinel.getBoundingClientRect();
      if (rect.top <= window.innerHeight + 350) {
          loadNextProducts();
      }
  }

  function loadNextProducts() {
      if (isLoading || !hasMorePages) return;
      isLoading = true;
      if (loader) loader.classList.remove('d-none');

      currentPage++;
      fetch(`{{ route('api.products') }}?page=${currentPage}`)
          .then(response => response.json())
          .then(data => {
              if (data.html && data.html.trim() !== '') {
                  productGrid.insertAdjacentHTML('beforeend', data.html);
              }
              hasMorePages = data.has_more;
              isLoading = false;
              if (loader) loader.classList.add('d-none');

              if (!hasMorePages && sentinel) {
                  sentinel.innerHTML = '<p class="text-gold font-display text-center py-3 fs-6 fw-bold m-0" style="color: #c9a24b !important; letter-spacing: 0.12em; text-shadow: 0 0 10px rgba(201,162,75,0.35);">✦ YOU HAVE EXPLORED ALL OUR ROYAL CREATIONS ✦</p>';
              }
          })
          .catch(err => {
              console.error('Error loading products:', err);
              isLoading = false;
              if (loader) loader.classList.add('d-none');
          });
  }

  if (sentinel && hasMorePages) {
      if ('IntersectionObserver' in window) {
          const observer = new IntersectionObserver((entries) => {
              if (entries[0].isIntersecting && !isLoading && hasMorePages) {
                  loadNextProducts();
              }
          }, { rootMargin: '350px 0px 350px 0px', threshold: 0 });

          observer.observe(sentinel);
      }

      window.addEventListener('scroll', checkScrollAndLoad, { passive: true });
      window.addEventListener('touchmove', checkScrollAndLoad, { passive: true });
  }
});
</script>
@endpush

@push('styles')
<style>
  /* Home Page Packages Horizontal Swiper Slider Styling */
  .home-pkg-slider-container {
      width: 100%;
      overflow: hidden;
  }
  .home-pkg-track-wrapper {
      overflow: hidden;
      width: 100%;
      padding: 1.5rem 0.5rem;
  }
  .home-pkg-track {
      display: flex !important;
      flex-direction: row !important;
      flex-wrap: nowrap !important;
      align-items: stretch !important;
      justify-content: flex-start !important;
      gap: 1.5rem !important;
      transition: transform 0.45s cubic-bezier(0.25, 0.46, 0.45, 0.94) !important;
  }
  .package-card-slide {
      width: calc(33.333% - 1rem);
      flex-shrink: 0;
  }
  .home-pkg-arrow {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background: rgba(8, 7, 6, 0.85);
      border: 1px solid rgba(201, 162, 75, 0.4);
      color: var(--gold);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 10;
      cursor: pointer;
      transition: all 0.3s ease;
  }
  .home-pkg-arrow:hover {
      background: var(--gold);
      color: #000000;
  }
  .home-pkg-arrow.prev-btn { left: -10px; }
  .home-pkg-arrow.next-btn { right: -10px; }

  .home-pkg-dots {
      display: flex;
      justify-content: center;
      gap: 0.6rem;
      margin-top: 1rem;
  }
  .home-pkg-dot {
      display: inline-block;
      width: 9px;
      height: 9px;
      border-radius: 50%;
      background: transparent;
      border: 1px solid rgba(255, 255, 255, 0.5);
      cursor: pointer;
      transition: all 0.25s ease;
  }
  .home-pkg-dot.active {
      background: var(--gold);
      border-color: var(--gold);
      transform: scale(1.1);
      box-shadow: 0 0 6px var(--gold);
  }

  @media (max-width: 991.98px) {
      .package-card-slide {
          width: calc(50% - 0.75rem);
      }
      .home-pkg-arrow.prev-btn { left: 5px; }
      .home-pkg-arrow.next-btn { right: 5px; }
  }
  @media (max-width: 767.98px) {
      .package-card-slide {
          width: 100%;
      }
      .home-pkg-arrow.prev-btn { left: 0; }
      .home-pkg-arrow.next-btn { right: 0; }
  }
</style>
@endpush


