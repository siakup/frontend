<?php

namespace App\Http\Requests;

use DateTime;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCalendarAcademicRequest extends FormRequest
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
        $id = $this->route('id');

        $data['id_periode'] = $id;
        $data['id_event'] = $data['name_event'] ?? null;

        $data['tanggal_awal'] = ! empty($data['tanggal_mulai'])
        ? DateTime::createFromFormat('d-m-Y, H:i', $data['tanggal_mulai'])->format('Y-m-d H:i:s')
        : null;

        $data['tanggal_akhir'] = ! empty($data['tanggal_selesai'])
        ? DateTime::createFromFormat('d-m-Y, H:i', $data['tanggal_selesai'])->format('Y-m-d H:i:s')
        : null;

        unset($data['name_event'], $data['tanggal_mulai'], $data['tanggal_selesai']);
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
            'id_event' => 'required',
            'status' => 'required',
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required',
            'id_calendar' => 'required',
            'id_periode' => 'required',
        ];
    }
}
