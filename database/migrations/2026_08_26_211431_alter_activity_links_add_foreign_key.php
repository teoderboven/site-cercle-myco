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
        Schema::table('activity_links', function (Blueprint $table) {
            $table->foreign('activity_id', 'fk_activity_links_activity_id')
                ->references('id')->on('activities')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity_links', function (Blueprint $table) {
            $table->dropForeign('fk_activity_links_activity_id');
        });
    }
};
