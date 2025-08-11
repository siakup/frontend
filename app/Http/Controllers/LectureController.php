<?php

namespace App\Http\Controllers;

use App\Endpoint\LectureService;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

use App\Traits\ApiResponse;

use Exception;

class LectureController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $prodi = $request->input('prodi', 'teknik informatika');
        $search = $request->input('search');
        $sort = $request->input('sort', 'created_at,desc');
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);

        $params = compact('prodi', 'sort', 'page', 'limit');

        $url = LectureService::getInstance()->getMataKuliah();
        $response = getCurl($url, $params, getHeaders());

        if ($request->ajax()) {
            return $this->successResponse($response->data ?? [], 'Berhasil mendapatkan data');
        }

        return view('lectures.index', [
            'data' => $response,
            'search' => $search,
            'prodi' => $prodi,
            'sort' => $sort,
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    public function create(Request $request)
    {
        return view('', get_defined_vars());
    }

    public function store(Request $request) {}

    public function show(Request $request, $id)
    {
        return view('lectures.show', get_defined_vars());
    }

    public function edit(Request $request, $id)
    {
        return view('lectures.show', get_defined_vars());
    }

    public function update(Request $request, $id) {}

    public function delete(Request $request, $id)
    {
        return redirect()->back();
    }
}
