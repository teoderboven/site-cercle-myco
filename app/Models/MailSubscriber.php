<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * Class MailSubscriber
 *
 * Represents a subscriber to email notifications.
 *
 * @property string $id The unique identifier for the subscriber.
 * @property string $email The email address of the subscriber.
 * @property bool $unsubscribed Indicates whether the subscriber has unsubscribed from notifications.
 * @property bool $bounced Indicates whether the subscriber's email has bounced.
 * @property string $token A unique token used for authenticate the subscriber.
 */
#[Table(keyType: 'string', incrementing: false, timestamps: false)]
#[Fillable(['email'])]
#[Hidden(['token'])]
class MailSubscriber extends Model
{
	use HasUuids;

	protected $casts = [
		'unsubscribed' => 'boolean'
	];


    /**
     * Determine if the subscriber can receive notifications.
     *
     * @return bool True if the subscriber can receive notifications, false otherwise.
     */
    public function canReceiveNotifications(): bool
    {
        return !($this->unsubscribed || $this->bounced);
    }

    /**
     * Get the unsubscribe link for the subscriber.
     *
     * @param Activity|null $activity The activity for which to generate the unsubscribe link (optional).
     * @return string The generated unsubscribe link.
     */
	public function getUnsubscribeLink(Activity $activity = null): string
    {
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

    /**
     * Unsubscribe the subscriber from notifications.
     */
    public function unsubscribe(): void
    {
        $this->unsubscribed = true;
        $this->save();
    }

    /**
     * Resubscribe the subscriber from notifications.
     */
	public function resubscribe(){
		$this->unsubscribed = false;
		$this->save();
	}

    /**
     * Mark the subscriber's email as bounced.
     */
    public function bounce(): void
    {
        $this->bounced = true;
        $this->save();
    }

    /**
     * Assign a unique token to the subscriber.
     */
	public function assignToken(): void{
		$this->token = Str::random(32);
	}

    /**
     * Boot the model and assign a token when creating a new subscriber.
     */
	protected static function booted(){
		static::creating(function($subscriber){
			if(empty($subscriber->token)) {
				$subscriber->assignToken();
			}
		});
	}

    /**
     * The subscriptions associated with the subscriber.
     */
	public function subscriptions() : HasMany {
		return $this->hasMany(ActivityNotificationSubscription::class, 'subscriber_id');
	}

    /**
     * The activities that the subscriber is subscribed to.
     */
    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class, 'activity_notification_subscriptions', 'subscriber_id', 'activity_id');
    }
}
