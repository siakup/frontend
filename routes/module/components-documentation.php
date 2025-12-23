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
    Route::get('/breadcrumb', [ComponentsDocumentationController::class, 'breadcrumb'])->name('components-documentation.breadcrumb');
    Route::get('/tab', [ComponentsDocumentationController::class, 'tab'])->name('components-documentation.tab');
    Route::get('/input', [ComponentsDocumentationController::class, 'input'])->name('components-documentation.input');
    Route::get('/input-refactor', [ComponentsDocumentationController::class, 'inputRefactor'])->name('components-documentation.input-refactor');
    Route::get('/textarea-refactor', [ComponentsDocumentationController::class, 'textareaRefactor'])->name('components-documentation.textarea-refactor');
    Route::get('/textarea', [ComponentsDocumentationController::class, 'textarea'])->name('components-documentation.textarea');
    Route::get('/checkbox', [ComponentsDocumentationController::class, 'checkbox'])->name('components-documentation.checkbox');
    Route::get('/file', [ComponentsDocumentationController::class, 'file'])->name('components-documentation.file');
    Route::get('/modal', [ComponentsDocumentationController::class, 'modal'])->name('components-documentation.modal');
    Route::get('/pagination', [ComponentsDocumentationController::class, 'pagination'])->name('components-documentation.partials.pagination');
});
