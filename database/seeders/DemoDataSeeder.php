<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $it = Department::create(['name' => 'IT']);
        $hr = Department::create(['name' => 'Human Resource']);

        Employee::create([
            'department_id' => $it->id,
            'name' => 'Nik Asyraf',
            'position' => 'Software Engineer',
            'basic_salary' => 4000,
            'allowance' => 600,
            'overtime_hours' => 10,
            'hourly_rate' => 25,
        ]);

        Employee::create([
            'department_id' => $hr->id,
            'name' => 'Farahanem',
            'position' => 'HR Executive',
            'basic_salary' => 5000,
            'allowance' => 400,
            'overtime_hours' => 5,
            'hourly_rate' => 20,
        ]);
    }
}
