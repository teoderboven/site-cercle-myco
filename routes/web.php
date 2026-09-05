<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriptionController;

// Dynamic views routes

Route::get('/', [HomeController::class, 'display'])->name('home');
Route::get('/activites', [ActivityController::class, 'publicDisplay'])->name('activities');
Route::get('/activites/{id}', [ActivityController::class, 'redirectToHash'])->name('activityDetail');
Route::get('/excursions', function () {
	return view('pages.excursions.index');
})->name('excursions');
// TODO: exclude cookie middleware for /excursions/xx/abc
//		 ->withoutMiddleware([CheckCookiesAccepted::class])

// Special routes

Route::get('/unsubscribe/{subId}/{token}', [SubscriptionController::class, 'unsubscribe'])->name('unsubscribe');

// Simple views routes

Route::view('/publications', 'pages.publications.index')->name('publications');
Route::view('/devenir-membre', 'pages.member.index')->name('member');
Route::view('/champi-parasite-des-plantes', 'pages.champi-parasite.index')->name('parasites');

Route::view('/error/403', 'errors.403');
Route::view('/error/404', 'errors.404');
Route::view('/error/500', 'errors.500');

if (app()->environment('local')) {
    Route::prefix('mail')->group(function () {
        Route::get('/welcome', [MailPreviewController::class, 'welcome'])->name('mail.welcome');
    });
}
