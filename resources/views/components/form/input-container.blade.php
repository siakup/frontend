@props(['containerClass' => '', 'labelClass' => '', 'inputClass' => '', 'labelWrap' => false, 'fullWidth' => true, 'half' => false])

@php
  if($fullWidth) {
    $labelWidth = 'col-start-1 col-end-2';
    $inputWidth = 'col-start-3 col-end-10';
  } elseif(!$fullWidth && $half){
    $labelWidth = 'col-start-1 col-end-5';
    $inputWidth = 'col-start-5 col-end-10';
    $labelClass = 'justify-center w-full';
  }
  else {
    $labelWidth = 'col-start-1 col-end-3';
    $inputWidth = 'col-start-5 col-end-10';
  };
@endphp

<x-container.wrapper cols="9" items="center" justify="center" width="full"
    class="{{ $containerClass }}">

    <x-container.container width="full" class="items-center {{ $labelWidth }}">
        <label
            {{ $attributes->merge([
                'class' =>
                    'text-gray-800 text-sm font-semibold flex items-center ' . ($labelWrap ? '' : 'flex-shrink-0') . " $labelClass",
            ]) }}
            for="{{ $attributes->get('for') }}">
            {{ $label }}
        </label>
    </x-container.container>

    <x-container.container height="max" class="{{ $inputWidth }} items-center {{ $inputClass }}">
        {{ $input }}
    </x-container.container>

</x-container.wrapper>
