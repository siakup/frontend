<?php

namespace App\Http\Controllers;

use App\Endpoint\PeriodAcademicService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TutelageController extends Controller
{
    use ApiResponse;

    public function listStudent(Request $request)
    {
        try {
            $urlPeriode = PeriodAcademicService::getInstance()->getListAllPeriode();
            $responsePeriode = getCurl($urlPeriode, null, getHeaders());
            if (! isset($responsePeriode->data) || ! isset($responsePeriode->success) || ! $responsePeriode->success || count($responsePeriode->data) == 0) {
                throw new \Exception(json_encode([
                    'message' => 'Periode belum ditambahkan!',
                    'system_error' => $responsePeriode,
                ]));
            }
            $periodeList = $responsePeriode->data ?? [];

            $limit = $request->input('limit', 10);
            $page = $request->input('page', 1);
            $periode = $request->input('periode', $periodeList[0]->id);
            $year = $request->input('year', date('Y'));
            $filter = $request->input('filter', '');
            $sort = $request->input('sort', '');

            $students = [];

            for ($i = 1; $i <= 10; $i++) {
                $students[] = [
                    'id' => $i,
                    'nim' => "10522{$i}",
                    'angkatan' => 2021,
                    'nama' => "Mahasiswa {$i}",
                    'ips' => rand(200, 400) / 100,
                    'ipk' => rand(200, 400) / 100,
                    'sks_lulus' => rand(60, 130),
                    'sks_lulus_wajib' => rand(40, 120),
                    'nilai_pem' => rand(100, 1500),
                    'status_akademik' => $i % 2 === 0 ? 'Aktif' : 'Kosong',
                    'status_persetujuan' => [
                        ['nilai' => rand(1, 4), 'status' => 'disetujui'],
                        ['nilai' => rand(0, 2), 'status' => 'ditolak'],
                        ['nilai' => rand(0, 2), 'status' => 'menunggu'],
                        ['nilai' => rand(0, 2), 'status' => 'hapus'],
                    ],
                ];
            }

            $pagination = [
                'currentPage' => 1,
                'from' => 1,
                'last' => 1,
                'limit' => $limit,
            ];

            if ($request->ajax()) {
                return $this->successResponse(['students' => $students, 'pagination' => $pagination] ?? [], 'Daftar Mahasiswa berhasil didapatkan');
            }

            return view('tutelage.student-list.index', get_defined_vars());
        } catch (\Throwable $err) {
            $decoded = json_decode($err->getMessage());

            Log::error('Gagal memuat halaman perwalian daftar mahasiswa', [
                'url' => $url ?? null,
                'request_data' => $request->all(),
                'response' => $decoded->system_error,
            ]);

            if ($request->ajax()) {
                return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data');
            }

            return redirect()
                ->route('home')
                ->withErrors(['error' => $decoded->message ?? 'Gagal memuat halaman perwalian daftar mahasiswa']);
        }
    }

    public function showKrs(Request $request, $id)
    {
        try {
            // Dummy student
            $student = [
                'nama' => 'Budi Santoso',
                'nim' => '123456789',
                'status_bayar' => 'Sudah Membayar',
                'ipk' => 3.45,
                'sks_boleh' => 24,
            ];

            // Dummy info KRS
            $krsInfo = [
                'sisa_sks_kelulusan' => 12,
                'total_sks_kelulusan' => 144,
                'rekom_wajib' => ['Kerja Praktik', 'Proyek Multidisiplin'],
                'rekom_ulang' => ['Struktur Data', 'Matematika Diskrit'],
            ];

            // Helper pill
            $pill = function ($txt, $type) {
                $map = [
                    'pending' => 'bg-[#FDE05D] text-black',
                    'deletion' => 'bg-[#3B82F6] text-white',
                    'rejected' => 'bg-[#EF4444] text-black',
                    'approved' => 'bg-[#F7B6B8] text-black',
                ];

                return '<span class="pill '.$map[$type].'">'.$txt.'</span>';
            };

            // Dummy data mata kuliah
            $courses = [
                [
                    'no' => 1,
                    'kelas' => 'Kerja Praktik - Ade Irawan - 2024 - I',
                    'mk' => '52402 – Kerja Praktik',
                    'sks' => 2,
                    'nilai' => '-',
                    'prodi' => 'Tidak',
                    'presensi' => '100%',
                    'uas' => 'OK',
                    'status' => 'pending',
                    'status_label' => $pill('Menunggu Persetujuan', 'pending'),
                ],
                [
                    'no' => 2,
                    'kelas' => 'Proyek Multidisiplin – CS7 – 2024',
                    'mk' => '52401 – Proyek Multidisiplin',
                    'sks' => 3,
                    'nilai' => '-',
                    'prodi' => 'Tidak',
                    'presensi' => '100%',
                    'uas' => 'OK',
                    'status' => 'pending',
                    'status_label' => $pill('Menunggu Persetujuan', 'pending'),
                ],
                [
                    'no' => 3,
                    'kelas' => 'Pancasila – CS7 – 2024',
                    'mk' => '52401 – Pancasila',
                    'sks' => 2,
                    'nilai' => '-',
                    'prodi' => 'Tidak',
                    'presensi' => '100%',
                    'uas' => 'OK',
                    'status' => 'deletion',
                    'status_label' => $pill('Mengajukan Penghapusan', 'deletion'),
                ],
                [
                    'no' => 4,
                    'kelas' => 'Pemrograman Web – CS3 – 2024',
                    'mk' => '52401 – Pemrograman Web',
                    'sks' => 3,
                    'nilai' => 'B',
                    'prodi' => 'Tidak',
                    'presensi' => '95%',
                    'uas' => 'OK',
                    'status' => 'approved',
                    'status_label' => $pill('Disetujui', 'approved'),
                ],
            ];

            $events = [
                [
                    'title' => 'Pemrograman Web',
                    'start_date' => '2025-09-27', // mulai semester
                    'end_date' => '2026-01-27', // akhir semester
                    'day_of_week' => 4, // Senin (0=minggu, 1=senin, dst)
                    'start_time' => '09:00:00',
                    'end_time' => '12:00:00',
                    'color' => '#EB474D',
                ],
                [
                    'title' => 'Pancasila',
                    'start_date' => '2025-09-27',
                    'end_date' => '2026-01-27',
                    'day_of_week' => 2, // Selasa
                    'start_time' => '13:00:00',
                    'end_time' => '15:00:00',
                    'color' => '#EB474D',
                ],
            ];

            // Grouping by status
            $tblPending = array_filter($courses, fn ($c) => $c['status'] === 'pending');
            $tblDeletion = array_filter($courses, fn ($c) => $c['status'] === 'deletion');
            $tblRejected = array_filter($courses, fn ($c) => $c['status'] === 'rejected');
            $tblApproved = array_filter($courses, fn ($c) => $c['status'] === 'approved');

            $data = compact('student', 'krsInfo', 'events');
            $tbl = [
                'pending' => array_values($tblPending),
                'deletion' => array_values($tblDeletion),
                'rejected' => array_values($tblRejected),
                'approved' => array_values($tblApproved),
            ];

            // dd($tbl);

            return view('tutelage.student-list.detail-krs', get_defined_vars());
        } catch (\Throwable $err) {
            $decoded = json_decode($err->getMessage());

            Log::error('Gagal memuat halaman detail krs mahasiswa', [
                'url' => $url ?? null,
                'request_data' => $request->all(),
                'response' => $decoded->system_error,
            ]);

            if ($request->ajax()) {
                return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data');
            }

            return redirect()
                ->route('tutelage-group.list-student')
                ->withErrors(['error' => $decoded->message ?? 'Gagal memuat halaman detail krs mahasiswa']);
        }
    }

    public function showStudentData(Request $request, $id)
    {
        try {
            $data = [
                'nama' => 'Fauzan Akmal Mukhlas',
                'nim' => '105221015',
                'judul_ta' => '',
                'nik' => '140002848925',
                'kota_lahir' => 'Tangerang Selatan',
                'tanggal_lahir' => '28-11-2003',
                'agama' => 'Islam',
                'jenis_kelamin' => 'Pria',
                'kewarganegaraan' => 'WNI',
                'alamat_asal' => 'Jl. Teuku Nyak Arief, RT.7/RW.8, Simprug, Kec. Kby. Lama, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta',
                'rt' => '007',
                'rw' => '014',
                'dusun' => 'Durian',
                'kelurahan' => 'Serpong',
                'kecamatan' => 'Serpong',
                'kota' => 'Tangerang Selatan',
                'provinsi' => 'Banten',
                'kode_pos' => '12210',
                'jenis_tinggal' => 'Bersama Orang Tua',
                'jenis_tinggal_lain' => 'Asrama',
                'transport' => 'Motor',
                'transport_lain' => 'Mobil',
                'alamat_domisili' => 'ASRAMA SASAK DALAM 2, ASRAMA MAHASISWA H.SUGIANTO, JL. SASAK II NO.5 15, RT.5/RW.2, KLP. DUA, KEC. KB. JERUK, KOTA JAKARTA BARAT, DKI JAKARTA 11550 LEWAT JL. ARTERI PERMATA HIJAU DAN JL. PANJANG ARTERI KLP. DUA RAYA.',
                'telp_rumah' => '0909090909',
                'telp_seluler' => '0909090908',
                'telp_darurat' => '0909090907',
                'email' => 'siup@universitaspertamina.ac.id',
                'kps' => true,
                'no_kps' => '934234',
                'kebutuhan_khusus' => false,
                'orang_tua' => [
                    'ayah' => [
                        'nama' => 'Budi Suratno',
                        'nik' => '140002848925',
                        'tanggal_lahir' => '10-10-1960',
                        'riwayat_pendidikan' => 'Sarjana',
                        'pendidikan_lain' => '',
                        'pekerjaan' => 'Karyawan BUMN',
                        'pekerjaan_lain' => 'Investor',
                        'penghasilan' => 50000000,
                    ],
                    'ibu' => [
                        'nama' => 'Susi Susanti',
                        'nik' => '140002848923',
                        'tanggal_lahir' => '10-10-1962',
                        'riwayat_pendidikan' => 'Magister',
                        'pendidikan_lain' => 'Sarjana',
                        'pekerjaan' => 'Ibu Rumah Tangga',
                        'pekerjaan_lain' => 'Wirausaha',
                        'penghasilan' => 10000000,
                    ],
                ],
                'data_tambahan' => [
                    'jumlah_tanggungan' => 3,
                    'alamat_orang_tua' => 'Jl. Teuku Nyak Arief, RT.7/RW.8, Simprug, Kec. Kby. Lama, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12220',
                    'alamt_alternatif_orang_tua' => '',
                    'no_hp_orang_tua' => '0909090904',
                    'kecamatan_orang_tua' => 'Kebayoran Lama',
                    'kota_orang_tua' => 'Jakarta Selatan',
                    'provinsi_orang_tua' => 'DKI Jakarta',
                    'email_orang_tua' => 'susisusanti6219@gmail.com',
                ],
                'data_sma' => [
                    'nisn' => '140002848921',
                    'tahun_lulus' => 2021,
                    'asal' => 'SMA Negeri 7 Sumedang',
                    'provinsi' => 'Jawa Tengah',
                    'kota' => 'Sumedang',
                    'kecamatan' => 'Sidomakmur',
                    'jenis' => 'SMA',
                    'jurusan' => 'MIPA',
                    'no_ijazah' => 'M-SMK-1292/2911',
                    'uan_mtk' => rand(0, 100),
                    'uan_inggris' => rand(0, 100),
                    'uan_fisika' => rand(0, 100),
                    'rapor_mtk' => rand(0, 100),
                    'rapor_inggris' => rand(0, 100),
                ],
                'health' => [
                    'buta_warna' => false,
                    'napza' => false,
                    'riwayat_pribadi' => true,
                    'riwayat_keluarga' => true,
                    'pernyataan_kesehatan' => '',
                    'pernyataan_napza' => false,
                ],
                'statusAdministrasi' => [
                    'administrasi' => 'Belum Membayar',
                    'akademik' => 'active',
                ],
                'catatanAkademik' => [
                    [
                        'id' => 1,
                        'year' => 2021,
                        'ips' => 3.5,
                        'ipk' => 3.5,
                        'sks_diambil' => 16,
                        'sks_diperoleh' => 16,
                        'semester' => 1,
                        'mataKuliah' => [
                            [
                                'nama' => 'Pancasila',
                                'nama_kelas' => 'Pancasila - CS21',
                                'nilai' => 'A-',
                            ],
                            [
                                'nama' => 'Kalkulus I',
                                'nama_kelas' => 'Kalkulus I - CS21',
                                'nilai' => 'A',
                            ],
                        ],
                    ],
                    [
                        'id' => 2,
                        'year' => 2022,
                        'ips' => 3.6,
                        'ipk' => 3.55,
                        'sks_diambil' => 16,
                        'sks_diperoleh' => 32,
                        'semester' => 2,
                        'mataKuliah' => [
                            [
                                'nama' => 'Kewarganegaraan',
                                'nama_kelas' => 'Kewarganegaraan - CS21',
                                'nilai' => 'A-',
                            ],
                            [
                                'nama' => 'Kalkulus II',
                                'nama_kelas' => 'Kalkulus II - CS21',
                                'nilai' => 'A',
                            ],
                        ],
                    ],
                    [
                        'id' => 3,
                        'year' => 2022,
                        'ips' => 3.3,
                        'ipk' => 3.45,
                        'sks_diambil' => 23,
                        'sks_diperoleh' => 55,
                        'semester' => 1,
                        'mataKuliah' => [
                            [
                                'nama' => 'Agama',
                                'nama_kelas' => 'Agama - CS21',
                                'nilai' => 'A-',
                            ],
                            [
                                'nama' => 'Aljabar Linear dan Aplikasinya',
                                'nama_kelas' => 'Aljabar Linear dan Aplikasinya - CS21',
                                'nilai' => 'A',
                            ],
                        ],
                    ],
                ],
            ];

            return view('tutelage.student-list.detail-student-data', get_defined_vars());
        } catch (\Throwable $err) {
            $decoded = json_decode($err->getMessage());

            Log::error('Gagal memuat halaman detail data mahasiswa', [
                'url' => $url ?? null,
                'request_data' => $request->all(),
                'response' => $decoded->system_error,
            ]);

            if ($request->ajax()) {
                return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data');
            }

            return redirect()
                ->route('tutelage-group.list-student')
                ->withErrors(['error' => $decoded->message ?? 'Gagal memuat halaman detail data mahasiswa']);
        }
    }

    public function showTranskripKurikulum(Request $request, $id)
    {
        try {
            $transkrip = [
                'nim' => '105221015',
                'nip_wali' => '116130',
                'nama' => 'Fauzan Akmal Mukhlas',
                'dosen_wali' => 'Ade Irawan Ph.D',
                'sks' => '118/118',
                'fakultas' => 'Fakultas Sains dan Ilmu Komputer',
                'program' => 'Sarjana',
                'prodi' => 'Ilmu Komputer',
                'ipk' => '3.20',
            ];

            $curriculum = [
                [
                    'tahun' => 2021,
                    'semester' => '3',
                    'jenis' => 'Ganjil',
                    'matkul' => [
                        [
                            'kode' => '10008',
                            'nama' => 'Inovasi dan Kewirausahaan',
                            'sks' => 2,
                            'nilai' => 'A-',
                            'status' => 'Lulus',
                        ],
                        [
                            'kode' => '52201',
                            'nama' => 'Studi Literatur Penulisan Ilmiah',
                            'sks' => 2,
                            'nilai' => 'A-',
                            'status' => 'Lulus',
                        ],
                        [
                            'kode' => '52202',
                            'nama' => 'Probabilitas dan Statistika',
                            'sks' => 3,
                            'nilai' => 'C',
                            'status' => 'Lulus',
                        ],
                        [
                            'kode' => '52203',
                            'nama' => 'Aljabar Linear dan Aplikasinya',
                            'sks' => 3,
                            'nilai' => 'B',
                            'status' => 'Lulus',
                        ],
                        [
                            'kode' => '52204',
                            'nama' => 'Algoritma dan Struktur Data',
                            'sks' => 3,
                            'nilai' => 'B',
                            'status' => 'Lulus',
                        ],
                        [
                            'kode' => '52205',
                            'nama' => 'Praktikum Algoritma dan Struktur Data',
                            'sks' => 1,
                            'nilai' => 'B',
                            'status' => 'Lulus',
                        ],
                        [
                            'kode' => '52206',
                            'nama' => 'Basis Data',
                            'sks' => 3,
                            'nilai' => 'B+',
                            'status' => 'Lulus',
                        ],
                        [
                            'kode' => '52207',
                            'nama' => 'Praktikum Basis Data',
                            'sks' => 1,
                            'nilai' => 'A',
                            'status' => 'Lulus',
                        ],
                    ],
                    'sks_total' => 18,
                    'ips' => 3.09,
                ],
                [
                    'tahun' => 2021,
                    'semester' => '4',
                    'jenis' => 'Genap',
                    'matkul' => [
                        [
                            'kode' => '52208',
                            'nama' => 'Kecerdasan Artifisial',
                            'sks' => 2,
                            'nilai' => 'B',
                            'status' => 'Lulus',
                        ],
                        [
                            'kode' => '52209',
                            'nama' => 'Metode Numerik',
                            'sks' => 3,
                            'nilai' => 'C',
                            'status' => 'Lulus',
                        ],
                        [
                            'kode' => '52210',
                            'nama' => 'Rekayasa Perangkat Lunak',
                            'sks' => 3,
                            'nilai' => 'B+',
                            'status' => 'Lulus',
                        ],
                        [
                            'kode' => '52211',
                            'nama' => 'Komputasi Pararel dan Terdistribusi',
                            'sks' => 3,
                            'nilai' => 'B',
                            'status' => 'Lulus',
                        ],
                        [
                            'kode' => '52212',
                            'nama' => 'Jaringan Komputer',
                            'sks' => 2,
                            'nilai' => 'B-',
                            'status' => 'Lulus',
                        ],

                    ],
                    'sks_total' => 13,
                    'ips' => 3.09,
                ],
            ];

            return view('tutelage.student-list.detail-transkrip-kurikulum', get_defined_vars());
        } catch (\Throwable $err) {
            $decoded = json_decode($err->getMessage());

            Log::error('Gagal memuat halaman detail transkrip kurikulum mahasiswa', [
                'url' => $url ?? null,
                'request_data' => $request->all(),
                'response' => $decoded->system_error,
            ]);

            if ($request->ajax()) {
                return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data');
            }

            return redirect()
                ->route('tutelage-group.list-student')
                ->withErrors(['error' => $decoded->message ?? 'Gagal memuat halaman detail transkrip kurikulum mahasiswa']);
        }
    }

    public function showTranskripHistoris(Request $request, $id)
    {
        try {
            $transkrip = [
                'nim' => '105221015',
                'nip_wali' => '116130',
                'nama' => 'Fauzan Akmal Mukhlas',
                'dosen_wali' => 'Ade Irawan Ph.D',
                'sks' => '118/118',
                'fakultas' => 'Fakultas Sains dan Ilmu Komputer',
                'program' => 'Sarjana',
                'prodi' => 'Ilmu Komputer',
                'ipk' => '3.20',
            ];

            $historis = [
                [
                    'tahun' => 2021,
                    'semester' => '3',
                    'jenis' => 'Ganjil',
                    'matkul' => [
                        [
                            'kode' => '10008',
                            'nama' => 'Inovasi dan Kewirausahaan',
                            'sks' => 2,
                            'nilai' => 'A-',
                            'status' => 'Lulus',
                        ],
                        [
                            'kode' => '52201',
                            'nama' => 'Studi Literatur Penulisan Ilmiah',
                            'sks' => 2,
                            'nilai' => 'A-',
                            'status' => 'Lulus',
                        ],
                        [
                            'kode' => '52202',
                            'nama' => 'Probabilitas dan Statistika',
                            'sks' => 3,
                            'nilai' => 'C',
                            'status' => 'Lulus',
                        ],
                        [
                            'kode' => '52203',
                            'nama' => 'Aljabar Linear dan Aplikasinya',
                            'sks' => 3,
                            'nilai' => 'B',
                            'status' => 'Lulus',
                        ],
                        [
                            'kode' => '52204',
                            'nama' => 'Algoritma dan Struktur Data',
                            'sks' => 3,
                            'nilai' => 'B',
                            'status' => 'Lulus',
                        ],
                        [
                            'kode' => '52205',
                            'nama' => 'Praktikum Algoritma dan Struktur Data',
                            'sks' => 1,
                            'nilai' => 'B',
                            'status' => 'Lulus',
                        ],
                        [
                            'kode' => '52206',
                            'nama' => 'Basis Data',
                            'sks' => 3,
                            'nilai' => 'B+',
                            'status' => 'Lulus',
                        ],
                        [
                            'kode' => '52207',
                            'nama' => 'Praktikum Basis Data',
                            'sks' => 1,
                            'nilai' => 'A',
                            'status' => 'Lulus',
                        ],
                    ],
                    'sks_total' => 18,
                    'ips' => 3.09,
                ],
                [
                    'tahun' => 2021,
                    'semester' => '4',
                    'jenis' => 'Genap',
                    'matkul' => [
                        [
                            'kode' => '52208',
                            'nama' => 'Kecerdasan Artifisial',
                            'sks' => 2,
                            'nilai' => 'B',
                            'status' => 'Lulus',
                        ],
                        [
                            'kode' => '52209',
                            'nama' => 'Metode Numerik',
                            'sks' => 3,
                            'nilai' => 'C',
                            'status' => 'Lulus',
                        ],
                        [
                            'kode' => '52210',
                            'nama' => 'Rekayasa Perangkat Lunak',
                            'sks' => 3,
                            'nilai' => 'B+',
                            'status' => 'Lulus',
                        ],
                        [
                            'kode' => '52211',
                            'nama' => 'Komputasi Pararel dan Terdistribusi',
                            'sks' => 3,
                            'nilai' => 'B',
                            'status' => 'Lulus',
                        ],
                        [
                            'kode' => '52212',
                            'nama' => 'Jaringan Komputer',
                            'sks' => 2,
                            'nilai' => 'B-',
                            'status' => 'Lulus',
                        ],

                    ],
                    'sks_total' => 13,
                    'ips' => 3.09,
                ],
            ];

            return view('tutelage.student-list.detail-transkrip-historis', get_defined_vars());
        } catch (\Throwable $err) {
            $decoded = json_decode($err->getMessage());

            Log::error('Gagal memuat halaman detail transkrip historis mahasiswa', [
                'url' => $url ?? null,
                'request_data' => $request->all(),
                'response' => $decoded->system_error,
            ]);

            if ($request->ajax()) {
                return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data');
            }

            return redirect()
                ->route('tutelage-group.list-student')
                ->withErrors(['error' => $decoded->message ?? 'Gagal memuat halaman detail transkrip historis mahasiswa']);
        }
    }

    public function showTranskripPem(Request $request, $id)
    {
        try {
            $student = [
                'nim' => '105221015',
                'nama' => 'Fauzan Akmal Mukhlas',
                'prodi' => 'Ilmu Komputer',
                'tahun_masuk' => 2021,
                'total_pem' => 1750,
            ];

            $pem = [
                [
                    'organisasi' => 'Unit Kegiatan Mahasiswa (UKM)',
                    'kegiatan' => [
                        [
                            'semester' => '2021 - 2',
                            'nama' => 'Catur dan Bridge',
                            'jabatan' => 'Anggota',
                            'status' => 'Disetujui',
                            'nilai' => 150,
                        ],
                        [
                            'semester' => '2021 - 2',
                            'nama' => 'Kewirausahaan',
                            'jabatan' => 'Anggota',
                            'status' => 'Disetujui',
                            'nilai' => 150,
                        ],
                        [
                            'semester' => '2023 - 1',
                            'nama' => 'Catur dan Bridge',
                            'jabatan' => 'Anggota',
                            'status' => 'Disetujui',
                            'nilai' => 150,
                        ],
                    ],
                ],
                [
                    'organisasi' => 'Himpunan Mahasiswa Program Studi (HMPS)',
                    'kegiatan' => [
                        [
                            'semester' => '2022 - 2',
                            'nama' => 'Himpunan Mahasiswa Ilmu Komputer',
                            'jabatan' => 'Anggota',
                            'status' => 'Disetujui',
                            'nilai' => 150,
                        ],
                        [
                            'semester' => '2022 - 3',
                            'nama' => 'Himpunan Mahasiswa Ilmu Komputer',
                            'jabatan' => 'Anggota',
                            'status' => 'Disetujui',
                            'nilai' => null,
                        ],
                        [
                            'semester' => '2022 - 1',
                            'nama' => 'Himpunan Mahasiswa Ilmu Komputer',
                            'jabatan' => 'Anggota',
                            'status' => 'Disetujui',
                            'nilai' => null,
                        ],
                    ],

                ],
                [
                    'organisasi' => 'Badan Eksekutif Mahasiswa (BEM) dan BEM Fakultas (BEMF)',
                    'kegiatan' => [],
                ],
            ];

            return view('tutelage.student-list.detail-transkrip-pem', get_defined_vars());
        } catch (\Throwable $err) {
            $decoded = json_decode($err->getMessage());

            Log::error('Gagal memuat halaman detail transkrip pem mahasiswa', [
                'url' => $url ?? null,
                'request_data' => $request->all(),
                'response' => $decoded->system_error,
            ]);

            if ($request->ajax()) {
                return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data');
            }

            return redirect()
                ->route('tutelage-group.list-student')
                ->withErrors(['error' => $decoded->message ?? 'Gagal memuat halaman detail transkrip pem mahasiswa']);
        }
    }

    public function showTranskripResmi(Request $request, $id)
    {
        try {
            $transkrip = [
                'nim' => '105221015',
                'nip_wali' => '116130',
                'nama' => 'Fauzan Akmal Mukhlas',
                'dosen_wali' => 'Ade Irawan Ph.D',
                'sks' => '118/118',
                'fakultas' => 'Fakultas Sains dan Ilmu Komputer',
                'program' => 'Sarjana',
                'prodi' => 'Ilmu Komputer',
                'ipk' => '3.20',
            ];

            $mataKuliahResmi = [
                [
                    'kode' => '10008',
                    'nama' => 'Inovasi dan Kewirausahaan',
                    'sks' => 2,
                    'nilai' => 'A-',
                    'status' => 'Lulus',
                    'tahun' => '2022',
                    'semester' => 'Ganjil',
                    'konversi' => rand(0, 20) / 50,
                ],
                [
                    'kode' => '52201',
                    'nama' => 'Studi Literatur Penulisan Ilmiah',
                    'sks' => 2,
                    'nilai' => 'A-',
                    'status' => 'Lulus',
                    'tahun' => '2022',
                    'semester' => 'Ganjil',
                    'konversi' => rand(0, 20) / 50,
                ],
                [
                    'kode' => '52202',
                    'nama' => 'Probabilitas dan Statistika',
                    'sks' => 3,
                    'nilai' => 'C',
                    'status' => 'Lulus',
                    'tahun' => '2022',
                    'semester' => 'Ganjil',
                    'konversi' => rand(0, 20) / 50,
                ],
                [
                    'kode' => '52203',
                    'nama' => 'Aljabar Linear dan Aplikasinya',
                    'sks' => 3,
                    'nilai' => 'B',
                    'status' => 'Lulus',
                    'tahun' => '2022',
                    'semester' => 'Ganjil',
                    'konversi' => rand(0, 20) / 50,
                ],
                [
                    'kode' => '52204',
                    'nama' => 'Algoritma dan Struktur Data',
                    'sks' => 3,
                    'nilai' => 'B',
                    'status' => 'Lulus',
                    'tahun' => '2022',
                    'semester' => 'Ganjil',
                    'konversi' => rand(0, 20) / 50,
                ],
                [
                    'kode' => '52205',
                    'nama' => 'Praktikum Algoritma dan Struktur Data',
                    'sks' => 1,
                    'nilai' => 'B',
                    'status' => 'Lulus',
                    'tahun' => '2022',
                    'semester' => 'Ganjil',
                    'konversi' => rand(0, 20) / 50,
                ],
                [
                    'kode' => '52206',
                    'nama' => 'Basis Data',
                    'sks' => 3,
                    'nilai' => 'B+',
                    'status' => 'Lulus',
                    'tahun' => '2022',
                    'semester' => 'Ganjil',
                    'konversi' => rand(0, 20) / 50,
                ],
                [
                    'kode' => '52207',
                    'nama' => 'Praktikum Basis Data',
                    'sks' => 1,
                    'nilai' => 'A',
                    'status' => 'Lulus',
                    'tahun' => '2022',
                    'semester' => 'Ganjil',
                    'konversi' => rand(0, 20) / 50,
                ],
                [
                    'kode' => '52208',
                    'nama' => 'Kecerdasan Artifisial',
                    'sks' => 2,
                    'nilai' => 'B',
                    'status' => 'Lulus',
                    'tahun' => '2022',
                    'semester' => 'Ganjil',
                    'konversi' => rand(0, 20) / 50,
                ],
                [
                    'kode' => '52209',
                    'nama' => 'Metode Numerik',
                    'sks' => 3,
                    'nilai' => 'C',
                    'status' => 'Lulus',
                    'tahun' => '2022',
                    'semester' => 'Ganjil',
                    'konversi' => rand(0, 20) / 50,
                ],
                [
                    'kode' => '52210',
                    'nama' => 'Rekayasa Perangkat Lunak',
                    'sks' => 3,
                    'nilai' => 'B+',
                    'status' => 'Lulus',
                    'tahun' => '2022',
                    'semester' => 'Ganjil',
                    'konversi' => rand(0, 20) / 50,
                ],
                [
                    'kode' => '52211',
                    'nama' => 'Komputasi Pararel dan Terdistribusi',
                    'sks' => 3,
                    'nilai' => 'B',
                    'status' => 'Lulus',
                    'tahun' => '2022',
                    'semester' => 'Ganjil',
                    'konversi' => rand(0, 20) / 50,
                ],
                [
                    'kode' => '52212',
                    'nama' => 'Jaringan Komputer',
                    'sks' => 2,
                    'nilai' => 'B-',
                    'status' => 'Lulus',
                    'tahun' => '2022',
                    'semester' => 'Ganjil',
                    'konversi' => rand(0, 20) / 50,
                ],
            ];

            return view('tutelage.student-list.detail-transkrip-resmi', get_defined_vars());
        } catch (\Throwable $err) {
            $decoded = json_decode($err->getMessage());

            Log::error('Gagal memuat halaman detail transkrip resmi mahasiswa', [
                'url' => $url ?? null,
                'request_data' => $request->all(),
                'response' => $decoded->system_error,
            ]);

            if ($request->ajax()) {
                return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data');
            }

            return redirect()
                ->route('tutelage-group.list-student')
                ->withErrors(['error' => $decoded->message ?? 'Gagal memuat halaman detail transkrip resmi mahasiswa']);
        }
    }

    public function addCourse(Request $request, $id)
    {
        // Dummy data Program Studi
        $programStudis = [
            'TI' => 'Teknik Informatika',
            'SI' => 'Sistem Informasi',
            'MI' => 'Manajemen Informatika',
        ];

        // Dummy data Semester
        $semesters = [
            '1' => 'Semester 1',
            '2' => 'Semester 2',
            '3' => 'Semester 3',
            '4' => 'Semester 4',
            '5' => 'Semester 5',
            '6' => 'Semester 6',
            '7' => 'Semester 7',
            '8' => 'Semester 8',
        ];

        // Dummy data Mata Kuliah
        $courses = [
            [
                'semester' => 3,
                'nama' => 'Pemrograman Web',
                'kelas' => 'A',
                'sks' => 3,
                'peserta' => 30,
                'kapasitas' => 40,
                'jadwal' => [
                    'Senin 08:00 - 10:00',
                    'Kamis 10:00 - 12:00',
                ],
                'pengajar' => [
                    'Bapak Ahmad',
                    'Ibu Rina',
                ],
            ],
            [
                'semester' => 3,
                'nama' => 'Struktur Data',
                'kelas' => 'B',
                'sks' => 3,
                'peserta' => 25,
                'kapasitas' => 40,
                'jadwal' => [
                    'Selasa 10:00 - 12:00',
                ],
                'pengajar' => [
                    'Ibu Siti',
                ],
            ],
            [
                'semester' => 5,
                'nama' => 'Basis Data Lanjut',
                'kelas' => 'A',
                'sks' => 3,
                'peserta' => 35,
                'kapasitas' => 40,
                'jadwal' => [
                    'Rabu 13:00 - 15:00',
                    'Jumat 08:00 - 10:00',
                ],
                'pengajar' => [
                    'Pak Joko',
                    'Pak Budi',
                ],
            ],
        ];

        $events = [
            [
                'title' => 'Pemrograman Web',
                'start_date' => '2025-09-27', // mulai semester
                'end_date' => '2026-01-27', // akhir semester
                'day_of_week' => 0, // Senin (0=minggu, 1=senin, dst)
                'start_time' => '09:00:00',
                'end_time' => '12:00:00',
                'color' => '#EB474D',
            ],
            [
                'title' => 'Pancasila',
                'start_date' => '2025-09-27',
                'end_date' => '2026-01-27',
                'day_of_week' => 2, // Selasa
                'start_time' => '13:00:00',
                'end_time' => '15:00:00',
                'color' => '#EB474D',
            ],
        ];

        return view('tutelage.student-list.add-course', get_defined_vars());
    }

    public function addMessage(Request $request, $id) 
    {
      try {
        $subject_id = $request->input('subject', 1);
        $subjectData = (object)[
          'id' => 1,
          'subject_name' => "Konsultasi KRS Semester 2"
        ];
        $subjectList = [
          [
            'id' => 1,
            'subject_name' => 'Konsultasi KRS Semester 2', 
            'student_name' => 'Dian Sastro W', 
            'student_nim' => '17720001', 
            'program_studi' => 'Ilmu Komputer',
            'latest_chat_at' => '2025-05-21 10:30:00+1',
            'latest_chat_by' => 'Dian Sastro W'
          ],
          [
            'id' => 2,
            'subject_name' => 'Konsultasi KRS Semester 1', 
            'student_name' => 'Dian Sastro W', 
            'student_nim' => '17720001', 
            'program_studi' => 'Ilmu Komputer',
            'latest_chat_at' => '2024-05-21 10:30:00+1',
            'latest_chat_by' => 'Dian Sastro W'
          ],
        ];

        $receiverData = (object)[
          'id' => 1,
          'name' => 'Dian Sastro W',
          'nim' => '1720001',
          'program_studi' => 'Ilmu Komputer'
        ];

        $senderData = (object)[
          'name' => session('nama'),
          'role' => 'Dosen',
          'program_studi' => 'Ilmu Komputer'
        ];

        $listStudent = [
          (object)[
            'id' => 1,
            'nama' => 'Dian Sastro W',
            'nim' => '17720001'
          ],
          (object)[
            'id' => 2,
            'nama' => 'Putri Marino',
            'nim' => '17720002'
          ],
        ];

        $messages = [
          (object)[
            'id' => 1,
            'type' => 'sender',
            'name' => 'Meredita Susanty',
            'role' => 'Dosen',
            'message' => "Hay,\nDian kamu jadi konsultasi KRS Semester 2 mau kapan ya, saya bisa hari seni pagi jam 10, kamu bisa?",
            'last_updated' =>  "2025-05-21 10:30:00+1",
            'imgProfile' => asset('assets/icons/human/women.svg')
          ],
          (object)[
            'id' => 2,
            'type' => 'receiver',
            'name' => 'Dian Sastro W',
            'role' => 'Mahasiswa',
            'message' => "Ohh boleh bu nanti saya langsung ke ruangan ibu",
            'last_updated' =>  "2025-05-21 11:00:00+1",
            'imgProfile' => asset('assets/icons/human/women.svg'),
            'nim' => '17720001'
          ],
          (object)[
            'id' => 3,
            'type' => 'sender',
            'name' => 'Meredita Susanty',
            'role' => 'Dosen',
            'message' => "Sipp,\nDi nanti langsung saja.",
            'last_updated' =>  "2025-05-21 13:40:00+1",
            'imgProfile' => asset('assets/icons/human/women.svg')
          ],
        ];

        return view('tutelage.student-list.message', get_defined_vars());

      } catch (\Throwable $err) {
        $decoded = json_decode($err->getMessage());

        Log::error('Gagal memuat halaman pesan untuk mahasiswa', [
          'url' => $url ?? null,
          'request_data' => $request->all(),
          'response' => $decoded->system_error,
        ]);

        if ($request->ajax()) {
          return $this->errorResponse($decoded->message ?? 'Gagal mendapatkan Data pesan untuk mahasiswa');
        }

        return redirect()
          ->route('tutelage-group.list-student')
          ->withErrors(['error' => $decoded->message ?? 'Gagal memuat halaman pesan untuk mahasiswa']);
      }
    }

    public function edit(Request $request, $id)
    {
        return view('students.show', get_defined_vars());
    }
}
