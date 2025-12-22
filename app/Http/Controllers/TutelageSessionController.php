<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TutelageSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'nama_event' => 'Perwalian I Semester Ganjil',
            'periode_akademik' => 'Ganjil 2022',
            'tanggal' => '2022-09-20',
            'tempat' => 'Online',
            'jumlah_peserta' => 3,
        ];

        $data = json_decode(json_encode($data), false);
        for ($i = 1; $i < 6; $i++) {
            $perwalian[$i] = $data;
        }

        return view('tutelage.lecturer.tutelage-session.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'kelompok_perwalian' => 'Teuku Muhammad Roffi',
            'dosen_wali' => 'Teuku Muhammad Roffi',
            'jenjang' => '2024/2025',
            'periode_akademik' => '2023 - Ganjil',
        ];

        $data = json_decode(json_encode($data), false);

        $daftarPeserta = [
            'nim' => '105220055',
            'nama' => 'BENI ANDRIANSYAH',
            'institusi' => 'Ilmu Komputer',
        ];

        $daftarPeserta = json_decode(json_encode($daftarPeserta), false);
        for ($i = 1; $i < 6; $i++) {
            $dataPeserta[$i] = $daftarPeserta;
        }
        return view('tutelage.lecturer.tutelage-session.create', get_defined_vars());
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
