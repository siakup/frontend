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
        $urlDetail = CourseService::getInstance()->courseUrl($id);
        $course = getCurl($urlDetail, null, getHeaders());

        $data = json_decode(json_encode($course), true)['data']['course'];

        return view('courses.edit', compact('course'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'study_program'    => 'required',
            'code'             => 'required',
            'name'             => 'required',
            'credits'          => 'required|numeric',
            'semester'         => 'required|numeric',
            'course_type'      => 'required',
        ], [
            'study_program.required' => "Program studi wajib diisi",
            'code.required'          => "Kode matakuliah wajib diisi",
            'name.required'          => "Nama matakuliah wajib diisi",
            'credits.required'       => "SKS wajib diisi",
            'semester.required'      => "Semester wajib diisi",
            'course_type.required'   => "Jenis matakuliah wajib diisi",
        ]);

        $subject = [
            'study_program'    => $request->study_program,
            'code'             => $request->code,
            'name'             => $request->name,
            'english_name'     => $request->english_name,
            'short_name'       => $request->short_name,
            'credits'          => $request->credits,
            'semester'         => $request->semester,
            'objective'        => $request->objective,
            'description'      => $request->description,
            'bibliography'     => $request->bibliography,
            'course_type'      => $request->course_type,
            'coordinator'      => $request->coordinator,
            'special_course'   => $request->special_course,
            'open_for_other'   => $request->open_for_other,
            'mandatory'        => $request->mandatory,
            'merdeka_campus'   => $request->merdeka_campus,
            'capstone'         => $request->capstone,
            'internship'       => $request->internship,
            'final_assignment' => $request->final_assignment,
            'minor'            => $request->minor,
            'user_active'      => $request->user_active,
        ];

        // ada data prasyarat masuk ke subject
        if ($request->has('prasyarat')) {
            $subject['prasyarat'] = $request->prasyarat;
        }

        $url = CourseService::getInstance()->courseUrl($id);
        $response = putCurl($url, $subject, getHeaders());

        if (isset($response['success']) && $response['success']) {
            return redirect()->route('courses.index')
                ->with('success', 'Berhasil disimpan.');
        }
        return back()->with('error', 'Gagal disimpan.');
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
