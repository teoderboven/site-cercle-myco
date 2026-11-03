<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ActivityNotificationSubscription
 *
 * Represents a subscription of a mail subscriber to notifications for a specific activity.
 */
#[Table(timestamps: false)]
#[Fillable(['activity_id', 'subscriber_id'])]
class ActivityNotificationSubscription extends Model{
	public function activity(): BelongsTo
    {
		return $this->belongsTo(Activity::class, 'activity_id');
	}

	public function subscriber(): BelongsTo
    {
		return $this->belongsTo(MailSubscriber::class, 'subscriber_id');
	}

    public function logs(): HasMany
    {
        return $this->hasMany(ActivityNotificationLog::class, 'subscription_id');
    }
}
