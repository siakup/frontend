@props([
  'placeholder' => 'Tulis Deskripsi',
  'id',
  'name' => 'deskripsi',
  'rows' => "10",
  'value' => null,
  'maxChar' => null,
  'helperText' => '',
])

@php
  $extraOnClick = $attributes->get('oninput');
  $initialLength = $value ? strlen($value) : 0;
@endphp

<script>
  function onInputTextArea(element, maxChar) {
    const display = element.parentElement.querySelector('.length-display');
    if (!display || !maxChar) return;

    let text = element.value || '';

    if (text.length > maxChar) {
      text = text.slice(0, maxChar);
      element.value = text;
    }

    const isLimitReached = text.length >= maxChar;

    display.textContent = `${text.length}/${maxChar}`;
    display.classList.toggle('text-red-500', isLimitReached);
    display.classList.toggle('text-gray-600', !isLimitReached);

    element.classList.toggle('border-red-500', isLimitReached);
    element.classList.toggle('border-gray-400', !isLimitReached);

    element.style.height = "auto"; 
    element.style.height = element.scrollHeight + "px";
  }
</script>


<div class="flex flex-col gap-0.5 flex-1">
  <textarea 
    cols="110" 
    rows="{{ $rows }}" 
    {{ $attributes->merge([
      'class' => 
        'w-full pe-10 box-border ps-3 text-sm pt-3 border border-gray-400 rounded-lg leading-5 focus:outline-none
        disabled:bg-gray-200 disabled:text-gray-600 disabled:cursor-not-allowed'
    ]) }}
    name="{{ $name }}" 
    placeholder="{{ $placeholder }}" 
    id="{{ $id }}"
    oninput="onInputTextArea(this, {{ $maxChar }});{{ $extraOnClick }}"
  >{{ $value }}</textarea>

  @if($maxChar)
    <div class="flex flex-row items-center text-xs text-[#8C8C8C]">
      @if($helperText)
        <span>{{ $helperText }}</span>
      @endif

      <span class="ml-auto length-display text-gray-600">
        {{ $initialLength }}/{{ $maxChar }}
      </span>
    </div>
  @endif
</div>
