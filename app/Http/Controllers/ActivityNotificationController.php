<?php

namespace App\Http\Controllers;

use App\Actions\Subscriptions\RegisterAction;
use App\Actions\Subscriptions\UnregisterAction;
use App\Http\Requests\NotificationRegisterRequest;
use App\Http\Requests\NotificationUnregisterRequest;
use App\Http\Requests\GetActivityNotificationSubscriptionsRequest;
use App\Models\Activity;
use App\Models\ActivityNotificationSubscription;
use App\Models\MailSubscriber;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

/**
 * Class ActivityNotificationController
 *
 * Controller responsible for handling activity notification subscriptions and sending reminders.
 */
class ActivityNotificationController extends Controller{

    /**
     * ActivityNotificationController constructor.
     *
     * @param RegisterAction $registerAction The action responsible for registering subscribers.
     * @param UnregisterAction $unregisterAction The action responsible for unregistering subscribers.
     */
    public function __construct(
        private readonly RegisterAction $registerAction,
        private readonly UnregisterAction $unregisterAction
    ) {}

    /**
     * Register a subscriber to an activity notification subscription.
     *
     * @param NotificationRegisterRequest $req The incoming HTTP request containing email and activity parameters.
     * @param Activity $activity The activity for which the notification subscription is being registered.
     * @return Responsable JSON response with subscription status and subscriber details (201 Created or 409 Conflict).
     *
     */
    public function register(NotificationRegisterRequest $req, Activity $activity): Responsable
    {
        return $this->registerAction->execute(
            email: $req->validated('email'),
            targetable: $activity,
            targetForeignKey: 'activity_id',
            subscriptionModelClass: ActivityNotificationSubscription::class,
            alreadyExistsLangKey: 'subscription.alreadySubscribedToActivity',
            registeredLangKey: 'subscription.registeredToActivity'
        );
    }

    /**
     * Unregister a subscriber from an activity notification subscription.
     *
     * @param NotificationUnregisterRequest $req The incoming HTTP request containing subscriber details.
     * @param Activity $activity The activity for which the notification subscription is being unregistered.
     * @return Responsable JSON response with unregistration status (200 OK or 404 Not Found).
     *
     */
    public function unregister(NotificationUnregisterRequest $req, Activity $activity): Responsable
    {
        return $this->unregisterAction->execute(
            subscriberData: $req->validated('subscriber'),
            targetable: $activity,
            targetForeignKey: 'activity_id',
            subscriptionModelClass: ActivityNotificationSubscription::class,
            notSubscribedLangKey: 'subscription.notSubscribedToActivity',
            successLangKey: 'subscription.unregisteredToActivity'
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

        return response()->json([
            'success' => true,
            'activityIds' => $activityIds,
        ]);
    }

}
