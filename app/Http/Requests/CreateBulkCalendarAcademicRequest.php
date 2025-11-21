<?php

namespace App\Http\Requests;

use App\Endpoint\EventAcademicService;
use App\Endpoint\EventCalendarService;
use Illuminate\Foundation\Http\FormRequest;

class CreateBulkCalendarAcademicRequest extends FormRequest
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
        $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
        $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
        $programStudiList = $responseProgramStudiList->data;

        $url = EventAcademicService::getInstance()->baseEventURL();
        $responseEvent = getCurl($url, null, getHeaders());
        $eventAkademik = $responseEvent->data;

        if ($this->has('data')) {
            $transformed = collect($this->data)->map(function ($item) use ($id, $programStudiList, $eventAkademik) {
                $prodi = current(array_filter(
                    $programStudiList,
                    function ($program) use ($item) {
                        return $item['program_studi'] == $program->nama;
                    }
                ));

                $event = current(array_filter(
                    $eventAkademik,
                    function ($ev) use ($item) {
                        return $item['name_event'] == $ev->nama_event;
                    }
                ));

                return [
                    'id_program' => $item['program_perkuliahan'] ?? null,
                    'id_prodi' => $prodi ? $prodi->id : null,
                    'id_event' => $event ? $event->id : null,
                    'id_periode' => (int) $id,
                    'tanggal_awal' => $item['tanggal_mulai'] ?? null,
                    'tanggal_akhir' => $item['tanggal_selesai'] ?? null,
                    'status' => 'active',
                    'created_by' => session('username'),
                ];
            })->toArray();

            $this->merge(['eventGlobalCalendar' => $transformed]);
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
            'eventGlobalCalendar' => ['required', 'array', 'min:1'],
            'eventGlobalCalendar.*.id_program' => ['required', 'string'],
            'eventGlobalCalendar.*.id_prodi' => ['required'],
            'eventGlobalCalendar.*.id_event' => ['required'],
            'eventGlobalCalendar.*.id_periode' => ['required'],
            'eventGlobalCalendar.*.tanggal_awal' => ['required'],
            'eventGlobalCalendar.*.tanggal_akhir' => ['required'],
            'eventGlobalCalendar.*.status' => ['required', 'in:active,inactive'],
        ];
    }
}
