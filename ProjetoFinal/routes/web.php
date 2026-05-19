<?php

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

Route::get('/dashboard', function () {
    return Inertia::render('auth/Dashboard');
})->name('dashboard');

Route::get('/register', function () {
    return Inertia::render('auth/Register');
})->name('register');

require __DIR__.'/settings.php';
