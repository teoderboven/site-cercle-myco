<?php

namespace App\Models;

use App\Enums\ActivityNotificationType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ActivityNotificationLog
 *
 * Represents a log entry for an activity notification.
 *
 * @property int $id The unique identifier for the log entry.
 * @property int $subscription_id The ID of the associated subscription.
 * @property ActivityNotificationType $type The type of notification sent.
 * @property \Illuminate\Support\Carbon|null $sent_at The timestamp when the notification was sent.
 */
class ActivityNotificationLog extends Model
{
    protected $fillable = [
        'subscription_id',
        'type',
    ];

    protected function casts() : array
    {
        return [
            'type' => ActivityNotificationType::class,
            'sent_at' => 'datetime',
        ];
    }

    public $timestamps = false;

    public function subscription() : BelongsTo
    {
        return $this->belongsTo(ActivityNotificationSubscription::class, 'subscription_id');
    }
}
