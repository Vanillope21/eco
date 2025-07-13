<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed lookup tables first
        $this->call([
            RolesTableSeeder::class,
            WasteTypesTableSeeder::class,
            DaysOfWeekTableSeeder::class,
            RequestStatusesTableSeeder::class,
            BarangayStatusesTableSeeder::class,
        ]);

        // Then create users (which depend on roles)
        $this->call([
            UsersTableSeeder::class,
        ]);

        // User::factory(10)->create();
    }
}
