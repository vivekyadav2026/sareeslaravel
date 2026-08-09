@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<!-- Quick Action Banner -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card bg-dark border-warning border-opacity-50 text-white position-relative overflow-hidden shadow">
            <div class="card-body p-4 d-flex align-items-center justify-content-between position-relative z-1">
                <div>
                    <h4 class="fw-bold mb-1" style="color: var(--primary-gold);">Bridal E-commerce Executive Suite</h4>
                    <p class="mb-0 text-white-50">Manage luxury bookings, catalog items, and view live boutique performance metrics.</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary rounded-pill px-4 shadow-sm" onclick="Swal.fire('Quick Action', 'Redirecting to custom bridal booking...', 'info')">
                        <i class="fas fa-calendar-check me-2"></i> Book Bridal Consultation
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-light rounded-pill px-4">
                        <i class="fas fa-cog me-2"></i> System Settings
                    </a>
                </div>
            </div>
            <!-- Aesthetic Gold Ring in background -->
            <div class="position-absolute" style="right: -50px; bottom: -50px; width: 200px; height: 200px; border: 20px solid rgba(197, 168, 128, 0.1); border-radius: 50%;"></div>
        </div>
    </div>
</div>

<!-- Key Performance Metrics (Top Row) -->
<div class="row mb-4">
    <!-- Today's Revenue -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 bg-dark text-white shadow h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-uppercase text-white-50 fw-bold small">Today's Revenue</span>
                    <span class="text-success small"><i class="fas fa-arrow-up"></i> +12.5%</span>
                </div>
                <h2 class="fw-bold mb-1 text-warning">₹{{ number_format($todaySales, 2) }}</h2>
                <div class="text-white-50 small">Live updates from orders</div>
            </div>
        </div>
    </div>

    <!-- Monthly Sales -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 bg-dark text-white shadow h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-uppercase text-white-50 fw-bold small">Monthly Revenue</span>
                    <span class="text-success small"><i class="fas fa-arrow-up"></i> +8.2%</span>
                </div>
                <h2 class="fw-bold mb-1">₹{{ number_format($monthlySales, 2) }}</h2>
                <div class="text-white-50 small">Target goal: ₹500,000</div>
            </div>
        </div>
    </div>

    <!-- Conversion Rate -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 bg-dark text-white shadow h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-uppercase text-white-50 fw-bold small">Conversion Rate</span>
                    <span class="text-danger small"><i class="fas fa-arrow-down"></i> -0.4%</span>
                </div>
                <h2 class="fw-bold mb-1">{{ $conversionRate }}%</h2>
                <div class="text-white-50 small">Avg: 1.8% industry std</div>
            </div>
        </div>
    </div>

    <!-- Average Order Value -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 bg-dark text-white shadow h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-uppercase text-white-50 fw-bold small">Avg. Order Value</span>
                    <span class="text-success small"><i class="fas fa-arrow-up"></i> +4.1%</span>
                </div>
                <h2 class="fw-bold mb-1">₹{{ number_format($averageOrderValue, 2) }}</h2>
                <div class="text-white-50 small">Premium customer profile</div>
            </div>
        </div>
    </div>
</div>

