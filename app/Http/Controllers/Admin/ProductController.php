<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Collection;
use App\Models\Tag;
use App\Models\ProductImage;
use App\Models\ProductQuestion;
use App\Models\Review;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use App\Models\AdminActivityLog;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Product::with(['category', 'brand'])->select('products.*');

            if ($request->filled('category_id')) {
                $query->where('category_id', $request->category_id);
            }
            if ($request->filled('status')) {
                $query->where('is_active', $request->status === 'active');
            }
            if ($request->filled('approval')) {
                $query->where('is_approved', $request->approval === 'approved');
            }

            return DataTables::of($query)
                ->addColumn('category', function($row) {
                    return $row->category->name ?? '<span class="text-muted">Uncategorized</span>';
                })
                ->addColumn('brand', function($row) {
                    return $row->brand->name ?? '<span class="text-muted">N/A</span>';
                })
                ->addColumn('price', function($row) {
                    return '₹' . number_format($row->price, 2);
                })
                ->addColumn('status', function($row) {
                    $class = $row->is_active ? 'bg-success' : 'bg-secondary';
                    $text = $row->is_active ? 'Active' : 'Inactive';
                    return '<span class="badge ' . $class . '">' . $text . '</span>';
                })
                ->addColumn('approved', function($row) {
                    $class = $row->is_approved ? 'bg-info' : 'bg-warning';
                    $text = $row->is_approved ? 'Approved' : 'Pending';
                    return '<span class="badge ' . $class . '">' . $text . '</span>';
                })
                ->addColumn('action', function($row) {
                    $editBtn = '<a href="' . route('admin.products.edit', $row->id) . '" class="btn btn-sm btn-light me-1 rounded-circle"><i class="fas fa-edit text-warning"></i></a>';
                    $deleteBtn = '<button class="btn btn-sm btn-light rounded-circle delete-product" data-id="' . $row->id . '"><i class="fas fa-trash text-danger"></i></button>';
                    return $editBtn . $deleteBtn;
                })
                ->rawColumns(['category', 'brand', 'status', 'approved', 'action'])
                ->make(true);
        }

        $categories = Category::all();
        $totalProducts = Product::count();
        $pendingApproval = Product::where('is_approved', false)->count();
        $activeProducts = Product::where('is_active', true)->count();
        
        return view('admin.products.index', compact('categories', 'totalProducts', 'pendingApproval', 'activeProducts'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $collections = Collection::all();
        $tags = Tag::all();
        return view('admin.products.create', compact('categories', 'brands', 'collections', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'rating' => 'nullable|numeric|min:1|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|unique:products,sku',
            'barcode' => 'nullable|string',
            'material' => 'nullable|string',
            'occasion' => 'nullable|string',
            'summary' => 'nullable|string',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'is_active' => 'boolean',
            'is_approved' => 'boolean',
            'is_featured' => 'boolean',
            'is_trending' => 'boolean',
            'is_new_arrival' => 'boolean',
            'is_best_seller' => 'boolean',
            'collections' => 'nullable|array',
            'tags' => 'nullable|array',
            'variants' => 'nullable|array',
        ]);

        $slug = Str::slug($request->name);
        // Ensure slug is unique
        $originalSlug = $slug;
        $count = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        DB::transaction(function() use ($request, $slug) {
            $product = Product::create(array_merge($request->all(), [
                'slug' => $slug,
                'is_active' => $request->has('is_active'),
                'is_approved' => $request->has('is_approved'),
                'is_featured' => $request->has('is_featured'),
                'is_trending' => $request->has('is_trending'),
                'is_new_arrival' => $request->has('is_new_arrival'),
                'is_best_seller' => $request->has('is_best_seller'),
            ]));

            // Sync tags/collections
            if ($request->has('collections')) {
                $product->collections()->sync($request->collections);
            }
            if ($request->has('tags')) {
                $product->tags()->sync($request->tags);
            }

            // Process selected size options & variants
            $sizesToSave = [];
            if ($request->has('selected_sizes')) {
                $sizesToSave = array_merge($sizesToSave, $request->selected_sizes);
            }
            if ($request->filled('custom_sizes_text')) {
                $extra = array_map('trim', explode(',', $request->custom_sizes_text));
                $sizesToSave = array_merge($sizesToSave, array_filter($extra));
            }

            if (!empty($sizesToSave)) {
                foreach (array_unique($sizesToSave) as $sz) {
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'size' => $sz,
                        'sku' => $product->sku ? ($product->sku . '-' . Str::slug($sz)) : strtoupper(Str::random(8)),
                        'price' => $product->price,
                        'sale_price' => $product->sale_price,
                        'stock' => 10,
                    ]);
                }
            } elseif (!$request->has('variants') || count($request->variants) === 0) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'sku' => $product->sku ?: strtoupper(Str::random(8)),
                    'size' => 'Free Size (Unstitched)',
                    'price' => $product->price,
                    'sale_price' => $product->sale_price,
                    'stock' => $request->stock ?? 10,
                ]);
            } else {
                foreach ($request->variants as $variant) {
                    ProductVariant::create(array_merge($variant, [
                        'product_id' => $product->id,
                        'sku' => $variant['sku'] ?: strtoupper(Str::random(8)),
                    ]));
                }
            }

            // Handle images upload
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $file) {
                    // Optimized/simple local storage path
                    $path = $file->store('products', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'file_path' => '/storage/' . $path,
                        'type' => 'image',
                        'is_primary' => $index === 0,
                        'sort_order' => $index,
                    ]);
                }
            }

            AdminActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'create_product',
                'details' => "Created product: {$product->name} (SKU: {$product->sku})",
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        });

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $product->load(['category', 'brand', 'collections', 'tags', 'variants', 'images', 'questions']);
        $categories = Category::all();
        $brands = Brand::all();
        $collections = Collection::all();
        $tags = Tag::all();
        
        $selectedCollections = $product->collections->pluck('id')->toArray();
        $selectedTags = $product->tags->pluck('id')->toArray();

        return view('admin.products.edit', compact('product', 'categories', 'brands', 'collections', 'tags', 'selectedCollections', 'selectedTags'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'rating' => 'nullable|numeric|min:1|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|unique:products,sku,' . $product->id,
            'barcode' => 'nullable|string',
            'material' => 'nullable|string',
            'occasion' => 'nullable|string',
            'summary' => 'nullable|string',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'collections' => 'nullable|array',
            'tags' => 'nullable|array',
            'variants' => 'nullable|array',
        ]);

        DB::transaction(function() use ($request, $product) {
            $product->update(array_merge($request->all(), [
                'is_active' => $request->has('is_active'),
                'is_approved' => $request->has('is_approved'),
                'is_featured' => $request->has('is_featured'),
                'is_trending' => $request->has('is_trending'),
                'is_new_arrival' => $request->has('is_new_arrival'),
                'is_best_seller' => $request->has('is_best_seller'),
            ]));

            // Sync tags/collections
            $product->collections()->sync($request->collections ?? []);
            $product->tags()->sync($request->tags ?? []);

            // Sync selected size options & variants
            $sizesToSave = [];
            if ($request->has('selected_sizes')) {
                $sizesToSave = array_merge($sizesToSave, $request->selected_sizes);
            }
            if ($request->filled('custom_sizes_text')) {
                $extra = array_map('trim', explode(',', $request->custom_sizes_text));
                $sizesToSave = array_merge($sizesToSave, array_filter($extra));
            }

            $sizesToSave = array_values(array_unique(array_filter($sizesToSave)));

            if ($request->has('selected_sizes') || $request->filled('custom_sizes_text')) {
                // Delete existing size variants that were unchecked/deselected
                $product->variants()->whereNotIn('size', $sizesToSave)->delete();

                foreach ($sizesToSave as $sz) {
                    if (!$product->variants()->where('size', $sz)->exists()) {
                        ProductVariant::create([
                            'product_id' => $product->id,
                            'size' => $sz,
                            'sku' => $product->sku ? ($product->sku . '-' . Str::slug($sz)) : strtoupper(Str::random(8)),
                            'price' => $product->price,
                            'sale_price' => $product->sale_price,
                            'stock' => 10,
                        ]);
                    }
                }
            }

            // Update variants table if rows passed
            if ($request->has('variants')) {
                $incomingIds = collect($request->variants)->pluck('id')->filter()->toArray();
                if (!empty($incomingIds)) {
                    $product->variants()->whereNotIn('id', $incomingIds)->delete();
                }

                foreach ($request->variants as $variant) {
                    if (isset($variant['id'])) {
                        ProductVariant::where('id', $variant['id'])->update($variant);
                    } else {
                        ProductVariant::create(array_merge($variant, [
                            'product_id' => $product->id,
                            'sku' => $variant['sku'] ?: strtoupper(Str::random(8)),
                        ]));
                    }
                }
            }

            // Handle extra uploaded images
            if ($request->hasFile('images')) {
                $lastOrder = $product->images()->max('sort_order') ?? 0;
                foreach ($request->file('images') as $file) {
                    $path = $file->store('products', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'file_path' => '/storage/' . $path,
                        'type' => 'image',
                        'is_primary' => false,
                        'sort_order' => ++$lastOrder,
                    ]);
                }
            }

            AdminActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'update_product',
                'details' => "Updated product: {$product->name} (SKU: {$product->sku})",
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        });

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Request $request, Product $product)
    {
        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete_product',
            'details' => "Deleted product: {$product->name} (SKU: {$product->sku})",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $product->delete();

        return response()->json(['success' => true, 'message' => 'Product deleted successfully.']);
    }

    // Categories CRUD
    public function categoriesIndex()
    {
        $categories = Category::withCount('products')->get();
        return view('admin.products.categories', compact('categories'));
    }

    public function categoriesStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Category created successfully.');
    }

    public function categoriesDestroy(Category $category)
    {
        if ($category->products()->count() > 0) {
            return back()->withErrors(['category' => 'Cannot delete category with products associated.']);
        }

        $category->delete();
        return back()->with('success', 'Category deleted successfully.');
    }

    // Q&A Approve / Answer
    public function answerQuestion(Request $request, ProductQuestion $question)
    {
        $request->validate([
            'answer_text' => 'required|string',
        ]);

        $question->update([
            'answer_text' => $request->answer_text,
            'replied_by' => auth()->id(),
            'is_approved' => true,
        ]);

        return back()->with('success', 'Question answered and approved successfully.');
    }

    public function approveQuestion(ProductQuestion $question)
    {
        $question->update(['is_approved' => true]);
        return back()->with('success', 'Question approved successfully.');
    }

    public function destroyQuestion(ProductQuestion $question)
    {
        $question->delete();
        return back()->with('success', 'Question deleted successfully.');
    }

    public function destroyImage(ProductImage $image)
    {
        $image->delete();
        return response()->json(['success' => true, 'message' => 'Gallery image deleted successfully.']);
    }
}
