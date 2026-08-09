@extends('layouts.app')

@section('title', 'My Account — RANISAHAB')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}?v={{ time() }}">
@endpush

@section('content')
<div class="customer-dashboard-wrapper">
    <div class="container">
        <div class="row">

            {{-- Sidebar --}}
            <div class="col-lg-3 col-md-4 mb-4">
                @include('customer.layouts.sidebar')
            </div>

            {{-- Main Content --}}
            <div class="col-lg-9 col-md-8">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Welcome Banner --}}
                <div class="dashboard-card p-4 mb-4" style="background: linear-gradient(135deg, #1c060a 0%, #130f0c 100%); border-color: rgba(201,162,75,0.35);">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="label-title text-gold mb-1" style="font-size:0.6rem; letter-spacing:0.18em;">WELCOME BACK</div>
                            <h2 class="font-display text-gold-light mb-2" style="font-size:1.8rem; font-weight:700;">Namaste, {{ $customer->first_name }}!</h2>
                            <p class="mb-0" style="font-size:0.83rem; color:rgba(251,248,241,0.55); line-height:1.7;">
                                Manage your orders, fitting specs, custom design requests, and boutique appointments — all in one place.
                            </p>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <div class="label-title text-gold" style="font-size:0.58rem; letter-spacing:0.16em;">MEMBER SINCE</div>
                            <div class="font-display text-white mt-1" style="font-size:1.05rem; font-weight:600;">{{ $customer->created_at->format('M Y') }}</div>
                        </div>
                    </div>
                </div>

                {{-- Metrics Row --}}
                <div class="row g-3 mb-4">
                    <div class="col-sm-6 col-lg-3">
                        <div class="metric-card">
                            <div class="metric-card-icon"><i class="fa-solid fa-bag-shopping"></i></div>
                            <div class="metric-card-info">
                                <h3>{{ $stats['orders_count'] }}</h3>
                                <p>Total Orders</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="metric-card">
                            <div class="metric-card-icon"><i class="fa-solid fa-heart"></i></div>
                            <div class="metric-card-info">
                                <h3>{{ $stats['wishlist_count'] ?? '—' }}</h3>
                                <p>Wishlist Items</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="metric-card">
                            <div class="metric-card-icon"><i class="fa-solid fa-scissors"></i></div>
                            <div class="metric-card-info">
                                <h3>{{ $stats['designs_count'] }}</h3>
                                <p>Custom Designs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="metric-card">
                            <div class="metric-card-icon"><i class="fa-solid fa-calendar-check"></i></div>
                            <div class="metric-card-info">
                                <h3>{{ $stats['appointments_count'] ?? '—' }}</h3>
                                <p>Consultations</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Action Widgets --}}
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="dashboard-card h-100 mb-0" style="border-color:rgba(201,162,75,0.22);">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div style="width:38px;height:38px;border-radius:8px;background:rgba(90,11,22,0.4);border:1px solid rgba(201,162,75,0.2);display:flex;align-items:center;justify-content:center;">
                                    <i class="fa-solid fa-ruler text-gold" style="font-size:0.9rem;"></i>
                                </div>
                                <h4 class="font-display mb-0" style="font-size:0.95rem; font-weight:700; letter-spacing:0.03em; color:var(--gold-light);">Fitting Spec Sheets</h4>
                            </div>
                            <p style="font-size:0.82rem; color:rgba(251,248,241,0.55); line-height:1.65; margin-bottom:1.2rem;">
                                Store precise body measurements — used directly by our master tailors for perfect bespoke fits on every custom creation.
                            </p>
                            <a href="{{ route('customer.measurements') }}" class="btn-outline-gold btn-sm" style="font-size:0.62rem; letter-spacing:0.1em; padding:0.5rem 1.2rem;">
                                UPDATE FIT SPECS <i class="fa-solid fa-pencil ms-1"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="dashboard-card h-100 mb-0" style="border-color:rgba(201,162,75,0.22);">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div style="width:38px;height:38px;border-radius:8px;background:rgba(90,11,22,0.4);border:1px solid rgba(201,162,75,0.2);display:flex;align-items:center;justify-content:center;">
                                    <i class="fa-solid fa-scissors text-gold" style="font-size:0.9rem;"></i>
                                </div>
                                <h4 class="font-display mb-0" style="font-size:0.95rem; font-weight:700; letter-spacing:0.03em; color:var(--gold-light);">Custom Bridal Designs</h4>
                            </div>
                            <p style="font-size:0.82rem; color:rgba(251,248,241,0.55); line-height:1.65; margin-bottom:1.2rem;">
                                Have a dream lehenga or saree vision? Submit your brief, upload reference images, and receive an exclusive design quotation.
                            </p>
                            <a href="{{ route('customer.custom-designs') }}" class="btn-outline-gold btn-sm" style="font-size:0.62rem; letter-spacing:0.1em; padding:0.5rem 1.2rem;">
                                NEW DESIGN REQUEST <i class="fa-solid fa-plus ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Recent Orders --}}
                <div class="dashboard-card">
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-clock-rotate-left text-gold" style="font-size:0.95rem;"></i>
                            <h4 class="font-display mb-0" style="font-size:1rem; font-weight:700; color:var(--gold-light);">Recent Orders</h4>
                        </div>
                        <a href="{{ route('customer.orders') }}" class="text-gold label-title" style="font-size:0.6rem; letter-spacing:0.12em; text-decoration:underline; text-underline-offset:3px;">VIEW ALL</a>
                    </div>

                    @if ($recentOrders->isEmpty())
                        <div class="text-center py-5">
                            <i class="fa-solid fa-bag-shopping mb-3" style="font-size:2.5rem; color:rgba(201,162,75,0.25);"></i>
                            <p class="mb-0" style="font-size:0.85rem; color:rgba(251,248,241,0.4);">You haven't placed any orders yet.</p>
                            <a href="{{ url('/sarees') }}" class="btn-outline-gold btn-sm mt-3 d-inline-block" style="font-size:0.62rem;">SHOP NOW</a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-luxury text-nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentOrders as $order)
                                        <tr>
                                            <td class="font-display" style="font-weight:600; color:var(--gold-light);">{{ $order->order_number }}</td>
                                            <td style="font-size:0.82rem; color:rgba(251,248,241,0.55);">{{ $order->created_at->format('d M Y') }}</td>
                                            <td>
                                                @if ($order->status === 'delivered')
                                                    <span class="badge badge-luxury-success">{{ $order->status }}</span>
                                                @elseif ($order->status === 'pending')
                                                    <span class="badge badge-luxury-pending">{{ $order->status }}</span>
                                                @elseif ($order->status === 'cancelled')
                                                    <span class="badge badge-luxury-danger">{{ $order->status }}</span>
                                                @else
                                                    <span class="badge badge-luxury-pending">{{ $order->status }}</span>
                                                @endif
                                            </td>
                                            <td style="font-weight:600; color:var(--ivory);">₹{{ number_format($order->total, 2) }}</td>
                                            <td>
                                                <a href="{{ route('customer.orders.show', $order->id) }}" class="btn-outline-gold py-1 px-3" style="font-size:0.58rem; letter-spacing:0.1em; padding:0.3rem 0.8rem;">DETAILS</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
