<?php

namespace App\Services;

use Carbon\Carbon;

/**
 * Class SeasonService
 *
 * This service provides methods to determine the season ID based on a given date,
 * as well as to retrieve the start and end dates of a season.
 */
class SeasonService
{
    /**
     * Get the season ID for a given date.
     *
     * @param Carbon|null $date The date to determine the season for. Defaults to the current date if null.
     * @return int The season ID (year) corresponding to the given date.
     */
    public function getSeasonId(?Carbon $date = null): int
    {
        $date ??= now();

        [$month, $day] = $this->getSeasonStartMonthAndDay();

        $start = $date->copy()->setDate(
            $date->year,
            (int) $month,
            (int) $day
        );

        return $date->lt($start)
            ? $date->year - 1
            : $date->year;
    }

    /**
     * Get the start date of a season.
     *
     * @param int $seasonId The season ID (year).
     * @return Carbon The start date of the season.
     */
    public function getSeasonStartDate(int $seasonId): Carbon
    {
        [$month, $day] = $this->getSeasonStartMonthAndDay();

        return Carbon::create($seasonId, (int) $month, (int) $day)
            ->startOfDay();
    }

    /**
     * Get the end date of a season (exclusive).
     *
     * @param int $seasonId The season ID (year).
     * @return Carbon The end date of the season.
     */
    public function getSeasonEndDate(int $seasonId): Carbon
    {
        return $this->getSeasonStartDate($seasonId + 1);
    }

    /**
     * Get the start month and day of the season from the configuration.
     *
     * @return array An array containing the month and day as integers.
     */
    private function getSeasonStartMonthAndDay(): array
    {
        return explode('-', config('cmb.season_start_date'));
    }
}