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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('asset_tag')->unique(); // Unique asset ID/tag
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained('asset_categories')->onDelete('restrict');
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onDelete('set null');
            $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('set null');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');

            // Procurement Information
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_cost', 15, 2)->nullable();
            $table->string('purchase_order_number')->nullable();
            $table->string('warranty_expiry')->nullable();

            // Asset Details
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('location')->nullable();
            $table->string('condition')->default('good'); // excellent, good, fair, poor, damaged

            // Financial Information
            $table->decimal('current_value', 15, 2)->nullable();
            $table->decimal('depreciation_rate', 5, 2)->default(0);
            $table->enum('depreciation_method', ['straight_line', 'declining_balance'])->default('straight_line');
            $table->date('depreciation_start_date')->nullable();

            // Status and Lifecycle
            $table->enum('status', ['active', 'inactive', 'maintenance', 'retired', 'lost', 'damaged'])->default('active');
            $table->date('retirement_date')->nullable();
            $table->text('retirement_reason')->nullable();

            // Files
            $table->string('photo_path')->nullable();
            $table->string('manual_path')->nullable();
            $table->string('receipt_path')->nullable();

            // Metadata
            $table->json('specifications')->nullable(); // Store additional specifications as JSON
            $table->text('notes')->nullable();
            $table->timestamps();

            // Indexes for better performance
            $table->index(['status', 'department_id']);
            $table->index(['category_id', 'status']);
            $table->index('assigned_to');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
