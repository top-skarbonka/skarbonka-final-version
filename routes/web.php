<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CompanyAuthController;
use App\Http\Controllers\PointDemoController;

// ==========================
// STRONA GŁÓWNA
// ==========================
Route::get('/', function () {
    return view('welcome');
});

// ==========================
// DASHBOARD użytkownika (Breeze, zwykli userzy)
// ==========================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==========================
// PROFIL użytkownika (Breeze)
// ==========================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================
// POSTY (przykład testowy)
// ==========================
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// ==========================
// PANEL ADMINA
// ==========================

// Logowanie admina
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Dashboard admina
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// ==========================
// ZARZĄDZANIE FIRMAMI (ADMIN)
// ==========================
Route::prefix('admin/companies')->group(function () {
    Route::get('/', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('/{company}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::put('/{company}', [CompanyController::class, 'update'])->name('companies.update');
    Route::delete('/{company}', [CompanyController::class, 'destroy'])->name('companies.destroy');
});

// ==========================
// PANEL FIRMY (LOGOWANIE)
// ==========================
Route::get('/company/login', [CompanyAuthController::class, 'showLoginForm'])->name('company.login');
Route::post('/company/login', [CompanyAuthController::class, 'login'])->name('company.login.submit');
Route::post('/company/logout', [CompanyAuthController::class, 'logout'])->name('company.logout');

Route::get('/company/dashboard', function () {
    return view('company.dashboard');
})->middleware('auth:company')->name('company.dashboard');

// ==========================
// AUTH (Breeze, zwykli userzy)
// ==========================
require __DIR__.'/auth.php';

// ==========================
// DEMO PRZYZNAWANIA PUNKTÓW
// ==========================
Route::get('/points-demo', [PointDemoController::class, 'index']);
Route::post('/points-demo', [PointDemoController::class, 'store']);
