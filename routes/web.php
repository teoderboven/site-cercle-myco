<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'display'])->name('home');
Route::get('/activites', [ActivityController::class, 'publicDisplay'])->name('activities');
Route::get('/activites/{id}', [ActivityController::class, 'redirectToHash'])->name('activityDetail');
Route::get('/excursions', function () {
	return view('excursions');
})->name('excursions');
// TODO: exclude cookie middleware for /excursions/xx/abc
//		 ->withoutMiddleware([CheckCookiesAccepted::class])

Route::view('/publications', 'publications')->name('publications');
Route::view('/devenir-membre', 'member')->name('member');
Route::view('/champi-parasite-des-plantes', 'champi-parasite')->name('parasites');

Route::view('/error/403', 'errors.403');
Route::view('/error/404', 'errors.404');
Route::view('/error/500', 'errors.500');
