<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuddySettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataMahasiswa = [
            'Adinda' => 'adinda',
            'Afyar' => 'afyar',
            'Adi' => 'Adi',
            'Mahesya' => 'mahesya',
            'Alfien' => 'alfien',
            'Fadel' => 'fadel',
        ];


        $daftarPeserta = [
            // 'id' => 3,
            'nim' => '105220055',
            'nama' => 'BENI ANDRIANSYAH',
            'institusi' => 'Ilmu Komputer',
        ];

        $daftarPeserta = json_decode(json_encode($daftarPeserta), false);
        for ($i = 0; $i < 10; $i++) {
            $dataPeserta[$i] = $daftarPeserta;
        }
        return view('tutelage.lecturer.buddy-settings.index', get_defined_vars());
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
