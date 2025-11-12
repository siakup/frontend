<?php

namespace App\Http\Controllers;

use App\Endpoint\EventAcademicService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Excel as ExcelFormat;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Endpoint\EventCalendarService;
use App\Endpoint\PeriodAcademicService;
use App\Endpoint\ScheduleService;
use App\Endpoint\UserService;
use App\Traits\ApiResponse;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Log\Logger;

class ScheduleController extends Controller
{
  use ApiResponse;

  public function index(Request $request)
  {
    try {
      $limit = $request->input('limit', 10);
      $page = $request->input('page', 1);
      $search = $request->input('search', '');
      $sort = $request->input('sort', '');
      $program_perkuliahan = $request->input('program_perkuliahan', '');
      $program_studi = $request->input('program_studi', '');
      $params = compact('limit', 'page', 'search', 'sort', 'program_perkuliahan', 'program_studi');
  
      $display = $request->input('display', 'true');
      
      $programPerkuliahanList = config('static-data.program_perkuliahan');
      if(!$programPerkuliahanList || count($programPerkuliahanList) == 0) {
        throw new \Exception(json_encode([
          'message'=>'Kesalahan sistem, tunggu beberapa saat lagi!',
          'system_error' => 'Konfigurasi program perkuliahan tidak ditemukan!',
        ]));
      }
  
      $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
      $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
      if(!isset($responseProgramStudiList->data) || !isset($responseProgramStudiList->success) || !$responseProgramStudiList->success || count($responseProgramStudiList->data) == 0) {
        throw new \Exception(json_encode([
          'message'=>'Program studi belum ditambahkan!',
          'system_error' => $responseProgramStudiList,
        ]));
      }
      $programStudiList = $responseProgramStudiList->data;
  
      $urlPeriode = PeriodAcademicService::getInstance()->getListAllPeriode();
      $responsePeriode = getCurl($urlPeriode, null, getHeaders());
      if(!isset($responsePeriode->data) || !isset($responsePeriode->success) || !$responsePeriode->success || count($responsePeriode->data) == 0) {
        throw new \Exception(json_encode([
          'message'=>'Periode belum ditambahkan!',
          'system_error' => $responsePeriode,
        ]));
      }
      $periodeList = $responsePeriode->data ?? [];
  
      // $urlSchedule = ScheduleService::getInstance()->getSchedule();
      // $responseSchedule = getCurl($urlSchedule, $params, getHeaders());
      // if(!isset($responseSchedule->success) || !$responseSchedule->success) {
      //   throw new \Exception(json_encode([
      //     'message'=>'Gagal memuat jadwal program studi!',
      //     'system_error' => $responseSchedule,
      //   ]));
      // }
      // $dataSchedule = $responseSchedule->data;
  
      $dataSchedule = [
        (object)[
          "id_kelas" => 1,
          "periode" => current(array_filter($periodeList, function($item) { return $item->id == 18; }))->tahun ."/". current(array_filter($periodeList, function($item) { return $item->id == 18; }))->semester,
          'nama_matakuliah'     => (object)[
            "nama_matakuliah_id" => "Agama dan Etika",
          ],
          "nama_kelas" => "Elektronika dan Instrumentasi Geofisika - EIG4",
          "kode_matakuliah" => "52204",
          'kapasitas_peserta'   => 45,
          'scheduleList'        => [
            (object)[
              "hari" => "Senin",
              "jam_akhir" => "14:00",
              "jam_mulai" => "12:00",
              "ruangan" => "Ruangan 2"
            ],
            (object)[
              "hari" => "Jumat",
              "jam_akhir" => "14:00",
              "jam_mulai" => "12:00",
              "ruangan" => "Ruangan 1"
            ]
          ],
          'lectureList'         => [
            (object)[
              "nama" => "Paramita Jaya Ratri",
            ],
            (object)[
              "nama" => "Dosen Rahasia",
            ],
          ],
        ],
        (object)[
          "id_kelas" => 2,
          "periode" => current(array_filter($periodeList, function($item) { return $item->id == 18; }))->tahun ."/". current(array_filter($periodeList, function($item) { return $item->id == 18; }))->semester,
          'nama_matakuliah'     => (object)[
            "nama_matakuliah_id" => "Aljabar Linear dan Aplikasinya",
          ],
          "kode_matakuliah" => "52203",
          "nama_kelas" => "Aljabar Linear dan Aplikasinya - CS3",
          'kapasitas_peserta'   => 45,
          'scheduleList'        => [
            (object)[
              "hari" => "Senin",
              "jam_akhir" => "14:00",
              "jam_mulai" => "12:00",
              "ruangan" => "Ruangan 2"
            ],
            (object)[
              "hari" => "Jumat",
              "jam_akhir" => "14:00",
              "jam_mulai" => "12:00",
              "ruangan" => "Ruangan 1"
            ]
          ],
          'lectureList'         => [
            (object)[
              "nama" => "Paramita Jaya Ratri",
            ],
            (object)[
              "nama" => "Dosen Rahasia",
            ],
          ],
        ],
      ];
  
      $dataSchedule = array_filter($dataSchedule, function($item) use($params) {
        return str_starts_with($item->nama_matakuliah->nama_matakuliah_id, $params['search']) 
          || str_starts_with($item->nama_kelas, $params['search'])
          || str_starts_with($item->kode_matakuliah, $params['search']);
      });
  
      $pagination = [
        'currentPage' => 1,
        'from' => 1,
        'last' => 1,
        'limit' => $limit
      ];
  
      if ($request->ajax()) {
        return $this->successResponse(['schedules' => $dataSchedule, 'pagination' => $pagination] ?? [], 'Daftar Dosen berhasil didapatkan');
      }
  
      return view('academics.schedule.prodi_schedule.index', get_defined_vars());
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal mengambil daftar jadwal program studi', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data daftar jadwal program studi');
      }

