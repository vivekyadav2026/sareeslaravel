@extends('layouts.app')

@section('title', 'Wallet & Rewards — RANISAHAB')

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
            
            <!-- Wallet ledger Content -->
            <div class="col-lg-9 col-md-8">
                
                <!-- Wallet & Rewards Summary Header -->
                <div class="row g-4 mb-4">
                    <!-- Wallet Balance Card -->
                    <div class="col-md-6">
                        <div class="dashboard-card h-100 bg-white" style="border-left: 4px solid var(--gold);">
                            <h5 class="font-display text-muted text-uppercase mb-2" style="font-size:0.72rem; letter-spacing:0.1em;">Ranisahab Digital Wallet</h5>
                            <h2 class="font-display text-maroon" style="font-weight:700; font-size:2.4rem;">₹{{ number_format($customer->wallet_balance, 2) }}</h2>
                            <p class="small text-muted mb-0">Use your wallet credits for instant, zero-click checkouts and priority refund processing.</p>
                        </div>
                    </div>

                    <!-- Reward Points Card -->
                    <div class="col-md-6">
                        <div class="dashboard-card h-100 bg-white" style="border-left: 4px solid var(--maroon);">
                            <h5 class="font-display text-muted text-uppercase mb-2" style="font-size:0.72rem; letter-spacing:0.1em;">Royal Loyalty Reward Points</h5>
                            <h2 class="font-display text-gold-dark" style="font-weight:700; font-size:2.4rem;">{{ $customer->reward_points }} <span class="fs-5 text-muted">pts</span></h2>
                            <p class="small text-muted mb-0">Earn 1 reward point for every ₹100 spent. Redeem points for exclusive boutique discounts and products.</p>
                        </div>
                    </div>
                </div>

                <!-- Transaction Ledger -->
                <div class="dashboard-card">
                    <h4 class="font-display text-maroon mb-3 border-bottom pb-2" style="font-weight:700;">
                        <i class="fa-solid fa-list-check me-2 text-gold"></i>Transaction History Ledger
                    </h4>
                    
                    @if ($transactions->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="fa-solid fa-receipt mb-2" style="font-size:2.5rem;"></i>
                            <p class="mb-0">No wallet transaction records found.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-luxury text-nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $tx)
                                        <tr>
                                            <td style="font-size:0.85rem;">{{ $tx->created_at->format('d M Y - h:i A') }}</td>
                                            <td style="font-size:0.85rem; max-width:300px; overflow:hidden; text-overflow:ellipsis;">{{ $tx->description }}</td>
                                            <td>
                                                @if ($tx->type === 'deposit')
                                                    <span class="badge badge-luxury-success"><i class="fa-solid fa-circle-arrow-down me-1"></i> Credit</span>
                                                @else
                                                    <span class="badge badge-luxury-danger"><i class="fa-solid fa-circle-arrow-up me-1"></i> Debit</span>
                                                @endif
                                            </td>
                                            <td style="font-weight:700;">
                                                @if ($tx->type === 'deposit')
                                                    <span class="text-success">+ ₹{{ number_format($tx->amount, 2) }}</span>
                                                @else
                                                    <span class="text-danger">- ₹{{ number_format($tx->amount, 2) }}</span>
                                                @endif
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
