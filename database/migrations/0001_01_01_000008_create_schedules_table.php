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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('barangay_id');
            $table->unsignedBigInteger('waste_type_id');
            $table->unsignedBigInteger('day_of_week_id');
            $table->time('pickup_time');
            $table->unsignedBigInteger('status_id')->default(1); // 1 = active
            $table->unsignedBigInteger('truck_id')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('barangay_id')->references('id')->on('barangays')->onDelete('cascade');
            $table->foreign('waste_type_id')->references('id')->on('waste_types')->onDelete('restrict');
            $table->foreign('day_of_week_id')->references('id')->on('days_of_week')->onDelete('restrict');
            $table->foreign('status_id')->references('id')->on('barangay_statuses')->onDelete('restrict');
            $table->foreign('truck_id')->references('id')->on('trucks')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
