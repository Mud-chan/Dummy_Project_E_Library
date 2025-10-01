<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\PeminjamanApiController;

// Auth
Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthApiController::class, 'profile']);
    Route::post('/update-profile', [AuthApiController::class, 'updateProfile']);
    Route::post('/logout', [AuthApiController::class, 'logout']);

    // Peminjaman
    Route::get('/riwayat-pinjam', [PeminjamanApiController::class, 'riwayatPinjam']);
});
