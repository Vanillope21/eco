<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Truck;
use App\Models\TruckLocation;
use Carbon\Carbon;

class TruckLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all existing trucks
        $trucks = Truck::all();

        // get any valid status id
        $statusIds = DB::table('gps_statuses')->pluck('id')->all();
        if (empty($statusIds)) {
            $this->call(Gps_statuses_Seeder::class);
            $statusIds = DB::table('gps_statuses')->pluck('id')->all();
        }

        foreach ($trucks as $truck) {
            TruckLocation::create([
                'truck_id'      => $truck->id,
                'gps_status_id' => $statusIds[array_rand($statusIds)],
                'latitude'      => 14.5995 + mt_rand(-100, 100) / 1000,
                'longitude'     => 120.9842 + mt_rand(-100, 100) / 1000,
                'altitude'      => 15 + mt_rand(-10, 10),
                'speed'         => mt_rand(0, 80),
                'heading'       => mt_rand(0, 360),
                'accuracy'      => mt_rand(1, 10),
                'recorded_at'   => Carbon::now()->subMinutes(mt_rand(0, 60)),
            ]);
        }
    }
}
