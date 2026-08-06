@extends('layouts.app')

@section('title', 'Track Your Order — RANISAHAB Luxury')

@section('content')
<div class="tracking-wrap py-5 bg-black text-ivory">
  <div class="container" style="max-width:720px;">
    
    <div class="text-center mb-5">
      <h2 class="font-display text-gold mb-2">YOUR ORDER IS IN SAFE HANDS</h2>
      <p class="text-muted">ORDER ID: <strong class="text-ivory">RSB-2024-0512-4587</strong> &nbsp;•&nbsp; Placed on 12 May, 2024</p>
    </div>

    <!-- Timeline list -->
    <div class="track-timeline mb-5">
      
      <div class="track-item done">
        <div class="track-dot"><i class="fa-solid fa-check"></i></div>
        <div class="track-card bg-black-soft border border-secondary border-opacity-25 rounded p-3 text-ivory">
          <div>
            <strong class="text-gold">ORDER CONFIRMED</strong>
            <p class="small text-muted mb-0">Your order has been confirmed successfully.</p>
          </div>
          <span class="track-time small text-muted">12 May, 11:45 AM</span>
        </div>
      </div>

      <div class="track-item done">
        <div class="track-dot"><i class="fa-solid fa-scissors"></i></div>
        <div class="track-card bg-black-soft border border-secondary border-opacity-25 rounded p-3 text-ivory">
          <div>
            <strong class="text-gold">FABRIC &amp; MATERIAL SELECTED</strong>
            <p class="small text-muted mb-0">We have selected the finest quality fabric for your order.</p>
          </div>
          <span class="track-time small text-muted">12 May, 02:30 PM</span>
        </div>
      </div>

      <div class="track-item done">
        <div class="track-dot"><i class="fa-solid fa-shirt"></i></div>
        <div class="track-card bg-black-soft border border-secondary border-opacity-25 rounded p-3 text-ivory">
          <div>
            <strong class="text-gold">STITCHING &amp; QUALITY CHECK</strong>
            <p class="small text-muted mb-0">Your product is being stitched and quality checked.</p>
          </div>
          <span class="track-time small text-muted">13 May, 10:15 AM</span>
        </div>
      </div>

      <div class="track-item done">
        <div class="track-dot"><i class="fa-solid fa-gift"></i></div>
        <div class="track-card bg-black-soft border border-secondary border-opacity-25 rounded p-3 text-ivory">
          <div>
            <strong class="text-gold">PREMIUM PACKAGING</strong>
            <p class="small text-muted mb-0">Your order is packed in our signature luxury packaging.</p>
          </div>
          <span class="track-time small text-muted">13 May, 04:20 PM</span>
        </div>
      </div>

      <div class="track-item done">
        <div class="track-dot"><i class="fa-solid fa-box"></i></div>
        <div class="track-card bg-black-soft border border-secondary border-opacity-25 rounded p-3 text-ivory">
          <div>
            <strong class="text-gold">DISPATCHED</strong>
            <p class="small text-muted mb-0">Your order has been dispatched via courier.</p>
          </div>
          <span class="track-time small text-muted">13 May, 06:10 PM</span>
        </div>
      </div>

      <div class="track-item done">
        <div class="track-dot"><i class="fa-solid fa-truck"></i></div>
        <div class="track-card bg-black-soft border border-secondary border-opacity-25 rounded p-3 text-ivory">
          <div>
            <strong class="text-gold">OUT FOR DELIVERY</strong>
            <p class="small text-muted mb-0">Your order is on the way to your delivery address.</p>
          </div>
          <span class="track-time small text-muted">14 May, 09:00 AM</span>
        </div>
      </div>

      <div class="track-item">
        <div class="track-dot"><i class="fa-solid fa-house"></i></div>
        <div class="track-card bg-black-soft border border-secondary border-opacity-25 rounded p-3 text-ivory">
          <div>
            <strong>DELIVERED</strong>
            <p class="small text-muted mb-0">Enjoy your luxury with RANISAHAB.</p>
          </div>
          <span class="track-time small text-muted">Pending</span>
        </div>
      </div>

    </div>

    <div class="d-flex gap-3">
      <a href="#" class="btn btn-gold flex-fill text-center py-3">TRACK ON COURIER WEBSITE</a>
      <a href="#" class="btn btn-whatsapp flex-fill justify-content-center py-3"><i class="fa-brands fa-whatsapp fs-5 me-1"></i> NEED HELP?</a>
    </div>

  </div>
</div>
@endsection
