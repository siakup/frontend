@extends('layouts.main')

@section('title', 'Card')

@php
    $mataKuliah = [
        'nama' => 'Ilmu Sosial Dasar',
        'sks' => 3,
        'kode' => 'SPFA212104',
    ];
@endphp

@section('content')
    <x-container.wrapper :gapY="4" :rows="12">
        <x-container.container class="row-start-1 row-end-2">
            <x-typography variant="body-large-semibold">Card Kuliah</x-typography>
        </x-container.container>
        <x-container.container :background="'content-white'" :radius="'md'" :padding="'p-4'" :gap="'gap-5'"
            class="row-start-2 row-end-13 flex flex-col gap-5">
            <div class="flex flex-row gap-2">
                <x-card.mata-kuliah variant="primary" :data="$mataKuliah" />
                <x-card.mata-kuliah variant="secondary" :data="$mataKuliah" />
            </div>
            <div>
                <x-container.container :background="'disable-white'" class="w-75!" :padding="'p-2.5'">
                    <x-container.wrapper :rows="3" :gapY="2" :padding="'p-0'">
                        <x-container.container class="flex flex-col items-center">
                            <x-container.container class="flex flex-row items-center" :gap="'gap-1'">
                                <x-icon :name="'survey-solid/solid-blue-24'" class="w-6 h-6" />
                                <x-typography :variant="'body-medium-bold'">Subject Pesan Terakhir</x-typography>
                            </x-container.container>
                            <x-container.container height="auto">
                                <div class="self-center w-full bg-gray-500 h-px opacity-50"></div>
                            </x-container.container>
                        </x-container.container>
                        <x-container.container class="row-span-2">
                            <x-card.list-subjek :nomor="1" :name="'Putri Mariono'" :nim="'17720002'" :subjek="'Konsultasi KRS Semester 2'"
                                :latest_chat_at="'hari ini 15:10'" :latest_chat_by="'Dian Sastro'"></x-card.list-subjek>
                        </x-container.container>
                    </x-container.wrapper>

                </x-container.container>
            </div>


        </x-container.container>
    </x-container.wrapper>
@endsection
