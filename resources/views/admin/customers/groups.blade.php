@extends('layouts.admin')

@section('title', 'Manage Customer Groups')

@section('content')
<div class="row">
    <!-- Group List -->
    <div class="col-md-8 mb-4">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0 fw-bold">Customer Groups</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success border-0 bg-success bg-opacity-25 text-success rounded-3 mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger border-0 bg-danger bg-opacity-25 text-white rounded-3 mb-4">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Discount</th>
                                <th>Description</th>
                                <th class="text-center">Members Count</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($groups as $group)
                                <tr>
                                    <td class="fw-semibold">{{ $group->name }}</td>
                                    <td class="font-monospace text-warning">{{ $group->discount_percent }}%</td>
                                    <td>{{ $group->description ?: 'N/A' }}</td>
                                    <td class="text-center"><span class="badge bg-secondary rounded-pill">{{ $group->customers_count }}</span></td>
                                    <td class="text-end">
                                        <form action="{{ route('admin.customer-groups.destroy', $group->id) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light rounded-circle" {{ $group->customers_count > 0 ? 'disabled' : '' }}>
                                                <i class="fas fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No customer groups found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Group Form -->
    <div class="col-md-4 mb-4">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0 fw-bold">Create Group</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.customer-groups.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Group Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="e.g. VIP Club" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="discount_percent" class="form-label fw-semibold">Discount Percent (%)</label>
                        <input type="number" step="0.01" class="form-control" id="discount_percent" name="discount_percent" placeholder="e.g. 10.00" min="0" max="100" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Optional details..."></textarea>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill">Create Group</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.delete-form').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Delete this group?',
                text: "This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#c5a880',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>
@endpush
