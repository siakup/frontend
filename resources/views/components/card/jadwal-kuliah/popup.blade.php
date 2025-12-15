@props([
    'data' => null,
])

<div x-data="{ show: false }" class="relative inline-block" @click.away="show = false">

    {{-- Trigger --}}
    <div x-on:click="show = true" class="cursor-pointer">
        {{ $slot }}
    </div>

    {{-- Tooltip --}}
    <div x-show="show" x-transition.opacity.duration.250ms class="card-jadwal-popup" style="display: none;">
        <div class="grid grid-rows-5 gap-2 p-5 h-full w-full">
            <div class="flex flex-cols gap-2 justify-end">
                <x-typography variant="caption-regular" class="self-center cursor-pointer">Tutup</x-typography>
                <button type="button" x-on:click="show = false" class="cursor-pointer">
                    <x-icon :name="'close-cancel/black-16'" class="w-fit h-fit self-center" />
                </button>
            </div>
            <div class="row-span-2">
                <div class="grid grid-cols-10 gap-x-2 p-0">
                    <x-icon :name="'dot/red-24'" class="w-fit h-fit" />
                    <div class="col-span-9 flex flex-col gap-0.5">
                        <x-typography :variant="'body-small-bold'">{{ $data['mataKuliah'] }} - {{ $data['kode'] }} -
                            {{ $data['periode'] }} [{{ $data['kodeRuangan'] }}]</x-typography>
                        <x-typography :variant="'caption-regular'"> {{ $data['date'] }} ⋅ {{ $data['startTime'] }} -
                            {{ $data['endTime'] }}</x-typography>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-10 gap-x-2 p-0 items-center">
                <x-icon :name="'notification/black-24'" class="w-fit h-fit" />
                <div class="col-span-9">
                    <x-typography :variant="'caption-regular'">Datang 30 Menit Sebelumnya</x-typography>
                </div>
            </div>
            <div class="grid grid-cols-10 gap-x-2 p-0 items-center">
                <div>
                    <x-icon :name="'schedule/black-24'" class="w-fit h-fit" />
                </div>
                <div class="col-span-9">
                    <x-typography :variant="'caption-regular'">Jadwal Kuliah Mahasiswa</x-typography>
                </div>
            </div>
        </div>
    </div>
</div>
