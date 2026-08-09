@extends('layouts.admin')

@section('title', 'Fitting & Measurement Specs')

@section('content')
<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold"><i class="fas fa-cut me-2 text-warning"></i> Sizing & Fitting Measurement Sheets</h5>
        <a href="{{ route('admin.measurements.create') }}" class="btn btn-warning rounded-pill px-4 btn-sm fw-bold">
            <i class="fas fa-plus me-2"></i> Log Sizing Specs
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle w-100" id="measurements-table">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Client Details</th>
                        <th>Sheet Title</th>
                        <th>Bust (in)</th>
                        <th>Waist (in)</th>
                        <th>Hips (in)</th>
                        <th>Shoulder (in)</th>
                        <th>Lehenga L (in)</th>
                        <th>Created At</th>
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
        var table = $('#measurements-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.measurements.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'customer', name: 'customer' },
                { data: 'title', name: 'title', className: 'fw-semibold text-warning' },
                { data: 'bust', name: 'bust' },
                { data: 'waist', name: 'waist' },
                { data: 'hips', name: 'hips' },
                { data: 'shoulder', name: 'shoulder' },
                { data: 'lehenga_length', name: 'lehenga_length' },
                { data: 'created_at', name: 'created_at', render: function(data) {
                    return data ? data.substring(0, 10) : 'N/A';
                }},
                { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-end' }
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search measurement sheets...",
                lengthMenu: "Show _MENU_ entries"
            }
        });

        // Delete sizing sheet
        $(document).on('click', '.delete-sheet', function() {
            var id = $(this).data('id');
            var url = "{{ route('admin.measurements.destroy', ':id') }}".replace(':id', id);

            Swal.fire({
                title: 'Delete Sizing Sheet?',
                text: "This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Delete!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function(res) {
                            if (res.success) {
                                Swal.fire('Deleted!', res.message, 'success');
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
