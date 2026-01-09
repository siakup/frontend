<?php

namespace App\View\Components\Dropdown;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Endpoint\EventAcademicService;

class EventPerwalian extends Component
{
    /**
     * Create a new component instance.
     */

    public $options;

    public function __construct()
    {
        $url = EventAcademicService::getInstance()->getListAllEvents();
        $response = getCurl($url, null, getHeaders());

        $items = $response->data ?? [];

        $data = [];

        foreach ($items as $item) {
            $data[$item->nama_event] = $item->id;
        }

        $this->options = $data;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dropdown.event-perwalian');
    }
}
