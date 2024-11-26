<?php

use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KembaliController as AdminKembaliController;
use App\Http\Controllers\Admin\PinjamController as AdminPinjamController;

use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\PinjamController as UserPinjamController;
use Illuminate\Support\Facades\Route;

// Login anggota
Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [AuthController::class, 'verify'])->name('auth.verify');

// Registrasi user
Route::get('/registrasi', [AuthController::class, 'registrasi'])->middleware('guest');
Route::post('/registrasi/store', [AuthController::class, 'store'])->name('registrasi.store');

// Middleware untuk melindungi admin
Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard.index');

    Route::get('/admin/anggota', [AnggotaController::class, 'index'])->name('admin.anggota.index');
    Route::delete('/admin/anggota/{idAnggota}', [AnggotaController::class, 'delete']);

    Route::get('/admin/buku', [BukuController::class, 'index'])->name('admin.buku.index');
    Route::get('/admin/buku/create', [BukuController::class, 'create']);
    Route::post('/admin/buku/store', [BukuController::class, 'store']);
    Route::get('/admin/buku/edit/{idBuku}', [BukuController::class, 'edit']);
    Route::put('/admin/buku/{idBuku}', [BukuController::class, 'update']);
    Route::delete('/admin/buku/{idBuku}', [BukuController::class, 'delete']);

    Route::get('/admin/pinjam', [AdminPinjamController::class, 'index'])->name('admin.pinjam.index');
    Route::post('/admin/pinjam/{id}/approve', [AdminPinjamController::class, 'approve'])->name('admin.pinjam.approve');
    Route::delete('/admin/pinjam/{id}', [AdminPinjamController::class, 'destroy'])->name('admin.pinjam.destroy');

    Route::get('/admin/kembali', [AdminKembaliController::class, 'index'])->name('admin.kembali.index');
    Route::post('/admin/kembali/{id}/approve', [AdminKembaliController::class, 'approve'])->name('admin.kembali.approve');
    Route::delete('/admin/kembali/{id}', [AdminKembaliController::class, 'destroy'])->name('admin.kembali.destroy');
});

// Middleware untuk melindungi user
Route::group(['middleware' => 'auth:user'], function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard.index');
    Route::get('/user/dashboard/{idBuku}', [UserDashboardController::class, 'detail'])->name('user.dashboard.detail');
    Route::post('/user/dashboard/{idBuku}', [UserDashboardController::class, 'pinjam'])->name('user.dashboard.pinjam');

    Route::get('/user/pinjam', [UserPinjamController::class, 'index'])->name('user.pinjam.index');
    Route::post('/user/pinjam/{id}/return', [UserPinjamController::class, 'return'])->name('user.return.book'); // route pengembalian buku
});

// Logout anggota
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
