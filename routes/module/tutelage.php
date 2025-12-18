<?php

use App\Http\Controllers\TutelageController;
use App\Http\Controllers\TutelageGroupController;
use Illuminate\Support\Facades\Route;

// Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'tutelage-group'], function () {
        Route::group(['prefix' => 'student-list'], function () {
            Route::get('/', action: [TutelageController::class, 'listStudent'])->name('tutelage-group.list-student');
            Route::group(['prefix' => 'detail'], function () {
                Route::get('/krs/{id}', action: [TutelageController::class, 'showKrs'])->name('tutelage-group.student-list.detail-krs');
                Route::get('/student-data/{id}', action: [TutelageController::class, 'showStudentData'])->name('tutelage-group.student-list.detail-student-data');
                Route::get('/transkrip-resmi/{id}', action: [TutelageController::class, 'showTranskripResmi'])->name('tutelage-group.student-list.detail-transkrip-resmi');
                Route::get('/transkrip-historis/{id}', action: [TutelageController::class, 'showTranskripHistoris'])->name('tutelage-group.student-list.detail-transkrip-historis');
                Route::get('/transkrip-kurikulum/{id}', action: [TutelageController::class, 'showTranskripKurikulum'])->name('tutelage-group.student-list.detail-transkrip-kurikulum');
                Route::get('/transkrip-pem/{id}', action: [TutelageController::class, 'showTranskripPem'])->name('tutelage-group.student-list.detail-transkrip-pem');
                Route::get('/krs/add-course/{id}', action: [TutelageController::class, 'addCourse'])->name('tutelage-group.student-list.detail-krs.add-course');
                Route::get('/message/{id}', action: [TutelageController::class, 'addMessage'])->name('tutelage-group.student-list.message.add');
            });
        });
        Route::get('/', action: [TutelageGroupController::class, 'index'])->name('tutelage-group');
        Route::get('/create', action: [TutelageGroupController::class, 'create'])->name('tutelage-group.create');
    });
// });
