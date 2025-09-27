<?php

// web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('index');
});

// Register & Login
Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

// Dashboard umum (role dicek di controller)
Route::get('/petugas/dashboard', [AuthController::class, 'dashboardPetugas'])
    ->name('dashboard.petugas')
    ->middleware('auth');

Route::get('/pengunjung/dashboard', [AuthController::class, 'dashboardPengunjung'])
    ->name('dashboard.pengunjung')
    ->middleware('auth');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
