<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


use App\Traits\ApiResponse;
use App\Endpoint\EventCalendarService;

use Exception;
use Svg\Tag\Rect;

class CurriculumController extends Controller
{
    use ApiResponse;

    public function curriculumList(Request $request) 
    {
      $urlProgramPerkuliahan = EventCalendarService::getInstance()->getListUniversityProgram();
      $responseProgramPerkuliahanList = getCurl($urlProgramPerkuliahan, null, getHeaders());
      $programPerkuliahanList = $responseProgramPerkuliahanList->data;
      $id_program = $request->input('program_perkuliahan');

      $data = [
        [
          'nama' => 'Kurikulum 2025 - Teknik Kimia - DD',
          'program_perkuliahan' => 'Double Degree',
          'deskripsi' => 'Kurikulum 2025 - Double Degree',
          'total_sks' => 155,
          'status' => 'active',
        ],
        [
          'nama' => 'Kurikulum 2025 - Teknik Kimia - Int',
          'program_perkuliahan' => 'International',
          'deskripsi' => 'Kurikulum 2025 - International',
          'total_sks' => 141,
          'status' => 'active',
        ],
        [
          'nama' => 'Kurikulum 2025 - Teknik Kimia - R',
          'program_perkuliahan' => 'Reguler',
          'deskripsi' => 'Kurikulum 2020 - Reguler',
          'total_sks' => 144,
          'status' => 'inactive',
        ],
        [
          'nama' => 'Kurikulum 2025 - Teknik Kimia - K',
          'program_perkuliahan' => 'Karyawan',
          'deskripsi' => 'Kurikulum 2020 - Karyawan',
          'total_sks' => 95,
          'status' => 'inactive',
        ],
      ];
      return view('curriculums.list.index', get_defined_vars());
    }

    public function index(Request $request)
    {
      return view('study.index', get_defined_vars());
    }

    public function create(Request $request)
    {
      return view('study.create', get_defined_vars());
    }

    public function edit(Request $request, $id)
    {
      return view('study.edit', get_defined_vars());
    }

    public function view(Request $request, $id)
    {
      return view('study.view', get_defined_vars());
    }

    public function store(Request $request, $id) 
    {
      return redirect()->route('calendar.show', ['id' => $id])->with('success', 'Berhasil disimpan');
    }

    public function send(Request $request, $id) 
    {
      return redirect()->route('calendar.show', ['id' => $id])->with('success', 'Unggah Event Kalender Akademik telah berhasil');
    }

    public function update(Request $request, $id)
    {
        
    }

    public function delete(Request $request, $id)
    {
        return redirect()->back();
    }
}