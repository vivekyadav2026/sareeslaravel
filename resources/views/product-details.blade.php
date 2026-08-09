@extends('layouts.app')

@section('title', $product->name . ' — RANISAHAB Luxury Collection')

@section('content')
<div class="plp-page">
  <div class="container py-5 text-ivory">
  
  <!-- Breadcrumbs -->
  <nav aria-label="breadcrumb" class="mb-4 small text-white-50">
    <ol class="breadcrumb mb-0" style="background: none; padding: 0;">
      <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-gold-light"><i class="fa-solid fa-house me-1"></i>Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route($product->category->slug === 'bridal-wear' ? 'bridal-collection' : $product->category->slug) }}" class="text-gold-light text-capitalize">{{ $product->category->name }}</a></li>
      <li class="breadcrumb-item active text-white" aria-current="page">{{ $product->name }}</li>
    </ol>
  </nav>

  <div class="row g-5">
    
    <!-- Left Column: Product Image Gallery -->
    <div class="col-lg-6">
      <div class="position-sticky" style="top: 100px;">
        <div class="product-main-image-wrap rounded overflow-hidden mb-3" style="border:1px solid rgba(201, 162, 75, 0.35); background:#0c0a09; height: 600px; display: flex; align-items: center; justify-content: center;">
          @if ($product->images && $product->images->isNotEmpty())
            <img id="mainProductImg" src="{{ asset($product->images->first()->file_path) }}" alt="{{ $product->name }}" class="img-fluid w-100 h-100" style="object-fit: cover;">
          @else
            @php
              $mainFallbackImage = 'images/cat_saree.png';
              if ($product->category && $product->category->slug === 'suits') {
                  $mainFallbackImage = 'images/cat_suit.png';
              } elseif ($product->category && $product->category->slug === 'lehengas') {
                  $mainFallbackImage = 'images/cat_lehenga.png';
              } elseif ($product->category && $product->category->slug === 'bridal-wear') {
                  $mainFallbackImage = 'images/cat_bridal.png';
              }
            @endphp
            <img id="mainProductImg" src="{{ asset($mainFallbackImage) }}" alt="{{ $product->name }}" class="img-fluid w-100 h-100" style="object-fit: cover;">
          @endif
        </div>

        <!-- Thumbnail selector (simulated if single, or loops images) -->
        <div class="d-flex gap-2 justify-content-center">
          @if ($product->images && $product->images->isNotEmpty())
            @foreach($product->images as $img)
              <div class="thumb-box rounded overflow-hidden cursor-pointer" onclick="swapMainImage('{{ asset($img->file_path) }}', this)" style="width: 72px; height: 90px; border: 2px solid {{ $loop->first ? 'var(--gold)' : 'rgba(255,255,255,0.1)' }};">
                <img src="{{ asset($img->file_path) }}" alt="thumb" class="w-100 h-100" style="object-fit: cover;">
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </div>

    <!-- Right Column: Product Couture Details -->
    <div class="col-lg-6">
      
      <!-- Brand & Badges -->
      <div class="mb-2">
        <span class="text-gold-light small text-uppercase tracking-wider" style="letter-spacing: 0.15em;">{{ $product->brand->name ?? 'RANISAHAB Signature' }}</span>
        @if ($product->is_best_seller)
          <span class="badge bg-gold text-dark ms-2 small" style="font-size: 0.65rem;">BEST SELLER</span>
        @elseif ($product->is_new_arrival)
          <span class="badge bg-danger text-white ms-2 small" style="font-size: 0.65rem;">NEW ARRIVAL</span>
        @endif
      </div>

      <!-- Title -->
      <h1 class="font-display display-5 text-gold-light mb-3" style="font-weight: 700; letter-spacing: 0.05em;">{{ $product->name }}</h1>

      <!-- Ratings & Reviews -->
      <div class="d-flex align-items-center gap-3 mb-4">
        <span class="text-gold"><i class="fa-solid fa-star"></i> {{ $product->average_rating }}</span>
        <span class="text-muted">|</span>
        <span class="small text-white-50">{{ $product->reviews_count }} Royal Reviews</span>
        <span class="text-muted">|</span>
        <span class="text-success small fw-bold"><i class="fa-solid fa-circle-check me-1"></i>In Stock</span>
      </div>

      <!-- Pricing Block -->
      <div class="mb-4 p-4 rounded" style="background: rgba(90, 11, 22, 0.15); border: 1px solid rgba(201, 162, 75, 0.25);">
        <div class="d-flex align-items-baseline gap-3 mb-1">
          <span class="fs-2 fw-bold text-gold">₹{{ number_format($product->price, 0) }}</span>
          @if ($product->sale_price)
            <span class="text-muted text-decoration-line-through">₹{{ number_format($product->sale_price, 0) }}</span>
          @endif
        </div>
        <p class="small text-muted mb-0">Inclusive of all local GST taxes. Free express shipping across India.</p>
      </div>

      <!-- Description -->
      <div class="mb-4">
        <h5 class="text-gold-light font-display border-bottom pb-2 mb-3">COUTURE DESCRIPTION</h5>
        <p class="text-white-50" style="line-height: 1.8;">{{ $product->description }}</p>
      </div>

      <!-- Sizing Options -->
      <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <label class="text-gold-light fw-bold">SELECT COUTURE SIZE</label>
          <a href="{{ route('customer.measurements') }}" class="small text-gold-light text-decoration-underline"><i class="fa-solid fa-ruler me-1"></i>Sizing Spec Sheet</a>
        </div>
        <div class="d-flex gap-2">
          <button type="button" class="btn btn-outline-gold active px-4 py-2 font-display text-uppercase" style="font-size: 0.8rem;">Free Size (Unstitched)</button>
          <button type="button" class="btn btn-outline-gold px-4 py-2 font-display text-uppercase" style="font-size: 0.8rem;" onclick="showToast('Custom fitting details will be retrieved from your profile!')">Custom Stitched</button>
        </div>
        <small class="text-white-50 d-block mt-2"><i class="fa-solid fa-scissors me-1"></i>All sarees/lehengas include standard sizing margins for personal alterations.</small>
      </div>

      <!-- Action Buttons: Buy Now / Add to Bag / Wishlist -->
      <div class="d-flex flex-column gap-3 mb-5">
        <!-- BUY NOW — primary CTA -->
        <button type="button"
          class="btn w-100 py-3 d-flex align-items-center justify-content-center gap-2 font-display fw-bold"
          style="background: var(--maroon); color: var(--gold-light); border: 1px solid var(--maroon-bright); letter-spacing: 0.12em; font-size: 1rem; border-radius: var(--radius); transition: all 0.2s ease;"
          onmouseover="this.style.background='var(--maroon-bright)'"
          onmouseout="this.style.background='var(--maroon)'"
          onclick="buyNow({{ $product->id }})">
          <i class="fa-solid fa-bolt fs-5"></i> BUY NOW
        </button>

        <!-- ADD TO BAG + WISHLIST side by side -->
        <div class="d-flex gap-3">
          <button type="button"
            class="btn btn-gold flex-grow-1 py-3 d-flex align-items-center justify-content-center gap-2 font-display fw-bold"
            style="letter-spacing: 0.1em;"
            onclick="addToBag({{ $product->id }})">
            <i class="fa-solid fa-bag-shopping fs-5"></i> ADD TO BAG
          </button>
          <button type="button"
            class="btn btn-outline-gold py-3 px-4 d-flex align-items-center justify-content-center gap-2"
            onclick="toggleWishlist({{ $product->id }}, this)"
            title="Add to Wishlist">
            <i class="@if(Auth::check() ? \App\Models\Wishlist::where('customer_id', auth()->user()->customer->id ?? 0)->where('product_id', $product->id)->exists() : in_array($product->id, session('wishlist', []))) fa-solid text-gold @else fa-regular @endif fa-heart fs-5"></i>
          </button>
        </div>
      </div>

      <!-- Sizing Guidelines Details accordion -->
      <div class="accordion luxury-accordion mb-4" id="detailsAccordion">
        <div class="accordion-item bg-transparent border-secondary border-opacity-25 text-white">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent text-gold-light border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
              ❖ DESIGN DETAILS &amp; FABRIC
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#detailsAccordion">
            <div class="accordion-body text-white-50 small">
              @if ($product->category && $product->category->slug === 'sarees')
                This saree couture creation features 100% pure silk yards hand-loomed with metallic gold thread weavers (Zari). It includes matching blouse fabric materials (80cm) with running borders. Recommend dry-clean only to preserve color fastness.
              @elseif ($product->category && $product->category->slug === 'suits')
                This designer suit features premium lightweight fabric, tailored for a flattering silhouette. It includes matching dupatta, bottom wear material, and intricate neckline embroidery details. Recommend dry-clean only to preserve color fastness.
              @elseif ($product->category && $product->category->slug === 'lehengas')
                This exclusive lehenga features a heavy flared gher, premium fabric lining, and detailed handcrafting (Zari, Resham, or Gota Patti work). Includes matching choli and heavy dupatta. Recommend dry-clean only to preserve color fastness.
              @else
                This exclusive couture creation features our signature luxury crafting. Handcrafted with heavy traditional Zardozi and Kundan details on finest fabrics. Custom tailoring and designer fittings included. Recommend dry-clean only.
              @endif
            </div>
          </div>
        </div>
        
        <div class="accordion-item bg-transparent border-secondary border-opacity-25 text-white">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent text-gold-light border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
              ❖ LOGISTICS, DELIVERY &amp; RETURNS
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#detailsAccordion">
            <div class="accordion-body text-white-50 small">
              Handled via <strong>Shiprocket logistics</strong>. We provide free express delivery across India within 3-5 business days. Return requested within 7 days is supported with zero reverse logistics pickup fees.
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

  <!-- Related Products Grid -->
  @if ($relatedProducts && $relatedProducts->isNotEmpty())
    <div class="mt-5 pt-4">
      <div class="section-title-wrapper text-center mb-4">
        <span class="motif text-gold">❖ RELATED CREATIONS ❖</span>
        <h3 class="text-gold font-display text-uppercase" style="letter-spacing: 0.1em;">You May Also Admire</h3>
      </div>

      <div class="row g-4">
        @foreach ($relatedProducts as $rel)
          <div class="col-md-3 col-sm-6">
            <div class="plp-card" style="cursor:pointer;" onclick="window.location='{{ route('product.show', ['slug' => $rel->slug]) }}'">
              <div class="plp-card-img-wrap">
                @if ($rel->images && $rel->images->isNotEmpty())
                  <img src="{{ asset($rel->images->first()->file_path) }}" alt="{{ $rel->name }}" class="plp-card-img">
                @else
                  @php
                    $fallbackImage = 'images/cat_saree.png';
                    if ($rel->category && $rel->category->slug === 'suits') {
                        $fallbackImage = 'images/cat_suit.png';
                    } elseif ($rel->category && $rel->category->slug === 'lehengas') {
                        $fallbackImage = 'images/cat_lehenga.png';
                    } elseif ($rel->category && $rel->category->slug === 'bridal-wear') {
                        $fallbackImage = 'images/cat_bridal.png';
                    }
                  @endphp
                  <img src="{{ asset($fallbackImage) }}" alt="{{ $rel->name }}" class="plp-card-img">
                @endif
                <button class="plp-wishlist-btn" onclick="event.stopPropagation(); toggleWishlist({{ $rel->id }}, this)">
                  <i class="@if(Auth::check() ? \App\Models\Wishlist::where('customer_id', auth()->user()->customer->id ?? 0)->where('product_id', $rel->id)->exists() : in_array($rel->id, session('wishlist', []))) fa-solid text-gold @else fa-regular @endif fa-heart"></i>
                </button>
              </div>
              <div class="plp-card-body">
                <p class="plp-card-name" style="font-size: 0.85rem;">{{ $rel->name }}</p>
                <p class="plp-card-price">₹{{ number_format($rel->price, 0) }}</p>
                <div class="plp-card-footer">
                  <span class="plp-rating"><i class="fa-solid fa-star"></i> {{ $rel->average_rating }}</span>
                  <button class="plp-cart-btn" onclick="event.stopPropagation(); addToBag({{ $rel->id }})"><i class="fa-solid fa-bag-shopping"></i></button>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @endif

  </div>
