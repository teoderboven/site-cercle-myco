<?php

namespace App\Http\Controllers;

use App\Models\Activity;

class HomeController extends Controller{
	
	public function display(){
		$nextActivity = Activity::getNextUpcomingActivity();

		if($nextActivity && $nextActivity->fullDaysUntilStart() > 7){
			$nextActivity = null; // don't display next
		}

		return view('home', ['nextActivity' => $nextActivity]);
	}
}
