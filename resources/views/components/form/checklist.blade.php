@props([
  'id',
  'value',
  'label',  
  'name',
  'disabled' => false,
  'checked' => false
])

@php
  $extraOnChange = $attributes->get('onchange');
  $defaultOnChange = "onChangeLabel(this);";
  $onChange = $defaultOnChange . ($extraOnChange ?  "$extraOnChange;" : '');
@endphp

<script>
  function onChangeLabel(element) {
    const label = element.nextElementSibling;
    const checked = element.checked;

    if(checked) {
      label.classList.add('text-[#262626]')
      label.classList.remove('text-[#8C8C8C]')
    } else {
      label.classList.add('text-[#8C8C8C]')
      label.classList.remove('text-[#262626]')
    }
  }
</script>

<div class="flex gap-3 items-center">
  <input 
    id="{{ $id }}" 
    type="checkbox" 
    {{
      $attributes->except('onchange')->merge([
        'class' => "accent-[#E62129] w-full pe-10 box-border ps-3 border-[1px] border-[#D9D9D9] rounded-lg text-sm leading-5 h-10"
      ])
    }}
    onchange="{{$onChange}}"
    value="{{ $value }}"
    name="{{ $name }}"
    @if($disabled)
      disabled
    @endif
    @if($checked)
      checked
    @endif
  />
  <label 
    for="{{ $id }}" 
    class="text-sm w-max {{ $checked ? 'text-[#262626]' : 'text-[#8C8C8C]'}}"
  >
    {{ $label }}
  </label>
</div>