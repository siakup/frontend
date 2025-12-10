@props([
    'buttonId' => '',
    'optionsId' => '',
    'options' => null,
    'type' => 'sort', // ada sort dan filter
    'value' => '',
])

@php
    $labelType = [
        'sort' => 'Urutkan',
        'filter' => 'Filter',
    ];

    $label = $labelType[$type] ?? 'Urutkan';
    $icon = "$type/red-20";
@endphp

<div class="relative w-fit" 
    x-data="{
        open: false,
        value: '{{ $value }}',
        label: '{{ $label }}',
        defaultLabel: '{{ $label }}',
        toggle() { this.open = !this.open },
        options: @js($options),
        setFalse() { this.open = false },
        init() {
            this.$watch('value', (val) => {
                if (val === '') {
                    this.label = this.defaultLabel;
                }
            });
        },
    }"
    x-modelable="value"
    x-model="{{ $attributes->get('x-model') }}"
    x-on:click.outside="setFalse"
>
    <x-button 
        x-on:click="toggle" 
        :variant="'secondary'" 
        :icon="$icon" 
        :iconPosition="'right'"
        :size="'lg'" 
        
    >
        <span x-text="label"></span>
    </x-button>
    <div 
        class="sort"
        style="display: none;"
        x-show.important="open" 
        x-transition 
    >
        <template x-if="options !== null">
            <template x-for="(option, key) in options">
                <div class="sort-option"
                    x-on:click="
                        value = option; 
                        label = key;
                        setFalse();
                    "
                    x-text="key">
                </div>
            </template>
        </template>
    </div>
</div>