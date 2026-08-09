@extends('layouts.app')

@section('title', 'Order Confirmed — RANISAHAB Luxury')

@push('styles')
<style>
  .confirm-wrap {
      background-color: #080706 !important;
  }
  .confirm-wrap .text-muted {
      color: rgba(251, 248, 241, 0.55) !important;
  }
  .confirm-wrap strong, .confirm-wrap span {
      color: var(--ivory);
  }
  .confirm-wrap .badge span, .confirm-wrap .badge i {
      color: inherit;
  }
</style>
@endpush

@section('content')
<div class="confirm-wrap d-flex align-items-center py-5 text-ivory">
  <div class="container" style="max-width:540px;">
    
    <div class="text-center mb-4">
      <a href="{{ route('home') }}">
        <img src="{{ asset('images/logo.png') }}" alt="RANISAHAB" class="brand-logo-img logo-lg mb-2">
      </a>
    </div>

    <div class="text-center mb-4">
      <div class="confirm-check mb-3 mx-auto" style="width:72px;height:72px;border-radius:50%;border:2px solid var(--gold);display:flex;align-items:center;justify-content:center;color:var(--gold);font-size:2rem;">
        <i class="fa-solid fa-check"></i>
      </div>
      <h2 class="text-gold font-display" style="font-size:2.4rem;">THANK YOU!</h2>
      <h5 class="text-uppercase fw-light" style="letter-spacing:0.1em;font-size:0.95rem;">YOUR ORDER HAS BEEN SUCCESSFULLY CONFIRMED</h5>
      <p class="small text-muted">We have received your order and it is now being processed.</p>
    </div>

    <div class="p-4 rounded mb-4" style="background:rgba(255,255,255,0.03);border:1px solid rgba(201,162,75,0.3);">
      <div class="d-flex justify-content-between py-2 border-bottom border-secondary border-opacity-25 small">
        <span class="text-muted">ORDER ID</span>
        <strong>{{ $order->order_number }}</strong>
      </div>
      <div class="d-flex justify-content-between py-2 border-bottom border-secondary border-opacity-25 small">
        <span class="text-muted">ORDER DATE</span>
        <span>{{ $order->created_at->format('d M, Y | h:i A') }}</span>
      </div>
      <div class="d-flex justify-content-between py-2 border-bottom border-secondary border-opacity-25 small">
        <span class="text-muted">PAYMENT STATUS</span>
        @if ($order->payment_status === 'paid')
          <span class="badge bg-success bg-opacity-25 text-success border border-success"><i class="fa-solid fa-circle-check me-1"></i>PAID</span>
        @else
          <span class="badge bg-warning bg-opacity-25 text-warning border border-warning"><i class="fa-solid fa-circle-exclamation me-1"></i>UNPAID / COD</span>
        @endif
      </div>
      <div class="d-flex justify-content-between py-2 border-bottom border-secondary border-opacity-25 small">
        <span class="text-muted">PAYMENT METHOD</span>
        <span class="text-uppercase">{{ $order->payment_method }}</span>
      </div>
      <div class="d-flex justify-content-between py-2 small">
        <span class="text-muted">TOTAL AMOUNT</span>
        <strong class="text-gold">₹{{ number_format($order->total, 0) }}</strong>
      </div>
    </div>

    <div class="text-center mb-4">
      <p class="small text-muted mb-1">Estimated Delivery</p>
      <h4 class="text-gold font-display">{{ $order->created_at->addDays(4)->format('d – d M, Y') }}</h4>
      @if ($order->tracking_number)
        <p class="small text-success"><i class="fa-solid fa-truck-fast me-1"></i>Shipment Scheduled via Shiprocket. Tracking Number: {{ $order->tracking_number }}</p>
      @else
        <p class="small text-muted">We will send you tracking details once your order is shipped.</p>
      @endif
    </div>

    <div class="d-flex gap-3 mb-4">
      <a href="{{ route('tracking', ['number' => $order->tracking_number ?: '']) }}" class="btn btn-gold flex-fill text-center py-3">VIEW ORDER TRACKING</a>
      <a href="{{ route('home') }}" class="btn btn-outline-gold flex-fill text-center py-3">CONTINUE SHOPPING</a>
    </div>

    <div class="text-center">
      <a href="#" class="btn btn-whatsapp"><i class="fa-brands fa-whatsapp fs-5"></i> NEED HELP? CHAT WITH US ON WHATSAPP</a>
    </div>

  </div>
</div>
@endsection
