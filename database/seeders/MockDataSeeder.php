<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CustomerGroup;
use App\Models\Address;
use App\Models\Review;
use App\Models\Wishlist;
use App\Models\WalletTransaction;
use App\Models\Collection;
use App\Models\Tag;
use App\Models\ProductQuestion;
use App\Models\Coupon;
use App\Models\BridalPackage;
use App\Models\Appointment;
use App\Models\Measurement;
use App\Models\CustomDesignRequest;
use App\Models\MakeupService;
use App\Models\MakeupBooking;
use Carbon\Carbon;

class MockDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Categories
        $categories = [
            ['name' => 'Sarees', 'slug' => 'sarees'],
            ['name' => 'Lehengas', 'slug' => 'lehengas'],
            ['name' => 'Suits', 'slug' => 'suits'],
            ['name' => 'Bridal Wear', 'slug' => 'bridal-wear'],
        ];
        
        $catModels = [];
        foreach ($categories as $cat) {
            $catModels[] = Category::create($cat);
        }

        // 2. Brands
        $brands = [
            ['name' => 'RaniSahab Signature', 'slug' => 'ranisahab-signature'],
            ['name' => 'Royal Heritage', 'slug' => 'royal-heritage'],
        ];
        
        $brandModels = [];
        foreach ($brands as $brand) {
            $brandModels[] = Brand::create($brand);
        }

        // 3. Products & Variants
        $products = [
            [
                'name' => 'Red Banarasi Silk Saree',
                'slug' => 'red-banarasi-silk-saree',
                'price' => 15000,
                'sale_price' => 12500,
                'cost_price' => 6000,
                'category_id' => $catModels[0]->id,
                'brand_id' => $brandModels[0]->id,
                'is_featured' => true,
                'is_best_seller' => true,
            ],
            [
                'name' => 'Golden Zardozi Lehenga',
                'slug' => 'golden-zardozi-lehenga',
                'price' => 85000,
                'sale_price' => 78000,
                'cost_price' => 40000,
                'category_id' => $catModels[1]->id,
                'brand_id' => $brandModels[0]->id,
                'is_featured' => true,
            ],
            [
                'name' => 'Pink Anarkali Suit',
                'slug' => 'pink-anarkali-suit',
                'price' => 8500,
                'sale_price' => 7200,
                'cost_price' => 3500,
                'category_id' => $catModels[2]->id,
                'brand_id' => $brandModels[1]->id,
                'is_new_arrival' => true,
            ],
        ];

        foreach ($products as $prod) {
            $product = Product::create($prod);
            ProductVariant::create([
                'product_id' => $product->id,
                'sku' => strtoupper(Str::random(8)),
                'price' => $product->price,
                'sale_price' => $product->sale_price,
                'stock' => rand(5, 20),
                'color' => 'Default',
                'size' => 'Free Size',
            ]);
        }

        // 4. Customers
        $customers = [
            ['first_name' => 'Ananya', 'last_name' => 'Sharma', 'email' => 'ananya@example.com', 'phone' => '9876543210', 'wallet_balance' => 500.00, 'reward_points' => 120],
            ['first_name' => 'Priya', 'last_name' => 'Patel', 'email' => 'priya@example.com', 'phone' => '8765432109', 'wallet_balance' => 0.00, 'reward_points' => 50],
            ['first_name' => 'Riya', 'last_name' => 'Sen', 'email' => 'riya@example.com', 'phone' => '7654321098', 'wallet_balance' => 1500.00, 'reward_points' => 350],
        ];

        $customerModels = [];
        foreach ($customers as $cust) {
            $customerModels[] = Customer::create($cust);
        }

        // 5. Orders
        // Let's create mock orders for the last 6 months to make Chart.js look nice
        for ($i = 0; $i < 30; $i++) {
            $customer = $customerModels[array_rand($customerModels)];
            $date = Carbon::now()->subDays(rand(1, 180));
            $subtotal = rand(5000, 90000);
            $discount = rand(0, 1) ? 500 : 0;
            $tax = $subtotal * 0.18; // 18% GST
            $total = $subtotal - $discount + $tax;
            
            $status = 'delivered';
            if ($i < 3) $status = 'pending';
            elseif ($i < 6) $status = 'confirmed';
            
            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'customer_id' => $customer->id,
                'status' => $status,
                'payment_status' => $status === 'pending' ? 'unpaid' : 'paid',
                'payment_method' => array_rand(['cod' => 1, 'stripe' => 1, 'razorpay' => 1]),
                'subtotal' => $subtotal,
                'discount' => $discount,
                'shipping_charge' => 150.00,
                'tax' => $tax,
                'total' => $total + 150.00,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => 'Mock Bridal Saree/Lehenga',
                'product_sku' => 'SKU-' . rand(100, 999),
                'quantity' => rand(1, 2),
                'price' => $subtotal,
                'total' => $subtotal,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        // 6. Customer Groups
        $group1 = CustomerGroup::create(['name' => 'Boutique VIP', 'discount_percent' => 15.00, 'description' => 'Premium brides with high AOV']);
        $group2 = CustomerGroup::create(['name' => 'Wholesale Agent', 'discount_percent' => 25.00, 'description' => 'Regional bulk boutique resellers']);

        // Assign some customers to groups
        $customerModels[0]->update(['customer_group_id' => $group1->id]);
        $customerModels[2]->update(['customer_group_id' => $group2->id]);

        // 7. Addresses
        foreach ($customerModels as $c) {
            Address::create([
                'customer_id' => $c->id,
                'address_line_1' => 'Flat ' . rand(101, 909) . ', luxury Heights',
                'address_line_2' => 'MG Road',
                'city' => 'Mumbai',
                'state' => 'Maharashtra',
                'postal_code' => '400001',
                'country' => 'India',
                'is_default' => true,
            ]);
        }

        // 8. Reviews
        $dbProducts = Product::all();
        foreach ($customerModels as $index => $c) {
            if (isset($dbProducts[$index])) {
                Review::create([
                    'customer_id' => $c->id,
                    'product_id' => $dbProducts[$index]->id,
                    'rating' => rand(4, 5),
                    'comment' => 'Outstanding craftmanship! The embroidery work is breathtaking.',
                    'is_approved' => true,
                ]);

                // 9. Wishlist
                Wishlist::create([
                    'customer_id' => $c->id,
                    'product_id' => $dbProducts[$index]->id,
                ]);
            }
        }

        // 10. Wallet Transactions
        foreach ($customerModels as $c) {
            if ($c->wallet_balance > 0) {
                WalletTransaction::create([
                    'customer_id' => $c->id,
                    'amount' => $c->wallet_balance,
                    'type' => 'deposit',
                    'description' => 'Sign up registration bonus',
                ]);
            }
        }

        // 11. Collections
        $coll1 = Collection::create(['name' => 'Royal Bridal Couture 2026', 'slug' => 'royal-bridal-couture-2026', 'description' => 'Luxury bridal collections featuring detailed zardozi handloom craft.']);
        $coll2 = Collection::create(['name' => 'Spring Pastel Banarasi', 'slug' => 'spring-pastel-banarasi', 'description' => 'Light weight premium pastel shade sarees.']);

        // 12. Tags
        $tag1 = Tag::create(['name' => 'Zardozi', 'slug' => 'zardozi']);
        $tag2 = Tag::create(['name' => 'Banarasi', 'slug' => 'banarasi']);
        $tag3 = Tag::create(['name' => 'Handwoven', 'slug' => 'handwoven']);

        // Sync Collections & Tags to Products
        if (count($dbProducts) >= 2) {
            $dbProducts[0]->collections()->sync([$coll1->id]);
            $dbProducts[0]->tags()->sync([$tag1->id, $tag3->id]);
            
            $dbProducts[1]->collections()->sync([$coll2->id]);
            $dbProducts[1]->tags()->sync([$tag2->id, $tag3->id]);
        }

        // 13. Product Questions & Answers
        if (count($dbProducts) > 0) {
            ProductQuestion::create([
                'product_id' => $dbProducts[0]->id,
                'customer_id' => $customerModels[0]->id,
                'question_text' => 'Can this lehenga be customized to have a double dupatta?',
                'answer_text' => 'Yes, absolutely! We provide dual dupatta options in custom packages. Our team will contact you for measurements.',
                'replied_by' => 1, // Super Admin
                'is_approved' => true,
            ]);

            ProductQuestion::create([
                'product_id' => $dbProducts[0]->id,
                'customer_id' => $customerModels[1]->id,
                'question_text' => 'How many days does it take to ship custom orders?',
                'is_approved' => false, // Needs moderation
            ]);
        }

        // 14. Coupons
        Coupon::create([
            'code' => 'BRIDE2026',
            'type' => 'percentage',
            'value' => 15.00,
            'min_order_value' => 50000.00,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addYear(),
            'limit' => 100,
            'is_active' => true,
        ]);

        Coupon::create([
            'code' => 'FESTIVE500',
            'type' => 'fixed',
            'value' => 500.00,
            'min_order_value' => 5000.00,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addMonths(3),
            'limit' => 500,
            'is_active' => true,
        ]);

        // 15. Bridal Packages
        $pack1 = BridalPackage::create([
            'name' => 'Royal Heritage Zardozi Package',
            'slug' => 'royal-heritage-zardozi-package',
            'description' => 'Complete couture collection package containing custom heavy bridal lehenga, matching jewelry coordination, and two fittings.',
            'price' => 150000.00,
            'features' => ['Custom Zardozi Fitting', '2 Trial Sessions', 'Style Consultation', 'Priority Stitching Delivery'],
            'is_active' => true,
        ]);
        $pack2 = BridalPackage::create([
            'name' => 'Classic Silk Silhouette Package',
            'slug' => 'classic-silk-silhouette-package',
            'description' => 'Bridal silk lehenga fitting with matching blouse customizations and styling trial consultations.',
            'price' => 85000.00,
            'features' => ['Pure Banarasi Silk Lehenga', '1 Trial Session', 'Styling Consultation'],
            'is_active' => true,
        ]);

        // 16. Bridal Appointments
        if (count($customerModels) >= 2) {
            Appointment::create([
                'customer_id' => $customerModels[0]->id,
                'bridal_package_id' => $pack1->id,
                'appointment_date' => Carbon::now()->addDays(5),
                'status' => 'confirmed',
                'notes' => 'Bride wishes to try double dupatta matching with gold zardozi work lehenga.',
            ]);

            Appointment::create([
                'customer_id' => $customerModels[1]->id,
                'bridal_package_id' => $pack2->id,
                'appointment_date' => Carbon::now()->addDays(12),
                'status' => 'pending',
                'notes' => 'Requested weekend afternoon slots.',
            ]);
        }

        // 17. Measurement Sheets
        if (count($customerModels) > 0) {
            Measurement::create([
                'customer_id' => $customerModels[0]->id,
                'title' => 'Wedding Lehenga Fitting Specs',
                'bust' => 34.50,
                'waist' => 28.00,
                'hips' => 38.00,
                'shoulder' => 14.50,
                'chest' => 33.00,
                'sleeve_length' => 12.00,
                'lehenga_length' => 41.50,
                'blouse_length' => 14.00,
                'notes' => 'Provide extra margin in blouse stitching for future alterations.',
            ]);
        }

        // 18. Custom Design Requests (Custom Lehenga quotations)
        if (count($customerModels) >= 3) {
            CustomDesignRequest::create([
                'customer_id' => $customerModels[2]->id,
                'fabric_preference' => 'Kanchipuram Silk & Velvet',
                'budget_range' => '₹1,00,000 - ₹1,50,000',
                'design_details' => 'I would like a custom wedding saree designed in velvet maroon borders and rich handwoven gold motifs across the pallu, similar to heritage style.',
                'status' => 'quotation_sent',
                'estimated_price' => 125000.00,
                'estimated_delivery_date' => Carbon::now()->addMonths(2),
                'admin_notes' => 'Quotation generated and shared with customer via WhatsApp/Email. Awaiting review.',
            ]);
        }

        // 19. Makeup Services
        $ms1 = MakeupService::create([
            'name' => 'Bridal HD Airbrush Package',
            'slug' => 'bridal-hd-airbrush-package',
            'description' => 'Complete airbrush makeover with premium lashes, hair styling, draping, and touch-up kit.',
            'price' => 35000.00,
            'duration_minutes' => 180,
            'is_active' => true,
        ]);
        $ms2 = MakeupService::create([
            'name' => 'Sangeet Soft Glam Makeup',
            'slug' => 'sangeet-soft-glam-makeup',
            'description' => 'Soft glow dewy makeup with loose curls hair coordination.',
            'price' => 18000.00,
            'duration_minutes' => 120,
            'is_active' => true,
        ]);

        // 20. Makeup Bookings
        if (count($customerModels) >= 2) {
            MakeupBooking::create([
                'customer_id' => $customerModels[0]->id,
                'makeup_service_id' => $ms1->id,
                'artist_name' => 'Geetika Sen (Senior Artist)',
                'booking_date' => Carbon::now()->addDays(5)->setTime(10, 0, 0),
                'status' => 'confirmed',
                'total_price' => 35000.00,
                'notes' => 'Early morning venue booking. Travel coordinator details shared.',
            ]);
        }
    }
}
