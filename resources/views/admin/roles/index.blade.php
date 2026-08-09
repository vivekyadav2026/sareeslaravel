@extends('layouts.admin')

@section('title', 'Manage Roles & Permissions')

@section('content')
<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Roles List</h5>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary rounded-pill px-4">
            <i class="fas fa-plus me-2"></i> Add New Role
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success border-0 bg-success bg-opacity-25 text-success rounded-3 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle w-100" id="roles-table">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th style="width: 250px;">Role Name</th>
                        <th>Permissions</th>
                        <th style="width: 150px;" class="text-end">Actions</th>
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
        var table = $('#roles-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.roles.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name', className: 'fw-semibold' },
                { data: 'permissions', name: 'permissions', orderable: false, searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-end' }
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search roles...",
                lengthMenu: "Show _MENU_ entries"
            }
        });

        // Delete Role Handler
        $(document).on('click', '.delete-role', function() {
            var id = $(this).data('id');
            var url = "{{ route('admin.roles.destroy', ':id') }}".replace(':id', id);
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
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
                                table.ajax.reload();
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    response.message,
                                    'error'
                                );
                            }
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                xhr.responseJSON.message || 'Something went wrong.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
