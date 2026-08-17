<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Coupon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CouponTest extends TestCase
{
    use RefreshDatabase;

    public function test_apply_valid_coupon(): void
    {
        // 1. Create a valid active coupon
        $coupon = Coupon::create([
            'code' => 'WELCOME10',
            'type' => 'percentage',
            'value' => 10,
            'is_active' => true,
            'start_date' => now()->subDay(),
            'end_date' => now()->addDays(5),
            'min_order_value' => 1000,
            'limit' => 100,
            'used_count' => 0
        ]);

        // 2. Set mock cart in session with a subtotal > minimum order value
        $cart = [
            'p1' => [
                'id' => 1,
                'name' => 'Royal Saree',
                'price' => 2000,
                'quantity' => 1,
                'image' => 'images/product_main.png',
                'size' => 'Free Size'
            ]
        ];

        // 3. Make the API POST request to apply the coupon
        $response = $this->withSession(['cart' => $cart])
            ->postJson(route('checkout.coupon'), [
                'code' => 'WELCOME10'
            ]);

        // 4. Assert response is success
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'code' => 'WELCOME10'
        ]);

        $this->assertEquals('WELCOME10', session('coupon_code'));
    }

    public function test_apply_invalid_coupon(): void
    {
        // Make the API POST request with a coupon that does not exist
        $response = $this->postJson(route('checkout.coupon'), [
            'code' => 'NONEXISTENT'
        ]);

        // Assert response fails with proper message
        $response->assertStatus(200);
        $response->assertJson([
            'success' => false,
            'message' => 'Invalid or expired coupon code.'
        ]);
    }

    public function test_apply_expired_coupon(): void
    {
        // 1. Create an expired coupon
        $coupon = Coupon::create([
            'code' => 'EXPIRED50',
            'type' => 'fixed',
            'value' => 500,
            'is_active' => true,
            'start_date' => now()->subDays(10),
            'end_date' => now()->subDay(), // expired yesterday
            'min_order_value' => 1000,
            'limit' => 100,
            'used_count' => 0
        ]);

        // 2. Make the API POST request
        $response = $this->postJson(route('checkout.coupon'), [
            'code' => 'EXPIRED50'
        ]);

        // 3. Assert response fails with expired message
        $response->assertStatus(200);
        $response->assertJson([
            'success' => false,
            'message' => 'Invalid or expired coupon code.'
        ]);
    }

    public function test_apply_coupon_with_under_min_value(): void
    {
        // 1. Create a coupon requiring min order value
        $coupon = Coupon::create([
            'code' => 'HIGHVAL20',
            'type' => 'percentage',
            'value' => 20,
            'is_active' => true,
            'min_order_value' => 10000, // Requires ₹10,000
            'limit' => 100,
            'used_count' => 0
        ]);

        // 2. Set cart subtotal under ₹10,000 (e.g. ₹5,000)
        $cart = [
            'p1' => [
                'id' => 1,
                'name' => 'Designer Suit',
                'price' => 5000,
                'quantity' => 1,
                'image' => 'images/product_main.png',
                'size' => 'Free Size'
            ]
        ];

        // 3. Apply the coupon
        $response = $this->withSession(['cart' => $cart])
            ->postJson(route('checkout.coupon'), [
                'code' => 'HIGHVAL20'
            ]);

        // 4. Assert response fails with min order limit alert message
        $response->assertStatus(200);
        $response->assertJson([
            'success' => false,
            'message' => 'Minimum purchase of ₹10,000.00 required to apply this coupon.'
        ]);
    }
}
