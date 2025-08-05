<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LandRegister;
use App\Models\BuildingRegister;
use Illuminate\Support\Str;

class TestRegisters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registers:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test land and building register functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== Testing Land Register ===');

        // Test creating a sample land register entry
        try {
            $landRegister = LandRegister::create([
                'description_of_land' => 'Test Land Entry - ' . now()->format('Y-m-d H:i:s'),
                'mode_of_acquisition' => 'purchase',
                'category' => 'land',
                'county' => 'Test County',
                'nearest_town_location' => 'Test Town',
                'proprietorship_details' => 'Test ownership details',
                'size_hectares' => 10.5,
                'ownership_status' => 'freehold',
                'acquisition_date' => now(),
                'disputed_status' => 'undisputed',
                'planning_status' => 'planned',
                'purpose_use_of_land' => 'Residential',
                'survey_status' => 'surveyed',
            ]);

            $this->info("✅ Created test land register entry with ID: {$landRegister->id}");
        } catch (\Exception $e) {
            $this->error("❌ Failed to create land register entry: " . $e->getMessage());
        }

        $this->info('');
        $this->info('=== Testing Building Register ===');

        // Test creating a sample building register entry
        try {
            $buildingRegister = BuildingRegister::create([
                'description_name_of_building' => 'Test Building Entry - ' . now()->format('Y-m-d H:i:s'),
                'building_ownership' => 'Test ownership',
                'category' => 'building',
                'nearest_town_shopping_centre' => 'Test Town',
                'street' => 'Test Street',
                'county' => 'Test County',
                'size_of_land_hectares' => 5.0,
                'ownership_status' => 'freehold',
                'source_of_funds' => 'Government',
                'mode_of_acquisition' => 'construction',
                'date_of_purchase_commissioning' => now(),
                'type_of_building' => 'permanent',
                'designated_use' => 'Office',
                'estimated_useful_life_years' => 50,
                'number_of_floors' => 3,
                'plinth_area_sqm' => 500.0,
                'cost_of_construction_valuation' => 1000000.0,
                'annual_depreciation' => 20000.0,
                'accumulated_depreciation_to_date' => 100000.0,
                'net_book_value' => 900000.0,
            ]);

            $this->info("✅ Created test building register entry with ID: {$buildingRegister->id}");
        } catch (\Exception $e) {
            $this->error("❌ Failed to create building register entry: " . $e->getMessage());
        }

        $this->info('');
        $this->info('=== Final Counts ===');
        $this->info("Land Register entries: " . LandRegister::count());
        $this->info("Building Register entries: " . BuildingRegister::count());

        return 0;
    }
}