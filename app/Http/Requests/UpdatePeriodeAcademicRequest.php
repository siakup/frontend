<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdatePeriodeAcademicRequest extends FormRequest
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
        $id = $this->route('id');

        $namaSemester = [
            1 => 'ganjil',
            2 => 'genap',
            3 => 'pendek',
        ];

        if (! array_key_exists((int) $this->semester, $namaSemester)) {
            throw ValidationException::withMessages([
                'semester' => 'Semester tidak valid.',
            ]);
        }

        $data = [
            'tahun' => (int) $this->tahun,
            'semester' => $namaSemester[(int) $this->semester],
            'tanggal_mulai' => Carbon::createFromFormat('d-m-Y, H:i', $this->tanggal_mulai)->format('Y-m-d H:i:s'),
            'tanggal_akhir' => Carbon::createFromFormat('d-m-Y, H:i', $this->tanggal_akhir)->format('Y-m-d H:i:s'),
            'tahun_akademik' => $this->tahun_akademik,
            'deskripsi' => $this->deskripsi,
            'status' => $this->status == 'true' ? 'active' : 'inactive',
            'update_at' => date('Y-m-d H:i:s'),
            'updated_by' => session('username'),
        ];

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
            'updated_by' => 'required',
        ];
    }
}
