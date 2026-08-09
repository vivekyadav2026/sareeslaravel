@extends('layouts.admin')

@section('title', 'Bridal Couture Packages')

@section('content')
<div class="row">
    <!-- Add Package Form -->
    <div class="col-md-4 mb-4">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0 fw-bold">Add Couture Package</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.bridal-packages.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Package Name</label>
                        <input type="text" class="form-control" name="name" id="name" required placeholder="e.g. Royal Zardozi Package">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price (INR)</label>
                        <input type="number" step="0.01" class="form-control" name="price" id="price" required placeholder="0.00">
                    </div>
                    <div class="mb-3">
                        <label for="features" class="form-label">Key Features (comma separated)</label>
                        <textarea class="form-control" name="features" id="features" rows="2" placeholder="Feature 1, Feature 2, Feature 3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Package detailed description..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning rounded-pill w-100">Create Package</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Packages List -->
    <div class="col-md-8 mb-4">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0 fw-bold">Active Couture Packages</h5>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-2 g-3">
                    @forelse($packages as $package)
                        <div class="col">
                            <div class="card h-100 border border-warning border-opacity-25 bg-dark bg-opacity-10 shadow-sm position-relative">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title fw-bold text-warning mb-0">{{ $package->name }}</h5>
                                        <span class="fs-6 fw-bold text-light">₹{{ number_format($package->price, 2) }}</span>
                                    </div>
                                    <p class="card-text text-muted small">{{ $package->description }}</p>
                                    @if(is_array($package->features) && count($package->features) > 0)
                                        <ul class="list-unstyled small mb-4">
                                            @foreach($package->features as $feature)
                                                <li><i class="fas fa-check text-success me-2"></i> {{ $feature }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                <div class="card-footer bg-transparent border-0 d-flex justify-content-end p-3">
                                    <form action="{{ route('admin.bridal-packages.destroy', $package->id) }}" method="POST" onsubmit="return confirm('Delete this package?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle"><i class="fas fa-trash-alt"></i></button>
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
