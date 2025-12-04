@extends('layouts.main')

@section('title', 'Card Mata Kuliah')

@section('content')
    <x-container variant="content-wrapper">
        <x-typography variant="body-large-semibold">Card Mata Kuliah</x-typography>
        <x-container class="flex flex-col gap-5 mb-5">
            <x-card.mata-kuliah variant="primary">
                <x-slot name="mataKuliah">Ilmu Sosial Dasar</x-slot>
                <x-slot name="sks">3</x-slot>
                <x-slot name="kode">SPFA212104</x-slot>
            </x-card-mata.kuliah>
            <x-card.mata-kuliah variant="secondary">
                <x-slot name="mataKuliah">Ilmu Sosial Dasar</x-slot>
                <x-slot name="sks">3</x-slot>
                <x-slot name="kode">SPFA212104</x-slot>
            </x-card-mata.kuliah>
        </x-container>
    </x-container>
@endsection
