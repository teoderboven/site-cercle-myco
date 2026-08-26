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
        Schema::table('activities', function (Blueprint $table) {
            $table->foreign('guide_id', 'fk_activities_guide_id')
                ->references('id')->on('guides');

            $table->foreign('meeting_point', 'fk_activities_meeting_point')
                ->references('id')->on('meeting_points');

            $table->foreign('updated_by', 'fk_activities_updated_by')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropForeign('fk_activities_guide_id');
            $table->dropForeign('fk_activities_meeting_point');
            $table->dropForeign('fk_activities_updated_by');
        });
    }
};
