<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions for Assets
        $assetPermissions = [
            'view assets',
            'create assets',
            'edit assets',
            'delete assets',
            'assign assets',
            'return assets',
            'transfer assets',
            'retire assets',
            'export assets',
        ];

        // Create permissions for Categories
        $categoryPermissions = [
            'view categories',
            'create categories',
            'edit categories',
            'delete categories',
        ];

        // Create permissions for Departments
        $departmentPermissions = [
            'view departments',
            'create departments',
            'edit departments',
            'delete departments',
        ];

        // Create permissions for Suppliers
        $supplierPermissions = [
            'view suppliers',
            'create suppliers',
            'edit suppliers',
            'delete suppliers',
        ];

        // Create permissions for Maintenance
        $maintenancePermissions = [
            'view maintenance',
            'create maintenance',
            'edit maintenance',
            'delete maintenance',
            'schedule maintenance',
        ];

        // Create permissions for Transfers
        $transferPermissions = [
            'view transfers',
            'create transfers',
            'approve transfers',
            'reject transfers',
            'complete transfers',
        ];

        // Create permissions for Reports
        $reportPermissions = [
            'view reports',
            'export reports',
            'view analytics',
        ];

        // Create permissions for Users
        $userPermissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',
            'assign roles',
        ];

        // Create permissions for System
        $systemPermissions = [
            'manage settings',
            'view audit logs',
            'manage roles',
            'manage permissions',
        ];

        // Combine all permissions
        $allPermissions = array_merge(
            $assetPermissions,
            $categoryPermissions,
            $departmentPermissions,
            $supplierPermissions,
            $maintenancePermissions,
            $transferPermissions,
            $reportPermissions,
            $userPermissions,
            $systemPermissions
        );

        // Create permissions
        foreach ($allPermissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions

        // Super Admin - Has all permissions
        $superAdmin = Role::create(['name' => 'Super Admin']);
        $superAdmin->givePermissionTo($allPermissions);

        // Asset Manager - Can manage assets, categories, suppliers, maintenance, transfers
        $assetManager = Role::create(['name' => 'Asset Manager']);
        $assetManager->givePermissionTo(array_merge(
            $assetPermissions,
            $categoryPermissions,
            $supplierPermissions,
            $maintenancePermissions,
            $transferPermissions,
            ['view departments', 'view reports', 'export reports', 'view analytics']
        ));

        // Department Manager - Can manage assets in their department
        $departmentManager = Role::create(['name' => 'Department Manager']);
        $departmentManager->givePermissionTo([
            'view assets',
            'create assets',
            'edit assets',
            'assign assets',
            'return assets',
            'transfer assets',
            'view categories',
            'view suppliers',
            'view maintenance',
            'create maintenance',
            'edit maintenance',
            'schedule maintenance',
            'view transfers',
            'create transfers',
            'approve transfers',
            'complete transfers',
            'view reports',
            'export reports',
        ]);

        // Auditor/Viewer - Can only view and export
        $auditor = Role::create(['name' => 'Auditor']);
        $auditor->givePermissionTo([
            'view assets',
            'view categories',
            'view departments',
            'view suppliers',
            'view maintenance',
            'view transfers',
            'view reports',
            'export reports',
            'view analytics',
            'view audit logs',
        ]);

        // Regular User - Basic asset operations
        $regularUser = Role::create(['name' => 'Regular User']);
        $regularUser->givePermissionTo([
            'view assets',
            'view categories',
            'view departments',
            'view suppliers',
            'view maintenance',
            'view transfers',
        ]);

        // IT Support - Can manage IT assets and maintenance
        $itSupport = Role::create(['name' => 'IT Support']);
        $itSupport->givePermissionTo([
            'view assets',
            'edit assets',
            'assign assets',
            'return assets',
            'view categories',
            'view suppliers',
            'view maintenance',
            'create maintenance',
            'edit maintenance',
            'schedule maintenance',
            'view transfers',
            'create transfers',
            'complete transfers',
        ]);

        // Maintenance Technician - Can manage maintenance
        $maintenanceTech = Role::create(['name' => 'Maintenance Technician']);
        $maintenanceTech->givePermissionTo([
            'view assets',
            'view categories',
            'view suppliers',
            'view maintenance',
            'create maintenance',
            'edit maintenance',
            'schedule maintenance',
        ]);

        $this->command->info('Roles and permissions created successfully!');
        $this->command->info('Available roles: Super Admin, Asset Manager, Department Manager, Auditor, Regular User, IT Support, Maintenance Technician');
    }
}
