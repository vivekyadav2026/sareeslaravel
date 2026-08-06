@extends('layouts.app')

@section('title', 'Royal Bridal Collection — RANISAHAB Luxury')

@section('content')
<!-- Page Hero -->
<section class="bg-black text-ivory py-5 position-relative">
  <div class="container text-center py-4">
    <span class="brand-crown-icon mb-2 fs-2"><i class="fa-solid fa-crown text-gold"></i></span>
    <h1 class="font-display text-gold-light display-4 mb-3">ROYAL BRIDAL COLLECTION</h1>
    <p class="lead text-ivory-dark mx-auto" style="max-width:700px;font-size:1.1rem;font-weight:300;">Step into your big day with regal grace. Handcrafted bridal lehengas, silk saree sets, and bespoke wedding couture designed for modern royalty.</p>
  </div>
</section>

<!-- Collection Showcase Grid -->
<section class="py-5 bg-ivory">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-sm overflow-hidden">
          <img src="{{ asset('images/cat_bridal.png') }}" class="card-img-top" alt="Bridal 1" style="height:340px;object-fit:cover;">
          <div class="card-body p-4 text-center">
            <h5 class="font-display mb-1 text-maroon">Royal Red Kundan Lehenga</h5>
            <p class="small text-muted mb-2">Pure velvet with heavy antique kundan work and double dupatta.</p>
            <p class="text-maroon fw-bold fs-5 mb-3">₹28,999</p>
            <a href="{{ route('sarees') }}" class="btn btn-gold w-100">BOOK BRIDAL CONSULTATION</a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-sm overflow-hidden">
          <img src="{{ asset('images/hero_bride.png') }}" class="card-img-top" alt="Bridal 2" style="height:340px;object-fit:cover;">
          <div class="card-body p-4 text-center">
            <h5 class="font-display mb-1 text-maroon">Maroon Royal Heritage Lehenga</h5>
            <p class="small text-muted mb-2">Our flagship bridal design woven with pure gold zari threads.</p>
            <p class="text-maroon fw-bold fs-5 mb-3">₹34,999</p>
            <a href="{{ route('sarees') }}" class="btn btn-gold w-100">BOOK BRIDAL CONSULTATION</a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-sm overflow-hidden">
          <img src="{{ asset('images/promise_bride.png') }}" class="card-img-top" alt="Bridal 3" style="height:340px;object-fit:cover;">
          <div class="card-body p-4 text-center">
            <h5 class="font-display mb-1 text-maroon">Crimson Velvet Drape Lehenga</h5>
            <p class="small text-muted mb-2">One Design, One Bride exclusive piece with certificate.</p>
            <p class="text-maroon fw-bold fs-5 mb-3">₹39,999</p>
            <a href="{{ route('sarees') }}" class="btn btn-gold w-100">BOOK BRIDAL CONSULTATION</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
