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
            // TODO: implementasi halaman view Auto Assign
            return view('academics.auto-assign.view');
        }

        /**
         * Data peserta yang sudah diisi
         */
        public function autoAssignFilledMember()
        {
            // TODO: implementasi peserta diisi Auto Assign
            return view('academics.auto-assign.filled-member');
        }

        /**
         * Data peserta yang sudah disetujui
         */
        public function autoAssignApprovedMember()
        {
            // TODO: implementasi peserta disetujui Auto Assign

            return view('academics.auto-assign.approved-member');
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
