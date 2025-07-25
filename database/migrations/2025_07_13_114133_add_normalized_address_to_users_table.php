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
        Schema::table('users', function (Blueprint $table) {
            // Add normalized address fields
            $table->string('house_number')->nullable();
            $table->string('street_name')->nullable();
            $table->string('subdivision')->nullable();
            $table->string('sitio')->nullable();
            $table->string('barangay_address')->nullable(); // For barangay name in address
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->text('additional_address_info')->nullable(); // For any other address details
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'house_number',
                'street_name', 
                'subdivision',
                'sitio',
                'barangay_address',
                'city',
                'province',
                'postal_code',
                'additional_address_info'
            ]);
        });
    }
};
