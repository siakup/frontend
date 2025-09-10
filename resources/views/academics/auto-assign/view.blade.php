@extends('layouts.main')

@section('title', 'Daftar Kelas')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Daftar Kelas</div>
@endsection

@section('javascript')

@endsection

@section('content')
    <x-container variant="content-wrapper">
        <x-typography variant="heading-h6" bold class="">
            Daftar Kelas
        </x-typography>

        <x-button.back href="{{ route('academics.auto-assign.index') }}">
            Auto Assign
        </x-button.back>

        <x-container>
            <x-typography variant="heading-h6" class="mb-2">
                Daftar Kelas Hasil Auto Assign
            </x-typography>
        </x-container>
    </x-container>
@endsection
