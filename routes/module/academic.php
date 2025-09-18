<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\StudyController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AutoAssignController;

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'academics'], function () {
        //periode akademik
        Route::get('/periode', [AcademicController::class, 'indexPeriode'])->name('academics-periode.index');
        Route::get('/periode/create', [AcademicController::class, 'createPeriode'])->name('academics-periode.create');
        Route::post('/periode', [AcademicController::class, 'periodeStore'])->name('academics-periode.store');

        Route::get('/periode/edit/{id}', [AcademicController::class, 'periodeEdit'])->name('academics-periode.edit');
        Route::put('/periode/update/{id}', [AcademicController::class, 'periodeUpdate'])->name('academics-periode.update');

        Route::get('/periode-detail', [AcademicController::class, 'periodeDetail'])->name('academics-periode.detail');
        Route::get('/periode-edit/{id}', [AcademicController::class, 'periodeEdit'])->name('academics-periode.edit');
        Route::delete('/periode/delete/{id}', [AcademicController::class, 'periodeDelete'])->name('academics-periode.delete');

        //event akademik
        Route::get('/event', [AcademicController::class, 'indexEvent'])->name('academics-event.index');
        Route::get('/event-detail', [AcademicController::class, 'eventDetail'])->name('academics-event.detail');

        Route::get('/event/edit/{id}', [AcademicController::class, 'eventEdit'])->name('academics-event.edit');
        Route::put('/event/update/{id}', [AcademicController::class, 'eventUpdate'])->name('academics-event.update');

        Route::get('/event/create', [AcademicController::class, 'eventCreate'])->name('academics-event.create');
        Route::post('/event', [AcademicController::class, 'eventStore'])->name('academics-event.store');
        Route::get('/event/upload', [AcademicController::class, 'eventUpload'])->name('academics-event.upload');
        Route::post('/event/upload', [AcademicController::class, 'eventStoreUpload'])->name('academics-event.store-upload');
        Route::get('/event/template', [AcademicController::class, 'eventDownloadTemplate'])->name('academics-event.template');
        Route::post('/event/preview', [AcademicController::class, 'eventPreview'])->name('academics-event.preview');
        Route::delete('/event/delete/{id}', [AcademicController::class, 'eventDelete'])->name('academics-event.delete');
    });
    Route::get('/daftar-kurikulum/tambah/{program_studi}', [CurriculumController::class, 'createCurriculumList'])->name('curriculum.list.create');
    Route::post('/daftar-kurikulum/tambah', [CurriculumController::class, 'storeCurriculumList'])->name('curriculum.list.store');
    Route::group(['prefix' => '/daftar-kurikulum/ubah'], function () {
        Route::get('/{id}', [CurriculumController::class, 'editCurriculumList'])->name('curriculum.list.edit');
        Route::post('/{id}', [CurriculumController::class, 'updateCurriculumList'])->name('curriculum.list.update');
        Route::get('/{id}/lihat-mata-kuliah', [CurriculumController::class, 'showCurriculumStudyList'])->name('curriculum.list.edit.show-study');
        Route::get('/{id}/assign-mata-kuliah', [CurriculumController::class, 'assignCurriculumCourse'])->name('curriculum.list.edit.assign-study');
        Route::post('/{id}/assign-mata-kuliah', [CurriculumController::class, 'updateAssignCurriculumCourse'])->name('curriculum.list.edit.update-assign-study');
        Route::get('/{id}/lihat-mata-kuliah/{course_id}', [CurriculumController::class, 'editCurriculumStudyList'])->name('curriculum.list.edit.edit-study');
        Route::post('/{id}/lihat-mata-kuliah/{course_id}', [CurriculumController::class, 'updateCurriculumStudyList'])->name('curriculum.list.edit.update-study');
    });
    Route::get('/struktur-kurikulum/wajib', [CurriculumController::class, 'requiredCurriculumStructure'])->name('curriculum.required-structure');
    Route::get('/struktur-kurikulum/pilihan', [CurriculumController::class, 'optionalCurriculumStructure'])->name('curriculum.optional-structure');
    Route::get('/ekuivalensi-kurikulum', [CurriculumController::class, 'curriculumEquivalence'])->name('curriculum.equivalence');
    Route::get(
        '/ekuivalensi-kurikulum/tambah/{prodi}/{programPerkuliahan}',
        [CurriculumController::class, 'createCurriculumEquivalence']
    )->name('curriculum.equivalence.create');
    Route::get(
        '/ekuivalensi-kurikulum/edit/{id}',
        [CurriculumController::class, 'editCurriculumEquivalence']
    )->name('curriculum.equivalence.edit');

    Route::group(['prefix' => 'calendar'], function () {
        Route::get('/', [CalendarController::class, 'index'])->name('calendar.index');
        Route::get('/event/{id}', [CalendarController::class, 'show'])->name('calendar.show');
        Route::post('/event/{id}', [CalendarController::class, 'store'])->name('calendar.store');
        Route::put('/event/{id}', [CalendarController::class, 'update'])->name('calendar.update');
        Route::get('/event/{id}/upload', [CalendarController::class, 'upload'])->name('calendar.upload');
        Route::post('/event/{id}/upload', [CalendarController::class, 'send'])->name('calendar.send');
        Route::post('/event/{id}/save-upload', [CalendarController::class, 'save'])->name('calendar.save');
        Route::delete('/event/delete/{id}', [CalendarController::class, 'delete'])->name('calendar.delete');
    });

    Route::group(['prefix' => 'mata-kuliah'], function () {
        Route::get('/', [StudyController::class, 'index'])->name('study.index');
        Route::get('/tambah', [StudyController::class, 'create'])->name('study.create');
        Route::delete('/study/{id}', [StudyController::class, 'delete'])->name('study.delete');
        Route::get('/edit/{id}', [StudyController::class, 'edit'])->name('study.edit');
        Route::get('/view/{id}', [StudyController::class, 'view'])->name('study.view');
        Route::get('/upload', [StudyController::class, 'upload'])->name('study.upload');
        Route::post('/upload', [StudyController::class, 'uploadResult'])->name('study.upload-result');
        Route::post('/save-upload', [StudyController::class, 'uploadStore'])->name('study.save-upload');
    });

    Route::group(['prefix' => 'kurikulum'], function () {
        Route::get('/daftar-kurikulum', [CurriculumController::class, 'curriculumList'])->name('curriculum.list');
        Route::group(['prefix' => '/daftar-kurikulum/view'], function () {
            Route::get('/{id}', [CurriculumController::class, 'viewCurriculumList'])->name('curriculum.list.view');
            Route::get('/{id}/lihat-mata-kuliah', [CurriculumController::class, 'showCurriculumStudyList'])->name('curriculum.list.view.show-study');
        });
        Route::get('/daftar-kurikulum/tambah/{program_studi}', [CurriculumController::class, 'createCurriculumList'])->name('curriculum.list.create');
        Route::post('/daftar-kurikulum/tambah', [CurriculumController::class, 'storeCurriculumList'])->name('curriculum.list.store');
        Route::group(['prefix' => '/daftar-kurikulum/ubah'], function () {
            Route::get('/{id}', [CurriculumController::class, 'editCurriculumList'])->name('curriculum.list.edit');
            Route::post('/{id}', [CurriculumController::class, 'updateCurriculumList'])->name('curriculum.list.update');
            Route::get('/{id}/lihat-mata-kuliah', [CurriculumController::class, 'showCurriculumStudyList'])->name('curriculum.list.edit.show-study');
            Route::get('/{id}/assign-mata-kuliah', [CurriculumController::class, 'assignCurriculumCourse'])->name('curriculum.list.edit.assign-study');
            Route::post('/{id}/assign-mata-kuliah', [CurriculumController::class, 'updateAssignCurriculumCourse'])->name('curriculum.list.edit.update-assign-study');
            Route::get('/{id}/lihat-mata-kuliah/{course_id}', [CurriculumController::class, 'editCurriculumStudyList'])->name('curriculum.list.edit.edit-study');
        });
        Route::get('/struktur-kurikulum/wajib', [CurriculumController::class, 'requiredCurriculumStructure'])->name('curriculum.required-structure');
        Route::get('/struktur-kurikulum/pilihan', [CurriculumController::class, 'optionalCurriculumStructure'])->name('curriculum.optional-structure');
        Route::get('/ekuivalensi-kurikulum', [CurriculumController::class, 'curriculumEquivalence'])->name('curriculum.equivalence');
        Route::get(
            '/ekuivalensi-kurikulum/tambah/{prodi}/{programPerkuliahan}',
            [CurriculumController::class, 'createCurriculumEquivalence']
        )->name('curriculum.equivalence.create');
        Route::get(
            '/ekuivalensi-kurikulum/edit/{id}',
            [CurriculumController::class, 'editCurriculumEquivalence']
        )->name('curriculum.equivalence.edit');
        Route::get(
            '/ekuivalensi-kurikulum/upload',
            [CurriculumController::class, 'uploadCurriculumEquivalence']
        )->name('curriculum.equivalence.upload');

        Route::post('/upload', [CurriculumController::class, 'uploadResultCurriculumEquivalence'])->name('curriculum.equivalence.upload-result');
        Route::post('/save-upload', [CurriculumController::class, 'uploadStoreCurriculumEquivalence'])->name('curriculum.equivalence.save-upload');
        Route::get('/template', [CurriculumController::class, 'cplDownloadTemplateCurriculumEquivalence'])->name('curriculum.equivalence.template');
    });


    Route::group(['prefix' => 'persiapan-perkuliahan/jadwal-kuliah/program-studi'], function () {

        Route::get('/create/kelas/', [ScheduleController::class, 'jadwalKelas'])->name('academics.schedule.prodi-schedule.add-class-schedule');

        // LIST
        Route::get('/', [ScheduleController::class, 'index'])
            ->name('academics.schedule.prodi-schedule.index');
        Route::get('/create/mata-kuliah/{periode}', [ScheduleController::class, 'mataKuliah'])->name('academics.schedule.prodi-schedule.add-course');
        Route::get('/tambah/dosen', [ScheduleController::class, 'dosen'])->name('academics.schedule.prodi-schedule.add-lecture');


        // CREATE
        Route::get('/tambah', [ScheduleController::class, 'create'])
            ->name('academics.schedule.prodi-schedule.create');
        Route::post('/tambah', [ScheduleController::class, 'store'])
            ->name('academics.schedule.prodi-schedule.store');

        // SHOW
        Route::get(
            '/academics/schedule/prodi-schedule/{id}',
            [\App\Http\Controllers\ScheduleController::class, 'show']
        )->name('academics.schedule.prodi-schedule.show');


        // EDIT
        Route::get('/ubah/{id}', [ScheduleController::class, 'edit'])
            ->name('academics.schedule.prodi-schedule.edit');
        Route::put('/{id}', [ScheduleController::class, 'update'])
            ->name('academics.schedule.prodi-schedule.update');

        // DELETE
        Route::delete('/{id}', [ScheduleController::class, 'destroy'])
            ->name('academics.schedule.prodi-schedule.destroy');

        // IMPORT FET_1
        Route::get('/import/fet1', [ScheduleController::class, 'importFet1'])
            ->name('academics.schedule.prodi-schedule.import-fet1');
        Route::post('/save-upload', [ScheduleController::class, 'uploadStore'])
            ->name('academics.schedule.prodi-schedule.save-upload');

        // AVAILABLE ROOMS
        Route::get('/create/kelas/available-rooms', [ScheduleController::class, 'availableRooms'])
            ->name('academics.schedule.prodi-schedule.available-rooms');
    });
    // TEMPLATE DOWNLOAD
    Route::get('/template-jadwal-kuliah', [ScheduleController::class, 'downloadTemplate'])
        ->name('academics.schedule.prodi-schedule.template');

    // UploadResult **dikeluarkan dari prefix**, supaya tombol form di view tetap jalan
    Route::post('/persiapan-perkuliahan/jadwal-kuliah/program-studi/upload', [ScheduleController::class, 'uploadResult'])
        ->name('academics.schedule.prodi-schedule.upload-result');

    Route::prefix('persiapan-perkuliahan/jadwal-kuliah')->group(function () {
        Route::prefix('parent-institution')->name('academics.schedule.parent-institution-schedule.')->group(function () {
            Route::get('/', [ScheduleController::class, 'parentInstitutionIndex'])->name('index');
            Route::get('/create', [ScheduleController::class, 'parentInstitutionCreate'])->name('create');
            Route::get('/edit/{id}', [ScheduleController::class, 'parentInstitutionEdit'])->name('edit');
            Route::put('/edit/{id}', [ScheduleController::class, 'parentInstitutionUpdate'])->name('update');
            Route::get('/create/add-lecture', [ScheduleController::class, 'parentInstitutionLectureList'])->name('add-lecture');
            Route::get('/create/add-course/{periode}', [ScheduleController::class, 'parentInstitutionCourseList'])->name('add-course');
            Route::get('/create/add-class-schedule/', [ScheduleController::class, 'parentInstitutionClassScheduleCreate'])->name('add-class-schedule');
            Route::post('/create', [ScheduleController::class, 'parentInstitutionStore'])->name('store');
            Route::get('/view/{id}', [ScheduleController::class, 'parentInstitutionView'])->name('view');
            Route::get('/upload', [ScheduleController::class, 'parentInstitutionUpload'])->name('upload');
            Route::post('/upload', [ScheduleController::class, 'parentInstitutionUploadResult'])->name('upload-result');
            Route::get('/download-template', [ScheduleController::class, 'parentInstitutionDownloadTemplate'])->name('download-template');
            Route::post('/upload-store', [ScheduleController::class, 'parentInstitutionUploadStore'])->name('upload-store');
        });
    });

    Route::prefix('persiapan-perkuliahan/auto-assign')->name('academics.auto-assign.')->group(function () {
        Route::get('/', [AutoAssignController::class, 'autoAssignIndex'])->name('index');
        Route::get('/lihat', [AutoAssignController::class, 'autoAssignView'])->name('view');
        Route::get('/peserta-diisi', [AutoAssignController::class, 'autoAssignFilledMember'])->name('filled-member');
        Route::get('/peserta-disetujui', [AutoAssignController::class, 'autoAssignApprovedMember'])->name('approved-member');
        Route::post('/submit', [AutoAssignController::class, 'autoAssignSubmit'])->name('submit');
    });
});
