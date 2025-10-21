@props([
  'id',
  'name',
  'value' => ''
])
<script>
  function onClickShowYearDropdown(element) {
    const yearDropdown = element.nextElementSibling;
    if (yearDropdown.classList.contains('flex')) {
      yearDropdown.classList.add('hidden');
      yearDropdown.classList.remove('flex');
      element.querySelector('img').src = "{{ asset('assets/base/icon-calendar.svg') }}"
    } else {
      yearDropdown.classList.add("flex");
      yearDropdown.classList.remove("hidden");
      element.querySelector('img').src = "{{ asset('assets/active/icon-calendar.svg') }}"
    }
  }

  document.addEventListener('click', (e) => {
    const year = e.target.closest('#{{ $id }}');
    const yearDropdown = document.querySelector('#{{ $id }} #Year-dropdown');
    const yearInput = document.querySelector('#{{ $id }} .year-input');

    if(year == null && yearDropdown.classList.contains('flex')) {
      yearDropdown.classList.add("hidden");
      yearDropdown.classList.remove("flex");
      yearInput.querySelector('img').src = "{{ asset('assets/base/icon-calendar.svg') }}"
    }
  });

  function onClickSelectYear(element) {
    const value = element.getAttribute('data-year');
    const parent = element.parentElement;
    const allChild = parent.querySelectorAll('div');

    Array.from(allChild).map(child => {
      child.classList.remove('bg-[#E62129]');
      child.classList.remove('text-white');
    })

    element.classList.add('bg-[#E62129]');
    element.classList.add('text-white');
    element.parentElement.previousElementSibling.querySelector('#year').value = value; 
  }
</script>

@php
  $extraOnClick = $attributes->get('onclick');
@endphp

<div id="{{ $id }}" class="flex flex-col relative w-full">
  <div 
    onclick="onClickShowYearDropdown(this)"
    class="year-input border-[1px] border-[#BFBFBF] flex items-stretch text-[#262626] rounded-2xl">
    <input 
      type="text" 
      id="year" 
      class="border-none w-full focus:outline-none focus:border-none p-2" 
      name="{{ $name }}" 
      value="{{ $value }}"
      placeholder="Tahun" 
      readonly 
    />
    <img src="{{ asset('assets/base/icon-calendar.svg') }}" alt="Icon Calendar">
    <span class="bg-[#E8E8E8] rounded-tr-2xl rounded-br-2xl py-2.25 px-3 text-[#8C8C8C] border-l-[1px] border-l-[#D9D9D9] ml-3">Years</span>
  </div>
  <div id="Year-dropdown" class="h-[236px] w-[240px] overflow-scroll border-[1px] border-[#D9D9D9] rounded-lg self-end absolute top-11.25 bg-white hidden flex-col">
    @for($i = date('Y'); $i < date('Y') + 5; $i++) 
      <div 
        class="w-full py-3 px-2 hover:bg-[#D9D9D9] {{$value == $i ? 'bg-[#E62129] text-white' : ''}}" 
        data-year="{{ $i }}"
        onclick="onClickSelectYear(this); {{ $extraOnClick }}"
      >
        {{ $i }}
      </div>
    @endfor
  </div>
</div>