<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventAcademicRequest extends FormRequest
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
      $flags = [
        'nilai_on' => in_array('nilai_on', $this->flag ?? []),
        'irs_on' => in_array('irs_on', $this->flag ?? []),
        'lulus_on' => in_array('lulus_on', $this->flag ?? []),
        'registrasi_on' => in_array('registrasi_on', $this->flag ?? []),
        'yudisium_on' => in_array('yudisium_on', $this->flag ?? []),
        'survei_on' => in_array('survei_on', $this->flag ?? []),
        'dosen_on' => in_array('dosen_on', $this->flag ?? []),
      ];

      $data = [
        'nama_event' => $this->name,
        'status' => $this->status == "true" ? 'active' : 'inactive',
        'flags' => $flags,
        'created_by' => session('username'),
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
        'nama_event' => 'required|string|max:255',
        'flags' => 'array',
        'status' => 'required|string|in:active,inactive',
      ];
    }
}
