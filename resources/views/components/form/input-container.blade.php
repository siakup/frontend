@props(['containerClass' => '', 'labelClass' => '', 'inputClass' => '', 'labelWrap' => false])

<x-container.wrapper :padding="'p-0'" :cols="9" :align="'center'" :justify="'center'" class="{{ $containerClass }}">

  <x-container.container class="col-start-1 col-end-2">
    <label 
        {{ $attributes->merge([
            'class' => "text-[#262626] text-sm font-semibold flex items-center gap-2 flex-shrink-0 " 
                      . ($labelWrap ? 'whitespace-normal' : 'whitespace-nowrap') 
                      . " $labelClass"
        ]) }}
        for="{{ $attributes->get('for') }}"
    >
        {{ $label }}
    </label>
  </x-container.container>

  <x-container.container :height="'maxContent'" class="col-start-3 col-end-10 items-center {{ $inputClass }}">
      {{ $input }}
  </x-container.container>

</x-container.wrapper>
