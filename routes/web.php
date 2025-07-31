<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/style-guide', function (){
    return view('style-guide');
})->name('style-guide');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::get('/test-email', function () {
        return view('emails.new_user');
    });
});

require __DIR__.'/module/academic.php';
require __DIR__.'/module/institution.php';
require __DIR__.'/module/lecture.php';
require __DIR__.'/module/role.php';
require __DIR__.'/module/student.php';
require __DIR__.'/module/user.php';
