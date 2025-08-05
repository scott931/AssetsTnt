<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get regions first
        $nairobiRegion = Region::where('code', 'NAIROBI')->first();
        $mombasaRegion = Region::where('code', 'MOMBASA')->first();
        $kisumuRegion = Region::where('code', 'KISUMU')->first();
        $nakuruRegion = Region::where('code', 'NAKURU')->first();
        $eldoretRegion = Region::where('code', 'ELDORET')->first();

        $locations = [
            // Nairobi Region Locations
            [
                'name' => 'Nairobi Main Office',
                'code' => 'NAI-MAIN',
                'address' => '123 Kimathi Street',
                'city' => 'Nairobi',
                'state' => 'Nairobi',
                'country' => 'Kenya',
                'postal_code' => '00100',
                'phone' => '+254-20-1234567',
                'email' => 'main.nairobi@company.com',
                'description' => 'Main headquarters office in Nairobi CBD',
                'is_active' => true,
                'region_id' => $nairobiRegion ? $nairobiRegion->id : null
            ],
            [
                'name' => 'Westlands Branch',
                'code' => 'NAI-WEST',
                'address' => '456 Westlands Road',
                'city' => 'Nairobi',
                'state' => 'Nairobi',
                'country' => 'Kenya',
                'postal_code' => '00606',
                'phone' => '+254-20-1234568',
                'email' => 'westlands@company.com',
                'description' => 'Westlands branch office',
                'is_active' => true,
                'region_id' => $nairobiRegion ? $nairobiRegion->id : null
            ],
            [
                'name' => 'Eastleigh Branch',
                'code' => 'NAI-EAST',
                'address' => '789 Eastleigh Road',
                'city' => 'Nairobi',
                'state' => 'Nairobi',
                'country' => 'Kenya',
                'postal_code' => '00610',
                'phone' => '+254-20-1234569',
                'email' => 'eastleigh@company.com',
                'description' => 'Eastleigh branch office',
                'is_active' => true,
                'region_id' => $nairobiRegion ? $nairobiRegion->id : null
            ],
            [
                'name' => 'Karen Office',
                'code' => 'NAI-KAREN',
                'address' => '321 Karen Road',
                'city' => 'Nairobi',
                'state' => 'Nairobi',
                'country' => 'Kenya',
                'postal_code' => '00502',
                'phone' => '+254-20-1234570',
                'email' => 'karen@company.com',
                'description' => 'Karen branch office',
                'is_active' => true,
                'region_id' => $nairobiRegion ? $nairobiRegion->id : null
            ],

            // Mombasa Region Locations
            [
                'name' => 'Mombasa Port Office',
                'code' => 'MOM-PORT',
                'address' => '123 Port Road',
                'city' => 'Mombasa',
                'state' => 'Mombasa',
                'country' => 'Kenya',
                'postal_code' => '80100',
                'phone' => '+254-41-1234567',
                'email' => 'port.mombasa@company.com',
                'description' => 'Main office near Mombasa port',
                'is_active' => true,
                'region_id' => $mombasaRegion ? $mombasaRegion->id : null
            ],
            [
                'name' => 'Mombasa City Branch',
                'code' => 'MOM-CITY',
                'address' => '456 Moi Avenue',
                'city' => 'Mombasa',
                'state' => 'Mombasa',
                'country' => 'Kenya',
                'postal_code' => '80100',
                'phone' => '+254-41-1234568',
                'email' => 'city.mombasa@company.com',
                'description' => 'City center branch office',
                'is_active' => true,
                'region_id' => $mombasaRegion ? $mombasaRegion->id : null
            ],
            [
                'name' => 'Nyali Branch',
                'code' => 'MOM-NYALI',
                'address' => '789 Nyali Road',
                'city' => 'Mombasa',
                'state' => 'Mombasa',
                'country' => 'Kenya',
                'postal_code' => '80100',
                'phone' => '+254-41-1234569',
                'email' => 'nyali@company.com',
                'description' => 'Nyali branch office',
                'is_active' => true,
                'region_id' => $mombasaRegion ? $mombasaRegion->id : null
            ],

            // Kisumu Region Locations
            [
                'name' => 'Kisumu Main Office',
                'code' => 'KIS-MAIN',
                'address' => '123 Oginga Odinga Street',
                'city' => 'Kisumu',
                'state' => 'Kisumu',
                'country' => 'Kenya',
                'postal_code' => '40100',
                'phone' => '+254-57-1234567',
                'email' => 'main.kisumu@company.com',
                'description' => 'Main office in Kisumu city center',
                'is_active' => true,
                'region_id' => $kisumuRegion ? $kisumuRegion->id : null
            ],
            [
                'name' => 'Kisumu Airport Branch',
                'code' => 'KIS-AIR',
                'address' => '456 Airport Road',
                'city' => 'Kisumu',
                'state' => 'Kisumu',
                'country' => 'Kenya',
                'postal_code' => '40100',
                'phone' => '+254-57-1234568',
                'email' => 'airport.kisumu@company.com',
                'description' => 'Branch near Kisumu airport',
                'is_active' => true,
                'region_id' => $kisumuRegion ? $kisumuRegion->id : null
            ],

            // Nakuru Region Locations
            [
                'name' => 'Nakuru Main Office',
                'code' => 'NAK-MAIN',
                'address' => '123 Kenyatta Avenue',
                'city' => 'Nakuru',
                'state' => 'Nakuru',
                'country' => 'Kenya',
                'postal_code' => '20100',
                'phone' => '+254-51-1234567',
                'email' => 'main.nakuru@company.com',
                'description' => 'Main office in Nakuru city center',
                'is_active' => true,
                'region_id' => $nakuruRegion ? $nakuruRegion->id : null
            ],
            [
                'name' => 'Nakuru Industrial Branch',
                'code' => 'NAK-IND',
                'address' => '456 Industrial Area',
                'city' => 'Nakuru',
                'state' => 'Nakuru',
                'country' => 'Kenya',
                'postal_code' => '20100',
                'phone' => '+254-51-1234568',
                'email' => 'industrial.nakuru@company.com',
                'description' => 'Branch in Nakuru industrial area',
                'is_active' => true,
                'region_id' => $nakuruRegion ? $nakuruRegion->id : null
            ],

            // Eldoret Region Locations
            [
                'name' => 'Eldoret Main Office',
                'code' => 'ELD-MAIN',
                'address' => '123 Uganda Road',
                'city' => 'Eldoret',
                'state' => 'Uasin Gishu',
                'country' => 'Kenya',
                'postal_code' => '30100',
                'phone' => '+254-53-1234567',
                'email' => 'main.eldoret@company.com',
                'description' => 'Main office in Eldoret city center',
                'is_active' => true,
                'region_id' => $eldoretRegion ? $eldoretRegion->id : null
            ],
            [
                'name' => 'Eldoret Airport Branch',
                'code' => 'ELD-AIR',
                'address' => '456 Airport Road',
                'city' => 'Eldoret',
                'state' => 'Uasin Gishu',
                'country' => 'Kenya',
                'postal_code' => '30100',
                'phone' => '+254-53-1234568',
                'email' => 'airport.eldoret@company.com',
                'description' => 'Branch near Eldoret airport',
                'is_active' => true,
                'region_id' => $eldoretRegion ? $eldoretRegion->id : null
            ]
        ];

        foreach ($locations as $locationData) {
            Location::create($locationData);
        }

        $this->command->info('Sample locations data created successfully!');
        $this->command->info('Created ' . count($locations) . ' locations.');
    }
}
