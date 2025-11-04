<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RpsController;

// Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'rps'], function () {
        Route::get('/', [RpsController::class, 'index'])->name('rps.index');
        Route::get('/deskripsi-umum', [RpsController::class, 'buatRpsDeskripsiUmum'])->name('rps.deskripsi-umum');
        Route::get('/capaian-pembelajaran', [RpsController::class, 'buatCapaianPembelajaran'])->name('rps.capaian-pembelajaran');
        Route::get('/komponen-penilaian', [RpsController::class, 'buatKomponenPenilaian'])->name('rps.komponen-penilaian');
    });
// });