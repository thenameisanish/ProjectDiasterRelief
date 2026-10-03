<?php

use Illuminate\Support\Facades\Route;

// ==========================================
// PUBLIC ROUTES (User Side - No Login Required)
// ==========================================

// User Homepage
Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('user.home');
// User News Page
Route::get('/news', [App\Http\Controllers\FrontendController::class, 'newsIndex'])->name('user.news');

// API route for JavaScript to check alerts (MUST BE HERE AT THE TOP)
Route::get('/check-latest-alert', [App\Http\Controllers\FrontendController::class, 'checkAlert'])->name('check.alert');

// User viewing public data
Route::get('/missing', [App\Http\Controllers\MissingPersonController::class, 'index'])->name('missing.index');
Route::get('/shelters', [App\Http\Controllers\FrontendController::class, 'searchShelters'])->name('user.shelters');

// User Submissions
Route::get('/missing/create', [App\Http\Controllers\MissingPersonController::class, 'create'])->name('missing.create');
Route::post('/missing', [App\Http\Controllers\MissingPersonController::class, 'store'])->name('missing.store');

Route::get('/disasters/create', [App\Http\Controllers\DisasterReportController::class, 'create'])->name('disasters.create');
Route::post('/disasters', [App\Http\Controllers\DisasterReportController::class, 'store'])->name('disasters.store');

Route::get('/aid-requests/create', [App\Http\Controllers\AidRequestController::class, 'create'])->name('aid_requests.create');
Route::post('/aid-requests', [App\Http\Controllers\AidRequestController::class, 'store'])->name('aid_requests.store');

Route::get('/donations/create', [App\Http\Controllers\DonationController::class, 'create'])->name('donations.create');
Route::post('/donations', [App\Http\Controllers\DonationController::class, 'store'])->name('donations.store');
// API route for JavaScript to get live alerts list
Route::get('/api/latest-alerts', [App\Http\Controllers\FrontendController::class, 'getLatestAlerts'])->name('api.alerts');
// Public Disaster Map
Route::get('/disaster-map', [App\Http\Controllers\FrontendController::class, 'disasterMap'])->name('user.disasters');

Auth::routes();


