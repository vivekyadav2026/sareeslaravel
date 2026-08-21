@extends('layouts.app')

@section('title', $product->meta_title ?: ($product->name . ' — RANISAHAB Luxury Collection'))
@section('meta_description', $product->meta_description ?: strip_tags(str_replace('"', "'", $product->description ?: 'Exquisite royal ' . $product->name . ' handcrafted by heritage weavers.')))
@section('meta_keywords', $product->meta_keywords ?: ($product->name . ', ' . $product->category->name . ', ranisahab collection, royal apparel, wedding wear'))
@section('meta_og_image', $product->images && $product->images->isNotEmpty() ? asset($product->images->first()->file_path) : asset('images/logo.png'))

@section('content')
<style>
  .product-main-image-wrap {
      overflow: hidden;
      position: relative;
  }
  .product-main-image-wrap img {
      transition: transform 0.1s ease-out;
      transform-origin: center center;
  }
  .product-main-image-wrap:hover img {
      transform: scale(2.2);
  }
</style>
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
        <div class="product-main-image-wrap rounded overflow-hidden mb-3 position-relative" style="border:1px solid rgba(201, 162, 75, 0.35); background:#0c0a09; height: 580px; display: flex; align-items: center; justify-content: center; cursor: zoom-in;" onclick="openImageZoom()">
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

          <button class="btn btn-dark btn-sm position-absolute bottom-0 end-0 m-3 border-gold text-gold font-label opacity-90" style="font-size: 0.7rem;" type="button" onclick="openImageZoom(event)">
            <i class="fa-solid fa-magnifying-glass-plus me-1"></i> CLICK TO ZOOM
          </button>
        </div>

        <!-- Multi-Angle Gallery Thumbnails -->
        <div class="d-flex gap-2 justify-content-center overflow-x-auto py-1">
          @if ($product->images && $product->images->isNotEmpty())
            @foreach($product->images as $img)
              @php
                $labels = ['Front', 'Back', 'Close-up', 'Full Look', 'Detail'];
                $label = $labels[$loop->index % count($labels)];
              @endphp
              <div class="thumb-box rounded overflow-hidden cursor-pointer position-relative" onclick="swapMainImage('{{ asset($img->file_path) }}', this)" style="width: 76px; height: 92px; border: 2px solid {{ $loop->first ? 'var(--gold)' : 'rgba(255,255,255,0.1)' }}; flex-shrink: 0;">
                <img src="{{ asset($img->file_path) }}" alt="{{ $label }}" class="w-100 h-100" style="object-fit: cover;">
                <span class="badge bg-dark text-gold font-label position-absolute bottom-0 start-0 w-100 rounded-0" style="font-size: 0.52rem; opacity:0.85;">{{ $label }}</span>
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </div>

    <!-- Right Column: Product Couture Details -->
    <div class="col-lg-6">
      
      <!-- Brand & SKU -->
      <div class="mb-2 d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-2">
          <span class="text-gold font-display fw-bold text-uppercase" style="letter-spacing: 0.14em; font-size: 0.85rem; color: #c9a24b !important;">{{ $product->brand->name ?? 'RANISAHAB SIGNATURE' }}</span>
          @if ($product->is_best_seller)
            <span class="badge fw-bold px-2.5 py-1 text-uppercase" style="background: linear-gradient(90deg, #c5a880 0%, #b2946c 100%); color: #000000 !important; font-size: 0.68rem; letter-spacing: 0.08em; border-radius: 4px;">BEST SELLER</span>
          @elseif ($product->is_new_arrival)
            <span class="badge bg-danger text-white fw-bold px-2.5 py-1 text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.08em; border-radius: 4px;">NEW ARRIVAL</span>
          @endif
        </div>
        <span class="badge bg-dark border border-warning border-opacity-25 text-gold-light font-label" style="font-size: 0.7rem; letter-spacing: 0.05em;">PRODUCT CODE: {{ $product->sku ?: ('RS-PRD-' . $product->id) }}</span>
      </div>

      <!-- Title -->
      <h1 class="font-display display-5 text-gold-light mb-3" style="font-weight: 700; letter-spacing: 0.05em;">{{ $product->name }}</h1>

      <!-- Stock & Certification -->
      @php
        $isHandloom = false;
        $searchText = strtolower($product->name . ' ' . ($product->material ?? '') . ' ' . ($product->description ?? ''));
        if (\Illuminate\Support\Str::contains($searchText, ['handloom', 'pure silk', 'zari', 'banarasi', 'kanjivaram', 'chanderi', 'weaver'])) {
            $isHandloom = true;
        }

        $descData = [];
        if ($product->description && str_starts_with($product->description, '{')) {
            $descData = json_decode($product->description, true) ?: [];
        } else {
            $descData['general_desc'] = $product->description ?: 'Exquisite royal ' . $product->name . ' handcrafted by heritage weavers.';
        }
      @endphp
      <div class="d-flex flex-wrap align-items-center gap-2 gap-md-3 mb-4">
        <span class="text-gold-light small fw-semibold"><i class="fa-solid fa-shield-halved text-gold me-1"></i>Quality Checked &amp; Certified</span>
        @if($isHandloom)
          <span class="text-white-50">|</span>
          <span class="text-gold-light small fw-semibold"><i class="fa-solid fa-certificate text-gold me-1"></i>100% Handloom Guarantee</span>
        @endif
        <span class="text-white-50">|</span>
        <span class="text-success small fw-bold"><i class="fa-solid fa-circle-check me-1"></i>In Stock</span>
        <span class="text-white-50">|</span>
        <span class="text-success small fw-bold" style="color: #63d19e !important;"><i class="fa-solid fa-hand-holding-dollar text-gold me-1"></i>COD Available</span>
      </div>

      <!-- Pricing Block -->
      <div class="mb-4 p-3 p-md-4 rounded-3" style="background: linear-gradient(135deg, rgba(60, 8, 15, 0.6) 0%, rgba(18, 14, 11, 0.85) 100%); border: 1px solid rgba(201, 162, 75, 0.45); box-shadow: 0 10px 25px rgba(0,0,0,0.5);">
        <div class="d-flex align-items-baseline gap-3 mb-2">
          <span class="fs-2 fw-bold font-display" style="color: #f3dfb2 !important; letter-spacing: 0.04em;">₹{{ number_format($product->price, 0) }}</span>
          @if ($product->sale_price && $product->sale_price > $product->price)
            <span class="text-white-50 text-decoration-line-through fs-5">₹{{ number_format($product->sale_price, 0) }}</span>
            <span class="badge bg-warning text-dark font-label fw-bold px-2 py-1">SPECIAL OFFER</span>
          @endif
        </div>
        <p class="small mb-0" style="color: #ded6c8 !important; font-size: 0.84rem; line-height: 1.5; letter-spacing: 0.02em;">
          <i class="fa-solid fa-truck-fast text-gold me-1"></i> Inclusive of all GST taxes &bull; <strong>Free Express Shipping</strong> on orders above ₹5,000 (Flat ₹150 for orders below ₹5,000).
        </p>
      </div>


      <!-- Color Options -->
      @php
        $colors = $product->variants && $product->variants->isNotEmpty() ? $product->variants->pluck('color')->filter(fn($c) => !empty($c) && strtolower($c) !== 'default')->unique() : collect();
        $sizes = $product->variants && $product->variants->isNotEmpty() ? $product->variants->pluck('size')->filter(fn($s) => !empty($s) && strtolower($s) !== 'default' && strtolower($s) !== 'free size' && strtolower($s) !== 'free size (unstitched)')->unique() : collect();
      @endphp

      @if($colors->isNotEmpty())
      <div class="mb-4">
        <label class="text-gold fw-bold font-label text-uppercase mb-2" style="color: #f3dfb2 !important; letter-spacing: 0.12em; font-size: 0.82rem;">SELECT COUTURE SHADE / COLOR</label>
        <div class="d-flex flex-wrap gap-2" id="coutureColorButtons">
          @foreach($colors as $color)
            <button type="button" class="btn btn-outline-gold cout-color-btn {{ $loop->first ? 'active' : '' }} px-3.5 py-1.5 font-display text-uppercase" style="font-size: 0.78rem; letter-spacing: 0.08em; @if($loop->first) background: linear-gradient(90deg, #c5a880 0%, #b2946c 100%); color: #000; @endif" onclick="selectCoutureColor(this, '{{ $color }}')">
              <span class="color-dot me-2" style="display:inline-block; width:10px; height:10px; border-radius:50%; background-color: {{ strtolower($color) == 'rose gold' ? '#b76e79' : (strtolower($color) == 'maroon' ? '#800000' : (strtolower($color) == 'crimson' ? '#dc143c' : (strtolower($color) == 'emerald' ? '#50c878' : (strtolower($color) == 'ivory' ? '#fffff0' : (strtolower($color) == 'gold' ? '#ffd700' : (strtolower($color) == 'silver' ? '#c0c0c0' : (strtolower($color) == 'white' ? '#ffffff' : (strtolower($color) == 'red' ? '#ff0000' : strtolower($color))))))))) }}"></span>
              {{ $color }}
            </button>
          @endforeach
        </div>
      </div>
      @endif

      <!-- Sizing Options -->
      <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <label class="text-gold fw-bold font-label text-uppercase" style="color: #f3dfb2 !important; letter-spacing: 0.1em; font-size: 0.85rem;">SELECT COUTURE SIZE / VARIANT</label>
        </div>
        <div class="d-flex flex-nowrap gap-2" id="coutureSizeButtons">
          @if ($sizes->isNotEmpty())
            @foreach($sizes as $sz)
              <button type="button" class="btn btn-outline-gold cout-size-btn flex-fill {{ $loop->first ? 'active' : '' }} p-2 font-display text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em; white-space: normal; line-height: 1.2; @if($loop->first) background: linear-gradient(90deg, #c5a880 0%, #b2946c 100%); color: #000; @endif" onclick="selectCoutureSize(this, '{{ $sz }}')">
                {{ $sz }}
              </button>
            @endforeach
            <button type="button" class="btn btn-outline-gold cout-size-btn flex-fill p-2 font-display text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em; white-space: normal; line-height: 1.2;" onclick="selectCoutureSize(this, 'Custom Stitched')">
              <i class="fa-solid fa-scissors me-1 text-gold"></i> Custom Stitched
            </button>
          @else
            <button type="button" class="btn btn-outline-gold cout-size-btn active flex-fill p-2 font-display text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em; white-space: normal; line-height: 1.2; background: linear-gradient(90deg, #c5a880 0%, #b2946c 100%); color: #000;" onclick="selectCoutureSize(this, 'Free Size (Unstitched)')">
              Free Size (Unstitched)
            </button>
            <button type="button" class="btn btn-outline-gold cout-size-btn flex-fill p-2 font-display text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em; white-space: normal; line-height: 1.2;" onclick="selectCoutureSize(this, 'Custom Stitched')">
              <i class="fa-solid fa-scissors me-1 text-gold"></i> Custom Stitched
            </button>
          @endif
        </div>
      </div>

      <!-- Action Buttons: Buy Now / Add to Cart / Wishlist / Enquire -->
      <div class="d-flex flex-column gap-2 mb-4">
        <!-- BUY NOW + WISHLIST row -->
        <div class="d-flex gap-2">
          <button type="button"
            class="btn flex-grow-1 py-3 d-flex align-items-center justify-content-center gap-2 font-display fw-bold"
            style="background: var(--maroon); color: var(--gold-light); border: 1px solid var(--maroon-bright); letter-spacing: 0.12em; font-size: 1rem; border-radius: var(--radius); transition: all 0.2s ease;"
            onmouseover="this.style.background='var(--maroon-bright)'"
            onmouseout="this.style.background='var(--maroon)'"
            onclick="buyNow({{ $product->id }})">
            <i class="fa-solid fa-bolt fs-5"></i> BUY NOW
          </button>
          <button type="button"
            class="btn btn-outline-gold py-3 px-4 d-flex align-items-center justify-content-center gap-2"
            onclick="toggleWishlist({{ $product->id }}, this)"
            title="Add to Wishlist">
            <i class="@if(Auth::check() ? \App\Models\Wishlist::where('customer_id', auth()->user()->customer->id ?? 0)->where('product_id', $product->id)->exists() : in_array($product->id, session('wishlist', []))) fa-solid text-gold @else fa-regular @endif fa-heart fs-5"></i>
          </button>
        </div>

        <!-- ADD TO CART + ENQUIRE & CUSTOMIZE row -->
        <div class="d-flex gap-2">
          <button type="button"
            class="btn btn-gold flex-grow-1 py-2.5 d-flex align-items-center justify-content-center gap-2 font-display fw-bold text-dark"
            style="letter-spacing: 0.1em; background: linear-gradient(90deg, #c5a880 0%, #b2946c 100%); border: none; font-size: 0.82rem;"
            onclick="addToBag({{ $product->id }})">
            <i class="fa-solid fa-cart-plus fs-5"></i> ADD TO CART
          </button>
          <button type="button"
            class="btn btn-outline-gold flex-grow-1 py-2.5 d-flex align-items-center justify-content-center gap-2 font-display fw-bold"
            style="letter-spacing: 0.1em; font-size: 0.82rem; border-radius: var(--radius);"
            data-bs-toggle="modal"
            data-bs-target="#productEnquiryModal">
            <i class="fa-solid fa-envelope-open-text fs-5"></i> ENQUIRE &amp; CUSTOMIZE
          </button>
        </div>
      </div>

      <!-- Structured Specifications & What's Included Box -->
      <div class="p-3 mb-4 rounded bg-dark border border-warning border-opacity-25">
        <h6 class="text-gold font-display text-uppercase mb-3 pb-2 border-bottom border-secondary" style="font-size: 0.85rem;"><i class="fa-solid fa-list-check me-2"></i>PRODUCT SPECIFICATIONS &amp; WHAT'S INCLUDED</h6>
        <div class="row g-2 small text-white-50" style="line-height: 1.6;">
          <div class="col-6"><strong>Fabric:</strong> {{ $descData['fabric'] ?? ($product->material ?: 'Pure Silk / Handloom Zari') }}</div>
          <div class="col-6"><strong>Work:</strong> {{ $descData['work'] ?? 'Handcrafted Zari / Weaving' }}</div>
          <div class="col-6"><strong>Size:</strong> {{ $descData['size'] ?? 'Free Size (Unstitched)' }}</div>
          <div class="col-6"><strong>Weight:</strong> {{ $descData['weight'] ?? 'Approx 850g - 1.2kg' }}</div>
          <div class="col-6"><strong>Dispatch:</strong> {{ $descData['dispatch_time'] ?? 'Dispatched in 24-48 Hours' }}</div>
          <div class="col-6"><strong>Delivery:</strong> {{ $descData['delivery_time'] ?? '4 to 7 Business Days' }}</div>
          <div class="col-6"><strong>Shipping:</strong> Free above ₹5,000 (Else ₹150)</div>
          @if(!empty($descData['blouse']))
            <div class="col-6"><strong>Blouse:</strong> {{ $descData['blouse'] }}</div>
          @endif
          @if(!empty($descData['lehenga']))
            <div class="col-6"><strong>Lehenga:</strong> {{ $descData['lehenga'] }}</div>
          @endif
          @if(!empty($descData['dupatta']))
            <div class="col-6"><strong>Dupatta:</strong> {{ $descData['dupatta'] }}</div>
          @endif
        </div>
        <hr class="border-secondary my-2">
        <div class="mt-2">
          <strong class="text-gold-light small d-block mb-1"><i class="fa-solid fa-box-open me-1 text-gold"></i>What's Included:</strong>
          <span class="small text-white-50" style="font-size:0.75rem;">
            {{ $descData['whats_included'] ?? ($product->category && $product->category->slug === 'sarees' ? '1 Unstitched Saree (5.5 Meters), 1 Matching Unstitched Blouse Piece (80 cm), 1 Luxury Satin Storage Bag, Authenticity Card.' : ($product->category && $product->category->slug === 'suits' ? '1 Kurta Fabric/Outfit, 1 Bottom Wear Material, 1 Embellished Dupatta, 1 Storage Bag & Fitting Card.' : '1 Semi-Stitched Lehenga (Heavy Flared Gher), 1 Unstitched/Stitched Blouse Piece, 1 Heavy Embellished Dupatta, Storage Bag & Design Certificate.')) }}
          </span>
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
              @if(!empty($descData['general_desc']))
                <p class="mb-3">{{ $descData['general_desc'] }}</p>
              @endif
              <div class="spec-details-list">
                @if(!empty($descData['fabric'])) <div>❖ <strong>Fabric / Material:</strong> {{ $descData['fabric'] }}</div> @endif
                @if(!empty($descData['work'])) <div>❖ <strong>Craftsmanship / Work:</strong> {{ $descData['work'] }}</div> @endif
                @if(!empty($descData['size'])) <div>❖ <strong>Size / Fit:</strong> {{ $descData['size'] }}</div> @endif
                @if(!empty($descData['weight'])) <div>❖ <strong>Weight:</strong> {{ $descData['weight'] }}</div> @endif
                @if(!empty($descData['blouse'])) <div>❖ <strong>Blouse details:</strong> {{ $descData['blouse'] }}</div> @endif
                @if(!empty($descData['lehenga'])) <div>❖ <strong>Lehenga details:</strong> {{ $descData['lehenga'] }}</div> @endif
                @if(!empty($descData['dupatta'])) <div>❖ <strong>Dupatta details:</strong> {{ $descData['dupatta'] }}</div> @endif
              </div>
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

        <div class="accordion-item bg-transparent border-secondary border-opacity-25 text-white">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent text-gold border-0 fw-bold" style="color: #f3dfb2 !important;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
              ❖ PRODUCT Q&amp;A ({{ $product->questions->count() }})
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#detailsAccordion">
            <div class="accordion-body text-white opacity-90 small" style="color: #e5cf9b !important; line-height: 1.7;">
              
              <!-- Session Success / Errors -->
              @if (session('success'))
                  <div class="alert alert-success alert-dismissible fade show bg-transparent border-success text-success mb-3 p-2 small" role="alert">
                      <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close" style="padding: 0.5rem 0.5rem;"></button>
                  </div>
              @endif

              @if ($errors->any())
                  <div class="alert alert-danger alert-dismissible fade show bg-transparent border-danger text-danger mb-3 p-2 small" role="alert">
                      <ul class="mb-0 list-unstyled">
                          @foreach ($errors->all() as $error)
                              <li><i class="fa-solid fa-triangle-exclamation me-2"></i> {{ $error }}</li>
                          @endforeach
                      </ul>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close" style="padding: 0.5rem 0.5rem;"></button>
                  </div>
              @endif

              <!-- Questions List -->
              <div class="d-flex flex-column gap-3 mb-4">
                  @forelse($product->questions as $q)
                      <div class="p-3 rounded-3" style="background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(201, 162, 75, 0.15);">
                          <div class="d-flex justify-content-between align-items-center mb-1">
                              <span class="text-gold fw-bold" style="font-size: 0.8rem;"><i class="fa-solid fa-circle-question me-1 text-gold"></i> Q: {{ $q->question_text }}</span>
                              <span class="text-white-50" style="font-size: 0.65rem;">{{ $q->created_at ? $q->created_at->format('M d, Y') : 'N/A' }}</span>
                          </div>
                          <div class="text-white-50 ps-3" style="font-size: 0.78rem;">
                              Asked by <strong class="text-ivory">{{ $q->customer->first_name ?? 'Valued Customer' }}</strong>
                          </div>
                          @if($q->answer_text)
                              <div class="mt-2 pt-2 border-top border-secondary border-opacity-15 ps-3" style="font-size: 0.78rem;">
                                  <span class="text-gold-light fw-semibold d-block mb-1"><i class="fa-solid fa-reply me-1 text-gold-light"></i> Answer from Designer:</span>
                                  <p class="mb-0 text-ivory opacity-85" style="line-height: 1.5;">{{ $q->answer_text }}</p>
                              </div>
                          @else
                              <div class="mt-2 pt-2 border-top border-secondary border-opacity-15 ps-3 text-white-50" style="font-size: 0.75rem; font-style: italic;">
                                  Answer is pending from design atelier.
                              </div>
                          @endif
                      </div>
                  @empty
                      <p class="text-white-50 text-center py-2 mb-0" style="font-size: 0.78rem;">No questions have been asked about this product yet.</p>
                  @endforelse
              </div>

              <!-- Ask a Question Form -->
              <div class="pt-3 border-top border-secondary border-opacity-15">
                  <h6 class="text-gold font-display text-uppercase mb-2" style="font-size: 0.8rem; letter-spacing: 0.08em;">Have a question about this couture item?</h6>
                  @auth
                      <form action="{{ route('product.question.submit', $product->id) }}" method="POST">
                          @csrf
                          <div class="mb-3">
                              <textarea name="question_text" class="form-control bg-dark border-secondary text-white small" rows="2" placeholder="Ask about fabric weight, customizations, measurements adjustment options..." required style="font-size: 0.78rem;"></textarea>
                          </div>
                          <button type="submit" class="btn btn-sm btn-gold text-dark fw-bold font-label px-4" style="background: linear-gradient(90deg, #c5a880 0%, #b2946c 100%); border: none;">SUBMIT QUESTION</button>
                      </form>
                  @else
                      <div class="p-3 text-center rounded-3" style="background: rgba(201, 162, 75, 0.05); border: 1px solid rgba(201, 162, 75, 0.25);">
                          <p class="text-gold-light mb-2" style="font-size: 0.78rem;">You must be logged in to submit a question to our designers.</p>
                          <a href="{{ route('customer.login') }}" class="btn btn-sm btn-outline-gold fw-bold px-4" style="font-size: 0.75rem;">LOG IN TO ASK <i class="fa-solid fa-right-to-bracket ms-1"></i></a>
                      </div>
                  @endauth
              </div>

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
        <div class="alert border-gold border-opacity-25 text-gold-light small mb-4" style="background-color: rgba(201, 162, 75, 0.08) !important;">
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

