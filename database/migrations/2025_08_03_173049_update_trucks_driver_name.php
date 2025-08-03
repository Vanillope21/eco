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
        Schema::table('trucks', function (Blueprint $table) {
            $table->string('driver_last_name')->after('plate_number');
            $table->string('driver_first_name')->after('driver_last_name');
            $table->dropColumn('driver_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trucks', function (Blueprint $table) {
            $table->string('driver_name')->after('plate_number');
            $table->dropColumn(['driver_last_name', 'driver_first_name']);
        });
    }
};
