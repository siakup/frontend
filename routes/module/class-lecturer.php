<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassLecturerController;

// Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'class-lecturer'], function () {
        Route::get('/', [ClassLecturerController::class, 'index'])->name('class-lecturer.index');
    });
// });
