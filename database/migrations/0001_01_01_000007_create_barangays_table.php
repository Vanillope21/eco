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
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name'); // Name of the barangay (e.g., "Barangay San Isidro")
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('contact_firstname')->nullable(); // Contact person's first name
            $table->string('contact_lastname')->nullable(); // Contact person's last name
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('barangays')->onDelete('cascade');
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
