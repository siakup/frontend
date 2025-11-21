<?php

use App\Http\Controllers\InstitutionController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'institutions'], function () {
        Route::get('/', [InstitutionController::class, 'index'])->name('institutions.index');
        Route::get('role', [InstitutionController::class, 'getInstitutionsByRole'])->name('institutions.role');
    });
});
