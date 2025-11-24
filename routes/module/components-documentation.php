<?php

use App\Http\Controllers\ComponentsDocumentationController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'components-documentation'], function () {
    Route::get('/table', [ComponentsDocumentationController::class, 'table'])->name('components-documentation.table');
    Route::get('/button', [ComponentsDocumentationController::class, 'button'])->name('components-documentation.button');
});
