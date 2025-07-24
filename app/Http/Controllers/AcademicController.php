<?php
namespace App\Http\Controllers;

use App\Endpoint\EventAcademicService;
use App\Endpoint\PeriodAcademicService;
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
        $sort = $request->input('sort', 'active,desc');
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);

        $params = compact('search', 'sort', 'page', 'limit');

        $url = PeriodAcademicService::getInstance()->getListAllPeriode();
        $response = getCurl($url, $params, getHeaders());


        if ($request->ajax()) {
            return $this->successResponse($response->data ?? [], 'Berhasil mendapatkan data');
        }
        
        return view('academics.periode.index', [
            'data' => $response,
            'search' => $search,
            'sort' => $sort,
            'page' => $page,
            'limit' => $limit,
        ]);
    }



    public function periodeDetail(Request $request)
    {
        $nomor_induk = $request->input('nomor_induk');
        $url = EventAcademicService::getInstance()->getEventDetails();
        $response = getCurl($url, null, getHeaders());

        if ($request->ajax()) {
            return view('academics.periode._modal-view', get_defined_vars())->render();
        }
        return view('academics.periode.index', get_defined_vars());

        
    }

    public function createPeriode(Request $request)
    {
        return view('academics.periode.create', get_defined_vars());
    }

    public function periodeStore(Request $request) 
    {
      $validated = $request->validate([
          'year'   => 'required',
          'semester'   => 'required|string|in:ganjil,genap,pendek',
          'status' => 'required|string|in:active,inactive',
          'tahun_akademik' => 'required',
          'tanggal_mulai' => 'required',
          'tanggal_akhir' => 'required',
          'deskripsi' => 'required'
      ]);

      $data = [
          'tahun' => $validated['year'],
          'semester' => $validated['semester'],
          'tanggal_mulai' => $validated['tanggal_mulai'],
          'tanggal_akhir' => $validated['tanggal_akhir'],
          'deskripsi' => $validated['deskripsi'],
          'status'     => $validated['status'],
          'created_by' => session('username'),
      ];

      $url = PeriodAcademicService::getInstance()->store();
      $response = postCurl($url, $data, getHeaders());

      if ($request->ajax()) {
          if (isset($response->success) && $response->success) {
              return response()->json(['success' => true, 'message' => 'Berhasil disimpan']);
          }
          return response()->json(['success' => false, 'message' => $response->message ?? 'Gagal menyimpan data'], 422);
      }

      return redirect()->route('academics-periode.index')->with('success', 'Berhasil disimpan');
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

        $url = EventAcademicService::getInstance()->baseEventURL();
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
        $id = $request->input('id');
        $url = EventAcademicService::getInstance()->eventUrl($id);
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

        return view('academics.event.edit', get_defined_vars());
    }

    public function eventUpdate(Request $request, $id) {
      $request->validate([
        'nama_event' => 'required'
      ], [
        'nama_event.required' => "Mohon diisi Nama Event sebelum disimpan"
      ]);

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
        'updated_by' => session('username')
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
        return view('academics.event.upload', get_defined_vars());
    }

    public function eventStore(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'flag'   => 'array',
            'status' => 'required|string|in:active,inactive',
        ]);

        $flags = [
            'nilai_on'      => in_array('nilai_on', $request->flag ?? []),
            'irs_on'        => in_array('irs_on', $request->flag ?? []),
            'lulus_on'      => in_array('lulus_on', $request->flag ?? []),
            'registrasi_on' => in_array('registrasi_on', $request->flag ?? []),
            'yudisium_on'   => in_array('yudisium_on', $request->flag ?? []),
            'survei_on'     => in_array('survei_on', $request->flag ?? []),
            'dosen_on'      => in_array('dosen_on', $request->flag ?? []),
        ];

        $data = [
            'nama_event' => $validated['name'],
            'status'     => $validated['status'],
            'flags'      => $flags, 
            'created_by' => session('username'),
        ];

        $url = EventAcademicService::getInstance()->getListAllEvents();
        $response = postCurl($url, $data, getHeaders());

        if ($request->ajax()) {
            if (isset($response->success) && $response->success) {
                return response()->json(['success' => true, 'message' => 'Berhasil disimpan']);
            }
            return response()->json(['success' => false, 'message' => $response->message ?? 'Gagal menyimpan data'], 422);
        }

        return redirect()->route('academics-event.index')->with('success', 'Berhasil disimpan');
    }

    public function eventStoreUpload(Request $request)
    {
        return redirect()->route('academics-event.index')->with('success', 'Berhasil disimpan');
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