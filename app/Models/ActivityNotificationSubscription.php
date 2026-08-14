<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

/**
 * Class ActivityNotificationSubscription
 *
 * Represents a subscription of a mail subscriber to notifications for a specific activity.
 *
 * @property int $activity_id The ID of the associated activity.
 * @property string $subscriber_id The ID of the associated mail subscriber.
 * @property bool $first_reminder_sent Indicates whether the first reminder has been sent.
 * @property bool $second_reminder_sent Indicates whether the second reminder has been sent.
 */
class ActivityNotificationSubscription extends Model{

	use HasCompositeKey;

	protected $primaryKey = [
		'activity_id',
		'subscriber_id'
	];

	protected $fillable = [
		'activity_id',
		'subscriber_id'
	];

	protected $casts = [
		'first_reminder_sent' => 'boolean',
		'second_reminder_sent' => 'boolean'
	];

	public $timestamps = false;

	public function activity(){
		return $this->belongsTo(Activity::class, 'activity_id');
	}

	public function subscriber(){
		return $this->belongsTo(MailSubscriber::class, 'subscriber_id');
	}
}
