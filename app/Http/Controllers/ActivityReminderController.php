<?php

namespace App\Http\Controllers;

use App\Models\ActivityReminderSubscription;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ActivityReminderController extends Controller{
	
	public function register(Request $req){
		try{
			$customMessages = [
				'activity.unique' => 'Un rappel existe déjà pour cette activité avec cette adresse email'
			];

			$validatedSubscription = $req->validate([
				'email' => 'required|email|max:255',

				'activity' => [
					'required',
					'string',
					'exists:activities,id',

					// validate the uniqueness of (activity_id, email)
					Rule::unique('activity_reminder_subscriptions', 'activity_id')->where(function ($query) use ($req){
						return $query->where('email', $req->email);
					})
				]
			], $customMessages);

			// change activity to activity_id
			$validatedSubscription ['activity_id'] = $validatedSubscription ['activity'];
    		unset($validatedSubscription ['activity']);

			ActivityReminderSubscription::create($validatedSubscription);

			return response()->json([
				'success' => true
			], 201);

		}catch(ValidationException $e){
			return response()->json([
				'success' => false,
				'errors' => $e->errors()
			], 422);
		}
	}

}
