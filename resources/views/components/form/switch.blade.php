@props([
    'name' => '',
    'value' => false,
    'externalOnLabel' => 'Aktif',
    'externalOffLabel' => 'Tidak Aktif',
    'disabled' => false,
    'alpineModel' => null,
])

<div x-data="{ on: @json((bool) $value) }" x-modelable="on" x-model="{{ $attributes->whereStartsWith('x-model')->first() }}" class="flex items-center gap-3 cursor-pointer">
    <button type="button" x-on:click="on = !on" role="switch"
        :class="{
            'bg-green-600': on,
            'bg-white border border-gray-400': !on
        }"
        class="relative inline-flex h-7 w-16 items-center rounded-full transition-colors duration-200 ease-in-out focus:outline-0"
        {{ $disabled ? 'disabled' : '' }}>
        <input type="hidden" name="{{ $name }}" x-bind:value="on ? '1' : '0'" x-model="on">

        <!-- Toggle Circle -->
        <span
            :class="{
                'translate-x-9 bg-white': on,
                'translate-x-1 bg-gray-600': !on
            }"
            class="absolute inline-block h-5 w-5 rounded-full shadow-sm transition-all duration-200 ease-in-out"></span>

        <!-- Internal Labels -->
        <span x-show="!on" class="absolute right-2 text-xs font-medium text-gray-600">OFF</span>
        <span x-show="on" class="absolute left-2 text-xs font-medium text-black">ON</span>
    </button>

    <!-- External Label -->
    <span x-text="on ? '{{ $externalOnLabel }}' : '{{ $externalOffLabel }}'" class="text-sm font-medium text-gray-600">
    </span>
</div>
