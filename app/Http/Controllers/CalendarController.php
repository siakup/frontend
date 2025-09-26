<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelFormat;

use App\Endpoint\EventCalendarService;
use App\Endpoint\EventAcademicService;
use App\Endpoint\PeriodAcademicService;
use App\Traits\ApiResponse;
use DateTime;
use Exception;
use Illuminate\Console\Scheduling\Event;
use Svg\Tag\Rect;

class CalendarController extends Controller
{
  use ApiResponse;

  public function index(Request $request)
  {
    $url = PeriodAcademicService::getInstance()->getListAllPeriode();

    $response = getCurl($url, null, getHeaders());

    if (!isset($response->data)) {
      if ($request->ajax()) {
        return $this->errorResponse($response->message ?? 'Gagal Mengambil Data');
      }
      $data = [];
    } else {
      $data = $response->data;
    }


    if ($request->ajax()) {
      return $this->successResponse($data, 'Berhasil Mendapatkan Data');
    }

    return view('academics.calendar.index', get_defined_vars());
  }


  public function show(Request $request, $id)
  {

    $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
    $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
    $programStudiList = $responseProgramStudiList->data;
    $id_prodi = $request->input('program_studi', $programStudiList[0]->id);

    $urlProgramPerkuliahan = EventCalendarService::getInstance()->getListUniversityProgram();
    $responseProgramPerkuliahanList = getCurl($urlProgramPerkuliahan, null, getHeaders());
    $programPerkuliahanList = $responseProgramPerkuliahanList->data;
    $id_program = $request->input('program_perkuliahan', $programPerkuliahanList[0]->name);

    $id_periode = $id;

    $params = compact('id_program', 'id_prodi', 'id_periode');
    $url = EventCalendarService::getInstance()->eventUrl();
    $response = getCurl($url, $params, getHeaders());

    $urlPeriod = PeriodAcademicService::getInstance()->periodUrl($id);
    $responsePeriod = getCurl($urlPeriod, '', getHeaders());
    $period = $responsePeriod->data->periode;

    $url = EventAcademicService::getInstance()->baseEventURL();
    $responseEvent = getCurl($url, $params, getHeaders());
    $eventAkademik = $responseEvent->data;

    if (!isset($response->data)) {
      if ($request->ajax()) {
        return $this->errorResponse($response->message ?? 'Gagal Mengambil Data');
      }
      $data = [];
    } else {
      $data = $response->data;
    }

    if ($request->ajax()) {
      return $this->successResponse($data, 'Berhasil Mendapatkan Data');
    }

    return view('academics.calendar.show', get_defined_vars());
  }


  public function store(Request $request, $id)
  {
    //validasi data
    $validated = $request->validate([
      'name_event' => 'required',
      'id_program' => 'required',
      'id_prodi' => 'required',
      'id_periode' => 'required',
      'tanggal_mulai' => 'required',
      'tanggal_selesai' => 'required',
    ]);

    $data = [
      'id_event' => $validated['name_event'],
      'id_program' => $validated['id_program'],
      'id_prodi' => $validated['id_prodi'],
      'id_periode' => $validated['id_periode'],
      'status' => 'active',
      'tanggal_awal' => DateTime::createFromFormat('d-m-Y, H:i', $validated['tanggal_mulai'])->format('Y-m-d H:i:s'),
      'tanggal_akhir' => DateTime::createFromFormat('d-m-Y, H:i', $validated['tanggal_selesai'])->format('Y-m-d H:i:s'),
    ];

    $url = EventCalendarService::getInstance()->store();
    $response = postCurl($url, $data, getHeaders());

    if ($request->ajax()) {
      if (isset($response->success) && $response->success) {
        return response()->json(['success' => true, 'message' => 'Berhasil disimpan']);
      }
      return response()->json(['success' => false, 'message' => $response->message ?? 'Gagal menyimpan data'], 422);
    }

    return redirect()->back()->with('success', 'Event akademik berhasil ditambahkan.');
  }

  public function upload(Request $request, $id)
  {
    return view('academics.calendar.upload', get_defined_vars());
  }

