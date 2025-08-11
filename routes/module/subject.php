<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;

Route::group(['middleware' => ['auth']], function () {
  Route::group(['prefix' => 'subject'], function () {
    //Mata Kuliah
    Route::get('/subject', [SubjectController::class, 'index'])->name('subject.index');
    // Route::get('/periode/create', [AcademicController::class, 'createPeriode'])->name('periode.create');
    // Route::post('/periode', [AcademicController::class, 'periodeStore'])->name('subject.store');

    // Route::get('/periode/edit/{id}', [AcademicController::class, 'periodeEdit'])->name('subject.edit');
    // Route::put('/periode/update/{id}', [AcademicController::class, 'periodeUpdate'])->name('subject.update');

    // Route::get('/periode-detail', [AcademicController::class, 'periodeDetail'])->name('subject.detail');
    // Route::get('/periode-edit/{id}', [AcademicController::class, 'periodeEdit'])->name('subject.edit');

    // Route::get('/periode/detail', [AcademicController::class, 'periodeDetail'])->name('periode.detail');
    // Route::delete('/periode/delete/{id}',  [AcademicController::class, 'periodeDelete'])->name('subject.delete');


    //event akademik
    // Route::get('/event', [AcademicController::class, 'indexEvent'])->name('academics-event.index');
    // Route::get('/event-detail', [AcademicController::class, 'eventDetail'])->name('academics-event.detail');

    // Route::get('/event/edit/{id}', [AcademicController::class, 'eventEdit'])->name('academics-event.edit');
    // Route::put('/event/update/{id}', [AcademicController::class, 'eventUpdate'])->name('academics-event.update');

    // Route::get('/event/create', [AcademicController::class, 'eventCreate'])->name('academics-event.create');
    // Route::post('/event', [AcademicController::class, 'eventStore'])->name('academics-event.store');
    // Route::get('/event/upload', [AcademicController::class, 'eventUpload'])->name('academics-event.upload');
    // Route::post('/event/upload', [AcademicController::class, 'eventStoreUpload'])->name('academics-event.store-upload');
    // Route::get('/event/template', [AcademicController::class, 'eventDownloadTemplate'])->name('academics-event.template');
    // Route::post('/event/preview', [AcademicController::class, 'eventPreview'])->name('academics-event.preview');
    // Route::delete('/event/delete/{id}', [AcademicController::class, 'eventDelete'])->name('academics-event.delete');
  });

  //   Route::group(['prefix' => 'calendar'], function () {
  //     Route::get('/', [CalendarController::class, 'index'])->name('calendar.index');
  //   });
});