      return redirect()
        ->route('home')
        ->withErrors(['error' => $decoded->message ?? 'Gagal memuat halaman daftar jadwal program studi']);
    }
  }

  public function show(Request $request, $id)
  {
    try {
      $urlPeriode = PeriodAcademicService::getInstance()->getListAllPeriode();
      $responsePeriode = getCurl($urlPeriode, null, getHeaders());
      if(!isset($responsePeriode->data) || !isset($responsePeriode->success) || !$responsePeriode->success || count($responsePeriode->data) == 0) {
        throw new \Exception(json_encode([
          'message'=>'Periode belum ditambahkan!',
          'system_error' => $responsePeriode,
        ]));
      }
      $periodeList = $responsePeriode->data ?? [];
  
      // $url = ScheduleService::getInstance()->detailSchedule($id);
      // $response = getCurl($url, null, getHeaders());
      // if(!isset($response->success) || !$response->success) {
      //   throw new \Exception(json_encode([
      //     'message'=>'Data tidak ditemukan!',
      //     'system_error' => $response,
      //   ]));
      // }
      // $item = $response->data;

      $data = (object)[
        "id_kelas" => 1,
        "periode" => current(array_filter($periodeList, function($item) { return $item->id == 18; }))->tahun ."/". current(array_filter($periodeList, function($item) { return $item->id == 18; }))->semester,
        "program_perkuliahan" => 'Regular',
        "program_studi" => "Teknik Kimia",
        'course'     => (object)[
          "nama_matakuliah_id" => "Aljabar Linear dan Aplikasinya",
        ],
        "nama_kelas" => "Aljabar Linear dan Aplikasinya - CS3",
        "nama_singkat" => "ALIN-CS3",
        'kapasitas_peserta'   => 45,
        'tanggal_mulai'       => "13-11-2025",
        'tanggal_akhir'       => "27-11-2025",
        'kelas_mbkm' => false,
        'scheduleList'        => [
          (object)[
            "hari" => "Senin",
            "jam_akhir" => "14:00",
            "jam_mulai" => "12:00",
            "ruangan" => "Ruangan 2"
          ],
          (object)[
            "hari" => "Jumat",
            "jam_akhir" => "14:00",
            "jam_mulai" => "12:00",
            "ruangan" => "Ruangan 1"
          ]
        ],
        'lectureList'         => [
          (object)[
            "nama" => "Paramita Jaya Ratri",
            'status_pengajar' => 'Pengajar Utama',
          ],
          (object)[
            "nama" => "Dosen Rahasia",
            'status_pengajar' => 'Bukan Pengajar Utama',
          ],
        ],
      ];
  
      // $data = [
      //   'id' => $item->id_kelas,
      //   'periode' => $periodeList,
      //   'program_perkuliahan' => $item->perkuliahan ?? null,
      //   'program_studi' => $program_studi,
      //   'mata_kuliah' => $item->nama_matakuliah ?? null,
      //   'nama_kelas' => $item->nama_jadwal,
      //   'nama_singkat' => $item->singkatan_jadwal,
      //   'kapasitas' => $item->jumlah_peserta,
      //   'kelas_mbkm' => $item->is_mbkm ? 'Ya' : 'Tidak',
      //   'tanggal_mulai' => $item->tanggal_mulai,
      //   'tanggal_selesai' => $item->tanggal_akhir,
  
      //   'pengajar' => collect($item->classLecturer)->map(function ($p) {
      //     return [
      //       'nama' => $p->nama_pengajar,
      //       'status' => strtolower($p->status_pengajar) === 'pengajar utama' ? 'utama' : 'bukan',
      //     ];
      //   })->toArray(),
      //   'jadwal' => collect($item->classSchedule)->map(function ($jadwal) {
      //     return [
      //       'hari' => $jadwal->hari,
      //       'waktu' => $jadwal->mulai_kelas . '–' . $jadwal->selesai_kelas,
      //       'ruang' => $jadwal->nama_ruangan,
      //     ];
      //   })->toArray(),
      // ];
  
      if ($request->ajax()) {
        return view('academics.schedule.prodi_schedule._view', get_defined_vars())->render();
      } else {
        throw new \Exception(json_encode([
          'message'=>'Request tidak valid!',
          'system_error' => 'Request tidak valid',
        ]));
      }
      return redirect()->route('academics.schedule.prodi_schedule.index');
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal memuat data jadwal program studi', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded->system_error,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data');
      }

      return redirect()
        ->route('academics.schedule.prodi-schedule.index')
        ->withErrors(['error' => $decoded->message ?? 'Gagal mengambil data jadwal program studi']);
    }
  }

  public function create(Request $request)
  {
    try {
      if($request->ajax()) {
        throw new \Exception(json_encode([
          'message'=>'Request tidak valid!',
          'system_error' => 'Request tidak valid!',
        ]));
      }
      $programPerkuliahanList = config('static-data.program_perkuliahan');
      if(!$programPerkuliahanList || count($programPerkuliahanList) == 0) {
        throw new \Exception(json_encode([
          'message'=>'Kesalahan sistem, tunggu beberapa saat lagi!',
          'system_error' => 'Konfigurasi program perkuliahan tidak ditemukan!',
        ]));
      }
  
      $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
      $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
      if(!isset($responseProgramStudiList->data) || !isset($responseProgramStudiList->success) || !$responseProgramStudiList->success || count($responseProgramStudiList->data) == 0) {
        throw new \Exception(json_encode([
          'message'=>'Program studi belum ditambahkan!',
          'system_error' => $responseProgramStudiList,
        ]));
      }
      $programStudiList = $responseProgramStudiList->data ?? [];
  
      $urlPeriode = PeriodAcademicService::getInstance()->getListAllPeriode();
      $responsePeriode = getCurl($urlPeriode, null, getHeaders());
      if(!isset($responsePeriode->data) || !isset($responsePeriode->success) || !$responsePeriode->success || count($responsePeriode->data) == 0) {
        throw new \Exception(json_encode([
          'message'=>'Periode belum ditambahkan!',
          'system_error' => $responsePeriode,
        ]));
      }
      $periodeList = $responsePeriode->data ?? [];
  
      return view('academics.schedule.prodi_schedule.create', [
        'programPerkuliahanList' => $programPerkuliahanList,
        'programStudiList'       => $programStudiList,
        'periodeList'            => $periodeList,
      ]);
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal memuat halaman tambah jadwal program studi', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded->system_error,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data');
      }

      return redirect()
        ->route('academics.schedule.prodi-schedule.index')
        ->withErrors(['error' => $decoded->message ?? 'Gagal memuat halaman tambah jadwal program studi']);
    }
  }

  public function dosen(Request $request)
  {
    try {
      $limit = $request->input('limit', 5);
      $page = $request->input('page', 1);
      $search = $request->input('search', '');
      $display = $request->input('display', 'true');
      $params = compact('limit', 'page', 'search');
  
      $url = ScheduleService::getInstance()->getLectureList();
      $response = getCurl($url, $params, getHeaders());
      if(!isset($response->success) || !$response->success) {
        throw new \Exception(json_encode([
          'message' => $response->message ?? 'Gagal mendapatkan data daftar dosen',
          'system_error' => $response
        ]));
      }
      $pengajar = $response->data->data;
      $pagination = [
        'currentPage' => $response->data->current_page,
        'from' => $response->data->from,
        'last' => $response->data->last_page,
        'limit' => $limit
      ];
  
      if ($request->ajax()) {
        if($display == 'true') {
          return view('academics.schedule.prodi_schedule._lecture-view', get_defined_vars())->render();
        } else {
          return $this->successResponse(['pengajar' => $pengajar, 'pagination' => $pagination] ?? [], 'Daftar Dosen berhasil didapatkan');
        }
      }
      
      throw new \Exception(json_encode([
        'message' => 'Request tidak valid',
        'system_error' => 'Request tidak valid'
      ]));
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal memuat tampilan pilih dosen ketika menambah/mengubah jadwal program studi', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded->system_error,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data');
      }

      return redirect()
        ->route('academics.schedule.prodi-schedule.create')
        ->withErrors(['error' => $decoded->message ?? 'Gagal memuat tampilan pilih dosen ketika menambah/mengubah jadwal program studi']);
    }
  }

  public function mataKuliah(Request $request, $periode)
  {
    try {
      $limit = $request->input('limit', 5);
      $page = $request->input('page', 1);
      $search = $request->input('search', '');
      $program_perkuliahan = $request->input('program_perkuliahan');
      $program_studi = $request->input('program_studi');
      $display = $request->input('display', 'true');
      $params = compact('limit', 'page', 'search', 'program_perkuliahan', 'program_studi');
      
      $urlPeriode = PeriodAcademicService::getInstance()->periodeUrl($periode);
      $responsePeriode = getCurl($urlPeriode, null, getHeaders());
      if(!isset($responsePeriode->data) || !isset($responsePeriode->success) || !$responsePeriode->success) {
        throw new \Exception(json_encode([
          'message'=>'Periode belum ditambahkan!',
          'system_error' => $responsePeriode ?? [],
        ]));
      }
      $periodeData = $responsePeriode->data->periode;
  
      $url = ScheduleService::getInstance()->getCourseList($periodeData->semester);
      $response = getCurl($url, $params, getHeaders());
      if(!isset($response->success) || !$response->success) {
        throw new \Exception(json_encode([
          'message' => $response->message ?? 'Gagal mendapatkan data mata kuliah',
          'system_error' => $response
        ]));
      }
      $mata_kuliah_list = $response->data->data;
      $pagination = [
        'currentPage' => $response->data->current_page,
        'from' => $response->data->from,
        'last' => $response->data->last_page,
        'limit' => $limit
      ];
  
      if ($request->ajax()) {
        if($display == 'true') {
          return view(
            'academics.schedule.prodi_schedule._course-view',
            get_defined_vars()
          )->render();
        } else {
          return $this->successResponse(['matakuliah' => $mata_kuliah_list, 'pagination' => $pagination] ?? [], 'Daftar Dosen berhasil didapatkan');
        }
      } else {
        throw new \Exception(json_encode([
          'message'=>'Request tidak valid!',
          'system_error' => 'Request tidak valid',
        ]));
      }
  
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal memuat tampilan pilih mata kuliah ketika menambah/mengubah jadwal program studi', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded->system_error,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data');
      }

      return redirect()
        ->route('academics.schedule.prodi-schedule.create')
        ->withErrors(['error' => $decoded->message ?? 'Gagal memuat tampilan pilih mata kuliah']);
    }
  }

  public function jadwalKelas(Request $request)
  {
    return view('academics.schedule.prodi_schedule._create-schedule', get_defined_vars())->render();
  }

  public function availableRooms(Request $request)
  {
    try {
      if(!$request->ajax()) {
        throw new \Exception(json_encode([
          'message' => 'Request tidak valid',
          'system_error' => 'Request tidak valid'
        ]));
      }

      $validated = $request->validate([
        'hari'        => 'required|string',
        'jam_mulai'   => 'required|date_format:H:i',
        'jam_selesai' => 'required|date_format:H:i',
      ]);
  
      $params = [
        'hari'        => strtolower($validated['hari']),
        'jam_mulai'   => $validated['jam_mulai'],
        'jam_selesai' => $validated['jam_selesai'],
      ];
      $url = ScheduleService::getInstance()->getAvailableRooms();
      $response = getCurl($url, $params, getHeaders());
      if (!empty($response->data) && isset($response->success) && $response->success) {
        return response()->json([
          'success' => true,
          'data'    => $response->data,
        ]);
      }

      throw new \Exception(json_encode([
        'message' => $response->message ?? 'Tidak ada ruangan tersedia',
        'system_error' => $response
      ]));
    } catch (\Throwable $e) {
      $decoded = json_decode($e->getMessage());

      Log::error('Gagal memuat daftar ruangan', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded->system_error,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data daftar ruangan');
      }

      return redirect()
        ->route('academics.schedule.prodi-schedule.create')
        ->withErrors(['error' => $decoded->message ?? 'Gagal mengambil data ruangan']);

    }
  }

