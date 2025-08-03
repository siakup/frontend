<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/subject', function (){
    return view('subjects.index');
})->name('subject');

Route::get('/subject/create', function (){
    return view('subjects.create');
})->name('subject.create');

Route::get('/subject/edit', function (){
    return view('subjects.edit');
})->name('subject.edit');

Route::get('/subject/view', function (){
    return view('subjects.view');
})->name('subject.view');

// Route::group(['middleware' => ['auth']], function () {
Route::group([], function () {
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
