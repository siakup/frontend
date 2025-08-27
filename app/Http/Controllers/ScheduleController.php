<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Excel as ExcelFormat;
use Maatwebsite\Excel\Facades\Excel;

class ScheduleController extends Controller
{
    // LIST (SCRUM-305)
    public function index(Request $req)
    {
        // --- dummy data untuk slicing; ganti ke hasil API kalau sudah siap ---
        $rows = [
            [
                'id'=>101,'semester'=>1,'mata_kuliah'=>'Bahasa Indonesia',
                'nama_kelas'=>'Bhs Indo C21-2024','kapasitas'=>30,
                'jadwal'=>[['hari'=>'Selasa','waktu'=>'12:00–14:40','ruang'=>'B204'],['hari'=>'Kamis','waktu'=>'07:00–08:40','ruang'=>'B201']],
                'pengajar'=>'Agus Ivan Setiaji',
            ],
            [
                'id'=>102,'semester'=>1,'mata_kuliah'=>'Bahasa Inggris I',
                'nama_kelas'=>'Inggris I C20-2024','kapasitas'=>30,
                'jadwal'=>[['hari'=>'Senin','waktu'=>'10:00–11:40','ruang'=>'B203']],
                'pengajar'=>'Brahmadi',
            ],
        ];

        // pagination sederhana
        $page    = (int) $req->query('page', 1);
        $perPage = (int) $req->query('per_page', 7);
        $slice   = collect($rows)->forPage($page, $perPage)->values();

        $items = new LengthAwarePaginator($slice, count($rows), $perPage, $page, [
            'path' => url()->current()
        ]);

        $programPerkuliahanList = [
            (object)['id'=>1,'nama'=>'Reguler'],
            (object)['id'=>2,'nama'=>'Paralel'],
            (object)['id'=>3,'nama'=>'Karyawan'],
        ];
        $programStudiList = [
            (object)['id'=>10,'nama'=>'Ilmu Kimia'],
            (object)['id'=>11,'nama'=>'Informatika'],
            (object)['id'=>12,'nama'=>'Ilmu Komputer'],
        ];

        return view('academics.schedule.prodi_schedule.index', [
            'items' => $items,
            'programPerkuliahanList' => $programPerkuliahanList,
            'programStudiList'       => $programStudiList,
            'id_program'             => (int) $req->query('program_perkuliahan', 1),
            'id_prodi'               => (int) $req->query('program_studi', 10),
            'q'                      => $req->query('q', ''),
            'sort'                   => $req->query('sort', 'created_at,desc'),

        ]);
    }

    // ====== skeleton CRUD (nanti tinggal isi API) ======

    public function create()
{
    $programPerkuliahanList = [
        (object)['id'=>1,'nama'=>'Reguler'],
        (object)['id'=>2,'nama'=>'Paralel'],
        (object)['id'=>3,'nama'=>'Karyawan'],
    ];

    $programStudiList = [
        (object)['id'=>10,'nama'=>'Ilmu Kimia'],
        (object)['id'=>11,'nama'=>'Informatika'],
        (object)['id'=>12,'nama'=>'Ilmu Komputer'],
    ];

    $periodeList = [
        (object)['id'=>101,'nama'=>'2023-Ganjil'],
        (object)['id'=>102,'nama'=>'2023-Genap'],
        (object)['id'=>103,'nama'=>'2024-Pendek'],
    ];

    return view('academics.schedule.prodi_schedule.create', [
        'programPerkuliahanList' => $programPerkuliahanList,
        'programStudiList'       => $programStudiList,
        'periodeList'            => $periodeList,
    ]);
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

        return view('academics.schedule.prodi_schedule.upload-result', get_defined_vars());
    }


    public function downloadTemplate(Request $request)
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


    public function store(Request $r)      { /* TODO: call API create */ }
    public function show($id)              { return view('academics.schedule.prodi_schedule.show', compact('id')); }
    public function edit($id)              { return view('academics.schedule.prodi_schedule.edit', compact('id')); }
    public function update(Request $r,$id) { /* TODO: call API update */ }
    public function destroy($id)           { /* TODO: call API delete */ }
    public function importFet1(Request $r) {
        return view('academics.schedule.prodi_schedule.upload', get_defined_vars());
    }
}
