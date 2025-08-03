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
        Schema::create('asset_maintenance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assets')->onDelete('cascade');
            $table->foreignId('performed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('vendor_id')->nullable()->constrained('suppliers')->onDelete('set null');

            // Maintenance Details
            $table->string('maintenance_type'); // preventive, corrective, emergency
            $table->string('title');
            $table->text('description');
            $table->date('service_date');
            $table->date('next_service_due')->nullable();

            // Cost and Time
            $table->decimal('cost', 15, 2)->nullable();
            $table->integer('duration_hours')->nullable();

            // Status and Results
            $table->enum('status', ['scheduled', 'in_progress', 'completed', 'cancelled'])->default('scheduled');
            $table->text('findings')->nullable();
            $table->text('actions_taken')->nullable();
            $table->text('recommendations')->nullable();

            // Parts and Materials
            $table->json('parts_used')->nullable(); // Store parts as JSON
            $table->text('parts_notes')->nullable();

            // Documentation
            $table->string('invoice_path')->nullable();
            $table->string('work_order_path')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            // Indexes
            $table->index(['asset_id', 'status']);
            $table->index('next_service_due');
            $table->index('service_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_maintenance');
    }
};
