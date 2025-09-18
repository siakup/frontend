<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Endpoint\CourseService;
use App\Endpoint\EventCalendarService;
use App\Endpoint\UserService;
use App\Traits\ApiResponse;
use Maatwebsite\Excel\Facades\Excel;

use Exception;
use Svg\Tag\Rect;

class StudyController extends Controller
{
  use ApiResponse;

  public function index(Request $request)
  {
    $search = $request->input('search');
    $page = $request->input('page', 1);
    $limit = $request->input('limit', 10);
    $programStudi = $request->input('programStudi');
    $sortBy = $request->input('sortBy');

    $params = [
      'search' => $search,
      'page' => $page,
      'limit' => $limit,
      'programStudi' => $programStudi,
      'sortBy' => $sortBy
    ];

    $urlProgramStudi = UserService::getInstance()->getListAllInstitution();
    $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
    $programStudiList = $responseProgramStudiList->data ?? [];

    $url = CourseService::getInstance()->url();
    $response = getCurl($url, $params, getHeaders());
    $mataKuliahList = $response->data ?? [];


    $courses = [
      'getmataKuliah' => $response->data ?? [],
      'getprogramStudiList' => $programStudiList ?? [],
    ];

    return view('study.index', [
      'mataKuliahList' => $courses['getmataKuliah'],
      'programStudiList' => $courses['getprogramStudiList'],
      'search' => $search,
      'programStudi' => $programStudi,
      'sortBy' => $sortBy
    ]);
  }

  public function create(Request $request)
  {
    $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
    $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
    $programStudiList = $responseProgramStudiList->data;
    $programStudiList = collect($programStudiList)->pluck('nama', 'id')->toArray();

    $jenis_mata_kuliah = config('static-data.jenis_mata_kuliah');

    return view('study.create', get_defined_vars());
  }

  public function edit(Request $request, $id)
  {
    return view('study.edit', get_defined_vars());
  }

  public function view(Request $request, $id)
  {
    return view('study.view', get_defined_vars());
  }

  public function upload(Request $request)
  {
    return view('study.upload', get_defined_vars());
  }

  public function uploadResult(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'file' => 'required|file|mimes:csv,xlsx|max:5120'
    ]);
    $file = $request->file('file');
    $file_data = [];
    $errors = [];

    $file_data = convertFileDataExcelToObject($file);
    $file_data = array_map(function ($value) {
      return [
        'kode' => $value['kode_mk'],
        'nama' => $value['nama_mk'],
        'sks' => $value['sks'],
        'jenis' => $value['jenis_mk'],
        'semester' => $value['semester']
      ];
    }, $file_data);

    return view('study.upload-result', get_defined_vars());
  }

  public function uploadStore(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'file' => 'required|file|mimes:csv,txt|max:5120', // max 5mb
    ]);

    if ($validator->fails()) {
      return back()->withErrors($validator)->withInput();
    }

    $file = $request->file('file');
    $path = $file->getRealPath();
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    //validasi apakah menggunakan koma atau titik koma
    $rows = array_map(function ($line) {
      $delimiter = substr_count($line, ';') > substr_count($line, ',') ? ';' : ',';
      return str_getcsv($line, $delimiter);
    }, $lines);

    $header = array_map('trim', $rows[0]);
    unset($rows[0]);

    $eventAkademik = [];
    foreach ($rows as $index => $row) {
      $row = array_map('trim', $row);

      if (count($row) < 9) {
        continue;
      }

      $eventAkademik[] = [
        'nama'         => $row[0],
        'event_nilai'  => strtolower($row[1]) === 'y',
        'event_krs'    => strtolower($row[2]) === 'y',
        'event_lulus'  => strtolower($row[3]) === 'y',
        'registrasi'   => strtolower($row[4]) === 'y',
        'yudisium'     => strtolower($row[5]) === 'y',
        'survei'       => strtolower($row[6]) === 'y',
        'event_dosen'  => strtolower($row[7]) === 'y',
        'status'       => strtolower($row[8]) === 'active' ? 'active' : 'inactive',
        'calendar_id'  => $id,
      ];
    }

    // $url = EventCalendarService::getInstance()->bulkStore();
    // $response = postCurl($url, [
    //   'events' => $eventAkademik,
    //   'idperiode' => $id,
    // ], getHeaders());

    return redirect()->route('study.index', ['id' => $id])->with('success', 'Unggah Event Kalender Akademik telah berhasil');
    // if (isset($response->success) && $response->success) {
    //   return redirect()->route('calendar.show', ['id' => $id])->with('success', 'Unggah Event Kalender Akademik telah berhasil');
    // }

    return redirect()->route('calendar.index')->with('error', $response->message ?? 'Gagal menyimpan data event akademik');
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'kode' => 'required',
      'nama_id' => 'required',
      'nama_en' => 'required',
      'sks' => 'required',
      'semester' => 'required',
      'id_prodi' => 'required',
      'tujuan' => 'required',
      'deskripsi' => 'required',
      'daftar_pustaka' => 'required',
      'status' => 'required',
    ]);

    $mataKuliah = [
        'kode_matakuliah' => $validated['kode'],
        'nama_matakuliah_id' => $validated['nama_id'],
        'nama_matakuliah_en' => $validated['nama_en'],
        'nama_singkat' => $validated['short_name'],
        'id_prodi' => $validated['id_prodi'],
        'sks' => $validated['sks'],
        'semester' => $validated['semester'],
        'deskripsi' => $validated['deskripsi'],
        'tujuan' => $validated['tujuan'],
        'daftar_pustaka' => $validated['daftar_pustaka'],
        'id_jenis' => $validated['course_type'],
        'id_koordinator' => $validated['coordinator'],
        'matakuliah_spesial' => $validated['special_course'],
        'prodi_lain' => $validated['open_for_other'],
        'matakuliah_wajib' => $validated['mandatory'],
        'kampus_merdeka' => $validated['merdeka_campus'],
        'matakuliah_capstone' => $validated['capstone'],
        'matakuliah_kerja_praktik' => $validated['internship'],
        'matakuliah_tugas_akhir' => $validated['final_assignment'],
        'matakuliah_minor' => $validated['minor'],
        'status' => $validated['status'] === 1 ? "active" : 'inactive',
        'created_by' => $validated['created_by'],
        'updated_by' => $validated['updated_by'] ?? $validated['created_by'],
    ];
      
    $url = CourseService::getInstance()->url();
    $response = postCurl($url, null, $mataKuliah);
    
    return $response;
  }

  public function send(Request $request, $id)
  {
    return redirect()->route('calendar.show', ['id' => $id])->with('success', 'Unggah Event Kalender Akademik telah berhasil');
  }

  public function update(Request $request, $id) {}

  public function delete($id)
  {
    $url = CourseService::getInstance()->courseUrl($id);
    $response = deleteCurl($url, getHeaders());

    if (isset($response['status']) && $response['status'] == 'success') {
      return response()->json([
        'status' => 'success',
        'message' => 'Mata kuliah berhasil dihapus'
      ], 200);
    }

    return response()->json([
      'status' => 'error',
      'message' => $response['message'] ?? 'Gagal menghapus mata kuliah'
    ], 400);
  }
}
