// Dashboard firmy
Route::get('/company/dashboard', function () {
    return view('company.dashboard');
})->name('company.dashboard');
