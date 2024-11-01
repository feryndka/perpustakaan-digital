<?php

use App\Http\Controllers\Admin\BukuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', function () {
    return view('admin.pages.dashboard.index');
});

Route::get('/admin/buku', [BukuController::class, 'index']);
Route::get('/admin/buku/create', [BukuController::class, 'create']);
Route::post('/admin/buku/store', [BukuController::class, 'store']);
Route::get('/admin/buku/edit/{idBuku}', [BukuController::class, 'edit']);
Route::put('/admin/buku/{idBuku}', [BukuController::class, 'update']);
Route::delete('/admin/buku/{idBuku}', [BukuController::class, 'delete']);
