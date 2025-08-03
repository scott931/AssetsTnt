<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('asset_maintenance', function (Blueprint $table) {
            $table->boolean('is_recurring')->default(false)->after('status');
            $table->integer('recurrence_interval')->nullable()->after('is_recurring');
            $table->string('recurrence_unit')->nullable()->after('recurrence_interval'); // e.g., days, weeks, months, years
        });
    }

    public function down()
    {
        Schema::table('asset_maintenance', function (Blueprint $table) {
            $table->dropColumn(['is_recurring', 'recurrence_interval', 'recurrence_unit']);
        });
    }
};