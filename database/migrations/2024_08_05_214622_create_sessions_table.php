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
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->charset('utf8')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->charset('utf8')->nullable();
            $table->text('user_agent')->charset('utf8')->nullable();
            $table->longText('payload')->charset('utf8');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
