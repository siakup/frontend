@extends('layouts.main')

@section('title', 'Kalendar Jadwal Kuliah')

@section('content')
    <x-container variant="content-wrapper">
        <x-typography variant="body-large-semibold">Kalendar Jadwal Kuliah</x-typography>
        <div class="bg-gray-50 border rounded-md border-gray-400 p-5 w-full">
            <x-full-calendar.index></x-full-calendar.index>
        </div>
    </x-container>
@endsection
