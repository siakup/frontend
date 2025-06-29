<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'students'], function () {
        Route::get('/', [StudentController::class, 'index'])->name('students.index');
    });
});