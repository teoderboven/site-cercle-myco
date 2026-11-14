<?php

namespace App\Models;

use App\Services\SeasonService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class ActivitySeason
 *
 * Represents a season for activities, identified by a year.
 */
#[Table(incrementing: false, timestamps: false)]
class ActivitySeason extends Model
{
    /**
     * Get the start date of the season.
     *
     * @return Carbon The start date of the season.
     */
    public function getStartDate(): Carbon
    {
        return app(SeasonService::class)->getSeasonStartDate($this->id);
    }

    /**
     * Get the end date of the season.
     *
     * @return Carbon The end date of the season.
     */
    public function getEndDate(): Carbon
    {
        return app(SeasonService::class)->getSeasonEndDate($this->id);
    }

    /**
     * Get the activities associated with this season.
     *
     * @return HasMany The relationship to the Activity model.
     */
    public function activities() : HasMany
    {
        return $this->hasMany(Activity::class, 'season_id');
    }
}
