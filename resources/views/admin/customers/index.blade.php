@extends('layouts.admin')

@section('title', 'Manage Customers')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Customer Directory</h5>
    </div>
    <div class="card-body">
        <!-- Advanced Filters -->
        <div class="row g-3 mb-4 p-3 bg-dark bg-opacity-25 rounded-3 border">
            <div class="col-md-4">
                <label for="filter-status" class="form-label small fw-semibold text-muted">Filter by Status</label>
                <select id="filter-status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="active">Active</option>
                    <option value="blocked">Blocked</option>
                </select>
            </div>

            <div class="col-md-4 d-flex align-items-end">
                <button id="reset-filters" class="btn btn-light w-100 rounded-pill">
                    <i class="fas fa-undo me-2"></i> Reset Filters
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle w-100" id="customers-table">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>

                        <th>Wallet</th>
                        <th>Points</th>
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
        var table = $('#customers-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.customers.index') }}",
                data: function(d) {
                    d.status = $('#filter-status').val();

                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name', className: 'fw-semibold' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone', defaultContent: '<span class="text-muted">N/A</span>' },

                { 
                    data: 'wallet_balance', 
                    name: 'wallet_balance',
                    render: function(data) {
                        return '₹' + parseFloat(data).toFixed(2);
                    }
                },
                { data: 'reward_points', name: 'reward_points', className: 'text-center font-monospace' },
                { data: 'status', name: 'status', className: 'text-center' },
                { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-end' }
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search customers...",
                lengthMenu: "Show _MENU_ entries"
            }
        });

        $('#filter-status').change(function() {
            table.draw();
        });

        $('#reset-filters').click(function() {
            $('#filter-status').val('');

            table.draw();
        });

        // Toggle Status Handler
        $(document).on('click', '.toggle-status', function() {
            var id = $(this).data('id');
            var status = $(this).data('status');
            var url = "{{ route('admin.customers.toggle-status', ':id') }}".replace(':id', id);
            var actionText = status === 'active' ? 'Block' : 'Activate';
            
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to " + actionText.toLowerCase() + " this customer account?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#c5a880',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, ' + actionText
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Updated!',
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
