@extends('layouts.main')

@section('title', 'Beranda')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Beranda</div>
@endsection

@section('content')
  <x-container.container :variant="'content-wrapper'" class="min-h-[calc(100vh-9rem)]">
    <x-typography :variant="'body-large-semibold'">Beranda</x-typography>
    <x-container.container>
      Ini beranda SIAKUP. Selamat menjelajah!
    </x-container>
  </x-container>
@endsection
