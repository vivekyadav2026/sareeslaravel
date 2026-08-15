<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('description')->nullable();
            $table->string('type')->default('text');
            $table->timestamps();
        });

        // Insert defaults
        DB::table('settings')->insert([
            [
                'key' => 'shipping_rate_limit',
                'value' => '5000',
                'description' => 'Minimum order subtotal (₹) required for Free Shipping',
                'type' => 'number',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'shipping_charge',
                'value' => '150',
                'description' => 'Flat shipping fee (₹) for orders below free shipping limit',
                'type' => 'number',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'gst_rate_default',
                'value' => '18',
                'description' => 'Default GST rate percentage (%) applied if product rate is not specified',
                'type' => 'number',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
