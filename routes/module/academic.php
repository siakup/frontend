<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicController;

Route::group(['middleware' => ['auth']], function () {
  Route::group(['prefix' => 'academics'], function () {
    Route::group(['prefix' => 'periode'], function() {
      Route::get('/', [AcademicController::class, 'indexPeriode'])->name('academics-periode.index');
      Route::post('/', [AcademicController::class, 'periodeStore'])->name('academics-periode.store');
      Route::delete('/{id}', [AcademicController::class, 'periodeDelete'])->name('academics-periode.delete');
      Route::get('/detail', [AcademicController::class, 'periodeDetail'])->name('academics-periode.detail');
      Route::get('/create', [AcademicController::class, 'createPeriode'])->name('academics-periode.create');
      Route::group(['prefix' => 'edit'], function () {
        Route::get('/{id}', [AcademicController::class, 'periodeEdit'])->name('academics-periode.edit');
        Route::put('/{id}', [AcademicController::class, 'periodeUpdate'])->name('academics-periode.update');
      });
    });

    Route::group(['prefix' => 'event'], function() {
      Route::get('/', [AcademicController::class, 'indexEvent'])->name('academics-event.index');
      Route::get('/detail', [AcademicController::class, 'eventDetail'])->name('academics-event.detail');
      Route::group(['prefix' => 'edit'], function() {
        Route::get('/{id}', [AcademicController::class, 'eventEdit'])->name('academics-event.edit');
        Route::put('/{id}', [AcademicController::class, 'eventUpdate'])->name('academics-event.update');
      });
      Route::get('/create', [AcademicController::class, 'eventCreate'])->name('academics-event.create');
      Route::post('/create', [AcademicController::class, 'eventStore'])->name('academics-event.store');
      Route::group(['prefix' => 'upload'], function () {
        Route::get('/', [AcademicController::class, 'eventUpload'])->name('academics-event.upload');
        Route::post('/', [AcademicController::class, 'eventStoreUpload'])->name('academics-event.store-upload');
        Route::get('/template', [AcademicController::class, 'eventDownloadTemplate'])->name('academics-event.template');
        Route::post('/preview', [AcademicController::class, 'eventPreview'])->name('academics-event.preview');
      });
      Route::delete('/{id}', [AcademicController::class, 'eventDelete'])->name('academics-event.delete');
    });
  });
});
