<?php

namespace App\Actions\Subscriptions;

use App\DTOs\API\SubscriptionResponse;
use App\Models\MailSubscriber;
use App\Services\SubscriberMailService;
use App\Services\SubscriptionResponseService;
use Illuminate\Support\Facades\Log;

/**
 * Class SubscribeAction
 *
 * This action handles the registration of a subscriber to a specific subscription.
 */
readonly class SubscribeAction
{
    public function __construct(
        private SubscriberMailService       $mailService,
        private SubscriptionResponseService $responseService
    ) {}

    /**
     * Execute the subscription registration process.
     *
     * @param string $email The email of the subscriber.
     * @param string|int|null $targetId The ID of the target model.
     * @param string $targetForeignKey The foreign key used to identify the targetable model.
     * @param string $subscriptionModelClass The class name of the subscription model.
     * @param string $alreadyExistsLangKey The language key for the already exists message.
     * @param string $registeredLangKey The language key for the registered message.
     * @return SubscriptionResponse The response data indicating the result of the registration process.
     */
    public function execute(
            string $email,
            string|int|null $targetId,
            string $targetForeignKey,
            string $subscriptionModelClass,
            string $alreadyExistsLangKey,
            string $registeredLangKey
        ): SubscriptionResponse
    {
        $subscriber = $this->getOrCreateSubscriber($email);

        if ($subscriber->bounced) {
            return $this->responseService->bounced($subscriber);
        }

        $wasUnsubscribed = (bool) $subscriber->unsubscribed; // bool cast is necessary because the value can be null in the database, but we want to treat it as false in that case.
        if ($wasUnsubscribed) {
            $subscriber->resubscribe();
        }

        if ($this->subscriptionExists($subscriptionModelClass, $targetForeignKey, $targetId, $subscriber)) {
            return $this->alreadyExistsResponse($subscriber, $targetId, $alreadyExistsLangKey);
        }

        $this->createSubscription($subscriptionModelClass, $targetForeignKey, $targetId, $subscriber);

        $this->handleWelcomeEmail($subscriber, $wasUnsubscribed);

        return $this->successResponse($subscriber, $registeredLangKey);
    }

    /**
     * Get or create a subscriber based on the provided email.
     *
     * @param string $email The email of the subscriber.
     * @return MailSubscriber The found or newly created subscriber.
     */
    private function getOrCreateSubscriber(string $email): MailSubscriber
    {
        return MailSubscriber::firstOrCreate([
            'email' => $email,
        ]);
    }

    /**
     * Check if a subscription already exists for the given parameters.
     *
     * @param string $subscriptionModelClass The class name of the subscription model.
     * @param string $targetForeignKey The foreign key used to identify the targetable model.
     * @param string|int|null $targetId The ID of the target model.
     * @param MailSubscriber $subscriber The subscriber instance.
     * @return bool True if the subscription exists, false otherwise.
     */
    private function subscriptionExists(string $subscriptionModelClass, string $targetForeignKey, string|int|null $targetId, MailSubscriber $subscriber): bool
    {
        return $subscriptionModelClass::where($targetForeignKey, $targetId)
            ->where('subscriber_id', $subscriber->id)
            ->exists();
    }

    /**
     * Create a new subscription for the given parameters.
     *
     * @param string $subscriptionModelClass The class name of the subscription model.
     * @param string $targetForeignKey The foreign key used to identify the targetable model.
     * @param string|int|null $targetId The ID of the target model.
     * @param MailSubscriber $subscriber The subscriber instance.
     */
    private function createSubscription(string $subscriptionModelClass, string $targetForeignKey, string|int|null $targetId, MailSubscriber $subscriber): void
    {
        $subscriptionModelClass::create([
            $targetForeignKey => $targetId,
            'subscriber_id' => $subscriber->id,
        ]);
    }

    /**
     * Handle sending a welcome email to the subscriber if they were newly created or resubscribed.
     *
     * @param MailSubscriber $subscriber The subscriber instance.
     * @param bool $wasUnsubscribed Indicates if the subscriber was previously unsubscribed.
     */
    private function handleWelcomeEmail(MailSubscriber $subscriber, bool $wasUnsubscribed): void
    {
        if ($subscriber->wasRecentlyCreated || $wasUnsubscribed) {
            dispatch(function () use ($subscriber) {
                $this->mailService->sendWelcomeMail($subscriber);
            })->afterResponse();
        }
    }

    /**
     * Generate a response indicating that the subscription already exists.
     *
     * @param MailSubscriber $subscriber The subscriber instance.
     * @param string|int|null $targetId The ID of the target model.
     * @param string $alreadyExistsLangKey The language key for the already exists message.
     * @return SubscriptionResponse The response data.
     */
    private function alreadyExistsResponse(MailSubscriber $subscriber, string|int|null $targetId, string $alreadyExistsLangKey): SubscriptionResponse
    {
        Log::alert(sprintf(
            'Subscriber %s (ID: %s) attempted to register for target %s but is already subscribed.',
            $subscriber->email,
            $subscriber->id,
            $targetId
        ));

        return new SubscriptionResponse(
            status: 409,
            success: false,
            message: __($alreadyExistsLangKey, ['email' => $subscriber->email]),
            subscriber: $subscriber->only(['id', 'email', 'token']),
            reminderAlreadyExists: true
        );
    }

    /**
     * Generate a response indicating a successful subscription.
     *
     * @param MailSubscriber $subscriber The subscriber instance.
     * @param string $registeredLangKey The language key for the registered message.
     * @return SubscriptionResponse The response data.
     */
    private function successResponse(MailSubscriber $subscriber, string $registeredLangKey): SubscriptionResponse
    {
        return new SubscriptionResponse(
            status: 201,
            success: true,
            message: __($registeredLangKey, ['email' => $subscriber->email]),
            subscriber: $subscriber->only(['id', 'email', 'token'])
        );
    }
}
