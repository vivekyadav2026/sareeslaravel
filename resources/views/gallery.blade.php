@extends('layouts.app')

@section('title', 'Real Brides Gallery — RANISAHAB Luxury')

@section('content')
<!-- Header Banner -->
<div class="bg-black text-ivory py-5">
  <div class="container text-center">
    <span class="motif text-gold">❖</span>
    <h1 class="font-display text-gold-light display-4 mb-2">REAL BRIDES, REAL STORIES</h1>
    <p class="lead text-muted mx-auto" style="max-width:650px;">Witness the joy of over 10,000 brides across India who made their wedding unforgettable with RANISAHAB.</p>
  </div>
</div>

<section class="py-5 bg-ivory">
  <div class="container">
    
    <!-- Gallery Filter Tabs -->
    <div class="d-flex justify-content-center gap-2 mb-4 flex-wrap">
      <button class="btn btn-gold btn-sm">ALL BRIDES</button>
      <button class="btn btn-outline-gold btn-sm">BRIDAL LEHENGAS</button>
      <button class="btn btn-outline-gold btn-sm">HALDI &amp; MEHENDI</button>
      <button class="btn btn-outline-gold btn-sm">RECEPTION SAREES</button>
      <button class="btn btn-outline-gold btn-sm"><i class="fa-solid fa-play me-1"></i>VIDEO STORIES</button>
    </div>

    <!-- Gallery Grid -->
    <div class="row g-3">
      <div class="col-6 col-md-4 col-lg-3">
        <div class="gallery-thumb-item" style="height:280px;">
          <img src="{{ asset('images/hero_bride.png') }}" alt="Bride Story 1">
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="gallery-thumb-item" style="height:280px;">
          <img src="{{ asset('images/promise_bride.png') }}" alt="Bride Story 2">
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="gallery-thumb-item" style="height:280px;">
          <img src="{{ asset('images/cat_bridal.png') }}" alt="Bride Story 3">
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="gallery-thumb-item" style="height:280px;">
          <img src="{{ asset('images/cat_lehenga.png') }}" alt="Bride Story 4">
          <div class="video-play-btn"><i class="fa-solid fa-circle-play"></i></div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="gallery-thumb-item" style="height:280px;">
          <img src="{{ asset('images/pkg_royal.png') }}" alt="Bride Story 5">
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="gallery-thumb-item" style="height:280px;">
          <img src="{{ asset('images/pkg_gold.png') }}" alt="Bride Story 6">
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="gallery-thumb-item" style="height:280px;">
          <img src="{{ asset('images/pkg_silver.png') }}" alt="Bride Story 7">
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="gallery-thumb-item" style="height:280px;">
          <img src="{{ asset('images/cat_saree.png') }}" alt="Bride Story 8">
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
