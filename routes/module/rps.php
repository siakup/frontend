<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RpsController;

// Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'rps'], function () {
        Route::get('/', [RpsController::class, 'index'])->name('rps.index');
        Route::get('/deskripsi-umum', [RpsController::class, 'buatRpsDeskripsiUmum'])->name('rps.deskripsi-umum');
        Route::get('/capaian-pembelajaran', [RpsController::class, 'showCapaianPembelajaran'])->name('rps.capaian-pembelajaran');
        Route::get('/capaian-pembelajaran/create', [RpsController::class, 'buatCapaianPembelajaranLulusan'])->name('rps.capaian-pembelajaran.create');
        Route::get('/komponen-penilaian', [RpsController::class, 'buatKomponenPenilaian'])->name('rps.komponen-penilaian');
        Route::get('/rencana-perkuliahan', [RpsController::class, 'showRencanaPerkuliahan'])->name('rps.rencana-perkuliahan');
        Route::get('/rencana-perkuliahan/create', [RpsController::class, 'buatRencanaPerkuliahan'])->name('rps.rencana-perkuliahan.create');
        Route::get('/matriks-penilaian-kognitif', [RpsController::class, 'showMatriksPenilaianKognitif'])->name('rps.matriks-penilaian-kognitif');
        Route::get('/evaluasi-pemetaan-capaian', [RpsController::class, 'showRencanaPerkuliahan'])->name('rps.evaluasi-pemetaan-capaian');
        Route::get('/rencana-evaluasi-mahasiswa', [RpsController::class, 'showRencanaPerkuliahan'])->name('rps.rencana-evaluasi-mahasiswa');
        Route::get('/submission', [RpsController::class, 'showRencanaPerkuliahan'])->name('rps.submission');
    });
// });