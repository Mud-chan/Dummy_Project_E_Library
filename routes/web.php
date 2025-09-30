<?php

// web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\BukuPengunjungController;

Route::get('/', function () {
    return view('index');
});


// Register & Login
Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

// // Dashboard umum (role dicek di controller)
// Route::get('/petugas/dashboard', [AuthController::class, 'dashboardPetugas'])
//     ->name('dashboard.petugas')
//     ->middleware('auth');



// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Profile
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile.show');
Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');

Route::get('/profile/pengunjung', [AuthController::class, 'showProfilePengunjung'])->name('profile.show.pengunjung');
Route::put('/profile/pengunjung', [AuthController::class, 'updateProfilePengunjung'])->name('profile.update.pengunjung');



Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard-petugas', [BukuController::class, 'index'])->name('dashboard.petugas');
    Route::get('/koleksi-petugas', [BukuController::class, 'koleksi'])->name('koleksi.petugas');
    Route::get('/tambah-buku', [BukuController::class, 'show_tambah_buku'])->name('tambah.buku');
    Route::post('/upload-buku', [BukuController::class, 'upload_buku'])->name('upload.buku');
    Route::get('/buku/{id_buku}/edit', [BukuController::class, 'show_edit_buku'])->name('edit.buku');
    Route::put('/update-buku/{id_buku}', [BukuController::class, 'update_buku'])->name('update.buku');
    Route::delete('/hapus-buku/{id_buku}', [BukuController::class, 'delete_buku'])->name('hapus.buku');
    Route::get('/buku/{id_buku}/detail', [BukuController::class, 'detail_buku'])->name('buku.detail');
    Route::get('/cari-buku', [BukuController::class, 'cari_buku'])->name('cari.buku');
    Route::get('/detail-genre-petugas', [BukuController::class, 'show_genre'])->name('genre.detail');
    Route::get('/tambah-genre', [BukuController::class, 'show_tambah_genre'])->name('genre.tambah');
    Route::post('/genre/store', [BukuController::class, 'genre_store'])->name('genre.store');
    Route::get('/genre/{id}/edit', [BukuController::class, 'show_edit_genre'])->name('genre.edit');
    Route::put('/update-genre/{id}', [BukuController::class, 'genre_update'])->name('genre.update');
    Route::delete('/genre/{id}', [BukuController::class, 'hapus_genre'])->name('genre.hapus');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard-pengunjung', [BukuPengunjungController::class, 'index'])->name('dashboard.pengunjung');
    Route::get('/koleksi-pengunjung', [BukuPengunjungController::class, 'koleksi'])->name('koleksi.pengunjung');
    Route::get('/buku/{id_buku}/detail/pengunjung', [BukuPengunjungController::class, 'detail_buku'])->name('buku.detail.pengunjung');
    Route::get('/cari-buku-pengunjung', [BukuPengunjungController::class, 'cari_buku'])->name('cari.buku.pengunjung');
    Route::get('/detail-genre-pengunjung', [BukuPengunjungController::class, 'show_genre'])->name('genre.detail.pengunjung');
    Route::post('/buku/{id_buku}/pinjam', [BukuPengunjungController::class, 'pinjam'])->name('buku.pinjam');
    Route::get('/riwayat-pinjam', [BukuPengunjungController::class, 'riwayat_pinjam'])->name('riwayat.pinjam.pengunjung');

});
