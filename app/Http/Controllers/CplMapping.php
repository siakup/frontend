<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CplMapping extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cpl-mapping.index');
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

    public function upload(Request $request)
    {
      return view('cpl-mapping.upload', get_defined_vars());
    }

    public function uploadResult(Request $request)
    {
    //   $validator = Validator::make($request->all(), [
    //     'file' => 'required|file|mimes:csv,xlsx|max:5120'
    //   ]);
    //   $file = $request->file('file');
    //   $file_data = [];
    //   $errors = [];

    //   $file_data = convertFileDataExcelToObject($file);
    //   $file_data = array_map(function ($value) {
    //     return [
    //       'kode' => $value['kode_mk'],
    //       'nama' => $value['nama_mk'],
    //       'sks' => $value['sks'],
    //       'jenis' => $value['jenis_mk'],
    //       'semester' => $value['semester']
    //     ];
    //   }, $file_data);

      return view('cpl-mapping.upload-result', get_defined_vars());
    }
}
