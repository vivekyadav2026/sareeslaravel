@extends('layouts.admin')

@section('title', 'Manage Coupons')

@section('content')
<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Coupon Campaigns</h5>
        <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary rounded-pill px-4">
            <i class="fas fa-plus me-2"></i> Add Coupon
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success border-0 bg-success bg-opacity-25 text-success rounded-3 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle w-100" id="coupons-table">
                <thead class="table-dark">
                    <tr>
                        <th>Code</th>
                        <th>Discount Type</th>
                        <th>Value</th>
                        <th>Min Order Value</th>
                        <th>Usage Count</th>
                        <th>Status</th>
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
        var table = $('#coupons-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.coupons.index') }}",
            columns: [
                { data: 'code', name: 'code', className: 'font-monospace fw-bold text-warning' },
                { data: 'type', name: 'type', className: 'text-capitalize' },
                { data: 'value', name: 'value' },
                { 
                    data: 'min_order_value', 
                    name: 'min_order_value',
                    render: function(data) {
                        return '₹' + parseFloat(data).toFixed(2);
                    }
                },
                { data: 'used_count', name: 'used_count', className: 'text-center font-monospace' },
                { data: 'status', name: 'status', className: 'text-center' },
                { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-end' }
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search coupon codes...",
                lengthMenu: "Show _MENU_ entries"
            }
        });

        // Delete Coupon Handler
        $(document).on('click', '.delete-coupon', function() {
            var id = $(this).data('id');
            var url = "{{ route('admin.coupons.destroy', ':id') }}".replace(':id', id);
            
            Swal.fire({
                title: 'Delete this coupon?',
                text: "Active campaigns using this code will stop working.",
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
