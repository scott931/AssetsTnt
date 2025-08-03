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
        Schema::create('transfer_audits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_transfer_id');
            $table->string('action');
            $table->unsignedBigInteger('user_id');
            $table->json('details')->nullable();
            $table->timestamps();
            $table->foreign('asset_transfer_id')->references('id')->on('asset_transfers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_audits');
    }
};
