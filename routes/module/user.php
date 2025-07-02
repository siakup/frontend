<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('detail', [UserController::class, 'detail'])->name('users.detail');
        Route::get('show/{username}', [UserController::class, 'getUser'])->name('users.getUser'); // unused yet
        Route::get('create', [UserController::class, 'create'])->name('users.create');
        Route::get('edit/{nomor_induk}', [UserController::class, 'edit'])->name('users.edit');
        Route::get('search-by-nip', [UserController::class, 'searchByNip'])->name('users.search-nip');
        Route::get('generate-username', [UserController::class, 'generateUsername'])->name('users.generate-username');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
        Route::put('/{id}/status', [UserController::class, 'updateStatus'])->name('users.updateStatus');
    });
});