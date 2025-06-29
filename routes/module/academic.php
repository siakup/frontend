<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicController;

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'academics'], function () {
        Route::get('/', [AcademicController::class, 'index'])->name('academics.index');
    });
});