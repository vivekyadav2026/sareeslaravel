@extends('layouts.app')

@section('title', 'Contact Us — RANISAHAB Luxury Support & Boutiques')
@section('meta_description', 'Get in touch with RANISAHAB’s luxury bridal concierge. Contact us for custom bridal lehengas, saree collection inquiries, appointments, and tracking.')
@section('meta_keywords', 'contact ranisahab, boutique address delhi, boutique address jaipur, customer support, custom bridal wear inquiry')

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

@php
  $storePhone = \App\Models\Setting::getVal('store_phone', '+91 98765 43210');
  $storeEmail = \App\Models\Setting::getVal('store_email', 'Ranisahab01@gmail.com');
  $storeWhatsapp = \App\Models\Setting::getVal('store_whatsapp', '919876543210');
  $businessHours = \App\Models\Setting::getVal('business_hours', 'Mon - Sat: 10:00 AM - 8:00 PM IST');
@endphp
      <!-- Quick Contact -->
      <div class="contact-dark-card">
        <h3 class="contact-dark-card-title"><i class="fa-solid fa-crown me-2 text-gold"></i>LUXURY CONCIERGE</h3>
        <div class="contact-info-item">
          <div class="contact-info-icon"><i class="fa-brands fa-whatsapp"></i></div>
          <div>
            <p class="contact-info-label">WhatsApp Support</p>
            <p class="contact-info-value">+{{ preg_replace('/[^0-9]/', '', $storeWhatsapp) }}</p>
            <p class="contact-info-sub">{{ $businessHours }}</p>
          </div>
        </div>
        <div class="contact-info-item">
          <div class="contact-info-icon"><i class="fa-solid fa-phone"></i></div>
          <div>
            <p class="contact-info-label">Phone</p>
            <p class="contact-info-value">{{ $storePhone }}</p>
          </div>
        </div>
        <div class="contact-info-item">
          <div class="contact-info-icon"><i class="fa-solid fa-envelope"></i></div>
          <div>
            <p class="contact-info-label">Email</p>
            <p class="contact-info-value">{{ $storeEmail }}</p>
          </div>
        </div>
        <div class="contact-info-item">
          <div class="contact-info-icon"><i class="fa-solid fa-truck-fast"></i></div>
          <div>
            <p class="contact-info-label">Shipping</p>
            <p class="contact-info-value">Free Express Above ₹5,000</p>
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

        @if (session('success'))
          <div class="alert alert-success mx-4 my-2 text-gold border-gold" style="background: rgba(201, 162, 75, 0.1);">
            <i class="fa-solid fa-circle-check text-gold me-2"></i> {{ session('success') }}
          </div>
        @endif

        @if ($errors->any())
          <div class="alert alert-danger mx-4 my-2 text-danger border-danger" style="background: rgba(220, 53, 69, 0.1);">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('contact.submit') }}" method="POST" class="dark-form-grid" style="padding: 1.5rem;">
          @csrf
          <div class="dark-form-group">
            <label class="dark-label">Your Full Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="dark-input" placeholder="e.g. Neha Sharma" required value="{{ old('name') }}">
          </div>
          <div class="dark-form-group">
            <label class="dark-label">Phone Number</label>
            <input type="tel" name="phone" class="dark-input" placeholder="+91 98765 43210" value="{{ old('phone') }}">
          </div>
          <div class="dark-form-group">
            <label class="dark-label">Email Address <span class="text-danger">*</span></label>
            <input type="email" name="email" class="dark-input" placeholder="name@example.com" required value="{{ old('email') }}">
          </div>
          <div class="dark-form-group">
            <label class="dark-label">Inquiry Subject <span class="text-danger">*</span></label>
            <select name="subject" class="dark-input dark-select" required>
              <option value="Custom Bridal Lehenga">Custom Bridal Lehenga</option>
              <option value="Saree Order Inquiry">Saree Order Inquiry</option>
              <option value="Bridal Package Booking">Bridal Package Booking</option>
              <option value="Makeup Artist Appointment">Makeup Artist Appointment</option>
              <option value="Order Tracking">Order Tracking</option>
            </select>
          </div>
          <div class="dark-form-group dark-form-full">
            <label class="dark-label">Your Message <span class="text-danger">*</span></label>
            <textarea name="message" class="dark-input dark-textarea" rows="4" placeholder="Write your message or questions here..." required>{{ old('message') }}</textarea>
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
