<?php

namespace App\Http\Controllers;

use App\Actions\Subscriptions\SubscribeAction;
use App\Actions\Subscriptions\UnsubscribeAction;
use App\Http\Requests\NotificationSubscribeRequest;
use App\Http\Requests\NotificationUnsubscribeRequest;
use App\Http\Requests\GetActivityNotificationSubscriptionsRequest;
use App\Models\Activity;
use App\Models\ActivityNotificationSubscription;
use App\Models\MailSubscriber;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

/**
 * Class ActivityNotificationController
 *
 * Controller responsible for handling activity notification subscriptions.
 */
class ActivityNotificationController extends Controller{

    /**
     * ActivityNotificationController constructor.
     *
     * @param SubscribeAction $subscribeAction The action responsible for registering subscribers.
     * @param UnsubscribeAction $unsubscribeAction The action responsible for unregistering subscribers.
     */
    public function __construct(
        private readonly SubscribeAction   $subscribeAction,
        private readonly UnsubscribeAction $unsubscribeAction
    ) {}

    /**
     * Register a subscriber to an activity notification subscription.
     *
     * @param NotificationSubscribeRequest $req The incoming HTTP request containing email and activity parameters.
     * @param Activity $activity The activity for which the notification subscription is being registered.
     * @return Responsable JSON response with subscription status and subscriber details (201 Created or 409 Conflict).
     *
     */
    public function subscribe(NotificationSubscribeRequest $req, Activity $activity): Responsable
    {
        return $this->subscribeAction->execute(
            email: $req->validated('email'),
            targetId: $activity->id,
            targetForeignKey: 'activity_id',
            subscriptionModelClass: ActivityNotificationSubscription::class,
            alreadyExistsLangKey: 'subscription.alreadySubscribedToActivity',
            registeredLangKey: 'subscription.subscribedToActivity'
        );
    }

    /**
     * Unregister a subscriber from an activity notification subscription.
     *
     * @param NotificationUnsubscribeRequest $req The incoming HTTP request containing subscriber details.
     * @param Activity $activity The activity for which the notification subscription is being unregistered.
     * @return Responsable JSON response with unregistration status (200 OK or 404 Not Found).
     *
     */
    public function unsubscribe(NotificationUnsubscribeRequest $req, Activity $activity): Responsable
    {
        return $this->unsubscribeAction->execute(
            subscriberData: $req->validated('subscriber'),
            targetId: $activity->id,
            targetForeignKey: 'activity_id',
            subscriptionModelClass: ActivityNotificationSubscription::class,
            notSubscribedLangKey: 'subscription.notSubscribedToActivity',
            successLangKey: 'subscription.unsubscribedFromActivity'
        );
    }

    /**
     * Get the list of activities a subscriber is subscribed to.
     *
     * @param GetActivityNotificationSubscriptionsRequest $req The incoming HTTP request containing subscriber details.
     * @param MailSubscriber $subscriber The subscriber for whom the activity subscriptions are being retrieved.
     * @return JsonResponse JSON response with the list of subscribed activities (200 OK or 401 Unauthorized).
     */
    public function getSubscribedActivities(GetActivityNotificationSubscriptionsRequest $req, MailSubscriber $subscriber): JsonResponse
    {
        // token transmitted via X-Subscriber-Token header
        if (!hash_equals($subscriber->token, $req->validated('token'))) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        if ($subscriber->bounced) {
            return response()->json([
                'success' => false,
                'message' => __('subscription.subscriberBounced', ['email' => $subscriber->email])
            ], 409);
        }

        $activityIds = $subscriber->activities()->pluck('activities.id');
        $seasonSubscribed = $subscriber->seasonSubscriptions()
            ->whereNull('activity_season_id')
            ->exists();

        return response()->json([
            'success' => true,
            'activityIds' => $activityIds,
            'seasonSubscribed' => $seasonSubscribed,
        ]);
    }

}
