<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

use App\Traits\ApiResponse;

use Exception;

class TutelageController extends Controller
{
    use ApiResponse;

    public function listStudent(Request $request)
    {
        // ambil current page & per page
        $currentPage = $request->input('page', 1);
        $perPage     = $request->input('per_page', 10);

        // dummy total data
        $totalItems = 53; // misal 53 mahasiswa
        $totalPages = (int) ceil($totalItems / $perPage);

        // generate dummy mahasiswa sesuai page
        $students = [];
        $startId = ($currentPage - 1) * $perPage + 1;
        $endId   = min($startId + $perPage - 1, $totalItems);

        for ($i = $startId; $i <= $endId; $i++) {
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
                ],
            ];
        }

        return view('tutelage.student-list.index', [
            'students' => $students,
            'pagination' => [
                'current_page' => $currentPage,
                'per_page'     => $perPage,
                'total_items'  => $totalItems,
                'total_pages'  => $totalPages,
            ],
        ]);
    }


    public function showKrs(Request $request, $id)
    {
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
                'pending'  => 'pill-wait',
                'deletion' => 'pill-del',
                'rejected' => 'pill-no',
                'approved' => 'pill-ok',
            ];
            return '<span class="pill ' . $map[$type] . '">' . $txt . '</span>';
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
                'end_date'   => '2026-01-27', // akhir semester
                'day_of_week' => 0, // Senin (0=minggu, 1=senin, dst)
                'start_time' => '09:00:00',
                'end_time'   => '12:00:00',
                'color' => '#EB474D',
            ],
            [
                'title' => 'Pancasila',
                'start_date' => '2025-09-27',
                'end_date'   => '2026-01-27',
                'day_of_week' => 2, // Selasa
                'start_time' => '13:00:00',
                'end_time'   => '15:00:00',
                'color' => '#EB474D',
            ],
        ];



        // Kolom tabel
        $cols = [
            'No','Nama Kelas','Nama Mata Kuliah','SKS','Nilai',
            'Prodi Lain','Presensi Kehadiran','Status UAS','Status'
        ];

        // Grouping by status
        $tblPending  = array_filter($courses, fn($c) => $c['status'] === 'pending');
        $tblDeletion = array_filter($courses, fn($c) => $c['status'] === 'deletion');
        $tblRejected = array_filter($courses, fn($c) => $c['status'] === 'rejected');
        $tblApproved = array_filter($courses, fn($c) => $c['status'] === 'approved');

        return view('tutelage.student-list.detail-krs', get_defined_vars());
    }

    public function showTranskripKurikulum(Request $request, $id)
    {
        $transkrip = [
            'nim' => '105221015',
            'nip_wali' => '116130',
            'nama' => 'Fauzan Akmal Mukhlas',
            'dosen_wali' => 'Ade Irawan Ph.D',
            'sks' => '118/118',
            'fakultas' => 'Fakultas Sains dan Ilmu Komputer',
            'program' => 'Sarjana',
            'prodi'=> 'Ilmu Komputer',
            'ipk' => '3.20',
        ];

        $historis = [
            [
            'tahun' => 2021,
            'semester' => '3',
            'jenis' => 'Ganjil',
            'matkul' => [
                [
                    'kode'=>'10008',
                    'nama'=>'Inovasi dan Kewirausahaan',
                    'sks'=> 2,
                    'nilai'=>'A-',
                    'status'=>'Lulus'
                ],
                [
                    'kode'=>'52201',
                    'nama'=>'Studi Literatur Penulisan Ilmiah',
                    'sks'=>2,
                    'nilai'=>'A-',
                    'status'=>'Lulus'
                ],
                [
                    'kode'=>'52202',
                    'nama'=>'Probabilitas dan Statistika',
                    'sks'=> 3,
                    'nilai'=>'C',
                    'status'=>'Lulus'
                ],
                [
                    'kode'=>'52203',
                    'nama'=>'Aljabar Linear dan Aplikasinya',
                    'sks'=> 3,
                    'nilai'=>'B',
                    'status'=>'Lulus'
                ],
                [
                    'kode'=>'52204',
                    'nama'=>'Algoritma dan Struktur Data',
                    'sks'=> 3,
                    'nilai'=>'B',
                    'status'=>'Lulus'
                ],
                [
                    'kode'=>'52205',
                    'nama'=> 'Praktikum Algoritma dan Struktur Data',
                    'sks'=> 1,
                    'nilai'=>'B',
                    'status'=>'Lulus'
                ],
                [
                    'kode'=>'52206',
                    'nama'=>'Basis Data',
                    'sks'=> 3,
                    'nilai'=>'B+',
                    'status'=>'Lulus'
                ],
                [
                    'kode'=>'52207',
                    'nama'=>'Praktikum Basis Data',
                    'sks'=> 1,
                    'nilai'=>'A',
                    'status'=>'Lulus'
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
                        'kode'=>'52208',
                        'nama'=>'Kecerdasan Artifisial',
                        'sks'=> 2,
                        'nilai'=>'B',
                        'status'=>'Lulus'
                    ],
                    [
                        'kode'=>'52209',
                        'nama'=>'Metode Numerik',
                        'sks'=> 3,
                        'nilai'=>'C',
                        'status'=>'Lulus'
                    ],
                    [
                        'kode'=>'52210',
                        'nama'=>'Rekayasa Perangkat Lunak',
                        'sks'=> 3,
                        'nilai'=>'B+',
                        'status'=>'Lulus'
                    ],
                    [
                        'kode'=>'52211',
                        'nama'=>'Komputasi Pararel dan Terdistribusi',
                        'sks'=> 3,
                        'nilai'=>'B',
                        'status'=>'Lulus'
                    ],
                    [
                        'kode'=>'52212',
                        'nama'=>'Jaringan Komputer',
                        'sks'=> 2,
                        'nilai'=>'B-',
                        'status'=>'Lulus'
                    ],

                ],
                'sks_total' => 13,
                'ips' => 3.09,
            ]
        ];

        return view('tutelage.student-list.detail-transkrip-kurikulum', get_defined_vars());
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
                'end_date'   => '2026-01-27', // akhir semester
                'day_of_week' => 0, // Senin (0=minggu, 1=senin, dst)
                'start_time' => '09:00:00',
                'end_time'   => '12:00:00',
                'color' => '#EB474D',
            ],
            [
                'title' => 'Pancasila',
                'start_date' => '2025-09-27',
                'end_date'   => '2026-01-27',
                'day_of_week' => 2, // Selasa
                'start_time' => '13:00:00',
                'end_time'   => '15:00:00',
                'color' => '#EB474D',
            ],
        ];

        return view('tutelage.student-list.add-course', get_defined_vars());
    }

    public function edit(Request $request, $id)
    {
        return view('students.show', get_defined_vars());
    }

}
