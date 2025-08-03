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
        Schema::table('asset_transfers', function (Blueprint $table) {
            $table->unsignedBigInteger('initiated_by')->nullable()->after('id');
            $table->unsignedBigInteger('from_location_id')->nullable()->after('to_department_id');
            $table->unsignedBigInteger('to_location_id')->nullable()->after('from_location_id');
            $table->enum('transfer_type', ['permanent', 'temporary'])->default('permanent')->after('to_location_id');
            $table->timestamp('scheduled_at')->nullable()->after('transfer_type');
            $table->text('comments')->nullable()->after('status');
            $table->string('certificate_path')->nullable()->after('comments');
            $table->json('condition_before')->nullable()->after('certificate_path');
            $table->json('condition_after')->nullable()->after('condition_before');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asset_transfers', function (Blueprint $table) {
            $table->dropColumn([
                'initiated_by',
                'from_location_id',
                'to_location_id',
                'transfer_type',
                'scheduled_at',
                'comments',
                'certificate_path',
                'condition_before',
                'condition_after',
            ]);
        });
    }
};
