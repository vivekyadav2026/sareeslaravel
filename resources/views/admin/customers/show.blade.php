@extends('layouts.admin')

@section('title', 'Customer Profile')

@section('content')
<div class="row">
    <!-- Left Column: Customer Summary -->
    <div class="col-xl-4 mb-4">
        <!-- Profile Summary Card -->
        <div class="card shadow mb-4">
            <div class="card-body text-center p-4">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($customer->first_name . ' ' . $customer->last_name) }}&background=c5a880&color=fff&size=100" alt="Avatar" class="rounded-circle mb-3 shadow-sm" width="100" height="100">
                <h4 class="fw-bold mb-1">{{ $customer->first_name }} {{ $customer->last_name }}</h4>
                <p class="text-muted small mb-3">Customer ID: #{{ $customer->id }}</p>
                
                <div class="d-flex justify-content-center mb-4">
                    @if($customer->status === 'active')
                        <span class="badge bg-success bg-opacity-25 text-success px-4 py-2 rounded-pill"><i class="fas fa-check-circle me-1"></i> Active Account</span>
                    @else
                        <span class="badge bg-danger bg-opacity-25 text-danger px-4 py-2 rounded-pill"><i class="fas fa-ban me-1"></i> Blocked Account</span>
                    @endif
                </div>

                <hr>

                <!-- Basic stats in columns -->
                <div class="row text-center mt-3 g-2">
                    <div class="col-6 border-end">
                        <small class="text-muted text-uppercase d-block mb-1 small fw-semibold">Wallet Balance</small>
                        <h5 class="fw-bold text-warning mb-0">₹{{ number_format($customer->wallet_balance, 2) }}</h5>
                    </div>
                    <div class="col-6">
                        <small class="text-muted text-uppercase d-block mb-1 small fw-semibold">Reward Points</small>
                        <h5 class="fw-bold text-info mb-0">{{ $customer->reward_points }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- CRM Actions Card (Group, Status, Notes) -->
        <div class="card shadow">
            <div class="card-header">
                <h6 class="mb-0 fw-bold">CRM Settings</h6>
            </div>
            <div class="card-body">
                <!-- Notes editor -->
                <form action="{{ route('admin.customers.update-notes', $customer->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="notes" class="form-label small fw-semibold text-muted">Internal Administration Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="Write any internal admin comments about this customer...">{{ old('notes', $customer->notes) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-warning w-100 rounded-pill">Save Notes</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Column: Tabs Dashboard -->
    <div class="col-xl-8 mb-4">
        @if(session('success'))
            <div class="alert alert-success border-0 bg-success bg-opacity-25 text-success rounded-3 mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger border-0 bg-danger bg-opacity-25 text-white rounded-3 mb-4">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-header p-0">
                <!-- Navigation Tabs -->
                <ul class="nav nav-tabs card-header-tabs border-bottom-0 m-0 w-100" id="profile-tabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active py-3 px-4" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button"><i class="fas fa-shopping-bag me-2"></i> Orders ({{ $orders->count() }})</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link py-3 px-4" id="wallet-tab" data-bs-toggle="tab" data-bs-target="#wallet" type="button"><i class="fas fa-wallet me-2"></i> Wallet Adjust</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link py-3 px-4" id="points-tab" data-bs-toggle="tab" data-bs-target="#points" type="button"><i class="fas fa-coins me-2"></i> Points Adjust</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link py-3 px-4" id="addresses-tab" data-bs-toggle="tab" data-bs-target="#addresses" type="button"><i class="fas fa-map-marker-alt me-2"></i> Addresses ({{ $customer->addresses->count() }})</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link py-3 px-4" id="wishlist-tab" data-bs-toggle="tab" data-bs-target="#wishlist" type="button"><i class="fas fa-heart me-2"></i> Wishlist ({{ $wishlist->count() }})</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link py-3 px-4" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button"><i class="fas fa-star me-2"></i> Reviews ({{ $reviews->count() }})</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link py-3 px-4" id="referrals-tab" data-bs-toggle="tab" data-bs-target="#referrals" type="button"><i class="fas fa-share-alt me-2"></i> Referrals ({{ $referredCustomers->count() }})</button>
                    </li>
                </ul>
            </div>
            
            <div class="card-body">
                <div class="tab-content" id="profile-tabs-content">
                    
                    <!-- 1. Orders Tab -->
                    <div class="tab-pane fade show active" id="orders" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Payment</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                        <tr>
                                            <td class="fw-semibold font-monospace">{{ $order->order_number }}</td>
                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <span class="badge bg-secondary bg-opacity-25 text-reset px-3 py-2 rounded-pill text-uppercase">{{ $order->status }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-info bg-opacity-25 text-info px-3 py-2 rounded-pill text-uppercase">{{ $order->payment_status }}</span>
                                            </td>
                                            <td class="fw-bold">₹{{ number_format($order->total, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">
                                                <i class="fas fa-shopping-bag fs-1 mb-3 opacity-50"></i>
                                                <p class="mb-0">This customer hasn't placed any orders yet.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- 2. Wallet Adjustment Tab -->
                    <div class="tab-pane fade" id="wallet" role="tabpanel">
                        <div class="row">
                            <div class="col-md-5 mb-4">
                                <h6 class="fw-bold mb-3">Adjust Wallet Funds</h6>
                                <form action="{{ route('admin.customers.adjust-wallet', $customer->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="wallet-type" class="form-label small fw-semibold">Action Type</label>
                                        <select name="type" id="wallet-type" class="form-select" required>
                                            <option value="deposit">Deposit (Add Funds)</option>
                                            <option value="withdrawal">Withdrawal (Deduct Funds)</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="wallet-amount" class="form-label small fw-semibold">Amount (INR)</label>
                                        <input type="number" step="0.01" name="amount" id="wallet-amount" class="form-control" placeholder="e.g. 500" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="wallet-description" class="form-label small fw-semibold">Reason / Description</label>
                                        <input type="text" name="description" id="wallet-description" class="form-control" placeholder="e.g. Loyalty cashback reward" required>
                                    </div>
                                    <button type="submit" class="btn btn-warning w-100 rounded-pill">Apply Adjustments</button>
                                </form>
                            </div>
                            
                            <div class="col-md-7 border-start ps-md-4">
                                <h6 class="fw-bold mb-3">Wallet History Log</h6>
                                <div class="table-responsive" style="max-height: 350px;">
                                    <table class="table table-sm align-middle">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Amount</th>
                                                <th>Description</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($customer->walletTransactions as $tx)
                                                <tr>
                                                    <td>
                                                        <span class="badge {{ $tx->type === 'deposit' ? 'bg-success' : 'bg-danger' }}">
                                                            {{ ucfirst($tx->type) }}
                                                        </span>
                                                    </td>
                                                    <td class="fw-bold {{ $tx->type === 'deposit' ? 'text-success' : 'text-danger' }}">
                                                        {{ $tx->type === 'deposit' ? '+' : '-' }}₹{{ number_format($tx->amount, 2) }}
                                                    </td>
                                                    <td>{{ $tx->description }}</td>
                                                    <td class="text-muted small">{{ $tx->created_at->format('M d H:i') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted py-4">No wallet transactions found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- 3. Points Adjustment Tab -->
                    <div class="tab-pane fade" id="points" role="tabpanel">
                        <div class="col-md-6 mx-auto py-3">
                            <h6 class="fw-bold text-center mb-4">Adjust Reward Points</h6>
                            <form action="{{ route('admin.customers.adjust-points', $customer->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="points-amount" class="form-label small fw-semibold">Points Delta (Positive to add, Negative to deduct)</label>
                                    <input type="number" name="points" id="points-amount" class="form-control" placeholder="e.g. 100 or -50" required>
                                </div>
                                <div class="mb-3">
                                    <label for="points-desc" class="form-label small fw-semibold">Reason</label>
                                    <input type="text" name="description" id="points-desc" class="form-control" placeholder="e.g. Special promotion bonus" required>
                                </div>
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-primary rounded-pill">Apply Points Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- 4. Addresses Tab -->
                    <div class="tab-pane fade" id="addresses" role="tabpanel">
                        <div class="row mt-2 g-3">
                            @forelse($customer->addresses as $address)
                                <div class="col-md-6">
                                    <div class="border p-3 rounded position-relative shadow-sm bg-dark bg-opacity-25">
                                        @if($address->is_default)
                                            <span class="badge bg-warning position-absolute" style="top: 15px; right: 15px;">Default</span>
                                        @endif
                                        <h6 class="fw-bold"><i class="fas fa-home me-2 text-warning"></i> Address</h6>
                                        <p class="mb-0 text-white-50 small mt-3">
                                            {{ $address->address_line_1 }}<br>
                                            @if($address->address_line_2) {{ $address->address_line_2 }}<br> @endif
                                            {{ $address->city }}, {{ $address->state }} - {{ $address->postal_code }}<br>
                                            {{ $address->country }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5 text-muted col-12">
                                    <i class="fas fa-map-marker-alt fs-1 mb-3 opacity-50"></i>
                                    <p>No billing or shipping addresses configured yet.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    
                    <!-- 5. Wishlist Tab -->
                    <div class="tab-pane fade" id="wishlist" role="tabpanel">
                        <div class="row mt-2 g-3">
                            @forelse($wishlist as $item)
                                <div class="col-md-6 col-lg-4">
                                    <div class="border p-3 rounded text-center shadow-sm">
                                        <i class="fas fa-gem fs-2 text-warning mb-2"></i>
                                        <h6 class="mb-1 text-truncate">{{ $item->product->name ?? 'Product' }}</h6>
                                        <p class="text-muted mb-0 font-monospace text-warning">₹{{ number_format($item->product->price ?? 0, 2) }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5 text-muted col-12">
                                    <i class="fas fa-heart fs-1 mb-3 opacity-50"></i>
                                    <p>Wishlist is empty.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    
                    <!-- 6. Reviews Tab -->
                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <div class="d-flex flex-column gap-3 mt-2">
                            @forelse($reviews as $review)
                                <div class="border p-3 rounded shadow-sm bg-dark bg-opacity-25">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0 fw-bold">{{ $review->product->name ?? 'Product' }}</h6>
                                        <div class="text-warning small">
                                            @for($r = 1; $r <= 5; $r++)
                                                <i class="fas fa-star {{ $r <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="mb-0 text-white-50 small">{{ $review->comment }}</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                                        <span class="badge {{ $review->is_approved ? 'bg-success bg-opacity-10 text-success' : 'bg-warning bg-opacity-10 text-warning' }} rounded-pill">
                                            {{ $review->is_approved ? 'Approved' : 'Pending Approval' }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5 text-muted">
                                    <i class="fas fa-star fs-1 mb-3 opacity-50"></i>
                                    <p>No reviews submitted yet.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    
                    <!-- 7. Referrals Tab -->
                    <div class="tab-pane fade" id="referrals" role="tabpanel">
                        <div class="p-3 border rounded bg-dark bg-opacity-25 mb-4">
                            <div class="row align-items-center">
                                <div class="col-md-6 border-end">
                                    <small class="text-muted d-block small mb-1 fw-semibold text-uppercase">Referral Code</small>
                                    <h4 class="fw-bold text-warning mb-0 font-monospace">{{ $customer->referral_code ?: 'N/A' }}</h4>
                                </div>
                                <div class="col-md-6 ps-md-4">
                                    <small class="text-muted d-block small mb-1 fw-semibold text-uppercase text-md-start">Referred By ID</small>
                                    <h4 class="fw-bold mb-0 text-white font-monospace">{{ $customer->referred_by ?: 'Direct signup' }}</h4>
                                </div>
                            </div>
                        </div>
                        
                        <h6 class="fw-bold mb-3">Referred Customers list</h6>
                        <div class="table-responsive">
                            <table class="table table-sm align-middle">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Registered Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($referredCustomers as $ref)
                                        <tr>
                                            <td class="fw-semibold">{{ $ref->first_name }} {{ $ref->last_name }}</td>
                                            <td>{{ $ref->email }}</td>
                                            <td><span class="badge bg-success bg-opacity-10 text-success">{{ $ref->status }}</span></td>
                                            <td>{{ $ref->created_at->format('M d, Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">This customer has not referred anyone yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
