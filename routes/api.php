<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityNotificationController;

// AJAX routes
Route::post('/activity/{activity}/notifications', [ActivityNotificationController::class, 'register'])
    ->name('activity.notifications.store');