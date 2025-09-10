@extends('layouts.main')

@section('title', 'Daftar Peserta Kelas')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Daftar Peserta Kelas</div>
@endsection

@section('javascript')

@endsection

@section('content')
    <x-container variant="content-wrapper">
{{--        TODO: ambil nama kelas dr db--}}
        <x-typography variant="heading-h6" bold class="">
            Daftar Peserta Kelas - {{}}
        </x-typography>

        <x-button.back href="{{ route('academics.auto-assign.view') }}">
            Daftar Kelas
        </x-button.back>

        <x-container>
            {{--        TODO: ambil nama kelas dr db--}}
            <x-typography variant="heading-h6" class="mb-2">
                Daftar Peserta Kelas - {{}}
            </x-typography>
        </x-container>
    </x-container>
@endsection