// ==========================================
// ADMIN ROUTES (Protected - Login Required)
// ==========================================
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Disasters Management
    Route::get('/disasters', [App\Http\Controllers\DisasterReportController::class, 'index'])->name('disasters.index');
    Route::get('/disasters/{disaster}/edit', [App\Http\Controllers\DisasterReportController::class, 'edit'])->name('disasters.edit');
    Route::put('/disasters/{disaster}', [App\Http\Controllers\DisasterReportController::class, 'update'])->name('disasters.update');
    Route::delete('/disasters/{disaster}', [App\Http\Controllers\DisasterReportController::class, 'destroy'])->name('disasters.destroy');

    // Missing Persons Management (Edit/Delete)
    Route::get('/missing/{person}/edit', [App\Http\Controllers\MissingPersonController::class, 'edit'])->name('missing.edit');
    Route::put('/missing/{person}', [App\Http\Controllers\MissingPersonController::class, 'update'])->name('missing.update');
    Route::delete('/missing/{person}', [App\Http\Controllers\MissingPersonController::class, 'destroy'])->name('missing.destroy');
    
    // Relief Materials Management
    Route::get('/relief', [App\Http\Controllers\ReliefMaterialController::class, 'index'])->name('relief.index');
    Route::get('/relief/create', [App\Http\Controllers\ReliefMaterialController::class, 'create'])->name('relief.create');
    Route::post('/relief', [App\Http\Controllers\ReliefMaterialController::class, 'store'])->name('relief.store');
    Route::get('/relief/{material}/edit', [App\Http\Controllers\ReliefMaterialController::class, 'edit'])->name('relief.edit');
    Route::put('/relief/{material}', [App\Http\Controllers\ReliefMaterialController::class, 'update'])->name('relief.update');
    Route::delete('/relief/{material}', [App\Http\Controllers\ReliefMaterialController::class, 'destroy'])->name('relief.destroy');

       // Donations Management
    Route::get('/donations/export/csv', [App\Http\Controllers\DonationController::class, 'exportCsv'])->name('donations.exportCsv'); // <-- ADD THIS
    Route::get('/donations', [App\Http\Controllers\DonationController::class, 'index'])->name('donations.index');
    Route::get('/donations/{donation}/edit', [App\Http\Controllers\DonationController::class, 'edit'])->name('donations.edit');
    Route::put('/donations/{donation}', [App\Http\Controllers\DonationController::class, 'update'])->name('donations.update');
    Route::delete('/donations/{donation}', [App\Http\Controllers\DonationController::class, 'destroy'])->name('donations.destroy');
    // Holding Centers Management
    Route::get('/manage-shelters', [App\Http\Controllers\HoldingCenterController::class, 'index'])->name('shelters.index');
    Route::get('/manage-shelters/create', [App\Http\Controllers\HoldingCenterController::class, 'create'])->name('shelters.create');
    Route::post('/manage-shelters', [App\Http\Controllers\HoldingCenterController::class, 'store'])->name('shelters.store');
    Route::delete('/manage-shelters/{shelter}', [App\Http\Controllers\HoldingCenterController::class, 'destroy'])->name('shelters.destroy');

    // Aid Requests Management
    Route::get('/aid-requests', [App\Http\Controllers\AidRequestController::class, 'index'])->name('aid_requests.index');
    Route::get('/aid-requests/{id}/approve', [App\Http\Controllers\AidRequestController::class, 'approve'])->name('aid_requests.approve');

    // Alerts Management
    Route::get('/alerts', [App\Http\Controllers\AlertController::class, 'index'])->name('alerts.index');
    Route::get('/alerts/create', [App\Http\Controllers\AlertController::class, 'create'])->name('alerts.create');
    Route::post('/alerts', [App\Http\Controllers\AlertController::class, 'store'])->name('alerts.store');

    // Weather Reports Management
    Route::get('/weather', [App\Http\Controllers\WeatherReportController::class, 'index'])->name('weather.index');
    Route::get('/weather/create', [App\Http\Controllers\WeatherReportController::class, 'create'])->name('weather.create');
    Route::post('/weather', [App\Http\Controllers\WeatherReportController::class, 'store'])->name('weather.store');
    Route::delete('/weather/{report}', [App\Http\Controllers\WeatherReportController::class, 'destroy'])->name('weather.destroy');
    //payment verify
    Route::get('/donations/{id}/verify', [App\Http\Controllers\DonationController::class, 'verify'])->name('donations.verify');
        // Real-time API routes
    Route::get('/api/dashboard-stats', [App\Http\Controllers\HomeController::class, 'getStats'])->name('api.stats');
    Route::get('/api/disasters', [App\Http\Controllers\DisasterReportController::class, 'getDisasters'])->name('api.disasters');
    Route::get('/api/donations', [App\Http\Controllers\DonationController::class, 'getDonations'])->name('api.donations');
    // API route for JavaScript to get live news
Route::get('/api/news', [App\Http\Controllers\FrontendController::class, 'getNews'])->name('api.news');
    // Damage Assessment Routes
    Route::get('/damages', [App\Http\Controllers\DamageReportController::class, 'index'])->name('damages.index');
    Route::get('/damages/create', [App\Http\Controllers\DamageReportController::class, 'create'])->name('damages.create');
    Route::post('/damages', [App\Http\Controllers\DamageReportController::class, 'store'])->name('damages.store');
    Route::delete('/damages/{damage}', [App\Http\Controllers\DamageReportController::class, 'destroy'])->name('damages.destroy');
        // Damage Assessment PDF Route
    Route::get('/damages/pdf', [App\Http\Controllers\DamageReportController::class, 'downloadPDF'])->name('damages.pdf');

});