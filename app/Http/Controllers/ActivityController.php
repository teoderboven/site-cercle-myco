<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Carbon\Carbon;

class ActivityController extends Controller{

	protected $seasonStartMonth;
	protected $seasonStartDay;

	public function __construct()
	{
		$seasonStartDate = env('CMB_SEASON_START_DATE', '02-01'); // Default to February 1st if not set
		list($this->seasonStartMonth, $this->seasonStartDay) = explode('-', $seasonStartDate);
	}
	
	public function publicDisplay(){
		$currentDate = Carbon::now();

		$seasonYear = $this->getCurrentSeasonYear($currentDate);

		$hasNextActivity = false; // determines if list of activities has a next or if season has ended

		$seasonStartDate = Carbon::create($seasonYear, $this->seasonStartMonth, $this->seasonStartDay, 0, 0, 0);
		$seasonEndDate = Carbon::create($seasonYear + 1, $this->seasonStartMonth, $this->seasonStartDay, 0, 0, 0)->subDay()->endOfDay();

		$activities = Activity::without('updatedBy')
			->whereBetween('start_date', [$seasonStartDate, $seasonEndDate])
			->orderBy('start_date', 'asc')
			->get();

		foreach($activities as $activity){
			$activity->isPassed = $this->isPassed($activity, $currentDate);
			$activity->isOngoing = $this->isOngoing($activity, $currentDate);
			$activity->daysUntilStart = $this->fullDaysUntilStart($activity, $currentDate);

			if(!$activity->isPassed && !$hasNextActivity){
				$activity->isNext = true;
				$hasNextActivity = true;
			}else{
				$activity->isNext = false;
			}

			unset($activity->updated_by);
		}

		$groupedActivities = $this->groupActivitiesByMonth($activities);

		return view('activities', [
			'currentSeasonYear' => $seasonYear,
			'groupedActivities' => $groupedActivities,
			'hasNextActivity' => $hasNextActivity
		]);
	}

	/**
	 * Gives the current season year.
	 * The start of a season is determined by the env property CMB_SEASON_START_DATE
	 */
	protected function getCurrentSeasonYear($currentDate){

		$seasonStartThisYear = Carbon::create($currentDate->year, $this->seasonStartMonth, $this->seasonStartDay, 0, 0, 0);

		// If the current date is before the season start date this year, the season is from the previous year
		if ($currentDate->lt($seasonStartThisYear)) {
			return $currentDate->year - 1;
		}

		// Otherwise, the season is from the current year
		return $currentDate->year;
	}

	/**
	 * Determines if an activity is passed
	 */
	private function isPassed($activity, $currentDate){
		$endDateTime = $activity->start_date->copy()->addMinutes($activity->duration);

		return $currentDate->greaterThan($endDateTime);
	}

	/**
	 * Determines if an activity is ongoing
	 */
	private function isOngoing($activity, $currentDate){
		$startDateTime = $activity->start_date;
		$endDateTime = $startDateTime->copy()->addMinutes($activity->duration);

		return $currentDate->between($startDateTime, $endDateTime);
	}

	/**
	 * Determines the number of days until the start of an activity
	 */
	private function fullDaysUntilStart($activity, $currentDate){
		// startOfDay for use full days
		return (int) $currentDate->copy()->startOfDay()->diffInDays($activity->start_date->startOfDay(), false);
	}

	/**
	 * Creates an array of object with the month name and all the acitivities of the month
	 */
	private function groupActivitiesByMonth($activities){
		$grouped = [];

		foreach($activities as $activity){
			$yearMonth = $activity->start_date->format('Y-m');
			$monthName = ucfirst($activity->start_date->translatedFormat('F'));
			$year = $activity->start_date->format('Y');

			if(!isset($grouped[$yearMonth])){
				$grouped[$yearMonth] = (object) [
					'datetime' => $yearMonth,
					'month' => $monthName,
					'year' => $year,
					'activities' => []
				];
			}

			$grouped[$yearMonth]->activities[] = $activity;
		}

		// Convert associative array to array<Object>
		return array_values($grouped);
	}
}
