@extends('layouts.app')

@section('title', 'Track Your Order — RANISAHAB Luxury')

@push('styles')
<style>
  .tracking-wrap {
      background-color: #080706 !important;
  }
  .tracking-wrap .text-muted {
      color: rgba(251, 248, 241, 0.6) !important;
  }
  .tracking-wrap .badge.text-muted {
      color: var(--gold-light) !important;
  }
  .tracking-wrap .track-card {
      background: #12100e !important;
      border-color: rgba(201, 162, 75, 0.2) !important;
  }
</style>
@endpush

@section('content')
<div class="tracking-wrap py-5 text-ivory">
  <div class="container" style="max-width:720px;">
    
    @if (!$trackingNumber)
      <div class="text-center mb-5">
        <h2 class="font-display text-gold mb-2">TRACK COUTURE LOGISTICS</h2>
        <p class="text-muted">Enter your Shiprocket tracking number below to view real-time delivery checkpoints.</p>
      </div>

      <div class="p-5 rounded mb-4" style="background:rgba(255,255,255,0.03);border:1px solid rgba(201,162,75,0.3);">
        <form action="{{ route('tracking') }}" method="GET" class="row g-3">
          <div class="col-md-9">
            <input type="text" name="number" class="dark-input text-center py-3" placeholder="Enter Tracking Number (e.g. SR8493029193)" required style="font-size:1.1rem; border-color:rgba(201,162,75,0.4); background: rgba(255,255,255,0.03); color: #fff;">
          </div>
          <div class="col-md-3">
            <button type="submit" class="btn btn-gold w-100 h-100 py-3 font-display" style="letter-spacing:0.1em;">TRACK</button>
          </div>
        </form>
      </div>
    @else
      <div class="text-center mb-5">
        <h2 class="font-display text-gold mb-2">YOUR ORDER IS IN SAFE HANDS</h2>
        <p class="text-muted">TRACKING NUMBER: <strong class="text-gold">{{ $trackingNumber }}</strong> &nbsp;•&nbsp; Courier: <strong class="text-ivory">{{ $trackingData['courier_name'] ?? 'Shiprocket Express' }}</strong></p>
      </div>

      <!-- Dynamic Shiprocket Timeline -->
      <div class="track-timeline mb-5">
        @if (isset($trackingData['tracking_history']) && count($trackingData['tracking_history']) > 0)
          @foreach (array_reverse($trackingData['tracking_history']) as $activity)
            <div class="track-item done">
              <div class="track-dot"><i class="fa-solid fa-check"></i></div>
              <div class="track-card bg-black-soft border border-secondary border-opacity-25 rounded p-3 text-ivory">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                  <div>
                    <strong class="text-gold">{{ strtoupper($activity['activity']) }}</strong>
                    <p class="small text-muted mb-1">{{ $activity['details'] }}</p>
                    <span class="badge bg-secondary bg-opacity-20 text-muted small"><i class="fa-solid fa-location-dot me-1"></i>{{ $activity['location'] }}</span>
                  </div>
                  <span class="track-time small text-muted">{{ date('d M, h:i A', strtotime($activity['date'])) }}</span>
                </div>
              </div>
            </div>
          @endforeach
        @else
          <div class="text-center py-5">
            <i class="fa-solid fa-hourglass-start text-gold display-5 mb-3"></i>
            <p class="text-muted">Shipment scheduled. Waiting for Shiprocket pickup scan.</p>
          </div>
        @endif
      </div>

      <div class="d-flex gap-3 flex-wrap">
        <a href="{{ route('tracking') }}" class="btn btn-outline-gold flex-fill text-center py-3">TRACK ANOTHER SHIPMENT</a>
        <a href="#" class="btn btn-whatsapp flex-fill justify-content-center py-3"><i class="fa-brands fa-whatsapp fs-5 me-1"></i> NEED HELP? CHAT WITH US</a>
      </div>
    @endif

  </div>
</div>
@endsection
