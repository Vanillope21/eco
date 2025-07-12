<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'super-admin',
                'display_name' => 'Super Administrator',
                'description' => 'Full system access and control',
                'permissions' => json_encode([
                    'manage_users' => true,
                    'manage_barangays' => true,
                    'manage_schedules' => true,
                    'manage_requests' => true,
                    'view_analytics' => true,
                    'system_settings' => true
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'System administration and management',
                'permissions' => json_encode([
                    'manage_barangays' => true,
                    'manage_schedules' => true,
                    'manage_requests' => true,
                    'view_analytics' => true
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'barangay-official',
                'display_name' => 'Barangay Official',
                'description' => 'Barangay-level management',
                'permissions' => json_encode([
                    'manage_local_schedules' => true,
                    'manage_local_requests' => true,
                    'view_local_analytics' => true
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'resident',
                'display_name' => 'Resident',
                'description' => 'Basic user access',
                'permissions' => json_encode([
                    'view_schedules' => true,
                    'create_requests' => true,
                    'view_own_requests' => true
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}
