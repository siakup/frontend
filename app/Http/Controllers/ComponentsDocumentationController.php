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

    public function card(Request $request)
    {
        return view('components-documentation.card');
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

    public function toast(Request $request)
    {
        return view('components-documentation.toast');
    }

    public function calendar(Request $request)
    {
        return view('components-documentation.calendar');
    }

    public function sort(Request $request)
    {
        return view('components-documentation.sort');
    }

    public function dropdown(Request $request)
    {
        return view('components-documentation.dropdown');
    }

    public function accordion(Request $request)
    {
        return view('components-documentation.accordion');
    }

    public function indicator(Request $request)
    {
        return view('components-documentation.indicator');
    }
}
