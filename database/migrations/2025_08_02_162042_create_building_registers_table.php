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
        Schema::create('building_registers', function (Blueprint $table) {
            $table->id();

            // Basic Information
            $table->text('description_name_of_building');
            $table->text('building_ownership');
            $table->enum('category', ['building', 'investment_property']);
            $table->string('building_number')->nullable();
            $table->string('institution_number')->nullable();

            // Location Information
            $table->string('nearest_town_shopping_centre');
            $table->string('street');
            $table->string('county');
            $table->string('lr_number')->nullable(); // Land Reference Number
            $table->decimal('size_of_land_hectares', 10, 4);

            // Ownership and Legal Status
            $table->enum('ownership_status', ['freehold', 'leasehold']);
            $table->string('source_of_funds');
            $table->enum('mode_of_acquisition', ['purchase', 'construction', 'donation', 'inheritance', 'gift', 'other']);
            $table->date('date_of_purchase_commissioning');

            // Building Characteristics
            $table->enum('type_of_building', ['permanent', 'temporary']);
            $table->text('designated_use');
            $table->integer('estimated_useful_life_years');
            $table->integer('number_of_floors');
            $table->decimal('plinth_area_sqm', 10, 2);

            // Financial Information
            $table->decimal('cost_of_construction_valuation', 15, 2);
            $table->decimal('annual_depreciation', 15, 2);
            $table->decimal('accumulated_depreciation_to_date', 15, 2);
            $table->decimal('net_book_value', 15, 2);
            $table->decimal('annual_rental_income', 15, 2)->nullable();

            // Additional Information
            $table->text('remarks')->nullable();

            // File uploads for documents
            $table->string('building_plans_path')->nullable();
            $table->string('certificate_of_occupancy_path')->nullable();
            $table->string('valuation_report_path')->nullable();

            $table->timestamps();

            // Indexes for better performance
            $table->index(['county', 'category']);
            $table->index('date_of_purchase_commissioning');
            $table->index('type_of_building');
            $table->index('ownership_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('building_registers');
    }
};
