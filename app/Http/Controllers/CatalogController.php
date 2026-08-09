<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\CustomDesignRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\MakeupBooking;
use App\Models\MakeupService;

class CatalogController extends Controller
{
    private function applyFilters($query, Request $request)
    {
        if ($request->filled('types') && is_array($request->types)) {
            $query->where(function($q) use ($request) {
                foreach ($request->types as $type) {
                    $q->orWhere('name', 'like', '%' . $type . '%')
                      ->orWhere('description', 'like', '%' . $type . '%');
                }
            });
        }

        if ($request->filled('occasions') && is_array($request->occasions)) {
            $query->where(function($q) use ($request) {
                foreach ($request->occasions as $occ) {
                    $q->orWhere('description', 'like', '%' . $occ . '%')
                      ->orWhere('name', 'like', '%' . $occ . '%');
                }
            });
        }

        if ($request->filled('price')) {
            $priceRange = $request->price;
            if ($priceRange === 'under_5000') {
                $query->where('price', '<', 5000);
            } elseif ($priceRange === '5000_10000') {
                $query->whereBetween('price', [5000, 10000]);
            } elseif ($priceRange === '10000_30000') {
                $query->whereBetween('price', [10000, 30000]);
            } elseif ($priceRange === 'under_15000') {
                $query->where('price', '<', 15000);
            } elseif ($priceRange === '15000_30000') {
                $query->whereBetween('price', [15000, 30000]);
            } elseif ($priceRange === 'under_20000') {
                $query->where('price', '<', 20000);
            } elseif ($priceRange === '20000_40000') {
                $query->whereBetween('price', [20000, 40000]);
            } elseif ($priceRange === 'above_10000') {
                $query->where('price', '>', 10000);
            } elseif ($priceRange === 'above_15000') {
                $query->where('price', '>', 15000);
            } elseif ($priceRange === 'above_30000') {
                $query->where('price', '>', 30000);
            } elseif ($priceRange === 'above_40000') {
                $query->where('price', '>', 40000);
            }
        }

        if ($request->filled('sort_by')) {
            $sortBy = $request->sort_by;
            if ($sortBy === 'price_low_high') {
                $query->orderBy('price', 'asc');
            } elseif ($sortBy === 'price_high_low') {
                $query->orderBy('price', 'desc');
            } elseif ($sortBy === 'newest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($sortBy === 'popular') {
                $query->orderBy('is_best_seller', 'desc')->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return $query;
    }

    public function sarees(Request $request)
    {
        $category = Category::where('slug', 'sarees')->first();
        if (!$category) {
            $products = collect();
        } else {
            $query = Product::where('category_id', $category->id)->where('is_active', true)->with('images');
            $query = $this->applyFilters($query, $request);
            $products = $query->get();
        }

        return view('product', compact('products'));
    }

    public function suits(Request $request)
    {
        $category = Category::where('slug', 'suits')->first();
        if (!$category) {
            $products = collect();
        } else {
            $query = Product::where('category_id', $category->id)->where('is_active', true)->with('images');
            $query = $this->applyFilters($query, $request);
            $products = $query->get();
        }

        return view('product', compact('products'));
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('q');
        if (!$searchQuery) {
            return redirect()->route('home');
        }

        $query = Product::where('is_active', true)
            ->where(function($q) use ($searchQuery) {
                $q->where('name', 'like', '%' . $searchQuery . '%')
                  ->orWhere('description', 'like', '%' . $searchQuery . '%')
                  ->orWhere('sku', 'like', '%' . $searchQuery . '%')
                  ->orWhere('material', 'like', '%' . $searchQuery . '%')
                  ->orWhere('occasion', 'like', '%' . $searchQuery . '%');
            })
            ->with('images');
            
        $query = $this->applyFilters($query, $request);
        $products = $query->get();

        return view('product', compact('products', 'searchQuery'));
    }

    public function lehengas(Request $request)
    {
        $category = Category::where('slug', 'lehengas')->first();
        if (!$category) {
            $products = collect();
        } else {
            $query = Product::where('category_id', $category->id)->where('is_active', true)->with('images');
            $query = $this->applyFilters($query, $request);
            $products = $query->get();
        }

        return view('lehengas', compact('products'));
    }

    public function bridalCollection(Request $request)
    {
        $category = Category::where('slug', 'bridal-wear')->first();
        if (!$category) {
            $products = collect();
        } else {
            $query = Product::where('category_id', $category->id)->where('is_active', true)->with('images');
            $query = $this->applyFilters($query, $request);
            $products = $query->get();
        }

        return view('bridal-collection', compact('products'));
    }

    public function showProduct($slug)
    {
        $product = Product::where('slug', $slug)->where('is_active', true)->with(['images', 'category', 'variants'])->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->with('images')
            ->limit(4)
            ->get();

        return view('product-details', compact('product', 'relatedProducts'));
    }

    public function customLehenga()
    {
        return view('custom-lehenga');
    }

    public function submitCustomLehenga(Request $request)
    {
        $request->validate([
            'fabric_preference' => ['nullable', 'string', 'max:255'],
            'budget_range' => ['nullable', 'string', 'max:255'],
            'design_details' => ['required', 'string', 'max:5000'],
            'design_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            
            // Guest support details if not logged in
            'guest_name' => ['required_if:is_guest,1', 'nullable', 'string', 'max:255'],
            'guest_email' => ['required_if:is_guest,1', 'nullable', 'email', 'max:255'],
            'guest_phone' => ['required_if:is_guest,1', 'nullable', 'string', 'max:20'],
        ]);

        $customerId = null;

        if (Auth::check()) {
            $user = Auth::user();
            if (!$user->customer) {
                $names = explode(' ', $user->name, 2);
                $customer = Customer::create([
                    'user_id' => $user->id,
                    'first_name' => $names[0] ?? 'User',
                    'last_name' => $names[1] ?? 'Customer',
                    'email' => $user->email,
                    'status' => 'active'
                ]);
            } else {
                $customer = $user->customer;
            }
            $customerId = $customer->id;
        } else {
            // Guest customer creation / linking
            $email = $request->guest_email;
            $customer = Customer::where('email', $email)->first();
            
            if (!$customer) {
                $names = explode(' ', $request->guest_name, 2);
                $customer = Customer::create([
                    'first_name' => $names[0] ?? 'Guest',
                    'last_name' => $names[1] ?? 'Customer',
                    'email' => $email,
                    'phone' => $request->guest_phone,
                    'status' => 'active'
                ]);
            }
            $customerId = $customer->id;
        }

        $imagePath = null;
        if ($request->hasFile('design_image')) {
            $imagePath = \App\Services\ImageOptimizerService::compressAndStore($request->file('design_image'), 'designs', 1200, 1600, 82);
        }

        CustomDesignRequest::create([
            'customer_id' => $customerId,
            'fabric_preference' => $request->fabric_preference,
            'budget_range' => $request->budget_range,
            'design_details' => $request->design_details,
            'image_path' => $imagePath,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Your custom bridal lehenga details have been recorded! Our design consultants will contact you shortly.');
    }

    public function gallery()
    {
        $galleries = \App\Models\Gallery::where('is_active', true)->orderBy('sort_order', 'asc')->orderBy('id', 'desc')->get();
        return view('gallery', compact('galleries'));
    }

    public function makeupServices()
    {
        $services = MakeupService::where('is_active', true)->orderBy('price', 'asc')->get();
        return view('makeup-services', compact('services'));
    }

    public function submitMakeupBooking(Request $request)
    {
        $request->validate([
            'makeup_package' => ['required', 'string', 'max:255'],
            'booking_date' => ['required', 'date', 'after:today'],
            'notes' => ['nullable', 'string', 'max:5000'],
            
            // Guest support details if not logged in
            'guest_name' => ['required_if:is_guest,1', 'nullable', 'string', 'max:255'],
            'guest_email' => ['required_if:is_guest,1', 'nullable', 'email', 'max:255'],
            'guest_phone' => ['required_if:is_guest,1', 'nullable', 'string', 'max:20'],
        ]);

        $customerId = null;

        if (Auth::check()) {
            $user = Auth::user();
            if (!$user->customer) {
                $names = explode(' ', $user->name, 2);
                $customer = Customer::create([
                    'user_id' => $user->id,
                    'first_name' => $names[0] ?? 'User',
                    'last_name' => $names[1] ?? 'Customer',
                    'email' => $user->email,
                    'status' => 'active'
                ]);
            } else {
                $customer = $user->customer;
            }
            $customerId = $customer->id;
        } else {
            // Guest customer creation / linking
            $email = $request->guest_email;
            $customer = Customer::where('email', $email)->first();
            
            if (!$customer) {
                $names = explode(' ', $request->guest_name, 2);
                $customer = Customer::create([
                    'first_name' => $names[0] ?? 'Guest',
                    'last_name' => $names[1] ?? 'Customer',
                    'email' => $email,
                    'phone' => $request->guest_phone,
                    'status' => 'active'
                ]);
            } else {
                if ($request->guest_phone) {
                    $customer->update(['phone' => $request->guest_phone]);
                }
            }
            $customerId = $customer->id;
        }

        // Match service or create a default makeup service price
        $packageName = $request->makeup_package;
        $price = 11999.00; // HD Bridal default
        if (Str::contains($packageName, 'Airbrush')) {
            $price = 17999.00;
        } elseif (Str::contains($packageName, 'Signature')) {
            $price = 24999.00;
        }

        // Find or create active service for relational consistency
        $service = MakeupService::where('name', 'like', '%' . explode(' ', $packageName)[0] . '%')->first();
        $serviceId = $service ? $service->id : MakeupService::first()->id;

        MakeupBooking::create([
            'customer_id' => $customerId,
            'makeup_service_id' => $serviceId,
            'booking_date' => $request->booking_date,
            'artist_name' => 'Assigned Designer Artist',
            'status' => 'pending',
            'total_price' => $price,
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Your bridal makeup artist booking has been received! Our beauty coordinators will contact you to confirm timing.');
    }

    public function bridalPackages()
    {
        $packages = \App\Models\BridalPackage::where('is_active', true)->get();
        return view('bridal-packages', compact('packages'));
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        \App\Models\ContactInquiry::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'unread',
        ]);

        return back()->with('success', 'Thank you, ' . $request->name . '! Your luxury concierge inquiry has been received. Our stylists will connect with you shortly.');
    }

    public function apiProducts(Request $request)
    {
        $page = $request->get('page', 1);
        $products = Product::where('is_active', true)
            ->with(['images'])
            ->latest()
            ->paginate(8, ['*'], 'page', $page);

        $html = '';
        foreach ($products as $product) {
            $html .= view('partials.product_card', compact('product'))->render();
        }

        return response()->json([
            'html' => $html,
            'has_more' => $products->hasMorePages(),
            'next_page' => $products->currentPage() + 1
        ]);
    }
}
