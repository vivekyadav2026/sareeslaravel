@extends('layouts.admin')

@section('title', 'Manage Categories')

@section('content')
<div class="row">
    <!-- Categories List -->
    <div class="col-md-8 mb-4">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0 fw-bold">Boutique Categories</h5>
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
                                <th>Slug</th>
                                <th>Description</th>
                                <th class="text-center">Products</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td class="fw-semibold">
                                        {{ $category->name }}
                                    </td>
                                    <td class="font-monospace text-warning">{{ $category->slug }}</td>
                                    <td>{{ $category->description ?: 'N/A' }}</td>
                                    <td class="text-center"><span class="badge bg-secondary rounded-pill">{{ $category->products_count }}</span></td>
                                    <td class="text-end">
                                        <button type="button" 
                                            class="btn btn-sm btn-light rounded-circle me-1 edit-category-btn"
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->name }}"
                                            data-desc="{{ $category->description }}">
                                            <i class="fas fa-edit text-warning"></i>
                                        </button>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light rounded-circle" {{ $category->products_count > 0 ? 'disabled' : '' }}>
                                                <i class="fas fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">No categories found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Category Form -->
    <div class="col-md-4 mb-4">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0 fw-bold">Create Category</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Category Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="e.g. Silk Sarees" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Category summary..."></textarea>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill">Create Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white border border-warning border-opacity-25 shadow-lg">
            <div class="modal-header border-bottom border-secondary">
                <h5 class="modal-title text-gold fw-bold"><i class="fas fa-edit me-2"></i>Edit Category</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCategoryForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label fw-semibold">Category Name</label>
                        <input type="text" class="form-control bg-secondary text-white border-0" id="edit_name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_description" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control bg-secondary text-white border-0" id="edit_description" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top border-secondary">
                    <button type="button" class="btn btn-outline-secondary text-white" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning rounded-pill px-4">Save Changes</button>
                </div>
            </form>
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
                title: 'Delete category?',
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

        $('.edit-category-btn').click(function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var desc = $(this).data('desc');

            // Set Form action url dynamically
            var actionUrl = "{{ route('admin.categories.update', ':id') }}".replace(':id', id);
            $('#editCategoryForm').attr('action', actionUrl);

            // Populate form values
            $('#edit_name').val(name);
            $('#edit_description').val(desc);

            // Open Modal
            var editModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
            editModal.show();
        });
    });
</script>
@endpush
