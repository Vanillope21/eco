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
        Schema::create('barangays', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the barangay (e.g., "Barangay San Isidro")
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->string('contact_firstname')->nullable(); // Contact person's first name
            $table->string('contact_lastname')->nullable(); // Contact person's last name
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangays');
    }
};
