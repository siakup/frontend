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

use Exception;
use Svg\Tag\Rect;

class CalendarController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
      $program_perkuliahan = $request->input('program_perkuliahan', 'reguler');
      $program_studi = $request->input('program_studi', 'ilmu komputer');

      $data = [
        [
          'id' => 1,
          'periode_akademik' => '2025-1',
          'semester' => 'Ganjil',
          'tanggal_mulai' => "2025-07-02 00:02:00+07",
          'tanggal_akhir' => "2026-01-02 23:59:00+07",
        ]
      ];

      $month = [
          1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
          'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
      ];

      $params = compact('program_perkuliahan', 'program_studi');

      return view('academics.calendar.index', get_defined_vars());
    }

    public function show(Request $request, $id)
    {
      $data = [
        [
          'id' => 1,
          'name_event' => "Masa Pembayaran Cicilan I",
          'tanggal_mulai' => "2025-03-04 00:05:00+07",
          'tanggal_selesai' => "2026-07-04 23:59:00+07",
        ]
      ];

      $month = [
          1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
          'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
      ];
      return view('academics.calendar.show', get_defined_vars());
    }

    public function store(Request $request, $id) 
    {
      return redirect()->route('calendar.show', ['id' => $id])->with('success', 'Berhasil disimpan');
    } 
    
    public function upload(Request $request, $id)
    {
      return view('academics.calendar.upload', get_defined_vars());
    }

    public function send(Request $request, $id) 
    {
      $data = [
        [
          'name_event' => "Masa Pembayaran Cicilan I",
          'tanggal_mulai' => "2025-03-04 00:05:00+07",
          'tanggal_selesai' => "2026-07-04 23:59:00+07",
        ],
        [
          'name_event' => "Masa Pembayaran Cicilan II",
          'tanggal_mulai' => "2025-03-04 00:05:00+07",
          'tanggal_selesai' => "2026-07-04 23:59:00+07",
        ]
      ];

      $month = [
          1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
          'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
      ];
      return view('academics.calendar.upload-result', get_defined_vars());
    } 
    
    public function save(Request $request, $id)
    {
      return redirect()->route('calendar.show', ['id' => $id])->with('success', 'Unggah Event Kalender Akademik telah berhasil');
    }

    public function edit(Request $request, $id)
    {
        return view('academics.calendar.edit', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        
    }

    public function delete(Request $request, $id)
    {
        return redirect()->back();
    }
}