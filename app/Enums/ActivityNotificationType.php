<?php

namespace App\Enums;

/**
 * Enum ActivityNotificationType
 *
 * This enum represents the different types of activity notifications that can be sent to subscribers.
 */
enum ActivityNotificationType : string
{
    case REMINDER_7_DAYS = 'reminder_7_days';
    case REMINDER_2_DAYS = 'reminder_2_days';
    case ACTIVITY_UPDATED = 'activity_updated';
    case ACTIVITY_CANCELLED = 'activity_cancelled';
}
