<?php

use App\Services\SeasonService;
use Carbon\Carbon;
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
            $table->year('season_id')->nullable()->after('guide_id');

            // Add foreign key constraint
            $table->foreign('season_id')
                ->references('id')
                ->on('activity_seasons');
        });

        DB::table('activities')
            ->chunkById(100, function ($activities) {
                foreach ($activities as $activity) {
                    $seasonId = app(SeasonService::class)->getSeasonId(Carbon::parse($activity->start_date));

                    DB::table('activity_seasons')
                        ->insertOrIgnore([
                            'id' => $seasonId
                        ]);

                    DB::table('activities')
                        ->where('id', $activity->id)
                        ->update([
                            'season_id' => $seasonId
                        ]);
                }
            });

        Schema::table('activities', function (Blueprint $table) {
            $table->year('season_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropForeign('activities_season_id_foreign');
            $table->dropColumn('season_id');
        });
    }
};
