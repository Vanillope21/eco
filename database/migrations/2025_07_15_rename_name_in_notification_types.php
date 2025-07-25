<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notification_types', function (Blueprint $table) {
            if (Schema::hasColumn('notification_types', 'name')) {
                $table->renameColumn('name', 'notification_type_name');
            }
        });
    }
    public function down(): void
    {
        Schema::table('notification_types', function (Blueprint $table) {
            if (Schema::hasColumn('notification_types', 'notification_type_name')) {
                $table->renameColumn('notification_type_name', 'name');
            }
        });
    }
}; 