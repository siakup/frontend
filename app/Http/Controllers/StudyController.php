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

class StudyController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
      return view('study.index', get_defined_vars());
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