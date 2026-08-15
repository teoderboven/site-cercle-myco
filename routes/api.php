<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityNotificationController;

// AJAX routes
Route::post('/activity/{activity}/notifications', [ActivityNotificationController::class, 'register'])
    ->name('activity.notifications.store');
Route::delete('/activity/{activity}/notifications', [ActivityNotificationController::class, 'unregister'])
    ->name('activity.notifications.destroy');

Route::get('/subscriber/{subscriber}/activities', [ActivityNotificationController::class, 'getSubscribedActivities'])
    ->name('subscriber.activities.index');