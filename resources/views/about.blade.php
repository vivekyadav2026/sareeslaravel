@extends('layouts.app')

@section('title', 'About Us — RANISAHAB Heritage & Craftsmanship')

@section('content')
<!-- Hero -->
<section class="bg-black text-ivory py-5 text-center">
  <div class="container py-3">
    <span class="brand-crown-icon fs-2"><i class="fa-solid fa-crown text-gold"></i></span>
    <h1 class="font-display text-gold-light display-4 mb-3">OUR HERITAGE &amp; STORY</h1>
    <p class="lead text-muted mx-auto" style="max-width:700px;">"RANISAHAB is more than a luxury fashion house — it is a celebration of Indian heritage, royal elegance, and the timeless beauty of every woman."</p>
  </div>
</section>

<!-- Content -->
<section class="py-5 bg-ivory">
  <div class="container">
    <div class="row align-items-center g-5 mb-5">
      <div class="col-lg-6">
        <img src="{{ asset('images/fabric_detail.png') }}" alt="Craftsmanship" class="img-fluid rounded shadow-lg border border-warning">
      </div>
      <div class="col-lg-6">
        <span class="label-title">CRAFTED WITH LOVE</span>
        <h2 class="font-display text-maroon display-6 mb-3">Preserving Centuries of Zari Artistry</h2>
        <p class="text-muted leading-relaxed">Founded with a vision to make royal bridal fashion accessible without compromising on quality, RANISAHAB collaborates directly with master handloom weavers in Varanasi, Jaipur, and Kanchipuram.</p>
        <p class="text-muted leading-relaxed">Every saree, lehenga, and suit tells a story of meticulous zari weaving, pure silk fabrics, and authentic craftsmanship passed down through generations.</p>
      </div>
    </div>

    <!-- 4 Pillars -->
    <div class="row g-4 text-center mt-4">
      <div class="col-md-3">
        <div class="p-4 border rounded bg-white h-100 shadow-sm">
          <i class="fa-solid fa-gem text-gold fs-1 mb-3"></i>
          <h5 class="font-display text-maroon">100% Pure Fabrics</h5>
          <p class="small text-muted mb-0">Certified silk, pure velvet, and genuine gold-silver zari weaving.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="p-4 border rounded bg-white h-100 shadow-sm">
          <i class="fa-solid fa-hand-holding-heart text-gold fs-1 mb-3"></i>
          <h5 class="font-display text-maroon">Honest Pricing</h5>
          <p class="small text-muted mb-0">Direct from artisan to bride with transparent, honest pricing.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="p-4 border rounded bg-white h-100 shadow-sm">
          <i class="fa-solid fa-crown text-gold fs-1 mb-3"></i>
          <h5 class="font-display text-maroon">One Design, One Bride</h5>
          <p class="small text-muted mb-0">Custom bridal pieces with certified design exclusivity.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="p-4 border rounded bg-white h-100 shadow-sm">
          <i class="fa-solid fa-truck-fast text-gold fs-1 mb-3"></i>
          <h5 class="font-display text-maroon">Pan-India Delivery</h5>
          <p class="small text-muted mb-0">Insured express luxury packaging delivered right to your doorstep.</p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
