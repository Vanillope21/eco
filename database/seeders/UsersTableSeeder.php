<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin
        User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'birthdate' => '1999-09-21',
            'username' => 'superadmin',
            'email' => 'superadmin@eco.com',
            'password' => Hash::make('password'),
            'role_id' => 1, // super-admin
            'email_verified_at' => now(),
        ]);

        // Admin
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'birthdate' => '1975-11-02',
            'username' => 'admin',
            'email' => 'admin@eco.com',
            'password' => Hash::make('password'),
            'role_id' => 2, // admin
            'email_verified_at' => now(),
        ]);

        // Barangay Official
        User::create([
            'first_name' => 'Barangay',
            'last_name' => 'Captain',
            'birthdate' => '1980-12-16',
            'username' => 'barangay_captain',
            'email' => 'captain@barangay.com',
            'password' => Hash::make('password'),
            'role_id' => 3, // barangay-official
            'email_verified_at' => now(),
        ]);

        // Resident
        User::create([
            'first_name' => 'John',
            'last_name' => 'Resident',
            'birthdate' => '2004-03-11',
            'username' => 'resident',
            'email' => 'resident@eco.com',
            'password' => Hash::make('password'),
            'role_id' => 4, // resident
            'email_verified_at' => now(),
        ]);

        // Additional test users
        User::create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'birthdate' => '2003-01-10',
            'username' => 'jane_doe',
            'email' => 'jane@eco.com',
            'password' => Hash::make('password'),
            'role_id' => 4, // resident
            'email_verified_at' => now(),
        ]);

        User::create([
            'first_name' => 'Mike',
            'last_name' => 'Johnson',
            'extension_name' => 'Jr.',
            'birthdate' => '2004-02-09',
            'username' => 'mike_johnson',
            'email' => 'mike@eco.com',
            'password' => Hash::make('password'),
            'role_id' => 4, // resident
            'email_verified_at' => now(),
        ]);

        // Example: Employee user (admin)
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'Employee',
            'username' => 'adminemp',
            'email' => 'admin@ormoc.gov.ph',
            'password' => Hash::make('password123'),
            'role_id' => 2, // Assume 2 = admin
            'employee_id' => 1, // Assume employee with ID 1 exists
            'barangay_id' => null,
            'phone_number' => '09170000001',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Example: Resident user
        DB::table('users')->insert([
            'first_name' => 'Juan',
            'last_name' => 'Resident',
            'username' => 'juanres',
            'email' => 'juan.resident@email.com',
            'password' => Hash::make('password123'),
            'role_id' => 1, // Assume 1 = resident
            'employee_id' => null,
            'barangay_id' => 1, // Assume barangay with ID 1 exists
            'phone_number' => '09170000002',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
