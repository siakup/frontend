@props([
  'containerClass' => '', 
  'labelClass' => '', 
  'inputClass' => '', 
  'labelWrap' => false, 
  'fullWidth' => true, 
  'half' => false,
])

@php
  if($fullWidth) {
    $labelWidth = 2;
    $inputWidth = 7;
    $gapWidth = 2;
  } else {
    $labelWidth = 2;
    $inputWidth = 5;
    $gapWidth = 2;
  };
  if($half){
    $labelWidth = 2;
    $inputWidth = 5;
    $gapWidth = 2;
  }
@endphp

<x-container.wrapper cols="9" items="center" justify="center"
    class="{{ $containerClass }}">

  <x-container.container col="{{ $gapWidth }}">
  </x-container.container>

  <x-container.container col="{{ $labelWidth }}">
    <label 
        {{ $attributes->merge([
            'class' => "text-gray-800 text-sm font-semibold flex items-center " 
                      . ($labelWrap ? '' : 'flex-shrink-0') 
                      . " $labelClass"
        ]) }}
        for="{{ $attributes->get('for') }}"
    >
        {{ $label }}
    </label>
  </x-container.container>

  <x-container.container col="{{ $gapWidth }}">
  </x-container.container>

  <x-container.container height="max" class="{{ $inputWidth }} items-center {{ $inputClass }}">
      {{ $input }}
  </x-container.container>

</x-container.wrapper>
