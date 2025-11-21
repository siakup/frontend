<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComponentsDocumentationController;

Route::group(['prefix' => 'components-documentation'], function () {
    Route::get('/table', [ComponentsDocumentationController::class, 'table'])->name('components-documentation.table');
});
