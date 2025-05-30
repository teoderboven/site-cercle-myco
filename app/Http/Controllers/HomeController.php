<?php

namespace App\Http\Controllers;

use App\Models\Activity;

class HomeController extends Controller{
	
	public function display(){
		$nextActivity = Activity::getNextUpcomingActivity();

		$featuredDuration = config('cmb.activity_featured_duration_days');

		if($nextActivity && $nextActivity->fullDaysUntilStart() > $featuredDuration){
			$nextActivity = null; // don't display next
		}

		return view('home', ['nextActivity' => $nextActivity]);
	}
}
