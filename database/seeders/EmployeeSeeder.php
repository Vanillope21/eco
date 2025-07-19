<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        
        DB::table('employees')->insert([
            'first_name' => 'Admin',
            'last_name' => 'Employee',
            'extension_name' => null,
            'birthdate' => '1990-01-01',
            'contact_number' => '09170000001',
            'position' => 'Admin',
            'hire_date' => '2020-01-01',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
} 