public function update(Request $r,$id) { /* TODO: call API update */ }

public function importFet1(Request $r) {
  try {
    $programPerkuliahanList = config('static-data.program_perkuliahan');
    if(!$programPerkuliahanList || count($programPerkuliahanList) == 0) {
      throw new \Exception(json_encode([
        'message'=>'Kesalahan sistem, tunggu beberapa saat lagi!',
        'system_error' => 'Konfigurasi program perkuliahan tidak ditemukan!',
      ]));
    }
  
    $urlPeriode = PeriodAcademicService::getInstance()->getListAllPeriode();
    $responsePeriode = getCurl($urlPeriode, null, getHeaders());
    if(!isset($responsePeriode->data) || !isset($responsePeriode->success) || !$responsePeriode->success || count($responsePeriode->data) == 0) {
      throw new \Exception(json_encode([
        'message'=>'Program studi belum ditambahkan!',
        'system_error' => $responsePeriode,
      ]));
    }
    $periodeList = $responsePeriode->data;
  
    $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
    $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
    if(!isset($responseProgramStudiList->data) || !isset($responseProgramStudiList->success) || !$responseProgramStudiList->success || count($responseProgramStudiList->data) == 0) {
      throw new \Exception(json_encode([
        'message'=>'Program studi belum ditambahkan!',
        'system_error' => $responseProgramStudiList,
      ]));
    }
    $programStudiList = $responseProgramStudiList->data;
  
    return view('academics.schedule.prodi_schedule.upload', get_defined_vars());
  } catch (\Throwable $err) {
    $decoded = json_decode($err->getMessage());

    Log::error('Gagal memuat halaman import file FET', [
      'url' => $url ?? null,
      'request_data' => $r->all(),
      'response' => $decoded->system_error,
    ]);

    if ($r->ajax()) {
      return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data');
    }

    return redirect()
      ->route('academics.schedule.prodi-schedule.import-fet1')
      ->withErrors(['error' => $decoded->message ?? 'Gagal memuat halaman import file FET']);
  }
}

