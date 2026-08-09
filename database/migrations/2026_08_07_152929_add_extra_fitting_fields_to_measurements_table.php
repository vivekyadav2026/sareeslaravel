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
        Schema::table('measurements', function (Blueprint $table) {
            $table->decimal('front_neck_depth', 5, 2)->nullable()->after('blouse_length');
            $table->decimal('back_neck_depth', 5, 2)->nullable()->after('front_neck_depth');
            $table->decimal('armhole', 5, 2)->nullable()->after('back_neck_depth');
            $table->decimal('wrist', 5, 2)->nullable()->after('armhole');
            $table->decimal('ankle_length', 5, 2)->nullable()->after('wrist');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('measurements', function (Blueprint $table) {
            $table->dropColumn([
                'front_neck_depth',
                'back_neck_depth',
                'armhole',
                'wrist',
                'ankle_length',
            ]);
        });
    }
};
