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

class TutelageController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        return view('tutelage.index', get_defined_vars());
    }

    public function create(Request $request)
    {
        return view('', get_defined_vars());
    }

    public function store(Request $request)
    {

    }

    public function showKrs(Request $request, $id)
    {
        return view('tutelage.student-list.detail-krs', get_defined_vars());
    }

    public function showStudentData(Request $request, $id)
    {
        $academicNotes = [
            [
                'term' => '2021 / 1', 'ips' => '3.39', 'ipk' => '3.39',
                'sks_diambil' => 18, 'sks_diperoleh' => 18,
                'detail' => [
                    ['mk'=>'Pancasila','kelas'=>'GL8 2022','nilai'=>'A-'],
                    ['mk'=>'Kewarganegaraan','kelas'=>'CS8 2022','nilai'=>'B+'],
                    ['mk'=>'Rekayasa Perangkat Lunak','kelas'=>'CS4 2022','nilai'=>'B+'],
                    ['mk'=>'Komputasi Paralel','kelas'=>'CS4 2022','nilai'=>'A'],
                ]
            ],
            [
                'term' => '2021 / 2', 'ips' => '3.31', 'ipk' => '3.35',
                'sks_diambil' => 18, 'sks_diperoleh' => 36,
                'detail' => [
                    ['mk'=>'Jaringan Komputer','kelas'=>'CS4 2022','nilai'=>'B'],
                    ['mk'=>'Kecerdasan Artifisial','kelas'=>'CS4A 2022','nilai'=>'B+'],
                ]
            ],
            [
                'term' => '2022 / 1', 'ips' => '3.57', 'ipk' => '3.43',
                'sks_diambil' => 21, 'sks_diperoleh' => 57,
                'detail' => []
            ],
        ];

        return view('tutelage.student-list.detail-student-data', get_defined_vars());
    }

    public function showTranskripResmi (Request $request, $id)
    {

        return view('tutelage.student-list.detail-transkrip-resmi', get_defined_vars());
    }
    public function showTranskripHistoris (Request $request, $id)
    {

        return view('tutelage.student-list.detail-transkrip-historis', get_defined_vars());
    }


    public function edit(Request $request, $id)
    {
        return view('students.show', get_defined_vars());
    }

    public function update(Request $request, $id)
    {

    }

    public function delete(Request $request, $id)
    {
        return redirect()->back();
    }

}
