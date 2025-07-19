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
        // Seed lookup tables first (in dependency order)
        $this->call([
            RolesTableSeeder::class,
            WasteTypesTableSeeder::class,
            DaysOfWeekTableSeeder::class,
            RequestStatusesTableSeeder::class,
            BarangayStatusesTableSeeder::class,
            NotificationTypesTableSeeder::class,
            ViolationTypesTableSeeder::class,
            PenaltyStatusesTableSeeder::class,
        ]);

        // Then create barangays and users (which depend on roles)
        $this->call([
            BarangaySeeder::class,
            EmployeeSeeder::class,
            UsersTableSeeder::class,
        ]);

        // User::factory(10)->create();
    }
}
