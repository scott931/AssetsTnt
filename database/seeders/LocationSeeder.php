<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'name' => 'Headquarters',
                'code' => 'HQ',
                'address' => '123 Main Street',
                'city' => 'New York',
                'state' => 'NY',
                'country' => 'USA',
                'postal_code' => '10001',
                'phone' => '+1-555-0123',
                'email' => 'hq@company.com',
                'description' => 'Main corporate headquarters and administrative center',
                'is_active' => true,
            ],
            [
                'name' => 'West Coast Branch',
                'code' => 'WC',
                'address' => '456 Pacific Avenue',
                'city' => 'San Francisco',
                'state' => 'CA',
                'country' => 'USA',
                'postal_code' => '94102',
                'phone' => '+1-555-0456',
                'email' => 'westcoast@company.com',
                'description' => 'West Coast regional office and distribution center',
                'is_active' => true,
            ],
            [
                'name' => 'Midwest Regional Office',
                'code' => 'MW',
                'address' => '789 Lake Street',
                'city' => 'Chicago',
                'state' => 'IL',
                'country' => 'USA',
                'postal_code' => '60601',
                'phone' => '+1-555-0789',
                'email' => 'midwest@company.com',
                'description' => 'Midwest regional operations and customer service center',
                'is_active' => true,
            ],
            [
                'name' => 'Southern Branch',
                'code' => 'SB',
                'address' => '321 Peachtree Street',
                'city' => 'Atlanta',
                'state' => 'GA',
                'country' => 'USA',
                'postal_code' => '30301',
                'phone' => '+1-555-0321',
                'email' => 'southern@company.com',
                'description' => 'Southern regional office and logistics hub',
                'is_active' => true,
            ],
            [
                'name' => 'European Office',
                'code' => 'EU',
                'address' => '10 Oxford Street',
                'city' => 'London',
                'state' => '',
                'country' => 'United Kingdom',
                'postal_code' => 'W1D 1BS',
                'phone' => '+44-20-7123-4567',
                'email' => 'europe@company.com',
                'description' => 'European headquarters and international operations center',
                'is_active' => true,
            ],
            [
                'name' => 'Asia Pacific Office',
                'code' => 'AP',
                'address' => '25 Marina Bay',
                'city' => 'Singapore',
                'state' => '',
                'country' => 'Singapore',
                'postal_code' => '018956',
                'phone' => '+65-6123-4567',
                'email' => 'asia@company.com',
                'description' => 'Asia Pacific regional headquarters',
                'is_active' => true,
            ],
            [
                'name' => 'Warehouse Facility',
                'code' => 'WH',
                'address' => '500 Industrial Boulevard',
                'city' => 'Dallas',
                'state' => 'TX',
                'country' => 'USA',
                'postal_code' => '75201',
                'phone' => '+1-555-0500',
                'email' => 'warehouse@company.com',
                'description' => 'Central warehouse and distribution facility',
                'is_active' => true,
            ],
            [
                'name' => 'Research & Development Center',
                'code' => 'R&D',
                'address' => '100 Innovation Drive',
                'city' => 'Boston',
                'state' => 'MA',
                'country' => 'USA',
                'postal_code' => '02101',
                'phone' => '+1-555-0100',
                'email' => 'rd@company.com',
                'description' => 'Research and development facility',
                'is_active' => true,
            ],
        ];

        foreach ($locations as $locationData) {
            Location::create($locationData);
        }
    }
}
