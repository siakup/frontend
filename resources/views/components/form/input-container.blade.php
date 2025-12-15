@props(['containerClass' => '', 'labelClass' => '', 'inputClass' => '', 'labelWrap' => false])

<x-container.wrapper :padding="'p-0'" :cols="15" :align="'center'" :justify="'center'" class="{{ $containerClass }}">

  <x-container.container class="col-start-1 col-end-3">
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

  <x-container.container :height="'maxContent'" class="col-start-4 col-end-16 items-center {{ $inputClass }}">
      {{ $input }}
  </x-container.container>

</x-container.wrapper>
