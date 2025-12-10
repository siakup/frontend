@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
  <x-container.wrapper cols="1" padding="p-0">

    <x-container.container background="transparent" align="start">
      <x-typography :variant="'body-large-semibold'">Beranda</x-typography>
    </x-container.container>

    <x-container.container background="transparent">
      <x-container.container :background="'content-white'" :height="'maxContent'" :width="'full'" :padding="'p-4'">
        Ini beranda SIAKUP. Selamat menjelajah!
      </x-container.container>
    </x-container.container>

  </x-container.wrapper>
@endsection
