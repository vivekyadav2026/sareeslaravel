@extends('layouts.admin')

@section('title', 'Bridal Couture Packages')

@section('content')
<div class="row">
    <!-- Add Package Form -->
    <div class="col-md-4 mb-4">
        <div class="card shadow border-0 bg-dark text-white" style="border: 1px solid rgba(201,162,75,0.15) !important;">
            <div class="card-header border-bottom border-warning border-opacity-25 py-3">
                <h5 class="mb-0 fw-bold text-gold"><i class="fas fa-plus-circle me-2"></i>Add Couture Package</h5>
            </div>
            <div class="card-body py-4">
                <form action="{{ route('admin.bridal-packages.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label text-gold-light fw-semibold">Package Name</label>
                        <input type="text" class="form-control bg-dark border-secondary text-white" name="name" id="name" required placeholder="e.g. Royal Ranisahab Package">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label text-gold-light fw-semibold">Price (INR)</label>
                        <input type="number" step="0.01" class="form-control bg-dark border-secondary text-white" name="price" id="price" required placeholder="0.00">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label text-gold-light fw-semibold">Package Cover Image</label>
                        <input type="file" class="form-control bg-dark border-secondary text-white" name="image" id="image" accept="image/*">
                        <small class="text-muted">Upload a horizontal/portrait preview image for the package card.</small>
                    </div>
                    <div class="mb-3">
                        <label for="features" class="form-label text-gold-light fw-semibold">Key Features (comma separated)</label>
                        <textarea class="form-control bg-dark border-secondary text-white" name="features" id="features" rows="3" placeholder="Custom Lehenga, Bridal Suit, Haldi Saree"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label text-gold-light fw-semibold">Description</label>
                        <textarea class="form-control bg-dark border-secondary text-white" name="description" id="description" rows="3" placeholder="Package detailed description..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning rounded-pill w-100 fw-bold py-2 mt-2">Create Package</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Packages List -->
    <div class="col-md-8 mb-4">
        <div class="card shadow border-0 bg-dark text-white" style="border: 1px solid rgba(201,162,75,0.15) !important;">
            <div class="card-header border-bottom border-warning border-opacity-25 py-3">
                <h5 class="mb-0 fw-bold text-gold"><i class="fas fa-crown me-2"></i>Active Couture Packages</h5>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-2 g-3">
                    @forelse($packages as $package)
                        @php
                          // Determine fallback image mapping
                          $fallbackImage = 'images/pkg_silver.png';
                          if (\Illuminate\Support\Str::contains(strtolower($package->name), 'gold')) {
                              $fallbackImage = 'images/pkg_gold.png';
                          } elseif (\Illuminate\Support\Str::contains(strtolower($package->name), 'royal') || \Illuminate\Support\Str::contains(strtolower($package->name), 'ranisahab')) {
                              $fallbackImage = 'images/pkg_royal.png';
                          }
                          $imageSrc = $package->image ? asset($package->image) : asset($fallbackImage);
                        @endphp
                        
                        <div class="col">
                            <div class="card h-100 border border-secondary border-opacity-25 bg-dark shadow-sm position-relative overflow-hidden">
                                <!-- Package Image Display -->
                                <div style="height: 180px; overflow: hidden; position: relative;">
                                    <img src="{{ $imageSrc }}" alt="{{ $package->name }}" style="width:100%; height:100%; object-fit:cover; object-position:center top;">
                                    <div class="position-absolute top-0 end-0 bg-dark bg-opacity-75 text-gold px-3 py-1 m-2 rounded small fw-bold">
                                        ₹{{ number_format($package->price, 0) }}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-warning mb-2">{{ $package->name }}</h5>
                                    <p class="card-text text-light opacity-75 small mb-3">{{ $package->description }}</p>
                                    @if(is_array($package->features) && count($package->features) > 0)
                                        <ul class="list-unstyled small mb-2 text-light opacity-75">
                                            @foreach($package->features as $feature)
                                                <li><i class="fas fa-check text-gold me-2"></i> {{ $feature }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center p-3">
                                    <span class="badge {{ $package->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $package->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                    <div class="d-flex gap-2">
                                        <!-- Edit Trigger Button -->
                                        <button class="btn btn-sm btn-outline-warning rounded-circle" data-bs-toggle="modal" data-bs-target="#editModal{{ $package->id }}" title="Edit Package">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        
                                        <!-- Delete Package Form -->
                                        <form action="{{ route('admin.bridal-packages.destroy', $package->id) }}" method="POST" onsubmit="return confirm('Delete this package?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Delete Package"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bootstrap Edit Modal for current Package -->
                        <div class="modal fade text-white" id="editModal{{ $package->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $package->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content bg-dark border border-secondary border-opacity-50">
                                    <div class="modal-header border-bottom border-secondary border-opacity-25">
                                        <h5 class="modal-title fw-bold text-gold" id="editModalLabel{{ $package->id }}"><i class="fas fa-edit me-2"></i>Edit {{ $package->name }}</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.bridal-packages.update', $package->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="edit_name{{ $package->id }}" class="form-label text-gold-light">Package Name</label>
                                                <input type="text" class="form-control bg-dark border-secondary text-white" name="name" id="edit_name{{ $package->id }}" value="{{ $package->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_price{{ $package->id }}" class="form-label text-gold-light">Price (INR)</label>
                                                <input type="number" step="0.01" class="form-control bg-dark border-secondary text-white" name="price" id="edit_price{{ $package->id }}" value="{{ $package->price }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_image{{ $package->id }}" class="form-label text-gold-light">Update Cover Image</label>
                                                <input type="file" class="form-control bg-dark border-secondary text-white" name="image" id="edit_image{{ $package->id }}" accept="image/*">
                                                @if($package->image)
                                                    <div class="mt-2 small text-muted">Current: <code>{{ $package->image }}</code></div>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_features{{ $package->id }}" class="form-label text-gold-light">Key Features (comma separated)</label>
                                                <textarea class="form-control bg-dark border-secondary text-white" name="features" id="edit_features{{ $package->id }}" rows="3">{{ is_array($package->features) ? implode(', ', $package->features) : '' }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_description{{ $package->id }}" class="form-label text-gold-light">Description</label>
                                                <textarea class="form-control bg-dark border-secondary text-white" name="description" id="edit_description{{ $package->id }}" rows="3">{{ $package->description }}</textarea>
                                            </div>
                                            <div class="mb-3 form-check">
                                                <input type="checkbox" class="form-check-input bg-dark border-secondary" name="is_active" id="edit_active{{ $package->id }}" value="1" {{ $package->is_active ? 'checked' : '' }}>
                                                <label class="form-check-label text-gold-light" for="edit_active{{ $package->id }}">Package is Active</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-top border-secondary border-opacity-25">
                                            <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-warning rounded-pill fw-bold px-4">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <i class="fas fa-crown fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No couture bridal packages registered.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
