@extends('layouts.app')

@section('title', 'Curated Bridal Packages — RANISAHAB Luxury')

@section('content')
<div class="bp-page-wrap">
  <div class="container">
    
    <!-- Breadcrumb -->
    <div class="plp-breadcrumb mb-4">
      <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i></a>
      <span class="plp-bc-sep">/</span>
      <span>Bridal Packages</span>
    </div>

    <!-- Page Header with Ornate Dividers -->
    <div class="text-center mb-5 mt-2">
      <div class="d-flex justify-content-center align-items-center mb-2">
        <span style="width: 50px; height: 1px; background: linear-gradient(to left, var(--gold), transparent);"></span>
        <i class="fa-solid fa-crown text-gold px-2" style="font-size: 1.1rem;"></i>
        <span style="width: 50px; height: 1px; background: linear-gradient(to right, var(--gold), transparent);"></span>
      </div>
      <h1 class="font-display text-gold mb-1" style="font-size: 2.5rem; letter-spacing: 0.04em; font-weight: 400; text-transform: uppercase;">BRIDAL PACKAGES</h1>
      <p class="text-ivory opacity-75 font-label" style="font-size: 0.88rem; letter-spacing: 0.12em; font-weight: 300;">Choose Your Royal Experience</p>
      <div style="width: 60px; height: 1px; background: rgba(201,162,75,0.25); margin: 0.8rem auto 0;"></div>
    </div>

    <!-- Custom Packages Grid Wrapper with Swiper Slider Controls -->
    <div class="bp-slider-container-custom position-relative px-md-4">
      
      <!-- Left/Right Slider Arrows -->
      <button class="bp-slider-arrow prev-btn" id="pkgPrevBtn" aria-label="Previous Package"><i class="fa-solid fa-chevron-left"></i></button>
      <button class="bp-slider-arrow next-btn" id="pkgNextBtn" aria-label="Next Package"><i class="fa-solid fa-chevron-right"></i></button>

      <div class="bp-slider-track-wrapper">
        <div class="bp-slider-track" id="pkgSliderTrack">
          
          {{-- Loop over packages database record dynamically --}}
          @foreach($packages as $package)
            @php
              // Determine if featured
              $isFeatured = \Illuminate\Support\Str::contains(strtolower($package->name), 'royal') || \Illuminate\Support\Str::contains(strtolower($package->name), 'ranisahab');
              
              // Map images based on keywords
              $image = 'images/pkg_silver.png';
              if (\Illuminate\Support\Str::contains(strtolower($package->name), 'gold')) {
                  $image = 'images/pkg_gold.png';
              } elseif (\Illuminate\Support\Str::contains(strtolower($package->name), 'royal') || \Illuminate\Support\Str::contains(strtolower($package->name), 'ranisahab')) {
                  $image = 'images/pkg_royal.png';
              }
            @endphp
            
            <div class="bp-card-custom {{ $isFeatured ? 'featured' : '' }}">
              @if ($isFeatured)
                <div class="bp-popular-badge-custom">
                  <i class="fa-solid fa-crown text-black me-1" style="font-size:0.6rem;"></i> MOST POPULAR
                </div>
              @endif
              <div class="bp-img-wrap-custom">
                <img src="{{ asset($image) }}" alt="{{ $package->name }}">
              </div>
              <div class="bp-card-body-custom">
                <h3 class="bp-card-name-custom">{{ $package->name }}</h3>
                <p class="bp-card-price-custom">₹{{ number_format($package->price, 0) }}</p>
                
                <ul class="bp-features-list-custom">
                  @if($package->features && is_array($package->features))
                    @foreach($package->features as $feat)
                      <li><i class="fa-solid fa-check text-gold"></i> {{ $feat }}</li>
                    @endforeach
                  @else
                    <li><i class="fa-solid fa-check text-gold"></i> Custom Bridal Wear</li>
                    <li><i class="fa-solid fa-check text-gold"></i> Matching Jewelry Coordination</li>
                    <li><i class="fa-solid fa-check text-gold"></i> Trial Sessions</li>
                  @endif
                </ul>

                <div class="mt-auto">
                  <form action="{{ route('cart.add-package') }}" method="POST">
                    @csrf
                    <input type="hidden" name="package_id" value="{{ $package->id }}">
                    <button type="submit" class="btn-book-custom" style="{{ $isFeatured ? 'background: linear-gradient(90deg, #dcc29b 0%, #c5a880 100%) !important;' : '' }}">BOOK NOW</button>
                  </form>
                </div>
              </div>
            </div>
          @endforeach

        </div>
      </div>

      <!-- Dynamic Mobile/Desktop Slide Indicators -->
      <div class="bp-dots-container-custom text-center mt-4" id="pkgDotsContainer">
        <!-- Generated dynamically by JS -->
      </div>

    </div>

  </div>

