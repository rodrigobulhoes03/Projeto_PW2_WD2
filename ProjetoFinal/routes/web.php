<?php

use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

Route::inertia('/', 'Welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

Route::get('/login', function () {
    return Inertia::render('auth/Login');
})->name('login');

Route::get('/dashboardAdmin', function () {
    return Inertia::render('auth/DashboardAdmin');
})->name('dashboardAdmin');

Route::resource('users', UserController::class);

Route::get('/dashboard', function () {
    return Inertia::render('auth/Dashboard');
})->name('dashboard');

Route::get('/history', function () {
    return Inertia::render('auth/HistoryDashboard');
})->name('history');

Route::get('/register', function () {
    return Inertia::render('auth/Register');
})->name('register');

Route::get('/quiz', function () {
    return Inertia::render('auth/Quiz');
})->name('quiz');


require __DIR__.'/settings.php';
