<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@eco.com',
            'password' => Hash::make('password'),
            'role_id' => 1, // super-admin
            'email_verified_at' => now(),
        ]);

        // Admin
        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@eco.com',
            'password' => Hash::make('password'),
            'role_id' => 2, // admin
            'email_verified_at' => now(),
        ]);

        // Barangay Official
        User::create([
            'name' => 'Barangay Captain',
            'username' => 'barangay_captain',
            'email' => 'captain@barangay.com',
            'password' => Hash::make('password'),
            'role_id' => 3, // barangay-official
            'email_verified_at' => now(),
        ]);

        // Resident
        User::create([
            'name' => 'John Resident',
            'username' => 'resident',
            'email' => 'resident@eco.com',
            'password' => Hash::make('password'),
            'role_id' => 4, // resident
            'email_verified_at' => now(),
        ]);

        // Additional test users
        User::create([
            'name' => 'Jane Doe',
            'username' => 'jane_doe',
            'email' => 'jane@eco.com',
            'password' => Hash::make('password'),
            'role_id' => 4, // resident
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Mike Johnson',
            'username' => 'mike_johnson',
            'email' => 'mike@eco.com',
            'password' => Hash::make('password'),
            'role_id' => 4, // resident
            'email_verified_at' => now(),
        ]);
    }
}
