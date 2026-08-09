@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-10">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">Add Boutique Item</h4>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Save Product</button>
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
                                    <button class="nav-link py-3 px-4" id="inventory-tab" data-bs-toggle="tab" data-bs-target="#inventory" type="button">Variants & Inventory</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link py-3 px-4" id="media-tab" data-bs-toggle="tab" data-bs-target="#media" type="button">Gallery Media</button>
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
                                        <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Royal Gold Embroidered Lehenga" required>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="category_id" class="form-label fw-semibold">Category</label>
                                            <select name="category_id" id="category_id" class="form-select" required>
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="brand_id" class="form-label fw-semibold">Brand / Designer</label>
                                            <select name="brand_id" id="brand_id" class="form-select">
                                                <option value="">Select Designer</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="price" class="form-label fw-semibold">Base Price (INR)</label>
                                            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="sale_price" class="form-label fw-semibold">Sale Price (INR)</label>
                                            <input type="number" step="0.01" class="form-control" id="sale_price" name="sale_price" value="{{ old('sale_price') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="cost_price" class="form-label fw-semibold">Cost Price (INR)</label>
                                            <input type="number" step="0.01" class="form-control" id="cost_price" name="cost_price" value="{{ old('cost_price') }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="material" class="form-label fw-semibold">Fabric / Material</label>
                                            <input type="text" class="form-control" id="material" name="material" value="{{ old('material') }}" placeholder="e.g. Pure Silk, Georgette">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="occasion" class="form-label fw-semibold">Occasion</label>
                                            <input type="text" class="form-control" id="occasion" name="occasion" value="{{ old('occasion') }}" placeholder="e.g. Bridal Wear, Sangeet Ceremony">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="rating" class="form-label fw-semibold">Product Star Rating (1.0 to 5.0)</label>
                                            <input type="number" step="0.1" min="1.0" max="5.0" class="form-control" id="rating" name="rating" value="{{ old('rating', '4.9') }}" placeholder="4.9">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="reviews_count" class="form-label fw-semibold">Reviews Count (Number of Reviews)</label>
                                            <input type="number" min="0" class="form-control" id="reviews_count" name="reviews_count" value="{{ old('reviews_count', '12') }}" placeholder="12">
                                        </div>
                                    </div>

                                    <!-- Available Sizes Selection Widget -->
                                    <div class="mb-4 p-3 bg-dark bg-opacity-50 rounded border border-warning border-opacity-25">
                                        <label class="form-label fw-bold text-warning"><i class="fas fa-ruler-horizontal me-1"></i> Available Couture Sizes for Customers</label>
                                        <div class="d-flex flex-wrap gap-3 mt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="selected_sizes[]" value="Free Size (Unstitched)" id="sz_free" checked>
                                                <label class="form-check-label fw-semibold" for="sz_free">Free Size (Unstitched)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="selected_sizes[]" value="Custom Stitched" id="sz_custom" checked>
                                                <label class="form-check-label fw-semibold" for="sz_custom">Custom Stitched</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="selected_sizes[]" value="S" id="sz_s">
                                                <label class="form-check-label" for="sz_s">S (Small)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="selected_sizes[]" value="M" id="sz_m">
                                                <label class="form-check-label" for="sz_m">M (Medium)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="selected_sizes[]" value="L" id="sz_l">
                                                <label class="form-check-label" for="sz_l">L (Large)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="selected_sizes[]" value="XL" id="sz_xl">
                                                <label class="form-check-label" for="sz_xl">XL (Extra Large)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="selected_sizes[]" value="XXL" id="sz_xxl">
                                                <label class="form-check-label" for="sz_xxl">XXL (Double XL)</label>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <input type="text" class="form-control form-control-sm" name="custom_sizes_text" placeholder="Additional custom sizes (comma separated, e.g. 38, 40, 42)">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="summary" class="form-label fw-semibold">Short Summary Description</label>
                                        <textarea class="form-control" id="summary" name="summary" rows="2" placeholder="Brief summary details for catalog..."></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label fw-semibold">Detailed Product Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="5" placeholder="Elaborated description with craftsmanship details..."></textarea>
                                    </div>
                                </div>
                                
                                <!-- 2. Variants & Inventory -->
                                <div class="tab-pane fade" id="inventory" role="tabpanel">
                                    <div class="p-3 bg-dark bg-opacity-25 rounded-3 border mb-4">
                                        <h6 class="fw-bold mb-3">Single / Base Product Stock</h6>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="sku" class="form-label small fw-semibold text-muted">SKU Code</label>
                                                <input type="text" class="form-control" id="sku" name="sku" placeholder="Auto-generated if blank">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="barcode" class="form-label small fw-semibold text-muted">Barcode (EAN/UPC)</label>
                                                <input type="text" class="form-control" id="barcode" name="barcode">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="stock" class="form-label small fw-semibold text-muted">Default Stock Quantity</label>
                                                <input type="number" class="form-control" id="stock" name="stock" value="10">
                                            </div>
                                        </div>
                                    </div>

                                    <h6 class="fw-bold mb-3 d-flex justify-content-between align-items-center">
                                        <span>Product Variants (Colors, Sizes)</span>
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
                                                <!-- Dynamic Variant Rows go here -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                                <!-- 3. Gallery Media -->
                                <div class="tab-pane fade" id="media" role="tabpanel">
                                    <div class="mb-3">
                                        <label for="images" class="form-label fw-semibold">Upload Gallery Images & Video Files</label>
                                        <input class="form-control" type="file" id="images" name="images[]" multiple accept="image/*">
                                        <div class="form-text">Choose premium photos. First uploaded image will set as the primary view.</div>
                                    </div>
                                    
                                    <div class="row g-3 mt-3" id="image-previews">
                                        <!-- Image uploading previews -->
                                    </div>
                                </div>
                                
                                <!-- 4. SEO Tags -->
                                <div class="tab-pane fade" id="seo" role="tabpanel">
                                    <div class="mb-3">
                                        <label for="meta_title" class="form-label fw-semibold">SEO Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Gold embroidered lehenga online shopping - RaniSahab">
                                    </div>
                                    <div class="mb-3">
                                        <label for="meta_description" class="form-label fw-semibold">SEO Meta Description</label>
                                        <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="Order this stunning design..."></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="meta_keywords" class="form-label fw-semibold">SEO Meta Keywords</label>
                                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="bridal lehenga, designer saree, wedding suit">
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
                                <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" checked value="1">
                                <label class="form-check-label fw-semibold" for="is_active">Publish Active Status</label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_approved" name="is_approved" checked value="1">
                                <label class="form-check-label fw-semibold" for="is_approved">Approve Status (Publish Live)</label>
                            </div>
                            <hr>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_featured" name="is_featured" value="1">
                                <label class="form-check-label" for="is_featured">Featured Product</label>
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_trending" name="is_trending" value="1">
                                <label class="form-check-label" for="is_trending">Trending Product</label>
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_new_arrival" name="is_new_arrival" value="1">
                                <label class="form-check-label" for="is_new_arrival">New Arrival</label>
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_best_seller" name="is_best_seller" value="1">
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
                                    <input class="form-check-input" type="checkbox" name="collections[]" value="{{ $collection->id }}" id="col_{{ $collection->id }}">
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
                                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag_{{ $tag->id }}">
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
        var variantIndex = 0;

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

        // Live Gallery Image Upload Preview
        $('#images').on('change', function(e) {
            var files = e.target.files;
            var previewContainer = $('#image-previews');
            previewContainer.empty();

            if (files && files.length > 0) {
                $.each(files, function(index, file) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        var html = `
                            <div class="col-md-3 col-sm-6">
                                <div class="card bg-dark border border-warning border-opacity-25 h-100 shadow-sm overflow-hidden text-center position-relative">
                                    <img src="${event.target.result}" class="card-img-top object-fit-cover" style="height: 160px;" alt="Image Preview">
                                    <div class="card-body p-2 bg-dark bg-opacity-90">
                                        <span class="badge bg-warning text-dark small fw-bold">New Upload ${index + 1}</span>
                                        <div class="small text-truncate text-white-50 mt-1" style="font-size: 0.72rem;">${file.name}</div>
                                    </div>
                                </div>
                            </div>
                        `;
                        previewContainer.append(html);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });
    });
</script>
@endpush
