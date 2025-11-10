@props(['containerClass' => '', 'labelClass' => ''])
<div class="flex items-center gap-3 mt-2 {{$containerClass}}">
  <label 
      {{ $attributes->merge([
      'class' => "whitespace-nowrap text-[#262626] text-sm font-semibold flex items-center gap-2 $labelClass"
      ]) }}
      for="{{$attributes->get('for')}}"
  >
    {{$label}}
  </label>
  {{ $input }}
</div>