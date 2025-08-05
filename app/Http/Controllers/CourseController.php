<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index()
    {
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {

        return redirect()->route('courses.index')->with('success', 'Course berhasil ditambahkan.');
    }

    public function show($id)
    {
        return view('courses.show', compact('course'));
    }

    public function edit($id)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {

        return redirect()->route('courses.index')->with('success', 'Course berhasil diperbarui.');
    }

    public function delete($id)
    {

        return redirect()->route('courses.index')->with('success', 'Course berhasil dihapus.');
    }

    public function getAllKurikulum(Request $request) {}
}