<!-- Standalone Reassurance Bar below Packages Grid -->
<div class="bp-features-bar-custom">
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-6 col-lg-3 mb-4 mb-lg-0 text-center">
        <div class="bp-feature-item-custom">
          <i class="fa-solid fa-crown"></i>
          <h6>Premium Quality</h6>
          <p>Assured Designs</p>
        </div>
      </div>
      <div class="col-6 col-lg-3 mb-4 mb-lg-0 text-center">
        <div class="bp-feature-item-custom">
          <i class="fa-solid fa-wand-magic-sparkles"></i>
          <h6>Expert Makeup Artist</h6>
          <p>Professional &amp; Skilled</p>
        </div>
      </div>
      <div class="col-6 col-lg-3 mb-0 text-center">
        <div class="bp-feature-item-custom">
          <i class="fa-solid fa-gift"></i>
          <h6>Luxury Gifts</h6>
          <p>With Every Package</p>
        </div>
      </div>
      <div class="col-6 col-lg-3 mb-0 text-center">
        <div class="bp-feature-item-custom">
          <i class="fa-solid fa-shield-halved"></i>
          <h6>100% Satisfaction</h6>
          <p>Guaranteed Quality</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Ornate Bride Silhouette Quote Box -->
<div class="container pb-5">
  <div class="bp-quote-box-custom">
    <div class="bp-quote-icon-custom">
      <i class="fa-solid fa-person-dress-burst"></i>
    </div>
    <div>
      <p class="bp-quote-text-custom">
        "Every bride deserves to feel like royalty on her special day. Let us make your moments timeless."
      </p>
    </div>
  </div>
</div>
</div>
@endsection

