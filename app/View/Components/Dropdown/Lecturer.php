<?php

namespace App\View\Components\Dropdown;

use App\Endpoint\LecturerService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Lecturer extends Component
{
    /**
     * Create a new component instance.
     */
    public $options;

    public function __construct()
    {
        $url = LecturerService::getInstance()->getLecturer();
        $response = getCurl($url, null, getHeaders());

        $items = $response->data->data ?? [];

        $data = [];

        foreach ($items as $item) {
            $data[$item->nama] = $item->id;
        }

        $this->options = $data;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dropdown.lecturer');
    }
}
