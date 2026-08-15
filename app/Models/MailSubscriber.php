<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * Class MailSubscriber
 *
 * Represents a subscriber to email notifications.
 *
 * @property string $id The unique identifier for the subscriber.
 * @property string $email The email address of the subscriber.
 * @property bool $unsubscribed Indicates whether the subscriber has unsubscribed from notifications.
 * @property string $token A unique token used for authenticate the subscriber.
 */
class MailSubscriber extends Model{
	
	use HasUuids;

	public $incrementing = false;
	protected $keyType = 'string';

	protected $fillable = [
		'email'
	];

	protected $casts = [
		'unsubscribed' => 'boolean'
	];

	protected $hidden = [
		'token'
	];

	public $timestamps = false;

	public function subscriptions(){
		return $this->hasMany(ActivityNotificationSubscription::class, 'subscriber_id');
	}

    public function activities(){
        return $this->belongsToMany(Activity::class, 'activity_notification_subscriptions', 'subscriber_id', 'activity_id');
    }

	public function getUnsubscribeLink(Activity $activity = null){
		$routeParameters = [
			'subId' => $this->id,
			'token' => $this->token,
		];
	
		if($activity){
			$routeParameters['scope'] = 'activity';
			$routeParameters['activity'] = $activity->id;
		}
	
		return route('unsubscribe', $routeParameters);
	}

	public function resubscribe(){
		$this->unsubscribed = false;
		$this->save();
	}
	
	public function assignToken(): void{
		$this->token = Str::random(32);
	}

	protected static function booted(){
		static::creating(function($subscriber){
			if(empty($subscriber->token)) {
				$subscriber->assignToken();
			}
		});
	}

}
