<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicController;

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'academics'], function () {
        Route::get('/periode', [AcademicController::class, 'indexPeriode'])->name('academics-periode.index');
        Route::get('/event', [AcademicController::class, 'indexEvent'])->name('academics-event.index');
        Route::get('/event-detail', [AcademicController::class, 'eventDetail'])->name('academics-event.detail');
        Route::get('/event/edit/{id}', [AcademicController::class, 'eventEdit'])->name('academics-event.edit');
        Route::delete('/event/delete/{id}', [AcademicController::class, 'eventDelete'])->name('academics-event.delete');
    });
});