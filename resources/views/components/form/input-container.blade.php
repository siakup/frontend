@props(['containerClass' => '', 'labelClass' => '', 'inputClass' => '', 'labelWrap' => false])

<div class="flex flex-row items-center gap-3 mt-2 {{ $containerClass }}">
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
  <div class="flex-grow {{ $inputClass }}">
      {{ $input }}
  </div>
</div>
