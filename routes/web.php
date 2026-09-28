<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// This creates the Login, Register, Logout routes
Auth::routes();

// Dashboard route with auth protection
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

// Missing Persons Routes
Route::get('/missing', [App\Http\Controllers\MissingPersonController::class, 'index'])->name('missing.index');
Route::get('/missing/create', [App\Http\Controllers\MissingPersonController::class, 'create'])->name('missing.create');
Route::post('/missing', [App\Http\Controllers\MissingPersonController::class, 'store'])->name('missing.store');

// New Routes for Edit, Update, Delete
Route::get('/missing/{person}/edit', [App\Http\Controllers\MissingPersonController::class, 'edit'])->name('missing.edit');
Route::put('/missing/{person}', [App\Http\Controllers\MissingPersonController::class, 'update'])->name('missing.update');
Route::delete('/missing/{person}', [App\Http\Controllers\MissingPersonController::class, 'destroy'])->name('missing.destroy');
// Disaster Map Routes
Route::get('/disasters', [App\Http\Controllers\DisasterReportController::class, 'index'])->name('disasters.index');
Route::get('/disasters/create', [App\Http\Controllers\DisasterReportController::class, 'create'])->name('disasters.create');
Route::post('/disasters', [App\Http\Controllers\DisasterReportController::class, 'store'])->name('disasters.store');
Route::get('/disasters/{disaster}/edit', [App\Http\Controllers\DisasterReportController::class, 'edit'])->name('disasters.edit');
Route::put('/disasters/{disaster}', [App\Http\Controllers\DisasterReportController::class, 'update'])->name('disasters.update');
Route::delete('/disasters/{disaster}', [App\Http\Controllers\DisasterReportController::class, 'destroy'])->name('disasters.destroy');

// Relief Materials Routes
Route::get('/relief', [App\Http\Controllers\ReliefMaterialController::class, 'index'])->name('relief.index');
Route::get('/relief/create', [App\Http\Controllers\ReliefMaterialController::class, 'create'])->name('relief.create');
Route::post('/relief', [App\Http\Controllers\ReliefMaterialController::class, 'store'])->name('relief.store');
Route::get('/relief/{material}/edit', [App\Http\Controllers\ReliefMaterialController::class, 'edit'])->name('relief.edit');
Route::put('/relief/{material}', [App\Http\Controllers\ReliefMaterialController::class, 'update'])->name('relief.update');
Route::delete('/relief/{material}', [App\Http\Controllers\ReliefMaterialController::class, 'destroy'])->name('relief.destroy');
// Donations Routes
Route::get('/donations', [App\Http\Controllers\DonationController::class, 'index'])->name('donations.index');
Route::get('/donations/create', [App\Http\Controllers\DonationController::class, 'create'])->name('donations.create');
Route::post('/donations', [App\Http\Controllers\DonationController::class, 'store'])->name('donations.store');
Route::get('/donations/{donation}/edit', [App\Http\Controllers\DonationController::class, 'edit'])->name('donations.edit');
Route::put('/donations/{donation}', [App\Http\Controllers\DonationController::class, 'update'])->name('donations.update');
Route::delete('/donations/{donation}', [App\Http\Controllers\DonationController::class, 'destroy'])->name('donations.destroy');
// Alerts Routes
Route::get('/alerts', [App\Http\Controllers\AlertController::class, 'index'])->name('alerts.index');
Route::get('/alerts/create', [App\Http\Controllers\AlertController::class, 'create'])->name('alerts.create');
Route::post('/alerts', [App\Http\Controllers\AlertController::class, 'store'])->name('alerts.store');
// Weather Report Routes
Route::get('/weather', [App\Http\Controllers\WeatherReportController::class, 'index'])->name('weather.index');
Route::get('/weather/create', [App\Http\Controllers\WeatherReportController::class, 'create'])->name('weather.create');
Route::post('/weather', [App\Http\Controllers\WeatherReportController::class, 'store'])->name('weather.store');
Route::delete('/weather/{report}', [App\Http\Controllers\WeatherReportController::class, 'destroy'])->name('weather.destroy');