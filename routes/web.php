<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — Azora Solutions
|--------------------------------------------------------------------------
*/

// Public Page Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/plans', [PageController::class, 'plans'])->name('plans');
Route::get('/plans-services', [PageController::class, 'plansServices'])->name('plans.services');
Route::get('/portfolio', [PageController::class, 'portfolio'])->name('portfolio');
Route::get('/client-success', [PageController::class, 'portfolio'])->name('client.success');
Route::get('/quote', [PageController::class, 'quote'])->name('quote');
Route::get('/get-a-quote', [PageController::class, 'quote'])->name('get.quote');
Route::get('/success', [PageController::class, 'success'])->name('success');

// Removed Hardware routes — 301 redirect to services to preserve SEO health
Route::get('/hardware', function () {
    return redirect()->route('services', [], 301);
});
Route::get('/admin-inventory', function () {
    return redirect()->route('dashboard.index', [], 301);
});

// Lead & Quote Submissions (Web & AJAX with Rate Limiting)
Route::middleware(['throttle:10,1'])->group(function () {
    Route::post('/lead', [LeadController::class, 'store'])->name('lead.store');
    Route::post('/quote', [LeadController::class, 'store'])->name('quote.store');
    Route::post('/contact', [LeadController::class, 'store'])->name('contact.store');

    // API & Legacy Serverless Emulation
    Route::match(['get', 'post'], '/api/lead', [LeadController::class, 'store'])->name('api.lead');
    Route::match(['get', 'post'], '/.netlify/functions/send-lead-email', [LeadController::class, 'store'])->name('api.netlify.lead');
});

// Admin Guest Authentication Routes
Route::get('/dashboard/login', [DashboardController::class, 'login'])->name('dashboard.login');
Route::post('/dashboard/login', [DashboardController::class, 'authenticate'])->name('dashboard.authenticate');

// Protected Admin Command Center Routes
Route::middleware(['auth'])->group(function () {
    Route::post('/dashboard/logout', [DashboardController::class, 'logout'])->name('dashboard.logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/admin', function () {
        return redirect()->route('dashboard.index');
    });

    // Admin Lead Actions
    Route::post('/dashboard/lead/{id}/read', [LeadController::class, 'markRead'])->name('lead.markRead');
    Route::delete('/dashboard/lead/{id}', [LeadController::class, 'destroy'])->name('lead.destroy');
    Route::get('/dashboard/export', [LeadController::class, 'exportCsv'])->name('dashboard.export');
    Route::post('/dashboard/password', [DashboardController::class, 'updatePassword'])->name('dashboard.password');
});