  public function uploadStore(Request $request, $id)
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

    $url = EventCalendarService::getInstance()->bulkStore();
    $response = postCurl($url, [
      'events' => $eventAkademik,
      'idperiode' => $id,
    ], getHeaders());

    if (isset($response->success) && $response->success) {
      return redirect()->route('calendar.show', ['id' => $id])->with('success', 'Unggah Event Kalender Akademik telah berhasil');
    }

    return redirect()->route('calendar.index')->with('error', $response->message ?? 'Gagal menyimpan data event akademik');
  }

  public function send(Request $request, $id)
  {
    $data = [
      [
        'name_event' => "Masa Pembayaran Cicilan I",
        'tanggal_mulai' => "2025-03-04 00:05:00+07",
        'tanggal_selesai' => "2026-07-04 23:59:00+07",
      ],
      [
        'name_event' => "Masa Pembayaran Cicilan II",
        'tanggal_mulai' => "2025-03-04 00:05:00+07",
        'tanggal_selesai' => "2026-07-04 23:59:00+07",
      ]
    ];
    $month = [
      1 => 'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember'
    ];
    return view('academics.calendar.upload-result', get_defined_vars());
  }

  public function save(Request $request, $id)
  {
    return redirect()->route('calendar.show', ['id' => $id])->with('success', 'Unggah Event Kalender Akademik telah berhasil');
  }

  public function edit(Request $request, $id)
  {
    return view('academics.calendar.edit', get_defined_vars());
  }

  public function update(Request $request, $id)
  {
    $validated = $request->validate([
      'name_event' => 'required',
      'status' => 'required',
      'tanggal_mulai' => 'required',
      'tanggal_selesai' => 'required',
      'id_calendar' => 'required'
    ]);

    $data = [
      'id_event' => $validated['name_event'],
      'tanggal_awal' => DateTime::createFromFormat('d-m-Y, H:i', $validated['tanggal_mulai'])->format('Y-m-d H:i:s'),
      'tanggal_akhir' => DateTime::createFromFormat('d-m-Y, H:i', $validated['tanggal_selesai'])->format('Y-m-d H:i:s'),
      'status' => $validated['status']
    ];


    $url = EventCalendarService::getInstance()->edit($request->id_calendar);
    $response = putCurl($url, $data, getHeaders());

    if ($request->ajax()) {
      if (isset($response->success) && $response->success) {
        return response()->json(['success' => true, 'message' => 'Berhasil disimpan']);
      }
      return response()->json(['success' => false, 'message' => $response->message ?? 'Gagal menyimpan data'], 422);
    }

    return redirect()->back()->with('success', 'Event akademik berhasil ditambahkan.');
  }

  public function delete(Request $request, $id)
  {
    $url = EventCalendarService::getInstance()->edit($id);
    $response = deleteCurl($url, getHeaders());
    return $response;
  }

  public function eventDownloadTemplate(Request $request)
  {
    $type = $request->query('type', 'xlsx');
    $allowed = ['xlsx', 'csv'];

    if (!in_array($type, $allowed)) {
      return redirect()->back()->with('error', 'Format file tidak valid');
    }

    $data = [
      [
        'kode',
        'nama',
        'sks',
        'semester',
        'tujuan',
        'deskripsi',
        'jenis',
        'koordinator',
        'spesial',
        'dibuka',
        'wajib',
        'mbkm',
        'aktif',
        'prasyarat',
        'namasingkat'
      ],
      [
        'UP001',
        'Kalkulus',
        '3',
        '1',
        '',
        '',
        'Mata Kuliah Dasar Umum',
        '116020',
        'n',
        'y',
        'y',
        'n',
        'y',
        '',
        'KAL'
      ],
      [
        'UP002',
        'Kimia Dasar 2',
        '2',
        '1',
        '',
        '',
        'Mata Kuliah Dasar Umum',
        '116024',
        'n',
        'y',
        'y',
        'n',
        'y',
        'UP001',
        'KD2'
      ],
    ];
    $filename = 'template-mata-kuliah.' . $type;

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
