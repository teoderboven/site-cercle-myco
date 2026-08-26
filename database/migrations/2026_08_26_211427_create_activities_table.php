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
        Schema::create('activities', function (Blueprint $table) {
            $table->char('id', 16)->primary();
            $table->string('title');
            $table->integer('guide_id')->index('guide');
            $table->dateTime('start_date')->index('idx_activity_start_date');
            $table->smallInteger('duration');
            $table->text('description');
            $table->integer('meeting_point')->index('idx_activity_meeting_point');
            $table->boolean('cancelled')->default(false);
            $table->boolean('visible')->default(true);
            $table->timestamp('created_time')->nullable()->useCurrent();
            $table->timestamp('updated_time')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->integer('updated_by')->index('updated_by');

            $table->index(['guide_id'], 'idx_activity_guide');
            $table->index(['meeting_point'], 'meeting_point');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
