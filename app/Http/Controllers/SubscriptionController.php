<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityReminderSubscription;
use App\Models\MailSubscriber as Subscriber;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SubscriptionController extends Controller{
	
	/*
		Unsubscribe Route Querry:

		- rt {html,json} 			: the wanted response type, default=html
		- scope {global,activity} 	: the scope of the unsubscribe, default=global
		- activity {activityId}		: the activity id of reminders to unsubscribe
	*/
	public function unsubscribe(Request $req, string $subId, string $token){

		$responseType = $req->query('rt', 'html');

		try{
			$req->validate([
				'scope' => 'in:global,activity',
				'activity' => [
					'required_if:scope,activity',
					function ($attribute, $value, $fail) use ($req){
						// check if activity exists only when scope is activity
						if($req->scope === 'activity'){
							$validator = Validator::make(
								['activity' => $value],
								['activity' => 'exists:activities,id']
							);
			
							if($validator->fails()){
								$fail($validator->errors()->first($attribute));
							}
						}
					}
				]
			]);

			$subscriber = Subscriber::where('id', $subId)
			->where('unsubscribe_token', $token)
			->firstOrFail();

			$scope = $req->query('scope', 'global');

			if($scope == 'activity'){
				$this->unsubscribeFromActivity($subscriber->id, $req->query('activity'));
			}else{
				$this->globalUnsubscribe($subscriber);
			}

			if($responseType == 'json'){
				return response()->json([
					'success' => true
				], 200);
			}else{
				if($scope == 'activity'){
					return view('unsubscribeActivity', [
						'subscriberEmail' => $subscriber->email,
						'activity' => Activity::find($req->query('activity'))
					]);
				}else{
					return view('unsubscribeGlobal', [
						'subscriberEmail' => $subscriber->email,
					]);
				}
			}
		
		}catch(ValidationException $e){
			return response()->json([
				'success' => false,
				'errors' => $e->errors()
			], 422);
		}catch(ModelNotFoundException $e){
			// Subscriber not found
			if($responseType == 'json'){
				return response()->json([
					'success' => false,
					'errors' => ['global' => 'Bad unsubscribe link']
				], 404);
			}
			else abort(404);
		}
	}

	/**
	 * Delete an activity subscription entry
	 */
	private function unsubscribeFromActivity(string $subscriberId, string $activityId){
		ActivityReminderSubscription::where('activity_id', $activityId)
		->where('subscriber_id', $subscriberId)
		->delete();
	}

	/**
	 * Marks subscriber as unsubscribed and delete associated reminders
	 */
	private function globalUnsubscribe(Subscriber $subscriber){
		$subscriber->unsubscribed = true;
		$subscriber->save();

		ActivityReminderSubscription::where('subscriber_id', $subscriber->id)->delete();
	}

}
