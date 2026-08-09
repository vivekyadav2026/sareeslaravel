@extends('layouts.admin')

@section('title', 'Makeup Artistry Bookings')

@section('content')
<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold"><i class="fas fa-sparkles text-warning me-2"></i> Makeup Artistry Sessions Directory</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle w-100" id="makeup-table">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Client Details</th>
                        <th>Artistry Service</th>
                        <th>Assigned Artist</th>
                        <th>Session Date & Time</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th style="width: 100px;" class="text-end">Actions</th>
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
        var table = $('#makeup-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.makeup-bookings.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'customer', name: 'customer' },
                { data: 'service', name: 'service', className: 'fw-semibold text-warning' },
                { data: 'artist_name', name: 'artist_name' },
                { data: 'date', name: 'booking_date' },
                { data: 'price', name: 'total_price' },
                { data: 'status', name: 'status', className: 'text-center' },
                { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-end' }
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search artistry bookings...",
                lengthMenu: "Show _MENU_ entries"
            }
        });

        // Confirm booking action handler
        $(document).on('click', '.action-confirm-makeup', function() {
            var id = $(this).data('id');
            var url = "{{ route('admin.makeup-bookings.confirm', ':id') }}".replace(':id', id);

            Swal.fire({
                title: 'Confirm Makeup Session?',
                text: "Confirm booking slot for this artistry package.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#c5a880',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Confirm!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function(res) {
                            if (res.success) {
                                Swal.fire('Session Confirmed!', res.message, 'success');
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
