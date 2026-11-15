<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ActivitySeasonNotificationSubscription
 *
 * Represents a subscription of a mail subscriber to notifications for a specific activity season.
 *
 * @property string $subscriber_id The ID of the associated mail subscriber.
 * @property int $activity_season_id The ID of the associated activity season.
 * @property \Carbon\Carbon $subscribed_at The date and time when the subscription was created.
 */
#[Table(timestamps: false)]
#[Fillable(['subscriber_id', 'activity_season_id'])]
class ActivitySeasonNotificationSubscription extends Model
{
    /**
     * Get the casts for the model's attributes.
     *
     * @return array The casts for the model's attributes.
     */
    protected function casts(): array
    {
        return [
            'subscriber_id' => 'string',
            'activity_season_id' => 'int',
            'subscribed_at' => 'datetime',
        ];
    }

    /**
     * Get the activity season associated with this subscription.
     *
     * @return BelongsTo
     */
    public function activitySeason(): BelongsTo
    {
        return $this->belongsTo(ActivitySeason::class, 'activity_season_id');
    }

    /**
     * Get the subscriber associated with this subscription.
     *
     * @return BelongsTo
     */
    public function subscriber(): BelongsTo
    {
        return $this->belongsTo(MailSubscriber::class, 'subscriber_id');
    }
}
