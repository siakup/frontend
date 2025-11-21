<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        return view('roles.index', get_defined_vars());
    }

    public function create(Request $request)
    {
        return view('', get_defined_vars());
    }

    public function store(Request $request) {}

    public function show(Request $request, $id)
    {
        return view('roles.show', get_defined_vars());
    }

    public function edit(Request $request, $id)
    {
        return view('edit.show', get_defined_vars());
    }

    public function update(Request $request, $id) {}

    public function delete(Request $request, $id)
    {
        return redirect()->back();
    }
}
