<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('material')->nullable()->after('summary');
            $table->string('occasion')->nullable()->after('material');
            $table->json('related_products')->nullable()->after('meta_keywords');
            $table->json('upsell_products')->nullable()->after('related_products');
            $table->json('cross_sell_products')->nullable()->after('upsell_products');
            $table->boolean('is_approved')->default(true)->after('is_active');
            $table->string('barcode')->nullable()->after('sku');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'material',
                'occasion',
                'related_products',
                'upsell_products',
                'cross_sell_products',
                'is_approved',
                'barcode',
            ]);
        });
    }
};
