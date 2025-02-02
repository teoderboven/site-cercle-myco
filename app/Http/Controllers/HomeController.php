<?php

namespace App\Http\Controllers;

use App\Models\Activity;

class HomeController extends Controller{
	
	public function display(){
		$nextActivity = Activity::getNextUpcomingActivity();

		if($nextActivity && $nextActivity->fullDaysUntilStart() > config('cmb.activity_featured_duration_days')){
			$nextActivity = null; // don't display next
		}
// TODO : changer config par une variable ici et get config dans helper countdown
		return view('home', ['nextActivity' => $nextActivity]);
	}
}
