@props(['id', 'value' => null, 'variant' => 'default'])

@php
 $variants = [
  'default' => [
    'imgSource' => asset('components/toggle-on-disabled-false.svg'),
    'span' => 'text-[#262626] font-bold leading-5.5'
  ],
  'readonly' => [
    'imgSource' => asset('components/toggle-on-disabled-true.svg'),
    'span' => 'text-[#8C8C8C] font-semibold pl-4'
  ]
 ]   
@endphp

<script>
  function onHandleToggleInput(element, isInit) {
    const toggleIcon = element.querySelector('img');
    const toggleInfo = element.querySelector('span');
    const input = element.nextElementSibling;

    let isActive = input.value === "true" ? true : false;
    if(!isInit) {
      isActive = !isActive;
    }

    if (isActive) {
      toggleIcon.src = "{{ $variants[$variant]['imgSource'] }}";
      toggleInfo.textContent = "Aktif";
      input.value = "true";
    } else {
      toggleIcon.src = "{{ asset('components/toggle-off-disabled-true.svg') }}";
      toggleInfo.textContent = "Tidak Aktif";
      input.value = "false";
    }
  }

  setTimeout(() => {
    onHandleToggleInput(document.getElementById('{{$id}}').previousElementSibling, true);
  }, 0);
</script>

<div class="flex items-center gap-3 m-2">
  <label class="whitespace-nowrap text-[#262626] text-sm font-semibold flex w-[200px] items-center gap-2" for="status">Status</label>
  <button 
    type="button"
    class="p-0 border-none bg-transparent outline-none flex items-center cursor-pointer gap-4" 
    @if($variant !== 'readonly')
      onclick="onHandleToggleInput(this, false)"
    @endif  
  >
      <img src="{{ asset('components/toggle-off-disabled-true.svg') }}" alt="Toggle Icon">
      <span class="text-sm {{ $variants[$variant]['span'] }}">Tidak Aktif</span>
  </button>
  <input onload="onHandleToggleInput(this, true)" type="hidden" name="status" id="{{$id}}" value="{{ $value ? 'true' : 'false' }}">
</div>