<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Endpoint\CourseService;

use App\Traits\ApiResponse;

use Exception;

class CourseController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {

        return redirect()->route('courses.index')->with('success', 'Course berhasil ditambahkan.');
    }

    public function show($id)
    {
        return view('courses.show', compact('course'));
    }

    public function edit($id)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {

        return redirect()->route('courses.index')->with('success', 'Course berhasil diperbarui.');
    }

    public function delete($id)
    {

        return redirect()->route('courses.index')->with('success', 'Course berhasil dihapus.');
    }

    public function getListMataKuliah(Request $request)
    {
        $prodi = $request->input('prodi');

        $params = compact('prodi');

        $url = CourseService::getInstance()->getMataKuliahPrasyarat();
        $response = getCurl($url, $params, getHeaders());

        if ($request->ajax()) {
            return $this->successResponse($response->data ?? [], 'Berhasil mendapatkan data');
        }

        return view('subject.index', [
            'data' => $response,
            'prodi' => $prodi,
        ]);
    }
}
