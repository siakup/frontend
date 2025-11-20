@extends('layouts.main')

@section('title', 'Beranda')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Beranda</div>
@endsection

@section('content')
  <x-container :variant="'content-wrapper'">
    <x-typography :variant="'body-large-semibold'">Beranda</x-typography>
    <x-container>
      Ini beranda SIAKUP. Selamat menjelajah!
    </x-container>
  </x-container>
@endsection
