<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TutelageController;

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'tutelage-group'], function () {
        Route::group(['prefix' => 'student-list'], function () {
            Route::get('/', action: [TutelageController::class, 'listStudent'])->name('tutelage-group.list-student');
            Route::group(['prefix' => 'detail'], function () {
                Route::get('/krs/{id}', action: [TutelageController::class, 'showKrs'])->name('tutelage-group.student-list.detail-krs');
                Route::get('/krs/add-course/{id}', action: [TutelageController::class, 'addCourse'])->name('tutelage-group.student-list.detail-krs.add-course');
            });

        });

    });
});
