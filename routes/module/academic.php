<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicController;

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'academics'], function () {
        //periode akademik
        Route::get('/periode', [AcademicController::class, 'indexPeriode'])->name('academics-periode.index');
        Route::get('/periode/create', [AcademicController::class, 'createPeriode'])->name('periode.create');
        Route::get('/periode-detail', [AcademicController::class, 'periodeDetail'])->name('academics-periode.detail');

        //event akademik
        Route::get('/event', [AcademicController::class, 'indexEvent'])->name('academics-event.index');
        Route::get('/event-detail', [AcademicController::class, 'eventDetail'])->name('academics-event.detail');
        Route::get('/event/edit/{id}', [AcademicController::class, 'eventEdit'])->name('academics-event.edit');
        Route::delete('/event/delete/{id}', [AcademicController::class, 'eventDelete'])->name('academics-event.delete');
    });
});