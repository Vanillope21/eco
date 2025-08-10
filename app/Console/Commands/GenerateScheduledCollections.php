<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Schedule;
use App\Models\ScheduleCollection;
use Carbon\Carbon; 

class GenerateScheduledCollections extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'collections:generate-daily';//app:generate-scheduled-collections

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate today\'s scheduled collections from recurring schedules.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now()->format('l');

        $alreadyGenerated = ScheduleCollection::whereDate('collection_date', today())->exists();
        if($alreadyGenerated){
            $this->info('Scheduled collections for today already exist.');
            return;
        }

        $schedules = Schedule::where('day_of_week', $today)->get();

        foreach ($schedules as $schedule){
            ScheduleCollection::create([
                'schedule_id' => $schedule->id,
                'truck_id' => $schedule->truck_id,
                'barangay_id' => $schedule->barangay_id,
                'waste_type_id' => $schedule->waste_type_id,
                'collection_date' => today(),
                'pickup_time' => $schedule->pickup_time,
                'status' => 'pending',
            ]);
        }

        $this->info('Scheduled collections gathered for today: ' . count($schedules));
    }
}
