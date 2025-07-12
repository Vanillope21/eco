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
        Schema::create('household_requests', function (Blueprint $table) {
            $table->id();
            $table->string('household_name');
            $table->string('household_head');
            $table->string('contact_number');
            $table->string('email')->nullable();
            $table->foreignId('barangay_id')->constrained()->onDelete('cascade');
            $table->text('address_description');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('household_requests');
    }
}; 