<!-- Order Statuses & Inventory Quick Metrics -->
<div class="row mb-4">
    <div class="col-xl-2 col-md-4 mb-3">
        <div class="card text-center border-0 py-3 shadow">
            <div class="card-body py-2">
                <h4 class="fw-bold mb-1 text-primary">{{ $ordersCount }}</h4>
                <span class="text-muted small text-uppercase">Total Orders</span>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 mb-3">
        <div class="card text-center border-0 py-3 shadow">
            <div class="card-body py-2">
                <h4 class="fw-bold mb-1 text-warning">{{ $pendingOrders }}</h4>
                <span class="text-muted small text-uppercase">Pending Orders</span>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 mb-3">
        <div class="card text-center border-0 py-3 shadow">
            <div class="card-body py-2">
                <h4 class="fw-bold mb-1 text-success">{{ $deliveredOrders }}</h4>
                <span class="text-muted small text-uppercase">Delivered</span>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 mb-3">
        <div class="card text-center border-0 py-3 shadow">
            <div class="card-body py-2">
                <h4 class="fw-bold mb-1 text-danger">{{ $cancelledOrders }}</h4>
                <span class="text-muted small text-uppercase">Cancelled</span>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 mb-3">
        <div class="card text-center border-0 py-3 shadow">
            <div class="card-body py-2">
                <h4 class="fw-bold mb-1 text-info">{{ $customersCount }}</h4>
                <span class="text-muted small text-uppercase">Customers</span>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 mb-3">
        <div class="card text-center border-0 py-3 shadow">
            <div class="card-body py-2">
                <h4 class="fw-bold mb-1 text-secondary">{{ $lowStockCount }}</h4>
                <span class="text-muted small text-uppercase">Low Stock SKU</span>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row mb-4">
    <!-- Sales Chart -->
    <div class="col-xl-8 mb-4">
        <div class="card shadow h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0 fw-bold">Live Sales & Order Performance</h5>
                <span class="badge bg-warning bg-opacity-25 text-warning px-3 py-2 rounded-pill font-monospace">Annual Analytics</span>
            </div>
            <div class="card-body">
                <div style="height: 350px;">
                    <canvas id="performanceChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Inventory / Quick Actions Panel -->
    <div class="col-xl-4 mb-4">
        <div class="card shadow h-100">
            <div class="card-header">
                <h5 class="card-title mb-0 fw-bold">Low Stock & Catalog Warnings</h5>
            </div>
            <div class="card-body">
                @if($lowStockProducts->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($lowStockProducts as $variant)
                            <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <h6 class="mb-0 fw-semibold">{{ $variant->product->name ?? 'Unknown Product' }}</h6>
                                    <small class="text-muted">SKU: {{ $variant->sku }} | Size: {{ $variant->size }}</small>
                                </div>
                                <span class="badge bg-danger rounded-pill">{{ $variant->stock }} left</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-check-circle text-success fs-1 mb-3"></i>
                        <p class="mb-0">Inventory is healthy! No low stock warnings.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Tables & Operations Info -->
<div class="row">
    <!-- Recent Orders -->
    <div class="col-xl-7 mb-4">
        <div class="card shadow h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-bold">Recent Orders</h5>
                <button class="btn btn-sm btn-outline-warning rounded-pill" onclick="Swal.fire('Manage Orders', 'Loading complete orders list...', 'success')">View All</button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-4">Order Number</th>
                                <th>Customer</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th class="pe-4 text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                                <tr>
                                    <td class="ps-4 fw-semibold font-monospace">{{ $order->order_number }}</td>
                                    <td>
                                        <div>{{ $order->customer->first_name ?? 'Guest' }} {{ $order->customer->last_name ?? '' }}</div>
                                        <small class="text-muted">{{ $order->customer->email ?? '' }}</small>
                                    </td>
                                    <td>
                                        @if($order->status === 'delivered')
                                            <span class="badge bg-success bg-opacity-25 text-success px-3 py-2 rounded-pill">Delivered</span>
                                        @elseif($order->status === 'pending')
                                            <span class="badge bg-warning bg-opacity-25 text-warning px-3 py-2 rounded-pill">Pending</span>
                                        @elseif($order->status === 'cancelled')
                                            <span class="badge bg-danger bg-opacity-25 text-danger px-3 py-2 rounded-pill">Cancelled</span>
                                        @else
                                            <span class="badge bg-info bg-opacity-25 text-info px-3 py-2 rounded-pill">{{ ucfirst($order->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="fw-bold">₹{{ number_format($order->total, 2) }}</td>
                                    <td class="pe-4 text-end">
                                        <button class="btn btn-sm btn-light rounded-circle shadow-sm" onclick="Swal.fire('View Order', 'Viewing details for {{ $order->order_number }}', 'info')">
                                            <i class="fas fa-eye text-primary"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Customers -->
    <div class="col-xl-5 mb-4">
        <div class="card shadow h-100">
            <div class="card-header">
                <h5 class="card-title mb-0 fw-bold">Recent Customers & Active Logins</h5>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-customers-tab" data-bs-toggle="pill" data-bs-target="#pills-customers" type="button">Customers</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-logs-tab" data-bs-toggle="pill" data-bs-target="#pills-logs" type="button">System Logs</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <!-- Customers Tab -->
                    <div class="tab-pane fade show active" id="pills-customers" role="tabpanel">
                        <div class="d-flex flex-column gap-3 mt-2">
                            @forelse($recentCustomers as $customer)
                                <div class="d-flex align-items-center justify-content-between p-2 rounded hover-bg-dark">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($customer->first_name . ' ' . $customer->last_name) }}&background=c5a880&color=fff" alt="Avatar" class="rounded-circle" width="40" height="40">
                                        <div>
                                            <h6 class="mb-0 fw-semibold">{{ $customer->first_name }} {{ $customer->last_name }}</h6>
                                            <small class="text-muted">{{ $customer->email }}</small>
                                        </div>
                                    </div>
                                    <span class="badge bg-warning bg-opacity-25 text-warning font-monospace">Pts: {{ $customer->reward_points }}</span>
                                </div>
                            @empty
                                <div class="text-center py-4 text-muted">No new customers found.</div>
                            @endforelse
                        </div>
                    </div>
                    
                    <!-- Logs Tab -->
                    <div class="tab-pane fade" id="pills-logs" role="tabpanel">
                        <div class="timeline mt-2">
                            @forelse($recentActivity as $log)
                                <div class="mb-3 d-flex gap-3 align-items-start">
                                    <div class="mt-1"><i class="fas fa-info-circle text-warning"></i></div>
                                    <div>
                                        <h6 class="mb-0 fw-semibold" style="font-size: 14px;">{{ $log->user->name ?? 'System' }} - {{ $log->action }}</h6>
                                        <small class="text-muted" style="font-size: 12px;">{{ $log->details }} | IP: {{ $log->ip_address }}</small>
                                        <div class="text-muted small" style="font-size: 11px;">{{ $log->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4 text-muted">No system activity logs.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('performanceChart').getContext('2d');
        
        // Theme context colors
        const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark';
        const gridColor = isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.05)';
        const textColor = isDark ? '#adb5bd' : '#495057';
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [
                    {
                        type: 'line',
                        label: 'Sales Revenue (₹)',
                        data: {!! json_encode($chartSales) !!},
                        borderColor: '#c5a880',
                        backgroundColor: 'rgba(197, 168, 128, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        yAxisID: 'y'
                    },
                    {
                        type: 'bar',
                        label: 'Order Count',
                        data: {!! json_encode($chartOrders) !!},
                        backgroundColor: 'rgba(255, 255, 255, 0.1)',
                        hoverBackgroundColor: '#c5a880',
                        borderWidth: 0,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: textColor,
                            font: {
                                family: 'Outfit'
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: gridColor
                        },
                        ticks: {
                            color: textColor,
                            font: {
                                family: 'Outfit'
                            }
                        }
                    },
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        grid: {
                            color: gridColor
                        },
                        ticks: {
                            color: textColor,
                            font: {
                                family: 'Outfit'
                            }
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        grid: {
                            drawOnChartArea: false
                        },
                        ticks: {
                            color: textColor,
                            font: {
                                family: 'Outfit'
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
