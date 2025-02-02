<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Start date of a season
	|--------------------------------------------------------------------------
	|
	| This value determines the start of a displayed activity season.
	| A season is during 1 year (Example: from february 1st 2025 to january 31 2026)
	|
	*/

	'season_start_date' => env('CMB_SEASON_START_DATE', '02-01'),

	/*
	|--------------------------------------------------------------------------
	| Activity counter days
	|--------------------------------------------------------------------------
	|
	| This value determines how many days the number of days remaining
	| before an activity is displayed.
	|
	*/

	'days_before_activity_counter_shows' => (int) env('CMB_DAYS_BEFORE_ACTIVITY_COUNTER_SHOWS', 21),

	/*
	|--------------------------------------------------------------------------
	| Activity featured duration
	|--------------------------------------------------------------------------
	|
	| This value determines how many days an activity remains featured
	| on the website’s home page. A special banner will appear during
	| this time to signal the next activity with a direct link to it.
	| The banner also shows how much time is left before the activity
	| starts (for example, "in 3 days", "tomorrow", etc.).
	|
	*/

	'activity_featured_duration_days' => (int) env(
		'CMB_ACTIVITY_FEATURED_DURATION_DAYS',
		env('CMB_DAYS_BEFORE_ACTIVITY_COUNTER_SHOWS', 7)
	),

	/*
	|--------------------------------------------------------------------------
	| Length of the Activity table id
	|--------------------------------------------------------------------------
	|
	| This value determines the length of the Activity table id since
	| it is an alphanumeric id.
	|
	*/

	'activity_id_length' => (int) env('CMB_ACTIVITY_ID_LENGTH', 16),

];
