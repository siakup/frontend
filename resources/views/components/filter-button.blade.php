<script>
  let handleDropdownButtonClick;

  function resetOptionDefaultClass(event, buttonElement) {
    if (
      event.target !== buttonElement &&
      !buttonElement.nextElementSibling.contains(event.target)
    ) {
      const dropdown = buttonElement.nextElementSibling;
      dropdown.classList.add('hidden');
      dropdown.classList.remove('flex');

      document.removeEventListener('click', handleDropdownButtonClick);
    }
  }

  function dropdownButtonHandleClick(buttonElement, event) {
    event.stopPropagation();

    const dropdownOptionList = buttonElement.nextElementSibling;

    if (dropdownOptionList.classList.contains('flex')) {
      document.removeEventListener('click', handleDropdownButtonClick);
      dropdownOptionList.classList.remove('flex');
      dropdownOptionList.classList.add('hidden');
      return;
    }

    dropdownOptionList.classList.remove('hidden');
    dropdownOptionList.classList.add('flex');

    setTimeout(() => {
      handleDropdownButtonClick = (e) => resetOptionDefaultClass(e, buttonElement);
      document.addEventListener('click', handleDropdownButtonClick);
    }, 0);
  }

  function optionButtonHandleClick(element) {
    const value = element.getAttribute('data-sort');
    const url = new URL(window.location.href);
    url.searchParams.set('sort', value);
    window.location.href = url.toString();
  }
</script>

<div class="relative">
    <button class="flex items-center gap-[8px] px-[16px] py-[8px] bg-transparent border-[1px] border-solid border-[#E62129] rounded-md cursor-pointer text-[#E62129]" id="sortButton" onclick="dropdownButtonHandleClick(this, event)">
        <span id="sortLabel">Urutkan</span>
        <img src="{{ asset('assets/icons/filter/red-16.svg') }}" alt="Filter">
    </button>
    <div id="sortDropdown" class="bg-white border-[1px] border-[#DDD] rounded-md w-[226px] p-1 flex-col items-start max-h-[200px] overflow-y-auto z-999 absolute top-[100%] right-0 h-max hidden">
        <div class="px-[12px] py-[8px] cursor-pointer transition-[background] duration-200 hover:bg-[#FBE8E6] w-full text-sm" data-sort="active" onclick="optionButtonHandleClick(this)">Aktif</div>
        <div class="px-[12px] py-[8px] cursor-pointer transition-[background] duration-200 hover:bg-[#FBE8E6] w-full text-sm" data-sort="inactive" onclick="optionButtonHandleClick(this)">Tidak Aktif</div>
        <div class="px-[12px] py-[8px] cursor-pointer transition-[background] duration-200 hover:bg-[#FBE8E6] w-full text-sm" data-sort="nama,asc" onclick="optionButtonHandleClick(this)">A-Z</div>
        <div class="px-[12px] py-[8px] cursor-pointer transition-[background] duration-200 hover:bg-[#FBE8E6] w-full text-sm" data-sort="nama,desc" onclick="optionButtonHandleClick(this)">Z-A</div>
        <div class="px-[12px] py-[8px] cursor-pointer transition-[background] duration-200 hover:bg-[#FBE8E6] w-full text-sm" data-sort="created_at,desc" onclick="optionButtonHandleClick(this)">Terbaru</div>
        <div class="px-[12px] py-[8px] cursor-pointer transition-[background] duration-200 hover:bg-[#FBE8E6] w-full text-sm" data-sort="created_at,asc" onclick="optionButtonHandleClick(this)">Terlama</div>
    </div>
</div>