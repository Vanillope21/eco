<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'sms',
                'display_name' => 'SMS',
                'description' => 'Short Message Service notifications',
                'is_active' => true,
            ],
            [
                'name' => 'email',
                'display_name' => 'Email',
                'description' => 'Email notifications',
                'is_active' => true,
            ],
            [
                'name' => 'push',
                'display_name' => 'Push Notification',
                'description' => 'Push notifications for mobile app',
                'is_active' => true,
            ],
        ];

        foreach ($types as $type) {
            DB::table('notification_types')->insert($type);
        }
    }
}
