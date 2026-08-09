@extends('layouts.admin')

@section('title', 'Manage Admin Users')

@section('content')
<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Staff Directory</h5>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary rounded-pill px-4">
            <i class="fas fa-plus me-2"></i> Add Admin User
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success border-0 bg-success bg-opacity-25 text-success rounded-3 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle w-100" id="users-table">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Status</th>
                        <th>Last Login</th>
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
        var table = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.users.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name', className: 'fw-semibold' },
                { data: 'email', name: 'email' },
                { data: 'roles', name: 'roles', orderable: false, searchable: false },
                { data: 'status', name: 'status', className: 'text-center' },
                { data: 'last_login_at', name: 'last_login_at', defaultContent: '<span class="text-muted">Never</span>' },
                { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-end' }
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search staff...",
                lengthMenu: "Show _MENU_ entries"
            }
        });

        // Delete User Handler
        $(document).on('click', '.delete-user', function() {
            var id = $(this).data('id');
            var url = "{{ route('admin.users.destroy', ':id') }}".replace(':id', id);
            
            Swal.fire({
                title: 'Are you sure?',
                text: "Delete this admin user? They will lose access immediately.",
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
