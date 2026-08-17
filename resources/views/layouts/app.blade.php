<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RANISAHAB — Luxury Fashion for Every Woman | Sarees, Lehengas & Bridal Wear')</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('meta_description', 'RANISAHAB is India’s premium luxury bridal house offering 100% certified pure silk sarees, designer lehengas, and custom bridal wear directly from master weavers.')">
    <meta name="keywords" content="@yield('meta_keywords', 'sarees, lehengas, designer suits, bridal wear, banarasi silk saree, wedding outfits, customized lehenga, Kanjeevaram sarees, luxury fashion')">
    <meta name="author" content="RANISAHAB">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">
    <link rel="canonical" href="{{ request()->url() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:title" content="@yield('title', 'RANISAHAB — Luxury Fashion for Every Woman')">
    <meta property="og:description" content="@yield('meta_description', 'Discover premium luxury sarees, designer lehengas, and custom bridal couture at RANISAHAB. Direct from master weavers with certified exclusivity.')">
    <meta property="og:image" content="@yield('meta_og_image', asset('images/logo.png'))">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ request()->url() }}">
    <meta name="twitter:title" content="@yield('title', 'RANISAHAB — Luxury Fashion for Every Woman')">
    <meta name="twitter:description" content="@yield('meta_description', 'Discover premium luxury sarees, designer lehengas, and custom bridal couture at RANISAHAB.')">
    <meta name="twitter:image" content="@yield('meta_og_image', asset('images/logo.png'))">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ file_exists(public_path('css/style.css')) ? filemtime(public_path('css/style.css')) : time() }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}?v={{ file_exists(public_path('style.css')) ? filemtime(public_path('style.css')) : time() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .border-gold { border: 1px solid var(--gold) !important; }
        .text-gold { color: var(--gold) !important; }

        /* Bulletproof Mobile Navigation Vertical Alignment Fix */
        @media (max-width: 991.98px) {
            .nav-ranisahab-menu {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 0.35rem !important;
                padding: 1.2rem 1rem 1.2rem 2.5rem !important;
            }
            .nav-ranisahab-menu .nav-item {
                width: 100% !important;
                max-width: 260px !important;
                text-align: left !important;
            }
            .nav-ranisahab-menu .nav-item:not(:last-child)::after,
            .nav-ranisahab-menu .nav-item::after {
                display: none !important;
            }
            .nav-ranisahab-menu .nav-link {
                font-size: 0.78rem !important;
                padding: 0.65rem 1rem !important;
                letter-spacing: 0.14em !important;
                text-align: left !important;
                display: flex !important;
                align-items: center !important;
                justify-content: flex-start !important;
                border-radius: 4px !important;
                background: rgba(255, 255, 255, 0.02) !important;
                border: 1px solid rgba(201, 162, 75, 0.12) !important;
                width: 100% !important;
            }
            .nav-ranisahab-menu .nav-link.active {
                background: linear-gradient(90deg, rgba(90, 11, 22, 0.9) 0%, rgba(20, 15, 12, 0.95) 100%) !important;
                border-color: var(--gold) !important;
                color: var(--gold-light) !important;
                box-shadow: 0 4px 15px rgba(201, 162, 75, 0.25) !important;
            }
            .nav-ranisahab-menu .nav-link i {
                color: var(--gold) !important;
                font-size: 0.9rem !important;
                width: 24px !important;
                text-align: center !important;
                margin-right: 0.8rem !important;
                display: inline-block !important;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- Top Announcement Bar -->
<div class="top-strip">
  <div class="container">
    <i class="fa-solid fa-crown me-2"></i> FREE EXPRESS SHIPPING ABOVE ₹5,000 &nbsp;✦&nbsp; PREMIUM QUALITY COLLECTION
  </div>
</div>

<!-- Header / Main Brand Area -->
<header class="navbar-ranisahab">
  <div class="container header-three-col flex-nowrap align-items-center">
    
    <!-- Left: Mobile Toggle & Desktop Search Bar -->
    <div class="header-col-left">
      <!-- Desktop Search Bar -->
      <form action="{{ route('search') }}" method="GET" class="header-search-bar d-none d-lg-block m-0">
        <input type="text" name="q" placeholder="Search sarees, suits, lehengas..." value="{{ request('q') }}" required>
        <button type="submit" style="background:none; border:none; padding:0; color:var(--text-color); position:absolute; right:14px; top:50%; transform:translateY(-50%); z-index:10;"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
      <!-- Mobile Menu Toggle Button -->
      <button class="mobile-nav-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa-solid fa-bars-staggered"></i>
        <span>MENU</span>
      </button>
    </div>

    <!-- Center: Brand Logo -->
    <div class="header-col-center">
      <a href="{{ route('home') }}">
        <img src="{{ asset('images/logo.png') }}" alt="RANISAHAB — Luxury Fashion for Every Woman" class="brand-logo-img">
      </a>
    </div>

    <!-- Right: Nav Actions & Mobile Search/Cart -->
    <div class="header-col-right">
      <div class="nav-actions d-flex align-items-center">
        <!-- Search Trigger for Mobile/Tablet -->
        <button class="mobile-search-btn d-lg-none me-2" type="button" data-bs-toggle="collapse" data-bs-target="#mobileSearchBar" aria-expanded="false" style="background:none; border:none; color:var(--ivory-dark); font-size:1.05rem; padding:0;">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>

        @if(auth()->check())
          <a href="{{ auth()->user()->is_admin ? route('admin.dashboard') : route('customer.dashboard') }}" class="action-icon ms-2 ms-lg-3"><i class="fa-regular fa-user"></i><span class="d-none d-lg-inline-flex ms-1">ACCOUNT</span></a>
        @else
          <a href="{{ route('customer.login') }}" class="action-icon ms-2 ms-lg-3"><i class="fa-regular fa-user"></i><span class="d-none d-lg-inline-flex ms-1">ACCOUNT</span></a>
        @endif
        
        <a href="{{ route('customer.wishlist') }}" class="action-icon ms-2 ms-lg-3"><i class="fa-regular fa-heart"></i><span class="d-none d-lg-inline-flex ms-1">WISHLIST</span></a>
        
        <a href="{{ route('checkout') }}" class="action-icon ms-2 ms-lg-3">
          <i class="fa-solid fa-bag-shopping"></i>
          <span class="d-none d-lg-inline-flex ms-1">BAG</span>
          <span class="badge-cart" id="headerCartCount">{{ collect(session('cart', []))->sum('quantity') }}</span>
        </a>
      </div>
    </div>

  </div>

  <!-- Expandable Mobile Search Bar -->
  <div class="collapse d-lg-none" id="mobileSearchBar">
    <div class="container py-2 px-3">
      <form action="{{ route('search') }}" method="GET" class="mobile-search-box">
        <input type="text" name="q" class="form-control" placeholder="Search sarees, suits..." value="{{ request('q') }}" required>
        <button class="btn btn-gold-sm" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
    </div>
  </div>

  <!-- Primary Navigation Menu & Collapsible Mobile Drawer -->
  <nav class="navbar navbar-expand-lg navbar-dark nav-menu-bar-container py-0">
    <div class="container px-md-0">
      <div class="collapse navbar-collapse justify-content-center" id="navMain">
        <ul class="navbar-nav nav-ranisahab-menu text-center py-2 py-lg-0">
          {{-- Mobile Menu Account Welcome Card --}}
          @if(auth()->check())
            <li class="nav-item d-lg-none w-100 py-2 px-3 mb-2" style="background: rgba(201,162,75,0.06); border-radius: 6px; border: 1px solid rgba(201,162,75,0.15);">
                <div class="d-flex align-items-center justify-content-between">
                    <span class="text-gold-light fw-bold" style="font-size: 0.78rem;"><i class="fa-solid fa-crown text-gold me-2"></i>HELLO, {{ strtoupper(auth()->user()->first_name) }}!</span>
                    <a href="{{ auth()->user()->is_admin ? route('admin.dashboard') : route('customer.dashboard') }}" class="btn btn-sm py-1 px-3" style="background:var(--gold); color:#000; font-family:var(--font-label); font-weight:700; font-size: 0.62rem; letter-spacing:0.05em; border-radius:4px;">DASHBOARD</a>
                </div>
            </li>
          @else
            <li class="nav-item d-lg-none w-100 py-2 px-3 mb-2" style="background: rgba(255,255,255,0.03); border-radius: 6px; border: 1px solid rgba(255,255,255,0.05);">
                <div class="d-flex align-items-center justify-content-between">
                    <span style="font-size: 0.72rem; color:rgba(255,255,255,0.5);">Welcome, Boutique Guest</span>
                    <a href="{{ route('customer.login') }}" class="btn btn-sm py-1 px-3" style="background:var(--gold); color:#000; font-family:var(--font-label); font-weight:700; font-size: 0.62rem; letter-spacing:0.05em; border-radius:4px;">SIGN IN / JOIN</a>
                </div>
            </li>
          @endif

          <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}"><i class="fa-solid fa-house me-2 d-lg-none"></i>HOME</a></li>
          
          {{-- Wishlist for mobile --}}
          <li class="nav-item d-lg-none">
            <a class="nav-link {{ request()->routeIs('customer.wishlist') ? 'active' : '' }}" href="{{ route('customer.wishlist') }}">
              <i class="fa-solid fa-heart me-2 d-lg-none"></i>MY WISHLIST
            </a>
          </li>
          
          {{-- Dynamic Category Menu Links --}}
          @php
            $navCategories = \App\Models\Category::where('is_active', true)->orderBy('id', 'asc')->get();
          @endphp
          @foreach($navCategories as $cat)
            @php
              // Map database category slug to predefined routes
              $routeName = $cat->slug;
              if ($cat->slug === 'bridal-wear') {
                  $routeName = 'bridal-collection';
              }
              $isActive = request()->routeIs($routeName);
              
              // Select class-matching icons for responsive layout drawer
              $icon = 'fa-tag';
              if ($cat->slug === 'sarees') $icon = 'fa-gem';
              elseif ($cat->slug === 'suits') $icon = 'fa-shirt';
              elseif ($cat->slug === 'lehengas') $icon = 'fa-wand-magic-sparkles';
              elseif ($cat->slug === 'bridal-wear') $icon = 'fa-crown';
            @endphp
            <li class="nav-item">
              <a class="nav-link {{ $isActive ? 'active' : '' }}" href="{{ Route::has($routeName) ? route($routeName) : '#' }}">
                <i class="fa-solid {{ $icon }} me-2 d-lg-none"></i>{{ strtoupper($cat->name) }}
              </a>
            </li>
          @endforeach

          <li class="nav-item"><a class="nav-link {{ request()->routeIs('bridal-packages') ? 'active' : '' }}" href="{{ route('bridal-packages') }}"><i class="fa-solid fa-box-open me-2 d-lg-none"></i>BRIDAL PACKAGES</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('makeup-services') ? 'active' : '' }}" href="{{ route('makeup-services') }}"><i class="fa-solid fa-spa me-2 d-lg-none"></i>MAKEUP SERVICES</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('custom-lehenga') ? 'active' : '' }}" href="{{ route('custom-lehenga') }}"><i class="fa-solid fa-scissors me-2 d-lg-none"></i>CUSTOM LEHENGA</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}"><i class="fa-solid fa-images me-2 d-lg-none"></i>GALLERY</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}"><i class="fa-solid fa-circle-info me-2 d-lg-none"></i>ABOUT US</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}"><i class="fa-solid fa-envelope me-2 d-lg-none"></i>CONTACT</a></li>
        </ul>
        
        <!-- Mobile Quick Contact Strip inside collapsed menu -->
        <div class="mobile-menu-footer d-lg-none mt-3 pt-3 border-top border-warning border-opacity-25 text-center">
          <div class="d-flex justify-content-center gap-3 mb-2">
            <a href="tel:+911234567890" class="btn btn-outline-gold btn-sm"><i class="fa-solid fa-phone me-1"></i>CALL US</a>
            <a href="#" class="btn btn-whatsapp btn-sm"><i class="fa-brands fa-whatsapp me-1"></i>WHATSAPP</a>
          </div>
          <p class="small text-muted mb-0" style="font-size:0.68rem;">PAN-INDIA EXPRESS DELIVERY &amp; 100% HANDLOOM GUARANTEE</p>
        </div>
      </div>
    </div>
  </nav>
