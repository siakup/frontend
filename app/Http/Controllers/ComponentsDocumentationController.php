<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDO;

class ComponentsDocumentationController extends Controller
{
    public function table(Request $request)
    {
        return view('components-documentation.table');
    }

    public function tooltip(Request $request)
    {
        return view('components-documentation.tooltip');
    }

    public function badge(Request $request)
    {
        return view('components-documentation.badge');
    }

    public function dialog(Request $request)
    {
        return view('components-documentation.dialog');
    }

    public function typography(Request $request)
    {
        return view('components-documentation.typography');
    }

    public function button(Request $request)
    {
        return view('components-documentation.button');
    }

    public function cardMataKuliah(Request $request)
    {
        return view('components-documentation.card-mata-kuliah');
    }

    public function cardJadwalKuliah(Request $request)
    {
        $data1 = [
            'mataKuliah' => 'Proyek Multi Disiplin',
            'kode' => 'CS7',
            'periode' => '2024',
            'kodeRuangan' => '2705',
            'date' => 'Senin, 17 Juli',
            'startTime' => '10.00',
            'endTime' => '11.40',
        ];

        $data2 = [
            'mataKuliah' => 'Basis Data',
            'kode' => 'CS7',
            'periode' => '2024',
            'kodeRuangan' => '2705',
            'date' => 'Senin, 17 Juli',
            'startTime' => '10.00',
            'endTime' => '11.40',
        ];

        return view('components-documentation.card-jadwal-kuliah', get_defined_vars());
    }
    public function quantity(Request $request)
    {
        return view('components-documentation.quantity');
    }

    public function breadcrumb(Request $request)
    {
        return view('components-documentation.breadcrumb');
    }

    public function tab(Request $request)
    {
        return view('components-documentation.tab');
    }

    public function input(Request $request)
    {
        return view('components-documentation.input');
    }

    public function checkbox(Request $request)
    {
        return view('components-documentation.checkbox');
    }

    public function file(Request $request)
    {
        return view('components-documentation.file');
    }

    public function modal(Request $request)
    {
        return view('components-documentation.modal');
    }
}
