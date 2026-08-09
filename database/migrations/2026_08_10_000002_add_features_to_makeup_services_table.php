<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('makeup_services', function (Blueprint $table) {
            if (!Schema::hasColumn('makeup_services', 'features')) {
                $table->text('features')->nullable()->after('description');
            }
            if (!Schema::hasColumn('makeup_services', 'is_popular')) {
                $table->boolean('is_popular')->default(false)->after('is_active');
            }
        });
    }

    public function down(): void
    {
        Schema::table('makeup_services', function (Blueprint $table) {
            $table->dropColumn(['features', 'is_popular']);
        });
    }
};
