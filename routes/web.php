<?php

use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [AuthController::class, 'verify'])->name('auth.verify');

Route::get('/registrasi', [AuthController::class, 'registrasi'])->middleware('guest');
Route::post('/registrasi/store', [AuthController::class, 'store'])->name('registrasi.store');

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard.index');

    Route::get('/admin/buku', [BukuController::class, 'index'])->name('admin.buku.index');
    Route::get('/admin/buku/create', [BukuController::class, 'create']);
    Route::post('/admin/buku/store', [BukuController::class, 'store']);
    Route::get('/admin/buku/edit/{idBuku}', [BukuController::class, 'edit']);
    Route::put('/admin/buku/{idBuku}', [BukuController::class, 'update']);
    Route::delete('/admin/buku/{idBuku}', [BukuController::class, 'delete']);
});

Route::group(['middleware' => 'auth:user'], function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard.index');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
