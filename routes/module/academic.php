<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicController;

Route::group(['midgit dleware' => ['auth']], function () {
    Route::group(['prefix' => 'academics'], function () {
        //periode akademik
        Route::get('/periode', [AcademicController::class, 'indexPeriode'])->name('academics-periode.index');
        Route::get('/periode/create', [AcademicController::class, 'createPeriode'])->name('periode.create');
        Route::post('/periode', [AcademicController::class, 'periodeStore'])->name('academics-periode.store');
        Route::get('/periode-detail', [AcademicController::class, 'periodeDetail'])->name('academics-periode.detail');
        Route::get('/periode-edit', [AcademicController::class, 'periodeEdit'])->name('academics-periode.edit');
        Route::get('/periode/detail', [AcademicController::class, 'periodeDetail'])->name('periode.detail');
        Route::delete('/periode/delete/{id}',  [AcademicController::class, 'periodeDelete'])->name('academics-periode.delete');


        //event akademik
        Route::get('/event', [AcademicController::class, 'indexEvent'])->name('academics-event.index');
        Route::get('/event-detail', [AcademicController::class, 'eventDetail'])->name('academics-event.detail');
        Route::get('/event/edit/{id}', [AcademicController::class, 'eventEdit'])->name('academics-event.edit');
        Route::put('/event/update/{id}', [AcademicController::class, 'eventUpdate'])->name('academics-event.update');
        Route::get('/event/create', [AcademicController::class, 'eventCreate'])->name('academics-event.create');
        Route::post('/event', [AcademicController::class, 'eventStore'])->name('academics-event.store');
        Route::get('/event/upload', [AcademicController::class, 'eventUpload'])->name('academics-event.upload');
        Route::post('/event/upload', [AcademicController::class, 'eventStoreUpload'])->name('academics-event.store-upload');
        Route::delete('/event/delete/{id}', [AcademicController::class, 'eventDelete'])->name('academics-event.delete');
    });
});
