@extends('layouts.app')

@section('title', 'Contact Us — RANISAHAB Luxury Support & Boutiques')

@section('content')
<!-- Banner -->
<div class="bg-black text-ivory py-4 text-center">
  <div class="container">
    <span class="label-title">WE ARE HERE FOR YOU</span>
    <h1 class="font-display text-gold-light display-5 mb-2">CONTACT RANISAHAB</h1>
    <p class="small text-muted mb-0">Visit our flagship luxury boutiques or connect with our royal customer concierge.</p>
  </div>
</div>

<section class="py-5 bg-ivory">
  <div class="container">
    <div class="row g-5">
      <!-- Contact Info & Boutiques Left -->
      <div class="col-lg-5">
        <div class="p-4 border rounded bg-white shadow-sm mb-4">
          <h5 class="font-display text-maroon mb-3 border-bottom pb-2">LUXURY CONCIERGE</h5>
          <div class="d-flex align-items-start gap-3 mb-3">
            <i class="fa-solid fa-phone text-gold fs-4"></i>
            <div>
              <strong class="d-block">Phone / WhatsApp Support</strong>
              <span class="small text-muted">+91 12345 67890 (10 AM – 8 PM)</span>
            </div>
          </div>
          <div class="d-flex align-items-start gap-3 mb-3">
            <i class="fa-solid fa-envelope text-gold fs-4"></i>
            <div>
              <strong class="d-block">Email Address</strong>
              <span class="small text-muted">support@ranisahab.com</span>
            </div>
          </div>
          <div class="d-flex align-items-start gap-3">
            <i class="fa-solid fa-truck-fast text-gold fs-4"></i>
            <div>
              <strong class="d-block">Shipping &amp; Delivery</strong>
              <span class="small text-muted">Free Pan-India Delivery across 25,000+ Pincodes</span>
            </div>
          </div>
        </div>

        <!-- Boutique Locations -->
        <div class="p-4 border rounded bg-white shadow-sm">
          <h5 class="font-display text-maroon mb-3 border-bottom pb-2">FLAGSHIP BOUTIQUES</h5>
          <div class="mb-3">
            <strong class="text-maroon d-block"><i class="fa-solid fa-location-dot text-gold me-2"></i>Jaipur Royal Boutique</strong>
            <p class="small text-muted mb-0">123 Green Avenue, Sector 15, Jaipur, Rajasthan - 302001</p>
          </div>
          <div class="mb-3">
            <strong class="text-maroon d-block"><i class="fa-solid fa-location-dot text-gold me-2"></i>Delhi Bridal Couture Studio</strong>
            <p class="small text-muted mb-0">45 South Extension Part II, New Delhi - 110049</p>
          </div>
          <div>
            <strong class="text-maroon d-block"><i class="fa-solid fa-location-dot text-gold me-2"></i>Mumbai Flagship Store</strong>
            <p class="small text-muted mb-0">88 Linking Road, Bandra West, Mumbai - 400050</p>
          </div>
        </div>
      </div>

      <!-- Contact Form Right -->
      <div class="col-lg-7">
        <div class="p-4 rounded bg-white border shadow-sm">
          <h4 class="font-display text-maroon mb-2">SEND US A MESSAGE</h4>
          <p class="small text-muted mb-4">Have questions about a custom lehenga, saree design, or order status? Send us your message below.</p>
          <form class="row g-3">
            <div class="col-md-6"><label class="small text-muted mb-1">Your Full Name</label><input type="text" class="form-control form-control-luxury" placeholder="e.g. Neha Sharma"></div>
            <div class="col-md-6"><label class="small text-muted mb-1">Phone Number</label><input type="tel" class="form-control form-control-luxury" placeholder="+91 98765 43210"></div>
            <div class="col-md-6"><label class="small text-muted mb-1">Email Address</label><input type="email" class="form-control form-control-luxury" placeholder="name@example.com"></div>
            <div class="col-md-6">
              <label class="small text-muted mb-1">Inquiry Subject</label>
              <select class="form-select form-control-luxury">
                <option>Custom Bridal Lehenga</option>
                <option>Saree Order Inquiry</option>
                <option>Bridal Package Booking</option>
                <option>Makeup Artist Appointment</option>
              </select>
            </div>
            <div class="col-12"><label class="small text-muted mb-1">Your Message</label><textarea class="form-control form-control-luxury" rows="4" placeholder="Write your message or order questions here..."></textarea></div>
            <div class="col-12"><button class="btn btn-gold w-100 py-3" type="submit">SEND MESSAGE NOW</button></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
