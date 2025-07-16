<?php
namespace App\Http\Controllers;

use App\Endpoint\EventAcademicService;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

use App\Traits\ApiResponse;

use Exception;

class AcademicController extends Controller
{
    use ApiResponse;

    public function indexPeriode(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort', 'nama,asc');
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);

        $params = [
            'search' => $search,
            'page' => $page,
            'sort' => $sort,
            'limit' => $limit,
        ];

        return view('academics.periode.index', get_defined_vars());
    }

    public function indexEvent(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort', 'nama,asc');
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);

        $params = [
            'search' => $search,
            'page' => $page,
            'sort' => $sort,
            'limit' => $limit,
        ];

        $url = EventAcademicService::getInstance()->getListAllEvents();
        $response = getCurl($url, $params, getHeaders());
        $data = json_decode(json_encode($response), true);

        if ($request->ajax()) {
            if (!isset($response->data)) {
                return $this->errorResponse($response->message);
            }
            return $this->successResponse($response->data ?? [], 'Berhasil mendapatkan data');
        }

        return view('academics.event.index', get_defined_vars());
    }

    public function eventDetail(Request $request)
    {
        $nomor_induk = $request->input('nomor_induk');
        $url = EventAcademicService::getInstance()->getEventDetails();
        $response = getCurl($url, null, getHeaders());

        if ($request->ajax()) {
            $data = [
              'name' => "Perkuliahan Semester Ganjil",
              'flag' => [
                'nilai' => true,
                'irs' => true,
                'lulus' => false,
                'registrasi' => false,
                'yudisium' => false,
                'survei' => false,
                'dosen' => false
              ],
              'status' => true
            ];
            return view('academics.event._modal-view', get_defined_vars())->render();
        }
        return view('users.view', get_defined_vars());
    }

    public function eventEdit($id)
    {
      $url = EventAcademicService::getInstance()->getEventDetails();
        $response = getCurl($url, null, getHeaders());

        $data = [
          'name' => "Perkuliahan Semester Ganjil",
          'flag' => [
            'nilai' => true,
            'irs' => true,
            'lulus' => false,
            'registrasi' => false,
            'yudisium' => false,
            'survei' => false,
            'dosen' => false
          ],
          'status' => true
        ];

        return view('academics.event.edit', get_defined_vars());
    }

    public function create(Request $request)
    {
        return view('', get_defined_vars());
    }

    public function store(Request $request)
    {
        
    }

    public function show(Request $request, $id)
    {
        return view('academics.show', get_defined_vars());
    }

    public function edit(Request $request, $id)
    {
        return view('academics.show', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        
    }

    public function delete(Request $request, $id)
    {
        return redirect()->back();
    }

}