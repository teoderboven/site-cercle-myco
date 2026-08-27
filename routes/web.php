<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityNotificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriptionController;

// Dynamic views routes

Route::get('/', [HomeController::class, 'display'])->name('home');
Route::get('/activites', [ActivityController::class, 'publicDisplay'])->name('activities');
Route::get('/activites/{id}', [ActivityController::class, 'redirectToHash'])->name('activityDetail');
Route::get('/excursions', function () {
	return view('excursions');
})->name('excursions');
// TODO: exclude cookie middleware for /excursions/xx/abc
//		 ->withoutMiddleware([CheckCookiesAccepted::class])
//
//// Tasks (web cron) routes
//
//Route::middleware('throttle:3,1')->group(function () { // limit at 3 access/minute
//    Route::get('/tasks/send-activity-reminder-mails/{key}', [ActivityNotificationController::class, 'secureSendReminders']);
//});

// Special routes

Route::get('/unsubscribe/{subId}/{token}', [SubscriptionController::class, 'unsubscribe'])->name('unsubscribe');

// Simple views routes

Route::view('/publications', 'publications')->name('publications');
Route::view('/devenir-membre', 'member')->name('member');
Route::view('/champi-parasite-des-plantes', 'champi-parasite')->name('parasites');

Route::view('/error/403', 'errors.403');
Route::view('/error/404', 'errors.404');
Route::view('/error/500', 'errors.500');