</header>

<main>
    @yield('content')
</main>

<!-- Black Features Bar -->
<div class="black-features-bar">
  <div class="container">
    <div class="row g-4 text-center text-md-start">
      <div class="col-6 col-md-3">
        <div class="feature-pill-item justify-content-center justify-content-md-start">
          <i class="fa-solid fa-gem"></i>
          <div>
            <h6>PREMIUM QUALITY</h6>
            <p>You Deserve The Best</p>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="feature-pill-item justify-content-center justify-content-md-start">
          <i class="fa-solid fa-tag"></i>
          <div>
            <h6>AFFORDABLE PRICES</h6>
            <p>Luxury at Low Prices</p>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="feature-pill-item justify-content-center justify-content-md-start">
          <i class="fa-solid fa-headset"></i>
          <div>
            <h6>CUSTOMER SUPPORT</h6>
            <p>We Are Here For You</p>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="feature-pill-item justify-content-center justify-content-md-start">
          <i class="fa-solid fa-truck"></i>
          <div>
            <h6>ON TIME DELIVERY</h6>
            <p>5-7 Days Express Delivery</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
@php
  $storePhone = \App\Models\Setting::getVal('store_phone', '+91 98765 43210');
  $storeEmail = \App\Models\Setting::getVal('store_email', 'Ranisahab01@gmail.com');
  $storeWhatsapp = \App\Models\Setting::getVal('store_whatsapp', '919876543210');
  $instagramUrl = \App\Models\Setting::getVal('instagram_url', 'https://instagram.com/ranisahabofficial');
  $facebookUrl = \App\Models\Setting::getVal('facebook_url', 'https://facebook.com/ranisahabofficial');
  $youtubeUrl = \App\Models\Setting::getVal('youtube_url', 'https://youtube.com/@ranisahab');
  $pinterestUrl = \App\Models\Setting::getVal('pinterest_url', 'https://pinterest.com/ranisahab');