</div>
@endsection

@push('scripts')
<script>
  function swapMainImage(src, element) {
      document.getElementById('mainProductImg').src = src;
      // Clear all border highlights
      document.querySelectorAll('.thumb-box').forEach(box => {
          box.style.borderColor = 'rgba(255,255,255,0.1)';
      });
      // Highlight selected thumb
      element.style.borderColor = 'var(--gold)';
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
                  icon.className = 'fa-solid fa-heart text-gold fs-5';
              } else {
                  icon.className = 'fa-regular fa-heart fs-5';
              }
          } else {
              window.location.href = "{{ route('customer.login') }}";
          }
      })
      .catch(err => {
          window.location.href = "{{ route('customer.login') }}";
      });
  }
  function buyNow(productId) {
      const btn = event.currentTarget;
      const originalHtml = btn.innerHTML;
      btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin fs-5"></i> PROCESSING...';
      btn.disabled = true;

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
          if (data.success) {
              window.location.href = "{{ route('checkout') }}";
          } else {
              btn.innerHTML = originalHtml;
              btn.disabled = false;
              showToast(data.message || 'Something went wrong. Please try again.');
          }
      })
      .catch(err => {
          btn.innerHTML = originalHtml;
          btn.disabled = false;
          showToast('Error processing request. Please try again.');
      });
  }
</script>
@endpush
