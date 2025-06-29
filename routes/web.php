<?php

use App\Http\Controllers\InstitutionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/show/{username}', [UserController::class, 'getUser'])->name('users.getUser');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::get('/edit/{username}', [UserController::class, 'edit'])->name('users.edit');
        Route::get('/search-by-nip', [UserController::class, 'searchByNip'])->name('users.search-nip');
        Route::get('/generate-username', [UserController::class, 'generateUsername'])->name('users.generate-username');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
    });

    Route::group(['prefix' => 'institutions'], function () {
        Route::get('/', [InstitutionController::class, 'index'])->name('institutions.index');
        Route::get('/by-role', [InstitutionController::class, 'getInstitutionsByRole'])->name('institutions.role');
    });

    Route::get('/test-email', function () {return view('emails.new_user');
});
});
