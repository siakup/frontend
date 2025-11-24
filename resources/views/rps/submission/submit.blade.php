@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Semester)')

@section('content')
    <x-container variant="content-wrapper">
        <x-typography variant="heading-h6">Buat RPS (Rencana Pembelajaran Semester)</x-typography>
        <x-button.back class="ml-2" href="{{ route('rps.submission') }}">RPS (Rencana Pembelajaran Semester)</x-button.back>
    </x-container>
@endsection
