<?php

namespace App\View\Components\Dropdown;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TahunMasuk extends Component
{
    /**
     * Create a new component instance.
     */
    public $options;

    public function __construct()
    {
        $data = [
            '2019' => 2019,
            '2020' => 2020,
            '2021' => 2021,
            '2022' => 2022,
            '2023' => 2023,
            '2024' => 2024,
            '2025' => 2025,
        ];

        $this->options = $data;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dropdown.tahun-masuk');
    }
}
