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
    case REMINDER_3_DAYS = 'reminder_3_days';
    case ACTIVITY_UPDATED = 'activity_updated';
    case ACTIVITY_CANCELLED = 'activity_cancelled';
}
