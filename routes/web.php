<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientSettingsController;
use App\Http\Controllers\PointDemoController;
use App\Http\Controllers\CompanyRegisterController;
use App\Http\Controllers\CompanyAuthController;
use App\Http\Controllers\CompanyDashboardController;
use App\Http\Controllers\ClientDashboardController;

/*
|--------------------------------------------------------------------------
| PANEL KLIENTA (logowanie klasyczne)
|--------------------------------------------------------------------------
*/
Route::prefix('client')->group(function () {
    Route::get('/login', [ClientAuthController::class, 'showLoginForm'])->name('client.login');
    Route::post('/login', [ClientAuthController::class, 'login'])->name('client.login.submit');
    Route::post('/logout', [ClientAuthController::class, 'logout'])->name('client.logout');

    Route::get('/register', [ClientController::class, 'showRegisterForm'])->name('client.register');
    Route::post('/register', [ClientController::class, 'register'])->name('client.register.submit');
    Route::get('/qr/{id}', [ClientController::class, 'showQr'])->name('client.qr');

    Route::middleware('auth:client')->group(function () {
        Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');
        Route::get('/history', [ClientController::class, 'history'])->name('client.history');
        Route::get('/consents', [ClientSettingsController::class, 'edit'])->name('client.consents.edit');
        Route::post('/consents', [ClientSettingsController::class, 'update'])->name('client.consents.update');
    });
});

/*
|--------------------------------------------------------------------------
| PANEL KLIENTA (po kodzie QR)
|--------------------------------------------------------------------------
*/
Route::get('/panel-klienta', [ClientDashboardController::class, 'index'])->name('client.panel');
Route::post('/panel-klienta', [ClientDashboardController::class, 'login'])->name('client.login.qr');

/*
|--------------------------------------------------------------------------
| STRONA GŁÓWNA
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/company/login');
});

/*
|--------------------------------------------------------------------------
| PANEL ADMINA
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    // 🔓 Logowanie administratora
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    // 🔒 Panel po zalogowaniu
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    });
});

/*
|--------------------------------------------------------------------------
| PANEL FIRMY
|--------------------------------------------------------------------------
*/
Route::prefix('company')->group(function () {
    Route::get('/login', [CompanyAuthController::class, 'showLoginForm'])->name('company.login');
    Route::post('/login', [CompanyAuthController::class, 'login'])->name('company.login.submit');
    Route::post('/logout', [CompanyAuthController::class, 'logout'])->name('company.logout');

    Route::get('/register', [CompanyRegisterController::class, 'showForm'])->name('company.register');
    Route::post('/register', [CompanyRegisterController::class, 'store'])->name('company.register.store');

    Route::middleware('auth:company')->group(function () {
        Route::get('/dashboard', [CompanyDashboardController::class, 'index'])->name('company.dashboard');
        Route::post('/add-points', [CompanyDashboardController::class, 'addPoints'])->name('company.addPoints');
    });
});

/*
|--------------------------------------------------------------------------
| DEMO
|--------------------------------------------------------------------------
*/
Route::get('/points-demo', [PointDemoController::class, 'index']);
Route::post('/points-demo', [PointDemoController::class, 'store']);

/*
|--------------------------------------------------------------------------
| AUTH (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
