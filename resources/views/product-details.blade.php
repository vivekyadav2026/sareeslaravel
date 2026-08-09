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
      <div class="mb-2 d-flex align-items-center gap-2">
        <span class="text-gold font-display fw-bold text-uppercase" style="letter-spacing: 0.14em; font-size: 0.85rem; color: #c9a24b !important;">{{ $product->brand->name ?? 'RANISAHAB SIGNATURE' }}</span>
        @if ($product->is_best_seller)
          <span class="badge fw-bold px-2.5 py-1 text-uppercase" style="background: linear-gradient(90deg, #c5a880 0%, #b2946c 100%); color: #000000 !important; font-size: 0.68rem; letter-spacing: 0.08em; border-radius: 4px; box-shadow: 0 2px 8px rgba(197, 168, 128, 0.3);">BEST SELLER</span>
        @elseif ($product->is_new_arrival)
          <span class="badge bg-danger text-white fw-bold px-2.5 py-1 text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.08em; border-radius: 4px;">NEW ARRIVAL</span>
        @endif
      </div>

      <!-- Title -->
      <h1 class="font-display display-5 text-gold-light mb-3" style="font-weight: 700; letter-spacing: 0.05em;">{{ $product->name }}</h1>

      <!-- Ratings & Reviews -->
      <div class="d-flex align-items-center gap-3 mb-4">
        <span class="text-gold fw-bold"><i class="fa-solid fa-star"></i> {{ $product->average_rating }}</span>
        <span class="text-white-50">|</span>
        <span class="small text-white opacity-90 fw-semibold">{{ $product->reviews_count }} Royal Reviews</span>
        <span class="text-white-50">|</span>
        <span class="text-success small fw-bold"><i class="fa-solid fa-circle-check me-1"></i>In Stock</span>
      </div>

      <!-- Pricing Block -->
      <div class="mb-4 p-3 p-md-4 rounded-3" style="background: linear-gradient(135deg, rgba(60, 8, 15, 0.6) 0%, rgba(18, 14, 11, 0.85) 100%); border: 1px solid rgba(201, 162, 75, 0.45); box-shadow: 0 10px 25px rgba(0,0,0,0.5);">
        <div class="d-flex align-items-baseline gap-3 mb-2">
          <span class="fs-2 fw-bold font-display" style="color: #f3dfb2 !important; letter-spacing: 0.04em;">₹{{ number_format($product->price, 0) }}</span>
          @if ($product->sale_price)
            <span class="text-white-50 text-decoration-line-through fs-5">₹{{ number_format($product->sale_price, 0) }}</span>
            <span class="badge bg-warning text-dark font-label fw-bold px-2 py-1">SPECIAL OFFER</span>
          @endif
        </div>
        <p class="small mb-0" style="color: #ded6c8 !important; font-size: 0.84rem; line-height: 1.5; letter-spacing: 0.02em;">
          <i class="fa-solid fa-truck-fast text-gold me-1"></i> Inclusive of all GST taxes &bull; Free express delivery across India.
        </p>
      </div>

      <!-- Description -->
      <div class="mb-4">
        <h6 class="text-gold font-display text-uppercase border-bottom border-warning border-opacity-25 pb-2 mb-2" style="color: #c9a24b !important; letter-spacing: 0.14em; font-size: 0.95rem;">COUTURE DESCRIPTION &amp; CRAFTSMANSHIP</h6>
        <p style="line-height: 1.75; color: #ece3d3 !important; font-size: 0.92rem; letter-spacing: 0.015em; font-weight: 400;">
          {{ $product->description ?: ($product->summary ?: 'Exquisite royal creation handcrafted with pure silk fabrics, intricate hand-embroidery, and traditional zari artistry by master handloom weavers.') }}
        </p>
      </div>

      <!-- Sizing Options -->
      <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <label class="text-gold fw-bold font-label text-uppercase" style="color: #f3dfb2 !important; letter-spacing: 0.1em; font-size: 0.85rem;">SELECT COUTURE SIZE</label>
          <a href="{{ route('customer.measurements') }}" class="small text-gold text-decoration-underline font-label" style="color: #c9a24b !important; letter-spacing: 0.05em;"><i class="fa-solid fa-ruler me-1"></i>Sizing Spec Sheet</a>
        </div>
        <div class="d-flex flex-wrap gap-2" id="coutureSizeButtons">
          @if ($product->variants && $product->variants->where('size', '!=', null)->isNotEmpty())
            @foreach($product->variants->pluck('size')->unique() as $sz)
              <button type="button" class="btn btn-outline-gold cout-size-btn {{ $loop->first ? 'active' : '' }} px-3.5 py-2 font-display text-uppercase" style="font-size: 0.8rem; letter-spacing: 0.08em;" onclick="selectCoutureSize(this, '{{ $sz }}')">
                {{ $sz }}
              </button>
            @endforeach
          @else
            <button type="button" class="btn btn-outline-gold cout-size-btn active px-3.5 py-2 font-display text-uppercase" style="font-size: 0.8rem; letter-spacing: 0.08em;" onclick="selectCoutureSize(this, 'Free Size (Unstitched)')">
              Free Size (Unstitched)
            </button>
            <button type="button" class="btn btn-outline-gold cout-size-btn px-3.5 py-2 font-display text-uppercase" style="font-size: 0.8rem; letter-spacing: 0.08em;" onclick="selectCoutureSize(this, 'Custom Stitched')">
              <i class="fa-solid fa-scissors me-1 text-gold"></i> Custom Stitched
            </button>
          @endif
        </div>
        <div class="p-3 rounded-3 mt-3 d-flex align-items-center gap-2.5" style="background: rgba(201, 162, 75, 0.08); border: 1px solid rgba(201, 162, 75, 0.35) !important;">
          <i class="fa-solid fa-scissors text-gold fs-6 flex-shrink-0" style="color: #c9a24b !important;"></i>
          <span style="color: #ece3d3 !important; font-size: 0.82rem; line-height: 1.5; letter-spacing: 0.01em; margin: 0;">All sarees &amp; lehengas include standard internal fabric margins for personal alterations.</span>
        </div>
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
            class="btn btn-gold flex-grow-1 py-3 d-flex align-items-center justify-content-center gap-2 font-display fw-bold text-dark"
            style="letter-spacing: 0.1em; background: linear-gradient(90deg, #c5a880 0%, #b2946c 100%); border: none;"
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
            <button class="accordion-button collapsed bg-transparent text-gold border-0 fw-bold" style="color: #f3dfb2 !important;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
              ❖ DESIGN DETAILS &amp; FABRIC
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#detailsAccordion">
            <div class="accordion-body text-white opacity-90 small" style="color: #e5cf9b !important; line-height: 1.7;">
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
            <button class="accordion-button collapsed bg-transparent text-gold border-0 fw-bold" style="color: #f3dfb2 !important;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
              ❖ LOGISTICS, DELIVERY &amp; RETURNS
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#detailsAccordion">
            <div class="accordion-body text-white opacity-90 small" style="color: #e5cf9b !important; line-height: 1.7;">
              Handled via <strong>Shiprocket logistics</strong>. We provide free express delivery across India within 3-5 business days. Return requested within 7 days is supported with zero reverse logistics pickup fees.
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

  <!-- You May Also Like / Related Creations -->
  @if(isset($relatedProducts) && $relatedProducts->isNotEmpty())
    <div class="mt-5 pt-4 border-top border-warning border-opacity-15">
      <div class="section-title-wrapper text-center mb-4">
        <span class="motif text-gold">❖</span>
        <h3 class="text-gold-light font-display fs-3 text-uppercase mb-1">YOU MAY ALSO LIKE</h3>
        <p class="text-white opacity-75 small font-label">Complementary Royal Creations From Our Atelier</p>
      </div>
      <div class="row g-3 g-md-4">
        @foreach ($relatedProducts as $rel)
          @include('partials.product_card', ['product' => $rel])
        @endforeach
      </div>
    </div>
  @endif

  </div>
