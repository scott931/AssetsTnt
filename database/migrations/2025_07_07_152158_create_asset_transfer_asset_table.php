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
        Schema::create('asset_transfer_asset', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_transfer_id');
            $table->unsignedBigInteger('asset_id');
            $table->timestamps();
            $table->foreign('asset_transfer_id')->references('id')->on('asset_transfers')->onDelete('cascade');
            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_transfer_asset');
    }
};
