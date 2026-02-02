<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/pendaftaran', [HomeController::class, 'pendaftaran']);
Route::post('/pendaftaran/simpan', [HomeController::class, 'simpanPendaftaran']);
Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware('auth');

Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/siswa', [SiswaController::class, 'index']);
    Route::get('/siswa/tambah', [SiswaController::class, 'create']);
    Route::post('/siswa/store', [SiswaController::class, 'store']);
    Route::get('/siswa/edit/{id}', [SiswaController::class, 'edit']);
    Route::put('/siswa/update/{id}', [SiswaController::class, 'update']);
    Route::get('/siswa/hapus/{id}', [SiswaController::class, 'delete']);
    Route::delete('/siswa/destroy/{id}', [SiswaController::class, 'destroy']);
    Route::post('/siswa/export', [SiswaController::class, 'exportExcel']);

    Route::get('/akun', [UserController::class, 'index']);
    Route::get('/akun/edit/{id}', [UserController::class, 'edit']);
    Route::put('/akun/update/{id}', [UserController::class, 'update']);
});
