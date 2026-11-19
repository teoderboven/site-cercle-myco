<?php

namespace App\DTOs\API;

/**
 * Class SubscriptionResponse
 *
 * A specialized API response DTO for subscription-related actions, extending the generic APIResponse.
 */
readonly class SubscriptionResponse extends APIResponse
{
    /**
     * SubscriptionResponse constructor.
     *
     * @param int $status HTTP status code.
     * @param bool $success Indicates if the operation succeeded.
     * @param string|null $message Response message.
     * @param array<string, string>|null $errors Validation or business errors.
     * @param array<string, mixed>|null $subscriber Subscriber public data.
     * @param bool|null $reminderAlreadyExists Flag indicating duplicate subscription.
     * @param bool|null $reminderNotFound Flag indicating missing subscription or subscriber.
     */
    public function __construct(
        int $status,
        bool $success,
        ?string $message = null,
        ?array $errors = null,
        public ?array $subscriber = null,
        public ?bool $reminderAlreadyExists = null,
        public ?bool $reminderNotFound = null,
    ) {
        parent::__construct($status, $success, $message, $errors);
    }

    /**
     * Get the payload for the subscription response.
     *
     * @return array The payload containing success, message, errors, subscriber data, and flags.
     */
    public function getPayload(): array
    {
        $superPayload = parent::getPayload();

        $payload = array_filter([
            'subscriber' => $this->subscriber,
            'reminderAlreadyExists' => $this->reminderAlreadyExists,
            'reminderNotFound' => $this->reminderNotFound,
        ], fn ($value) => $value !== null);

        return array_merge($superPayload, $payload);
    }
}