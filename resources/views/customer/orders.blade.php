@extends('layouts.app')

@section('title', 'My Orders — RANISAHAB')

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
            
            <!-- Orders History Content -->
            <div class="col-lg-9 col-md-8">
                
                <div class="dashboard-card">
                    <h4 class="font-display text-maroon mb-3 border-bottom pb-2" style="font-weight:700;">
                        <i class="fa-solid fa-clock-rotate-left me-2 text-gold"></i>Order History
                    </h4>
                    
                    @if ($orders->isEmpty())
                        <div class="text-center py-5">
                            <i class="fa-solid fa-bag-shopping text-muted mb-2" style="font-size:3rem;"></i>
                            <p class="mb-0 text-muted">You haven't placed any orders yet. Explore our luxury sarees and lehengas to get started!</p>
                            <a href="{{ route('home') }}" class="btn-gold btn-sm mt-3">BROWSE CATALOG <i class="fa-solid fa-gem ms-1"></i></a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-luxury text-nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Date</th>
                                        <th>Fulfillment Status</th>
                                        <th>Payment Status</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="font-display" style="font-weight:600;">{{ $order->order_number }}</td>
                                            <td style="font-size:0.85rem;">{{ $order->created_at->format('d M Y') }}</td>
                                            <td>
                                                @if ($order->status === 'delivered')
                                                    <span class="badge badge-luxury-success">{{ $order->status }}</span>
                                                @elseif ($order->status === 'pending')
                                                    <span class="badge badge-luxury-pending">{{ $order->status }}</span>
                                                @elseif ($order->status === 'cancelled')
                                                    <span class="badge badge-luxury-danger">{{ $order->status }}</span>
                                                @else
                                                    <span class="badge badge-luxury-pending" style="background-color:rgba(197, 168, 128, 0.15); color:var(--gold-dark); border-color:var(--gold);">{{ $order->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($order->payment_status === 'paid')
                                                    <span class="badge badge-luxury-success"><i class="fa-solid fa-circle-check me-1"></i> Paid</span>
                                                @else
                                                    <span class="badge badge-luxury-danger"><i class="fa-solid fa-clock me-1"></i> Unpaid</span>
                                                @endif
                                            </td>
                                            <td style="font-weight:600;">₹{{ number_format($order->total, 2) }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('customer.orders.show', $order->id) }}" class="btn-outline-gold py-1 px-3" style="font-size:0.6rem; padding: 0.3rem 0.8rem;">VIEW DETAILS</a>
                                                    <a href="{{ route('customer.orders.certificate', $order->id) }}" target="_blank" class="btn-outline-gold py-1 px-3" style="font-size:0.6rem; padding: 0.3rem 0.8rem; background: rgba(201, 162, 75, 0.1);"><i class="fa-solid fa-certificate text-gold me-1"></i>CERTIFICATE</a>
                                                </div>
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
