<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Excel as ExcelFormat;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;


use App\Endpoint\EventCalendarService;
use App\Endpoint\PeriodAcademicService;
use App\Endpoint\ScheduleService;
use App\Endpoint\UserService;

class ScheduleController extends Controller
{
    public function index(Request $req)
    {
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
    public function create(Request $request)
    {
      $urlProgramPerkuliahan = EventCalendarService::getInstance()->getListUniversityProgram();
      $responseProgramPerkuliahanList = getCurl($urlProgramPerkuliahan, null, getHeaders());
      $programPerkuliahanList = $responseProgramPerkuliahanList->data;

      $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
      $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
      $programStudiList = $responseProgramStudiList->data;

      $urlPeriode = PeriodAcademicService::getInstance()->getListAllPeriode();
      $responsePeriode = getCurl($urlPeriode, null, getHeaders());
      $periodeList = $responsePeriode->data;

      return view('academics.schedule.prodi_schedule.create', get_defined_vars());
    }

    public function dosen(Request $request)
    {
      $pengajar = [
        [
          'id' => 1,
          'nip' => '12001',
          'nama_pengajar' => 'Ade Irawan, Ph.D',
          'pengajar_program_studi' => 'Ilmu Komputer'
        ],
        [
          'id' => 2,
          'nip' => '12001',
          'nama_pengajar' => 'Dr. Tasmi, S.Si, M.Si',
          'pengajar_program_studi' => 'Ilmu Komputer'
        ],
        [
          'id' => 3,
          'nip' => '12001',
          'nama_pengajar' => 'Rangga Ganzar Nugraha, Ph.D',
          'pengajar_program_studi' => 'Ilmu Komputer'
        ],
        [
          'id' => 4,
          'nip' => '12001',
          'nama_pengajar' => 'Meredita Susanty, M.Sc',
          'pengajar_program_studi' => 'Ilmu Komputer'
        ],
        [
          'id' => 5,
          'nip' => '12001',
          'nama_pengajar' => 'Randi Farmana Putra, M.Si',
          'pengajar_program_studi' => 'Ilmu Komputer'
        ],
        [
          'id' => 6,
          'nip' => '12001',
          'nama_pengajar' => 'Dr. Tasmi, S.Si, M.Si',
          'pengajar_program_studi' => 'Ilmu Komputer'
        ],
        [
          'id' => 7,
          'nip' => '12001',
          'nama_pengajar' => 'Ade Irawan, Ph.D',
          'pengajar_program_studi' => 'Ilmu Komputer'
        ],
        [
          'id' => 8,
          'nip' => '12001',
          'nama_pengajar' => 'Rangga Ganzar Nugraha, Ph.D',
          'pengajar_program_studi' => 'Ilmu Komputer'
        ],
        [
          'id' => 9,
          'nip' => '12001',
          'nama_pengajar' => 'Meredita Susanty, M.Sc',
          'pengajar_program_studi' => 'Ilmu Komputer'
        ],
        [
          'id' => 10,
          'nip' => '12001',
          'nama_pengajar' => 'Randi Farmana Putra, M.Si',
          'pengajar_program_studi' => 'Ilmu Komputer'
        ],
      ];
    $limit = $request->input('limit', 5);
      $page = $request->input('page', 1);

      $pengajar = array_values(array_filter($pengajar, function($p) use ($request) {
        return str_starts_with(strtolower($p['nip']), strtolower($request->input('search', ''))) ||
          str_starts_with(strtolower($p['nama_pengajar']), strtolower($request->input('search', ''))) ||
          str_starts_with(strtolower($p['pengajar_program_studi']), strtolower($request->input('search', '')));
      }));

      $pengajar = array_chunk($pengajar, $limit);
      $lastPage = count($pengajar);
      $pengajar = count($pengajar) > 0 ? $pengajar[$page - 1] : [];

      if ($request->ajax()) {
          return view('academics.schedule.prodi_schedule._lecture-view', get_defined_vars())->render();
      }
      return redirect()->route('academics.schedule.prodi_schedule.create');
    }

    public function mataKuliah(Request $request, $periode)
    {
      $mata_kuliah_list = [
        [
          'id' => 1,
          'kode_matakuliah' => '12001',
          'nama_matakuliah' => 'Akuisisi dan Pengolahan Data Seismik Refleksi',
          'jenis_matakuliah' => 'Mata Kuliah Program Studi',
          'sks' => 2,
          'kurikulum' => 'Kurikulum 2021 - Teknik Geofisika',
        ],
        [
          'id' => 2,
          'kode_matakuliah' => '12001',
          'nama_matakuliah' => 'Analisis Sinyal Geofisika',
          'jenis_matakuliah' => 'Mata Kuliah Program Studi',
          'sks' => 2,
          'kurikulum' => 'Kurikulum 2021 - Teknik Geofisika',
        ],
        [
          'id' => 3,
          'kode_matakuliah' => '12001',
          'nama_matakuliah' => 'Elektronika dan Instrumentasi Geofisika',
          'jenis_matakuliah' => 'Mata Kuliah Program Studi',
          'sks' => 2,
          'kurikulum' => 'Kurikulum 2021 - Teknik Geofisika',
        ],
        [
          'id' => 4,
          'kode_matakuliah' => '12001',
          'nama_matakuliah' => 'Evaluasi Farmasi',
          'jenis_matakuliah' => 'Mata Kuliah Program Studi',
          'sks' => 2,
          'kurikulum' => 'Kurikulum 2021 - Teknik Geofisika',
        ],
        [
          'id' => 5,
          'kode_matakuliah' => '12001',
          'nama_matakuliah' => 'Fisika Batuan',
          'jenis_matakuliah' => 'Mata Kuliah Program Studi',
          'sks' => 2,
          'kurikulum' => 'Kurikulum 2021 - Teknik Geofisika',
        ],
        [
          'id' => 6,
          'kode_matakuliah' => '12001',
          'nama_matakuliah' => 'Akuisisi dan Pengolahan Data Seismik Refleksi',
          'jenis_matakuliah' => 'Mata Kuliah Program Studi',
          'sks' => 2,
          'kurikulum' => 'Kurikulum 2021 - Teknik Geofisika',
        ],
        [
          'id' => 7,
          'kode_matakuliah' => '12001',
          'nama_matakuliah' => 'Analisis Sinyal Geofisika',
          'jenis_matakuliah' => 'Mata Kuliah Program Studi',
          'sks' => 2,
          'kurikulum' => 'Kurikulum 2021 - Teknik Geofisika',
        ],
        [
          'id' => 8,
          'kode_matakuliah' => '12001',
          'nama_matakuliah' => 'Elektronika dan Instrumentasi Geofisika',
          'jenis_matakuliah' => 'Mata Kuliah Program Studi',
          'sks' => 2,
          'kurikulum' => 'Kurikulum 2021 - Teknik Geofisika',
        ],
        [
          'id' => 9,
          'kode_matakuliah' => '12001',
          'nama_matakuliah' => 'Fisika Batuan',
          'jenis_matakuliah' => 'Mata Kuliah Program Studi',
          'sks' => 2,
          'kurikulum' => 'Kurikulum 2021 - Teknik Geofisika',
        ],
        [
          'id' => 10,
          'kode_matakuliah' => '12001',
          'nama_matakuliah' => 'Evaluasi Farmasi',
          'jenis_matakuliah' => 'Mata Kuliah Program Studi',
          'sks' => 2,
          'kurikulum' => 'Kurikulum 2021 - Teknik Geofisika',
        ],
      ];

      $limit = $request->input('limit', 5);
      $page = $request->input('page', 1);

      $urlPeriode = PeriodAcademicService::getInstance()->periodeUrl($periode);
      $responsePeriode = getCurl($urlPeriode, null, getHeaders());
      $periodeData = $responsePeriode->data->periode;

      $mata_kuliah_list = array_values(array_filter($mata_kuliah_list, function($p) use ($request) {
        return str_starts_with(strtolower($p['kode_matakuliah']), strtolower($request->input('search', ''))) ||
          str_starts_with(strtolower($p['nama_matakuliah']), strtolower($request->input('search', '')));
      }));

      $mata_kuliah_list = array_chunk($mata_kuliah_list, $limit);
      $lastPage = count($mata_kuliah_list);
      $mata_kuliah_list = count($mata_kuliah_list) > 0 ? $mata_kuliah_list[$page - 1] : [];

      if ($request->ajax()) {
          return view('academics.schedule.parent-institution_schedule._course-view', get_defined_vars())->render();
      }
      return redirect()->route('academics.schedule.prodi_schedule.create');
    }

    public function jadwalKelas(Request $request)
    {
      $ruangans = [
        [
          'id_ruangan' => 1,
          'nama_ruangan' => 'Online'
        ],
        [
          'id_ruangan' => 2,
          'nama_ruangan' => 'Ruang Kelas ABC'
        ],
        [
          'id_ruangan' => 3,
          'nama_ruangan' => '2201'
        ],
        [
          'id_ruangan' => 4,
          'nama_ruangan' => '2202'
        ],
        [
          'id_ruangan' => 5,
          'nama_ruangan' => '2203'
        ],
        [
          'id_ruangan' => 6,
          'nama_ruangan' => '2401'
        ],
        [
          'id_ruangan' => 7,
          'nama_ruangan' => '2402'
        ],
        [
          'id_ruangan' => 8,
          'nama_ruangan' => '2403'
        ],
        [
          'id_ruangan' => 9,
          'nama_ruangan' => '2501'
        ],
        [
          'id_ruangan' => 10,
          'nama_ruangan' => '2502'
        ],
      ];

      return view('academics.schedule.prodi_schedule._create-schedule', get_defined_vars())->render();
    }

    public function show($id)
    {
        // TODO: ganti ke service asli kamu
        // Contoh mock agar front-end langsung jalan
        $data = [
            'id' => (int)$id,
            'periode' => '2025–Ganjil',
            'program_perkuliahan' => 'Reguler',
            'program_studi' => 'Ilmu Komputer',
            'mata_kuliah' => 'Fisika Dasar 2',
            'nama_kelas' => 'Fisika Dasar 2 - C2',
            'nama_singkat' => 'C2',
            'kapasitas' => 50,
            'kelas_mbkm' => 'Tidak',
            'tanggal_mulai' => '05-02-2025',
            'tanggal_selesai' => '06-06-2025',
            'pengajar' => [
                ['nama'=>'Ayu Kartini','status'=>'utama'],
                ['nama'=>'Ika Dyth Mulyawati','status'=>'bukan'],
            ],
            'jadwal' => [
                ['hari'=>'Selasa','waktu'=>'12:30–14:10','ruang'=>'B204'],
                ['hari'=>'Kamis','waktu'=>'07:00–08:40','ruang'=>'B201'],
            ],
        ];
        return response()->json($data);
    }



    public function destroy($id)
    {
        // Validasi ringan
        if (!ctype_digit((string)$id)) {
            return response()->json(['message' => 'ID tidak valid'], 422);
        }

        try {
            // TODO: taruh logika hapus di sini
            // $ok = EventCalendarService::deleteSchedule((int)$id);
            // if (!$ok) throw new \RuntimeException('Gagal hapus di service');
            $ok = true;

            if ($ok) {
                return response()->json(['message' => 'Jadwal berhasil dihapus.'], 200);
            }

            return response()->json(['message' => 'Gagal menghapus data.'], 500);

        } catch (\Throwable $e) {
            return response()->json(['message' => 'Terjadi kesalahan: '.$e->getMessage()], 500);
        }
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

        // Sesuaikan dengan struktur data CSV baru
        $file_data = array_map(function ($value) {
            return [
                'activity_id'    => $value['Activity Id'] ?? null,
                'day'            => $value['Day'] ?? null,
                'hour'           => $value['Hour'] ?? null,
                'students_sets'  => $value['Students Sets'] ?? null,
                'subject'        => $value['Subject'] ?? null,
                'teachers'       => $value['Teachers'] ?? null,
                'activity_tags'  => $value['Activity Tags'] ?? null,
                'room'           => $value['Room'] ?? null,
                'comments'       => $value['Comments'] ?? null,
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
            [
                'Activity Id','Day','Hour','Students Sets','Subject','Teachers','Activity Tags','Room','Comments'
            ],
            [1, 'Rabu', '13:00-13:30', 'GP2+GP2DD', '10103#Bahasa Inggris II', 'Harumi Manik Ayu Yamin', 'GP', '2602', ''],
            [1, 'Rabu', '13:30-14:00', 'GP2+GP2DD', '10103#Bahasa Inggris II', 'Harumi Manik Ayu Yamin', 'GP', '2602', ''],
            [1, 'Rabu', '14:00-14:30', 'GP2+GP2DD', '10103#Bahasa Inggris II', 'Harumi Manik Ayu Yamin', 'GP', '2602', ''],
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

    public function store(Request $request)      {
      dd($request->all());
    }

    public function edit($id)
    {
      $urlProgramPerkuliahan = EventCalendarService::getInstance()->getListUniversityProgram();
      $responseProgramPerkuliahanList = getCurl($urlProgramPerkuliahan, null, getHeaders());
      $programPerkuliahanList = $responseProgramPerkuliahanList->data;

      $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
      $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
      $programStudiList = $responseProgramStudiList->data;

      $urlPeriode = PeriodAcademicService::getInstance()->getListAllPeriode();
      $responsePeriode = getCurl($urlPeriode, null, getHeaders());
      $periodeList = $responsePeriode->data;

      $data = [
        "program_perkuliahan" => "Reguler",
        "program_studi" => "3",
        "periode" => "17",
        "nama_matakuliah" => "Elektronika dan Instrumentasi Geofisika",
        "matakuliah" => [
          "jenis_matakuliah" => "Mata Kuliah Program Studi",
          "sks" => "2",
          "kurikulum" => "Kurikulum 2021 - Teknik Geofisika",
          "kode_matakuliah" => "12001",
          "id" => "3",
        ],
        "nama_kelas" => "Elektronika dan Instrumentasi Geofisika - EIG4",
        "nama_singkat" => "EIG4",
        "kapasitas_peserta" => "50",
        "kelas_mbkm" => false,
        "tanggal_mulai" => "09-09-2025, 12:00",
        "tanggal_akhir" => "30-09-2025, 12:00",
        "selected_lecture" => [
          [
            "id" => "1",
            "nama_pengajar" => "Ade Irawan, Ph.D",
            "pengajar_program_studi" => "Ilmu Komputer",
            "status_pengajar" => "Pengajar Utama",
            "hari" => "Senin",
            "ruangan" => "2",
            "jam_mulai_kelas" => "12:00",
            "jam_akhir_kelas" => "14:00",
          ],
          1 => [
            "id" => "2",
            "nama_pengajar" => "Dr. Tasmi, S.Si, M.Si",
            "pengajar_program_studi" => "Ilmu Komputer",
            "status_pengajar" => "Bukan Pengajar Utama",
            "hari" => "Selasa",
            "ruangan" => "3",
            "jam_mulai_kelas" => "12:00",
            "jam_akhir_kelas" => "14:00",
          ]
        ],
        "class_schedule" => [
          [
            "hari" => "Senin",
            "ruangan" => "2",
            "jam_mulai_kelas" => "12:00",
            "jam_akhir_kelas" => "14:00",
          ],
          [
            "hari" => "Selasa",
            "ruangan" => "2",
            "jam_mulai_kelas" => "12:00",
            "jam_akhir_kelas" => "14:00",
          ]
        ]
      ];
      return view('academics.schedule.prodi_schedule.edit', get_defined_vars());
    }

    public function update(Request $r,$id) { /* TODO: call API update */ }

    public function importFet1(Request $r) {
        return view('academics.schedule.prodi_schedule.upload', get_defined_vars());
    }

    public function parentInstitutionIndex(Request $request) {
      $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
      $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
      $programStudiList = $responseProgramStudiList->data;
      $program_studi = $request->input('study_program', $programStudiList ? $programStudiList[0]->id : null);

      $urlPeran = UserService::getInstance()->getListAllRoles();
      $responsePeranList = getCurl($urlPeran, null, getHeaders());
      $peranList = $responsePeranList->data;
      $peran = $request->input('role', $peranList ? $peranList[0]->id : null);

      $sort = $request->input('sort', 'created_at,desc');

      $data = [
        [
          'id' => 1,
          'mata_kuliah' => 'Bahasa Indonesia',
          'nama_kelas' => 'Bahasa Indonesia I-CE1-2024',
          'kapasitas' => 50,
          'jadwal' => [
            [
              'hari' => 'Selasa',
              'jam_mulai' => '13.00',
              'jam_selesai' => '14.40',
              'ruangan' => 2201
            ]
          ],
          'pengajar' => ['Acep Iwan Saidi']
        ],
        [
          'id' => 2,
          'mata_kuliah' => 'Bahasa Inggris I',
          'nama_kelas' => 'Bahasa Inggris I-CE1-2024',
          'kapasitas' => 50,
          'jadwal' => [
            [
              'hari' => 'Selasa',
              'jam_mulai' => '11.30',
              'jam_selesai' => '12.30',
              'ruangan' => 2801
            ],
            [
              'hari' => 'Rabu',
              'jam_mulai' => '08.00',
              'jam_selesai' => '09.40',
              'ruangan' => 2801
            ]
          ],
          'pengajar' => ['Rinaldi Medali', 'Rachman']
        ],
        [
          'id' => 3,
          'mata_kuliah' => 'Berpikir Kritis',
          'nama_kelas' => 'Berpikir Kritis-CE1A-2024',
          'kapasitas' => 70,
          'jadwal' => [
            [
              'hari' => 'Kamis',
              'jam_mulai' => '09.00',
              'jam_selesai' => '10.40',
              'ruangan' => 2201
            ]
          ],
          'pengajar' => ['Alfina Permata Sari']
        ]
      ];

      return view('academics.schedule.parent-institution_schedule.index', get_defined_vars());
    }

    public function parentInstitutionCreate(Request $request)
    {
      $urlProgramPerkuliahan = EventCalendarService::getInstance()->getListUniversityProgram();
      $responseProgramPerkuliahanList = getCurl($urlProgramPerkuliahan, null, getHeaders());
      $programPerkuliahanList = $responseProgramPerkuliahanList->data;

      $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
      $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
      $programStudiList = $responseProgramStudiList->data;

      $urlPeriode = PeriodAcademicService::getInstance()->getListAllPeriode();
      $responsePeriode = getCurl($urlPeriode, null, getHeaders());
      $periodeList = $responsePeriode->data;

      return view('academics.schedule.parent-institution_schedule.create', get_defined_vars());
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
        'ruangan' => array_map(function ($ruangan) { return [
            'id_ruangan' => $ruangan["'ruangan'"], 
            'hari' => $ruangan["'hari'"], 
            'mulai_kelas' => $ruangan["'jam_mulai_kelas'"],
            'selesai_kelas' => $ruangan["'jam_akhir_kelas'"]
        ];}, $validated['class_schedule']),
        'pengajar' => array_map(function ($pengajar) { return [
            "id_pengajar" => $pengajar["'id'"],
            "nama_pengajar" => $pengajar["'nama_pengajar'"],
            "status_pengajar" => $pengajar["'status_pengajar'"],
        ];}, $validated['selected_lecture']),
      ];
      $response = postCurl($url, $data, getHeaders());

      if($response->success) {
        return redirect()->route('academics.schedule.parent-institution-schedule.index')->with('success', 'Jadwal Kuliah Institusi Parent berhasil ditambahkan.');
      }
    }

    public function parentInstitutionEdit(Request $request, $id)
    {
      $urlProgramPerkuliahan = EventCalendarService::getInstance()->getListUniversityProgram();
      $responseProgramPerkuliahanList = getCurl($urlProgramPerkuliahan, null, getHeaders());
      $programPerkuliahanList = $responseProgramPerkuliahanList->data;

      $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
      $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
      $programStudiList = $responseProgramStudiList->data;

      $urlPeriode = PeriodAcademicService::getInstance()->getListAllPeriode();
      $responsePeriode = getCurl($urlPeriode, null, getHeaders());
      $periodeList = $responsePeriode->data;

      $data = [
        "program_perkuliahan" => "Reguler",
        "program_studi" => "3",
        "periode" => "17",
        "nama_matakuliah" => "Elektronika dan Instrumentasi Geofisika",
        "matakuliah" => [
          "jenis_matakuliah" => "Mata Kuliah Program Studi",
          "sks" => "2",
          "kurikulum" => "Kurikulum 2021 - Teknik Geofisika",
          "kode_matakuliah" => "12001",
          "id" => "3",
        ],
        "nama_kelas" => "Elektronika dan Instrumentasi Geofisika - EIG4",
        "nama_singkat" => "EIG4",
        "kapasitas_peserta" => "50",
        "kelas_mbkm" => false,
        "tanggal_mulai" => "09-09-2025, 12:00",
        "tanggal_akhir" => "30-09-2025, 12:00",
        "selected_lecture" => [
          [
            "id" => "1",
            "nama_pengajar" => "Ade Irawan, Ph.D",
            "pengajar_program_studi" => "Ilmu Komputer",
            "status_pengajar" => "Pengajar Utama",
            "hari" => "Senin",
            "ruangan" => "2",
            "jam_mulai_kelas" => "12:00",
            "jam_akhir_kelas" => "14:00",
          ],
          1 => [
            "id" => "2",
            "nama_pengajar" => "Dr. Tasmi, S.Si, M.Si",
            "pengajar_program_studi" => "Ilmu Komputer",
            "status_pengajar" => "Bukan Pengajar Utama",
            "hari" => "Selasa",
            "ruangan" => "3",
            "jam_mulai_kelas" => "12:00",
            "jam_akhir_kelas" => "14:00",
          ]
        ],
        "class_schedule" => [
          [
            "hari" => "Senin",
            "ruangan" => "2",
            "jam_mulai_kelas" => "12:00",
            "jam_akhir_kelas" => "14:00",
          ],
          [
            "hari" => "Selasa",
            "ruangan" => "2",
            "jam_mulai_kelas" => "12:00",
            "jam_akhir_kelas" => "14:00",
          ]
        ]
      ];
      return view('academics.schedule.parent-institution_schedule.edit', get_defined_vars());
    }

    public function parentInstitutionUpdate(Request $request, $id)
    {
      dd($request->all());
    }

    public function parentInstitutionLectureList(Request $request)
    {
      $limit = $request->input('limit', 5);
      $page = $request->input('page', 1);
      $search = $request->input('search', '');
      $params = compact('limit', 'page', 'search');

      $url = ScheduleService::getInstance()->getLectureList();
      $response = getCurl($url, $params, getHeaders());
      $pengajar = $response->data->data;
      $lastPage = $response->data->last_page;

      if ($request->ajax()) {
          return view('academics.schedule.parent-institution_schedule._lecture-view', get_defined_vars())->render();
      }
      return redirect()->route('academics.schedule.parent-institution-schedule.create');
    }

    public function parentInstitutionCourseList(Request $request, $periode)
    {
      $limit = $request->input('limit', 5);
      $page = $request->input('page', 1);
      $search = $request->input('search', '');
      $params = compact('limit', 'page', 'search');
      $url = ScheduleService::getInstance()->getCourseList($periode);
      $response = getCurl($url, $params, getHeaders());
      $mata_kuliah_list = $response->data->data;
      

      $urlPeriode = PeriodAcademicService::getInstance()->periodeUrl($periode);
      $responsePeriode = getCurl($urlPeriode, null, getHeaders());
      $periodeData = $responsePeriode->data->periode;

      $lastPage = $response->data->last_page;

      if ($request->ajax()) {
          return view('academics.schedule.parent-institution_schedule._course-view', get_defined_vars())->render();
      }
      return redirect()->route('academics.schedule.parent-institution-schedule.create');
    }

    public function parentInstitutionView(Request $request, $id)
    {
      $urlProgramPerkuliahan = EventCalendarService::getInstance()->getListUniversityProgram();
      $responseProgramPerkuliahanList = getCurl($urlProgramPerkuliahan, null, getHeaders());
      $programPerkuliahanList = $responseProgramPerkuliahanList->data;

      $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
      $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
      $programStudiList = $responseProgramStudiList->data;

      $urlPeriode = PeriodAcademicService::getInstance()->getListAllPeriode();
      $responsePeriode = getCurl($urlPeriode, null, getHeaders());
      $periodeList = $responsePeriode->data;

      $data = [
        "program_perkuliahan" => "Reguler",
        "program_studi" => "3",
        "periode" => "17",
        "nama_matakuliah" => "Elektronika dan Instrumentasi Geofisika",
        "matakuliah" => [
          "jenis_matakuliah" => "Mata Kuliah Program Studi",
          "sks" => "2",
          "kurikulum" => "Kurikulum 2021 - Teknik Geofisika",
          "kode_matakuliah" => "12001",
          "id" => "3",
        ],
        "nama_kelas" => "Elektronika dan Instrumentasi Geofisika - EIG4",
        "nama_singkat" => "EIG4",
        "kapasitas_peserta" => "50",
        "kelas_mbkm" => false,
        "tanggal_mulai" => "09-09-2025, 12:00",
        "tanggal_akhir" => "30-09-2025, 12:00",
        "selected_lecture" => [
          [
            "id" => "1",
            "nama_pengajar" => "Ade Irawan, Ph.D",
            "pengajar_program_studi" => "Ilmu Komputer",
            "status_pengajar" => "Pengajar Utama",
            "hari" => "Senin",
            "ruangan" => "2",
            "jam_mulai_kelas" => "12:00",
            "jam_akhir_kelas" => "14:00",
          ],
          1 => [
            "id" => "2",
            "nama_pengajar" => "Dr. Tasmi, S.Si, M.Si",
            "pengajar_program_studi" => "Ilmu Komputer",
            "status_pengajar" => "Bukan Pengajar Utama",
            "hari" => "Selasa",
            "ruangan" => "3",
            "jam_mulai_kelas" => "12:00",
            "jam_akhir_kelas" => "14:00",
          ]
        ],
        "class_schedule" => [
          [
            "hari" => "Senin",
            "ruangan" => "2",
            "jam_mulai_kelas" => "12:00",
            "jam_akhir_kelas" => "14:00",
          ],
          [
            "hari" => "Selasa",
            "ruangan" => "2",
            "jam_mulai_kelas" => "12:00",
            "jam_akhir_kelas" => "14:00",
          ]
        ]
      ];

      return view('academics.schedule.parent-institution_schedule._view', get_defined_vars())->render();
    }

    public function parentInstitutionClassScheduleCreate(Request $request)
    {
      $url = ScheduleService::getInstance()->getRoomList();
      $response = getCurl($url, null, getHeaders());
      $ruangans = $response->data;

      return view('academics.schedule.parent-institution_schedule._create-schedule', get_defined_vars())->render();
    }
}
