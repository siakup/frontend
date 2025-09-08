<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstitutionController;

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'institutions'], function () {
        Route::get('/', [InstitutionController::class, 'index'])->name('institutions.index');
        Route::get('role', [InstitutionController::class, 'getInstitutionsByRole'])->name('institutions.role');
    });
});
