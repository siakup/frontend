<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventAcademicRequest extends FormRequest
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
      $data = [
        'nama_event' => $this->nama_event,
        'nilai_on' => $this->nilai_on ? true : false,
        'irs_on' => $this->irs_on ? true : false,
        'lulus_on' => $this->lulus_on ? true : false,
        'registrasi_on' => $this->registrasi_on ? true : false,
        'yudisium_on' => $this->yudisium_on ? true : false,
        'survei_on' => $this->survei_on ? true : false,
        'dosen_on' => $this->dosen_on ? true : false,
        'status' => $this->status == "true" ? 'active' : 'inactive',
        'updated_by' => session('username')
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
        'nama_event' => 'required',
      ];
    }

    public function messages(): array
    {
      return [
        'nama_event.required' => "Mohon diisi Nama Event sebelum disimpan"
      ];
    }
}
