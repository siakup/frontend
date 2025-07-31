<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\StudyController;

Route::group(['middleware' => ['auth']], function () {
  Route::group(['prefix' => 'academics'], function () {
    //periode akademik
    Route::get('/periode', [AcademicController::class, 'indexPeriode'])->name('academics-periode.index');
    Route::get('/periode/create', [AcademicController::class, 'createPeriode'])->name('periode.create');
    Route::post('/periode', [AcademicController::class, 'periodeStore'])->name('academics-periode.store');

    Route::get('/periode/edit/{id}', [AcademicController::class, 'periodeEdit'])->name('academics-periode.edit');
    Route::put('/periode/update/{id}', [AcademicController::class, 'periodeUpdate'])->name('academics-periode.update');

    Route::get('/periode-detail', [AcademicController::class, 'periodeDetail'])->name('academics-periode.detail');
    Route::get('/periode-edit/{id}', [AcademicController::class, 'periodeEdit'])->name('academics-periode.edit');
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
    Route::get('/event/template', [AcademicController::class, 'eventDownloadTemplate'])->name('academics-event.template');
    Route::post('/event/preview', [AcademicController::class, 'eventPreview'])->name('academics-event.preview');
    Route::delete('/event/delete/{id}', [AcademicController::class, 'eventDelete'])->name('academics-event.delete');
  });

  Route::group(['prefix' => 'calendar'], function () {
    Route::get('/', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/event/{id}', [CalendarController::class, 'show'])->name('calendar.show');
    Route::post('/event/{id}', [CalendarController::class, 'store'])->name('calendar.store');
    Route::get('/event/{id}/upload', [CalendarController::class, 'upload'])->name('calendar.upload');
    Route::post('/event/{id}/upload', [CalendarController::class, 'send'])->name('calendar.send');
  });

  Route::group(['prefix' => 'mata-kuliah'], function () {
    Route::get('/', [StudyController::class, 'index'])->name('study.index');
  });
});
