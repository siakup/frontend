<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StorePeriodeAcademicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $data = $this->all();

        $namaSemester = [
            1 => 'ganjil',
            2 => 'genap',
            3 => 'pendek',
        ];

        $data['status'] = $data['status'] == 'true' ? 'active' : 'inactive';
        $data['tahun'] = (int) $data['year'];
        $data['created_by'] = session('username');
        if (! array_key_exists((int) $data['semester'], $namaSemester)) {
            throw ValidationException::withMessages([
                'semester' => 'Semester tidak valid.',
            ]);
        }
        $data['semester'] = $namaSemester[(int) $data['semester']];

        unset($data['year']);
        $this->replace($data);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tahun' => 'required|integer',
            'semester' => 'required|string|in:ganjil,genap,pendek',
            'status' => 'required|string|in:active,inactive',
            'tahun_akademik' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_akhir' => 'required',
            'deskripsi' => 'required',
            'created_by' => 'required',
        ];
    }
}
