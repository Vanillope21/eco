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
        Schema::table('barangays', function (Blueprint $table) {
            $table->dropColumn([
                'location',
                'contact_firstname',
                'contact_lastname',
                'contact_number',
                'email',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barangays', function (Blueprint $table) {
            Schema::table('barangays', function (Blueprint $table) {
                $table->string('location')->nullable();
                $table->string('contact_firstname')->nullable();
                $table->string('contact_lastname')->nullable();
                $table->string('contact_number')->nullable();
                $table->string('email')->nullable();
            });
        });
    }
};
