<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LandRegister;
use App\Models\BuildingRegister;
use Illuminate\Support\Str;

class CheckRegisters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registers:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check land and building register data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== Land Register Data ===');
        $landCount = LandRegister::count();
        $this->info("Total Land Register entries: {$landCount}");

        if ($landCount > 0) {
            $latestLand = LandRegister::latest()->first();
            $this->info("Latest Land Register entry:");
            $this->info("- Description: " . Str::limit($latestLand->description_of_land, 50));
            $this->info("- County: " . $latestLand->county);
            $this->info("- Created: " . $latestLand->created_at->format('Y-m-d H:i:s'));
        }

        $this->info('');
        $this->info('=== Building Register Data ===');
        $buildingCount = BuildingRegister::count();
        $this->info("Total Building Register entries: {$buildingCount}");

        if ($buildingCount > 0) {
            $latestBuilding = BuildingRegister::latest()->first();
            $this->info("Latest Building Register entry:");
            $this->info("- Description: " . Str::limit($latestBuilding->description_name_of_building, 50));
            $this->info("- County: " . $latestBuilding->county);
            $this->info("- Created: " . $latestBuilding->created_at->format('Y-m-d H:i:s'));
        }

        return 0;
    }
}