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


        return view('rps.deskripsi-umum', get_defined_vars());
    }

    public function buatCapaianPembelajaran(){
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

        return view('rps.capaian-pembelajaran', get_defined_vars());
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
