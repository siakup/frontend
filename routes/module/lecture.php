<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LectureController;

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'lectures'], function () {
        Route::get('/', [LectureController::class, 'index'])->name('lectures.index');
    });
});
