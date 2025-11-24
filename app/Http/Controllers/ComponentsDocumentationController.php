<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    
    public function typography(Request $request) {
      return view('components-documentation.typography');
    }

    public function button(Request $request) {
      return view('components-documentation.button');
    }
}
