<?php

namespace App\Services;

use App\DTOs\API\SubscriptionResponse;
use App\Models\MailSubscriber;

/**
 * Class SubscriptionResponseService
 *
 * This service is responsible for formatting responses related to subscription actions.
 */
class SubscriptionResponseService
{
    /**
     * Format response when subscriber email has bounced.
     *
     * @param MailSubscriber $subscriber The subscriber whose email has bounced.
     * @return SubscriptionResponse The formatted response indicating the bounced email status.
     */
    public function bounced(MailSubscriber $subscriber): SubscriptionResponse
    {
        return new SubscriptionResponse(
            status: 409,
            success: false,
            errors: [
                'email' => __('subscription.subscriberBounced', ['email' => $subscriber->email])
            ]
        );
    }

    /**
     * Format response when subscriber is not found.
     *
     * @return SubscriptionResponse The formatted response indicating the subscriber not found status.
     */
    public function subscriberNotFound(): SubscriptionResponse
    {
        return new SubscriptionResponse(
            status: 404,
            success: false,
            message: __('subscription.subscriberNotFound'),
            reminderNotFound: true
        );
    }
}