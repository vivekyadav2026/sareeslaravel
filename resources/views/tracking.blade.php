@extends('layouts.app')

@section('title', 'Track Your Order — RANISAHAB Luxury')
@section('meta_description', 'Track your RANISAHAB couture logistics in real-time. Enter your tracking number to view real-time delivery checkpoints, courier logs, and shipping status.')
@section('meta_keywords', 'track order, courier tracking, track shipment, shiprocket tracking, ranisahab logistics')

@section('content')
<div class="tracking-wrap py-5 text-ivory" style="background-color: #080706; min-height: 80vh;">
  <div class="container" style="max-width:760px;">
    
    @if (!$trackingNumber)
      <div class="text-center mb-5">
        <h2 class="font-display text-gold mb-2" style="font-size: 2.2rem; letter-spacing: 0.05em;">TRACK COUTURE LOGISTICS</h2>
        <p class="text-muted">Enter your tracking number below to view real-time delivery checkpoints.</p>
      </div>

      <div class="p-5 rounded mb-4" style="background:rgba(255,255,255,0.02); border:1px solid rgba(201,162,75,0.25); box-shadow: 0 10px 30px rgba(0,0,0,0.55);">
        <form action="{{ route('tracking') }}" method="GET" class="row g-3">
          <div class="col-md-9">
            <input type="text" name="number" class="dark-input text-center py-3" placeholder="Enter Tracking Number (e.g. SR8493029193)" required style="font-size:1.1rem; border-color:rgba(201,162,75,0.4); background: rgba(255,255,255,0.03); color: #fff; width: 100%; border-radius: 4px; outline: none; transition: all 0.3s ease;">
          </div>
          <div class="col-md-3">
            <button type="submit" class="btn btn-gold w-100 h-100 py-3 font-display" style="letter-spacing:0.1em;">TRACK</button>
          </div>
        </form>
      </div>
    @else
      <div class="text-center mb-5">
        <h2 class="font-display text-gold mb-2" style="font-size: 2.2rem; letter-spacing: 0.05em;">YOUR ORDER IS IN SAFE HANDS</h2>
        <p class="text-muted">TRACKING NUMBER: <strong class="text-gold">{{ $trackingNumber }}</strong> &nbsp;•&nbsp; Courier: <strong class="text-ivory">{{ $trackingData['courier_name'] ?? 'Shiprocket Express' }}</strong></p>
      </div>

      <!-- 8-Stage Curation Stepper Timeline -->
      @if ($order)
        @php
          $stagesMapping = [
              'pending' => [
                  'label' => 'Order Placed',
                  'icon' => 'fa-clipboard-list',
                  'desc' => 'Your order has been recorded successfully.'
              ],
              'confirmed' => [
                  'label' => 'Order Confirmed',
                  'icon' => 'fa-circle-check',
                  'desc' => 'RANISAHAB luxury desk has confirmed your order features.'
              ],
              'processing' => [
                  'label' => 'Processing',
                  'icon' => 'fa-gears',
                  'desc' => 'Our curation tailors are working on stitching and fitting details.'
              ],
              'quality_check' => [
                  'label' => 'Quality Check',
                  'icon' => 'fa-square-poll-horizontal',
                  'desc' => 'Couture passed standard premium quality validation inspections.'
              ],
              'packed' => [
                  'label' => 'Packed',
                  'icon' => 'fa-box-open',
                  'desc' => 'Your purchase package is sealed and loaded in gold boutique bags.'
              ],
              'shipped' => [
                  'label' => 'Shipped 🚚',
                  'icon' => 'fa-truck-fast',
                  'desc' => 'Order package is handed over to Shiprocket express logistics courier.'
              ],
              'out_for_delivery' => [
                  'label' => 'Out for Delivery',
                  'icon' => 'fa-house-chimney-window',
                  'desc' => 'Courier agent has left regional depot with your delivery packet.'
              ],
              'delivered' => [
                  'label' => 'Delivered 👑',
                  'icon' => 'fa-crown',
                  'desc' => 'Thank you for choosing RANISAHAB. Enjoy your couture experience!'
              ]
          ];

          $statusSequenceList = ['pending', 'confirmed', 'processing', 'quality_check', 'packed', 'shipped', 'out_for_delivery', 'delivered'];
          $currentOrderState = $order->status;
          if ($currentOrderState === 'new') $currentOrderState = 'pending';
          
          $currentSequenceIndex = array_search($currentOrderState, $statusSequenceList);
          if ($currentSequenceIndex === false) $currentSequenceIndex = 0;

          $mappedCompletionTimes = [];
          foreach ($statusSequenceList as $seqIndex => $statusKey) {
              $logMatch = $order->statusLogs->where('status', $statusKey)->first();
              
              if ($logMatch) {
                  $mappedCompletionTimes[$statusKey] = $logMatch->created_at;
              } elseif ($seqIndex <= $currentSequenceIndex) {
                  $mappedCompletionTimes[$statusKey] = ($statusKey === 'pending') ? $order->created_at : $order->updated_at;
              } else {
                  $mappedCompletionTimes[$statusKey] = null;
              }
          }
        @endphp

        <div class="p-4 border rounded mb-5" style="background: rgba(25, 21, 19, 0.6); border-color: rgba(201, 162, 75, 0.25) !important; box-shadow: 0 10px 30px rgba(0,0,0,0.45);">
          <h5 class="font-display text-gold border-bottom pb-2 mb-4" style="font-weight:700;">
              <i class="fa-solid fa-crown text-gold me-2"></i>RANISAHAB ORDER JOURNEY
          </h5>
          
          <div class="premium-stepper-timeline">
              @foreach ($statusSequenceList as $seqIndex => $statusKey)
                  @php
                      $stageInfo = $stagesMapping[$statusKey];
                      $completedAt = $mappedCompletionTimes[$statusKey];
                      $isCompleted = !is_null($completedAt);
                      $isActive = ($statusKey === $currentOrderState);
                  @endphp
                  
                  <div class="timeline-step-row {{ $isCompleted ? 'completed' : '' }} {{ $isActive ? 'active' : '' }}">
                      <!-- Bubble -->
                      <div class="timeline-step-bubble">
                          @if ($isCompleted)
                              <i class="fa-solid fa-check"></i>
                          @else
                              <i class="fa-solid {{ $stageInfo['icon'] }}"></i>
                          @endif
                      </div>
                      
                      <!-- Card -->
                      <div class="timeline-step-content-card">
                          <div class="d-flex justify-content-between align-items-baseline flex-wrap gap-1">
                              <strong class="timeline-step-title">{{ $stageInfo['label'] }}</strong>
                              @if ($isCompleted)
                                  <span class="timeline-step-time">{{ $completedAt->format('d M Y, h:i A') }}</span>
                              @else
                                  <span class="timeline-step-time-pending text-muted" style="font-size:0.65rem;">Awaiting stage...</span>
                              @endif
                          </div>
                          <p class="timeline-step-desc">{{ $stageInfo['desc'] }}</p>
                          
                          <!-- Alert Logs -->
                          @if ($isCompleted)
                              <div class="d-flex align-items-center gap-2 mt-2 pt-2 border-top border-secondary border-opacity-10" style="font-size:0.68rem; color:rgba(201,162,75,0.65);">
                                  <i class="fa-solid fa-envelope text-gold"></i>
                                  <span>Order update notification sent to Email</span>
                              </div>
                          @endif
                      </div>
                  </div>
              @endforeach
          </div>
        </div>
      @endif

      <!-- Shiprocket Logistic Checkpoints Header -->
      <h5 class="font-display text-gold mb-3 px-1"><i class="fa-solid fa-truck-ramp-box text-gold me-2"></i>COURIER TRANSIT LOGS</h5>

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
                    <span class="badge bg-secondary bg-opacity-20 text-muted small" style="color:var(--gold-light) !important;"><i class="fa-solid fa-location-dot me-1"></i>{{ $activity['location'] }}</span>
                  </div>
                  <span class="track-time small text-muted">{{ date('d M, h:i A', strtotime($activity['date'])) }}</span>
                </div>
              </div>
            </div>
          @endforeach
        @else
          <div class="text-center py-5 rounded" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(201,162,75,0.15);">
            <i class="fa-solid fa-hourglass-start text-gold display-5 mb-3"></i>
            <p class="text-muted">Shipment scheduled. Waiting for Shiprocket pickup scan.</p>
          </div>
        @endif
      </div>

      <div class="d-flex gap-3 flex-wrap">
        <a href="{{ route('tracking') }}" class="btn btn-outline-gold flex-fill text-center py-3">TRACK ANOTHER SHIPMENT</a>
        <a href="https://wa.me/911234567890" target="_blank" class="btn btn-whatsapp flex-fill justify-content-center py-3"><i class="fa-brands fa-whatsapp fs-5 me-1"></i> NEED HELP? CHAT WITH US</a>
      </div>
    @endif

  </div>
