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

class CalendarController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
      $program_perkuliahan = $request->input('program_perkuliahan', 'reguler');
      $program_studi = $request->input('program_studi', 'ilmu komputer');

      $params = compact('program_perkuliahan', 'program_studi');

      return view('academics.calendar.index', get_defined_vars());
    }

    public function show(Request $request, $id)
    {
        return view('academics.calendar.show', get_defined_vars());
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