@push('styles')
<style>
  /* Local Luxury Styling Overrides for Curated Packages Swiper Slider */
  .bp-page-wrap {
      background-color: #080706;
      color: var(--ivory);
      padding: 3rem 0;
      overflow: hidden;
  }
  .bp-slider-track-wrapper {
      overflow: hidden;
      width: 100%;
      padding: 1.5rem 0.5rem;
  }
  .bp-slider-track {
      display: flex !important;
      flex-direction: row !important;
      flex-wrap: nowrap !important; /* Prevent cards from wrapping to new lines */
      align-items: stretch !important;
      justify-content: flex-start !important;
      gap: 1.5rem !important;
      transition: transform 0.45s cubic-bezier(0.25, 0.46, 0.45, 0.94) !important;
  }
  .bp-card-custom {
      background: linear-gradient(145deg, #130f0c 0%, #080706 100%);
      border: 1px solid rgba(201, 162, 75, 0.12);
      border-radius: 12px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      position: relative;
      transition: all 0.4s ease;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6);
      width: calc(33.333% - 1rem);
      flex-shrink: 0;
  }
  .bp-card-custom:hover {
      transform: translateY(-8px);
      border-color: rgba(201, 162, 75, 0.35);
      box-shadow: 0 20px 45px rgba(201, 162, 75, 0.15);
  }
  
  /* Scaled layout for middle featured item (Royal Ranisahab) */
  .bp-card-custom.featured {
      border: 1px solid rgba(201, 162, 75, 0.55);
      box-shadow: 0 25px 50px rgba(201, 162, 75, 0.22);
      z-index: 2;
  }
  .bp-card-custom.featured:hover {
      transform: translateY(-8px);
      border-color: rgba(201, 162, 75, 0.8);
      box-shadow: 0 30px 60px rgba(201, 162, 75, 0.32);
  }
  
  .bp-img-wrap-custom {
      position: relative;
      height: 260px;
      overflow: hidden;
  }
  .bp-img-wrap-custom img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center top;
      transition: transform 0.5s ease;
  }
  .bp-card-custom:hover .bp-img-wrap-custom img {
      transform: scale(1.04);
  }
  
  /* Ribbon badge vertical writing orientation */
  .bp-popular-badge-custom {
      position: absolute;
      top: 0;
      right: 20px;
      background: linear-gradient(135deg, #d4af37 0%, #b2946c 100%);
      color: #000000;
      font-family: var(--font-label);
      font-size: 0.62rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      padding: 1.1rem 0.5rem 0.5rem;
      border-radius: 0 0 4px 4px;
      text-transform: uppercase;
      z-index: 10;
      clip-path: polygon(0 0, 100% 0, 100% 100%, 50% 85%, 0 100%);
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
      writing-mode: vertical-rl;
      text-orientation: mixed;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 4px;
  }
  
  .bp-card-body-custom {
      padding: 1.8rem 1.4rem;
      display: flex;
      flex-direction: column;
      flex-grow: 1;
  }
  
  .bp-card-name-custom {
      font-family: var(--font-display);
      font-size: 1.05rem;
      letter-spacing: 0.05em;
      color: var(--ivory);
      margin-bottom: 0.6rem;
      text-transform: uppercase;
      text-align: center;
  }
  
  .bp-card-price-custom {
      font-family: var(--font-display);
      font-size: 1.6rem;
      color: var(--gold);
      font-weight: 400;
      margin-bottom: 1.5rem;
      text-align: center;
  }
  
  .bp-features-list-custom {
      list-style: none;
      padding: 0;
      margin: 0 0 1.8rem;
      text-align: left;
      display: flex;
      flex-direction: column;
      gap: 0.65rem;
  }
  .bp-features-list-custom li {
      font-size: 0.82rem;
      color: rgba(251, 248, 241, 0.72);
      display: flex;
      align-items: center;
      gap: 0.65rem;
  }
  .bp-features-list-custom li i {
      color: var(--gold);
      font-size: 0.75rem;
  }
  
  /* Solid warm gold button styling */
  .btn-book-custom {
      background: linear-gradient(90deg, #c5a880 0%, #b2946c 100%) !important;
      color: #000000 !important;
      font-family: var(--font-label) !important;
      font-weight: 700 !important;
      font-size: 0.78rem !important;
      letter-spacing: 0.12em !important;
      text-transform: uppercase !important;
      padding: 0.8rem 1.8rem !important;
      border: none !important;
      border-radius: 4px !important;
      width: 100% !important;
      transition: all 0.3s ease !important;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2) !important;
  }
  .btn-book-custom:hover {
      background: linear-gradient(90deg, #dcc29b 0%, #c5a880 100%) !important;
      transform: translateY(-1px);
      box-shadow: 0 8px 20px rgba(197, 168, 128, 0.3) !important;
  }
  
  /* Standalone bottom feature bar */
  .bp-features-bar-custom {
      background-color: #0c0a09;
      border-top: 1px solid rgba(201, 162, 75, 0.15);
      border-bottom: 1px solid rgba(201, 162, 75, 0.15);
      padding: 2rem 0;
      margin-bottom: 3.5rem;
  }
  .bp-feature-item-custom {
      text-align: center;
      color: var(--ivory);
  }
  .bp-feature-item-custom i {
      font-size: 1.6rem;
      color: var(--gold);
      margin-bottom: 0.6rem;
      display: block;
  }
  .bp-feature-item-custom h6 {
      font-family: var(--font-label);
      font-size: 0.75rem;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      margin-bottom: 0.2rem;
      font-weight: 600;
      color: var(--gold-light);
  }
  .bp-feature-item-custom p {
      font-size: 0.7rem;
      color: rgba(251, 248, 241, 0.5);
      margin: 0;
  }

  /* Bride Silhouette Quote Box */
  .bp-quote-box-custom {
      border: 1px solid rgba(201, 162, 75, 0.2);
      background: rgba(255, 255, 255, 0.015);
      border-radius: 8px;
      padding: 1.5rem 2.2rem;
      max-width: 680px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      gap: 1.5rem;
  }
  .bp-quote-icon-custom {
      font-size: 2.2rem;
      color: var(--gold);
      opacity: 0.8;
  }
  .bp-quote-text-custom {
      font-family: var(--font-display);
      font-size: 0.95rem;
      color: rgba(251, 248, 241, 0.85);
      line-height: 1.5;
      margin: 0;
      font-style: italic;
  }

  /* Slider arrows style */
  .bp-slider-arrow {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background: rgba(8, 7, 6, 0.8);
      border: 1px solid rgba(201, 162, 75, 0.4);
      color: var(--gold);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 10;
      cursor: pointer;
      transition: all 0.3s ease;
  }
  .bp-slider-arrow:hover {
      background: var(--gold);
      color: #000000;
  }
  .bp-slider-arrow.prev-btn { left: -20px; }
  .bp-slider-arrow.next-btn { right: -20px; }

  .bp-dots-container-custom {
      display: flex;
      justify-content: center;
      gap: 0.6rem;
      margin-top: 1rem;
  }

  .bp-dot {
      display: inline-block;
      width: 9px;
      height: 9px;
      border-radius: 50%;
      background: transparent;
      border: 1px solid rgba(255, 255, 255, 0.5);
      cursor: pointer;
      transition: all 0.25s ease;
  }
  .bp-dot.active {
      background: var(--gold);
      border-color: var(--gold);
      transform: scale(1.1);
      box-shadow: 0 0 6px var(--gold);
  }
  
  @media (max-width: 991.98px) {
      .bp-card-custom {
          width: calc(50% - 0.75rem);
      }
      .bp-slider-arrow.prev-btn { left: 5px; }
      .bp-slider-arrow.next-btn { right: 5px; }
  }

  @media (max-width: 767.98px) {
      .bp-card-custom {
          width: 100%;
      }
      .bp-slider-arrow.prev-btn { left: 0; }
      .bp-slider-arrow.next-btn { right: 0; }
      .bp-feature-item-custom {
          margin-bottom: 1.5rem;
      }
      .bp-quote-box-custom {
          flex-direction: column;
          text-align: center;
          padding: 1.25rem 1.5rem;
      }
  }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const track = document.getElementById('pkgSliderTrack');
    const cards = document.querySelectorAll('.bp-card-custom');
    const prevBtn = document.getElementById('pkgPrevBtn');
    const nextBtn = document.getElementById('pkgNextBtn');
    const dotsContainer = document.getElementById('pkgDotsContainer');
    
    if (!track || cards.length === 0) return;

    let itemsPerPage = 3;
    if (window.innerWidth < 768) {
        itemsPerPage = 1;
    } else if (window.innerWidth < 992) {
        itemsPerPage = 2;
    }

    let currentIndex = 0;
    let maxIndex = Math.max(0, cards.length - itemsPerPage);

    // Create pagination dots dynamically based on number of possible slide pages
    function createDots() {
        dotsContainer.innerHTML = '';
        const pagesCount = cards.length - itemsPerPage + 1;
        if (pagesCount <= 1) return; // No dots needed if all fit on one page
        
        for (let i = 0; i < pagesCount; i++) {
            const dot = document.createElement('span');
            dot.className = 'bp-dot' + (i === currentIndex ? ' active' : '');
            dot.setAttribute('data-index', i);
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

        // Update active class on dots
        const dots = dotsContainer.querySelectorAll('.bp-dot');
        dots.forEach((dot, idx) => {
            if (idx === currentIndex) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });

        // Toggle arrow disabled state/opacity
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

    // Handle viewport resizing
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

    // Initial setup
    createDots();
    updateSlider();
});
</script>
@endpush
