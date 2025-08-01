<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/subject', function (){
    $users = collect([
        ['name' => 'Ahmad Arroziqi', 'email' => 'arroziqi@example.com', 'role' => 'Admin'],
        ['name' => 'Putri Lestari', 'email' => 'putri@example.com', 'role' => 'Editor'],
        ['name' => 'Budi Santoso', 'email' => 'budi@example.com', 'role' => 'Viewer'],
    ])->map(fn($u) => (object) $u);


    return view('subjects.index', compact('users'));
})->name('subject');

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
