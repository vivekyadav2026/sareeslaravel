<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductImage;

class BoutiqueProductsSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure Categories and Brands exist
        $sareesCat = Category::firstOrCreate(['slug' => 'sarees'], ['name' => 'Sarees']);
        $suitsCat = Category::firstOrCreate(['slug' => 'suits'], ['name' => 'Suits']);
        $lehengasCat = Category::firstOrCreate(['slug' => 'lehengas'], ['name' => 'Lehengas']);
        $bridalCat = Category::firstOrCreate(['slug' => 'bridal-wear'], ['name' => 'Bridal Wear']);

        $brand = Brand::firstOrCreate(['slug' => 'ranisahab-signature'], ['name' => 'RaniSahab Signature']);

        // Data arrays
        $sarees = [
            ['name' => 'Royal Banarasi Silk Saree', 'price' => 3999, 'image' => 'images/cat_saree.png', 'is_best_seller' => true, 'is_new_arrival' => false, 'is_featured' => false],
            ['name' => 'Maroon Zari Weaving Saree', 'price' => 4499, 'image' => 'images/product_main.png', 'is_best_seller' => false, 'is_new_arrival' => true, 'is_featured' => false],
            ['name' => 'Pure Katan Silk Saree', 'price' => 5999, 'image' => 'images/fabric_detail.png', 'is_best_seller' => false, 'is_new_arrival' => false, 'is_featured' => true],
            ['name' => 'Kanjivaram Wedding Saree', 'price' => 7499, 'image' => 'images/hero_bride.png', 'is_best_seller' => true, 'is_new_arrival' => false, 'is_featured' => false],
            ['name' => 'Organza Silk Bridal Saree', 'price' => 6299, 'image' => 'images/promise_bride.png', 'is_best_seller' => false, 'is_new_arrival' => true, 'is_featured' => false],
            ['name' => 'Crimson Paithani Saree', 'price' => 8999, 'image' => 'images/cat_bridal.png', 'is_best_seller' => false, 'is_new_arrival' => false, 'is_featured' => false],
            ['name' => 'Chanderi Silk Festive Saree', 'price' => 3499, 'image' => 'images/pkg_royal.png', 'is_best_seller' => false, 'is_new_arrival' => false, 'is_featured' => true],
            ['name' => 'Gold Soft Silk Saree', 'price' => 4199, 'image' => 'images/pkg_gold.png', 'is_best_seller' => true, 'is_new_arrival' => false, 'is_featured' => false]
        ];

        $suits = [
            ['name' => 'Royal White Georgette Suit', 'price' => 3499, 'image' => 'images/cat_suit.png', 'is_best_seller' => true, 'is_new_arrival' => false, 'is_featured' => false],
            ['name' => 'Crimson Velvet Anarkali', 'price' => 5999, 'image' => 'images/cat_bridal.png', 'is_best_seller' => false, 'is_new_arrival' => true, 'is_featured' => false],
            ['name' => 'Maroon Zardozi Sharara Set', 'price' => 8499, 'image' => 'images/hero_bride.png', 'is_best_seller' => false, 'is_new_arrival' => false, 'is_featured' => true],
            ['name' => 'Mustard Silk Gota Suit', 'price' => 2999, 'image' => 'images/pkg_gold.png', 'is_best_seller' => false, 'is_new_arrival' => false, 'is_featured' => false],
            ['name' => 'Silver Mirror Work Anarkali', 'price' => 4799, 'image' => 'images/pkg_silver.png', 'is_best_seller' => true, 'is_new_arrival' => false, 'is_featured' => false],
            ['name' => 'Rose Silk Straight Suit', 'price' => 2499, 'image' => 'images/cat_saree.png', 'is_best_seller' => false, 'is_new_arrival' => true, 'is_featured' => false],
            ['name' => 'Deep Blue Embroidered Suit', 'price' => 6299, 'image' => 'images/promise_bride.png', 'is_best_seller' => false, 'is_new_arrival' => false, 'is_featured' => true],
            ['name' => 'Peach Organza Palazzo Suit', 'price' => 3799, 'image' => 'images/pkg_royal.png', 'is_best_seller' => false, 'is_new_arrival' => false, 'is_featured' => false]
        ];

        $lehengas = [
            ['name' => 'Royal Velvet Bridal Lehenga', 'price' => 24999, 'image' => 'images/cat_lehenga.png', 'is_best_seller' => false, 'is_new_arrival' => true, 'is_featured' => false],
            ['name' => 'Rose Gold Zari Lehenga', 'price' => 22999, 'image' => 'images/hero_bride.png', 'is_best_seller' => true, 'is_new_arrival' => false, 'is_featured' => false],
            ['name' => 'Emerald Heritage Lehenga', 'price' => 26999, 'image' => 'images/promise_bride.png', 'is_best_seller' => false, 'is_new_arrival' => false, 'is_featured' => true],
            ['name' => 'Red Royal Bridal Lehenga', 'price' => 28999, 'image' => 'images/cat_bridal.png', 'is_best_seller' => false, 'is_new_arrival' => false, 'is_featured' => false],
            ['name' => 'Crimson Kundan Lehenga', 'price' => 19999, 'image' => 'images/pkg_royal.png', 'is_best_seller' => false, 'is_new_arrival' => true, 'is_featured' => false],
            ['name' => 'Golden Zardozi Lehenga', 'price' => 31999, 'image' => 'images/pkg_gold.png', 'is_best_seller' => true, 'is_new_arrival' => false, 'is_featured' => false],
            ['name' => 'Ivory Pearl Sangeet Lehenga', 'price' => 17499, 'image' => 'images/pkg_silver.png', 'is_best_seller' => false, 'is_new_arrival' => false, 'is_featured' => true],
            ['name' => 'Maroon Velvet Haldi Lehenga', 'price' => 13999, 'image' => 'images/fabric_detail.png', 'is_best_seller' => false, 'is_new_arrival' => false, 'is_featured' => false]
        ];

        $bridal = [
            ['name' => 'Royal Red Kundan Lehenga', 'price' => 28999, 'image' => 'images/cat_bridal.png', 'is_best_seller' => false, 'is_new_arrival' => false, 'is_featured' => true],
            ['name' => 'Maroon Royal Heritage Lehenga', 'price' => 34999, 'image' => 'images/hero_bride.png', 'is_best_seller' => true, 'is_new_arrival' => false, 'is_featured' => false],
            ['name' => 'Crimson Velvet Drape Lehenga', 'price' => 39999, 'image' => 'images/promise_bride.png', 'is_best_seller' => false, 'is_new_arrival' => true, 'is_featured' => false],
            ['name' => 'Rose Gold Zari Bridal Set', 'price' => 44999, 'image' => 'images/pkg_royal.png', 'is_best_seller' => false, 'is_new_arrival' => false, 'is_featured' => true],
            ['name' => 'Ivory Kundan Bridal Lehenga', 'price' => 32999, 'image' => 'images/cat_lehenga.png', 'is_best_seller' => true, 'is_new_arrival' => false, 'is_featured' => false],
            ['name' => 'Golden Zardozi Reception Lehenga', 'price' => 37999, 'image' => 'images/pkg_gold.png', 'is_best_seller' => false, 'is_new_arrival' => true, 'is_featured' => false]
        ];

        $this->seedGroup($sarees, $sareesCat->id, $brand->id);
        $this->seedGroup($suits, $suitsCat->id, $brand->id);
        $this->seedGroup($lehengas, $lehengasCat->id, $brand->id);
        $this->seedGroup($bridal, $bridalCat->id, $brand->id);
    }

    private function seedGroup(array $items, int $categoryId, int $brandId): void
    {
        foreach ($items as $item) {
            $slug = Str::slug($item['name']);
            
            $product = Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $item['name'],
                    'description' => 'Experience the rich handwoven craftsmanship of RANISAHAB. Designed with standard margins, premium fabrics, and intricate thread work.',
                    'summary' => 'Premium designer boutique clothing.',
                    'category_id' => $categoryId,
                    'brand_id' => $brandId,
                    'sku' => 'SKU-' . strtoupper(Str::random(6)),
                    'price' => $item['price'],
                    'is_active' => true,
                    'is_featured' => $item['is_featured'],
                    'is_new_arrival' => $item['is_new_arrival'],
                    'is_best_seller' => $item['is_best_seller'],
                ]
            );

            // Seed Image
            ProductImage::updateOrCreate(
                ['product_id' => $product->id, 'file_path' => $item['image']],
                [
                    'type' => 'image',
                    'is_primary' => true,
                    'sort_order' => 0
                ]
            );

            // Seed Variant
            ProductVariant::updateOrCreate(
                ['product_id' => $product->id, 'color' => 'Default', 'size' => 'Free Size'],
                [
                    'sku' => $product->sku . '-VAR',
                    'price' => $product->price,
                    'stock' => rand(10, 45)
                ]
            );
        }
    }
}
