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
// use Symfony\Component\HttpFoundation\StreamedResponse;


use App\Traits\ApiResponse;

use Exception;

class CplMapping extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cpl-mapping.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function upload(Request $request)
    {
      return view('cpl-mapping.upload', get_defined_vars());
    }

    public function uploadResult(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:csv,xlsx|max:5120'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $file = $request->file('file');
        $file_data = [];
        $errors = [];

        // Convert file ke array of object/array
        $file_data = convertFileDataExcelToObject($file);

        // Sesuaikan dengan struktur data CSV yang baru
        $file_data = array_map(function ($value) {
            return [
                'kode_matakuliah' => $value['kode_matakuliah'] ?? null,
                'kode_cpl'        => $value['kode_cpl'] ?? null,
                'bobot'           => $value['bobot'] ?? null,
            ];
        }, $file_data);

        return view('cpl-mapping.upload-result', get_defined_vars());
    }


    public function cplDownloadTemplate(Request $request)
    {
        $type = $request->query('type', 'xlsx');
        $allowed = ['xlsx', 'csv'];

        if (!in_array($type, $allowed)) {
            return redirect()->back()->with('error', 'Format file tidak valid');
        }

        $data = [
            ['kode_matakuliah', 'kode_cpl', 'bobot'],
            ['MK001', 'CPL-01', 30],
            ['MK001', 'CPL-02', 60],
            ['MK002', 'CPL-01', 40],
            ['MK003', 'CPL-03', 50],
        ];

        $filename = 'template-cpl.' . $type;

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

      return redirect()->route('cpl-mapping.index')->with('error', $response->message ?? 'Gagal menyimpan data event akademik');
    }

}
