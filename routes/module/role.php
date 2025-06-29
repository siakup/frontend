<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index');
        Route::get('show/{id}', [RoleController::class, 'show'])->name('roles.show');
        Route::get('edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
        Route::get('create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/', [RoleController::class, 'store'])->name('roles.store');
        Route::put('update/{id}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('/', [RoleController::class, 'delete'])->name('roles.delete');
    });
});