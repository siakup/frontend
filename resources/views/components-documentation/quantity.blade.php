@extends('layouts.main')

@section('title', 'Table Documentation')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/plugins/flatpckr.css') }}" />
@endsection

@section('content')

<x-container :variant="'content-wrapper'" class="!w-max !mx-0 !pb-10 !flex !flex-col !items-start !justify-start" x-data="{num: 0, num1: 0, num2: 0, num3: 0}">
  <x-typography :variant="'body-small-bold'">Quantity Min: 0</x-typography>
  <x-form.quantity x-model="num" :min="0" />
  <x-typography :variant="'body-small-bold'">Quantity Max: 0</x-typography>
  <x-form.quantity x-model="num1" :max="0" />
  <x-typography :variant="'body-small-bold'">Quantity Min: 0, Max: 1</x-typography>
  <x-form.quantity x-model="num2" :min="0" :max="1" />
  <x-typography :variant="'body-small-bold'">Quantity Disabled</x-typography>
  <x-form.quantity x-model="num3" :min="0" :max="1" :disabled="true" />
</x-container>


@endsection
