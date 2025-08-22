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

    public function index(Request $request)
    {
        $search = $request()->input('search');
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);
        $idJenisMataKuliah   = $request->input('idJenisMataKuliah');

        $params = [
            'search' => $search,
            'page' => $page,
            'limit' => $limit,
            'idJenisMataKuliah'  => $idJenisMataKuliah,
        ];

        $url = CourseService::getInstance()->url();
        $response = getCurl($url, $params, getHeaders());
        $data = json_decode(json_encode($response), true);

        if ($request->ajax()) {
            if (!isset($response->data)) {
                return $this->errorResponse($response->message);
            }
            return $this->successResponse($response->data ?? [], 'Berhasil mendapatkan data');
        }

        return view('courses.index',  get_defined_vars());
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {

        // Simulasi data dummy
        // $dummyData = [
        //     "kode_matakuliah" => "IF101",
        //     "nama_matakuliah_id" => "Algoritma dan Pemrograman",
        //     "nama_matakuliah_en" => "Algorithm and Programming",
        //     "nama_singkat" => "A0010",
        //     "id_prodi" => 1,
        //     "sks" => 3,
        //     "semester" => 1,
        //     "deskripsi" => "Mata kuliah dasar pemrograman komputer",
        //     "daftar_pustaka" => "Intro to Algorithms, Programming in C",
        //     "id_jenis" => 1,
        //     "id_koordinator" => 5,
        //     "matakuliah_spesial" => true,
        //     "prodi_lain" => false,
        //     "matakuliah_wajib" => true,
        //     "kampus_merdeka" => false,
        //     "matakuliah_capstone" => false,
        //     "matakuliah_kerja_praktik" => false,
        //     "matakuliah_tugas_akhir" => false,
        //     "matakuliah_minor" => false,
        //     "status" => "active",
        //     "created_by" => 'admin',
        //     "updated_by" => 'admin',
        //     "prasyarat" => ["IF100", "MT101"],
        //     "tipe" => "Co-Requisite",
        // ];

        // $request->replace($dummyData);

        $validated = $request->validate([
            'kode_matakuliah'       => 'required',
            'nama_matakuliah_id'    => 'required',
            'sks'                   => 'required|numeric',
            'id_prodi'              => 'required|numeric',
            'nama_singkat'          => 'required|string|max:5',
        ], [
            'kode_matakuliah.required'      => "Kode Mata Kuliah wajib diisi",
            'nama_matakuliah_id.required'   => "Nama matakuliah wajib diisi",
            'sks.required'                  => "Sks wajib diisi",
            'id_prodi.required'             => "Program Studi wajib diisi",
            'nama_singkat.required'         => "Nama singkat wajib diisi dan maksimal 5 karakter",
        ]);

        $data = [
            'kode_matakuliah'       => $validated['kode_matakuliah'],
            'nama_matakuliah_id'    => $validated['nama_matakuliah_id'],
            'nama_matakuliah_en'    => $request->input('nama_matakuliah_en'),
            'nama_singkat'          => $request->input('nama_singkat'),
            'id_prodi'              => $validated['id_prodi'],
            'sks'                   => $validated['sks'],
            'semester'              => $request->input('semester'),
            'deskripsi'             => $request->input('deskripsi'),
            'daftar_pustaka'        => $request->input('daftar_pustaka'),
            'id_jenis'              => $request->input('id_jenis'),
            'id_koordinator'        => $request->input('id_koordinator'),
            'matakuliah_spesial'    => $request->boolean('matakuliah_spesial'),
            'prodi_lain'            => $request->boolean('prodi_lain'),
            'matakuliah_wajib'      => $request->boolean('matakuliah_wajib'),
            'kampus_merdeka'        => $request->boolean('kampus_merdeka'),
            'matakuliah_capstone'   => $request->boolean('matakuliah_capstone'),
            'matakuliah_kerja_praktik' => $request->boolean('matakuliah_kerja_praktik'),
            'matakuliah_tugas_akhir' => $request->boolean('matakuliah_tugas_akhir'),
            'matakuliah_minor'      => $request->boolean('matakuliah_minor'),
            'status'                => $request->input('status', 'active'),
            'prasyarat'            => $request->input('prasyarat', []),
            "tipe"                 => $request->input('tipe'),
        ];

        $url = CourseService::getInstance()->url();
        $response = postCurl($url, $data, getHeaders());

        if ($request->ajax()) {
            if (isset($response->success) && $response->success) {
                return $this->successResponse($response->data, 'Mata kuliah berhasil ditambahkan.');
            }
            return response()->json([
                'status' => 'error',
                'message' => $response->message ?? 'Gagal menambahkan mata kuliah'
            ], 400);
        }
        return redirect()->back()->with('success', 'Mata kuliah berhasil ditambahkan.');
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
        $url = CourseService::getInstance()->courseUrl($id);
        $response = deleteCurl($url, getHeaders());

        if (isset($response['status']) && $response['status'] == 'success') {
            return response()->json([
                'status' => 'success',
                'message' => 'Mata kuliah berhasil dihapus'
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => $response['message'] ?? 'Gagal menghapus mata kuliah'
        ], 400);
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

    public function bulkStore(Request $request)
    {
        $data = $request->input('data', []);

        $matakuliah = [];

        foreach ($data as $row) {
            if (count($row) < 20) {
                continue;
            }
            $matakuliah[] = [
                'kode'          => $row[0],
                'nama'          => $row[1],
                'namasingkat'   => $row[2],
                'sks'           => intval($row[3]),
                'semester'      => intval($row[4]),
                'tujuan'        => $row[5],
                'deskripsi'     => $row[6],
                'daftar_pustaka' => $row[7],
                'jenis'         => strtolower($row[8]), //id jenis matakuliah
                'prodi'         => strtolower($row[9]), //id prodi
                'koordinator'   => strtolower($row[10]), //id koordinator matakuliah

                // Kolom pilihan 
                'spesial'       => strtolower($row[11]),
                'dibuka'        => strtolower($row[12]),
                'wajib'         => strtolower($row[13]),
                'mbkm'          => strtolower($row[14]),
                'capstone'      => strtolower($row[15]),
                'kp'            => strtolower($row[16]),
                'ta'            => strtolower($row[17]),
                'minor'         => strtolower($row[18]),

                //mk prasyarat
                'prasyarat' => array_filter(array_map('trim', explode(',', $row[19]))),

                'status'        => 'active',
                'created_by'    => session('username'),
                'updated_by'    => session('username'),
            ];
        }

        $url = CourseService::getInstance()->bulkStore();
        $response = postCurl($url, ['data' => $matakuliah], getHeaders());
        return $this->successResponse($response, 'Berhasil menyimpan data mata kuliah');
    }
}
