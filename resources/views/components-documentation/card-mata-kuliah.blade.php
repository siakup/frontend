@extends('layouts.main')

@section('title', 'Card Mata Kuliah')

@section('content')
    <x-container.wrapper :gapY="4" :rows="12">
        <x-container.container class="row-start-1 row-end-2">
            <x-typography variant="body-large-semibold">Card Jadwal Mata Kuliah</x-typography>
        </x-container.container>
        <x-container.container :background="'content-white'" :radius="'md'" :padding="'p-4'" :gap="'gap-5'"
            class="row-start-2 row-end-13">
            <x-card.mata-kuliah variant="primary">
                <x-slot name="mataKuliah">Ilmu Sosial Dasar</x-slot>
                <x-slot name="sks">3</x-slot>
                <x-slot name="kode">SPFA212104</x-slot>
            </x-card.mata-kuliah>
            <x-card.mata-kuliah variant="secondary">
                <x-slot name="mataKuliah">Ilmu Sosial Dasar</x-slot>
                <x-slot name="sks">3</x-slot>
                <x-slot name="kode">SPFA212104</x-slot>
            </x-card.mata-kuliah>
        </x-container.container>
    </x-container.wrapper>
@endsection
