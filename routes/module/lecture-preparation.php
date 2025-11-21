<?php

use App\Http\Controllers\AutoAssignController;
use App\Http\Controllers\CplMapping;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'lecture-preparation'], function () {
        Route::group(['prefix' => 'schedule'], function () {
            Route::group(['prefix' => 'program-studi'], function () {
                Route::get('/', [ScheduleController::class, 'index'])->name('academics.schedule.prodi-schedule.index');
                Route::group(['prefix' => 'create'], function () {
                    Route::get('/', [ScheduleController::class, 'create'])->name('academics.schedule.prodi-schedule.create');
                    Route::post('/', [ScheduleController::class, 'store'])->name('academics.schedule.prodi-schedule.store');
                    Route::group(['prefix' => 'kelas'], function () {
                        Route::get('/', [ScheduleController::class, 'jadwalKelas'])->name('academics.schedule.prodi-schedule.add-class-schedule');
                        Route::get('/rooms', [ScheduleController::class, 'availableRooms'])->name('academics.schedule.prodi-schedule.available-rooms');
                    });
                    Route::get('/course/{periode}', [ScheduleController::class, 'mataKuliah'])->name('academics.schedule.prodi-schedule.add-course');
                    Route::get('/lecture', [ScheduleController::class, 'dosen'])->name('academics.schedule.prodi-schedule.add-lecture');
                });
                Route::group(['prefix' => 'upload'], function () {
                    Route::get('/page', [ScheduleController::class, 'importFet1'])->name('academics.schedule.prodi-schedule.import-fet1');
                    Route::post('/preview', [ScheduleController::class, 'uploadResult'])->name('academics.schedule.prodi-schedule.upload-result');
                    Route::post('/save-upload', [ScheduleController::class, 'uploadStore'])->name('academics.schedule.prodi-schedule.save-upload');
                    Route::get('/template-schedule', [ScheduleController::class, 'downloadTemplate'])->name('academics.schedule.prodi-schedule.template');
                });
                Route::get('/{id}', [ScheduleController::class, 'show'])->name('academics.schedule.prodi-schedule.show');
                Route::get('/edit/{id}', [ScheduleController::class, 'edit'])->name('academics.schedule.prodi-schedule.edit');
                Route::put('/{id}', [ScheduleController::class, 'update'])->name('academics.schedule.prodi-schedule.update');
                Route::delete('/{id}', [ScheduleController::class, 'destroy'])->name('academics.schedule.prodi-schedule.destroy');
            });
            Route::prefix('parent-institution')->name('academics.schedule.parent-institution-schedule.')->group(function () {
                Route::get('/', [ScheduleController::class, 'parentInstitutionIndex'])->name('index');
                Route::group(['prefix' => 'create'], function () {
                    Route::get('/', [ScheduleController::class, 'parentInstitutionCreate'])->name('create');
                    Route::post('/', [ScheduleController::class, 'parentInstitutionStore'])->name('store');
                    Route::get('/add-lecture', [ScheduleController::class, 'parentInstitutionLectureList'])->name('add-lecture');
                    Route::get('/add-course/{periode}', [ScheduleController::class, 'parentInstitutionCourseList'])->name('add-course');
                    Route::get('/add-class-schedule', [ScheduleController::class, 'parentInstitutionClassScheduleCreate'])->name('add-class-schedule');
                });
                Route::group(['prefix' => 'edit'], function () {
                    Route::get('/{id}', [ScheduleController::class, 'parentInstitutionEdit'])->name('edit');
                    Route::put('/{id}', [ScheduleController::class, 'parentInstitutionUpdate'])->name('update');
                });
                Route::get('/{id}', [ScheduleController::class, 'parentInstitutionView'])->name('view');
                Route::group(['prefix' => 'upload'], function () {
                    Route::get('/page', [ScheduleController::class, 'parentInstitutionUpload'])->name('upload');
                    Route::post('/preview', [ScheduleController::class, 'parentInstitutionUploadResult'])->name('upload-result');
                    Route::get('/download-template', [ScheduleController::class, 'parentInstitutionDownloadTemplate'])->name('download-template');
                    Route::post('/store', [ScheduleController::class, 'parentInstitutionUploadStore'])->name('upload-store');
                });
            });
        });
        Route::prefix('auto-assign')->name('academics.auto-assign.')->group(function () {
            Route::get('/', [AutoAssignController::class, 'autoAssignIndex'])->name('index');
            Route::get('/see', [AutoAssignController::class, 'autoAssignView'])->name('view');
            Route::get('/filled-participant', [AutoAssignController::class, 'autoAssignFilledMember'])->name('filled-member');
            Route::get('/approved-participant', [AutoAssignController::class, 'autoAssignApprovedMember'])->name('approved-member');
            Route::post('/submit', [AutoAssignController::class, 'autoAssignSubmit'])->name('submit');
        });
        Route::group(['prefix' => 'cpl-mapping'], function () {
            Route::get('/', [CplMapping::class, 'index'])->name('cpl-mapping.index');
            Route::get('/create', [CplMapping::class, 'create'])->name('cpl-mapping.create');
            Route::get('/edit/{id}', [CplMapping::class, 'edit'])->name('cpl-mapping.edit');
            Route::get('/view/{id}', [CplMapping::class, 'view'])->name('cpl-mapping.view');
            Route::get('/upload', [CplMapping::class, 'upload'])->name('cpl-mapping.upload');
            Route::post('/upload', [CplMapping::class, 'uploadResult'])->name('cpl-mapping.upload-result');
            Route::post('/save-upload', [CplMapping::class, 'uploadStore'])->name('cpl-mapping.save-upload');
            Route::get('/template', [CplMapping::class, 'cplDownloadTemplate'])->name('cpl-mapping.template');
        });
    });
});
