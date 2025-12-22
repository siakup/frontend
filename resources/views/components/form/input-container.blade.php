@props(['containerClass' => '', 'labelClass' => '', 'inputClass' => '', 'labelWrap' => false, 'fullWidth' => true,])

@php
  if($fullWidth) {
    $labelWidth = 'col-start-1 col-end-2';
    $inputWidth = 'col-start-3 col-end-10';
  } else {
    $labelWidth = 'col-start-1 col-end-3';
    $inputWidth = 'col-start-5 col-end-10';
  };
@endphp

<x-container.wrapper :padding="'p-0'" :cols="9" :align="'center'" :justify="'center'"
    class="{{ $containerClass }}">

    <x-container.container class="col-start-1 col-end-2">
        <label
            {{ $attributes->merge([
                'class' =>
                    'text-gray-800 text-sm font-semibold flex items-center ' . ($labelWrap ? '' : 'flex-shrink-0') . " $labelClass",
            ]) }}
            for="{{ $attributes->get('for') }}">
            {{ $label }}
        </label>
    </x-container.container>

    <x-container.container :height="'max'" class="col-start-3 col-end-10 items-center {{ $inputClass }}">
        {{ $input }}
    </x-container.container>

</x-container.wrapper>
