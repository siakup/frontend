<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class AutoAssignController extends Controller
    {
        /**
         * Tampilkan halaman utama Auto Assign
         */
        public function autoAssignIndex()
        {
            // TODO: ambil data real dari DB, sekarang dummy dulu
            $prodis = [
                'TI' => 'Teknik Informatika',
                'SI' => 'Sistem Informasi',
                'MI' => 'Manajemen Informatika',
            ];

            $programs = [
                'reguler'   => 'Reguler',
                'karyawan'  => 'Karyawan',
                'eksekutif' => 'Eksekutif',
            ];

            $periods = [
                '2023_ganjil' => '2023/2024 - Ganjil',
                '2023_genap'  => '2023/2024 - Genap',
            ];

            $angkatans = [
                '2020' => '2020',
                '2021' => '2021',
                '2022' => '2022',
                '2023' => '2023',
            ];

            // Dummy data untuk tabel
            $assignments = [
                [
                    'program'  => 'Teknik Informatika - Reguler',
                    'periode'  => '2023/2024 - Ganjil',
                    'angkatan' => '2021',
                ],
                [
                    'program'  => 'Sistem Informasi - Karyawan',
                    'periode'  => '2023/2024 - Genap',
                    'angkatan' => '2020',
                ],
                [
                    'program'  => 'Manajemen Informatika - Eksekutif',
                    'periode'  => '2023/2024 - Ganjil',
                    'angkatan' => '2022',
                ],
            ];

            return view('academics.auto-assign.index', get_defined_vars());
        }


        /**
         * Lihat detail Auto Assign
         */
        public function autoAssignView()
        {
            $data = [
                [
                    'nama' => 'Pak Budi',
                    'kode_mata_ajar' => 'MK001',
                    'nama_mata_ajar' => 'Algoritma dan Pemrograman',
                    'peserta' => 20,
                    'disetujui' => 18,
                    'kapasitas' => 30,
                ],
                [
                    'nama' => 'Bu Sari',
                    'kode_mata_ajar' => 'MK002',
                    'nama_mata_ajar' => 'Basis Data',
                    'peserta' => 25,
                    'disetujui' => 22,
                    'kapasitas' => 30,
                ],
                [
                    'nama' => 'Pak Andi',
                    'kode_mata_ajar' => 'MK003',
                    'nama_mata_ajar' => 'Pemrograman Web',
                    'peserta' => 30,
                    'disetujui' => 30,
                    'kapasitas' => 30,
                ],
            ];

            return view('academics.auto-assign.view', get_defined_vars());
        }


        /**
         * Data peserta yang sudah diisi
         */
        public function autoAssignFilledMember()
        {
            $makul = 'Aljabar Linear';

            $data = [
                [
                    'nim' => '20211001',
                    'nama' => 'Andi Pratama',
                    'status' => 'Terdaftar',
                    'status_akademik' => 'Aktif',
                ],
                [
                    'nim' => '20211002',
                    'nama' => 'Budi Santoso',
                    'status' => 'Menunggu',
                    'status_akademik' => 'Cuti',
                ],
                [
                    'nim' => '20211003',
                    'nama' => 'Citra Lestari',
                    'status' => 'Terdaftar',
                    'status_akademik' => 'Aktif',
                ],
            ];

            return view('academics.auto-assign.filled-member', get_defined_vars());
        }

        /**
         * Data peserta yang sudah disetujui
         */
        public function autoAssignApprovedMember()
        {
            $makul = 'Aljabar Linear';

            $data = [
                [
                    'nim' => '20211001',
                    'nama' => 'Andi Pratama',
                    'status' => 'Terdaftar',
                    'status_akademik' => 'Aktif',
                ],
                [
                    'nim' => '20211002',
                    'nama' => 'Budi Santoso',
                    'status' => 'Menunggu',
                    'status_akademik' => 'Cuti',
                ],
                [
                    'nim' => '20211003',
                    'nama' => 'Citra Lestari',
                    'status' => 'Terdaftar',
                    'status_akademik' => 'Aktif',
                ],
            ];

            return view('academics.auto-assign.approved-member', get_defined_vars());
        }

        /**
         * Submit hasil Auto Assign
         */
        public function autoAssignSubmit(Request $request)
        {
            // Log untuk debugging
            \Log::info('AutoAssignSubmit payload:', $request->all());

            // Simulasi delay proses (misalnya 2 detik)
            sleep(2);

            return response()->json([
                'message' => 'AutoAssignSubmit berhasil diproses',
                'data'    => $request->all(),
            ], 200);
        }

    }
