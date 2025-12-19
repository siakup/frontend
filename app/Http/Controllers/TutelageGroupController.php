<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nette\Utils\Json;

class TutelageGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'id' => 1,
            'nama' => 'Ade Irawan',
            'periode_akademik' => '2023-2',
            'bimbingan' => [
                [
                    'tahun' => '2017',
                    'jumlah_mahasiswa' => 1,
                    'status_aktif' => 0,
                    'status_cuti' => 0,
                    'status_kosong' => 1,
                ],
                [
                    'tahun' => '2019',
                    'jumlah_mahasiswa' => 1,
                    'status_aktif' => 1,
                    'status_cuti' => 0,
                    'status_kosong' => 0,
                ],
                [
                    'tahun' => '2020',
                    'jumlah_mahasiswa' => 1,
                    'status_aktif' => 17,
                    'status_cuti' => 0,
                    'status_kosong' => 3,
                ],
            ],
        ];

        $data = json_decode(json_encode($data), false);
        $collection = collect($data->bimbingan);

        $data->bimbingan_formatted = $collection->map(fn($item) => $item->tahun . ' - ' . $item->jumlah_mahasiswa . ' Mahasiswa')->implode('<br>');
        $data->status_aktif = $collection->pluck('status_aktif')->implode('<br>');
        $data->status_cuti = $collection->pluck('status_cuti')->implode('<br>');
        $data->status_kosong = $collection->pluck('status_kosong')->implode('<br>');

        for ($i = 1; $i < 10; $i++) {
            $perwalian[$i] = $data;
        }

        return view('tutelage.academic-staff.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'nim' => '105220055',
            'tahun_masuk' => '2020',
            'nama' => 'BENI ANDRIANSYAH',
            'institusi' => 'Ilmu Komputer',
        ];

        $data = json_decode(json_encode($data), false);
        for ($i = 1; $i < 10; $i++) {
            $perwalian[$i] = $data;
        }

        return view('tutelage.academic-staff.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function copy(Request $request, $id)
    {
        $lectureName = 'Meredita Susanty';
        $periode = 3;
        $major = 4;
        $data = [
            'nim' => '105220055',
            'tahun_masuk' => '2020',
            'nama' => 'BENI ANDRIANSYAH',
            'institusi' => 'Ilmu Komputer',
        ];

        $data = json_decode(json_encode($data), false);
        for ($i = 1; $i < 10; $i++) {
            $perwalian[$i] = $data;
        }

        return view('tutelage.academic-staff.copy', get_defined_vars());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lectureName = 'Meredita Susanty';
        $periode = 3;
        $major = 4;
        $dataMahasiswa = [
            'nim' => '105220055',
            'tahun_masuk' => '2020',
            'nama' => 'BENI ANDRIANSYAH',
            'institusi' => 'Ilmu Komputer',
        ];

        $dataMahasiswa = json_decode(json_encode($dataMahasiswa), false);
        for ($i = 1; $i < 10; $i++) {
            $perwalian[$i] = $dataMahasiswa;
        }

        $dosenWali = [
            [
                'id' => 1,
                'nip'=> '20201002',
                'nama' => 'Urip Teguh',
                'jumlah_bimbingan' => 31,
                'institusi' => 'Ilmu Komputer',
                'jenjang_pendidikan'=> 'S1 Reguler'
            ],
            [
                'id' => 2,
                'nip'=> '20201002',
                'nama' => 'Intan Oktafiani',
                'jumlah_bimbingan' => 31,
                'institusi' => 'Ilmu Komputer',
                'jenjang_pendidikan'=> 'Master'
            ],
            [
                'id' => 3,
                'nip'=> '20201002',
                'nama' => 'Ade Hodijah',
                'jumlah_bimbingan' => 31,
                'institusi' => 'Ilmu Komputer',
                'jenjang_pendidikan'=> 'S1 Reguler'
            ],
        ];

        $dosenWali = json_decode(json_encode($dosenWali), false);

        return view('tutelage.academic-staff.edit', get_defined_vars());
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
