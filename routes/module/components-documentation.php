<?php

use App\Http\Controllers\ComponentsDocumentationController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'components-documentation'], function () {
    Route::get('/table', [ComponentsDocumentationController::class, 'table'])->name('components-documentation.table');
    Route::get('/tooltip', [ComponentsDocumentationController::class, 'tooltip'])->name('components-documentation.tooltip');
    Route::get('/badge', [ComponentsDocumentationController::class, 'badge'])->name('components-documentation.badge');
    Route::get('/dialog', [ComponentsDocumentationController::class, 'dialog'])->name('components-documentation.dialog');
    Route::get('/typography', [ComponentsDocumentationController::class, 'typography'])->name('components-documentation.typography');
    Route::get('/button', [ComponentsDocumentationController::class, 'button'])->name('components-documentation.button');
    Route::get('/quantity', [ComponentsDocumentationController::class, 'quantity'])->name('components-documentation.quantity');
    Route::get('/container', [ComponentsDocumentationController::class, 'container'])->name('components-documentation.container');
});
