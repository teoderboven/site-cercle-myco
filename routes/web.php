<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('home');
});
Route::get('/activites', function () {
	return view('activities');
});
Route::get('/publications', function () {
	return view('publications');
});
Route::get('/excursions', function () {
	return view('excursions');
});
Route::get('/devenir-membre', function () {
	return view('member');
});
Route::get('/champi-parasite-des-plantes', function () {
	return view('champi-parasite');
});
