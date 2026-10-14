<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| All routes for the Tailor Shop Order Tracking System are defined here.
| Routes are added phase by phase. Each phase will add more routes.
|
| Route structure:
| Route::get('/url', [Controller::class, 'method'])->name('route.name');
|
| Middleware:
| 'auth'       → only logged-in users can access
| 'guest'      → only NOT logged-in users can access (login page)
| 'role:admin' → only admin role can access
| 'role:admin,staff' → admin OR staff can access
|
*/

// ─── Root Redirect ────────────────────────────────────────────────────────────
// When someone visits /, redirect to dashboard (if logged in) or login
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// ─── Authentication Routes ────────────────────────────────────────────────────
// Only accessible when NOT logged in (middleware: guest)
Route::middleware('guest')->group(function () {
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Logout (must be logged in to logout)
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ─── Protected Routes (must be logged in) ────────────────────────────────────
Route::middleware('auth')->group(function () {

    // Dashboard — accessible by both admin and staff
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ─── Admin-only routes will be added here in upcoming phases ──────────
    // Phase 4: Customer routes
    // Phase 5: Measurement routes
    // Phase 6: Garment routes
    // Phase 7: Order routes
    // Phase 8: Stage routes
    // Phase 9: Payment routes
    // Phase 11: Report + Notification routes

});
