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
        Schema::create('land_registers', function (Blueprint $table) {
            $table->id();
            $table->text('description_of_land');
            $table->enum('mode_of_acquisition', ['purchase', 'transfer', 'donation', 'inheritance', 'gift', 'other']);
            $table->enum('category', ['land', 'investment_property']);
            $table->string('county');
            $table->string('nearest_town_location');
            $table->string('gps_coordinates')->nullable();
            $table->string('polygon_a')->nullable();
            $table->string('polygon_b')->nullable();
            $table->string('polygon_c')->nullable();
            $table->string('polygon_d')->nullable();
            $table->string('lr_certificate_number')->nullable();
            $table->string('document_of_ownership_path')->nullable(); // File upload path
            $table->text('proprietorship_details');
            $table->decimal('size_hectares', 10, 4);
            $table->enum('ownership_status', ['freehold', 'leasehold']);
            $table->date('acquisition_date');
            $table->date('registration_date')->nullable();
            $table->enum('disputed_status', ['disputed', 'undisputed']);
            $table->text('encumbrances')->nullable();
            $table->enum('planning_status', ['planned', 'unplanned']);
            $table->text('purpose_use_of_land');
            $table->enum('survey_status', ['surveyed', 'not_surveyed']);
            $table->decimal('acquisition_amount', 15, 2)->nullable();
            $table->decimal('fair_value', 15, 2)->nullable();
            $table->string('zonal_maps_path')->nullable(); // File upload path for zonal maps
            $table->date('disposal_date')->nullable();
            $table->decimal('disposal_value', 15, 2)->nullable();
            $table->decimal('annual_rental_income', 15, 2)->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();

            // Indexes for better performance
            $table->index(['county', 'category']);
            $table->index('acquisition_date');
            $table->index('disputed_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_registers');
    }
};