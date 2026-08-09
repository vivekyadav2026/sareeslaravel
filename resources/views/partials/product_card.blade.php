<div class="col-6 col-md-4 col-lg-3 mb-4">
  <div class="plp-card h-100">
    <div class="plp-card-img-wrap">
      <a href="{{ route('product.show', $product->slug) }}">
        @if($product->images && $product->images->isNotEmpty())
          <img src="{{ asset($product->images->first()->file_path) }}" alt="{{ $product->name }}" class="plp-card-img">
        @else
          <img src="{{ asset('images/cat_saree.png') }}" alt="{{ $product->name }}" class="plp-card-img">
        @endif
      </a>

      @if ($product->is_best_seller)
        <span class="plp-badge badge-best">BEST SELLER</span>
      @elseif ($product->is_new_arrival)
        <span class="plp-badge badge-new">NEW ARRIVAL</span>
      @elseif ($product->is_featured)
        <span class="plp-badge badge-excl">EXCLUSIVE</span>
      @endif
      
      <button class="plp-wishlist-btn" onclick="toggleWishlist({{ $product->id }}, this)">
        <i class="@if(Auth::check() ? \App\Models\Wishlist::where('customer_id', auth()->user()->customer->id ?? 0)->where('product_id', $product->id)->exists() : in_array($product->id, session('wishlist', []))) fa-solid text-gold @else fa-regular @endif fa-heart"></i>
      </button>
    </div>
    <div class="plp-card-body d-flex flex-column">
      <p class="plp-card-name mb-1"><a href="{{ route('product.show', $product->slug) }}" class="text-white text-decoration-none">{{ $product->name }}</a></p>
      <p class="plp-card-price mb-2">₹{{ number_format($product->price, 0) }}</p>
      <div class="plp-card-footer mt-auto d-flex justify-content-between align-items-center">
        <span class="plp-rating"><i class="fa-solid fa-star text-gold"></i> {{ $product->average_rating ?? 4.9 }} <span class="plp-rating-count">({{ $product->reviews_count ?? 12 }})</span></span>
        <button class="plp-cart-btn" onclick="addToBag({{ $product->id }})"><i class="fa-solid fa-bag-shopping"></i></button>
      </div>
    </div>
  </div>
</div>
