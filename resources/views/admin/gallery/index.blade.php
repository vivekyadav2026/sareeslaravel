@extends('layouts.admin')

@section('title', 'Real Brides Gallery Management')

@section('content')
<div class="container-fluid py-3">

    <!-- Header & Stats Bar -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-gold mb-1"><i class="fas fa-images me-2"></i>Real Brides Gallery Management</h3>
            <p class="text-muted small mb-0">Upload, organize, and manage real bride photos, videos, and portfolio media.</p>
        </div>
        <button class="btn btn-warning rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#uploadGalleryModal">
            <i class="fas fa-plus me-2"></i>Upload New Media
        </button>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show bg-dark text-success border-success" role="alert">
            <i class="fas fa-check-circle me-2 text-gold"></i> {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Upload Modal -->
    <div class="modal fade" id="uploadGalleryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white border border-warning border-opacity-25 shadow-lg">
                <div class="modal-header border-bottom border-secondary">
                    <h5 class="modal-title text-gold fw-bold"><i class="fas fa-cloud-upload-alt me-2"></i>Upload Gallery Media</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label text-gold-light fw-bold">Select Category <span class="text-danger">*</span></label>
                            <select name="category" class="form-select bg-secondary text-white border-0" required>
                                <option value="lehenga">Bridal Lehengas</option>
                                <option value="saree">Pure Silk Sarees</option>
                                <option value="bridal">Royal Bridal Wear</option>
                                <option value="video">Video Reel / Story</option>
                                <option value="suits">Designer Suits</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-gold-light fw-bold">Media Title / Tagline</label>
                            <input type="text" name="title" class="form-control bg-secondary text-white border-0" placeholder="e.g. Royal Paithani Bride - Jaipur">
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-gold-light fw-bold">Upload Image File(s) <span class="text-danger">*</span></label>
                            <input type="file" name="images[]" class="form-control bg-secondary text-white border-0" multiple accept="image/*" required>
                            <small class="text-muted">Supports JPG, PNG, WEBP. Images will be automatically compressed for ultra-fast web loading.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-gold-light fw-bold">Video URL (Optional)</label>
                            <input type="url" name="video_url" class="form-control bg-secondary text-white border-0" placeholder="https://www.youtube.com/watch?v=...">
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="is_video" value="1" id="is_video_check">
                            <label class="form-check-label text-light" for="is_video_check">
                                Mark as Playable Video Item
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer border-top border-secondary">
                        <button type="button" class="btn btn-outline-secondary text-white" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning rounded-pill px-4">Upload &amp; Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Gallery Media Grid -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse($galleries as $item)
            <div class="col">
                <div class="card h-100 bg-dark text-white border border-secondary shadow-sm overflow-hidden position-relative">
                    <div class="ratio ratio-4x3 bg-secondary">
                        @if(str_starts_with($item->image_path, 'http') || str_starts_with($item->image_path, '/storage/') || str_starts_with($item->image_path, 'images/'))
                            <img src="{{ asset($item->image_path) }}" class="card-img-top object-fit-cover" alt="{{ $item->title }}">
                        @else
                            <img src="{{ asset('/storage/' . $item->image_path) }}" class="card-img-top object-fit-cover" alt="{{ $item->title }}">
                        @endif
                    </div>

                    @if($item->is_video)
                        <span class="position-absolute top-0 start-0 m-2 badge bg-danger"><i class="fas fa-play me-1"></i> VIDEO</span>
                    @endif

                    <span class="position-absolute top-0 end-0 m-2 badge bg-warning text-dark text-uppercase fw-bold">{{ $item->category }}</span>

                    <div class="card-body p-3">
                        <h6 class="card-title fw-bold text-gold mb-1 text-truncate">{{ $item->title }}</h6>
                        <p class="card-text text-muted small mb-0">Added: {{ $item->created_at ? $item->created_at->format('M d, Y') : 'N/A' }}</p>
                    </div>

                    <div class="card-footer bg-transparent border-top border-secondary d-flex justify-content-between align-items-center p-2 px-3">
                        <form action="{{ route('admin.gallery.toggle-status', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $item->is_active ? 'btn-outline-success' : 'btn-outline-secondary' }}">
                                {{ $item->is_active ? 'Active' : 'Disabled' }}
                            </button>
                        </form>

                        <form action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this gallery item?');" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-images fa-3x text-muted mb-3"></i>
                <p class="text-muted">No media items in gallery yet. Click "Upload New Media" to add your first real bride creation.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection
