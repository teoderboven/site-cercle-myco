<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Mail\ActivityReminder;
use App\Models\ActivityReminderSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ActivityReminderController extends Controller{
	
	public function register(Request $req){
		try{
			$customErrorMessages = [
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
			], $customErrorMessages);

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

	/**
	 * Sends activity reminders to subscribers.
	 * Only sends reminders if the date of the activity is close.
	 * A reminder is usually sent 7 days before an activity at 2pm and 2 days before an activity at 10am.
	 */
	public function sendReminders(): void{
		$subscriptions = ActivityReminderSubscription::where('first_reminder_sent', false)
		->orWhere('second_reminder_sent', false)
		->get();

		foreach ($subscriptions as $subscription){
			if($subscription->second_reminder_sent) continue; // nothing to send

			$activityDate = $subscription->activity->start_date;
			$now = Carbon::now();

			$firstReminderDate = $activityDate->copy()->subDays(7)->setTime(14, 0);
			$secondReminderDate = $activityDate->copy()->subDays(2)->setTime(10, 0);

			// check second reminder
			if($now->greaterThanOrEqualTo($secondReminderDate)){
				Mail::to($subscription->email)->send(new ActivityReminder($subscription->activity));

				$subscription->second_reminder_sent = true;
				$subscription->save();
			}
			// check first reminder
			else if($now->greaterThanOrEqualTo($firstReminderDate) && !$subscription->first_reminder_sent){
				Mail::to($subscription->email)->send(new ActivityReminder($subscription->activity));

				$subscription->first_reminder_sent = true;
				$subscription->save();
			}
		}
	}

	/**
	 * Removes reminders that have already been sent from the database
	 */
	public function removeSentSubscriptions(): void{
		ActivityReminderSubscription::where('second_reminder_sent', true)->delete();
	}

}
