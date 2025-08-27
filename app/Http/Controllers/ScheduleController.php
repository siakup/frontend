<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

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


    public function store(Request $r)      { /* TODO: call API create */ }
    public function show($id)              { return view('academics.schedule.prodi_schedule.show', compact('id')); }
    public function edit($id)              { return view('academics.schedule.prodi_schedule.edit', compact('id')); }
    public function update(Request $r,$id) { /* TODO: call API update */ }
    public function destroy($id)           { /* TODO: call API delete */ }
    public function importFet1(Request $r) { /* TODO: call API import */ }
}
