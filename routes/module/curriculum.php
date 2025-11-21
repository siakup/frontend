<?php

use App\Http\Controllers\CurriculumController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'curriculums'], function () {
        Route::group(['prefix' => '/list'], function () {
            Route::get('/', [CurriculumController::class, 'curriculumList'])->name('curriculum.list');
            Route::group(['prefix' => '/view'], function () {
                Route::get('/{id}', [CurriculumController::class, 'viewCurriculumList'])->name('curriculum.list.view');
                Route::get('/{id}/view-courses', [CurriculumController::class, 'showCurriculumStudyList'])->name('curriculum.list.view.show-study');
            });
            Route::group(['prefix' => 'create'], function () {
                Route::get('/{program_studi}', [CurriculumController::class, 'createCurriculumList'])->name('curriculum.list.create');
                Route::post('/', [CurriculumController::class, 'storeCurriculumList'])->name('curriculum.list.store');
            });
            Route::group(['prefix' => '/edit'], function () {
                Route::get('/{id}', [CurriculumController::class, 'editCurriculumList'])->name('curriculum.list.edit');
                Route::post('/{id}', [CurriculumController::class, 'updateCurriculumList'])->name('curriculum.list.update');
                Route::get('/{id}/show-courses', [CurriculumController::class, 'showCurriculumStudyList'])->name('curriculum.list.edit.show-study');
                Route::get('/{id}/assign-course', [CurriculumController::class, 'assignCurriculumCourse'])->name('curriculum.list.edit.assign-study');
                Route::post('/{id}/assign-course', [CurriculumController::class, 'updateAssignCurriculumCourse'])->name('curriculum.list.edit.update-assign-study');
                Route::get('/{id}/view-courses/{course_id}', [CurriculumController::class, 'editCurriculumStudyList'])->name('curriculum.list.edit.edit-study');
            });
        });
        Route::group(['prefix' => 'structure'], function () {
            Route::get('/required', [CurriculumController::class, 'requiredCurriculumStructure'])->name('curriculum.required-structure');
            Route::get('/optional', [CurriculumController::class, 'optionalCurriculumStructure'])->name('curriculum.optional-structure');
        });
        Route::group(['prefix' => 'equivalence'], function () {
            Route::get('/', [CurriculumController::class, 'curriculumEquivalence'])->name('curriculum.equivalence');
            Route::get('/add/{prodi}/{programPerkuliahan}', [CurriculumController::class, 'createCurriculumEquivalence'])->name('curriculum.equivalence.create');
            Route::get('/edit/{id}', [CurriculumController::class, 'editCurriculumEquivalence'])->name('curriculum.equivalence.edit');
            Route::get('/upload', [CurriculumController::class, 'uploadCurriculumEquivalence'])->name('curriculum.equivalence.upload');
            Route::post('/upload-result', [CurriculumController::class, 'uploadResultCurriculumEquivalence'])->name('curriculum.equivalence.upload-result');
        });
    });
});
