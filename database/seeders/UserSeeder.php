<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Department;
use App\Models\Location;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get roles
        $superAdminRole = Role::where('name', 'Super Admin')->first();
        $assetManagerRole = Role::where('name', 'Asset Manager')->first();
        $departmentManagerRole = Role::where('name', 'Department Manager')->first();
        $auditorRole = Role::where('name', 'Auditor')->first();
        $regularUserRole = Role::where('name', 'Regular User')->first();
        $itSupportRole = Role::where('name', 'IT Support')->first();

        // Get departments and locations (handle empty collections)
        $departments = Department::all();
        $locations = Location::all();

        // Create Super Admin
        $superAdmin = User::create([
            'name' => 'System Administrator',
            'email' => 'admin@company.com',
            'password' => Hash::make('password'),
            'status' => 'active',
            'department_id' => $departments->count() > 0 ? $departments->first()->id : null,
            'location_id' => $locations->count() > 0 ? $locations->first()->id : null,
        ]);
        if ($superAdminRole) {
            $superAdmin->assignRole($superAdminRole);
        }

        // Create Asset Manager
        $assetManager = User::create([
            'name' => 'John Asset Manager',
            'email' => 'asset.manager@company.com',
            'password' => Hash::make('password'),
            'status' => 'active',
            'department_id' => $departments->count() > 0 ? $departments->first()->id : null,
            'location_id' => $locations->count() > 0 ? $locations->first()->id : null,
        ]);
        if ($assetManagerRole) {
            $assetManager->assignRole($assetManagerRole);
        }

        // Create Department Managers (only if departments exist)
        if ($departments->count() > 0) {
            foreach ($departments->take(3) as $index => $department) {
                $manager = User::create([
                    'name' => "Manager {$department->name}",
                    'email' => "manager.{$index}@company.com",
                    'password' => Hash::make('password'),
                    'status' => 'active',
                    'department_id' => $department->id,
                    'location_id' => $locations->count() > 0 ? $locations->random()->id : null,
                ]);
                if ($departmentManagerRole) {
                    $manager->assignRole($departmentManagerRole);
                }
            }
        }

        // Create IT Support Users
        for ($i = 1; $i <= 2; $i++) {
            $itUser = User::create([
                'name' => "IT Support {$i}",
                'email' => "it.support{$i}@company.com",
                'password' => Hash::make('password'),
                'status' => 'active',
                'department_id' => $departments->count() > 0 ? $departments->random()->id : null,
                'location_id' => $locations->count() > 0 ? $locations->random()->id : null,
            ]);
            if ($itSupportRole) {
                $itUser->assignRole($itSupportRole);
            }
        }

        // Create Auditor
        $auditor = User::create([
            'name' => 'Audit Specialist',
            'email' => 'auditor@company.com',
            'password' => Hash::make('password'),
            'status' => 'active',
            'department_id' => $departments->count() > 0 ? $departments->random()->id : null,
            'location_id' => $locations->count() > 0 ? $locations->random()->id : null,
        ]);
        if ($auditorRole) {
            $auditor->assignRole($auditorRole);
        }

        // Create Regular Users
        for ($i = 1; $i <= 5; $i++) {
            $regularUser = User::create([
                'name' => "Employee {$i}",
                'email' => "employee{$i}@company.com",
                'password' => Hash::make('password'),
                'status' => 'active',
                'department_id' => $departments->count() > 0 ? $departments->random()->id : null,
                'location_id' => $locations->count() > 0 ? $locations->random()->id : null,
            ]);
            if ($regularUserRole) {
                $regularUser->assignRole($regularUserRole);
            }
        }

        // Create some inactive users
        $inactiveUser = User::create([
            'name' => 'Inactive User',
            'email' => 'inactive@company.com',
            'password' => Hash::make('password'),
            'status' => 'inactive',
            'department_id' => $departments->count() > 0 ? $departments->random()->id : null,
            'location_id' => $locations->count() > 0 ? $locations->random()->id : null,
        ]);
        if ($regularUserRole) {
            $inactiveUser->assignRole($regularUserRole);
        }

        // Create a suspended user
        $suspendedUser = User::create([
            'name' => 'Suspended User',
            'email' => 'suspended@company.com',
            'password' => Hash::make('password'),
            'status' => 'suspended',
            'department_id' => $departments->count() > 0 ? $departments->random()->id : null,
            'location_id' => $locations->count() > 0 ? $locations->random()->id : null,
        ]);
        if ($regularUserRole) {
            $suspendedUser->assignRole($regularUserRole);
        }

        // Create a pending user
        $pendingUser = User::create([
            'name' => 'Pending User',
            'email' => 'pending@company.com',
            'password' => Hash::make('password'),
            'status' => 'pending',
            'department_id' => $departments->count() > 0 ? $departments->random()->id : null,
            'location_id' => $locations->count() > 0 ? $locations->random()->id : null,
        ]);
        if ($regularUserRole) {
            $pendingUser->assignRole($regularUserRole);
        }

        $this->command->info('Sample users created successfully!');
        $this->command->info('Default password for all users: password');
    }
}
