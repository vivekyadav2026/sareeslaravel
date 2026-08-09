@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Order: {{ $order->order_number }}</h4>
        <small class="text-muted">Placed on: {{ $order->created_at->format('d M Y H:i') }}</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Back</a>
        <a href="{{ route('admin.orders.invoice', $order->id) }}" target="_blank" class="btn btn-primary rounded-pill px-3">
            <i class="fas fa-print me-1"></i> Invoice
        </a>
        <a href="{{ route('admin.orders.packing-slip', $order->id) }}" target="_blank" class="btn btn-warning rounded-pill px-3">
            <i class="fas fa-box me-1"></i> Packing Slip
        </a>
        <a href="{{ route('admin.orders.shipping-label', $order->id) }}" target="_blank" class="btn btn-dark rounded-pill px-3">
            <i class="fas fa-tag me-1"></i> Shipping Label
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 bg-success bg-opacity-25 text-success rounded-3 mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="row">
    <!-- Left Column: Items, Status Controls, Timeline -->
    <div class="col-xl-8 mb-4">
        <!-- Order Items Card -->
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Order Items</h5>
                <span class="badge bg-secondary font-monospace text-uppercase">{{ $order->status }}</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-4">Product</th>
                                <th>SKU</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th class="pe-4 text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td class="ps-4 fw-semibold text-warning">{{ $item->product_name }}</td>
                                    <td class="font-monospace text-muted">{{ $item->product_sku }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>₹{{ number_format($item->price, 2) }}</td>
                                    <td class="pe-4 text-end fw-bold">₹{{ number_format($item->total, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Shipping & Order Status Control Card -->
        <div class="card shadow mb-4">
            <div class="card-header">
                <h5 class="mb-0 fw-bold">Order Operations & Fulfillment</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="status" class="form-label fw-semibold">Order Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="new" {{ $order->status === 'new' ? 'selected' : '' }}>New Order</option>
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="packed" {{ $order->status === 'packed' ? 'selected' : '' }}>Packed</option>
                                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="returned" {{ $order->status === 'returned' ? 'selected' : '' }}>Returned</option>
                                <option value="exchange" {{ $order->status === 'exchange' ? 'selected' : '' }}>Exchange</option>
                                <option value="refund" {{ $order->status === 'refund' ? 'selected' : '' }}>Refund</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="payment_status" class="form-label fw-semibold">Payment Status</label>
                            <select name="payment_status" id="payment_status" class="form-select">
                                <option value="unpaid" {{ $order->payment_status === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="partially_refunded" {{ $order->payment_status === 'partially_refunded' ? 'selected' : '' }}>Partially Refunded</option>
                                <option value="refunded" {{ $order->payment_status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="courier_name" class="form-label fw-semibold">Courier / Shipping Service</label>
                            <input type="text" name="courier_name" id="courier_name" class="form-control" value="{{ $order->courier_name }}" placeholder="e.g. DHL, BlueDart">
                        </div>
                        <div class="col-md-6">
                            <label for="tracking_number" class="form-label fw-semibold">Tracking Number / AWB</label>
                            <input type="text" name="tracking_number" id="tracking_number" class="form-control" value="{{ $order->tracking_number }}" placeholder="e.g. AWB1028302">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="status_comment" class="form-label fw-semibold">Timeline Comment / Reason for Update</label>
                        <input type="text" name="status_comment" id="status_comment" class="form-control" placeholder="Internal log message e.g. Courier picked up package.">
                    </div>

                    <button type="submit" class="btn btn-warning rounded-pill px-4">Save Configuration</button>
                </form>
            </div>
        </div>

        <!-- Order Timeline / Activity Logs -->
        <div class="card shadow mb-4">
            <div class="card-header">
                <h5 class="mb-0 fw-bold">Order Activity Timeline</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled position-relative border-start border-2 border-warning ms-3 ps-4 py-2">
                    @forelse($order->statusLogs as $log)
                        <li class="position-relative mb-4">
                            <span class="position-absolute bg-warning rounded-circle" style="width: 12px; height: 12px; left: -31px; top: 6px; border: 2px solid #111;"></span>
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="badge bg-dark text-capitalize text-warning">{{ $log->status }}</span>
                                <small class="text-muted">{{ $log->created_at->format('d M Y H:i') }}</small>
                            </div>
                            <p class="mb-0 text-white-50 small">{{ $log->comment ?: 'No log comments added.' }}</p>
                            @if($log->user)
                                <small class="text-muted d-block mt-1">Logged by: {{ $log->user->name }}</small>
                            @endif
                        </li>
                    @empty
                        <li class="position-relative">
                            <span class="position-absolute bg-warning rounded-circle" style="width: 12px; height: 12px; left: -31px; top: 6px; border: 2px solid #111;"></span>
                            <div class="text-muted small">No order timeline logs found. Updating statuses will populate this section.</div>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Addresses Card -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card shadow h-100">
                    <div class="card-header"><h6 class="mb-0 fw-bold">Shipping Address</h6></div>
                    <div class="card-body">
                        @if($shippingAddress)
                            <p class="mb-0 text-white-50 small">
                                {{ $shippingAddress->address_line_1 }}<br>
                                @if($shippingAddress->address_line_2) {{ $shippingAddress->address_line_2 }}<br> @endif
                                {{ $shippingAddress->city }}, {{ $shippingAddress->state }} - {{ $shippingAddress->postal_code }}<br>
                                {{ $shippingAddress->country }}
                            </p>
                        @else
                            <span class="text-muted">No shipping address recorded.</span>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-3">
                <div class="card shadow h-100">
                    <div class="card-header"><h6 class="mb-0 fw-bold">Billing Address</h6></div>
                    <div class="card-body">
                        @if($billingAddress)
                            <p class="mb-0 text-white-50 small">
                                {{ $billingAddress->address_line_1 }}<br>
                                @if($billingAddress->address_line_2) {{ $billingAddress->address_line_2 }}<br> @endif
                                {{ $billingAddress->city }}, {{ $billingAddress->state }} - {{ $billingAddress->postal_code }}<br>
                                {{ $billingAddress->country }}
                            </p>
                        @else
                            <span class="text-muted">No billing address recorded.</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Customer Info, Payment Summary, Staff Notes -->
    <div class="col-xl-4 mb-4">
        <!-- Customer Summary Card -->
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="mb-0 fw-bold">Customer Profile</h6>
            </div>
            <div class="card-body">
                @if($order->customer)
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($order->customer->first_name . ' ' . $order->customer->last_name) }}&background=c5a880&color=fff" alt="Avatar" class="rounded-circle" width="50" height="50">
                        <div>
                            <h6 class="mb-0 fw-bold">{{ $order->customer->first_name }} {{ $order->customer->last_name }}</h6>
                            <a href="{{ route('admin.customers.show', $order->customer->id) }}" class="small text-warning">View profile info</a>
                        </div>
                    </div>
                    <hr>
                    <p class="mb-1 small"><strong>Email:</strong> {{ $order->customer->email }}</p>
                    <p class="mb-1 small"><strong>Phone:</strong> {{ $order->customer->phone ?: 'N/A' }}</p>
                @else
                    <span class="text-muted">Guest Checkout</span>
                @endif
            </div>
        </div>

        <!-- Payment Breakdowns -->
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="mb-0 fw-bold">Payment Summary</h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-white-50">Subtotal</span>
                    <span>₹{{ number_format($order->subtotal, 2) }}</span>
                </div>
                @if($order->discount > 0)
                    <div class="d-flex justify-content-between mb-2 text-danger">
                        <span>Discount (Coupon: {{ $order->coupon_code ?: 'N/A' }})</span>
                        <span>-₹{{ number_format($order->discount, 2) }}</span>
                    </div>
                @endif
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-white-50">Shipping Charges</span>
                    <span>₹{{ number_format($order->shipping_charge, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-white-50">Taxes (GST 18%)</span>
                    <span>₹{{ number_format($order->tax, 2) }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-0 fw-bold fs-5 text-warning">
                    <span>Grand Total</span>
                    <span>₹{{ number_format($order->total, 2) }}</span>
                </div>
                
                <hr class="mt-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="small text-muted">Method:</span>
                    <span class="badge bg-secondary text-uppercase">{{ $order->payment_method }}</span>
                </div>
            </div>
        </div>

        <!-- Order Notes (Staff / Client notes panel) -->
        <div class="card shadow">
            <div class="card-header">
                <h6 class="mb-0 fw-bold">Staff Order Notes</h6>
            </div>
            <div class="card-body">
                <!-- Add note form -->
                <form action="{{ route('admin.orders.add-note', $order->id) }}" method="POST" class="mb-4">
                    @csrf
                    <div class="mb-2">
                        <textarea name="note" class="form-control form-control-sm" rows="3" placeholder="Type internal memo..." required></textarea>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="is_customer_visible" id="is_customer_visible" value="1">
                        <label class="form-check-label small text-muted" for="is_customer_visible">Visible to Customer</label>
                    </div>
                    <button type="submit" class="btn btn-sm btn-warning w-100 rounded-pill">Add Note</button>
                </form>

                <!-- Notes list -->
                <div class="d-flex flex-column gap-3 overflow-auto" style="max-height: 300px;">
                    @forelse($order->orderNotes as $note)
                        <div class="p-3 bg-dark bg-opacity-25 rounded-3 border">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <strong class="small text-warning">{{ $note->user->name ?? 'Staff' }}</strong>
                                <span class="badge {{ $note->is_customer_visible ? 'bg-info' : 'bg-secondary' }}" style="font-size: 9px;">
                                    {{ $note->is_customer_visible ? 'Visible' : 'Internal' }}
                                </span>
                            </div>
                            <p class="mb-1 text-white-50 small" style="line-height: 1.4;">{{ $note->note }}</p>
                            <small class="text-muted" style="font-size: 10px;">{{ $note->created_at->diffForHumans() }}</small>
                        </div>
                    @empty
                        <div class="text-center text-muted small py-3">No staff memos added to this order yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
