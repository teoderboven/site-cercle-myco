<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ActivityNotificationSubscription
 *
 * Represents a subscription of a mail subscriber to notifications for a specific activity.
 *
 * @property int $activity_id The ID of the associated activity.
 * @property string $subscriber_id The ID of the associated mail subscriber.
 */
class ActivityNotificationSubscription extends Model{

	protected $fillable = [
		'activity_id',
		'subscriber_id'
	];

	public $timestamps = false;

	public function activity(): BelongsTo
    {
		return $this->belongsTo(Activity::class, 'activity_id');
	}

	public function subscriber(): BelongsTo
    {
		return $this->belongsTo(MailSubscriber::class, 'subscriber_id');
	}
}
