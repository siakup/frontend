<?php

namespace App\View\Components\Dropdown;

use App\Endpoint\CplService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Cpl extends Component
{
    /**
     * Create a new component instance.
     */

    public $options;

    public function __construct()
    {
        $urlCpl = CplService::getInstance()->getCpl();
        $responseCpl = getCurl($urlCpl, null, getHeaders());

        $items = $responseCpl->data ?? [];

        $data = [];

        foreach ($items as $item) {
            $data[$item->kode_cpl] = $item->id_cpl;
        }

        $this->options = $data;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dropdown.cpl');
    }
}
