@props([
  'placeholder',
  'id',
  'value' => null,
  'maxChar' => null
])

@php
  $extraOnClick = $attributes->get('oninput');
@endphp

<script>
  function onInputTextArea(element, maxChar) {
    const lengthDisplayDiv = element.nextElementSibling;
    if(lengthDisplayDiv && maxChar) {
      const lengthDisplay = lengthDisplayDiv.querySelector('#Length-display');
      const word = element.value ?? '';
      let splitWord = word.split('');

      if (splitWord.length >= maxChar) {
        lengthDisplay.classList.add('text-[#E62129]');
        lengthDisplay.classList.remove('text-[#8C8C8C]');
      } else {
        lengthDisplay.classList.add('text-[#8C8C8C]');
        lengthDisplay.classList.remove('text-[#E62129]');
      }

      if (splitWord.length > maxChar) {
        splitWord = splitWord.slice(0, maxChar).join("");
        element.value = splitWord;
      }
  
      lengthDisplay.textContent = `${splitWord.length}/${maxChar}`;
    }
    element.style.height = "auto"; 
    element.style.height = (element.scrollHeight) + "px";
  }
</script>

<div class="flex flex-col gap-0.5 flex-1">
  <textarea 
    cols="110" 
    rows="10" 
    class="w-full pe-10 box-border ps-3 pt-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 focus:outline-none focus:border-[1px] focus:border-[#D9D9D9]" style="display: auto;" name="deskripsi" value=""
    placeholder="{{ $placeholder }}" 
    id="{{ $id }}"
    oninput="onInputTextArea(this, {{ $maxChar }});{{ $extraOnClick }}"
  >@if($value !== null){{ $value }}@endif</textarea>
  @if($maxChar !== null)
    <div class="flex flex-col gap-1">
      <span class="text-xs text-[#8C8C8C]">Maksimal {{ $maxChar }} Karakter</span>
      <span class="text-xs text-[#8C8C8C]" id="Length-display">{{ $value ? strlen($value) : 0 }}/{{ $maxChar }}</span>
    </div>
  @endif
</div>