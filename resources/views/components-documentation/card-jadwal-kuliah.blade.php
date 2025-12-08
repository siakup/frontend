@extends('layouts.main')

@section('title', 'Card Mata Kuliah')

@section('content')
    <x-container.wrapper :gapY="4" :rows="12">
        <x-container.container class="row-start-1 row-end-2">
            <x-typography variant="body-large-semibold">Card Jadwal Mata Kuliah</x-typography>
        </x-container.container>
        <x-container.container :background="'content-white'" :radius="'md'" :padding="'p-4'" :gap="'gap-5'"
            class="row-start-2 row-end-13">
            <x-container.wrapper :gapY="4" :rows="4">
                <div class="row-start-1 row-end-2 flex gap-4 self-center">
                    <x-typography class="self-center" variant="body-medium-semibold">Card Perminggu Jadwal
                        Kuliah</x-typography>
                    <x-card.jadwal-kuliah.popup :data="$data1">
                        <x-card.jadwal-kuliah.event :variant="'active'" :data="$data1" />
                    </x-card.jadwal-kuliah.popup>
                    <x-card.jadwal-kuliah.popup :data="$data2">
                        <x-card.jadwal-kuliah.event :variant="'disable'" :data="$data2" />
                    </x-card.jadwal-kuliah.popup>
                </div>
                <div class="row-start-2 row-end-5 flex flex-col gap-4">
                    <x-typography variant="body-medium-semibold">Card Perhari Jadwal
                        Kuliah</x-typography>
                    <x-card.jadwal-kuliah.popup :data="$data1">
                        <x-card.jadwal-kuliah.event :variant="'active'" :event="'day'" :data="$data1" />
                    </x-card.jadwal-kuliah.popup>
                    <x-card.jadwal-kuliah.popup :data="$data2">
                        <x-card.jadwal-kuliah.event :variant="'disable'" :event="'day'" :data="$data2" />
                    </x-card.jadwal-kuliah.popup>
                </div>
            </x-container.wrapper>
        </x-container.container>
    </x-container.wrapper>
@endsection
