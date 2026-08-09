@extends('layouts.admin')

@section('title', 'Bridal Consultations')

@section('content')
<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Bridal Consultations Directory</h5>
    </div>
    <div class="card-body">
        <!-- Status Filter -->
        <div class="row g-3 mb-4 p-3 bg-dark bg-opacity-25 rounded-3 border">
            <div class="col-md-4">
                <label for="filter-status" class="form-label small fw-semibold text-muted">Consultation Status</label>
                <select id="filter-status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button id="reset-filters" class="btn btn-light w-100 rounded-pill"><i class="fas fa-undo me-2"></i> Reset Filters</button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle w-100" id="appointments-table">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Client Details</th>
                        <th>Couture Package</th>
                        <th>Appointment Date</th>
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

<!-- Reschedule Modal -->
<div class="modal fade" id="rescheduleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="reschedule-form" class="modal-content bg-dark border">
            @csrf
            <input type="hidden" name="appointment_id" id="reschedule-id">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-warning">Reschedule Consultation</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="appointment_date" class="form-label fw-semibold">New Date & Time</label>
                    <input type="datetime-local" class="form-control" name="appointment_date" id="reschedule-date" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning rounded-pill px-4">Reschedule</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('#appointments-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.appointments.index') }}",
                data: function(d) {
                    d.status = $('#filter-status').val();
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'customer', name: 'customer' },
                { data: 'package', name: 'package', className: 'fw-semibold text-warning' },
                { data: 'date', name: 'appointment_date' },
                { data: 'status', name: 'status', className: 'text-center' },
                { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-end' }
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search client appointments...",
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

        // Confirm appointment handler
        $(document).on('click', '.action-confirm', function() {
            var id = $(this).data('id');
            var url = "{{ route('admin.appointments.confirm', ':id') }}".replace(':id', id);

            Swal.fire({
                title: 'Confirm Consultation?',
                text: "Confirm booking slot for this bridal appointment.",
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
                                Swal.fire('Confirmed!', res.message, 'success');
                                table.ajax.reload(null, false);
                            }
                        }
                    });
                }
            });
        });

        // Trigger Reschedule Modal
        $(document).on('click', '.action-reschedule', function() {
            var id = $(this).data('id');
            var date = $(this).data('date');
            $('#reschedule-id').val(id);
            $('#reschedule-date').val(date);
            $('#rescheduleModal').modal('show');
        });

        // Post Reschedule form
        $('#reschedule-form').submit(function(e) {
            e.preventDefault();
            var id = $('#reschedule-id').val();
            var url = "{{ route('admin.appointments.reschedule', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                type: 'POST',
                data: $(this).serialize(),
                success: function(res) {
                    if (res.success) {
                        $('#rescheduleModal').modal('hide');
                        Swal.fire('Rescheduled!', res.message, 'success');
                        table.ajax.reload(null, false);
                    }
                }
            });
        });
    });
</script>
@endpush
