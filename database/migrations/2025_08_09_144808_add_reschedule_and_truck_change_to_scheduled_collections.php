<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.  
     */
    public function up(): void
    {
        Schema::table('schedule_collections', function (Blueprint $table) {
            //for switching to another truck
            $table->foreignId('truck_id')->nullable()->after('schedule_id')->constrained()->onDelete('set null');

            //for rescheduling
            $table->date('rescheduled_date')->nullable()->after('collection_date');

            //reason for change
            $table->string('change_reason')->nullable()->after('status');

            //who changed it 
            $table->foreignId('changed_by')->nullable()->after('change_reason')->constrained('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedule_collections', function (Blueprint $table) {
            $table->dropColumn(['truck_id', 'rescheduled_date', 'change_reason', 'changed_by']);
        });
    }
};
