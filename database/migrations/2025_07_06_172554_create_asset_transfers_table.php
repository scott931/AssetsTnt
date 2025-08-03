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
        Schema::create('asset_transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assets')->onDelete('cascade');
            $table->foreignId('requested_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');

            // Transfer Details
            $table->foreignId('from_department_id')->nullable()->constrained('departments')->onDelete('set null');
            $table->foreignId('to_department_id')->nullable()->constrained('departments')->onDelete('set null');
            $table->foreignId('from_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('to_user_id')->nullable()->constrained('users')->onDelete('set null');

            // Location Transfer
            $table->string('from_location')->nullable();
            $table->string('to_location')->nullable();

            // Transfer Process
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed', 'cancelled'])->default('pending');
            $table->dateTime('requested_at');
            $table->dateTime('approved_at')->nullable();
            $table->dateTime('completed_at')->nullable();

            // Approval Process
            $table->text('request_reason');
            $table->text('approval_notes')->nullable();
            $table->text('rejection_reason')->nullable();

            // Transfer Details
            $table->date('transfer_date')->nullable();
            $table->text('transfer_notes')->nullable();
            $table->string('transfer_method')->nullable(); // physical, digital, etc.

            $table->timestamps();

            // Indexes
            $table->index(['asset_id', 'status']);
            $table->index(['requested_by', 'status']);
            $table->index('requested_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_transfers');
    }
};
