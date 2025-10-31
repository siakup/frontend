<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateBulkEventAcademicRequest extends FormRequest
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
      if ($this->has('data')) {
          $transformed = collect($this->data)->map(function ($item) {
            return [
              'nama_event' => $item['nama'] ?? null,
              'nilai_on' => strtolower($item['event nilai']) === 'y',
              'irs_on' => strtolower($item['event irs']) === 'y',
              'lulus_on' => strtolower($item['event kelulusan']) === 'y',
              'registrasi_on' => strtolower($item['event registrasi']) === 'y',
              'yudisium_on' => strtolower($item['event yudisium']) === 'y',
              'survei_on' => strtolower($item['event survei']) === 'y',
              'dosen_on' => strtolower($item['event dosen']) === 'y',
              'status' => strtolower($item['status']),
              'created_by' => session('username'),
            ];
          })->toArray();

          $this->replace(['data' => $transformed]);
      }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
      return [
        'data' => ['required', 'array', 'min:1'],
        'data.*.nama_event' => ['required'],
        'data.*.nilai_on' => ['required', 'boolean'],
        'data.*.irs_on' => ['required', 'boolean'],
        'data.*.lulus_on' => ['required', 'boolean'],
        'data.*.registrasi_on' => ['required', 'boolean'],
        'data.*.yudisium_on' => ['required', 'boolean'],
        'data.*.survei_on' => ['required', 'boolean'],
        'data.*.dosen_on' => ['required', 'boolean'],
        'data.*.status' => ['required', 'in:active,inactive']
      ];
    }

    protected function failedValidation(Validator $validator) {
      throw new HttpResponseException(
        back()->withErrors([
          'error' => 'Data tidak valid. Mohon periksa kembali format dan isi file yang diunggah'
        ])->withInput()
      );
    }
}
