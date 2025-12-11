<?php

namespace App\View\Components\Dropdown;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;

class PeriodeAkademik extends Component
{
    /**
     * Create a new component instance.
     */
    public $options;

    public function __construct()
    {
        // fetch
        $response = Http::get('http://127.0.0.1:8004/api/period/list')->json();

        $items = $response['data'] ?? [];

        $cleaned = [];

        foreach ($items as $item) {
            // Tentukan label semester
            switch ($item['semester']) {
                case 1:
                    $semesterLabel = 'Ganjil';
                    break;
                case 2:
                    $semesterLabel = 'Genap';
                    break;
                case 3:
                    $semesterLabel = 'Pendek';
                    break;
                default:
                    $semesterLabel = 'Semester ' . $item['semester'];
            }

            // Gabungkan ke dalam label
            $label = $item['tahun'] . ' - ' . $semesterLabel;

            // Format final
            $cleaned[$label] = $item['id'];
        }

        // Simpan ke komponen
        $this->options = $cleaned;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dropdown.periode-akademik');
    }
}
