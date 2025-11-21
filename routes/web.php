<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::get('/subject', function () {
//     return view('subjects.index');
// })->name('subject');

// Route::get('/subject/create', function () {
//     $currentPage = 1;
//     $totalPages = 1;
//     $perPage = 10;

//     $prasyaratMataKuliahList = [
//         [
//             'kode' => 'CS101',
//             'nama' => 'Pengantar Pemrograman',
//             'sks' => 3,
//             'semester' => 1,
//             'jenis' => 'Wajib',
//             'tipe' => 'Prasyarat Wajib',
//             'isAdded' => false
//         ],
//         [
//             'kode' => 'CS201',
//             'nama' => 'Struktur Data',
//             'sks' => 3,
//             'semester' => 2,
//             'jenis' => 'Wajib',
//             'tipe' => 'Prasyarat Wajib',
//             'isAdded' => false
//         ],
//         [
//             'kode' => 'CS301',
//             'nama' => 'Algoritma Lanjut',
//             'sks' => 3,
//             'semester' => 3,
//             'jenis' => 'Pilihan',
//             'tipe' => 'Prasyarat Pilihan',
//             'isAdded' => false
//         ],
//         [
//             'kode' => 'MATH101',
//             'nama' => 'Kalkulus Dasar',
//             'sks' => 2,
//             'semester' => 1,
//             'jenis' => 'Wajib',
//             'tipe' => 'Prasyarat Wajib',
//             'isAdded' => true
//         ],
//     ];

//     $addedPrasyarat = array_filter($prasyaratMataKuliahList, function ($item) {
//         return $item['isAdded'] === true;
//     });

//     return view('subjects.create', compact('currentPage', 'totalPages', 'perPage', 'prasyaratMataKuliahList', 'addedPrasyarat'));
// })->name('subject.create');

// Route::get('/subject/edit/', function () {
//     $currentPage = 1;
//     $totalPages = 1;
//     $perPage = 10;

//     // Dummy data mata kuliah yang akan diedit
//     $subject = [
//         'study_program' => 'ti',
//         'code' => 'IF184101',
//         'name' => 'Pemrograman Web',
//         'english_name' => 'Web Programming',
//         'short_name' => 'WebProg',
//         'credits' => 3,
//         'semester' => 4,
//         'objective' => 'Mahasiswa memahami dasar pemrograman web.',
//         'description' => 'Mata kuliah ini membahas tentang HTML, CSS, JavaScript, dan framework web.',
//         'bibliography' => 'Eloquent JavaScript, MDN Docs',
//         'course_type' => 'wajib',
//         'coordinator' => 'D001',
//         'special_course' => 'tidak',
//         'open_for_other' => 'ya',
//         'mandatory' => 'ya',
//         'merdeka_campus' => 'tidak',
//         'capstone' => 'tidak',
//         'internship' => 'tidak',
//         'final_assignment' => 'tidak',
//         'minor' => 'tidak',
//         'user_active' => true,
//     ];

//     // Dummy data prasyarat
//     $prasyaratMataKuliahList = [
//         [
//             'kode' => 'CS101',
//             'nama' => 'Pengantar Pemrograman',
//             'sks' => 3,
//             'semester' => 1,
//             'jenis' => 'Wajib',
//             'tipe' => 'Prasyarat Wajib',
//             'isAdded' => false
//         ],
//         [
//             'kode' => 'CS201',
//             'nama' => 'Struktur Data',
//             'sks' => 3,
//             'semester' => 2,
//             'jenis' => 'Wajib',
//             'tipe' => 'Prasyarat Wajib',
//             'isAdded' => false
//         ],
//         [
//             'kode' => 'CS301',
//             'nama' => 'Algoritma Lanjut',
//             'sks' => 3,
//             'semester' => 3,
//             'jenis' => 'Pilihan',
//             'tipe' => 'Prasyarat Pilihan',
//             'isAdded' => false
//         ],
//         [
//             'kode' => 'MATH101',
//             'nama' => 'Kalkulus Dasar',
//             'sks' => 2,
//             'semester' => 1,
//             'jenis' => 'Wajib',
//             'tipe' => 'Prasyarat Wajib',
//             'isAdded' => true
//         ],
//     ];

//     $addedPrasyarat = array_values(array_filter($prasyaratMataKuliahList, fn($item) => $item['isAdded']));

//     return view('subjects.edit', compact('currentPage', 'totalPages', 'perPage', 'subject', 'prasyaratMataKuliahList', 'addedPrasyarat'));
// })->name('subject.edit');

// Route::get('/subject/view', function () {
//     $currentPage = 1;
//     $totalPages = 1;
//     $perPage = 10;

//     // Dummy data mata kuliah yang akan diedit
//     $subject = [
//         'study_program' => 'ti',
//         'code' => 'IF184101',
//         'name' => 'Pemrograman Web',
//         'english_name' => 'Web Programming',
//         'short_name' => 'WebProg',
//         'credits' => 3,
//         'semester' => 4,
//         'objective' => 'Mahasiswa memahami dasar pemrograman web.',
//         'description' => 'Mata kuliah ini membahas tentang HTML, CSS, JavaScript, dan framework web.',
//         'bibliography' => 'Eloquent JavaScript, MDN Docs',
//         'course_type' => 'wajib',
//         'coordinator' => 'D001',
//         'special_course' => 'tidak',
//         'open_for_other' => 'ya',
//         'mandatory' => 'ya',
//         'merdeka_campus' => 'tidak',
//         'capstone' => 'tidak',
//         'internship' => 'tidak',
//         'final_assignment' => 'tidak',
//         'minor' => 'tidak',
//         'user_active' => true,
//     ];

//     // Dummy data prasyarat
//     $prasyaratMataKuliahList = [
//         [
//             'kode' => 'CS101',
//             'nama' => 'Pengantar Pemrograman',
//             'sks' => 3,
//             'semester' => 1,
//             'jenis' => 'Wajib',
//             'tipe' => 'Prasyarat Wajib',
//             'isAdded' => false
//         ],
//         [
//             'kode' => 'CS201',
//             'nama' => 'Struktur Data',
//             'sks' => 3,
//             'semester' => 2,
//             'jenis' => 'Wajib',
//             'tipe' => 'Prasyarat Wajib',
//             'isAdded' => false
//         ],
//         [
//             'kode' => 'CS301',
//             'nama' => 'Algoritma Lanjut',
//             'sks' => 3,
//             'semester' => 3,
//             'jenis' => 'Pilihan',
//             'tipe' => 'Prasyarat Pilihan',
//             'isAdded' => false
//         ],
//         [
//             'kode' => 'MATH101',
//             'nama' => 'Kalkulus Dasar',
//             'sks' => 2,
//             'semester' => 1,
//             'jenis' => 'Wajib',
//             'tipe' => 'Prasyarat Wajib',
//             'isAdded' => true
//         ],
//     ];

//     $addedPrasyarat = array_values(array_filter($prasyaratMataKuliahList, fn($item) => $item['isAdded']));

//     return view('subjects.view', compact('currentPage', 'totalPages', 'perPage', 'subject', 'prasyaratMataKuliahList', 'addedPrasyarat'));
// })->name('subject.view');

// Route::group(['middleware' => ['auth']], function () {
Route::get('/', [HomeController::class, 'index']);
Route::get('home', [HomeController::class, 'index'])->name('home');

Route::get('/test-email', function () {
    return view('emails.new_user');
});
// });

require __DIR__.'/module/academic.php';
require __DIR__.'/module/curriculum.php';
require __DIR__.'/module/institution.php';
require __DIR__.'/module/role.php';
require __DIR__.'/module/student.php';
require __DIR__.'/module/user.php';
require __DIR__.'/module/tutelage.php';
require __DIR__.'/module/rps.php';
require __DIR__.'/module/lecture-preparation.php';
require __DIR__.'/module/calendar.php';
require __DIR__.'/module/courses.php';
require __DIR__.'/module/components-documentation.php';
