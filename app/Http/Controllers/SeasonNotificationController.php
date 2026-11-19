<?php

namespace App\Http\Controllers;

use App\Actions\Subscriptions\SubscribeAction;
use App\Actions\Subscriptions\UnsubscribeAction;
use App\Http\Requests\NotificationSubscribeRequest;
use App\Http\Requests\NotificationUnsubscribeRequest;
use App\Models\ActivitySeason;
use App\Models\ActivitySeasonNotificationSubscription;
use Illuminate\Contracts\Support\Responsable;

/**
 * Class SeasonNotificationController
 *
 * Controller responsible for handling season notification subscriptions.
 */
class SeasonNotificationController extends Controller
{
    public function __construct(
        private readonly SubscribeAction  $registerAction,
        private readonly UnsubscribeAction $unregisterAction
    ) {}

    /**
     * Register a subscriber to a season notification subscription.
     *
     * @param NotificationSubscribeRequest $req The incoming HTTP request containing email.
     * @param ActivitySeason $season The activity season for which the notification subscription is being registered.
     * @return Responsable JSON response with subscription status and subscriber details (201 Created or 409 Conflict).
     */
    public function subscribe(NotificationSubscribeRequest $req, ActivitySeason $season): Responsable
    {
        return $this->registerAction->execute(
            email: $req->validated('email'),
            targetable: $season,
            targetForeignKey: 'activity_season_id',
            subscriptionModelClass: ActivitySeasonNotificationSubscription::class,
            alreadyExistsLangKey: 'subscription.alreadySubscribedToSeason',
            registeredLangKey: 'subscription.subscribedToSeason'
        );
    }

    /**
     * Unregister a subscriber from a season notification subscription.
     *
     * @param NotificationUnsubscribeRequest $req The incoming HTTP request containing subscriber details.
     * @param ActivitySeason $season The activity season for which the notification subscription is being unregistered.
     * @return Responsable JSON response with unregistration status (200 OK or 404 Not Found).
     */
    public function unsubscribe(NotificationUnsubscribeRequest $req, ActivitySeason $season): Responsable
    {
        return $this->unregisterAction->execute(
            subscriberData: $req->validated('subscriber'),
            targetable: $season,
            targetForeignKey: 'activity_season_id',
            subscriptionModelClass: ActivitySeasonNotificationSubscription::class,
            notSubscribedLangKey: 'subscription.notSubscribedToSeason',
            successLangKey: 'subscription.unsubscribedFromSeason'
        );
    }
}
