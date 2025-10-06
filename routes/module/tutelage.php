<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TutelageController;

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'tutelage-group'], function () {
        Route::group(['prefix' => 'student-list'], function () {
            Route::get('/', action: [TutelageController::class, 'index'])->name('tutelage-group.index');
            Route::group(['prefix' => 'detail'], function () {
                Route::get('/krs/{id}', action: [TutelageController::class, 'showKrs'])->name('tutelage-group.student-list.detail-krs');
                Route::get('/student-data/{id}', action: [TutelageController::class, 'showStudentData'])->name('tutelage-group.student-list.detail-student-data');
                Route::get('/transkrip-resmi/{id}', action: [TutelageController::class, 'showTranskripResmi'])->name('tutelage-group.student-list.detail-transkrip-resmi');
                Route::get('/transkrip-historis/{id}', action: [TutelageController::class, 'showTranskripHistoris'])->name('tutelage-group.student-list.detail-transkrip-historis');
            });
        });
    });
});
