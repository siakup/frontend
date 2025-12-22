<?php

namespace App\View\Components\Dropdown;

use App\Endpoint\MajorService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Major extends Component
{
    /**
     * Create a new component instance.
     */
    public $options;

    public function __construct()
    {
        $url = MajorService::getInstance()->getList();
        $response = getCurl($url, null, getHeaders());

        $items = $response->data ?? [];

        $data = [];

        foreach ($items as $item) {
            $data[$item->nama_institusi] = $item->id_institusi;
        }

        $this->options = $data;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dropdown.major');
    }
}
