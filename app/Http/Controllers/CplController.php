<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Endpoint\CplService;

use App\Traits\ApiResponse;

class CplController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $search = $request->input('search');
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);

        $user = $request->user();
        $idProgramStudi = $request->input('id_program_studi') ?? $user?->id_program_studi;

        $params = [
            'search' => $search,
            'page' => $page,
            'limit' => $limit,
            'id_program_studi' => $idProgramStudi,
        ];

        $url = CplService::getInstance()->url();
        $response = getCurl($url, $params, getHeaders());
        $data = json_decode(json_encode($response), true);

        if ($request->ajax()) {
            if (!isset($response->data)) {
                return $this->errorResponse($response->message);
            }

            return $this->successResponse($response->data ?? [], 'Berhasil mendapatkan data');
        }


        return view('cpl.index', get_defined_vars());
    }

    public function bulkStore(Request $request)
    {
        $data = $request->input('data', []);
        $cpl = [];

        foreach ($data as $cplData) {
            $cpl[] = [
                'kode_matakuliah' => $cplData['kode_matakuliah'],
                'kode_cpl'        => $cplData['kode_cpl'] ?? [],
                'bobot'           => $cplData['bobot'],
                'created_by'      => session('username'),
            ];
        }

        $cpl = ['cpl' => $cpl];

        $url = CplService::getInstance()->bulkStore();
        $response = postCurl($url, $cpl, getHeaders());

        return $this->successResponse($response, 'Berhasil menyimpan data CPL');
    }
}
