<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelFormat;

use App\Endpoint\EventCalendarService;
use App\Endpoint\EventAcademicService;
use App\Endpoint\PeriodAcademicService;
use App\Http\Requests\CreateBulkCalendarAcademicRequest;
use App\Http\Requests\StoreCalendarAcademicRequest;
use App\Http\Requests\UpdateCalendarAcademicRequest;
use App\Traits\ApiResponse;
use Exception;

class CalendarController extends Controller
{
  use ApiResponse;

  public function index(Request $request)
  {
    try {
      $url = PeriodAcademicService::getInstance()->getListAllPeriode();
      $response = getCurl($url, null, getHeaders());
      if (!isset($response->data) || !isset($response->success) || !$response->success) {
        throw New \Exception(json_encode($response));
      } 

      $data = $response->data;

      if ($request->ajax()) {
        return $this->successResponse($data, 'Berhasil Mendapatkan Data');
      }

      return view('academics.calendar.index', get_defined_vars());
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal mengambil daftar Calendar Periode Akademik', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data');
      }

      return redirect()
        ->route('home')
        ->withErrors(['error' => $decoded->message ?? 'Gagal mengambil data']);
    }
  }


  public function show(Request $request, $id)
  {
    try {
      $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
      $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
      $programStudiList = $responseProgramStudiList->data;
      
      if(!isset($responseProgramStudiList->data) || !isset($responseProgramStudiList->success) || !$responseProgramStudiList->success || count($responseProgramStudiList->data) == 0) {
        throw New \Exception(json_encode([
          'message'=>'Program studi belum ditambahkan!',
          'system_error' => $responseProgramStudiList,
        ]));
      }
      
      $programPerkuliahanList = config('static-data.program_perkuliahan');
      
      if(!$programPerkuliahanList || count($programPerkuliahanList) == 0) {
        throw New \Exception(json_encode([
          'message'=>'Kesalahan sistem, tunggu beberapa saat lagi!',
          'system_error' => 'Konfigurasi program perkuliahan tidak ditemukan!',
        ]));
      }
      
      $id_prodi = $request->input('program_studi', $programStudiList[0]->id);
      $id_program = $request->input('program_perkuliahan', $programPerkuliahanList[0]['name']);
      $id_periode = $id;
  
      $params = compact('id_program', 'id_prodi', 'id_periode');
      $url = EventCalendarService::getInstance()->eventUrl();
      $response = getCurl($url, $params, getHeaders());
      if (!isset($response->data) || !isset($response->success) || !$response->success) {
        $data = [];
        Log::error('Gagal mengambil daftar Calendar Event Akademik', [
          'url' => $url ?? null,
          'request_data' => $request->all(),
          'response' => $response, 
        ]);
      } else {
        $data = $response->data;
      }
  
      $urlPeriod = PeriodAcademicService::getInstance()->periodUrl($id);
      $responsePeriod = getCurl($urlPeriod, '', getHeaders());
      if(!isset($responsePeriod->success) || !$responsePeriod->success) {
        throw New \Exception(json_encode([
          'message'=>'Periode akademik tidak ditemukan!',
          'system_error' => $responsePeriod
        ]));
      }
      $period = $responsePeriod->data->periode;
  
      $url = EventAcademicService::getInstance()->baseEventURL();
      $responseEvent = getCurl($url, $params, getHeaders());
      $eventAkademik = $responseEvent->data;
  
      if ($request->ajax()) {
        return $this->successResponse($data, 'Berhasil Mendapatkan Data');
      }
  
      return view('academics.calendar.show', get_defined_vars());
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal mengambil daftar Calendar Event Akademik', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded->system_error,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data');
      }

      return redirect()
        ->route('calendar.index')
        ->withErrors(['error' => $decoded->message ?? 'Gagal mengambil data']);
    } 
  }


  public function store(StoreCalendarAcademicRequest $request, $id)
  {
    try {
      $url = EventCalendarService::getInstance()->store();
      $response = postCurl($url, $request->all(), getHeaders());

      if ($request->ajax()) {
        if (isset($response->success) && $response->success) {
          return response()->json([
            'success' => true,
            'message' => 'Berhasil disimpan',
          ]);
        }
      } else {
        if (isset($response->success) && $response->success) {
          return redirect()->back()->with('success', 'Event akademik berhasil ditambahkan.');
        }
      }
        
      throw new \Exception(json_encode($response));

    } catch (\Throwable $e) {
      $decoded = json_decode($e->getMessage());

      Log::error('Gagal menambah calendar Akademik', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded,
      ]);

      if ($request->ajax()) {
        return response()->json([
          'success' => false,
          'message' => $decoded->message
        ], 500);
      }

      return redirect()
        ->back()
        ->withErrors(['error' => $decoded->message ?? 'Gagal menyimpan data'])
        ->withInput();
    }
  }

  public function upload(Request $request, $id)
  {
    try {
      $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
      $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
      if(!isset($responseProgramStudiList->data) || !isset($responseProgramStudiList->success) || !$responseProgramStudiList->success || count($responseProgramStudiList->data) == 0) {
        throw New \Exception(json_encode([
          'message'=>'Program studi belum ditambahkan!',
          'system_error' => $responseProgramStudiList,
        ]));
      }
      $programStudiList = $responseProgramStudiList->data;
      $id_prodi = $request->input('program_studi', $programStudiList[0]->id);
  
      $programPerkuliahanList = config('static-data.program_perkuliahan');
      if(!$programPerkuliahanList || count($programPerkuliahanList) == 0) {
        throw New \Exception(json_encode([
          'message'=>'Kesalahan sistem, tunggu beberapa saat lagi!',
          'system_error' => 'Konfigurasi program perkuliahan tidak ditemukan!',
        ]));
      }
      $id_program = $request->input('program_perkuliahan', $programPerkuliahanList[0]['name']);
  
      return view('academics.calendar.upload', get_defined_vars());
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal memuat halaman upload Calendar Event Akademik', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded,
      ]);

      if ($request->ajax()) {
        return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data');
      }

      return redirect()
        ->route('calendar.index')
        ->withErrors(['error' => $decoded->message ?? 'Gagal mengambil data']);
    }
  }

  public function send(Request $request, $id)
  {
    try {
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
      
      $keyData = $datas[0];
      $valueData = array_slice($datas, 1);

      if(empty($valueData)) throw new \Exception("File yang diupload kosong!");

      $datas = array_values(array_filter(
        array_map(
          function ($data) use($keyData) {
            $findNull = current(array_filter($data, function ($d) { return $d == null; }));
            if($findNull !== null) return array_combine($keyData, $data);
            else return [];
          }, 
          $valueData
        ),
        fn($data) => !empty($data)
      ));

      if(count($datas) === 0) throw new \Exception("File yang diupload memiliki data yang tidak valid pada seluruh barisnya!");

      return view('academics.calendar.upload-result', get_defined_vars());
    } catch (\Exception $err) {
      Log::error('Gagal membaca file kalender akademik', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $err->getMessage() ?? 'Gagal membaca file', 
        'exception' => $err,
      ]);
      return redirect()
        ->back()
        ->withErrors(['error' => $err->getMessage() ?? 'Gagal membaca file'])
        ->withInput();
    }
  }

  public function save(CreateBulkCalendarAcademicRequest $request, $id)
  {
    try {
      $url = EventCalendarService::getInstance()->bulkStore();
      $response = postCurl($url, [
        'eventGlobalCalendar' => $request->input('eventGlobalCalendar'),
        'idperiode' => $id
      ], getHeaders());
  
      if (isset($response->success) && $response->success) {
        return redirect()->route('calendar.show', ['id' => $id])->with('success', 'Unggah Event Kalender Akademik telah berhasil');
      }

      throw new \Exception(json_encode($response));
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());

      Log::error('Gagal menyimpan data event calendar Akademik', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded,
      ]);

      return redirect()->route('calendar.show')->with('error', $decoded->message ?? 'Gagal menyimpan data event akademik');
    }
  }

  public function update(UpdateCalendarAcademicRequest $request, $id)
  {
    try {
      $url = EventCalendarService::getInstance()->edit($request->input('id_calendar'));
      $response = putCurl($url, $request->all(), getHeaders());

      if ($request->ajax()) {
        if (isset($response->success) && $response->success) {
          return response()->json([
            'success' => true,
            'message' => 'Berhasil disimpan'
          ]);
        }
      } else {
        if (isset($response->success) && $response->success) {
          return redirect()->back()->with('success', 'Event akademik berhasil disimpan.');
        }
      }
        
      throw new \Exception(json_encode($response));

    } catch (\Throwable $e) {
      $decoded = json_decode($e->getMessage());

      Log::error('Gagal mengubah calendar Akademik', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded,
      ]);

      if ($request->ajax()) {
        return response()->json([
          'success' => false,
          'message' => $decoded->message ?? 'Gagal menyimpan data'
        ], 500);
      }

      return redirect()
        ->back()
        ->withErrors(['error' => $decoded->message ?? 'Gagal menyimpan data'])
        ->withInput();
    }
  }

  public function delete(Request $request, $id)
  {
    $url = EventCalendarService::getInstance()->edit($id);
    $response = deleteCurl($url, getHeaders());
    return $response;
  }

  public function eventDownloadTemplate(Request $request, $id)
  {
    try {
      $type = $request->query('type', 'xlsx');
      $allowed = ['xlsx', 'csv'];

      if (!in_array($type, $allowed)) throw new \Exception("Format File yang diminta tidak sesuai!");

      $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
      $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
      if(!isset($responseProgramStudiList->data) || !isset($responseProgramStudiList->success) || !$responseProgramStudiList->success || count($responseProgramStudiList->data) == 0) {
        throw New \Exception(json_encode([
          'message'=>'Program studi belum ditambahkan!',
          'system_error' => $responseProgramStudiList,
        ]));
      }
      $programStudiList = $responseProgramStudiList->data;
      $id_prodi = $request->input('program_studi', $programStudiList[0]->id);
      $programStudi = current(array_filter($programStudiList, function($prodi) use($id_prodi) { return $prodi->id == $id_prodi; }));

      if(!$programStudi) throw new \Exception("Program Studi tidak ditemukan!");
      
      $programPerkuliahanList = config('static-data.program_perkuliahan');
      if(!$programPerkuliahanList || count($programPerkuliahanList) == 0) {
        throw New \Exception(json_encode([
          'message'=>'Kesalahan sistem, tunggu beberapa saat lagi!',
          'system_error' => 'Konfigurasi program perkuliahan tidak ditemukan!',
        ]));
      }
      $id_program = $request->input('program_perkuliahan', $programPerkuliahanList[0]['name']);

      $id_periode = $id;
      $params = compact('id_program', 'id_prodi', 'id_periode');

      $url = EventAcademicService::getInstance()->baseEventURL();
      $responseEvent = getCurl($url, $params, getHeaders());
      if(!isset($responseEvent->data) || !isset($responseEvent->success) || !$responseEvent->success || count($responseEvent->data) == 0) {
        throw New \Exception(json_encode([
          'message'=>'Belum ada Calendar Event Akademik yang ditambahkan!',
          'system_error' => $responseEvent,
        ]));
      }
      $eventAkademik = $responseEvent->data;

      $templateValueData = array_map(function ($event) use($programPerkuliahanList, $programStudi) {
        return [
          implode('', array_map(fn($program) => $program['name'] . '|', $programPerkuliahanList)),
          $programStudi->nama,
          $event->nama_event,
          '2025-08-14 12:00:00',
          'yyyy-mm-dd hh:mm:ss',
        ];
      }, $eventAkademik);

      $header = [
        'Program Perkuliahan',
        'Program Studi',
        'Nama Event',
        'Tanggal Mulai',
        'Tanggal Selesai',
      ];

      $data = [...([$header]), ...($templateValueData)];
      $filename = 'template-calender-event-academic.' . $type;

      return Excel::download(new class($data) implements \Maatwebsite\Excel\Concerns\FromArray, \Maatwebsite\Excel\Concerns\WithHeadings {
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
      }, $filename, $type === 'csv' ? ExcelFormat::CSV : ExcelFormat::XLSX);
    } catch (\Throwable $err) {
      $decoded = json_decode($err->getMessage());
      if($decoded === null) {
        return redirect()
          ->route('calendar.show', ['id' => $id])
          ->withErrors(['error' => $err->getMessage() ?? 'Gagal mendownload data'])
          ->withInput();
      }

      Log::error('Gagal download template kalender akademik', [
        'url' => $url ?? null,
        'request_data' => $request->all(),
        'response' => $decoded,
      ]);

      return redirect()
        ->route('calendar.show', ['id' => $id])
        ->withErrors(['error' => $decoded->message ?? 'Gagal mendownload data'])
        ->withInput();
    }
  }


    public function generate(){
        // Data dummy untuk periode sebelumnya
        $dataSebelumnya = [
            ['indikator' => 'Jumlah mahasiswa periode sebelumnya', 'nilai' => '60'],
            ['indikator' => 'Jumlah mahasiswa lulus / DO / mengundurkan diri / transfer periode sebelumnya', 'nilai' => '120'],
        ];

        // Data dummy untuk periode aktif
        $dataAktif = [
            ['indikator' => 'Jumlah mahasiswa lama periode ini', 'nilai' => '7'],
            ['indikator' => 'Jumlah mahasiswa baru', 'nilai' => '20'],
            ['indikator' => 'Jumlah mahasiswa dengan riwayat akademik', 'nilai' => '7'],
        ];

        return view('academics.calendar.generate', get_defined_vars());
    }
}
