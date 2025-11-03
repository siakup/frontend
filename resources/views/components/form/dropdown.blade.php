@props([
  'buttonId',
  'dropdownId',
  'label',
  'imgSrc',
  'dropdownItem',
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

<div 
  class="relative {{ $dropdownContainerClass }}" 
  x-data="{ 
    open: false, 
    value: '{{ $inputValue }}',
    label: '{{ $label }}',
    toggle() { this.open = ! this.open },
    setFalse() { this.open = false },
    onSelectedOption() {
      if({{ json_encode($isOptionRedirectableToURLQueryParameter) }}) {
        const params = new URLSearchParams(window.location.search);
        params.set({{ json_encode($queryParameter) }}, encodeURIComponent(this.value));
        window.location.href = {{ json_encode($url) }} + '?' + params.toString();
      }
    }
  }"
  x-modelable="value"
  x-model="{{$attributes->get('x-model')}}"
  x-on:click.outside="setFalse"
>
    <button 
      class="flex items-center gap-2 py-2 px-4 bg-transparent border-[1px] border-[#E62129] cursor-pointer text-[#E62129] transition-all duration-200 rounded-lg hover:bg-[#FBE8E6] {{ $buttonStyleClass }}"
      id="{{$buttonId}}"
      x-on:click="toggle"
      type="button"
    >
        <x-typography :variant="'body-small-regular'" x-text="label"></x-typography>
        <img 
          src="{{ $imgSrc }}" 
          alt="Filter" 
          class="transition-all duration-200"
          :class="{ '-rotate-180': open && {{ json_encode($isIconCanRotate) }} }"
        >
    </button>
    <div 
      id="{{ $dropdownId }}" 
      class="absolute top-[100%] bg-white border-[1px] border-[#DDD] rounded-md flex flex-col items-start max-h-[200px] overflow-y-auto w-max z-10 {{ $optionStyleClass }}" 
      x-show.important="open"
      x-transition
      x-data="{
        options: {{ json_encode($dropdownItem) }}
      }"
    >
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
    </div>
    @if($isUsedForInputField)
      <input type="hidden" name="{{$inputFieldName}}" x-model="value">
    @endif
</div>  