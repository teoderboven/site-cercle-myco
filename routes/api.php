<?php

use App\Http\Controllers\SeasonNotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityNotificationController;
use App\Http\Controllers\Cron\ActivityRemindersCronController;

// AJAX routes
Route::post('/activity/{activity}/notifications', [ActivityNotificationController::class, 'subscribe'])
    ->name('activity.notifications.store');
Route::delete('/activity/{activity}/notifications', [ActivityNotificationController::class, 'unsubscribe'])
    ->name('activity.notifications.destroy');
Route::post('/season/upcoming/notifications', [SeasonNotificationController::class, 'subscribe'])
    ->name('season.upcoming.notifications.store');
Route::delete('/season/upcoming/notifications', [SeasonNotificationController::class, 'unsubscribe'])
    ->name('season.upcoming.notifications.destroy');

Route::get('/subscriber/{subscriber}/activities', [ActivityNotificationController::class, 'getSubscribedActivities'])
    ->name('subscriber.activities.index');


Route::middleware(['cron.auth', 'throttle:cron-limit'])->prefix('cron')->group(function () {
    Route::post('/reminders/send', [ActivityRemindersCronController::class, 'sendPendingReminders'])
        ->name('reminders.send');
});
