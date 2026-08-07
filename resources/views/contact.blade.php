@extends('layouts.app')

@section('title', 'Contact Us — RANISAHAB Luxury Support & Boutiques')

@section('content')
<div class="plp-page">

  <!-- Breadcrumb -->
  <div class="plp-breadcrumb">
    <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i></a>
    <span class="plp-bc-sep">/</span>
    <span>Contact Us</span>
  </div>

  <!-- Page Header -->
  <div class="plp-header">
    <div class="plp-header-deco">
      <span class="plp-deco-line"></span>
      <i class="fa-solid fa-headset plp-deco-icon"></i>
      <span class="plp-deco-line"></span>
    </div>
    <h1 class="plp-page-title">CONTACT US</h1>
    <p class="plp-page-subtitle">We Are Here for You — Always.</p>
  </div>

  <!-- Contact Layout -->
  <div class="contact-dark-layout">

    <!-- Left: Info + Boutiques -->
    <div class="contact-dark-left">

      <!-- Quick Contact -->
      <div class="contact-dark-card">
        <h3 class="contact-dark-card-title"><i class="fa-solid fa-crown me-2 text-gold"></i>LUXURY CONCIERGE</h3>
        <div class="contact-info-item">
          <div class="contact-info-icon"><i class="fa-brands fa-whatsapp"></i></div>
          <div>
            <p class="contact-info-label">WhatsApp Support</p>
            <p class="contact-info-value">+91 12345 67890</p>
            <p class="contact-info-sub">10 AM – 8 PM, All Days</p>
          </div>
        </div>
        <div class="contact-info-item">
          <div class="contact-info-icon"><i class="fa-solid fa-phone"></i></div>
          <div>
            <p class="contact-info-label">Phone</p>
            <p class="contact-info-value">+91 12345 67890</p>
          </div>
        </div>
        <div class="contact-info-item">
          <div class="contact-info-icon"><i class="fa-solid fa-envelope"></i></div>
          <div>
            <p class="contact-info-label">Email</p>
            <p class="contact-info-value">support@ranisahab.com</p>
          </div>
        </div>
        <div class="contact-info-item">
          <div class="contact-info-icon"><i class="fa-solid fa-truck-fast"></i></div>
          <div>
            <p class="contact-info-label">Shipping</p>
            <p class="contact-info-value">Free Pan-India</p>
            <p class="contact-info-sub">25,000+ Pincodes Covered</p>
          </div>
        </div>
      </div>

      <!-- Boutiques -->
      <div class="contact-dark-card" style="margin-top:0.75rem;">
        <h3 class="contact-dark-card-title"><i class="fa-solid fa-location-dot me-2 text-gold"></i>FLAGSHIP BOUTIQUES</h3>
        <div class="contact-boutique-item">
          <p class="contact-boutique-name">Jaipur Royal Boutique</p>
          <p class="contact-boutique-addr">123 Green Avenue, Sector 15, Jaipur, Rajasthan – 302001</p>
        </div>
        <div class="contact-boutique-item">
          <p class="contact-boutique-name">Delhi Bridal Couture Studio</p>
          <p class="contact-boutique-addr">45 South Extension Part II, New Delhi – 110049</p>
        </div>
        <div class="contact-boutique-item">
          <p class="contact-boutique-name">Mumbai Flagship Store</p>
          <p class="contact-boutique-addr">88 Linking Road, Bandra West, Mumbai – 400050</p>
        </div>
      </div>

    </div>

    <!-- Right: Contact Form -->
    <div class="contact-dark-right">
      <div class="dark-form-wrap" style="padding:0;">
        <div class="dark-form-header">
          <i class="fa-solid fa-paper-plane dark-form-icon"></i>
          <h3 class="dark-form-title">SEND US A MESSAGE</h3>
          <p class="dark-form-subtitle">Have questions about orders, custom designs, or appointments? We'll respond within 24 hours.</p>
        </div>
        <form class="dark-form-grid">
          <div class="dark-form-group">
            <label class="dark-label">Your Full Name</label>
            <input type="text" class="dark-input" placeholder="e.g. Neha Sharma">
          </div>
          <div class="dark-form-group">
            <label class="dark-label">Phone Number</label>
            <input type="tel" class="dark-input" placeholder="+91 98765 43210">
          </div>
          <div class="dark-form-group">
            <label class="dark-label">Email Address</label>
            <input type="email" class="dark-input" placeholder="name@example.com">
          </div>
          <div class="dark-form-group">
            <label class="dark-label">Inquiry Subject</label>
            <select class="dark-input dark-select">
              <option>Custom Bridal Lehenga</option>
              <option>Saree Order Inquiry</option>
              <option>Bridal Package Booking</option>
              <option>Makeup Artist Appointment</option>
              <option>Order Tracking</option>
            </select>
          </div>
          <div class="dark-form-group dark-form-full">
            <label class="dark-label">Your Message</label>
            <textarea class="dark-input dark-textarea" rows="4" placeholder="Write your message or questions here..."></textarea>
          </div>
          <div class="dark-form-full">
            <button type="submit" class="bp-book-btn bp-book-featured" style="font-size:0.75rem;">SEND MESSAGE NOW <i class="fa-solid fa-arrow-right ms-2"></i></button>
          </div>
        </form>
      </div>
    </div>

  </div>

</div>
@endsection
