@props([
  'id',
  'value',
  'label' => null,  
  'name',
  'disabled' => false,
  'checked' => false,
  'containerClass' => '',
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
      label.classList.add('text-gray-800')
      label.classList.remove('text-gray-600')
    } else {
      label.classList.add('text-600')
      label.classList.remove('text-gray-800')
    }
  }
</script>

<div class="flex gap-3 items-center {{ $containerClass }}">
  <input 
    id="{{ $id }}" 
    type="checkbox" 
    {{
      $attributes->except('onchange')->merge([
        'class' => "accent-red-500 w-fit pe-10 box-border flex items-center ps-3 border 
        border-gray-400 rounded-lg text-sm leading-5 h-6 disabled:cursor-not-allowed"
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
  @if($label)
    <label 
      for="{{ $id }}" 
      class="text-sm w-max {{ $checked ? 'text-gray-800' : 'text-gray-600'}}"
    >
      {{ $label }}
    </label>
  @endif
  
</div>