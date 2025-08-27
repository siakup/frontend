<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\StudyController;
use App\Http\Controllers\CplMapping;

// Route::group(['middleware' => ['auth']], function () {
  Route::group(['prefix' => 'academics'], function () {
    //periode akademik
    Route::get('/periode', [AcademicController::class, 'indexPeriode'])->name('academics-periode.index');
    Route::get('/periode/create', [AcademicController::class, 'createPeriode'])->name('academics-periode.create');
    Route::post('/periode', [AcademicController::class, 'periodeStore'])->name('academics-periode.store');

    Route::get('/periode/edit/{id}', [AcademicController::class, 'periodeEdit'])->name('academics-periode.edit');
    Route::put('/periode/update/{id}', [AcademicController::class, 'periodeUpdate'])->name('academics-periode.update');

    Route::get('/periode-detail', [AcademicController::class, 'periodeDetail'])->name('academics-periode.detail');
    Route::get('/periode-edit/{id}', [AcademicController::class, 'periodeEdit'])->name('academics-periode.edit');
    Route::delete('/periode/delete/{id}',  [AcademicController::class, 'periodeDelete'])->name('academics-periode.delete');

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

Route::group(['prefix' => 'pemetaan-cpl'], function () {
    Route::get('/', [CplMapping::class, 'index'])->name('cpl-mapping.index');
    Route::get('/tambah', [CplMapping::class, 'create'])->name('cpl-mapping.create');
    Route::get('/edit/{id}', [CplMapping::class, 'edit'])->name('cpl-mapping.edit');
    Route::get('/view/{id}', [CplMapping::class, 'view'])->name('cpl-mapping.view');
    Route::get('/upload', [CplMapping::class, 'upload'])->name('cpl-mapping.upload');
    Route::post('/upload', [CplMapping::class, 'uploadResult'])->name('cpl-mapping.upload-result');
    Route::post('/save-upload', [CplMapping::class, 'uploadStore'])->name('cpl-mapping.save-upload');
    Route::get('/template', [CplMapping::class, 'cplDownloadTemplate'])->name('cpl-mapping.template');
});
