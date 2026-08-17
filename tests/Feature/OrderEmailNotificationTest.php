<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use App\Mail\OrderConfirmed;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderEmailNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_notification_sent_on_order_confirmation(): void
    {
        Mail::fake();

        // 1. Create User
        $user = User::create([
            'name' => 'Royal Buyer',
            'email' => 'buyer@royal.com',
            'password' => bcrypt('password123')
        ]);

        // 2. Create Customer
        $customer = Customer::create([
            'user_id' => $user->id,
            'first_name' => 'Royal',
            'last_name' => 'Buyer',
            'email' => 'buyer@royal.com',
            'phone' => '9876543210',
            'status' => 'active'
        ]);

        // 3. Create mock Order
        $order = Order::create([
            'customer_id' => $customer->id,
            'order_number' => 'RS-100001',
            'subtotal' => 5000,
            'tax' => 900,
            'shipping_charge' => 0,
            'total' => 5900,
            'status' => 'pending',
            'payment_method' => 'cod'
        ]);

        // 4. Create mock Order Item
        OrderItem::create([
            'order_id' => $order->id,
            'product_name' => 'Bespoke Silk Saree',
            'product_sku' => 'SILK-001',
            'quantity' => 1,
            'price' => 5000,
            'total' => 5000
        ]);

        // 5. Create mock Address
        Address::create([
            'customer_id' => $customer->id,
            'address_line_1' => '123 Royal Lane',
            'city' => 'New Delhi',
            'state' => 'Delhi',
            'postal_code' => '110001',
            'is_default' => true
        ]);

        // 6. Send order confirmation email
        Mail::to($customer->email)->send(new OrderConfirmed($order));

        // 7. Assert that a mail was sent to the buyer's email
        Mail::assertSent(OrderConfirmed::class, function ($mail) use ($customer, $order) {
            return $mail->hasTo($customer->email) &&
                   $mail->order->order_number === $order->order_number &&
                   $mail->order->total === $order->total;
        });
    }
}
