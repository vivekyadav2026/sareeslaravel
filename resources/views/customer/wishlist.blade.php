@extends('layouts.app')

@section('title', 'My Wishlist — RANISAHAB')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}?v={{ time() }}">
    <style>
        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
            gap: 1.4rem;
        }

        .wishlist-card {
            background: var(--bg-black-soft);
            border: 1px solid rgba(201, 162, 75, 0.18);
            border-radius: var(--radius);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            position: relative;
        }

        .wishlist-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.4);
            border-color: rgba(201, 162, 75, 0.38);
        }

        .wishlist-card-img-wrap {
            position: relative;
            overflow: hidden;
        }

        .wishlist-card-img-wrap img {
            width: 100%;
            height: 240px;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .wishlist-card:hover .wishlist-card-img-wrap img {
            transform: scale(1.04);
        }

        .wishlist-card-body {
            padding: 1.1rem;
        }

        .wishlist-card-title {
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 600;
            color: var(--gold-light);
            margin-bottom: 0.4rem;
            height: 2.5rem;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            line-height: 1.3;
        }

        .wishlist-card-price {
            font-size: 0.92rem;
            font-weight: 700;
            color: var(--ivory);
            margin-bottom: 1rem;
        }

        .wishlist-action-btns {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .btn-wishlist-view {
            display: block;
            text-align: center;
            padding: 0.5rem 1rem;
            background: var(--gold);
            color: var(--bg-black);
            font-family: var(--font-label);
            font-size: 0.62rem;
            letter-spacing: 0.1em;
            font-weight: 700;
            border-radius: var(--radius);
            text-decoration: none;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .btn-wishlist-view:hover {
            background: var(--gold-light);
            color: var(--bg-black);
            transform: translateY(-1px);
        }

        .btn-wishlist-remove {
            display: block;
            width: 100%;
            padding: 0.45rem 1rem;
            background: transparent;
            border: 1px solid rgba(220, 53, 69, 0.35);
            color: rgba(248, 113, 113, 0.8);
            font-family: var(--font-label);
            font-size: 0.62rem;
            letter-spacing: 0.08em;
            border-radius: var(--radius);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-wishlist-remove:hover {
            background: rgba(220, 53, 69, 0.1);
            border-color: rgba(220, 53, 69, 0.6);
            color: #f87171;
        }

        /* Section header */
        .wishlist-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(201, 162, 75, 0.15);
        }

        .wishlist-page-header h4 {
            font-family: var(--font-display);
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--gold-light);
            margin: 0;
        }

        .wishlist-count-badge {
            background: rgba(201, 162, 75, 0.14);
            border: 1px solid rgba(201, 162, 75, 0.3);
            color: var(--gold);
            font-family: var(--font-label);
            font-size: 0.62rem;
            letter-spacing: 0.1em;
            padding: 0.28rem 0.7rem;
            border-radius: 20px;
        }

        /* Category badge on card */
        .wishlist-card-cat {
            font-family: var(--font-label);
            font-size: 0.58rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(201, 162, 75, 0.6);
            margin-bottom: 0.3rem;
        }
    </style>
@endpush

@section('content')
<div class="customer-dashboard-wrapper">
    <div class="container">
        <div class="row">

            {{-- Sidebar --}}
            <div class="col-lg-3 col-md-4 mb-4">
                @include('customer.layouts.sidebar')
            </div>

            {{-- Wishlist Content --}}
            <div class="col-lg-9 col-md-8">

                <div class="dashboard-card">

                    {{-- Header --}}
                    <div class="wishlist-page-header">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-heart text-gold" style="font-size:1rem;"></i>
                            <h4>My Wishlist</h4>
                        </div>
                        @if (!$wishlistItems->isEmpty())
                            <span class="wishlist-count-badge">{{ $wishlistItems->count() }} ITEMS</span>
                        @endif
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($wishlistItems->isEmpty())
                        {{-- Empty State --}}
                        <div class="text-center py-5">
                            <div style="width:80px;height:80px;border-radius:50%;background:rgba(201,162,75,0.08);border:1px solid rgba(201,162,75,0.2);display:flex;align-items:center;justify-content:center;margin:0 auto 1.2rem;">
                                <i class="fa-regular fa-heart" style="font-size:2rem;color:rgba(201,162,75,0.4);"></i>
                            </div>
                            <h5 class="font-display" style="color:var(--gold-light); font-size:1.1rem; margin-bottom:0.5rem;">Your Wishlist is Empty</h5>
                            <p style="font-size:0.83rem; color:rgba(251,248,241,0.45);">Save pieces you love and come back when you're ready.</p>
                            <a href="{{ route('sarees') }}" class="btn-outline-gold btn-sm mt-2 d-inline-block" style="font-size:0.62rem; padding:0.55rem 1.4rem;">
                                BROWSE CATALOG <i class="fa-solid fa-gem ms-1"></i>
                            </a>
                        </div>
                    @else
                        <div class="wishlist-grid">
                            @foreach ($wishlistItems as $item)
                                @if ($item->product)
                                    @php
                                        $product   = $item->product;
                                        $hasImages = $product->images && (is_object($product->images) ? $product->images->isNotEmpty() : count($product->images) > 0);
                                        $imgSrc    = $hasImages
                                            ? asset($product->images->first()->file_path)
                                            : asset('images/cat_saree.png');
                                        $catSlug   = optional($product->category)->slug ?? '';
                                        if ($catSlug === 'suits') $imgSrc = $hasImages ? $imgSrc : asset('images/cat_suit.png');
                                        elseif ($catSlug === 'lehengas') $imgSrc = $hasImages ? $imgSrc : asset('images/cat_lehenga.png');
                                        elseif ($catSlug === 'bridal-wear') $imgSrc = $hasImages ? $imgSrc : asset('images/cat_bridal.png');
                                    @endphp
                                    <div class="wishlist-card">
                                        {{-- Image --}}
                                        <div class="wishlist-card-img-wrap">
                                            <a href="{{ route('product.show', $product->slug) }}">
                                                <img src="{{ $imgSrc }}" alt="{{ $product->name }}" loading="lazy">
                                            </a>
                                        </div>

                                        <div class="wishlist-card-body">
                                            {{-- Category label --}}
                                            @if ($product->category)
                                                <div class="wishlist-card-cat">{{ $product->category->name }}</div>
                                            @endif

                                            {{-- Name --}}
                                            <h5 class="wishlist-card-title">{{ $product->name }}</h5>

                                            {{-- Price --}}
                                            <div class="wishlist-card-price">
                                                @if ($product->sale_price)
                                                    <span style="color:var(--gold);">₹{{ number_format($product->sale_price, 2) }}</span>
                                                    <span style="font-size:0.75rem; color:rgba(251,248,241,0.35); text-decoration:line-through; margin-left:0.4rem;">₹{{ number_format($product->price, 2) }}</span>
                                                @else
                                                    <span style="color:var(--gold);">₹{{ number_format($product->price, 2) }}</span>
                                                @endif
                                            </div>

                                            {{-- Actions --}}
                                            <div class="wishlist-action-btns">
                                                <a href="{{ route('product.show', $product->slug) }}" class="btn-wishlist-view">
                                                    VIEW PRODUCT <i class="fa-solid fa-arrow-right ms-1"></i>
                                                </a>

                                                <form action="{{ route('customer.wishlist.remove', $product->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-wishlist-remove">
                                                        <i class="fa-solid fa-trash-can me-1"></i> Remove
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
