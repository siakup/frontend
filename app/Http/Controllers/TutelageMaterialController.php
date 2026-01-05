<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TutelageMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            [
                'id' => 1,
                'periode' => '2023 - Ganjil',
                'event' => 'Perwalian I',
            ],
            [
                'id' => 2,
                'periode' => '2023 - Ganjil',
                'event' => 'Perwalian II',
            ],
            [
                'id' => 3,
                'periode' => '2023 - Genap',
                'event' => 'Perwalian I',
            ],
            [
                'id' => 4,
                'periode' => '2023 - Genap',
                'event' => 'Perwalian II',
            ],
        ];

        $materiPerwalian = json_decode(json_encode($data), false);

        return view('tutelage.material.index', get_defined_vars());
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