</div>

<!-- Custom Stitched Fitting Details Modal -->
<div class="modal fade" id="customStitchedModal" tabindex="-1" aria-labelledby="customStitchedModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content text-white" style="background: linear-gradient(145deg, #181410 0%, #0c0a08 100%); border: 1px solid rgba(201, 162, 75, 0.4); border-radius: 12px; box-shadow: 0 15px 40px rgba(0,0,0,0.8);">
      <div class="modal-header border-bottom border-warning border-opacity-25 pb-3">
        <h5 class="modal-title font-display text-gold d-flex align-items-center gap-2" id="customStitchedModalLabel">
          <i class="fa-solid fa-scissors text-gold"></i> CUSTOM STITCHING &amp; FITTING SPECIFICATIONS
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body py-4 px-4">
        <div class="alert alert-dark border-gold border-opacity-25 text-gold-light small mb-4">
          <i class="fa-solid fa-crown me-2 text-gold"></i> Our royal master tailors will stitch this {{ $product->name }} according to your exact measurements with padding, lining, and finishing.
        </div>

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label small text-gold fw-bold">Bust / Chest (Inches)</label>
            <input type="number" id="fit_bust" class="form-control bg-dark border-secondary text-white" placeholder="e.g. 36">
          </div>
          <div class="col-md-6">
            <label class="form-label small text-gold fw-bold">Waist (Inches)</label>
            <input type="number" id="fit_waist" class="form-control bg-dark border-secondary text-white" placeholder="e.g. 30">
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label small text-gold fw-bold">Hip Size (Inches)</label>
              <input type="number" id="fit_hip" class="form-control bg-dark border-secondary text-white" placeholder="e.g. 38">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label small text-gold fw-bold">Desired Length / Height</label>
              <input type="text" id="fit_length" class="form-control bg-dark border-secondary text-white" placeholder="e.g. 42 inches / 5ft 5in">
            </div>
          </div>
          <div class="col-12">
            <label class="form-label small text-gold fw-bold">Special Customisation &amp; Neckline Instructions</label>
            <textarea id="fit_notes" class="form-control bg-dark border-secondary text-white" rows="3" placeholder="Deep neck preference, sleeve length (e.g. Full Sleeve / Elbow length), padding preference..."></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer border-top border-warning border-opacity-15">
        <button type="button" class="btn btn-outline-secondary px-4 text-white" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-gold px-4 fw-bold font-label text-dark" onclick="confirmCustomFitting()" style="background: linear-gradient(90deg, #c5a880 0%, #b2946c 100%); border: none;">
          <i class="fa-solid fa-circle-check me-1"></i> SAVE FITTING &amp; SELECT CUSTOM SIZE
        </button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
  let selectedCoutureSize = "{{ $product->variants && $product->variants->where('size', '!=', null)->isNotEmpty() ? $product->variants->pluck('size')->filter()->first() : 'Free Size (Unstitched)' }}";

  function selectCoutureSize(btn, sizeName) {
      document.querySelectorAll('.cout-size-btn').forEach(b => {
          b.classList.remove('active');
          b.style.background = 'transparent';
          b.style.color = 'var(--gold)';
      });
      btn.classList.add('active');
      btn.style.background = 'linear-gradient(90deg, #c5a880 0%, #b2946c 100%)';
      btn.style.color = '#000000';
      selectedCoutureSize = sizeName;

      if (sizeName === 'Custom Stitched') {
          const modal = new bootstrap.Modal(document.getElementById('customStitchedModal'));
          modal.show();
      } else {
          showToast("Selected size: " + sizeName);
      }
  }

  function confirmCustomFitting() {
      const bust = document.getElementById('fit_bust').value;
      const waist = document.getElementById('fit_waist').value;
      const modalEl = document.getElementById('customStitchedModal');
      const modal = bootstrap.Modal.getInstance(modalEl);
      if (modal) modal.hide();
      
      selectedCoutureSize = `Custom Stitched (${bust ? 'Bust:' + bust + '"' : 'Custom Specs'})`;
      showToast("Custom fitting measurements saved for your order!");
  }

  function swapMainImage(src, element) {
      document.getElementById('mainProductImg').src = src;
      document.querySelectorAll('.thumb-box').forEach(box => {
          box.style.borderColor = 'rgba(255,255,255,0.1)';
      });
      element.style.borderColor = 'var(--gold)';
  }

  function addToBag(productId) {
      fetch("{{ route('cart.add') }}", {
          method: "POST",
          headers: {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": csrfToken
          },
          body: JSON.stringify({ product_id: productId, quantity: 1, size: selectedCoutureSize })
      })
      .then(res => res.json())
      .then(data => {
          if(data.success) {
              showToast(data.message + " (" + selectedCoutureSize + ")");
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
          body: JSON.stringify({ product_id: productId, quantity: 1, size: selectedCoutureSize })
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
