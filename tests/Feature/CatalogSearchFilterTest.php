<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariant;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CatalogSearchFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_by_product_name_and_product_code(): void
    {
        $category = Category::create([
            'name' => 'Sarees',
            'slug' => 'sarees',
            'is_active' => true
        ]);

        // Create base product
        $product = Product::create([
            'name' => 'Royal Banarasi Silk Saree',
            'slug' => 'royal-banarasi-silk-saree',
            'description' => 'A heavy gold zari handwoven saree.',
            'category_id' => $category->id,
            'sku' => 'BANARASI-101',
            'price' => 15000,
            'is_active' => true,
            'is_approved' => true
        ]);

        // Create a variant
        $variant = ProductVariant::create([
            'product_id' => $product->id,
            'sku' => 'BANARASI-101-RED-M',
            'price' => 15000,
            'stock' => 10,
            'color' => 'Red',
            'size' => 'M',
            'fabric' => 'Silk'
        ]);

        // 1. Search by Name
        $responseName = $this->get(route('search', ['q' => 'Banarasi']));
        $responseName->assertStatus(200);
        $responseName->assertSee('Royal Banarasi Silk Saree');

        // 2. Search by base SKU (Product Code)
        $responseCode = $this->get(route('search', ['q' => 'BANARASI-101']));
        $responseCode->assertStatus(200);
        $responseCode->assertSee('Royal Banarasi Silk Saree');

        // 3. Search by variant SKU
        $responseVarCode = $this->get(route('search', ['q' => 'BANARASI-101-RED-M']));
        $responseVarCode->assertStatus(200);
        $responseVarCode->assertSee('Royal Banarasi Silk Saree');
    }

    public function test_filter_by_price_color_fabric_size(): void
    {
        $category = Category::create([
            'name' => 'Sarees',
            'slug' => 'sarees',
            'is_active' => true
        ]);

        // Create product 1: Red Silk Saree
        $productRed = Product::create([
            'name' => 'Crimson Red Silk Saree',
            'slug' => 'crimson-red-silk-saree',
            'material' => 'Silk',
            'category_id' => $category->id,
            'sku' => 'RED-SILK-01',
            'price' => 6000,
            'is_active' => true,
            'is_approved' => true
        ]);
        ProductVariant::create([
            'product_id' => $productRed->id,
            'sku' => 'RED-SILK-01-V',
            'price' => 6000,
            'stock' => 10,
            'color' => 'Red',
            'size' => 'Free Size',
            'fabric' => 'Silk'
        ]);

        // Create product 2: Green Chanderi Saree
        $productGreen = Product::create([
            'name' => 'Emerald Green Chanderi Saree',
            'slug' => 'emerald-green-chanderi-saree',
            'material' => 'Chanderi',
            'category_id' => $category->id,
            'sku' => 'GREEN-CHAN-02',
            'price' => 22000,
            'is_active' => true,
            'is_approved' => true
        ]);
        ProductVariant::create([
            'product_id' => $productGreen->id,
            'sku' => 'GREEN-CHAN-02-V',
            'price' => 22000,
            'stock' => 5,
            'color' => 'Green',
            'size' => 'L',
            'fabric' => 'Chanderi'
        ]);

        // 1. Filter by Color Red
        $responseRedColor = $this->get(route('sarees', ['colors' => ['Red']]));
        $responseRedColor->assertStatus(200);
        $responseRedColor->assertSee('Crimson Red Silk Saree');
        $responseRedColor->assertDontSee('Emerald Green Chanderi Saree');

        // 2. Filter by Fabric Chanderi
        $responseChanderi = $this->get(route('sarees', ['fabrics' => ['Chanderi']]));
        $responseChanderi->assertStatus(200);
        $responseChanderi->assertSee('Emerald Green Chanderi Saree');
        $responseChanderi->assertDontSee('Crimson Red Silk Saree');

        // 3. Filter by Size L
        $responseSizeL = $this->get(route('sarees', ['sizes' => ['L']]));
        $responseSizeL->assertStatus(200);
        $responseSizeL->assertSee('Emerald Green Chanderi Saree');
        $responseSizeL->assertDontSee('Crimson Red Silk Saree');

        // 4. Filter by Price 5000-15000
        $responsePrice = $this->get(route('sarees', ['price' => '5000_15000']));
        $responsePrice->assertStatus(200);
        $responsePrice->assertSee('Crimson Red Silk Saree');
        $responsePrice->assertDontSee('Emerald Green Chanderi Saree');
    }
}
