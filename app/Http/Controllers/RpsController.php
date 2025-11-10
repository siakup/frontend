<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RpsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rpsList = [
            [
                'mata_kuliah' => 'Sistem Digital',
                'dosen' => 'Teuku Muhammad Rofii',
                'review_status' => 'Sedang Direview',
                'status' => 'Finalized',
                'tanggal_upload' => '2025-08-19, 11:42:15'
            ],
            [
                'mata_kuliah' => 'Manajemen',
                'dosen' => 'Teuku Muhammad Rofii',
                'review_status' => 'Sedang Direview',
                'status' => 'Finalized',
                'tanggal_upload' => '2025-08-19, 11:42:15'
            ],     
            [
                'mata_kuliah' => 'Sistem Informasi',
                'dosen' => 'Teuku Muhammad Rofii',
                'review_status' => 'Sedang Direview',
                'status' => 'Finalized',
                'tanggal_upload' => '2025-08-19, 11:42:15'
            ],
            [
                'mata_kuliah' => 'Ilmu Komputer',
                'dosen' => 'Meredita Susanti',
                'review_status' => 'Sedang Direview',
                'status' => 'Finalized',
                'tanggal_upload' => '2025-08-19, 11:42:15'
            ],
            [
                'mata_kuliah' => 'Aplikasi Komputer',
                'dosen' => 'Teuku Muhammad Rofii',
                'review_status' => 'Sedang Direview',
                'status' => 'Finalized',
                'tanggal_upload' => '2025-08-19, 11:42:15'
            ]                                           
        ];

        $periodeList = [
            '2022 - Ganjil' => '1',
            '2022 - Genap' => '2',
            '2023- Ganjil' => '3',
            '2023 - Genap' => '4',
            '2024 - Ganjil' => '5',
            '2024 - Genap' => '6',
            '2025 - Ganjil' => '7',
            '2025 - Genap' => '8',
            '2026 - Ganjil' => '9',
        ];
        
        $prodiList = [
            'Teknik Lingkungan' => '1',
            'Hubungan Internasional' => '2',
            'Sistem Informasi' => '3',
            'Ilmu Komputer' => '4',
            'Teknik Sipil' => '5',
            'Administrasi Bisnis' => '6',
        ];

        $matkulList = [
            'Struktur Data dan Algoritma' => '1',
            'Pengantar Akuntansi' => '2',
            'Komputasi Awan' => '3',
            'Dasar Dasar Pemrograman' => '4',
            'Basis Data' => '5',
            'Pengolahan Citra Digital' => '6',
        ];

        return view('rps.index', get_defined_vars());
    }

    public function buatRpsDeskripsiUmum() {
        $periodeList = [
            '2022 - Ganjil' => '1',
            '2022 - Genap' => '2',
            '2023- Ganjil' => '3',
            '2023 - Genap' => '4',
            '2024 - Ganjil' => '5',
            '2024 - Genap' => '6',
            '2025 - Ganjil' => '7',
            '2025 - Genap' => '8',
            '2026 - Ganjil' => '9',
        ];
        
        $prodiList = [
            'Teknik Lingkungan' => '1',
            'Hubungan Internasional' => '2',
            'Sistem Informasi' => '3',
            'Ilmu Komputer' => '4',
            'Teknik Sipil' => '5',
            'Administrasi Bisnis' => '6',
        ];

        $matkulList = [
            'Struktur Data dan Algoritma' => '1',
            'Pengantar Akuntansi' => '2',
            'Komputasi Awan' => '3',
            'Dasar Dasar Pemrograman' => '4',
            'Basis Data' => '5',
            'Pengolahan Citra Digital' => '6',
        ];

        $timPengajarList = [
            'Catia Angli Curie, MS' => '1',
            'Meredita Susanti' => '2',
            'Abdul Hamid' => '3',
            'Hasan Hasbi' => '4',
            'Irwan Nasution' => '5',
            'Agung Pramono Anung' => '6',
        ];

        $matkulSyaratList = [
            'Termodinamika' => '1',
            'Bahasa Inggris' => '2',
            'Agama dan Etika' => '3',
        ];


        return view('rps.deskripsi-umum.index', get_defined_vars());
    }

    public function showCapaianPembelajaran(){
        $cplList = [
            [
                'cpl' => 'CPL-G',
                'deskripsi' => 'Kemampuan menerapkan pengetahuan matematika dan ilmu pengetahuan dasar lainnya 
                                terutama pada kekhususan bidang teknik dan memahami konteks ilmu pengetabuan 
                                dan rekayasa multidisiplin yang lebih luas.'
            ],
            [
                'cpl' => 'CPL-H',
                'deskripsi' => 'Kemampuan untuk mengidentifikasi, merumuskan dan menyelesaikan permasalahan rekayasa
                                di bidang studi masing nasing: dan memilih serta menerapkan metode-metode relevan 
                                yang dibangun dari metode analitis, komputasi, da: chsnerimental vano telah dislani.'
            ],
            [
                'cpl' => 'CPL-I',
                'deskripsi' => 'Kemampuan untuk memilih dan memakai teknik-teknik, sumber days, serta peralatan 
                                rekayasa dan aplikasi IT modern yang sesuai, termasuk melakukan prediksi dan 
                                pemodelan problem rekayasa .'
            ]
        ];

        $cpmkList = [
            [
                'cpmk' => 'CPMK-1',
                'deskripsi' => 'Mahasiswa dapat mengevaluasi performa steam power plant, sistem refrigerasi dan sistem 
                                pencairan gas dalam hal kebutuhan energi, aliran massa yang terlibat, dan efisiensinya.'
            ],
            [
                'cpmk' => 'CPMK-2',
                'deskripsi' => 'Mahasiswa mampu menentukan dan menggunakan persamaan kesetimbangan yang sesuai untuk 
                                menyelesaikan permasalahan teknik kimia sederhana terkait kesetimbangan fasa maupun 
                                kesetimbangan reaksi kimia.'
            ],
            [
                'cpmk' => 'CPMK-3',
                'deskripsi' => 'Mahasiswa mampu menentukan dan menggunakan persamaan kesetimbangan yang sesuai untuk 
                                menyelesaikan permasalahan teknik kimia sederhana terkait kesetimbangan fasa maupun 
                                kesetimbangan reaksi kimia'
            ]

        ];

        return view('rps.capaian-pembelajaran.index', get_defined_vars());
    }

    public function buatCapaianPembelajaranLulusan () {
        $cplList = [
            [
                'kode' => 'CPL-A',
                'deskripsi' => 'Memiliki karakter individu yang berbudi pekerti luhur, berintegritas, spiritual dan cinta tanah air'
            ],
            [
                'kode' => 'CPL-B',
                'deskripsi' => 'Memiliki karakter individu yang berbudi pekerti luhur, berintegritas, spiritual dan cinta tanah air'
            ],
            [
                'kode' => 'CPL-C',
                'deskripsi' => 'Memiliki karakter individu yang berbudi pekerti luhur, berintegritas, spiritual dan cinta tanah air'
            ],
            [
                'kode' => 'CPL-D',
                'deskripsi' => 'Memiliki karakter individu yang berbudi pekerti luhur, berintegritas, spiritual dan cinta tanah air'
            ], 
            [
                'kode' => 'CPL-E',
                'deskripsi' => 'Memiliki karakter individu yang berbudi pekerti luhur, berintegritas, spiritual dan cinta tanah air'
            ], 
            [
                'kode' => 'CPL-F',
                'deskripsi' => 'Memiliki karakter individu yang berbudi pekerti luhur, berintegritas, spiritual dan cinta tanah air'
            ], 
            [
                'kode' => 'CPL-G',
                'deskripsi' => 'Memiliki karakter individu yang berbudi pekerti luhur, berintegritas, spiritual dan cinta tanah air'
            ], 
            [
                'kode' => 'CPL-H',
                'deskripsi' => 'Memiliki karakter individu yang berbudi pekerti luhur, berintegritas, spiritual dan cinta tanah air'
            ], 
            [
                'kode' => 'CPL-I',
                'deskripsi' => 'Memiliki karakter individu yang berbudi pekerti luhur, berintegritas, spiritual dan cinta tanah air'
            ],
            [
                'kode' => 'CPL-J',
                'deskripsi' => 'Memiliki karakter individu yang berbudi pekerti luhur, berintegritas, spiritual dan cinta tanah air'
            ], 
            [
                'kode' => 'CPL-K',
                'deskripsi' => 'Memiliki karakter individu yang berbudi pekerti luhur, berintegritas, spiritual dan cinta tanah air'
            ], 
            [
                'kode' => 'CPL-L',
                'deskripsi' => 'Memiliki karakter individu yang berbudi pekerti luhur, berintegritas, spiritual dan cinta tanah air'
            ]              
        ];

        return view('rps.capaian-pembelajaran.create-cpl', get_defined_vars());
    }

    public function buatKomponenPenilaian () {
        $cpmkList = ['CPMK-1','CPMK-2','CPMK-3','CPMK-4','CPMK-5','CPMK-6','CPMK-7','CPMK-8','CPMK-9','CPMK-10'];

        $komponenList = [
            [
                'nama' => 'TUGAS',
                'bobot' => '30.00%',
                'cpmk' => [false, true, true, true, false, true, true, true, false, true]
            ],
            [
                'nama' => 'UTS',
                'bobot' => '30.00%',
                'cpmk' => [true, false, true, true, false, false, true, true, false, true]     
            ],
            [
                'nama' => 'UAS',
                'bobot' => '30.00%',
                'cpmk' => [true, false, true, true, false, false, true, true, false, true]
            ],
        ];

        $komponenPenilaian = [
            'Tugas' => '1',
            'Kuis' => '2',
            'UTS' => '3',
            'UAS' => '4',
            'Praktikum' => '5',
        ];

        return view('rps.komponen-penilaian.index', get_defined_vars());
    }

    public function showRencanaPerkuliahan() {

        $rencanaPerkuliahan = [
            [
                'minggu' => 1,
                'cpmk' => 'CPMK-1',
                'sub_cpmk' => '1. Mahasiswa mampu menggunakan prinsip neraca energi untuk mengevaluasi steam power plant, seperti: menentukan laju alir steam, daya pompa/turbin, laju alir panas pada boiler/condenser).
                                2. Mahasiswa dapat menentukan efisiensi termal steam power plant yang beroperasi dengan siklus Rankine (ideal maupun aktual)',
                'rencana' => '1. Rencana Pembelajaran Studi
                            2. Steam power plant
                                a. Review siklus Carnot
                                b. Siklus Rankine ideal (ideal vapor power cycle)
                                c. Siklus Rankine aktual',
                'waktu_kuliah' => 100,
                'waktu_diskusi_latihan' => 50,
                'waktu_praktikum' => 180,
                'waktu_mandiri' => 180,
                'metode_penilaian' => 'Tugas 1, UTS'
            ],
            [
                'minggu' => 2,
                'cpmk' => 'CPMK-1',
                'sub_cpmk' => '1. Mahasiswa memahami perbedaan antara siklus refrigerasi dan power plant
                                2. Mahasiswa memahami siklus vapor compression ideal',
                'rencana' => '2. Steam power plant
                                a. Meningkatkan efisiensi siklus Ranking
                                2. Refrigerasi
                                a. Refrigerasi ideal: Carnot refrigerator & vapor compression cycle',
                'waktu_kuliah' => 100,
                'waktu_diskusi_latihan' => 50,
                'waktu_praktikum' => 180,
                'waktu_mandiri' => 180,
                'metode_penilaian' => 'Tugas 2, UTS'
            ],
            [
                'minggu' => 3,
                'cpmk' => 'CPMK-1',
                'sub_cpmk' => 'Mahasiswa mampu menggunakan prinsip neraca energi untuk mengevaluasi performa refrigerasi vapor compression cycle, seperti: menentukan laju alir refrigeran, daya kompresor, laju alir panas pada condenser/evaporator)',
                'rencana' => 'Refrigerasi
                                3.2. Efektivitas refrigerator (coefficient of performance)
                                3.3. Actual vapor compression cycle
                                3.4. Pemilihan refrigeran (pengayaan)',
                'waktu_kuliah' => 100,
                'waktu_diskusi_latihan' => 50,
                'waktu_praktikum' => 180,
                'waktu_mandiri' => 180,
                'metode_penilaian' => 'Tugas 3, UTS'
            ],
            [
                'minggu' => 4,
                'cpmk' => 'CPMK-1',
                'sub_cpmk' => 'Mahasiswa memahami prinsip pencairan gas berdasarkan diagram fasa',
                'rencana' => 'Liquefaction
                                4.1. Pengertian & diagram fasa
                                4.2. Linde liquefaction',
                'waktu_kuliah' => 100,
                'waktu_diskusi_latihan' => 50,
                'waktu_praktikum' => 180,
                'waktu_mandiri' => 180,
                'metode_penilaian' => 'UTS'
            ]
        ];

        $rencanaPerkuliahan = collect($rencanaPerkuliahan)->map(function ($item) {
            $item['total_waktu'] = collect($item)->only([
                'waktu_kuliah', 'waktu_diskusi_latihan', 'waktu_praktikum', 'waktu_mandiri'
            ])->sum();
            return $item;
        });

        // Hitung total per jenis waktu
        $waktuTotal = [
            'kuliah' => $rencanaPerkuliahan->sum('waktu_kuliah'),
            'diskusi_latihan' => $rencanaPerkuliahan->sum('waktu_diskusi_latihan'),
            'praktikum' => $rencanaPerkuliahan->sum('waktu_praktikum'),
            'mandiri' => $rencanaPerkuliahan->sum('waktu_mandiri'),
        ];

        // Hitung total keseluruhan
        $waktuTotal['total'] = array_sum($waktuTotal);
        $waktuStandarNasional = 140;
        $sks = 3;

        return view('rps.rencana-perkuliahan.index', get_defined_vars());
    }

    public function buatRencanaPerkuliahan() {
        $cpmkList = [
            [
                'label' => 'CPMK-1', 'value' => 1
            ],
            [
                'label' => 'CPMK-2', 'value' => 2
            ],
            [
                'label' => 'CPMK-3', 'value' => 3
            ],
        ];

        return view('rps.rencana-perkuliahan.create', get_defined_vars());
    }

    public function showMatriksPenilaianKognitif() {
        $matriksList = [
            [
                'nilai' => '40 < X <= 60',
                'jawaban' => 'Jabawan mahasiswa menunjukan pemahaman konsep dan teknik pemecahan masalah, tapi masih ada gap dalam penjelasan atau alasannya.'
            ],
            [
                'nilai' => '60 < X <= 80',
                'jawaban' => 'Jabawan mahasiswa menunjukan pemahaman sebagian dari konsep atau mahasiswa telah memulai jawaban dengan benar namun salah pada bagian penyelesaian masalah.'
            ],
            [
                'nilai' => '80 < X <= 100',
                'jawaban' => 'Jabawan mahasiswa menunjukan pemahaman tentang bagaimana memecahkan masalah dan hasilnya benar. Kesalahan kecil dapat diterima sepanjang tidak mengindikasıkan kesalahpahaman konsep.'
            ],            

        ];


        return view('rps.matriks-penilaian-kognitif.index', get_defined_vars());
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
}
