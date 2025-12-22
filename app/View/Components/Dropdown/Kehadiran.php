<?php

namespace App\View\Components\Dropdown;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Kehadiran extends Component
{
    /**
     * Create a new component instance.
     */
    public $options;

    public function __construct()
    {
        $data = [
            'Alpa' => 'alpa',
            'Hadir' => 'hadir',
            'Izin' => 'izin',
        ];

        $this->options = $data;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dropdown.kehadiran');
    }
}
