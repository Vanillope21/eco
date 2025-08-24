<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            //Drop foreign contraints 
            if(Schema::hasColumn('schedules', 'day_of_week_id')){
                $table->dropForeign(['day_of_week_id']);
                $table->dropColumn('day_of_week_id');
            }
            if(Schema::hasColumn('schedules', 'status_id')){
                $table->dropForeign(['status_id']);
                $table->dropColumn('status_id');
            }

            //modify the day_of_week and status
            $table->enum('day_of_week', [
                'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'
            ])->after('waste_type_id');

            $table->enum('status', [
                'active', 'inactive', 'rescheduled'
            ])->default('active')->after('pickup_time');

        

            if(Schema::hasColumn('schedules', 'title')){
                $table->dropColumn('title');
            }
            if(Schema::hasColumn('schedules', 'description')){
                $table->dropColumn('description');
            }
            
        });

        DB::statement('ALTER TABLE schedules MODIFY truck_id BIGINT UNSIGNED AFTER id');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table){
            //restore old columns
            $table->unsignedBigInteger('day_of_week_id')->nullable()->after('waste_type_id');
            $table->unsignedBigInteger('status_id')->nullable()->after('pickup_time');

            $table->foreign('day_of_week_id')->references('id')->on('day_of_weeks');
            $table->foreign('status_id')->references('id')->on('statuses');

            $table->string('title')->nullable();
            $table->text('description')->nullable();

            if(Schema::hasColumn('schedules', 'day_of_week')){
                $table->dropColumn('day_of_week');
            }
            if(Schema::hasColumn('schedules', 'status')){
                $table->dropColumn('status');
            }
        });
        DB::statement('ALTER TABLE schedules MODIFY truck_id BIGINT UNSIGNED');
    }
};
