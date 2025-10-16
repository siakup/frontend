@props(['id', 'value' => null])
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
      toggleIcon.src = "{{ asset('components/toggle-on-disabled-false.svg') }}";
      toggleInfo.textContent = "Aktif";
      input.value = "true";
    } else {
      toggleIcon.src = "{{ asset('components/toggle-off-disabled-true.svg') }}";
      toggleInfo.textContent = "Tidak Aktif";
      input.value = "false";
    }
  }

  document.addEventListener('DOMContentLoaded', function () {
    onHandleToggleInput(document.getElementById('{{$id}}').previousElementSibling, true);
  })
</script>

<div class="flex items-center gap-3 m-2">
  <label class="whitespace-nowrap text-[#262626] text-sm font-semibold flex w-[200px] items-center gap-2" for="status">Status</label>
  <div class="toggle-row"></div>
  <button class="p-0 border-none bg-transparent outline-none flex items-center cursor-pointer gap-4" onclick="onHandleToggleInput(this, false)">
      <img src="{{ asset('components/toggle-off-disabled-true.svg') }}" alt="Toggle Icon">
      <span class="text-sm-bd">Tidak Aktif</span>
  </button>
  <input type="hidden" name="status" id="{{$id}}" value="{{ $value ? 'true' : 'false' }}">
</div>