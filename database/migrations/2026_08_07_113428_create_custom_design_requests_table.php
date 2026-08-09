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
        Schema::create('custom_design_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('fabric_preference')->nullable();
            $table->string('budget_range')->nullable();
            $table->text('design_details');
            $table->string('status')->default('pending'); // pending, quotation_sent, approved, in_production, ready, completed, cancelled
            $table->decimal('estimated_price', 10, 2)->nullable();
            $table->date('estimated_delivery_date')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_design_requests');
    }
};