public function uploadResult(Request $request)
  {
    try {
      $url = PeriodAcademicService::getInstance()->periodeUrl($request->periode);
      $response = getCurl($url, null, getHeaders());
      if(!isset($response->success) || !$response->success) {
        throw new \Exception(json_encode([
          'message'=>'Program studi belum ditambahkan!',
          'system_error' => $response,
        ]));
      }
      $periode = $response->data->periode;
  
      $file = $request->file('file');
          
      if (!$file) throw new \Exception("File belum diupload!");
      if (!$file->isValid()) throw new \Exception("File upload tidak valid!");
      if ($file->getSize() === 0) throw new \Exception("File yang diupload tidak terisi!");
  
      $allowedExtensions = ['xlsx', 'xls', 'csv'];
      $extension = strtolower($file->getClientOriginalExtension());
  
      if (!in_array($extension, $allowedExtensions)) throw new \Exception("Ekstensi file tidak valid. Harap upload file berformat: .xlsx, .xls, atau .csv");
  
      $allowedMimes = [
        'text/csv',
        'text/plain',
        'application/csv',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
      ];
  
      $mimeType = $file->getMimeType();
      if (!in_array($mimeType, $allowedMimes)) throw new \Exception("Tipe file tidak valid ($mimeType). Harap upload file Excel atau CSV yang benar.");
  
      $maxSize = 5 * 1024 * 1024; 
      if ($file->getSize() > $maxSize) throw new \Exception("Ukuran file terlalu besar. Maksimal 5MB.");
  
      $rows = \Maatwebsite\Excel\Facades\Excel::toArray([], $file);
      $datas = $rows[0] ?? [];
  
      if(empty($datas)) throw new \Exception("File yang diupload kosong!");
      
      $file = $request->file('file');
      $file_data = [];
      $errors = [];
      
      // Convert file ke array of object/array
      $file_data = convertFileDataExcelToObject($file);
      $grouped_datas = [];

      
      array_walk($file_data, function ($item) use(&$grouped_datas) {
        $grouped_datas[$item['activity_id']][] = $item; 
      });
      
      $datas = [];
  
      array_walk($grouped_datas, function($grouped_data) use(&$datas, $periode) {
        $hoursStart = explode('-', $grouped_data[0]['hour']);
        $hoursEnd = explode('-', $grouped_data[count($grouped_data) - 1]['hour']);
        $subject = explode('#', $grouped_data[0]['subject']);
        $teachers = explode('+', $grouped_data[0]['teachers']);
        $studentSets = explode('+', $grouped_data[0]['students_sets']);

        array_walk($studentSets, function($studentSet) use($hoursStart, $hoursEnd, &$datas, $periode, $grouped_data, $subject, $teachers) {
          $existingKey = array_search(
            $subject[1] . '-' . $studentSet . '-' . $periode->tahun,
            array_column($datas, 'nama_kelas')
          );
          if($existingKey !== false) {
            $datas[$existingKey]['scheduleList'][] = [
              'hari' => $grouped_data[0]['day'],
              'jam_mulai' => $hoursStart[0],
              'jam_selesai' => $hoursEnd[1],
              'ruangan' => $grouped_data[0]['room']
            ];
          } else {
            array_push($datas, [
              'scheduleList' => [
                [
                  'hari' => $grouped_data[0]['day'],
                  'jam_mulai' => $hoursStart[0],
                  'jam_selesai' => $hoursEnd[1],
                  'ruangan' => $grouped_data[0]['room']
                ]
              ],
              'semester' => $periode->semester,
              'nama_matakuliah_id' => $subject[1],
              'kode_matakuliah' => $subject[0],
              'kapasitas' => '',
              'ruangan' => $grouped_data[0]['room'],
              'lectureList' => $teachers,
              'nama_kelas' => $subject[1].'-'.$studentSet.'-'.$periode->tahun,
              'program_perkuliahan' => $grouped_data[0]['program']
            ]);
          }
        });
      });
  
      return view('academics.schedule.prodi_schedule.upload-result', get_defined_vars());
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal membaca file', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded->system_error ?? $decoded,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal membaca file');
      }

      return redirect()
        ->route('academics.schedule.prodi-schedule.import-fet1')
        ->withErrors(['error' => $decoded->message ?? 'Gagal membaca file']);
    }
  }

  public function downloadTemplate(Request $request)
  {
    try {
      $type = $request->query('type', 'xlsx');
      $allowed = ['xlsx', 'csv'];
  
      if (!in_array($type, $allowed)) {
        throw new \Exception(json_encode([
          'message' => 'Format file tidak valid, pastikan menggunakan xlsx atau csv',
          'system_error' => 'Format file tidak valid: '.$type
        ]));
      }
  
      $programPerkuliahanList = config('static-data.program_perkuliahan');
      if(!$programPerkuliahanList || count($programPerkuliahanList) == 0) {
        throw new \Exception(json_encode([
          'message'=>'Kesalahan sistem, tunggu beberapa saat lagi!',
          'system_error' => 'Konfigurasi program perkuliahan tidak ditemukan!',
        ]));
      }
      $programPerkuliahan = implode('|', array_map(function($program) {
        return $program['name'];
      }, $programPerkuliahanList));
  
      $data = [
        [
          'Activity Id',
          'Day',
          'Hour',
          'Students Sets',
          'Subject',
          'Teachers',
          'Activity Tags',
          'Room',
          'Program'
        ],
        [1, 'Rabu', '13:00-13:30', 'GP2+GP2DD', '10103#Bahasa Inggris II', 'Harumi Manik Ayu Yamin', 'GP', '2602', $programPerkuliahan],
        [1, 'Rabu', '13:30-14:00', 'GP2+GP2DD', '10103#Bahasa Inggris II', 'Harumi Manik Ayu Yamin', 'GP', '2602', $programPerkuliahan],
        [1, 'Rabu', '14:00-14:30', 'GP2+GP2DD', '10103#Bahasa Inggris II', 'Harumi Manik Ayu Yamin', 'GP', '2602', $programPerkuliahan],
      ];
  
      $filename = 'template-activity.' . $type;
  
      return Excel::download(new class($data) implements FromArray, WithHeadings, WithCustomCsvSettings {
        private $rows;
  
        public function __construct($rows)
        {
          $this->rows = $rows;
        }
  
        public function array(): array
        {
          return array_slice($this->rows, 1);
        }
  
        public function headings(): array
        {
          return $this->rows[0];
        }
  
        public function getCsvSettings(): array
        {
          return [
            'delimiter' => ';',
            'enclosure' => '"',
            'line_ending' => "\n",
            'use_bom' => true,
          ];
        }
      }, $filename, $type === 'csv' ? ExcelFormat::CSV : ExcelFormat::XLSX);
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal mengunduh template jadwal program studi', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded->system_error,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal mengunduh template jadwal program studi');
      }

      return redirect()
        ->back()
        ->withErrors(['error' => $decoded->message ?? 'Gagal mengunduh template jadwal program studi']);
    }
  }

  public function uploadStore(Request $request)
  {
    try {
      dd($request->all());
      $validator = Validator::make($request->all(), [
        'file' => 'required|file|mimes:csv,txt|max:5120', // max 5mb
      ]);
  
      if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
      }
  
      $file = $request->file('file');
      $path = $file->getRealPath();
      $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  
      // Tentukan delimiter (koma atau titik koma)
      $rows = array_map(function ($line) {
        $delimiter = substr_count($line, ';') > substr_count($line, ',') ? ';' : ',';
        return str_getcsv($line, $delimiter);
      }, $lines);
  
      // Ambil header
      $header = array_map('trim', $rows[0]);
      unset($rows[0]);
  
      $dataCplMapping = [];
      foreach ($rows as $index => $row) {
        $row = array_map('trim', $row);
  
        // Skip kalau jumlah kolom tidak sesuai (harus 3)
        if (count($row) < 3) {
          continue;
        }
  
        $dataCplMapping[] = [
          'kode_matakuliah' => $row[0],
          'kode_cpl'        => $row[1],
          'bobot'           => is_numeric($row[2]) ? (int)$row[2] : 0,
        ];
      }
  
      // $url = EventCalendarService::getInstance()->bulkStore();
      // $response = postCurl($url, [
      //   'events' => $eventAkademik,
      //   'idperiode' => $id,
      // ], getHeaders());
  
      return redirect()->route('academics.schedule.prodi-schedule.index', ['id' => $id])->with('success', 'Unggah Event Kalender Akademik telah berhasil');
      // if (isset($response->success) && $response->success) {
      //   return redirect()->route('calendar.show', ['id' => $id])->with('success', 'Unggah Event Kalender Akademik telah berhasil');
      // }
  
      // return redirect()->route('cpl-mapping.index')->with('error', $response->message ?? 'Gagal menyimpan data event akademik');
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal menyimpan daftar data jadwal program studi', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded->system_error,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal menyimpan daftar Data jadwal program studi');
      }

      return redirect()
        ->back()
        ->withErrors(['error' => $decoded->message ?? 'Gagal menympan daftar data jadwal program studi.']);
    }
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'program_perkuliahan' => 'required',
      'program_studi' => 'required',
      'periode' => 'required',
      'nama_matakuliah' => 'required',
      'matakuliah' => 'required',
      'nama_kelas' => 'required',
      'nama_singkat' => 'required',
      'kapasitas_peserta' => 'required',
      'kelas_mbkm' => 'required',
      'tanggal_mulai' => 'required',
      'tanggal_akhir' => 'required',
      'selected_lecture' => 'array',
      'class_schedule' => 'array',
    ]);

    try {
      $url = ScheduleService::getInstance()->createInstitutionSchedule();
      $data = [
        'perkuliahan' => $validated['program_perkuliahan'],
        'id_prodi' => $validated['program_studi'],
        'id_periode' => $validated['periode'],
        'id_matkul' => $validated['matakuliah']['id'],
        'nama_jadwal' => $validated['nama_kelas'],
        'singkatan_jadwal' => $validated['nama_singkat'],
        'jumlah_peserta' => $validated['kapasitas_peserta'],
        'is_mbkm' => $validated['kelas_mbkm'] === 'true',
        'tanggal_mulai' => Carbon::createFromFormat('d-m-Y, H:i', $validated['tanggal_mulai'])->format('Y-m-d H:i:s'),
        'tanggal_akhir' => Carbon::createFromFormat('d-m-Y, H:i', $validated['tanggal_akhir'])->format('Y-m-d H:i:s'),
        'username' => session('username'),
        'jadwal_kelas' => array_map(function ($ruangan) {
          return [
            'id_ruangan'   => $ruangan["'ruangan'"],
            'hari'         => $ruangan["'hari'"],
            'mulai_kelas'  => $ruangan["'jam_mulai_kelas'"],
            'selesai_kelas' => $ruangan["'jam_akhir_kelas'"],
          ];
        }, $validated['class_schedule'] ?? []),
  
        'pengajar' => array_map(function ($pengajar) {
          return [
            'id_pengajar' => $pengajar["id"] ?? 1,
            'nama_pengajar'           => $pengajar["'nama_pengajar'"],
            'pengajar_program_studi'  => $pengajar["'pengajar_program_studi'"],
            'status_pengajar'         => $pengajar["'status_pengajar'"],
          ];
        }, $validated['selected_lecture'] ?? []),
      ];
  
      $response = postCurl($url, $data, getHeaders());
      if ($response->success) {
        return redirect()->route('academics.schedule.prodi-schedule.index')->with('success', 'Jadwal Kuliah Program Studi berhasil ditambahkan.');
      }

      throw new \Exception(json_encode([
        'message' => 'Gagal menyimpan data jadwal program studi',
        'system_error' => $response
      ]));
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal menambahkan data jadwal program studi', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded->system_error,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal menyimpan Data Jadwal Program Studi');
      }

      return redirect()
        ->back()
        ->withErrors(['error' => $decoded->message ?? 'Gagal menyimpan Data Jadwal Program Studi.']);
    }

  }

  public function edit(Request $request, $id)
  {
    try {
      $programPerkuliahanList = config('static-data.program_perkuliahan');
      if(!$programPerkuliahanList || count($programPerkuliahanList) == 0) {
        throw new \Exception(json_encode([
          'message'=>'Kesalahan sistem, tunggu beberapa saat lagi!',
          'system_error' => 'Konfigurasi program perkuliahan tidak ditemukan!',
        ]));
      }
  
      $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
      $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
      if(!isset($responseProgramStudiList->data) || !isset($responseProgramStudiList->success) || !$responseProgramStudiList->success || count($responseProgramStudiList->data) == 0) {
        throw new \Exception(json_encode([
          'message'=>'Program studi belum ditambahkan!',
          'system_error' => $responseProgramStudiList,
        ]));
      }
      $programStudiList = $responseProgramStudiList->data ?? [];
  
      $urlPeriode = PeriodAcademicService::getInstance()->getListAllPeriode();
      $responsePeriode = getCurl($urlPeriode, null, getHeaders());
      if(!isset($responsePeriode->data) || !isset($responsePeriode->success) || !$responsePeriode->success || count($responsePeriode->data) == 0) {
        throw new \Exception(json_encode([
          'message'=>'Program studi belum ditambahkan!',
          'system_error' => $responsePeriode,
        ]));
      }
      $periodeList = $responsePeriode->data;
  
      $data = (object)[
        'program_perkuliahan' => 'Reguler',
        'program_studi'       => 3,
        'periode'             =>  18,
        'course'     => (object)[
          "id_jenis" => "Mata Kuliah Dasar Umum",
          "id_kurikulum" => 2,
          "id_matakuliah" => 1,
          "kode_matakuliah" => "UP0011",
          "nama_matakuliah_id" => "Agama dan Etika",
          "sks" => 2,
        ],
        'nama_kelas'          => "Elektronika dan Instrumentasi Geofisika - EIG4",
        'nama_singkat'        => "AECE2",
        'kapasitas_peserta'   => 45,
        'kelas_mbkm'          => false,
        'tanggal_mulai'       => "13-11-2025",
        'tanggal_akhir'       => "27-11-2025",
        'lectureList'         => [
          (object)[
            "id" => 1,
            "nama" => "Paramita Jaya Ratri",
            "pengajar_program_studi" => "Teknik Kimia",
            "status_pengajar" => "Pengajar Utama"
          ],
          (object)[
            "id" => 2,
            "nama" => "Dosen Rahasia",
            "pengajar_program_studi" => "Teknik Kimia",
            "status_pengajar" => "Bukan Pengajar Utama"
          ],
        ],
        'scheduleList'        => [
          (object)[
            "hari" => "Senin",
            "jam_akhir" => "14:00",
            "jam_mulai" => "12:00",
            "ruangan" => 2
          ],
          (object)[
            "hari" => "Jumat",
            "jam_akhir" => "14:00",
            "jam_mulai" => "12:00",
            "ruangan" => 1
          ]
        ]
      ];
      // $data = [
      //   'program_perkuliahan' => $data['perkuliahan'],
      //   'program_studi'       => $data['id_prodi'],
      //   'periode'             =>  $data['periode']['id'],
      //   'nama_matakuliah'     => $data['nama_matakuliah'],
      //   'nama_kelas'          => $data['nama_jadwal'],
      //   'nama_singkat'        => $data['singkatan_jadwal'],
      //   'kapasitas_peserta'   => $data['jumlah_peserta'],
      //   'kelas_mbkm'          => $data['is_mbkm'],
      //   'tanggal_mulai'       => $data['tanggal_mulai'],
      //   'tanggal_akhir'       => $data['tanggal_akhir'],
      //   'nama_pengajar'       => $data['classLecturer']['nama_pengajar'] ?? [],
      //   'status_pengajar'     => $data['classLecturer']['status_pengajar'] ?? [],
      //   'kode_mata_kuliah'    => $data['curriculumCourse']['course']['kode_matakuliah'] ?? null,
      //   'selected_lecture'    => $data['pengajar'] ?? [],
      //   'class_schedule'           => $data['classSchedule'] ?? [],
      // ];
  
      return view('academics.schedule.prodi_schedule.edit', get_defined_vars());
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal memuat halaman edit jadwal program studi', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded->system_error,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal memuat Data ');
      }

      return redirect()
        ->route('academics.schedule.prodi-schedule.index')
        ->withErrors(['error' => $decoded->message ?? 'Gagal memuat halaman edit jadwal program studi.']);
    }
  }

  public function destroy($id)
  {
    if (!ctype_digit((string)$id)) {
      return response()->json(['message' => 'ID tidak valid'], 422);
    }

    try {
      $url = ScheduleService::getInstance()->destroySchedule($id);
      $ok  = deleteCurl($url, getHeaders());

      if (!isset($ok->data)) {
        return response()->json(['message' => 'Gagal menghapus data.'], 500);
      }

      return response()->json(['message' => 'Jadwal berhasil dihapus.'], 200);
    } catch (\Throwable $e) {
      return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
    }
  }

