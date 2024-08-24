<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityReminderController;

// Dynamic views routes

Route::get('/', function () {
	return view('home');
})->name('home');
Route::get('/activites', [ActivityController::class, 'publicDisplay'])->name('activities');
Route::get('/activites/{id}', [ActivityController::class, 'redirectToHash']);
Route::get('/excursions', function () {
	return view('excursions');
});

// AJAX routes

Route::post('/activites/rappel', [ActivityReminderController::class, 'register']);

// Simple views routes

Route::view('/publications', 'publications');
Route::view('/devenir-membre', 'member');
Route::view('/champi-parasite-des-plantes', 'champi-parasite');

Route::view('/error/403', 'errors.403');
Route::view('/error/404', 'errors.404');
Route::view('/error/500', 'errors.500');
