@props([
  'variant' => 'red',
  'buttonId' => '',
  'dropdownId' => '',
  'label',
  'dropdownItem' => null,
  'buttonStyleClass' => '',
  'dropdownContainerClass' => '',
  'optionStyleClass' => '',
  'isIconCanRotate' => true,
  'isOptionRedirectableToURLQueryParameter' => false,
  'queryParameter' => '',
  'url' => '',
  'isUsedForInputField' => false,
  'inputFieldName' => '',
  'inputValue' => ''
])

@php
  $arrows = [
    'red' => 'red',
    'gray' => 'grey',
  ];

  $arrow = $arrows[$variant] ?? $arrows['red'];
  $buttonClass = "dropdown-$variant dropdown-button $buttonStyleClass"
@endphp

<div 
  class="relative {{ $dropdownContainerClass }}" 
  x-data="{ 
    open: false, 
    value: '{{ $inputValue }}',
    label: '{{ $label }}',
    toggle() { this.open = ! this.open },
    setFalse() { this.open = false },
    options: @js($dropdownItem),
    init () {
      this.$watch('value', (val) => {
          if (val === '') {
            this.label = '{{ $label }}';
          }
      });
    },
    onSelectedOption() {
      if({{ json_encode($isOptionRedirectableToURLQueryParameter) }}) {
        const params = new URLSearchParams(window.location.search);
        params.set({{ json_encode($queryParameter) }}, encodeURIComponent(this.value));
        window.location.href = {{ json_encode($url) }} + '?' + params.toString();
      }
    },
  }"
  x-modelable="value"
  x-model="{{$attributes->whereStartsWith('x-model')->first()}}"
  x-on:click.outside="setFalse"
>
    <button 
      class="{{ $buttonClass }}"
      id="{{$buttonId}}"
      x-on:click="toggle"
      type="button"
    >
        <x-typography :variant="'body-small-regular'" x-text="value == '' ? label : Object.entries(options).filter(([key, val]) => val == value).map(([key]) => key)[0]"></x-typography>
        <img 
          src="{{ asset("assets/icons/arrow-down/$arrow-24.svg") }}"
          alt="Filter" 
          class="transition-all duration-200"
          :class="{ '-rotate-180': open && {{ json_encode($isIconCanRotate) }} }"
        >
    </button>
    <div 
      class="dropdown-option dropdown-option-{{ $variant }} {{ $optionStyleClass }}" 
      id="{{ $dropdownId }}" 
      @if($attributes->has('x-data') || $attributes->has('x-init'))
        x-data="{{ $attributes->get('x-data') }}"
        x-init="{{ $attributes->get('x-init') }}"
      @else
        x-data="{
          options: @js($dropdownItem),
        }"
      @endif
      x-show.important="open"
      x-transition
      @if($attributes->has('x-init'))
        x-init="{{ $attributes->get('x-init') }}"
      @endif
    >
      <template x-if="options !== null">
        <template x-for="(option, key) in options">
          <div 
            class="dropdown-option-item" 
            x-on:click="
              value = option; 
              label = key;
              onSelectedOption();
              {{ $attributes->has('onclick') ? str_replace('"', '\"', $attributes->get('onclick')) : '' }};
              setFalse();
            "
            x-text="key"
          >
          </div>
        </template>
      </template>
    </div>
    @if($isUsedForInputField)
      <input type="hidden" name="{{$inputFieldName}}" x-model="value">
    @endif
</div>  