public function parentInstitutionIndex(Request $request) {
  try {
    $search = $request->input('search', '');
    $limit = $request->input('limit', 10);
    $page = $request->input('page', 1);
    $sort = $request->input('sort');
  
    $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
    $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
    if(!isset($responseProgramStudiList->data) || !isset($responseProgramStudiList->success) || !$responseProgramStudiList->success || count($responseProgramStudiList->data) == 0) {
      throw new \Exception(json_encode([
        'message'=>'Program studi belum ditambahkan!',
        'system_error' => $responseProgramStudiList,
      ]));
    }
    $programStudiList = $responseProgramStudiList->data;
    $program_studi = $request->input('study_program', $programStudiList ? $programStudiList[0]->id : null);
  
    $urlPeran = UserService::getInstance()->getListAllRoles();
    $responsePeranList = getCurl($urlPeran, null, getHeaders());
    if(!isset($responsePeranList->data) || !isset($responsePeranList->success) || !$responsePeranList->success || count($responsePeranList->data) == 0) {
      throw new \Exception(json_encode([
        'message'=>'Peran belum ditambahkan!',
        'system_error' => $responsePeranList,
      ]));
    }
    $peranList = $responsePeranList->data;
    $peran = $request->input('role', $peranList ? $peranList[0]->id : null);
  
    $params = compact('limit', 'page', 'search', 'sort', 'peran', 'program_studi');
  
    $sort = $request->input('sort', 'created_at,desc');
  
    $data = [
      (object)[
        'id' => 1,
        'mata_kuliah' => 'Bahasa Indonesia',
        'nama_kelas' => 'Bahasa Indonesia I-CE1-2024',
        'kapasitas' => 50,
        'jadwal' => [
          (object)[
            'hari' => 'Selasa',
            'jam_mulai' => '13.00',
            'jam_selesai' => '14.40',
            'ruangan' => 2201
          ]
        ],
        'pengajar' => ['Acep Iwan Saidi']
      ],
      (object)[
        'id' => 2,
        'mata_kuliah' => 'Bahasa Inggris I',
        'nama_kelas' => 'Bahasa Inggris I-CE1-2024',
        'kapasitas' => 50,
        'jadwal' => [
          (object)[
            'hari' => 'Selasa',
            'jam_mulai' => '11.30',
            'jam_selesai' => '12.30',
            'ruangan' => 2801
          ],
          (object)[
            'hari' => 'Rabu',
            'jam_mulai' => '08.00',
            'jam_selesai' => '09.40',
            'ruangan' => 2801
          ]
        ],
        'pengajar' => ['Rinaldi Medali', 'Rachman']
      ],
      (object)[
        'id' => 3,
        'mata_kuliah' => 'Berpikir Kritis',
        'nama_kelas' => 'Berpikir Kritis-CE1A-2024',
        'kapasitas' => 70,
        'jadwal' => [
          (object)[
            'hari' => 'Kamis',
            'jam_mulai' => '09.00',
            'jam_selesai' => '10.40',
            'ruangan' => 2201
          ]
        ],
        'pengajar' => ['Alfina Permata Sari']
      ]
    ];
  
    $data = array_filter($data, function($item) use($params) {
      return str_starts_with($item->mata_kuliah, $params['search']) 
        || str_starts_with($item->nama_kelas, $params['search']);
    });
  
    
    $pagination = [
      'currentPage' => 1,
      'from' => 1,
      'last' => 1,
      'limit' => $limit
    ];
    
    if ($request->ajax()) {
      return $this->successResponse(['schedules' => $data, 'pagination' => $pagination] ?? [], 'Daftar Dosen berhasil didapatkan');
    }
  
    return view('academics.schedule.parent-institution_schedule.index', get_defined_vars());
  } catch (\Throwable $err) {
    $decoded = json_decode($err->getMessage());

    Log::error('Gagal mengambil daftar jadwal institusi parent', [
      'url' => $url ?? null,
      'request_data' => $request->all(),
      'response' => $decoded,
    ]);

    if ($request->ajax()) {
      return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data daftar jadwal institusi parent');
    }

    return redirect()
      ->route('home')
      ->withErrors(['error' => $decoded->message ?? 'Gagal memuat halaman daftar jadwal institusi parent']);
  }
}