<!-- Product Couture Enquiry Modal -->
<div class="modal fade" id="productEnquiryModal" tabindex="-1" aria-labelledby="productEnquiryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-white" style="background: linear-gradient(145deg, #181410 0%, #0c0a08 100%); border: 1px solid rgba(201, 162, 75, 0.4); border-radius: 12px; box-shadow: 0 15px 40px rgba(0,0,0,0.8);">
      <div class="modal-header border-bottom border-warning border-opacity-25 pb-3">
        <h5 class="modal-title font-display text-gold d-flex align-items-center gap-2" id="productEnquiryModalLabel">
          <i class="fa-solid fa-crown text-gold"></i> COUTURE CUSTOMISATION ENQUIRY
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('contact.submit') }}" method="POST">
        @csrf
        <div class="modal-body py-4 px-4 text-start">
          <p class="small text-white-50 mb-3 text-start">Enquire about custom tailoring, specific shade dyes, fabric modifications, or book a session with our designer for this outfit.</p>
          
          <div class="mb-3 text-start">
            <label class="form-label small text-gold fw-bold">Outfit Details</label>
            <input type="text" name="subject" class="form-control bg-dark border-secondary text-white" value="Couture Enquiry: {{ $product->name }} (Code: {{ $product->sku ?: ('RS-PRD-' . $product->id) }})" readonly>
          </div>
          
          <div class="mb-3 text-start">
            <label class="form-label small text-gold fw-bold">Your Full Name</label>
            <input type="text" name="name" class="form-control bg-dark border-secondary text-white" placeholder="e.g. Neha Sharma" required value="{{ auth()->check() ? auth()->user()->name : '' }}">
          </div>
          
          <div class="mb-3 text-start">
            <label class="form-label small text-gold fw-bold">Phone / WhatsApp Number</label>
            <input type="tel" name="phone" class="form-control bg-dark border-secondary text-white" placeholder="+91 98765 43210" value="{{ auth()->check() && auth()->user()->customer ? auth()->user()->customer->phone : '' }}">
          </div>
          
          <div class="mb-3 text-start">
            <label class="form-label small text-gold fw-bold">Email Address</label>
            <input type="email" name="email" class="form-control bg-dark border-secondary text-white" placeholder="name@example.com" required value="{{ auth()->check() ? auth()->user()->email : '' }}">
          </div>
          
          <div class="mb-3 text-start">
            <label class="form-label small text-gold fw-bold">Customisation Requirements / Message</label>
            <textarea name="message" class="form-control bg-dark border-secondary text-white" rows="3" placeholder="Specify neckline changes, sleeve preferences, borders details, or sizing request..." required>I would like to enquire about customizing/purchasing the {{ $product->name }}. Please contact me to discuss the details.</textarea>
          </div>
        </div>
        <div class="modal-footer border-top border-warning border-opacity-15">
          <button type="button" class="btn btn-outline-secondary px-4 text-white" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-gold px-4 fw-bold font-label text-dark" style="background: linear-gradient(90deg, #c5a880 0%, #b2946c 100%); border: none;">
            <i class="fa-solid fa-paper-plane me-1"></i> SEND ENQUIRY NOW
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Image Lightbox Modal -->
<div class="modal fade" id="imageZoomModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content bg-black text-center border-gold p-2">
      <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom border-secondary">
        <span class="text-gold font-display small"><i class="fa-solid fa-crown me-2"></i>{{ $product->name }} — Couture Zoom</span>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0 overflow-auto text-center" style="max-height: 85vh;">
        <img id="modalZoomImg" src="" alt="{{ $product->name }}" class="img-fluid" style="max-height: 82vh; object-fit: contain;">
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
  let selectedCoutureSize = "{{ $product->variants && $product->variants->where('size', '!=', null)->isNotEmpty() ? $product->variants->pluck('size')->filter()->first() : 'Free Size (Unstitched)' }}";
  let selectedColor = "{{ $product->variants && $product->variants->where('color', '!=', null)->where('color', '!=', 'Default')->isNotEmpty() ? $product->variants->where('color', '!=', null)->where('color', '!=', 'Default')->pluck('color')->first() : 'Default' }}";

  function openImageZoom(event) {
      if (event) event.stopPropagation();
      const currentSrc = document.getElementById('mainProductImg').src;
      document.getElementById('modalZoomImg').src = currentSrc;
      const modal = new bootstrap.Modal(document.getElementById('imageZoomModal'));
      modal.show();
  }


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

  function selectCoutureColor(btn, colorName) {
      document.querySelectorAll('.cout-color-btn').forEach(b => {
          b.classList.remove('active');
          b.style.background = 'transparent';
          b.style.color = 'var(--gold)';
      });
      btn.classList.add('active');
      btn.style.background = 'linear-gradient(90deg, #c5a880 0%, #b2946c 100%)';
      btn.style.color = '#000000';
      selectedColor = colorName;
      showToast("Selected color: " + colorName);
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
          body: JSON.stringify({ product_id: productId, quantity: 1, size: selectedCoutureSize, color: selectedColor })
      })
      .then(res => res.json())
      .then(data => {
          if(data.success) {
              showToast(data.message + " (" + selectedCoutureSize + " / " + selectedColor + ")");
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
          body: JSON.stringify({ product_id: productId, quantity: 1, size: selectedCoutureSize, color: selectedColor })
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

  document.addEventListener('DOMContentLoaded', function() {
      const wrap = document.querySelector('.product-main-image-wrap');
      const img = document.getElementById('mainProductImg');
      if (wrap && img) {
          wrap.addEventListener('mousemove', function(e) {
              const rect = wrap.getBoundingClientRect();
              const x = e.clientX - rect.left;
              const y = e.clientY - rect.top;
              const xPercent = (x / rect.width) * 100;
              const yPercent = (y / rect.height) * 100;
              img.style.transformOrigin = `${xPercent}% ${yPercent}%`;
          });
          wrap.addEventListener('mouseleave', function() {
              img.style.transformOrigin = 'center center';
          });
      }
  });
</script>
@endpush
