@extends('layouts.admin')

@section('title', 'Manage Orders')

@section('content')
<div class="row mb-4">
    <!-- Stat Cards -->
    <div class="col-md-3 mb-3">
        <div class="card bg-dark border-0 shadow h-100">
            <div class="card-body">
                <h6 class="text-white-50 text-uppercase fw-semibold mb-1 small">Total Orders</h6>
                <h3 class="fw-bold mb-0 text-warning">{{ $totalOrders }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-dark border-0 shadow h-100">
            <div class="card-body">
                <h6 class="text-white-50 text-uppercase fw-semibold mb-1 small">Pending Orders</h6>
                <h3 class="fw-bold mb-0 text-info">{{ $pendingOrders }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-dark border-0 shadow h-100">
            <div class="card-body">
                <h6 class="text-white-50 text-uppercase fw-semibold mb-1 small">Delivered Orders</h6>
                <h3 class="fw-bold mb-0 text-success">{{ $deliveredOrders }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-dark border-0 shadow h-100">
            <div class="card-body">
                <h6 class="text-white-50 text-uppercase fw-semibold mb-1 small">Gross Revenue</h6>
                <h3 class="fw-bold mb-0 text-warning">₹{{ number_format($totalEarnings, 2) }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-header">
        <h5 class="mb-0 fw-bold">Orders Directory</h5>
    </div>
    <div class="card-body">
        <!-- Advanced Filters -->
        <div class="row g-3 mb-4 p-3 bg-dark bg-opacity-25 rounded-3 border">
            <div class="col-md-4">
                <label for="filter-status" class="form-label small fw-semibold text-muted">Order Status</label>
                <select id="filter-status" class="form-select">
                    <option value="">All Orders</option>
                    <option value="new">New</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="processing">Processing</option>
                    <option value="packed">Packed</option>
                    <option value="shipped">Shipped</option>
                    <option value="delivered">Delivered</option>
                    <option value="cancelled">Cancelled</option>
                    <option value="returned">Returned</option>
                    <option value="exchange">Exchange</option>
                    <option value="refund">Refund</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="filter-payment" class="form-label small fw-semibold text-muted">Payment Status</label>
                <select id="filter-payment" class="form-select">
                    <option value="">All Payments</option>
                    <option value="paid">Paid</option>
                    <option value="unpaid">Unpaid</option>
                    <option value="partially_refunded">Partially Refunded</option>
                    <option value="refunded">Refunded</option>
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button id="reset-filters" class="btn btn-light w-100 rounded-pill"><i class="fas fa-undo me-2"></i> Reset Filters</button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle w-100" id="orders-table">
                <thead class="table-dark">
                    <tr>
                        <th>Order Number</th>
                        <th>Customer</th>
                        <th>Payment Status</th>
                        <th>Order Status</th>
                        <th>Grand Total</th>
                        <th>Order Date</th>
                        <th style="width: 120px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('#orders-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.orders.index') }}",
                data: function(d) {
                    d.status = $('#filter-status').val();
                    d.payment_status = $('#filter-payment').val();
                }
            },
            columns: [
                { data: 'order_number', name: 'order_number', className: 'font-monospace fw-semibold' },
                { data: 'customer', name: 'customer' },
                { data: 'payment', name: 'payment_status', className: 'text-center' },
                { data: 'status', name: 'status', className: 'text-center' },
                { data: 'total', name: 'total', className: 'fw-bold' },
                { data: 'date', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-end' }
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search orders...",
                lengthMenu: "Show _MENU_ entries"
            },
            order: [[5, 'desc']]
        });

        $('#filter-status, #filter-payment').change(function() {
            table.draw();
        });

        $('#reset-filters').click(function() {
            $('#filter-status').val('');
            $('#filter-payment').val('');
            table.draw();
        });
    });
</script>
@endpush
