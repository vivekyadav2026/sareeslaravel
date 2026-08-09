<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'rating')) {
                $table->decimal('rating', 3, 1)->default(4.9)->after('price');
            }
            if (!Schema::hasColumn('products', 'reviews_count')) {
                $table->integer('reviews_count')->default(12)->after('rating');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'rating')) {
                $table->dropColumn('rating');
            }
            if (Schema::hasColumn('products', 'reviews_count')) {
                $table->dropColumn('reviews_count');
            }
        });
    }
};
