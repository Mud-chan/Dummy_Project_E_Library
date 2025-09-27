<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;

// Auth API
Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);

// Route yang butuh login Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthApiController::class, 'logout']);

    Route::middleware('role:petugas')->get('/dashboard/petugas', function () {
        return response()->json(['message' => 'Halo Petugas']);
    });

    Route::middleware('role:pengunjung')->get('/dashboard/pengunjung', function () {
        return response()->json(['message' => 'Halo Pengunjung']);
    });
});
