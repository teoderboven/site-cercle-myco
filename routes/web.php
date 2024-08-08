<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as Ctrl;

Route::get('/', function () {
	return view('home');
});
Route::get('/activites', [Ctrl\ActivityController::class, 'publicDisplay']);
Route::get('/excursions', function () {
	return view('excursions');
});

Route::view('/publications', 'publications');
Route::view('/devenir-membre', 'member');
Route::view('/champi-parasite-des-plantes', 'champi-parasite');

Route::view('/error/403', 'errors.403');
Route::view('/error/404', 'errors.404');
