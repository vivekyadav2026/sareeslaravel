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
                                <th>Image</th>
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
                                    <td>
                                        @if($category->image)
                                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid rgba(201,162,75,0.25);">
                                        @else
                                            <span class="text-muted small">No Image</span>
                                        @endif
                                    </td>
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
                                            data-desc="{{ $category->description }}"
                                            data-image="{{ $category->image ? asset($category->image) : '' }}">
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
                <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Category Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="e.g. Silk Sarees" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Category summary..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label fw-semibold">Category Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <small class="text-muted d-block mt-1">Will be displayed on the homepage categories layout.</small>
                        <div id="create_image_preview_container" class="mt-2 d-none">
                            <label class="d-block small text-muted mb-1">Selected Image Preview:</label>
                            <img id="create_image_preview" src="" alt="Selected Preview" style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px; border: 1px solid rgba(201,162,75,0.25);">
                        </div>
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
            <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
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

                    <div class="mb-3">
                        <label for="edit_image" class="form-label fw-semibold">Category Image</label>
                        <input type="file" class="form-control bg-secondary text-white border-0" id="edit_image" name="image" accept="image/*">
                        
                        <div class="d-flex gap-3 mt-3">
                            <!-- Current Image -->
                            <div id="edit_image_preview_container" class="d-none">
                                <label class="d-block small text-muted mb-1">Current Image:</label>
                                <img id="edit_image_preview" src="" alt="Preview" style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px; border: 1px solid rgba(201,162,75,0.25);">
                            </div>

                            <!-- New Selected Image Preview -->
                            <div id="edit_new_image_preview_container" class="d-none">
                                <label class="d-block small text-warning mb-1">New Selection:</label>
                                <img id="edit_new_image_preview" src="" alt="New Preview" style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px; border: 1px solid var(--gold);">
                            </div>
                        </div>
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
            var image = $(this).data('image');

            // Set Form action url dynamically
            var actionUrl = "{{ route('admin.categories.update', ':id') }}".replace(':id', id);
            $('#editCategoryForm').attr('action', actionUrl);

            // Populate form values
            $('#edit_name').val(name);
            $('#edit_description').val(desc);

            // Reset new selection preview
            $('#edit_image').val('');
            $('#edit_new_image_preview').attr('src', '');
            $('#edit_new_image_preview_container').addClass('d-none');

            // Handle current image preview
            if (image) {
                $('#edit_image_preview').attr('src', image);
                $('#edit_image_preview_container').removeClass('d-none');
            } else {
                $('#edit_image_preview_container').addClass('d-none');
            }

            // Open Modal
            var editModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
            editModal.show();
        });

        // Create Form: Live Image Preview
        $('#image').change(function() {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#create_image_preview').attr('src', e.target.result);
                    $('#create_image_preview_container').removeClass('d-none');
                }
                reader.readAsDataURL(file);
            } else {
                $('#create_image_preview_container').addClass('d-none');
            }
        });

        // Edit Form: Live Image Preview
        $('#edit_image').change(function() {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#edit_new_image_preview').attr('src', e.target.result);
                    $('#edit_new_image_preview_container').removeClass('d-none');
                }
                reader.readAsDataURL(file);
            } else {
                $('#edit_new_image_preview_container').addClass('d-none');
            }
        });
    });
</script>
@endpush
