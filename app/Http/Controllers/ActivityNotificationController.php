<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityNotificationRegisterRequest;
use App\Http\Requests\ActivityNotificationUnregisterRequest;
use App\Http\Requests\GetActivityNotificationSubscriptionsRequest;
use App\Models\Activity;
use App\Models\ActivityNotificationSubscription;
use App\Models\MailSubscriber;
use App\Services\SubscriberMailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

/**
 * Class ActivityNotificationController
 *
 * Controller responsible for handling activity notification subscriptions and sending reminders.
 */
class ActivityNotificationController extends Controller{

    /**
     * ActivityNotificationController constructor.
     *
     * @param SubscriberMailService $mailService The service responsible for sending emails to subscribers.
     */
    public function __construct(
        private readonly SubscriberMailService $mailService
    ) {}

    /**
     * Register a subscriber to an activity notification subscription.
     *
     * @param ActivityNotificationRegisterRequest $req The incoming HTTP request containing email and activity parameters.
     * @param Activity $activity The activity for which the notification subscription is being registered.
     * @return JsonResponse JSON response with subscription status and subscriber details (201 Created or 409 Conflict).
     *
     * @throws ValidationException If request validation fails.
     */
    public function register(ActivityNotificationRegisterRequest $req, Activity $activity): JsonResponse
    {
        $subscriber = MailSubscriber::firstOrCreate([
            'email' => $req->validated('email'),
        ]);

        $wasUnsubscribed = $subscriber->unsubscribed;

        if ($wasUnsubscribed) {
            $subscriber->resubscribe();
        }

        // check if reminder already exists to handle conflict
        $subscriptionExists = ActivityNotificationSubscription::where('activity_id', $activity->id)
            ->where('subscriber_id', $subscriber->id)
            ->exists();

        if ($subscriptionExists) {
            Log::alert(sprintf(
                'Subscriber %s (ID: %s) attempted to register for activity %s (ID: %s) but is already subscribed.',
                $subscriber->email,
                $subscriber->id,
                $activity->title,
                $activity->id
            ));
            return response()->json([
                'success' => false,
                'reminderAlreadyExists' => true,
                'message' => __('subscription.subscriptionToActivityAlreadyExists', ['email' => $subscriber->email]),
                'subscriber' => $subscriber->only(['id', 'email', 'token']),
            ], 409);
        }

        ActivityNotificationSubscription::create([
            'activity_id' => $activity->id,
            'subscriber_id' => $subscriber->id,
        ]);

        if ($subscriber->wasRecentlyCreated || $wasUnsubscribed) {
            dispatch(function () use ($subscriber) {
                $this->mailService->sendWelcomeMail($subscriber);
            })->afterResponse();
        }

        return response()->json([
            'success' => true,
            'message' => __('subscription.registeredToActivity', ['email' => $subscriber->email]),
            'subscriber' => $subscriber->only(['id', 'email', 'token']),
        ], 201);
    }

    /**
     * Unregister a subscriber from an activity notification subscription.
     *
     * @param ActivityNotificationUnregisterRequest $req The incoming HTTP request containing subscriber details.
     * @param Activity $activity The activity for which the notification subscription is being unregistered.
     * @return JsonResponse JSON response with unregistration status (200 OK or 404 Not Found).
     *
     * @throws ValidationException If request validation fails.
     */
    public function unregister(ActivityNotificationUnregisterRequest $req, Activity $activity): JsonResponse
    {
        $subscriberData = $req->validated('subscriber');

        $subscriber = MailSubscriber::where('id', $subscriberData['id'])
            ->where('email', $subscriberData['email'])
            ->where('token', $subscriberData['token'])
            ->first();

        if(!$subscriber) {
            return response()->json([
                'success' => false,
                'reminderNotFound' => true,
                'message' => __('subscription.subscriberNotFound'),
            ], 404);
        }

        $subscription = ActivityNotificationSubscription::where('activity_id', $activity->id)
            ->where('subscriber_id', $subscriber->id)
            ->first();

        if (!$subscription) {
            return response()->json([
                'success' => false,
                'reminderNotFound' => true,
                'message' => __('subscription.notSubscribedToActivity'),
            ], 404);
        }

        $subscription->delete();

        return response()->json([
            'success' => true,
            'message' => __('subscription.unregisteredToActivity', ['email' => $subscriber->email]),
        ]);
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

        $activityIds = $subscriber->activities()->pluck('activities.id');

        return response()->json([
            'success' => true,
            'activityIds' => $activityIds,
        ]);
    }

}