@endphp
<footer class="footer-ranisahab">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-4">
        <div class="mb-3">
          <a href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="RANISAHAB Logo" class="brand-logo-img logo-lg mb-2">
          </a>
        </div>
        <p class="small text-muted mb-3" style="line-height:1.6;">RANISAHAB is India’s premium luxury bridal house offering certified pure silk sarees, designer lehengas, and custom bridal wear directly from master weavers.</p>
        <div class="d-flex gap-2 mb-3">
          <a href="{{ $instagramUrl }}" target="_blank" rel="noopener" class="social-icon-btn"><i class="fa-brands fa-instagram"></i></a>
          <a href="{{ $facebookUrl }}" target="_blank" rel="noopener" class="social-icon-btn"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="{{ $youtubeUrl }}" target="_blank" rel="noopener" class="social-icon-btn"><i class="fa-brands fa-youtube"></i></a>
          <a href="{{ $pinterestUrl }}" target="_blank" rel="noopener" class="social-icon-btn"><i class="fa-brands fa-pinterest-p"></i></a>
        </div>
      </div>

      <div class="col-6 col-lg-2">
        <h6>QUICK LINKS</h6>
        <ul class="list-unstyled d-grid gap-2 mb-0">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="{{ route('about') }}">About Us</a></li>
          <li><a href="{{ route('sarees') }}">Sarees</a></li>
          <li><a href="{{ route('suits') }}">Suits</a></li>
          <li><a href="{{ route('lehengas') }}">Lehengas</a></li>
          <li><a href="{{ route('bridal-collection') }}">Bridal Collection</a></li>
          <li><a href="{{ route('bridal-packages') }}">Bridal Packages</a></li>
          <li><a href="{{ route('makeup-services') }}">Makeup Services</a></li>
          <li><a href="{{ route('contact') }}">Contact Us</a></li>
        </ul>
      </div>

      <div class="col-6 col-lg-3">
        <h6>CUSTOMER SERVICE</h6>
        <ul class="list-unstyled d-grid gap-2 mb-0">
          <li><a href="{{ route('tracking') }}">Track Your Order</a></li>
          <li><a href="{{ Route::has('policies') ? route('policies') . '#shipping' : '#' }}">Shipping &amp; Delivery</a></li>
          <li><a href="{{ Route::has('policies') ? route('policies') . '#returns' : '#' }}">Returns &amp; Refunds</a></li>
          <li><a href="{{ Route::has('policies') ? route('policies') . '#terms' : '#' }}">Terms &amp; Conditions</a></li>
          <li><a href="{{ Route::has('policies') ? route('policies') . '#privacy' : '#' }}">Privacy Policy</a></li>
          <li><a href="{{ Route::has('policies') ? route('policies') . '#faq' : '#' }}">FAQ's</a></li>
        </ul>
      </div>

      <div class="col-lg-3">
        <h6>CONTACT US</h6>
        <ul class="list-unstyled d-grid gap-2 small text-muted mb-3">
          <li><i class="fa-solid fa-phone text-gold me-2"></i>{{ $storePhone }}</li>
          <li><i class="fa-solid fa-envelope text-gold me-2"></i>{{ $storeEmail }}</li>
          <li><i class="fa-solid fa-location-dot text-gold me-2"></i>Pan-India Express Delivery</li>
        </ul>
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $storeWhatsapp) }}?text=Hello%20RANISAHAB%20Team%2C%20I%20have%20an%20inquiry." target="_blank" rel="noopener" class="btn btn-whatsapp"><i class="fa-brands fa-whatsapp me-1 fs-6"></i>Chat on WhatsApp</a>
      </div>
    </div>

    <div class="footer-bottom-line d-flex flex-wrap justify-content-between align-items-center">
      <span>© {{ date('Y') }} RANISAHAB. All Rights Reserved.</span>
      <span>Designed with ❤️ for our lovely customers</span>
    </div>
  </div>
