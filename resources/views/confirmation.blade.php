@extends('layouts.app')

@section('title', 'Order Confirmed — RANISAHAB Luxury')
@section('meta_robots', 'noindex, nofollow')

@section('content')
<div class="confirm-wrap d-flex align-items-center py-5 text-ivory" style="background-color: #080706; min-height: 80vh;">
  <div class="container" style="max-width: 540px;">
    
    <div class="text-center mb-4">
      <a href="{{ route('home') }}">
        <img src="{{ asset('images/logo.png') }}" alt="RANISAHAB" class="brand-logo-img logo-lg mb-2" style="max-height: 70px; object-fit: contain;">
      </a>
    </div>

    <!-- Title and Reassurance -->
    <div class="text-center mb-5">
      <div class="confirm-check mb-3 mx-auto" style="width: 76px; height: 76px; border-radius: 50%; border: 2px solid var(--gold); display: flex; align-items: center; justify-content: center; color: var(--gold); font-size: 2.2rem; box-shadow: 0 0 15px rgba(201, 162, 75, 0.35);">
        <i class="fa-solid fa-crown text-gold"></i>
      </div>
      <h2 class="text-gold font-display mb-2" style="font-size: 2.2rem; letter-spacing: 0.05em; font-weight: 400;">ORDER CONFIRMED 👑</h2>
      <p class="text-ivory opacity-85 mb-0" style="font-size: 1rem; font-weight: 300;">Thank you for choosing RANISAHAB.</p>
      <p class="small text-muted mt-1">Your royal order has been recorded and handed over to our couture designers.</p>
    </div>

    <!-- Receipt Details Box -->
    <div class="p-4 rounded mb-4" style="background: rgba(25, 21, 19, 0.85); border: 1px solid rgba(201, 162, 75, 0.3); box-shadow: 0 10px 25px rgba(0,0,0,0.5);">
      <div class="d-flex justify-content-between py-2.5 border-bottom border-secondary border-opacity-25 small">
        <span class="text-muted">Order ID</span>
        <strong class="text-gold" style="letter-spacing: 0.05em;">{{ $order->order_number }}</strong>
      </div>
      
      <div class="d-flex justify-content-between py-2.5 border-bottom border-secondary border-opacity-25 small">
        <span class="text-muted">Payment</span>
        @if ($order->payment_status === 'paid')
          <span class="badge bg-success bg-opacity-25 text-success border border-success px-2.5 py-1" style="font-size:0.68rem; letter-spacing:0.04em;"><i class="fa-solid fa-circle-check me-1"></i>PAID</span>
        @else
          <span class="badge bg-warning bg-opacity-25 text-warning border border-warning px-2.5 py-1" style="font-size:0.68rem; letter-spacing:0.04em;"><i class="fa-solid fa-clock me-1"></i>CASH ON DELIVERY</span>
        @endif
      </div>

      <div class="d-flex justify-content-between py-2.5 border-bottom border-secondary border-opacity-25 small">
        <span class="text-muted">Estimated Delivery</span>
        <span class="text-ivory fw-bold">{{ $order->created_at->addDays(4)->format('d') }}–{{ $order->created_at->addDays(7)->format('d M') }}</span>
      </div>

      <div class="d-flex justify-content-between py-2.5 small">
        <span class="text-muted">Order Total</span>
        <strong class="text-gold" style="font-size: 1.1rem;">₹{{ number_format($order->total, 0) }}</strong>
      </div>
    </div>

    <!-- Notification dispatch log box -->
    <div class="p-4 rounded text-start mb-4" style="background: rgba(201, 162, 75, 0.03); border: 1px dashed rgba(201, 162, 75, 0.25);">
      <h6 class="text-gold font-display mb-3 text-center" style="font-size:0.85rem; letter-spacing:0.1em;"><i class="fa-solid fa-bell me-2"></i>NOTIFICATIONS LOG</h6>
      
      <div class="d-flex flex-column gap-3 small">
        <!-- Email Notification -->
        <div class="d-flex align-items-start gap-2">
          <span class="badge bg-success bg-opacity-20 text-success border border-success" style="font-size:0.6rem; padding: 0.25rem 0.5rem;">EMAIL</span>
          <div class="text-muted">
            <strong class="text-ivory" style="font-size:0.75rem;">RANISAHAB Order Confirmation</strong><br>
            Order details dispatched to <span class="text-gold-light">{{ $order->customer->email ?? 'customer' }}</span>.
          </div>
        </div>
      </div>
    </div>

    <!-- Navigation CTAs -->
    <div class="d-flex gap-3 mb-4">
      <a href="{{ route('tracking', ['number' => $order->tracking_number ?: '']) }}" class="btn btn-gold flex-fill text-center py-3 font-label fw-bold" style="font-size:0.82rem; letter-spacing:0.08em;">TRACK ORDER</a>
      <a href="{{ route('home') }}" class="btn btn-outline-gold flex-fill text-center py-3 font-label fw-bold" style="font-size:0.82rem; letter-spacing:0.08em;">CONTINUE SHOPPING</a>
    </div>

    <!-- WhatsApp Order Notification CTA -->
    @php $storeWhatsapp = \App\Models\Setting::getVal('store_whatsapp', '919876543210'); @endphp
    <div class="text-center">
      <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $storeWhatsapp) }}?text={{ urlencode('Hi RANISAHAB, please send me WhatsApp order updates for Order #' . $order->order_number) }}" target="_blank" class="btn btn-whatsapp w-100 py-3 small font-label fw-bold" style="letter-spacing:0.05em;">
        <i class="fa-brands fa-whatsapp fs-5 me-2"></i> GET INSTANT WHATSAPP ORDER UPDATES
      </a>
    </div>

  </div>
</div>
@endsection

@push('styles')
<style>
  .confirm-wrap .text-muted {
      color: rgba(251, 248, 241, 0.55) !important;
  }
  .confirm-wrap strong, .confirm-wrap span {
      color: var(--ivory);
  }
  .confirm-wrap .badge span, .confirm-wrap .badge i {
      color: inherit;
  }
  .confirm-wrap .py-2.5 {
      padding-top: 0.75rem !important;
      padding-bottom: 0.75rem !important;
  }
</style>
@endpush
