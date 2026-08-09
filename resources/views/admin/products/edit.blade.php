@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-10">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold mb-0">Edit Boutique Item</h4>
                    <small class="text-muted font-monospace text-warning">{{ $product->slug }}</small>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Save Changes</button>
                </div>
            </div>

            @if($errors->any())
                <div class="alert alert-danger border-0 bg-danger bg-opacity-25 text-white rounded-3 mb-4">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <!-- Left Column: Tabs -->
                <div class="col-lg-8">
                    <div class="card shadow mb-4">
                        <div class="card-header p-0">
                            <ul class="nav nav-tabs card-header-tabs border-bottom-0 m-0 w-100" id="product-form-tabs" role="tablist">
                                <li class="nav-item">
                                    <button class="nav-link active py-3 px-4" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic" type="button">General Info</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link py-3 px-4" id="inventory-tab" data-bs-toggle="tab" data-bs-target="#inventory" type="button">Variants & Stock</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link py-3 px-4" id="media-tab" data-bs-toggle="tab" data-bs-target="#media" type="button">Gallery Media</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link py-3 px-4" id="qa-tab" data-bs-toggle="tab" data-bs-target="#qa" type="button">Product Q&A ({{ $product->questions->count() }})</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link py-3 px-4" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo" type="button">SEO Tags</button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="product-form-content">
                                
                                <!-- 1. General Info -->
                                <div class="tab-pane fade show active" id="basic" role="tabpanel">
                                    <div class="mb-3">
                                        <label for="name" class="form-label fw-semibold">Product Name</label>
                                        <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="category_id" class="form-label fw-semibold">Category</label>
                                            <select name="category_id" id="category_id" class="form-select" required>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="brand_id" class="form-label fw-semibold">Brand / Designer</label>
                                            <select name="brand_id" id="brand_id" class="form-select">
                                                <option value="">Select Designer</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="price" class="form-label fw-semibold">Base Price (INR)</label>
                                            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="sale_price" class="form-label fw-semibold">Sale Price (INR)</label>
                                            <input type="number" step="0.01" class="form-control" id="sale_price" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="cost_price" class="form-label fw-semibold">Cost Price (INR)</label>
                                            <input type="number" step="0.01" class="form-control" id="cost_price" name="cost_price" value="{{ old('cost_price', $product->cost_price) }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="material" class="form-label fw-semibold">Fabric / Material</label>
                                            <input type="text" class="form-control" id="material" name="material" value="{{ old('material', $product->material) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="occasion" class="form-label fw-semibold">Occasion</label>
                                            <input type="text" class="form-control" id="occasion" name="occasion" value="{{ old('occasion', $product->occasion) }}">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="summary" class="form-label fw-semibold">Short Summary Description</label>
                                        <textarea class="form-control" id="summary" name="summary" rows="2">{{ old('summary', $product->summary) }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label fw-semibold">Detailed Product Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $product->description) }}</textarea>
                                    </div>
                                </div>
                                
                                <!-- 2. Variants & Inventory -->
                                <div class="tab-pane fade" id="inventory" role="tabpanel">
                                    <div class="p-3 bg-dark bg-opacity-25 rounded-3 border mb-4">
                                        <h6 class="fw-bold mb-3">Single / Base Product Stock</h6>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="sku" class="form-label small fw-semibold text-muted">SKU Code</label>
                                                <input type="text" class="form-control" id="sku" name="sku" value="{{ $product->sku }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="barcode" class="form-label small fw-semibold text-muted">Barcode (EAN/UPC)</label>
                                                <input type="text" class="form-control" id="barcode" name="barcode" value="{{ $product->barcode }}">
                                            </div>
                                            <div class="col-md-4">
                                                <div class="small fw-semibold text-muted mb-2">Inventory Sync</div>
                                                <span class="badge bg-secondary p-2">Standard Database Controlled</span>
                                            </div>
                                        </div>
                                    </div>

                                    <h6 class="fw-bold mb-3 d-flex justify-content-between align-items-center">
                                        <span>Product Variants (Colors, Sizes, Custom fabric settings)</span>
                                        <button type="button" id="add-variant-btn" class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                            <i class="fas fa-plus me-1"></i> Add Variant
                                        </button>
                                    </h6>
                                    
                                    <div class="table-responsive">
                                        <table class="table align-middle" id="variants-table">
                                            <thead>
                                                <tr>
                                                    <th>Color</th>
                                                    <th>Size</th>
                                                    <th>Fabric Override</th>
                                                    <th>SKU Code</th>
                                                    <th>Stock Qty</th>
                                                    <th>Price Override</th>
                                                    <th style="width: 50px;"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($product->variants as $index => $variant)
                                                    <tr id="variant-row-{{ $index }}">
                                                        <td>
                                                            <input type="hidden" name="variants[{{ $index }}][id]" value="{{ $variant->id }}">
                                                            <input type="text" name="variants[{{ $index }}][color]" class="form-control form-control-sm" value="{{ $variant->color }}" required>
                                                        </td>
                                                        <td><input type="text" name="variants[{{ $index }}][size]" class="form-control form-control-sm" value="{{ $variant->size }}" required></td>
                                                        <td><input type="text" name="variants[{{ $index }}][fabric]" class="form-control form-control-sm" value="{{ $variant->fabric }}"></td>
                                                        <td><input type="text" name="variants[{{ $index }}][sku]" class="form-control form-control-sm" value="{{ $variant->sku }}" required></td>
                                                        <td><input type="number" name="variants[{{ $index }}][stock]" class="form-control form-control-sm" value="{{ $variant->stock }}" required></td>
                                                        <td><input type="number" name="variants[{{ $index }}][price]" class="form-control form-control-sm" value="{{ $variant->price }}"></td>
                                                        <td>
                                                            <button type="button" class="btn btn-sm btn-outline-danger border-0 rounded-circle remove-variant" data-index="{{ $index }}"><i class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                                <!-- 3. Gallery Media -->
                                <div class="tab-pane fade" id="media" role="tabpanel">
                                    <div class="mb-4">
                                        <label for="images" class="form-label fw-semibold">Upload Additional Media</label>
                                        <input class="form-control" type="file" id="images" name="images[]" multiple accept="image/*">
                                        <div class="form-text">Choose premium photos. First uploaded image is set as default.</div>
                                    </div>
                                    
                                    <h6 class="fw-bold mb-3 border-bottom pb-2">Current Media Library</h6>
                                    <div class="row g-3">
                                        @forelse($product->images as $image)
                                            <div class="col-md-3 col-sm-6">
                                                <div class="card bg-dark border-0 h-100 shadow-sm overflow-hidden text-center position-relative">
                                                    <img src="{{ $image->file_path }}" class="card-img-top object-fit-cover" height="150" alt="Product Image">
                                                    <div class="card-body p-2 bg-dark bg-opacity-75 position-absolute w-100 bottom-0">
                                                        <span class="badge bg-secondary font-monospace">Sort: {{ $image->sort_order }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-center py-4 text-muted col-12">No media uploaded for this product yet.</div>
                                        @endforelse
                                    </div>
                                </div>
                                
                                <!-- 4. Q&A Approval and Admin Responses -->
                                <div class="tab-pane fade" id="qa" role="tabpanel">
                                    <h6 class="fw-bold mb-3">Customer Inquiries and Q&A Moderation</h6>
                                    <div class="d-flex flex-column gap-3 mt-2">
                                        @forelse($product->questions as $q)
                                            <div class="border p-3 rounded shadow-sm bg-dark bg-opacity-25">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <span class="badge {{ $q->is_approved ? 'bg-success' : 'bg-warning' }} mb-2">
                                                            {{ $q->is_approved ? 'Approved FAQ' : 'Pending Moderation' }}
                                                        </span>
                                                        <p class="mb-1 fw-semibold text-warning"><i class="fas fa-question-circle me-1"></i> {{ $q->question_text }}</p>
                                                        <small class="text-muted">Asked by {{ $q->customer->first_name ?? 'Guest' }} | {{ $q->created_at->diffForHumans() }}</small>
                                                    </div>
                                                    <div class="d-flex gap-1">
                                                        @if(!$q->is_approved)
                                                            <form action="{{ route('admin.questions.approve', $q->id) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-outline-success"><i class="fas fa-check"></i> Approve</button>
                                                            </form>
                                                        @endif
                                                        <form action="{{ route('admin.questions.destroy', $q->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </div>

                                                <!-- Reply response -->
                                                <form action="{{ route('admin.questions.answer', $q->id) }}" method="POST" class="mt-3 bg-dark bg-opacity-50 p-3 rounded border">
                                                    @csrf
                                                    <label for="answer-{{ $q->id }}" class="form-label small fw-semibold text-muted">Admin Response</label>
                                                    <div class="input-group">
                                                        <input type="text" name="answer_text" id="answer-{{ $q->id }}" class="form-control form-control-sm" value="{{ $q->answer_text }}" placeholder="Submit Boutique Answer..." required>
                                                        <button type="submit" class="btn btn-sm btn-warning">Reply</button>
                                                    </div>
                                                    @if($q->repliedBy)
                                                        <small class="text-muted mt-1 d-block">Last answered by: {{ $q->repliedBy->name }}</small>
                                                    @endif
                                                </form>
                                            </div>
                                        @empty
                                            <div class="text-center py-5 text-muted">
                                                <i class="fas fa-comments fs-1 mb-3 opacity-50"></i>
                                                <p class="mb-0">No customer questions submitted for this product.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>

                                <!-- 5. SEO Tags -->
                                <div class="tab-pane fade" id="seo" role="tabpanel">
                                    <div class="mb-3">
                                        <label for="meta_title" class="form-label fw-semibold">SEO Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ $product->meta_title }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="meta_description" class="form-label fw-semibold">SEO Meta Description</label>
                                        <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ $product->meta_description }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="meta_keywords" class="form-label fw-semibold">SEO Meta Keywords</label>
                                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ $product->meta_keywords }}">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Settings Side widgets -->
                <div class="col-lg-4">
                    <!-- Status, Feature, Approvals -->
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h6 class="mb-0 fw-bold">Publish Settings</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_active">Publish Active Status</label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_approved" name="is_approved" value="1" {{ $product->is_approved ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_approved">Approve Status (Publish Live)</label>
                            </div>
                            <hr>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_featured" name="is_featured" value="1" {{ $product->is_featured ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">Featured Product</label>
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_trending" name="is_trending" value="1" {{ $product->is_trending ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_trending">Trending Product</label>
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_new_arrival" name="is_new_arrival" value="1" {{ $product->is_new_arrival ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_new_arrival">New Arrival</label>
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_best_seller" name="is_best_seller" value="1" {{ $product->is_best_seller ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_best_seller">Best Seller</label>
                            </div>
                        </div>
                    </div>

                    <!-- Collections Checklist -->
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h6 class="mb-0 fw-bold">Special Collections</h6>
                        </div>
                        <div class="card-body" style="max-height: 200px; overflow-y: auto;">
                            @forelse($collections as $collection)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="collections[]" value="{{ $collection->id }}" id="col_{{ $collection->id }}" {{ in_array($collection->id, $selectedCollections) ? 'checked' : '' }}>
                                    <label class="form-check-label text-capitalize" for="col_{{ $collection->id }}">
                                        {{ $collection->name }}
                                    </label>
                                </div>
                            @empty
                                <div class="text-muted small">No collections available.</div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Tags Checklist -->
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h6 class="mb-0 fw-bold">Tags / Labels</h6>
                        </div>
                        <div class="card-body" style="max-height: 200px; overflow-y: auto;">
                            @forelse($tags as $tag)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag_{{ $tag->id }}" {{ in_array($tag->id, $selectedTags) ? 'checked' : '' }}>
                                    <label class="form-check-label text-capitalize" for="tag_{{ $tag->id }}">
                                        {{ $tag->name }}
                                    </label>
                                </div>
                            @empty
                                <div class="text-muted small">No tags available.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        var variantIndex = {{ $product->variants->count() }};

        $('#add-variant-btn').click(function() {
            var row = `
                <tr id="variant-row-${variantIndex}">
                    <td><input type="text" name="variants[${variantIndex}][color]" class="form-control form-control-sm" placeholder="Red" required></td>
                    <td><input type="text" name="variants[${variantIndex}][size]" class="form-control form-control-sm" placeholder="M" required></td>
                    <td><input type="text" name="variants[${variantIndex}][fabric]" class="form-control form-control-sm" placeholder="Silk"></td>
                    <td><input type="text" name="variants[${variantIndex}][sku]" class="form-control form-control-sm" placeholder="SKU-CODE"></td>
                    <td><input type="number" name="variants[${variantIndex}][stock]" class="form-control form-control-sm" value="5" required></td>
                    <td><input type="number" name="variants[${variantIndex}][price]" class="form-control form-control-sm" placeholder="Override price"></td>
                    <td><button type="button" class="btn btn-sm btn-outline-danger border-0 rounded-circle remove-variant" data-index="${variantIndex}"><i class="fas fa-trash"></i></button></td>
                </tr>
            `;
            $('#variants-table tbody').append(row);
            variantIndex++;
        });

        $(document).on('click', '.remove-variant', function() {
            var index = $(this).data('index');
            $('#variant-row-' + index).remove();
        });
    });
</script>
@endpush
