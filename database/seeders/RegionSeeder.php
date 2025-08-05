<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            [
                'name' => 'Nairobi',
                'code' => 'NAIROBI',
                'description' => 'Nairobi Region - Capital City',
                'headquarters' => 'Nairobi City',
                'contact_person' => 'John Kamau',
                'contact_email' => 'nairobi@company.com',
                'contact_phone' => '+254-20-1234567',
                'status' => 'active'
            ],
            [
                'name' => 'Mombasa',
                'code' => 'MOMBASA',
                'description' => 'Mombasa Region - Coastal Region',
                'headquarters' => 'Mombasa City',
                'contact_person' => 'Sarah Hassan',
                'contact_email' => 'mombasa@company.com',
                'contact_phone' => '+254-41-1234567',
                'status' => 'active'
            ],
            [
                'name' => 'Kisumu',
                'code' => 'KISUMU',
                'description' => 'Kisumu Region - Lake Region',
                'headquarters' => 'Kisumu City',
                'contact_person' => 'Peter Otieno',
                'contact_email' => 'kisumu@company.com',
                'contact_phone' => '+254-57-1234567',
                'status' => 'active'
            ],
            [
                'name' => 'Nakuru',
                'code' => 'NAKURU',
                'description' => 'Nakuru Region - Rift Valley',
                'headquarters' => 'Nakuru City',
                'contact_person' => 'Mary Wanjiku',
                'contact_email' => 'nakuru@company.com',
                'contact_phone' => '+254-51-1234567',
                'status' => 'active'
            ],
            [
                'name' => 'Eldoret',
                'code' => 'ELDORET',
                'description' => 'Eldoret Region - North Rift',
                'headquarters' => 'Eldoret City',
                'contact_person' => 'David Kiprop',
                'contact_email' => 'eldoret@company.com',
                'contact_phone' => '+254-53-1234567',
                'status' => 'active'
            ]
        ];

        foreach ($regions as $regionData) {
            Region::create($regionData);
        }

        $this->command->info('Sample regions data created successfully!');
        $this->command->info('Created ' . count($regions) . ' regions.');
    }
}