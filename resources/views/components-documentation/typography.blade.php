@extends('layouts.main')

@section('title', 'Table Documentation')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/plugins/flatpckr.css') }}" />
@endsection

@section('content')
<x-container :variant="'content-wrapper'" class=" tex">
  <x-typography :variant="'heading-h1'">Heading H1</x-typography>
  <x-typography :variant="'heading-h2'">Heading H2</x-typography>
  <x-typography :variant="'heading-h3'">Heading H3</x-typography>
  <x-typography :variant="'heading-h4'">Heading H4</x-typography>
  <x-typography :variant="'heading-h5'">Heading H5</x-typography>
  <x-typography :variant="'heading-h6'">Heading H6</x-typography>
  <x-typography :variant="'body-large-regular'">Body Large Regular</x-typography>
  <x-typography :variant="'body-large-bold'">Body Large Bold</x-typography>
  <x-typography :variant="'body-large-semibold'">Body Large Semibold</x-typography>
  <x-typography :variant="'body-large-italic'">Body Large Italic</x-typography>
  <x-typography :variant="'body-medium-regular'">Body Medium Regular</x-typography>
  <x-typography :variant="'body-medium-bold'">Body Medium Bold</x-typography>
  <x-typography :variant="'body-medium-semibold'">Body Medium Semibold</x-typography>
  <x-typography :variant="'body-medium-italic'">Body Medium Italic</x-typography>
  <x-typography :variant="'body-small-regular'">Body Small Regular</x-typography>
  <x-typography :variant="'body-small-bold'">Body Small Bold</x-typography>
  <x-typography :variant="'body-small-semibold'">Body Small Semibold</x-typography>
  <x-typography :variant="'body-small-italic'">Body Small Italic</x-typography>
  <x-typography :variant="'caption-regular'">Caption Regular</x-typography>
  <x-typography :variant="'caption-bold'">Caption Bold</x-typography>
  <x-typography :variant="'caption-semibold'">Caption Semibold</x-typography>
  <x-typography :variant="'caption-italic'">Caption Italic</x-typography>
  <x-typography :variant="'pixie-regular'">Pixie Regular</x-typography>
  <x-typography :variant="'pixie-bold'">Pixie Bold</x-typography>
  <x-typography :variant="'pixie-semibold'">Pixie Semibold</x-typography>
  <x-typography :variant="'pixie-italic'">Pixie Italic</x-typography>
</x-container>
@endsection