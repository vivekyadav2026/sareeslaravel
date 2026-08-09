<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $productId = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
            'color' => 'nullable|string',
            'size' => 'nullable|string'
        ]);

        $product = Product::with('images')->findOrFail($request->product_id);
        $qty = $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        $imagePath = 'images/cat_saree.png'; // default fallback
        if ($product->images && $product->images->isNotEmpty()) {
            $imagePath = $product->images->first()->file_path;
        }

        $cartId = $product->id; // Using product id as key for simplicity

        if (isset($cart[$cartId])) {
            $cart[$cartId]['quantity'] += $qty;
        } else {
            $cart[$cartId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => (float)($product->sale_price ?: $product->price),
                'image' => $imagePath,
                'quantity' => $qty,
                'color' => $request->input('color', 'Maroon'),
                'size' => $request->input('size', 'Free Size'),
            ];
        }

        session()->put('cart', $cart);

        $cartCount = collect($cart)->sum('quantity');

        return response()->json([
            'success' => true,
            'message' => "{$product->name} added to your shopping bag!",
            'cart_count' => $cartCount,
            'cart' => $cart
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        $cartCount = collect($cart)->sum('quantity');
        $subtotal = $this->calculateSubtotal($cart);

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully.',
            'cart_count' => $cartCount,
            'subtotal' => $subtotal
        ]);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
        }

        $cartCount = collect($cart)->sum('quantity');
        $subtotal = $this->calculateSubtotal($cart);

        return response()->json([
            'success' => true,
            'message' => 'Item removed from bag.',
            'cart_count' => $cartCount,
            'subtotal' => $subtotal
        ]);
    }

    public function addPackage(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:bridal_packages,id'
        ]);

        $package = \App\Models\BridalPackage::findOrFail($request->package_id);
        $cart = session()->get('cart', []);

        $cartId = 'pkg-' . $package->id;

        // Image mapping for packages
        $imagePath = 'images/pkg_silver.png';
        if (\Illuminate\Support\Str::contains(strtolower($package->name), 'gold')) {
            $imagePath = 'images/pkg_gold.png';
        } elseif (\Illuminate\Support\Str::contains(strtolower($package->name), 'royal') || \Illuminate\Support\Str::contains(strtolower($package->name), 'heritage')) {
            $imagePath = 'images/pkg_royal.png';
        }

        if (isset($cart[$cartId])) {
            $cart[$cartId]['quantity'] += 1;
        } else {
            $cart[$cartId] = [
                'id' => $cartId,
                'name' => $package->name,
                'price' => (float)$package->price,
                'image' => $imagePath,
                'quantity' => 1,
                'color' => 'Custom Gold Coordination',
                'size' => 'Designer Tailored',
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('checkout')->with('success', "{$package->name} added to your shopping bag!");
    }

    private function calculateSubtotal($cart)
    {
        return collect($cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });
    }
}
