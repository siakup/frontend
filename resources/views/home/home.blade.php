@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
  <x-container.wrapper :rows="12" :padding="'p-0'">

    <x-container.container :background="'transparent'" class="row-start-1 row-end-2">
      <x-typography :variant="'body-large-semibold'">Beranda</x-typography>
    </x-container.container>

    <x-container.container :background="'transparent'" class="row-start-2 row-end-13">
      <x-container.container :background="'content-white'" :height="'maxContent'" :width="'full'" :padding="'p-4'">
        Ini beranda SIAKUP. Selamat menjelajah!
      </x-container.container>
    </x-container.container>

  </x-container.wrapper>
@endsection
