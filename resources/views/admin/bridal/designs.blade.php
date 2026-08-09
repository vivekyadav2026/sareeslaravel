@extends('layouts.admin')

@section('title', 'Custom Bridal Designs')

@section('content')
<div class="card shadow">
    <div class="card-header">
        <h5 class="mb-0 fw-bold text-warning"><i class="fas fa-magic me-2"></i> Custom Bridal Saree & Lehenga Requests</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle w-100" id="designs-table">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Client Details</th>
                        <th>Fabric Preference</th>
                        <th>Budget Estimate</th>
                        <th>Quotation Value</th>
                        <th>Est. Delivery</th>
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

<!-- Quotation Generation Modal -->
<div class="modal fade" id="quoteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="quote-form" class="modal-content bg-dark border">
            @csrf
            <input type="hidden" name="design_id" id="quote-id">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-warning">Generate Couture Design Quotation</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="estimated_price" class="form-label fw-semibold">Quoted Price (INR)</label>
                    <input type="number" step="0.01" class="form-control" name="estimated_price" id="quote-price" required placeholder="0.00">
                </div>
                <div class="mb-3">
                    <label for="estimated_delivery_date" class="form-label fw-semibold">Estimated Delivery Date</label>
                    <input type="date" class="form-control" name="estimated_delivery_date" id="quote-date" required>
                </div>
                <div class="mb-3">
                    <label for="admin_notes" class="form-label fw-semibold">Stitching Details & Styling Notes</label>
                    <textarea class="form-control" name="admin_notes" id="quote-notes" rows="3" placeholder="Fabric, borders, embroidery style specifications..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning rounded-pill px-4">Send Quotation</button>
            </div>
        </form>
    </div>
</div>

<!-- Details Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark border">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-warning">Design & Pattern Specifications</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="details-text" class="text-light" style="white-space: pre-line;"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('#designs-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.designs.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'customer', name: 'customer' },
                { data: 'fabric_preference', name: 'fabric_preference' },
                { data: 'budget_range', name: 'budget_range' },
                { data: 'estimated_price', name: 'estimated_price' },
                { data: 'delivery_date', name: 'delivery_date' },
                { data: 'status', name: 'status', className: 'text-center' },
                { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-end' }
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search custom requests...",
                lengthMenu: "Show _MENU_ entries"
            }
        });

        // Trigger Quotation Modal
        $(document).on('click', '.action-quote', function() {
            var id = $(this).data('id');
            var price = $(this).data('price');
            var date = $(this).data('date');
            var notes = $(this).data('notes');

            $('#quote-id').val(id);
            $('#quote-price').val(price);
            $('#quote-date').val(date);
            $('#quote-notes').val(notes);
            $('#quoteModal').modal('show');
        });

        // Show details request pattern
        $(document).on('click', '.action-details', function() {
            var details = $(this).data('details');
            $('#details-text').text(details);
            $('#detailsModal').modal('show');
        });

        // Send Quotation form submit
        $('#quote-form').submit(function(e) {
            e.preventDefault();
            var id = $('#quote-id').val();
            var url = "{{ route('admin.designs.quote', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                type: 'POST',
                data: $(this).serialize(),
                success: function(res) {
                    if (res.success) {
                        $('#quoteModal').modal('hide');
                        Swal.fire('Quotation Sent!', res.message, 'success');
                        table.ajax.reload(null, false);
                    }
                }
            });
        });
    });
</script>
@endpush