public function parentInstitutionCreate(Request $request)
{
  try {
    if($request->ajax()) {
      throw new \Exception(json_encode([
        'message'=>'Request tidak valid!',
        'system_error' => 'Request tidak valid!',
      ]));
    }
    $programPerkuliahanList = config('static-data.program_perkuliahan');
    if(!$programPerkuliahanList || count($programPerkuliahanList) == 0) {
      throw new \Exception(json_encode([
        'message'=>'Kesalahan sistem, tunggu beberapa saat lagi!',
        'system_error' => 'Konfigurasi program perkuliahan tidak ditemukan!',
      ]));
    }
  
    $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
    $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
    if(!isset($responseProgramStudiList->data) || !isset($responseProgramStudiList->success) || !$responseProgramStudiList->success || count($responseProgramStudiList->data) == 0) {
      throw new \Exception(json_encode([
        'message'=>'Program studi belum ditambahkan!',
        'system_error' => $responseProgramStudiList,
      ]));
    }
    $programStudiList = $responseProgramStudiList->data;
  
    $urlPeriode = PeriodAcademicService::getInstance()->getListAllPeriode();
    $responsePeriode = getCurl($urlPeriode, null, getHeaders());
    if(!isset($responsePeriode->data) || !isset($responsePeriode->success) || !$responsePeriode->success || count($responsePeriode->data) == 0) {
      throw new \Exception(json_encode([
        'message'=>'Periode belum ditambahkan!',
        'system_error' => $responsePeriode,
      ]));
    }
    $periodeList = $responsePeriode->data;
  
    return view('academics.schedule.parent-institution_schedule.create', get_defined_vars());
  } catch (\Throwable $err) {
    $decoded = json_decode($err->getMessage());

    Log::error('Gagal memuat halaman tambah jadwal institusi parent', [
      'url' => $url ?? null,
      'request_data' => $request->all(),
      'response' => $decoded->system_error,
    ]);

    if ($request->ajax()) {
      return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data');
    }

    return redirect()
      ->route('academics.schedule.parent-institution-schedule.index')
      ->withErrors(['error' => $decoded->message ?? 'Gagal memuat halaman tambah jadwal institusi parent']);
  }
}

  public function parentInstitutionStore(Request $request)
  {
    $validated = $request->validate([
      'program_perkuliahan' => 'required',
      'program_studi' => 'required',
      'periode' => 'required',
      'nama_matakuliah' => 'required',
      'matakuliah' => 'required',
      'nama_kelas' => 'required',
      'nama_singkat' => 'required',
      'kapasitas_peserta' => 'required',
      'kelas_mbkm' => 'required',
      'tanggal_mulai' => 'required',
      'tanggal_akhir' => 'required',
      'selected_lecture' => 'array',
      'class_schedule' => 'array',
    ]);

    try {
      $url = ScheduleService::getInstance()->createSchedule();
      $data = [
        'perkuliahan' => $validated['program_perkuliahan'],
        'id_prodi' => $validated['program_studi'],
        'id_periode_akademik' => $validated['periode'],
        'id_mata_kuliah' => $validated['matakuliah']['id'],
        'nama_jadwal' => $validated['nama_kelas'],
        'singkatan_jadwal' => $validated['nama_singkat'],
        'jumlah_peserta' => $validated['kapasitas_peserta'],
        'is_mbkm' => $validated['kelas_mbkm'],
        'tanggal_mulai' => $validated['tanggal_mulai'],
        'tanggal_akhir' => $validated['tanggal_akhir'],
        'ruangan' => array_map(function ($ruangan) {
          return [
            'id_ruangan' => $ruangan["'ruangan'"],
            'hari' => $ruangan["'hari'"],
            'mulai_kelas' => $ruangan["'jam_mulai_kelas'"],
            'selesai_kelas' => $ruangan["'jam_akhir_kelas'"]
          ];
        }, $validated['class_schedule']),
        'pengajar' => array_map(function ($pengajar) {
          return [
            "id_pengajar" => $pengajar["'id'"],
            "nama_pengajar" => $pengajar["'nama_pengajar'"],
            "status_pengajar" => $pengajar["'status_pengajar'"],
          ];
        }, $validated['selected_lecture']),
      ];
      $response = postCurl($url, $data, getHeaders());
  
      if ($response->success) {
        return redirect()->route('academics.schedule.parent-institution-schedule.index')->with('success', 'Jadwal Kuliah Institusi Parent berhasil ditambahkan.');
      }

      throw new \Exception(json_encode([
        'message' => 'Gagal menyimpan data jadwal institusi parent',
        'system_error' => $response
      ]));
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal menambahkan data jadwal institusi parent', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded->system_error,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal menyimpan Data Jadwal Program Studi');
      }

      return redirect()
        ->back()
        ->withErrors(['error' => $decoded->message ?? 'Gagal menyimpan Data Jadwal Program Studi.']);
    }

  }

  public function parentInstitutionEdit(Request $request, $id)
  {
    try {
      $programPerkuliahanList = config('static-data.program_perkuliahan');
      if(!$programPerkuliahanList || count($programPerkuliahanList) == 0) {
        throw new \Exception(json_encode([
          'message'=>'Kesalahan sistem, tunggu beberapa saat lagi!',
          'system_error' => 'Konfigurasi program perkuliahan tidak ditemukan!',
        ]));
      }

      $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
      $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
      if(!isset($responseProgramStudiList->data) || !isset($responseProgramStudiList->success) || !$responseProgramStudiList->success || count($responseProgramStudiList->data) == 0) {
        throw new \Exception(json_encode([
          'message'=>'Program studi belum ditambahkan!',
          'system_error' => $responseProgramStudiList,
        ]));
      }
      $programStudiList = $responseProgramStudiList->data;
  
      $urlPeriode = PeriodAcademicService::getInstance()->getListAllPeriode();
      $responsePeriode = getCurl($urlPeriode, null, getHeaders());
      if(!isset($responsePeriode->data) || !isset($responsePeriode->success) || !$responsePeriode->success || count($responsePeriode->data) == 0) {
        throw new \Exception(json_encode([
          'message'=>'Program studi belum ditambahkan!',
          'system_error' => $responsePeriode,
        ]));
      }
      $periodeList = $responsePeriode->data;
  
      // $url = ScheduleService::getInstance()->detailSchedule($id);
      // $response = getCurl($url, null, getHeaders());
      // $data = $response->data;
      $data = (object)[
        'program_perkuliahan' => 'Reguler',
        'program_studi'       => 3,
        'periode'             =>  18,
        'course'     => (object)[
          "id_jenis" => "Mata Kuliah Dasar Umum",
          "id_kurikulum" => 2,
          "id_matakuliah" => 1,
          "kode_matakuliah" => "UP0011",
          "nama_matakuliah_id" => "Agama dan Etika",
          "sks" => 2,
        ],
        'nama_kelas'          => "Elektronika dan Instrumentasi Geofisika - EIG4",
        'nama_singkat'        => "AECE2",
        'kapasitas_peserta'   => 45,
        'kelas_mbkm'          => false,
        'tanggal_mulai'       => "13-11-2025",
        'tanggal_akhir'       => "27-11-2025",
        'lectureList'         => [
          (object)[
            "id" => 1,
            "nama" => "Paramita Jaya Ratri",
            "pengajar_program_studi" => "Teknik Kimia",
            "status_pengajar" => "Pengajar Utama"
          ],
          (object)[
            "id" => 2,
            "nama" => "Dosen Rahasia",
            "pengajar_program_studi" => "Teknik Kimia",
            "status_pengajar" => "Bukan Pengajar Utama"
          ],
        ],
        'scheduleList'        => [
          (object)[
            "hari" => "Senin",
            "jam_akhir" => "14:00",
            "jam_mulai" => "12:00",
            "ruangan" => 2
          ],
          (object)[
            "hari" => "Jumat",
            "jam_akhir" => "14:00",
            "jam_mulai" => "12:00",
            "ruangan" => 1
          ]
        ]
      ];
  
      return view('academics.schedule.parent-institution_schedule.edit', get_defined_vars());
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal memuat halaman edit jadwal institusi parent', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded->system_error,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal memuat Data ');
      }

      return redirect()
        ->route('academics.schedule.prodi-schedule.index')
        ->withErrors(['error' => $decoded->message ?? 'Gagal memuat halaman edit jadwal institusi parent.']);
    }
  }

  public function parentInstitutionUpdate(Request $request, $id)
  {
    $validated = $request->validate([
      'program_perkuliahan' => 'required',
      'program_studi' => 'required',
      'periode' => 'required',
      'nama_matakuliah' => 'required',
      'matakuliah' => 'required',
      'nama_kelas' => 'required',
      'nama_singkat' => 'required',
      'kapasitas_peserta' => 'required',
      'kelas_mbkm' => 'required',
      'tanggal_mulai' => 'required',
      'tanggal_akhir' => 'required',
      'selected_lecture' => 'array',
      'class_schedule' => 'array',
    ]);

    try {
      $data = [
        'perkuliahan' => $validated['program_perkuliahan'],
        'id_prodi' => $validated['program_studi'],
        'id_periode_akademik' => $validated['periode'],
        'id_mata_kuliah' => $validated['matakuliah']['id'],
        'nama_jadwal' => $validated['nama_kelas'],
        'singkatan_jadwal' => $validated['nama_singkat'],
        'jumlah_peserta' => $validated['kapasitas_peserta'],
        'is_mbkm' => $validated['kelas_mbkm'],
        'tanggal_mulai' => $validated['tanggal_mulai'],
        'tanggal_akhir' => $validated['tanggal_akhir'],
        'ruangan' => array_map(function ($ruangan) {
          return [
            'id_ruangan' => $ruangan["'ruangan'"],
            'hari' => $ruangan["'hari'"],
            'mulai_kelas' => $ruangan["'jam_mulai_kelas'"],
            'selesai_kelas' => $ruangan["'jam_akhir_kelas'"]
          ];
        }, $validated['class_schedule']),
        'pengajar' => array_map(function ($pengajar) {
          return [
            "id_pengajar" => $pengajar["'id'"],
            "nama_pengajar" => $pengajar["'nama_pengajar'"],
            "status_pengajar" => $pengajar["'status_pengajar'"],
          ];
        }, $validated['selected_lecture']),
      ];
  
      $url = ScheduleService::getInstance()->detailSchedule($id);
      $response = putCurl($url, $data, getHeaders());
  
      if ($response->success) {
        return redirect()->route('academics.schedule.parent-institution-schedule.index')->with('success', 'Jadwal Kuliah Institusi Parent berhasil diubah.');
      }

      throw new \Exception(json_encode([
        'message' => 'Gagal mengubah data jadwal institusi parent',
        'system_error' => $response
      ]));
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal mengubah data jadwal institusi parent', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded->system_error,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal mengubah Data');
      }

      return redirect()
        ->back()
        ->withErrors(['error' => $decoded->message ?? 'Gagal mengubah data jadwal institusi parent']);
    }

  }

  public function parentInstitutionLectureList(Request $request)
  {
    try {
      $limit = $request->input('limit', 5);
      $page = $request->input('page', 1);
      $search = $request->input('search', '');
      $display = $request->input('display', 'true');
      $params = compact('limit', 'page', 'search');
  
      $url = ScheduleService::getInstance()->getLectureList();
      $response = getCurl($url, $params, getHeaders());
      if(!isset($response->success) || !$response->success) {
        throw new \Exception(json_encode([
          'message' => $response->message ?? 'Gagal mendapatkan data daftar dosen',
          'system_error' => $response
        ]));
      }
      $pengajar = $response->data->data;
      $pagination = [
        'currentPage' => $response->data->current_page,
        'from' => $response->data->from,
        'last' => $response->data->last_page,
        'limit' => $limit
      ];
  
      if ($request->ajax()) {
        if($display == 'true') {
          return view('academics.schedule.parent-institution_schedule._lecture-view', get_defined_vars())->render();
        } else {
          return $this->successResponse(['pengajar' => $pengajar, 'pagination' => $pagination] ?? [], 'Daftar Dosen berhasil didapatkan');
        }
      }

      throw new \Exception(json_encode([
        'message' => 'Request tidak valid',
        'system_error' => 'Request tidak valid'
      ]));
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal memuat tampilan pilih dosen ketika menambah/mengubah jadwal institusi parent', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded->system_error,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data');
      }

      return redirect()
        ->route('academics.schedule.parent-institution-schedule.create')
        ->withErrors(['error' => $decoded->message ?? 'Gagal memuat tampilan pilih dosen ketika menambah/mengubah jadwal institusi parent']);
    }
  }

  public function parentInstitutionCourseList(Request $request, $periode)
  {
    try {
      $limit = $request->input('limit', 5);
      $page = $request->input('page', 1);
      $search = $request->input('search', '');
      $program_perkuliahan = $request->input('program_perkuliahan');
      $program_studi = $request->input('program_studi');
      $display = $request->input('display', 'true');
      $params = compact('limit', 'page', 'search', 'program_perkuliahan', 'program_studi');
      
      $urlPeriode = PeriodAcademicService::getInstance()->periodeUrl($periode);
      $responsePeriode = getCurl($urlPeriode, null, getHeaders());
      if(!isset($responsePeriode->data) || !isset($responsePeriode->success) || !$responsePeriode->success) {
        throw new \Exception(json_encode([
          'message'=>'Periode belum ditambahkan!',
          'system_error' => $responsePeriode ?? [],
        ]));
      }
      $periodeData = $responsePeriode->data->periode;
  
      $url = ScheduleService::getInstance()->getCourseList($periodeData->semester);
      $response = getCurl($url, $params, getHeaders());
      if(!isset($response->success) || !$response->success) {
        throw new \Exception(json_encode([
          'message' => $response->message ?? 'Gagal mendapatkan data mata kuliah',
          'system_error' => $response
        ]));
      }
      $mata_kuliah_list = $response->data->data;
      $pagination = [
        'currentPage' => $response->data->current_page,
        'from' => $response->data->from,
        'last' => $response->data->last_page,
        'limit' => $limit
      ];
  
      if ($request->ajax()) {
        if($display == 'true') {
          return view(
            'academics.schedule.parent-institution_schedule._course-view',
            get_defined_vars()
          )->render();
        } else {
          return $this->successResponse(['matakuliah' => $mata_kuliah_list, 'pagination' => $pagination] ?? [], 'Daftar Dosen berhasil didapatkan');
        }
      }
      throw new \Exception(json_encode([
        'message'=>'Request tidak valid!',
        'system_error' => 'Request tidak valid',
      ]));
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal memuat tampilan pilih mata kuliah ketika menambah/mengubah jadwal institusi parent', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded->system_error,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data');
      }

      return redirect()
        ->route('academics.schedule.parent-institution-schedule.create')
        ->withErrors(['error' => $decoded->message ?? 'Gagal memuat tampilan pilih mata kuliah']);
    }
  }

  public function parentInstitutionView(Request $request, $id)
  {
    try {
      // $programPerkuliahanList = config('static-data.program_perkuliahan');
      // if(!$programPerkuliahanList || count($programPerkuliahanList) == 0) {
      //   throw new \Exception(json_encode([
      //     'message'=>'Kesalahan sistem, tunggu beberapa saat lagi!',
      //     'system_error' => 'Konfigurasi program perkuliahan tidak ditemukan!',
      //   ]));
      // }
    
      // $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
      // $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
      // if(!isset($responseProgramStudiList->data) || !isset($responseProgramStudiList->success) || !$responseProgramStudiList->success || count($responseProgramStudiList->data) == 0) {
      //   throw new \Exception(json_encode([
      //     'message'=>'Program studi belum ditambahkan!',
      //     'system_error' => $responseProgramStudiList,
      //   ]));
      // }
      // $programStudiList = $responseProgramStudiList->data;
    
      $urlPeriode = PeriodAcademicService::getInstance()->getListAllPeriode();
      $responsePeriode = getCurl($urlPeriode, null, getHeaders());
      if(!isset($responsePeriode->data) || !isset($responsePeriode->success) || !$responsePeriode->success || count($responsePeriode->data) == 0) {
        throw new \Exception(json_encode([
          'message'=>'Periode belum ditambahkan!',
          'system_error' => $responsePeriode,
        ]));
      }
      $periodeList = $responsePeriode->data;
    
      // $url = ScheduleService::getInstance()->detailSchedule($id);
      // $response = getCurl($url, null, getHeaders());
      // if(!isset($response->success) || !$response->success) {
      //   throw new \Exception(json_encode([
      //     'message'=>'Data tidak ditemukan!',
      //     'system_error' => $response,
      //   ]));
      // }
      // $data = $response->data;
    
      $data = (object)[
        "id_kelas" => 1,
        "periode" => current(array_filter($periodeList, function($item) { return $item->id == 18; }))->tahun ."/". current(array_filter($periodeList, function($item) { return $item->id == 18; }))->semester,
        "program_perkuliahan" => 'Regular',
        "program_studi" => "Teknik Kimia",
        'course'     => (object)[
          "nama_matakuliah_id" => "Aljabar Linear dan Aplikasinya",
        ],
        "nama_kelas" => "Aljabar Linear dan Aplikasinya - CS3",
        "nama_singkat" => "ALIN-CS3",
        'kapasitas_peserta'   => 45,
        'tanggal_mulai'       => "13-11-2025",
        'tanggal_akhir'       => "27-11-2025",
        'kelas_mbkm' => false,
        'scheduleList'        => [
          (object)[
            "hari" => "Senin",
            "jam_akhir" => "14:00",
            "jam_mulai" => "12:00",
            "ruangan" => "Ruangan 2"
          ],
          (object)[
            "hari" => "Jumat",
            "jam_akhir" => "14:00",
            "jam_mulai" => "12:00",
            "ruangan" => "Ruangan 1"
          ]
        ],
        'lectureList'         => [
          (object)[
            "nama" => "Paramita Jaya Ratri",
            'status_pengajar' => 'Pengajar Utama',
          ],
          (object)[
            "nama" => "Dosen Rahasia",
            'status_pengajar' => 'Bukan Pengajar Utama',
          ],
        ],
      ];
      
      if ($request->ajax()) {
        return view('academics.schedule.parent-institution_schedule._view', get_defined_vars())->render();
      }
      throw new \Exception(json_encode([
        'message'=>'Request tidak valid!',
        'system_error' => 'Request tidak valid',
      ]));
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal memuat data jadwal institusi parent', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded->system_error,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data');
      }

      return redirect()
        ->route('academics.schedule.parent-institution-schedule.index')
        ->withErrors(['error' => $decoded->message ?? 'Gagal mengambil data jadwal institusi parent']);
    }
  }

  public function parentInstitutionClassScheduleCreate(Request $request)
  {
    return view('academics.schedule.parent-institution_schedule._create-schedule', get_defined_vars())->render();
  }

  public function parentInstitutionUpload(Request $request)
  {
    try {
      $programPerkuliahanList = config('static-data.program_perkuliahan');
      if(!$programPerkuliahanList || count($programPerkuliahanList) == 0) {
        throw new \Exception(json_encode([
          'message'=>'Kesalahan sistem, tunggu beberapa saat lagi!',
          'system_error' => 'Konfigurasi program perkuliahan tidak ditemukan!',
        ]));
      }

      $urlPeriode = PeriodAcademicService::getInstance()->getListAllPeriode();
      $responsePeriode = getCurl($urlPeriode, null, getHeaders());
      if(!isset($responsePeriode->data) || !isset($responsePeriode->success) || !$responsePeriode->success || count($responsePeriode->data) == 0) {
        throw new \Exception(json_encode([
          'message'=>'Program studi belum ditambahkan!',
          'system_error' => $responsePeriode,
        ]));
      }
      $periodeList = $responsePeriode->data;
  
      $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
      $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
      if(!isset($responseProgramStudiList->data) || !isset($responseProgramStudiList->success) || !$responseProgramStudiList->success || count($responseProgramStudiList->data) == 0) {
        throw new \Exception(json_encode([
          'message'=>'Program studi belum ditambahkan!',
          'system_error' => $responseProgramStudiList,
        ]));
      }
      $programStudiList = $responseProgramStudiList->data;

      return view('academics.schedule.parent-institution_schedule.upload', get_defined_vars());
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal memuat halaman import file FET', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded->system_error,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data');
      }

      return redirect()
        ->route('academics.schedule.parent-institution-schedule.import-fet1')
        ->withErrors(['error' => $decoded->message ?? 'Gagal memuat halaman import file FET']);
    }
  }

  public function parentInstitutionUploadResult(Request $request)
  {
    try {
      $url = PeriodAcademicService::getInstance()->periodeUrl($request->periode);
      $response = getCurl($url, null, getHeaders());
      if(!isset($response->success) || !$response->success) {
        throw new \Exception(json_encode([
          'message'=>'Program studi belum ditambahkan!',
          'system_error' => $response,
        ]));
      }
      $periode = $response->data->periode;
  
      $file = $request->file('file');
          
      if (!$file) throw new \Exception("File belum diupload!");
      if (!$file->isValid()) throw new \Exception("File upload tidak valid!");
      if ($file->getSize() === 0) throw new \Exception("File yang diupload tidak terisi!");
  
      $allowedExtensions = ['xlsx', 'xls', 'csv'];
      $extension = strtolower($file->getClientOriginalExtension());
  
      if (!in_array($extension, $allowedExtensions)) throw new \Exception("Ekstensi file tidak valid. Harap upload file berformat: .xlsx, .xls, atau .csv");
  
      $allowedMimes = [
        'text/csv',
        'text/plain',
        'application/csv',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
      ];
  
      $mimeType = $file->getMimeType();
      if (!in_array($mimeType, $allowedMimes)) throw new \Exception("Tipe file tidak valid ($mimeType). Harap upload file Excel atau CSV yang benar.");
  
      $maxSize = 5 * 1024 * 1024; 
      if ($file->getSize() > $maxSize) throw new \Exception("Ukuran file terlalu besar. Maksimal 5MB.");
  
      $rows = \Maatwebsite\Excel\Facades\Excel::toArray([], $file);
      $datas = $rows[0] ?? [];
  
      if(empty($datas)) throw new \Exception("File yang diupload kosong!");
      
      $file = $request->file('file');
      $file_data = [];
      $errors = [];
      
      // Convert file ke array of object/array
      $file_data = convertFileDataExcelToObject($file);
      $grouped_datas = [];
  
      array_walk($file_data, function ($item) use(&$grouped_datas) {
        $grouped_datas[$item['activity_id']][] = $item; 
      });
  
      $datas = [];
  
      array_walk($grouped_datas, function($grouped_data) use(&$datas, $periode) {
        $hoursStart = explode('-', $grouped_data[0]['hour']);
        $hoursEnd = explode('-', $grouped_data[count($grouped_data) - 1]['hour']);
        $subject = explode('#', $grouped_data[0]['subject']);
        $teachers = explode('+', $grouped_data[0]['teachers']);
        $studentSets = explode('+', $grouped_data[0]['students_sets']);

        array_walk($studentSets, function($studentSet) use($hoursStart, $hoursEnd, &$datas, $periode, $grouped_data, $subject, $teachers) {
          $existingKey = array_search(
            $subject[1] . '-' . $studentSet . '-' . $periode->tahun,
            array_column($datas, 'nama_kelas')
          );
          if($existingKey !== false) {
            $datas[$existingKey]['scheduleList'][] = [
              'hari' => $grouped_data[0]['day'],
              'jam_mulai' => $hoursStart[0],
              'jam_selesai' => $hoursEnd[1],
              'ruangan' => $grouped_data[0]['room']
            ];
          } else {
            array_push($datas, [
              'scheduleList' => [
                [
                  'hari' => $grouped_data[0]['day'],
                  'jam_mulai' => $hoursStart[0],
                  'jam_selesai' => $hoursEnd[1],
                  'ruangan' => $grouped_data[0]['room']
                ]
              ],
              'semester' => $periode->semester,
              'nama_matakuliah_id' => $subject[1],
              'kode_matakuliah' => $subject[0],
              'kapasitas' => '',
              'ruangan' => $grouped_data[0]['room'],
              'lectureList' => $teachers,
              'nama_kelas' => $subject[1].'-'.$studentSet.'-'.$periode->tahun,
              'program_perkuliahan' => $grouped_data[0]['program']
            ]);
          }
        });
      });
  
      return view('academics.schedule.parent-institution_schedule.upload-result', get_defined_vars());
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal membaca file', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded->system_error ?? $decoded,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal membaca file');
      }

      return redirect()
        ->route('academics.schedule.parent-institution-schedule.upload')
        ->withErrors(['error' => $decoded->message ?? 'Gagal membaca file']);
    }
  }

  public function parentInstitutionDownloadTemplate(Request $request)
  {
    try {
      $type = $request->query('type', 'xlsx');
      $allowed = ['xlsx', 'csv'];
  
      if (!in_array($type, $allowed)) {
        throw new \Exception(json_encode([
          'message' => 'Format file tidak valid, pastikan menggunakan xlsx atau csv',
          'system_error' => 'Format file tidak valid: '.$type
        ]));
      }
  
      $programPerkuliahanList = config('static-data.program_perkuliahan');
      if(!$programPerkuliahanList || count($programPerkuliahanList) == 0) {
        throw new \Exception(json_encode([
          'message'=>'Kesalahan sistem, tunggu beberapa saat lagi!',
          'system_error' => 'Konfigurasi program perkuliahan tidak ditemukan!',
        ]));
      }
      $programPerkuliahan = implode('|', array_map(function($program) {
        return $program['name'];
      }, $programPerkuliahanList));
  
      $data = [
        [
          'Activity Id',
          'Day',
          'Hour',
          'Students Sets',
          'Subject',
          'Teachers',
          'Activity Tags',
          'Room',
          'Program'
        ],
        [1, 'Rabu', '13:00-13:30', 'GP2+GP2DD', '10103#Bahasa Inggris II', 'Harumi Manik Ayu Yamin', 'GP', '2602', $programPerkuliahan],
        [1, 'Rabu', '13:30-14:00', 'GP2+GP2DD', '10103#Bahasa Inggris II', 'Harumi Manik Ayu Yamin', 'GP', '2602', $programPerkuliahan],
        [1, 'Rabu', '14:00-14:30', 'GP2+GP2DD', '10103#Bahasa Inggris II', 'Harumi Manik Ayu Yamin', 'GP', '2602', $programPerkuliahan],
      ];
  
      $filename = 'template-activity.' . $type;
  
      return Excel::download(new class($data) implements FromArray, WithHeadings, WithCustomCsvSettings {
        private $rows;
  
        public function __construct($rows)
        {
          $this->rows = $rows;
        }
  
        public function array(): array
        {
          return array_slice($this->rows, 1);
        }
  
        public function headings(): array
        {
          return $this->rows[0];
        }
  
        public function getCsvSettings(): array
        {
          return [
            'delimiter' => ';',
            'enclosure' => '"',
            'line_ending' => "\n",
            'use_bom' => true,
          ];
        }
      }, $filename, $type === 'csv' ? ExcelFormat::CSV : ExcelFormat::XLSX);
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal mengunduh template jadwal institusi parent', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded->system_error,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal mengunduh template jadwal institusi parent');
      }

      return redirect()
        ->back()
        ->withErrors(['error' => $decoded->message ?? 'Gagal mengunduh template jadwal institusi parent']);
    }
  }

  public function parentInstitutionUploadStore(Request $request)
  {
    try {
      dd($request->all());
      $validator = Validator::make($request->all(), [
        'file' => 'required|file|mimes:csv,txt|max:5120', // max 5mb
      ]);
  
      if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
      }
  
      $file = $request->file('file');
      $path = $file->getRealPath();
      $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  
      // Tentukan delimiter (koma atau titik koma)
      $rows = array_map(function ($line) {
        $delimiter = substr_count($line, ';') > substr_count($line, ',') ? ';' : ',';
        return str_getcsv($line, $delimiter);
      }, $lines);
  
      // Ambil header
      $header = array_map('trim', $rows[0]);
      unset($rows[0]);
  
      $dataCplMapping = [];
      foreach ($rows as $index => $row) {
        $row = array_map('trim', $row);
  
        // Skip kalau jumlah kolom tidak sesuai (harus 3)
        if (count($row) < 3) {
          continue;
        }
  
        $dataCplMapping[] = [
          'kode_matakuliah' => $row[0],
          'kode_cpl'        => $row[1],
          'bobot'           => is_numeric($row[2]) ? (int)$row[2] : 0,
        ];
      }
  
      // $url = EventCalendarService::getInstance()->bulkStore();
      // $response = postCurl($url, [
      //   'events' => $eventAkademik,
      //   'idperiode' => $id,
      // ], getHeaders());
  
      return redirect()->route('cpl-mapping.index', ['id' => $id])->with('success', 'Unggah Event Kalender Akademik telah berhasil');
      // if (isset($response->success) && $response->success) {
      //   return redirect()->route('calendar.show', ['id' => $id])->with('success', 'Unggah Event Kalender Akademik telah berhasil');
      // }
  
      // return redirect()->route('cpl-mapping.index')->with('error', $response->message ?? 'Gagal menyimpan data event akademik');
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal menyimpan daftar data jadwal institusi parent', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded->system_error,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal menyimpan daftar Data jadwal institusi parent');
      }

      return redirect()
        ->back()
        ->withErrors(['error' => $decoded->message ?? 'Gagal menympan daftar data jadwal institusi parent.']);
    }
  }
}
