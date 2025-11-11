@props([
  'value' => '',
  'name',
  'options',
  'class' => '',
])

@php
  $extraOnClick = $attributes->get('onchange');
@endphp

<script>
  function onChangeRadioButtonValue (element) {
    const radioElements = element.parentElement.parentElement.querySelectorAll("div");
    Array.from(radioElements).map(radioElement => {
      const label = radioElement.querySelector('label');
      const input = radioElement.querySelector('input');

      if(input !== element) {
        label.classList.add('text-[#8C8C8C]');
        label.classList.remove('text-[#262626]');
      } else {
        label.classList.add('text-[#262626]');
        label.classList.remove('text-[#8C8C8C]');
      }
    })
  }
</script>

<div class="flex flex-wrap gap-y-10 gap-x-8 w-full m-0 p-0 items-center box-border {{ $class }}">
  @foreach($options as $option)
    <div class="flex items-center gap-2">
      <input 
        type="radio" 
        id="{{ $option['value'] }}" 
        class="accent-[#E62129] rounded-sm" 
        value="{{ $option['value'] }}" 
        name="{{ $name }}"
        {{ $attributes->whereStartsWith('x-') }}
        onchange="onChangeRadioButtonValue(this); {{ $extraOnClick }}"
        @if($value == $option['value'])
          checked
        @endif
      />
      <label for="{{ $option['value'] }}" class="text-[#8C8C8C] ml-1">{{ $option['label'] }}</label>
    </div>
  @endforeach
</div>