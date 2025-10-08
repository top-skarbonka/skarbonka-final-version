<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CompanyAuthController;
use App\Http\Controllers\PointDemoController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientSettingsController;
use App\Http\Controllers\ClientAuthController;

/*
|--------------------------------------------------------------------------
| PANEL KLIENTA (priorytetowy)
|--------------------------------------------------------------------------
*/
Route::prefix('client')->group(function () {
    // 🔓 Publiczne — logowanie, rejestracja, QR
    Route::get('/login', [ClientAuthController::class, 'showLoginForm'])->name('client.login');
    Route::post('/login', [ClientAuthController::class, 'login'])->name('client.login.submit');
    Route::post('/logout', [ClientAuthController::class, 'logout'])->name('client.logout');

    Route::get('/register', [ClientController::class, 'showRegisterForm'])->name('client.register');
    Route::post('/register', [ClientController::class, 'register'])->name('client.register.submit');
    Route::get('/qr/{id}', [ClientController::class, 'showQr'])->name('client.qr');

    // 🔐 Zabezpieczone logowaniem
    Route::middleware('auth:client')->group(function () {
        Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');
        Route::get('/history', [ClientController::class, 'history'])->name('client.history');
        Route::get('/consents', [ClientSettingsController::class, 'edit'])->name('client.consents.edit');
        Route::post('/consents', [ClientSettingsController::class, 'update'])->name('client.consents.update');
    });
});

/*
|--------------------------------------------------------------------------
| STRONA GŁÓWNA (welcome)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| PANEL ADMINA
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

/*
|--------------------------------------------------------------------------
| PANEL FIRMY
|--------------------------------------------------------------------------
*/
Route::get('/company/login', [CompanyAuthController::class, 'showLoginForm'])->name('company.login');
Route::post('/company/login', [CompanyAuthController::class, 'login'])->name('company.login.submit');
Route::post('/company/logout', [CompanyAuthController::class, 'logout'])->name('company.logout');
Route::get('/company/dashboard', function () {
    return view('company.dashboard');
})->middleware('auth:company')->name('company.dashboard');

/*
|--------------------------------------------------------------------------
| DEMO PRZYZNAWANIA PUNKTÓW
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
