<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('home');
});
Route::get('/activites', function () {
	return view('activities');
});
Route::get('/excursions', function () {
	return view('excursions');
});

Route::view('/publications', 'publications');
Route::view('/devenir-membre', 'member');
Route::view('/champi-parasite-des-plantes', 'champi-parasite');

// Route::view('/error/403', 'errors.403');
// Route::view('/error/404', 'errors.404');

Route::get('/error/403', function () {
    return response()->view('errors.403', [], 403);
});

Route::get('/error/404', function () {
    return response()->view('errors.404', [], 404);
});
