<?php
namespace App\Http\Controllers;
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
        return view('lectures.index', get_defined_vars());
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
        return view('lectures.show', get_defined_vars());
    }

    public function edit(Request $request, $id)
    {
        return view('lectures.show', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        
    }

    public function delete(Request $request, $id)
    {
        return redirect()->back();
    }

}