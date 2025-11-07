@props([
  'variant' => 'red',
  'buttonId' => '',
  'dropdownId' => '',
  'label',
  'imgSrc',
  'dropdownItem' => null,
  'buttonStyleClass' => '',
  'dropdownContainerClass' => '',
  'optionStyleClass' => '',
  'isIconCanRotate' => false,
  'isOptionRedirectableToURLQueryParameter' => false,
  'queryParameter' => '',
  'url' => '',
  'isUsedForInputField' => false,
  'inputFieldName' => '',
  'inputValue' => ''
])

@php
  $variants = [
    'red' => 'flex items-center gap-2 py-2 px-4 bg-transparent border-[1px] border-[#E62129] cursor-pointer text-[#E62129] transition-all duration-200 rounded-lg hover:bg-[#FBE8E6]',
    'gray' => 'flex items-center justify-between py-2 px-4 w-auto cursor-pointer border-[1px] border-[#BFBFBF] bg-[#FFFFFF] transition-all duration-200 rounded-lg'
  ];

  $selectedVariant = isset($variants[$variant]) ? $variants[$variant] : $variants['content'];
  $selectedClass = "{$selectedVariant} {$buttonStyleClass} ";

@endphp

<div 
  class="relative {{ $dropdownContainerClass }}" 
  x-data="{ 
    open: false, 
    value: '{{ $inputValue }}',
    label: '{{ $label }}',
    toggle() { this.open = ! this.open },
    setFalse() { this.open = false },
    options: {{ json_encode($dropdownItem) }},
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
      class="{{ $selectedClass }}"
      id="{{$buttonId}}"
      x-on:click="toggle"
      type="button"
    >
        <x-typography :variant="'body-small-regular'" x-text="value == '' ? label : Object.entries(options).filter(([key, val]) => val == value).map(([key]) => key)[0]"></x-typography>
        <img 
          src="{{ $imgSrc }}" 
          alt="Filter" 
          class="transition-all duration-200"
          :class="{ '-rotate-180': open && {{ json_encode($isIconCanRotate) }} }"
        >
    </button>
    <div 
      class="
      absolute top-[100%] bg-white border-[1px] border-[#DDD] rounded-md flex-col items-start max-h-[200px] overflow-y-auto z-10
      {{ $variant === 'gray' ? 'min-w-[240px] right-0' : 'w-max right-0' }}
      {{ $optionStyleClass }}
    " 
      id="{{ $dropdownId }}" 
      @if($attributes->has('x-data') && $attributes->has('x-init'))
        x-data="{{ $attributes->get('x-data') }}"
        x-init="{{ $attributes->get('x-init') }}"
      @else
        x-data="{
          options: {{ json_encode($dropdownItem) }},
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
            class="item px-3 py-2 cursor-pointer hover:bg-[#DDD] transition-[background] duration-200 flex justify-between items-center text-sm w-full" 
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