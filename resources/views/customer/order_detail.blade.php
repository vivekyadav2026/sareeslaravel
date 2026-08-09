@extends('layouts.app')

@section('title', 'Order Details — RANISAHAB')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}?v={{ time() }}">
@endpush

@section('content')
<div class="customer-dashboard-wrapper py-5">
    <div class="container">
        <div class="row">
            
            <!-- Sidebar -->
            <div class="col-lg-3 col-md-4 mb-4">
                @include('customer.layouts.sidebar')
            </div>
            
            <!-- Order Details Content -->
            <div class="col-lg-9 col-md-8">
                
                <div class="mb-3 d-flex align-items-center">
                    <a href="{{ route('customer.orders') }}" class="text-gold-dark label-title" style="font-size:0.7rem;"><i class="fa-solid fa-arrow-left me-1"></i> Back to Orders</a>
                </div>

                <div class="dashboard-card">
                    <!-- Heading -->
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 border-bottom pb-3">
                        <div>
                            <h3 class="font-display text-maroon mb-1" style="font-weight:700;">Order Details</h3>
                            <p class="text-muted mb-0 small" style="font-size:0.75rem;">ORDER #{{ $order->order_number }} &nbsp;✦&nbsp; PLACED ON {{ $order->created_at->format('d M Y H:i A') }}</p>
                        </div>
                        <div class="mt-2 mt-md-0 d-flex gap-2">
                            @if ($order->status === 'delivered')
                                <span class="badge badge-luxury-success">{{ $order->status }}</span>
                            @elseif ($order->status === 'pending')
                                <span class="badge badge-luxury-pending">{{ $order->status }}</span>
                            @elseif ($order->status === 'cancelled')
                                <span class="badge badge-luxury-danger">{{ $order->status }}</span>
                            @else
                                <span class="badge badge-luxury-pending" style="background-color:rgba(197, 168, 128, 0.15); color:var(--gold-dark); border-color:var(--gold);">{{ $order->status }}</span>
                            @endif

                            @if ($order->payment_status === 'paid')
                                <span class="badge badge-luxury-success"><i class="fa-solid fa-circle-check me-1"></i> Paid</span>
                            @else
                                <span class="badge badge-luxury-danger"><i class="fa-solid fa-clock me-1"></i> Unpaid</span>
                            @endif
                        </div>
                    </div>

                    <!-- Items Purchased Table -->
                    <h5 class="font-display text-gold-light mb-3" style="font-weight:700;">Items Purchased</h5>
                    <div class="table-responsive mb-4">
                        <table class="table align-middle table-luxury text-nowrap">
                            <thead>
                                <tr style="font-family:var(--font-label); font-size:0.65rem; letter-spacing:0.05em; text-transform:uppercase;">
                                    <th class="ps-3">Product Item</th>
                                    <th>SKU</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th class="text-end pe-3">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr style="font-size:0.85rem;">
                                        <td class="ps-3">
                                            <div class="fw-semibold text-gold-light">{{ $item->product_name }}</div>
                                        </td>
                                        <td class="text-muted">{{ $item->product_sku }}</td>
                                        <td>₹{{ number_format($item->price, 2) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td class="text-end pe-3 fw-bold text-gold">₹{{ number_format($item->total, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Order Summary and Billing/Shipping Info -->
                    <div class="row g-4">
                        <!-- Order Calculations -->
                        <div class="col-md-6 offset-md-6">
                            <div class="p-3 rounded border" style="background: rgba(255, 255, 255, 0.02); border-color: rgba(201, 162, 75, 0.15) !important;">
                                <h6 class="font-display border-bottom pb-2 mb-2 text-gold-light" style="font-weight:700;">Order Total Summary</h6>
                                
                                <div class="d-flex justify-content-between mb-2 small text-muted">
                                    <span>Subtotal</span>
                                    <span>₹{{ number_format($order->subtotal, 2) }}</span>
                                </div>
                                
                                @if ($order->discount > 0)
                                    <div class="d-flex justify-content-between mb-2 small text-success">
                                        <span>Discount @if($order->coupon_code) (Coupon: {{ $order->coupon_code }}) @endif</span>
                                        <span>- ₹{{ number_format($order->discount, 2) }}</span>
                                    </div>
                                @endif
                                
                                <div class="d-flex justify-content-between mb-2 small text-muted">
                                    <span>Shipping &amp; Handling</span>
                                    <span>₹{{ number_format($order->shipping_charge, 2) }}</span>
                                </div>

                                <div class="d-flex justify-content-between mb-2 small text-muted">
                                    <span>Tax (GST)</span>
                                    <span>₹{{ number_format($order->tax, 2) }}</span>
                                </div>

                                <div class="d-flex justify-content-between border-top pt-2 mt-2 fw-bold text-gold-light fs-5">
                                    <span>Grand Total</span>
                                    <span class="text-gold">₹{{ number_format($order->total, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping and Tracking Info -->
                    @if ($order->tracking_number)
                        <div class="mt-4 p-3 rounded border" style="background: rgba(201, 162, 75, 0.05); border-color: rgba(201, 162, 75, 0.25) !important;">
                            <h5 class="font-display text-gold-light mb-2" style="font-weight:700;"><i class="fa-solid fa-truck-fast text-gold me-2"></i>Shipping &amp; Logistics Tracker</h5>
                            <div class="row text-muted small align-items-center">
                                <div class="col-md-4">
                                    <strong>Courier Service:</strong> {{ $order->courier_name ?? 'Standard Express' }}
                                </div>
                                <div class="col-md-4">
                                    <strong>Tracking Number:</strong> <code class="text-gold-light" style="background: rgba(255,255,255,0.05); padding: 0.2rem 0.5rem; border-radius: 4px;">{{ $order->tracking_number }}</code>
                                </div>
                                <div class="col-md-4 mt-2 mt-md-0 text-md-end">
                                    <a href="{{ route('tracking') }}?number={{ $order->tracking_number }}" class="btn-outline-gold py-1 px-3" style="font-size:0.6rem; padding: 0.3rem 0.8rem;">
                                        TRACK ON PLATFORM <i class="fa-solid fa-magnifying-glass-location ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row g-4 mt-3">
                        <!-- Order Status Log Timeline -->
                        <div class="col-md-6">
                            <div class="p-3 border rounded h-100" style="background: var(--bg-black-soft); border-color: rgba(201, 162, 75, 0.15) !important;">
                                <h5 class="font-display text-gold-light border-bottom pb-2" style="font-weight:700;">
                                    <i class="fa-solid fa-timeline text-gold me-2"></i>Fulfillment Timeline
                                </h5>
                                
                                @if ($order->statusLogs->isEmpty())
                                    <ul class="timeline-log">
                                        <li class="timeline-item active">
                                            <div class="timeline-date">{{ $order->created_at->format('d M Y h:i A') }}</div>
                                            <div class="timeline-status">Order Placed</div>
                                            <p class="timeline-desc">Your order has been recorded successfully. Awaiting boutique confirmation.</p>
                                        </li>
                                    </ul>
                                @else
                                    <ul class="timeline-log">
                                        @foreach ($order->statusLogs as $index => $log)
                                            <li class="timeline-item @if($index === 0) active @endif">
                                                <div class="timeline-date">{{ $log->created_at->format('d M Y h:i A') }}</div>
                                                <div class="timeline-status">{{ ucfirst($log->status) }}</div>
                                                @if($log->notes)
                                                    <p class="timeline-desc">{{ $log->notes }}</p>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>

                        <!-- Customer Assistant Notes -->
                        <div class="col-md-6">
                            <div class="p-3 border rounded h-100" style="background: var(--bg-black-soft); border-color: rgba(201, 162, 75, 0.15) !important;">
                                <h5 class="font-display text-gold-light border-bottom pb-2" style="font-weight:700;">
                                    <i class="fa-solid fa-comment-dots text-gold me-2"></i>Boutique Assistance Notes
                                </h5>
                                
                                @if ($order->orderNotes->isEmpty())
                                    <div class="text-center py-4 text-muted small">
                                        <i class="fa-regular fa-comments mb-2" style="font-size:1.5rem; color:rgba(201, 162, 75, 0.25);"></i>
                                        <p class="mb-0">No custom styling or shipment assistance messages available.</p>
                                    </div>
                                @else
                                    <div class="d-grid gap-3">
                                        @foreach ($order->orderNotes as $note)
                                            <div class="p-2 rounded border" style="background: rgba(255,255,255,0.02); border-color: rgba(201,162,75,0.1) !important;">
                                                <div class="d-flex justify-content-between text-muted" style="font-size:0.68rem; font-family:var(--font-label);">
                                                    <span class="text-gold">Boutique Stylist</span>
                                                    <span>{{ $note->created_at->format('d M Y h:i A') }}</span>
                                                </div>
                                                <p class="mb-0 mt-1 text-gold-light" style="font-size:0.8rem; line-height:1.4;">{{ $note->note_text }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            
        </div>
    </div>
</div>
@endsection
