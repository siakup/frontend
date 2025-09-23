<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\StudyController;
use App\Http\Controllers\CplMapping;

 Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'lectures'], function () {
        Route::get('/', [LectureController::class, 'index'])->name('lectures.index');
    });

    Route::group(['prefix' => 'courses'], function () {
        Route::get('/', [CourseController::class, 'index'])->name('courses.index');
        Route::get('/create', [CourseController::class, 'create'])->name('courses.create');
        Route::get('/edit/{id}', [CourseController::class, 'edit'])->name('courses.edit');
        Route::get('/view/{id}', [CourseController::class, 'view'])->name('courses.view');
        Route::get('/upload', [CourseController::class, 'upload'])->name('courses.upload');
        Route::post('/upload', [CourseController::class, 'uploadResult'])->name('courses.upload-result');
        Route::post('/save-upload', [CourseController::class, 'uploadStore'])->name('courses.save-upload');
    });

    Route::group(['prefix' => 'curriculums'], function () {
        Route::get('/list', [CurriculumController::class, 'curriculumList'])->name('curriculum.list');
        Route::group(['prefix' => '/list/view'], function () {
            Route::get('/{id}', [CurriculumController::class, 'viewCurriculumList'])->name('curriculum.list.view');
            Route::get('/{id}/view-courses', [CurriculumController::class, 'showCurriculumStudyList'])->name('curriculum.list.view.show-study');
        });
        Route::get('/list/create/{program_studi}', [CurriculumController::class, 'createCurriculumList'])->name('curriculum.list.create');
        Route::post('/list/create', [CurriculumController::class, 'storeCurriculumList'])->name('curriculum.list.store');
        Route::group(['prefix' => '/list/edit'], function () {
        Route::get('/{id}', [CurriculumController::class, 'editCurriculumList'])->name('curriculum.list.edit');
        Route::post('/{id}', [CurriculumController::class, 'updateCurriculumList'])->name('curriculum.list.update');
        Route::get('/{id}/show-courses', [CurriculumController::class, 'showCurriculumStudyList'])->name('curriculum.list.edit.show-study');
        Route::get('/{id}/assign-course', [CurriculumController::class, 'assignCurriculumCourse'])->name('curriculum.list.edit.assign-study');
        Route::post('/{id}/assign-course', [CurriculumController::class, 'updateAssignCurriculumCourse'])->name('curriculum.list.edit.update-assign-study');
        Route::get('/{id}/view-courses/{course_id}', [CurriculumController::class, 'editCurriculumStudyList'])->name('curriculum.list.edit.edit-study');
        });
        Route::get('/structure/required', [CurriculumController::class, 'requiredCurriculumStructure'])->name('curriculum.required-structure');
        Route::get('/structure/optional', [CurriculumController::class, 'optionalCurriculumStructure'])->name('curriculum.optional-structure');

        Route::get('/equivalence', [CurriculumController::class, 'curriculumEquivalence'])->name('curriculum.equivalence');
        Route::get(
            '/equivalence/add/{prodi}/{programPerkuliahan}',
            [CurriculumController::class, 'createCurriculumEquivalence']
        )->name('curriculum.equivalence.create');
        Route::get(
            '/equivalence/edit/{id}',
            [CurriculumController::class, 'editCurriculumEquivalence']
        )->name('curriculum.equivalence.edit');

    });

    Route::group(['prefix' => 'cpl-mapping'], function () {
        Route::get('/', [CplMapping::class, 'index'])->name('cpl-mapping.index');
        Route::get('/tambah', [CplMapping::class, 'create'])->name('cpl-mapping.create');
        Route::get('/edit/{id}', [CplMapping::class, 'edit'])->name('cpl-mapping.edit');
        Route::get('/view/{id}', [CplMapping::class, 'view'])->name('cpl-mapping.view');
        Route::get('/upload', [CplMapping::class, 'upload'])->name('cpl-mapping.upload');
        Route::post('/upload', [CplMapping::class, 'uploadResult'])->name('cpl-mapping.upload-result');
        Route::post('/save-upload', [CplMapping::class, 'uploadStore'])->name('cpl-mapping.save-upload');
        Route::get('/template', [CplMapping::class, 'cplDownloadTemplate'])->name('cpl-mapping.template');
    });
 });
