<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RpsController;

// Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'rps'], function () {
        Route::get('/', [RpsController::class, 'index'])->name('rps.index');
    });
// });