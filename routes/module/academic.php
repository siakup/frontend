<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicController;

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'academics'], function () {
        //periode akademik
        Route::get('/periode', [AcademicController::class, 'indexPeriode'])->name('academics-periode.index');
        Route::get('/periode/create', [AcademicController::class, 'createPeriode'])->name('periode.create');
        Route::get('/periode-detail', [AcademicController::class, 'periodeDetail'])->name('academics-periode.detail');
        Route::get('/periode-edit', [AcademicController::class, 'periodeEdit'])->name('academics-periode.edit');

        //event akademik
        Route::get('/event', [AcademicController::class, 'indexEvent'])->name('academics-event.index');
        Route::get('/event-detail', [AcademicController::class, 'eventDetail'])->name('academics-event.detail');
        Route::get('/event/edit/{id}', [AcademicController::class, 'eventEdit'])->name('academics-event.edit');
        Route::put('/event/update/{id}', [AcademicController::class, 'eventUpdate'])->name('academics-event.update');
        Route::get('/event/create', [AcademicController::class, 'eventCreate'])->name('academics-event.create');
        Route::get('/event/upload', [AcademicController::class, 'eventUpload'])->name('academics-event.upload');
        Route::delete('/event/delete/{id}', [AcademicController::class, 'eventDelete'])->name('academics-event.delete');
    });
});