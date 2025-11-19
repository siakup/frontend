<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClassLecturerController extends Controller
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
                'dosen' => 'Meredita Susanty',
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
            '2025 - Ganjil' => '1',
            '2025 - Pendek' => '2',
            '2025- Genap' => '3',
            '2024 - Ganjil' => '4',
            '2024 - Pendek' => '5',
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

        return view('class-lecturer.index', get_defined_vars());
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
