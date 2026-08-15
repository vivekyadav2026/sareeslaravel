@extends('layouts.admin')

@section('title', 'Manage Products')

@section('content')
<div class="row mb-4">
    <!-- Stat Widgets -->
    <div class="col-md-4 mb-3">
        <div class="card bg-dark border-0 shadow h-100">
            <div class="card-body py-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-white-50 text-uppercase fw-semibold mb-1 small">Total Catalog Items</h6>
                        <h3 class="fw-bold mb-0 text-warning">{{ $totalProducts }}</h3>
                    </div>
                    <div class="p-3 rounded-circle bg-warning bg-opacity-10 text-warning"><i class="fas fa-gem fs-4"></i></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-3">
        <div class="card bg-dark border-0 shadow h-100">
            <div class="card-body py-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-white-50 text-uppercase fw-semibold mb-1 small">Active In Boutique</h6>
                        <h3 class="fw-bold mb-0 text-success">{{ $activeProducts }}</h3>
                    </div>
                    <div class="p-3 rounded-circle bg-success bg-opacity-10 text-success"><i class="fas fa-check-circle fs-4"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card bg-dark border-0 shadow h-100">
            <div class="card-body py-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-white-50 text-uppercase fw-semibold mb-1 small">Pending Approvals</h6>
                        <h3 class="fw-bold mb-0 text-danger">{{ $pendingApproval }}</h3>
                    </div>
                    <div class="p-3 rounded-circle bg-danger bg-opacity-10 text-danger"><i class="fas fa-clock fs-4"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Products List</h5>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary rounded-pill px-4">
            <i class="fas fa-plus me-2"></i> Add Product
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success border-0 bg-success bg-opacity-25 text-success rounded-3 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filter Row -->
        <div class="row g-3 mb-4 p-3 bg-dark bg-opacity-25 rounded-3 border">
            <div class="col-md-3">
                <label class="form-label small fw-semibold text-muted">Search Product</label>
                <div class="input-group">
                    <span class="input-group-text bg-secondary border-0 text-white"><i class="fas fa-search"></i></span>
                    <input type="text" id="filter-search" class="form-control bg-dark text-white border-secondary" placeholder="Search by name, SKU...">
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-semibold text-muted">Category</label>
                <select id="filter-category" class="form-select bg-dark text-white border-secondary">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-semibold text-muted">Status</label>
                <select id="filter-status" class="form-select bg-dark text-white border-secondary">
                    <option value="">All Statuses</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-semibold text-muted">Approval</label>
                <select id="filter-approval" class="form-select bg-dark text-white border-secondary">
                    <option value="">All Approvals</option>
                    <option value="approved">Approved</option>
                    <option value="pending">Pending</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button id="reset-filters" class="btn btn-light w-100 rounded-pill"><i class="fas fa-undo me-2"></i> Reset</button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle w-100" id="products-table">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Base Price</th>
                        <th>Status</th>
                        <th>Approval</th>
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
        var table = $('#products-table').DataTable({
            processing: true,
            serverSide: true,
            dom: 'lrtip', // Hide default duplicate search bar ('f')
            ajax: {
                url: "{{ route('admin.products.index') }}",
                data: function(d) {
                    d.category_id = $('#filter-category').val();
                    d.status = $('#filter-status').val();
                    d.approval = $('#filter-approval').val();
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name', className: 'fw-semibold' },
                { data: 'sku', name: 'sku', defaultContent: '<span class="text-muted">N/A</span>' },
                { data: 'category', name: 'category', orderable: false, searchable: false },
                { data: 'brand', name: 'brand', orderable: false, searchable: false },
                { data: 'price', name: 'price' },
                { data: 'status', name: 'status', className: 'text-center' },
                { data: 'approved', name: 'approved', className: 'text-center' },
                { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-end' }
            ],
            language: {
                lengthMenu: "Show _MENU_ entries"
            }
        });

        // Trigger search on typing in the custom filter-search box
        $('#filter-search').on('keyup change clear', function() {
            table.search(this.value).draw();
        });

        $('#filter-category, #filter-status, #filter-approval').change(function() {
            table.draw();
        });

        $('#reset-filters').click(function() {
            $('#filter-search').val('');
            $('#filter-category').val('');
            $('#filter-status').val('');
            $('#filter-approval').val('');
            table.search('').draw();
        });

        // Delete Product Handler
        $(document).on('click', '.delete-product', function() {
            var id = $(this).data('id');
            var url = "{{ route('admin.products.destroy', ':id') }}".replace(':id', id);
            
            Swal.fire({
                title: 'Delete this product?',
                text: "All associated variants and images will be permanently removed.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#c5a880',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                );
                                table.ajax.reload(null, false);
                            }
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
