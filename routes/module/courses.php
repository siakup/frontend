<?php

use App\Http\Controllers\StudyController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'courses'], function () {
        Route::get('/', [StudyController::class, 'index'])->name('study.index');
        Route::group(['prefix' => 'create'], function () {
            Route::get('/', [StudyController::class, 'create'])->name('study.create');
            Route::get('/get-matakuliah-prasyarat', [StudyController::class, 'getCoursePrerequisiteList'])->name('study.prerequisite-course');
            Route::post('/', [StudyController::class, 'store'])->name('study.store');
        });
        Route::get('/view/{id}', [StudyController::class, 'view'])->name('study.view');
        Route::delete('/{id}', [StudyController::class, 'delete'])->name('study.delete');
        Route::get('/edit/{id}', [StudyController::class, 'edit'])->name('study.edit');

        Route::group(['prefix' => 'upload'], function () {
            Route::get('/', [StudyController::class, 'upload'])->name('study.upload');
            Route::post('/', [StudyController::class, 'uploadResult'])->name('study.upload-result');
            Route::post('/save-upload', [StudyController::class, 'uploadStore'])->name('study.save-upload');
        });
    });
});
