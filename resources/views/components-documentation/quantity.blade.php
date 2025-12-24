@extends('layouts.main')

@section('title', 'Quantity Documentation')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/plugins/flatpckr.css') }}" />
@endsection

@section('content')

  <x-container.wrapper>

    {{-- Title Row --}}
    <x-container.container col="1">
      <x-typography variant="body-large-semibold">Penggunaan Quantity</x-typography>
    </x-container.container>

    {{-- Content Row --}}
    <x-container.container col="1">
      <x-container.wrapper rows="4" class="gap-6">

        {{-- variant quantity min 0 --}}
        <x-container.container row="1" class="flex flex-col gap-3 w-fit">
          <x-typography variant="body-small-bold">Quantity Min: 0</x-typography>
          <x-form.quantity x-model=0 :min="0" />
        </x-container.container>

        {{-- variant quantity max 0 --}}
        <x-container.container row="1" class="flex flex-col gap-3 w-fit">
          <x-typography variant="body-small-bold">Quantity Max: 0</x-typography>
          <x-form.quantity x-model=0 :max="0" />
        </x-container.container>

        {{-- variant quantity min 0 max 1 --}}
        <x-container.container row="1" class="flex flex-col gap-3 w-fit">
          <x-typography variant="body-small-bold">Quantity Min: 0, Max: 1</x-typography>
          <x-form.quantity x-model=0 :min="0" :max="1" />
        </x-container.container>

        {{-- variant quantity disabled --}}
        <x-container.container row="1" class="flex flex-col gap-3 w-fit">
          <x-typography variant="body-small-bold">Quantity Disabled</x-typography>
          <x-form.quantity x-model=0 :min="0" :max="1" :disabled="true" />
        </x-container.container>
      </x-container.wrapper>
    </x-container.container>
  </x-container.wrapper>

@endsection