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
        $url = EventAcademicService::getInstance()->getListAllPeriode();
        $response = getCurl($url, $params, getHeaders());
        $data = json_decode(json_encode($response), true);

        if ($request->ajax()) {
            //pengecekan jika response tidak valid
            if (!isset($response->data)) {
                return $this->errorResponse($response->message);
            }
            
            return $this->successResponse($response->data ?? [], 'Berhasil mendapatkan data');
        }

        return view('academics.periode.index', get_defined_vars());
    }

    public function periodeDetail(Request $request)
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
            return view('academics.periode._modal-view', get_defined_vars())->render();
        }
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
        $url = EventAcademicService::getInstance()->eventUrl(1);
        $response = getCurl($url, null, getHeaders());
        $data = $response->data->event;

        if ($request->ajax()) {
          return view('academics.event._modal-view', get_defined_vars())->render();
        }
        return redirect()->route('academics-event.index');
    }

    public function eventEdit($id)
    {
        $url = EventAcademicService::getInstance()->eventUrl($id);
        $response = getCurl($url, null, getHeaders());
        $data = json_decode(json_encode($response), true)['data']['event'];
        // dd($data);

        return view('academics.event.edit', get_defined_vars());
    }

    public function eventUpdate(Request $request, $id) {
      $data = [
        'nama_event' => $request->nama_event,
        'nilai_on' => $request->nilai_on ? true : false,
        'irs_on' => $request->irs_on ? true : false,
        'lulus_on' => $request->lulus_on ? true : false,
        'registrasi_on' => $request->registrasi_on ? true : false,
        'yudisium_on' => $request->yudisium_on ? true : false,
        'survei_on' => $request->survei_on ? true : false,
        'dosen_on' => $request->dosen_on ? true : false,
        'status' => $request->status,
      ];
      $url = EventAcademicService::getInstance()->eventUrl($id);
      $response = putCurl($url, $data, getHeaders());
      
      return redirect()->route('academics-event.index')->with('success', 'Berhasil disimpan');
    }

    public function eventDelete($id) {
      $url = EventAcademicService::getInstance()->eventUrl($id);
      $response = deleteCurl($url, getHeaders());
      return $response;
    }

    public function eventCreate(Request $request)
    {
        return view('academics.event.create', get_defined_vars());
    }

    public function eventUpload(Request $request)
    {
        return view('academics.event.create', get_defined_vars());
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