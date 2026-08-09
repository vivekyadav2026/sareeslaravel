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
        Schema::table('customers', function (Blueprint $table) {
            // Drop foreign key if it exists. Ignore if not.
            try {
                $table->dropForeign(['customer_group_id']);
            } catch (\Exception $e) {}
            
            $table->dropColumn('customer_group_id');
        });

        Schema::dropIfExists('customer_groups');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not reversing
    }
};
