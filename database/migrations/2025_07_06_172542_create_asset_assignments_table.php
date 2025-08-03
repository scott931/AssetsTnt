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
        Schema::create('asset_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assets')->onDelete('cascade');
            $table->foreignId('assigned_to')->constrained('users')->onDelete('cascade');
            $table->foreignId('assigned_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('set null');

            // Assignment Details
            $table->dateTime('assigned_at');
            $table->dateTime('expected_return_at')->nullable();
            $table->dateTime('returned_at')->nullable();
            $table->foreignId('returned_to')->nullable()->constrained('users')->onDelete('set null');

            // Status
            $table->enum('status', ['active', 'returned', 'overdue'])->default('active');
            $table->text('assignment_notes')->nullable();
            $table->text('return_notes')->nullable();

            // Location tracking
            $table->string('assigned_location')->nullable();
            $table->string('returned_location')->nullable();

            $table->timestamps();

            // Indexes
            $table->index(['asset_id', 'status']);
            $table->index(['assigned_to', 'status']);
            $table->index('expected_return_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_assignments');
    }
};