</div>
@endsection

@push('styles')
<style>
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
  
  /* Premium Stepper Timeline styles overrides */
  .premium-stepper-timeline {
      display: flex;
      flex-direction: column;
      position: relative;
      padding-left: 20px;
      margin-top: 1.5rem;
  }
  .premium-stepper-timeline::before {
      content: '';
      position: absolute;
      top: 10px;
      left: 31px;
      width: 2px;
      height: calc(100% - 20px);
      background: rgba(255,255,255,0.06);
      z-index: 1;
  }
  .timeline-step-row {
      display: flex;
      gap: 1.5rem;
      position: relative;
      z-index: 2;
      margin-bottom: 1.5rem;
  }
  .timeline-step-row:last-child {
      margin-bottom: 0;
  }
  .timeline-step-bubble {
      width: 24px;
      height: 24px;
      border-radius: 50%;
      background: #1c1815;
      border: 1px solid rgba(255,255,255,0.15);
      color: rgba(255,255,255,0.3);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.7rem;
      flex-shrink: 0;
      transition: all 0.3s ease;
  }
  .timeline-step-row.completed .timeline-step-bubble {
      background: var(--gold-dark);
      border-color: var(--gold);
      color: #000;
      box-shadow: 0 0 8px rgba(201, 162, 75, 0.3);
  }
  .timeline-step-row.active .timeline-step-bubble {
      background: var(--gold);
      border-color: var(--gold);
      color: #000;
      box-shadow: 0 0 12px var(--gold);
      transform: scale(1.1);
  }
  .timeline-step-content-card {
      background: rgba(255,255,255,0.01);
      border: 1px solid rgba(255,255,255,0.04);
      padding: 0.85rem 1.1rem;
      border-radius: 6px;
      flex-grow: 1;
      transition: all 0.3s ease;
  }
  .timeline-step-row.completed .timeline-step-content-card {
      background: rgba(201,162,75,0.015);
      border-color: rgba(201,162,75,0.1);
  }
  .timeline-step-row.active .timeline-step-content-card {
      background: rgba(201,162,75,0.04);
      border-color: rgba(201,162,75,0.25);
  }
  .timeline-step-title {
      font-family: var(--font-label);
      font-size: 0.82rem;
      letter-spacing: 0.05em;
      color: rgba(255,255,255,0.65);
      text-transform: uppercase;
  }
  .timeline-step-row.completed .timeline-step-title,
  .timeline-step-row.active .timeline-step-title {
      color: var(--gold-light);
  }
  .timeline-step-time {
      font-size: 0.72rem;
      color: var(--gold-light);
  }
  .timeline-step-time-pending {
      font-size: 0.68rem;
  }
  .timeline-step-desc {
      font-size: 0.78rem;
      color: rgba(251,248,241,0.45);
      margin: 0.3rem 0 0;
      line-height: 1.4;
  }
  .timeline-step-row.completed .timeline-step-desc,
  .timeline-step-row.active .timeline-step-desc {
      color: rgba(251,248,241,0.65);
  }
</style>
@endpush
