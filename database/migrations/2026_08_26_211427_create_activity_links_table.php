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
        Schema::create('activity_links', function (Blueprint $table) {
            $table->integer('id', true);
            $table->char('activity_id', 16)->index('activity_id');
            $table->string('text');
            $table->string('url');

            $table->unique(['activity_id', 'url'], 'activity_id_2');
            $table->index(['activity_id'], 'idx_links_activity_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_links');
    }
};
