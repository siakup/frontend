<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComponentsDocumentationController extends Controller
{
    public function table(Request $request) {
      return view('components-documentation.table');
    }

    public function typography(Request $request) {
      return view('components-documentation.typography');
    }
}
