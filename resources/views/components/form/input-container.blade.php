@props(['containerClass' => '', 'labelClass' => '', 'inputClass' => '', 'labelWrap' => false])

<x-container.wrapper :padding="'p-0'" :cols="9" :align="'center'" :justify="'center'">

  <x-container.container class="col-start-1 col-end-2">
    <label 
        {{ $attributes->merge([
            'class' => "input-container-label " 
                      . ($labelWrap ? 'input-container-label-wrap' : 'input-container-label-nowrap') 
                      . " $labelClass"
        ]) }}
        for="{{ $attributes->get('for') }}"
    >
        {{ $label }}
    </label>
  </x-container.container>

  <x-container.container :height="'maxContent'" class="col-start-3 col-end-10 items-center">
      {{ $input }}
  </x-container.container>

</x-container.wrapper>
