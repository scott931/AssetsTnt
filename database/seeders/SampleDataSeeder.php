<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\AssetCategory;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Asset;
use Illuminate\Support\Facades\Hash;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample departments
        $departments = [
            ['name' => 'Information Technology', 'code' => 'IT', 'description' => 'IT Department'],
            ['name' => 'Human Resources', 'code' => 'HR', 'description' => 'Human Resources Department'],
            ['name' => 'Finance', 'code' => 'FIN', 'description' => 'Finance Department'],
            ['name' => 'Marketing', 'code' => 'MKT', 'description' => 'Marketing Department'],
            ['name' => 'Operations', 'code' => 'OPS', 'description' => 'Operations Department'],
        ];

        foreach ($departments as $dept) {
            Department::create($dept);
        }

        // Create sample asset categories
        $categories = [
            ['name' => 'IT Equipment', 'code' => 'IT-EQ', 'description' => 'Information Technology Equipment', 'expected_lifespan_years' => 5, 'depreciation_rate' => 20.00],
            ['name' => 'Furniture', 'code' => 'FURN', 'description' => 'Office Furniture', 'expected_lifespan_years' => 10, 'depreciation_rate' => 10.00],
            ['name' => 'Vehicles', 'code' => 'VEH', 'description' => 'Company Vehicles', 'expected_lifespan_years' => 8, 'depreciation_rate' => 12.50],
            ['name' => 'Office Equipment', 'code' => 'OFF-EQ', 'description' => 'General Office Equipment', 'expected_lifespan_years' => 7, 'depreciation_rate' => 14.29],
        ];

        foreach ($categories as $cat) {
            AssetCategory::create($cat);
        }

        // Create sub-categories for IT Equipment
        $itCategory = AssetCategory::where('code', 'IT-EQ')->first();
        $itSubCategories = [
            ['name' => 'Computers', 'code' => 'IT-COMP', 'description' => 'Desktop and Laptop Computers', 'parent_id' => $itCategory->id, 'expected_lifespan_years' => 4, 'depreciation_rate' => 25.00],
            ['name' => 'Networking', 'code' => 'IT-NET', 'description' => 'Network Equipment', 'parent_id' => $itCategory->id, 'expected_lifespan_years' => 6, 'depreciation_rate' => 16.67],
            ['name' => 'Printers', 'code' => 'IT-PRT', 'description' => 'Printers and Scanners', 'parent_id' => $itCategory->id, 'expected_lifespan_years' => 5, 'depreciation_rate' => 20.00],
        ];

        foreach ($itSubCategories as $subCat) {
            AssetCategory::create($subCat);
        }

        // Create sample suppliers
        $suppliers = [
            ['name' => 'Tech Solutions Inc.', 'code' => 'TSI', 'contact_person' => 'John Smith', 'email' => 'john@techsolutions.com', 'phone' => '+1-555-0101', 'address' => '123 Tech Street, Tech City, TC 12345'],
            ['name' => 'Office Supplies Co.', 'code' => 'OSC', 'contact_person' => 'Jane Doe', 'email' => 'jane@officesupplies.com', 'phone' => '+1-555-0102', 'address' => '456 Office Ave, Office City, OC 67890'],
            ['name' => 'Furniture World', 'code' => 'FW', 'contact_person' => 'Bob Johnson', 'email' => 'bob@furnitureworld.com', 'phone' => '+1-555-0103', 'address' => '789 Furniture Blvd, Furniture City, FC 11111'],
            ['name' => 'Auto Dealers Ltd.', 'code' => 'ADL', 'contact_person' => 'Alice Brown', 'email' => 'alice@autodealers.com', 'phone' => '+1-555-0104', 'address' => '321 Auto Drive, Auto City, AC 22222'],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }

        // Create sample users
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@company.com',
                'password' => Hash::make('password'),
                'department_id' => Department::where('code', 'IT')->first()->id,
                'status' => 'active',
            ],
            [
                'name' => 'Asset Manager',
                'email' => 'assetmanager@company.com',
                'password' => Hash::make('password'),
                'department_id' => Department::where('code', 'IT')->first()->id,
                'status' => 'active',
            ],
            [
                'name' => 'IT Support',
                'email' => 'itsupport@company.com',
                'password' => Hash::make('password'),
                'department_id' => Department::where('code', 'IT')->first()->id,
                'status' => 'active',
            ],
            [
                'name' => 'HR Manager',
                'email' => 'hrmanager@company.com',
                'password' => Hash::make('password'),
                'department_id' => Department::where('code', 'HR')->first()->id,
                'status' => 'active',
            ],
            [
                'name' => 'Finance Manager',
                'email' => 'financemanager@company.com',
                'password' => Hash::make('password'),
                'department_id' => Department::where('code', 'FIN')->first()->id,
                'status' => 'active',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        // Assign roles to users
        $admin = User::where('email', 'admin@company.com')->first();
        $admin->assignRole('Super Admin');

        $assetManager = User::where('email', 'assetmanager@company.com')->first();
        $assetManager->assignRole('Asset Manager');

        $itSupport = User::where('email', 'itsupport@company.com')->first();
        $itSupport->assignRole('IT Support');

        $hrManager = User::where('email', 'hrmanager@company.com')->first();
        $hrManager->assignRole('Department Manager');

        $financeManager = User::where('email', 'financemanager@company.com')->first();
        $financeManager->assignRole('Department Manager');

        // Create sample assets
        $assets = [
            [
                'asset_tag' => 'IT-001',
                'name' => 'Dell Latitude Laptop',
                'description' => 'Dell Latitude 5520 Laptop - Intel i7, 16GB RAM, 512GB SSD',
                'category_id' => AssetCategory::where('code', 'IT-COMP')->first()->id,
                'supplier_id' => Supplier::where('code', 'TSI')->first()->id,
                'department_id' => Department::where('code', 'IT')->first()->id,
                'assigned_to' => $itSupport->id,
                'purchase_date' => '2023-01-15',
                'purchase_cost' => 1200.00,
                'purchase_order_number' => 'PO-2023-001',
                'model' => 'Latitude 5520',
                'serial_number' => 'DL5520-12345',
                'manufacturer' => 'Dell',
                'location' => 'IT Office',
                'condition' => 'good',
                'current_value' => 960.00,
                'depreciation_rate' => 25.00,
                'depreciation_method' => 'straight_line',
                'depreciation_start_date' => '2023-01-15',
                'status' => 'active',
            ],
            [
                'asset_tag' => 'IT-002',
                'name' => 'HP LaserJet Printer',
                'description' => 'HP LaserJet Pro M404n Printer - Monochrome Laser',
                'category_id' => AssetCategory::where('code', 'IT-PRT')->first()->id,
                'supplier_id' => Supplier::where('code', 'TSI')->first()->id,
                'department_id' => Department::where('code', 'IT')->first()->id,
                'purchase_date' => '2023-02-20',
                'purchase_cost' => 350.00,
                'purchase_order_number' => 'PO-2023-002',
                'model' => 'LaserJet Pro M404n',
                'serial_number' => 'HP404N-67890',
                'manufacturer' => 'HP',
                'location' => 'IT Office',
                'condition' => 'good',
                'current_value' => 280.00,
                'depreciation_rate' => 20.00,
                'depreciation_method' => 'straight_line',
                'depreciation_start_date' => '2023-02-20',
                'status' => 'active',
            ],
            [
                'asset_tag' => 'FURN-001',
                'name' => 'Office Desk',
                'description' => 'Standard Office Desk - 60" x 30"',
                'category_id' => AssetCategory::where('code', 'FURN')->first()->id,
                'supplier_id' => Supplier::where('code', 'FW')->first()->id,
                'department_id' => Department::where('code', 'HR')->first()->id,
                'assigned_to' => $hrManager->id,
                'purchase_date' => '2022-06-10',
                'purchase_cost' => 450.00,
                'purchase_order_number' => 'PO-2022-015',
                'model' => 'Standard Desk',
                'serial_number' => 'DESK-2022-001',
                'manufacturer' => 'Office Furniture Co.',
                'location' => 'HR Office',
                'condition' => 'good',
                'current_value' => 405.00,
                'depreciation_rate' => 10.00,
                'depreciation_method' => 'straight_line',
                'depreciation_start_date' => '2022-06-10',
                'status' => 'active',
            ],
            [
                'asset_tag' => 'VEH-001',
                'name' => 'Company Van',
                'description' => 'Ford Transit Van - White, 2022 Model',
                'category_id' => AssetCategory::where('code', 'VEH')->first()->id,
                'supplier_id' => Supplier::where('code', 'ADL')->first()->id,
                'department_id' => Department::where('code', 'OPS')->first()->id,
                'purchase_date' => '2022-03-15',
                'purchase_cost' => 35000.00,
                'purchase_order_number' => 'PO-2022-008',
                'model' => 'Transit',
                'serial_number' => 'FORD-2022-001',
                'manufacturer' => 'Ford',
                'location' => 'Company Garage',
                'condition' => 'good',
                'current_value' => 30625.00,
                'depreciation_rate' => 12.50,
                'depreciation_method' => 'straight_line',
                'depreciation_start_date' => '2022-03-15',
                'status' => 'active',
            ],
        ];

        foreach ($assets as $asset) {
            Asset::create($asset);
        }

        $this->command->info('Sample data created successfully!');
        $this->command->info('Sample users created with email: user@company.com and password: password');
        $this->command->info('Sample assets created with tags: IT-001, IT-002, FURN-001, VEH-001');
    }
}
