<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Mail\ActivityReminder;
use App\Models\ActivityReminderSubscription;
use App\Models\MailSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ActivityReminderController extends Controller{
	
	/**
	 * Add a subscription for an activity reminder.
	 * @param Request $req
	 * @return string a json response
	 */
	public function register(Request $req){
		try{
			$customErrorMessages = [
				'activity.unique' => 'Un rappel existe déjà pour cette activité avec cette adresse email'
			];

			$validatedSubscriber = $req->validate([
				'email' => 'required|email|max:255'
			]);

			$subscriber = MailSubscriber::firstOrCreate($validatedSubscriber);

			$validatedActivity = $req->validate([
				'activity' => [
					'required',
					'string',
					'exists:activities,id',

					// validate the uniqueness of (activity_id, subscriber_id)
					Rule::unique('activity_reminder_subscriptions', 'activity_id')->where(function ($query) use ($subscriber){
						return $query->where('subscriber_id', $subscriber->id);
					})
				]
			], $customErrorMessages);

			ActivityReminderSubscription::create([
				'activity_id' => $validatedActivity['activity'],
				'subscriber_id' => $subscriber->id
			]);

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
		$subscriptions = ActivityReminderSubscription::with('subscriber')
		->where('first_reminder_sent', false)
		->orWhere('second_reminder_sent', false)
		->get();

		$now = Carbon::now();

		foreach ($subscriptions as $subscription){
			$activityDate = $subscription->activity->start_date;

			if($subscription->second_reminder_sent || $now->greaterThanOrEqualTo($activityDate)){
				continue; // nothing to send
			}

			$firstReminderDate = $activityDate->copy()->subDays(7)->setTime(14, 0);
			$secondReminderDate = $activityDate->copy()->subDays(2)->setTime(10, 0);

			// check second reminder
			if($now->greaterThanOrEqualTo($secondReminderDate)){
				Mail::to($subscription->subscriber->email)->send(new ActivityReminder($subscription->activity));

				$subscription->second_reminder_sent = true;
				$subscription->save();
			}
			// check first reminder
			else if($now->greaterThanOrEqualTo($firstReminderDate) && !$subscription->first_reminder_sent){
				Mail::to($subscription->subscriber->email)->send(new ActivityReminder($subscription->activity));

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

	/**
	 * Hourly task: send reminder to subscribers.
	 * Secured by the .env CRON_SECRET_KEY.
	 * @param Request $req
	 * @param string $key the pretending secret key
	 * @return string returns 'done'
	 */
	public function secureSendReminders(Request $req, string $key){
		$taskName = 'send reminders';
		$reqIp = $req->ip();
		Log::notice("task $taskName accessed by $reqIp");

		$secretKey = config('app.cron_secret_key');

		if(empty($secretKey)){
			throw new \RuntimeException('CRON_SECRET_KEY is not set in the configuration.');
		}

		if(empty($key) || $key !== $secretKey){
			Log::warning("task $taskName has refused $reqIp. key=$key");
			abort(403, 'Unauthorized');
		}

		// key is valid, execute task

		Log::notice("task $taskName has validate $reqIp, task executed");

		$this->sendReminders();
		$this->removeSentSubscriptions();

		return 'done';
	}

}
