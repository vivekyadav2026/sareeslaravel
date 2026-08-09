@extends('layouts.admin')

@section('title', 'Makeup Artistry Services')

@section('content')
<div class="row">
    <!-- Add Service Form -->
    <div class="col-md-4 mb-4">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0 fw-bold">Add Makeup Service</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.makeup-services.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Service Title</label>
                        <input type="text" class="form-control" name="name" id="name" required placeholder="e.g. Bridal HD Airbrush Makeup">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price (INR)</label>
                        <input type="number" step="0.01" class="form-control" name="price" id="price" required placeholder="0.00">
                    </div>
                    <div class="mb-3">
                        <label for="duration_minutes" class="form-label">Duration (Minutes)</label>
                        <input type="number" class="form-control" name="duration_minutes" id="duration_minutes" required placeholder="180">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Package detailed description..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning rounded-pill w-100">Create Service Style</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Services List -->
    <div class="col-md-8 mb-4">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0 fw-bold">Artistry & Styling Packages</h5>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-2 g-3">
                    @forelse($services as $service)
                        <div class="col">
                            <div class="card h-100 border border-warning border-opacity-25 bg-dark bg-opacity-10 shadow-sm position-relative">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title fw-bold text-warning mb-0">{{ $service->name }}</h5>
                                        <span class="fs-6 fw-bold text-light">₹{{ number_format($service->price, 2) }}</span>
                                    </div>
                                    <span class="badge bg-secondary mb-3"><i class="far fa-clock me-1"></i> {{ $service->duration_minutes }} Min Session</span>
                                    <p class="card-text text-muted small">{{ $service->description }}</p>
                                </div>
                                <div class="card-footer bg-transparent border-0 d-flex justify-content-end p-3">
                                    <form action="{{ route('admin.makeup-services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Delete this makeup service?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <i class="fas fa-palette fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No makeup services registered.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
