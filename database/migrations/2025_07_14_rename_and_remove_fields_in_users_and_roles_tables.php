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
        // Remove 'name' column from users table
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'name')) {
                $table->dropColumn('name');
            }
        });

        // Rename 'name' to 'role_name' in roles table
        Schema::table('roles', function (Blueprint $table) {
            if (Schema::hasColumn('roles', 'name')) {
                $table->renameColumn('name', 'role_name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add 'name' column back to users table
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'name')) {
                $table->string('name')->after('id');
            }
        });

        // Rename 'role_name' back to 'name' in roles table
        Schema::table('roles', function (Blueprint $table) {
            if (Schema::hasColumn('roles', 'role_name')) {
                $table->renameColumn('role_name', 'name');
            }
        });
    }
}; 