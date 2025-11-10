<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;

Route::group(['middleware' => 'auth'], function () {
  Route::group(['prefix' => 'calendar'], function () {
    Route::get('/', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/generate', [CalendarController::class, 'generate'])->name('calendar.generate');
    Route::get('/template/{id}', [CalendarController::class, 'eventDownloadTemplate'])->name('calendar.template');
    Route::get('/event/{id}', [CalendarController::class, 'show'])->name('calendar.show');
    Route::post('/event/{id}', [CalendarController::class, 'store'])->name('calendar.store');
    Route::put('/event/{id}', [CalendarController::class, 'update'])->name('calendar.update');
    Route::get('/event/{id}/upload', [CalendarController::class, 'upload'])->name('calendar.upload');
    Route::post('/event/{id}/upload', [CalendarController::class, 'send'])->name('calendar.send');
    Route::post('/event/{id}/save-upload', [CalendarController::class, 'save'])->name('calendar.save');
    Route::delete('/event/delete/{id}', [CalendarController::class, 'delete'])->name('calendar.delete');
  });
});