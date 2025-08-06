<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


use App\Traits\ApiResponse;

use Exception;
use Svg\Tag\Rect;

class StudyController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
      return view('study.index', get_defined_vars());
    }

    public function create(Request $request)
    {
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
      // dd($request->all());
      $file_data = [
        ['kode' => 'MK001', 'nama' => 'Algoritma dan Pemrograman', 'sks' => 3, 'semester' => 1, 'jenis' => 'Wajib', 'prodi' => 'Teknik Informatika'],
        ['kode' => 'MK002', 'nama' => 'Struktur Data', 'sks' => 3, 'semester' => 2, 'jenis' => 'Wajib', 'prodi' => 'Teknik Informatika'],
        ['kode' => 'MK003', 'nama' => 'Basis Data', 'sks' => 3, 'semester' => 3, 'jenis' => 'Wajib', 'prodi' => 'Sistem Informasi'],
        ['kode' => 'MK004', 'nama' => 'Pemrograman Web', 'sks' => 3, 'semester' => 4, 'jenis' => 'Wajib', 'prodi' => 'Sistem Informasi'],
        ['kode' => 'MK005', 'nama' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 5, 'jenis' => 'Wajib', 'prodi' => 'Teknik Komputer'],
        ['kode' => 'MK006', 'nama' => 'Kecerdasan Buatan', 'sks' => 3, 'semester' => 6, 'jenis' => 'Pilihan', 'prodi' => 'Teknik Informatika'],
        ['kode' => 'MK007', 'nama' => 'Sistem Operasi', 'sks' => 3, 'semester' => 3, 'jenis' => 'Wajib', 'prodi' => 'Teknik Komputer'],
        ['kode' => 'MK008', 'nama' => 'Pemrograman Mobile', 'sks' => 3, 'semester' => 5, 'jenis' => 'Pilihan', 'prodi' => 'Sistem Informasi'],
        ['kode' => 'MK009', 'nama' => 'Data Mining', 'sks' => 3, 'semester' => 6, 'jenis' => 'Pilihan', 'prodi' => 'Teknik Informatika'],
        ['kode' => 'MK010', 'nama' => 'Keamanan Jaringan', 'sks' => 3, 'semester' => 5, 'jenis' => 'Pilihan', 'prodi' => 'Teknik Komputer']
      ];
      return view('study.upload-result', get_defined_vars());
    }

    public function uploadStore(Request $request)
    {
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

    public function store(Request $request, $id) 
    {
      return redirect()->route('calendar.show', ['id' => $id])->with('success', 'Berhasil disimpan');
    }

    public function send(Request $request, $id) 
    {
      return redirect()->route('calendar.show', ['id' => $id])->with('success', 'Unggah Event Kalender Akademik telah berhasil');
    }

    public function update(Request $request, $id)
    {
        
    }

    public function delete(Request $request, $id)
    {
        return redirect()->back();
    }
}