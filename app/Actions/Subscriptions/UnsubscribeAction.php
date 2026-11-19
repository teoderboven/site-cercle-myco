<?php

namespace App\Actions\Subscriptions;

use App\DTOs\API\SubscriptionResponse;
use App\Models\MailSubscriber;
use App\Services\SubscriptionResponseService;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UnsubscribeAction
 *
 * This action handles the unsubscribe of a subscriber from a specific subscription.
 */
readonly class UnsubscribeAction
{
    public function __construct(
        private SubscriptionResponseService $responseService
    ) {}

    /**
     * Execute the subscription unsubscribe process.
     *
     * @param array $subscriberData The data used to identify the subscriber.
     * @param Model $targetable The targetable model instance (e.g., Activity or ActivitySeason).
     * @param string $targetForeignKey The foreign key used to identify the targetable model.
     * @param string $subscriptionModelClass The class name of the subscription model.
     * @param string $notSubscribedLangKey The language key for the not subscribed message.
     * @param string $successLangKey The language key for the success message.
     * @return SubscriptionResponse The response data indicating the result of the unregistration process.
     */
    public function execute(
            array $subscriberData,
            Model $targetable,
            string $targetForeignKey,
            string $subscriptionModelClass,
            string $notSubscribedLangKey,
            string $successLangKey
        ): SubscriptionResponse
    {
        $subscriber = $this->findSubscriber($subscriberData);

        if (!$subscriber) {
            return $this->responseService->subscriberNotFound();
        }

        $subscription = $this->findSubscription($subscriptionModelClass, $targetForeignKey, $targetable, $subscriber);

        if (!$subscription) {
            return $this->notSubscribedResponse($notSubscribedLangKey);
        }

        $subscription->delete();

        return $this->successResponse($subscriber, $successLangKey);
    }

    /**
     * Find a subscriber based on the provided data.
     *
     * @param array $subscriberData The data used to find the subscriber.
     * @return MailSubscriber|null The found subscriber or null if not found.
     */
    private function findSubscriber(array $subscriberData): ?MailSubscriber
    {
        return MailSubscriber::where('id', $subscriberData['id'])
            ->where('email', $subscriberData['email'])
            ->where('token', $subscriberData['token'])
            ->first();
    }

    /**
     * Find a subscription based on the provided parameters.
     *
     * @param string $subscriptionModelClass The class name of the subscription model.
     * @param string $targetForeignKey The foreign key used to identify the targetable model.
     * @param Model $targetable The targetable model instance.
     * @param MailSubscriber $subscriber The subscriber instance.
     * @return Model|null The found subscription or null if not found.
     */
    private function findSubscription(string $subscriptionModelClass, string $targetForeignKey, Model $targetable, MailSubscriber $subscriber): ?Model
    {
        return $subscriptionModelClass::where($targetForeignKey, $targetable->id)
            ->where('subscriber_id', $subscriber->id)
            ->first();
    }

    /**
     * Generate a response indicating that the subscriber is not subscribed.
     *
     * @param string $notSubscribedLangKey The language key for the not subscribed message.
     * @return SubscriptionResponse The response data.
     */
    private function notSubscribedResponse(string $notSubscribedLangKey): SubscriptionResponse
    {
        return new SubscriptionResponse(
            status: 404,
            success: false,
            message: __($notSubscribedLangKey),
            reminderNotFound: true
        );
    }

    /**
     * Generate a response indicating successful unregistration.
     *
     * @param MailSubscriber $subscriber The subscriber instance.
     * @param string $successLangKey The language key for the success message.
     * @return SubscriptionResponse The response data.
     */
    private function successResponse(MailSubscriber $subscriber, string $successLangKey): SubscriptionResponse
    {
        return new SubscriptionResponse(
            status: 200,
            success: true,
            message: __($successLangKey, ['email' => $subscriber->email])
        );
    }
}