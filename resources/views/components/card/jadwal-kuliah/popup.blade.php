@props([
    'data' => null,
])

{{-- <div x-data="{ show: false, data: {} }"
    x-on:open-popup.window="
        if ($event.detail.id === '{{ $id }}') {
            data = $event.detail.payload;
            show = true;
        }
    "
    x-on:close-popup.window="show = false" x-show="show" x-transition class="card-jadwal-popup" style="display: none;">
    <x-container.wrapper :rows="5" :gapY="2" :padding="'p-5'">
        <x-container.container class="row-start-1 row-end-2 flex gap-2 justify-end">
            <x-typography variant="caption-regular" class="self-center cursor-pointer" >Tutup</x-typography>
            <button type="button" @click="$dispatch('close-popup', { id: @js($id) })" class="cursor-pointer">
                <x-icon :name="'close-cancel/black-16'" class="w-4 h-4 self-center"  />
            </button>
        </x-container.container>
        <x-container.container class="row-start-2 row-end-4">
            <x-container.wrapper :cols="10" :gapX="2" :padding="'p-0'">
                <div>
                    <x-icon :name="'dot/red-24'" class="w-6 h-6" />
                </div>
                <div class="col-span-9 flex flex-col gap-0.5">
                    <x-typography :variant="'body-small-bold'"
                        x-text="`${data.mataKuliah} - ${data.kode} - ${data.periode} [${data.kodeRuangan}]`"></x-typography>
                    <x-typography :variant="'caption-regular'"
                        x-text="`${data.date ?? ''} ⋅ ${data.startTime} - ${data.endTime}`"></x-typography>
                </div>
            </x-container.wrapper>
        </x-container.container>
        <x-container.container class="row-start-4 row-end-5 flex flex-row gap-2">
            <x-container.wrapper :cols="10" :gapX="2" :padding="'p-0'" :align="'center'">
                <div>
                    <x-icon :name="'notification/black-24'" class="w-6 h-6" />
                </div>
                <div class="col-span-9">
                    <x-typography :variant="'caption-regular'">Datang 30 Menit Sebelumnya</x-typography>
                </div>
            </x-container.wrapper>
        </x-container.container>
        <x-container.container class="row-start-5 row-end-6 flex flex-row gap-2">
            <x-container.wrapper :cols="10" :gapX="2" :padding="'p-0'" :align="'center'">
                <div>
                    <x-icon :name="'schedule/black-24'" class="w-6 h-6" />
                </div>
                <div class="col-span-9">
                    <x-typography :variant="'caption-regular'">Jadwal Kuliah Mahasiswa</x-typography>
                </div>
            </x-container.wrapper>
        </x-container.container>
    </x-container.wrapper>
</div> --}}

<div x-data="{ show: false }" class="relative inline-block">

    {{-- Trigger --}}
    <div x-on:click="show = true" class="cursor-pointer">
        {{ $slot }}
    </div>

    {{-- Tooltip --}}
    <div x-show="show" x-transition.opacity.duration.250ms class="card-jadwal-popup" style="display: none;">
        <x-container.wrapper :rows="5" :gapY="2" :padding="'p-5'">
            <x-container.container class="row-start-1 row-end-2 flex gap-2 justify-end">
                <x-typography variant="caption-regular" class="self-center cursor-pointer">Tutup</x-typography>
                <button type="button" x-on:click="show = false" class="cursor-pointer">
                    <x-icon :name="'close-cancel/black-16'" class="w-4 h-4 self-center" />
                </button>
            </x-container.container>
            <x-container.container class="row-start-2 row-end-4">
                <x-container.wrapper :cols="10" :gapX="2" :padding="'p-0'">
                    <div>
                        <x-icon :name="'dot/red-24'" class="w-6 h-6" />
                    </div>
                    <div class="col-span-9 flex flex-col gap-0.5">
                        <x-typography :variant="'body-small-bold'">{{ $data['mataKuliah'] }} - {{ $data['kode'] }} -
                            {{ $data['periode'] }} [{{ $data['kodeRuangan'] }}]</x-typography>
                        <x-typography :variant="'caption-regular'"> {{ $data['date'] }} ⋅ {{ $data['startTime'] }} -
                            {{ $data['endTime'] }}</x-typography>
                    </div>
                </x-container.wrapper>
            </x-container.container>
            <x-container.container class="row-start-4 row-end-5 flex flex-row gap-2">
                <x-container.wrapper :cols="10" :gapX="2" :padding="'p-0'" :align="'center'">
                    <div>
                        <x-icon :name="'notification/black-24'" class="w-6 h-6" />
                    </div>
                    <div class="col-span-9">
                        <x-typography :variant="'caption-regular'">Datang 30 Menit Sebelumnya</x-typography>
                    </div>
                </x-container.wrapper>
            </x-container.container>
            <x-container.container class="row-start-5 row-end-6 flex flex-row gap-2">
                <x-container.wrapper :cols="10" :gapX="2" :padding="'p-0'" :align="'center'">
                    <div>
                        <x-icon :name="'schedule/black-24'" class="w-6 h-6" />
                    </div>
                    <div class="col-span-9">
                        <x-typography :variant="'caption-regular'">Jadwal Kuliah Mahasiswa</x-typography>
                    </div>
                </x-container.wrapper>
            </x-container.container>
        </x-container.wrapper>
    </div>
</div>
