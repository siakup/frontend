@props([
    'options' => [],
    'selected' => null,
    'name' => null,
    'id' => null,
])

<div
    x-data="{
        open: false,
        value: '{{ $selected }}',
        options: @js($options),
        dropdownAlign: 'left-0',
        triggerWidth: 0,
        adjustDropdown($trigger, $dropdown) {
            let rect = $trigger.getBoundingClientRect();
            this.triggerWidth = rect.width; // simpan lebar trigger
            let vw = window.innerWidth;
            if (rect.right > vw) {
                this.dropdownAlign = 'right-0'; // buka ke kiri
            } else {
                this.dropdownAlign = 'left-0'; // default buka ke kanan
            }
        }
    }"
    class="relative inline-block"
    {{ $attributes }}
>
    <!-- Trigger -->
    <button
        type="button"
        @click="
            open = !open;
            $nextTick(() => adjustDropdown($el, $refs.dropdown))
        "
        class="flex items-center justify-between border border-[#E62129] px-4 py-2 rounded-[8px] text-[#E62129] bg-white focus:outline-none"
    >
        <span class="whitespace-nowrap" x-text="options[value] ?? 'Pilih opsi'"></span>
        <svg class="w-4 h-4 ml-2 text-[#E62129]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <!-- Dropdown -->
    <ul
        x-ref="dropdown"
        x-show="open"
        @click.away="open = false"
        x-transition
        :class="dropdownAlign"
        :style="{ minWidth: triggerWidth + 'px' }"
        class="absolute mt-1 bg-white border border-[#E62129] rounded-[8px] shadow-lg z-10 whitespace-nowrap"
    >
        @foreach($options as $value => $label)
            <li
                @click="value = '{{ $value }}'; open = false"
                class="px-4 py-2 cursor-pointer hover:bg-[#E62129] hover:text-white"
                :class="{ 'bg-[#E62129] text-white': value === '{{ $value }}' }"
            >
                {{ $label }}
            </li>
        @endforeach
    </ul>

    <!-- Hidden input biar tetap ke-submit -->
    @if($name)
        <input type="hidden" name="{{ $name }}" :value="value">
    @endif
</div>
