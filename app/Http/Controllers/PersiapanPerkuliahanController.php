<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PersiapanPerkuliahanController extends Controller
{
    public function index(Request $req)
    {
        // === 1) DATA DUMMY (sementara untuk slicing) ===
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
            // tambahkan beberapa baris lagi kalau mau lihat pagination
        ];

        // === 2) PARAM & PAGINATOR ===
        $page    = (int) $req->query('page', 1);
        $perPage = (int) $req->query('per_page', 7);

        $slice = collect($rows)->forPage($page, $perPage)->values();
        $items = new LengthAwarePaginator(
            $slice,                // item halaman ini
            count($rows),          // total item
            $perPage,              // item per halaman
            $page,                 // halaman saat ini
            ['path' => url()->current()] // biar links() benar
        );

        // === 3) DROPDOWN OPSI (sementara) ===
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

        // === 4) KIRIM KE VIEW (WAJIB: 'items') ===
        return view('academics.persiapan_perkuliahan.jadwal_prodi.index', [
            'items' => $items,
            'programPerkuliahanList' => $programPerkuliahanList,
            'programStudiList'       => $programStudiList,
            'id_program'             => (int) $req->query('program_perkuliahan', 1),
            'id_prodi'               => (int) $req->query('program_studi', 10),
            'q'                      => $req->query('q', ''),
        ]);

        
    }
}
