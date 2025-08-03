<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Information Technology',
                'code' => 'IT',
                'description' => 'IT Department responsible for technology infrastructure',
                'budget' => 50000.00,
                'is_active' => true,
            ],
            [
                'name' => 'Human Resources',
                'code' => 'HR',
                'description' => 'Human Resources Department',
                'budget' => 30000.00,
                'is_active' => true,
            ],
            [
                'name' => 'Finance',
                'code' => 'FIN',
                'description' => 'Finance and Accounting Department',
                'budget' => 40000.00,
                'is_active' => true,
            ],
            [
                'name' => 'Marketing',
                'code' => 'MKT',
                'description' => 'Marketing and Communications Department',
                'budget' => 35000.00,
                'is_active' => true,
            ],
            [
                'name' => 'Operations',
                'code' => 'OPS',
                'description' => 'Operations Department',
                'budget' => 45000.00,
                'is_active' => true,
            ],
            [
                'name' => 'Sales',
                'code' => 'SALES',
                'description' => 'Sales Department',
                'budget' => 60000.00,
                'is_active' => true,
            ],
            [
                'name' => 'Customer Support',
                'code' => 'CS',
                'description' => 'Customer Support Department',
                'budget' => 25000.00,
                'is_active' => true,
            ],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }

        $this->command->info('Sample departments created successfully!');
    }
}
