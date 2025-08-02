@extends('layouts.main')

@section('title', 'Mata Kuliah')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Mata Kuliah</div>
@endsection

@section('css')

@endsection

@section('javascript')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('content')
    <div class="px-5 flex flex-col gap-5">
        <x-typography variant="heading-h6" bold class="">
            Mata Kuliah
        </x-typography>

        <livewire:mata-kuliah.mata-kuliah-table />
    </div>
@endsection