</footer>

<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999; pointer-events: none;">
  <div id="luxuryToast" class="toast align-items-center text-white bg-dark border-gold border-opacity-50" role="alert" aria-live="assertive" aria-atomic="true" style="pointer-events: auto;">
    <div class="d-flex">
      <div class="toast-body">
        <i class="fa-solid fa-crown text-gold me-2"></i> <span id="toastMessage">Item added to bag!</span>
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function showToast(message) {
    const toastEl = document.getElementById('luxuryToast');
    const toastMsg = document.getElementById('toastMessage');
    if (toastEl && toastMsg) {
      toastMsg.innerHTML = '<i class="fa-solid fa-crown text-gold me-2"></i>' + message;
      const toast = new bootstrap.Toast(toastEl, { delay: 3500 });
      toast.show();
    }
  }

  // Global AJAX handler for Add to Cart / Shopping Bag
  function addToBag(productId, qty = 1, size = 'Free Size', color = 'Maroon') {
    fetch("{{ route('cart.add') }}", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        "Accept": "application/json"
      },
      body: JSON.stringify({
        product_id: productId,
        quantity: qty,
        size: size,
        color: color
      })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        showToast(data.message || 'Item added to your shopping bag!');
        // Update header cart counter badge
        const headerCartCount = document.getElementById('headerCartCount');
        if (headerCartCount) {
          headerCartCount.textContent = data.cart_count;
        }
        const cartBadges = document.querySelectorAll('.header-cart-badge, .cart-count-badge, .badge-cart');
        cartBadges.forEach(badge => {
          badge.textContent = data.cart_count;
        });
      } else {
        showToast(data.message || 'Failed to add item to shopping bag.');
      }
    })
    .catch(err => {
      console.error('Error adding to bag:', err);
      showToast('An error occurred while adding to bag.');
    });
  }

  // Global AJAX handler for Toggle Wishlist
  function toggleWishlist(productId, btnElement) {
    fetch("{{ route('customer.wishlist.toggle') }}", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        "Accept": "application/json"
      },
      body: JSON.stringify({
        product_id: productId
      })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        showToast(data.message);
        if (btnElement) {
          const icon = btnElement.querySelector('i');
          if (icon) {
            if (data.action === 'added') {
              icon.classList.remove('fa-regular');
              icon.classList.add('fa-solid', 'text-gold');
            } else {
              icon.classList.remove('fa-solid', 'text-gold');
              icon.classList.add('fa-regular');
            }
          }
        }
      } else {
        showToast(data.message || 'Failed to update wishlist.');
      }
    })
    .catch(err => {
      console.error('Error toggling wishlist:', err);
      showToast('An error occurred while updating wishlist.');
    });
  }

  // Set CSRF Token header globally for AJAX
  window.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  var csrfToken = window.csrfToken;
</script>
@stack('scripts')
</body>
</html>
