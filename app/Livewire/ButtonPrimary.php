<?php

namespace App\Livewire;

use Livewire\Component;

class ButtonPrimary extends Component
{
    public string $icon;
    public string $iconPosition;
    public string $type;
    public string $label;

    public function mount(
        string $icon = '',
        string $iconPosition = 'left',
        string $type = 'button',
        string $label = ''
    ) {
        $this->icon = $icon;
        $this->iconPosition = $iconPosition;
        $this->type = $type;
        $this->label = $label;
    }

    public function render()
    {
        return view('livewire.button-primary');
    }
}
