<?php

namespace App\View\Components\Dropdown;

use App\Endpoint\ProgramPerkuliahanService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProgramPerkuliahan extends Component
{
    /**
     * Create a new component instance.
     */
    public $options;

    public function __construct()
    {
        $urlProgram = ProgramPerkuliahanService::getInstance()->getPrograms();
        $responseProgram = getCurl($urlProgram, null, getHeaders());

        $items = $responseProgram->data ?? [];

        $data = [];

        foreach ($items as $item) {
            $data[$item->name] = $item->code;
        }

        $this->options = $data;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dropdown.program-perkuliahan');
    }
}
