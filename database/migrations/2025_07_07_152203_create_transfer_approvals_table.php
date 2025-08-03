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
        Schema::create('transfer_approvals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_transfer_id');
            $table->unsignedBigInteger('approver_id');
            $table->integer('level');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('comment')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->foreign('asset_transfer_id')->references('id')->on('asset_transfers')->onDelete('cascade');
            $table->foreign('approver_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_approvals');
    }
};
