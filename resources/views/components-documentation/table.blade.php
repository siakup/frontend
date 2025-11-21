@extends('layouts.main')

@section('title', 'Table Documentation')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/plugins/flatpckr.css') }}" />
@endsection

@section('content')
{{-- penjelasan parameter --}}

{{-- isRounderedTop = true: radius di sisi atas --}}
{{-- isRounderedBottom = true: radius di sisi atas --}}

<x-container :variant="'content-wrapper'">
  <x-typography :variant="'body-medium-bold'">Table variant default tanpa tableTitle (isHaveTitle = false)</x-typography>
  <x-table.index>
    <x-table.head>
      <x-table.row>
        <x-table.header-cell>header1</x-table.header-cell>
        <x-table.header-cell>header2</x-table.header-cell>
      </x-table.row>
    </x-table.head>
    <x-table.body>
      <x-table.row>
        <x-table.cell>Cell 1</x-table.cell>
        <x-table.cell>Cell 2</x-table.cell>
      </x-table.row>
    </x-table.body>
  </x-table.index>
  
  <x-typography :variant="'body-medium-bold'">Table variant default dengan tableTitle (isHaveTitle = true)</x-typography>
  <x-table.index :isHaveTitle="true">
    <x-slot name="tableTitleSlot">
      <x-container :variant="'content-wrapper'" class="!px-0">Title</x-container>
    </x-slot>
    <x-table.head>
      <x-table.row>
        <x-table.header-cell>header1</x-table.header-cell>
        <x-table.header-cell>header2</x-table.header-cell>
      </x-table.row>
    </x-table.head>
    <x-table.body>
      <x-table.row>
        <x-table.cell>Cell 1</x-table.cell>
        <x-table.cell>Cell 2</x-table.cell>
      </x-table.row>
    </x-table.body>
  </x-table.index>
  
  <x-typography :variant="'body-medium-bold'">Table variant old tanpa tableTitle (isHaveTitle = false)</x-typography>
  <x-table.index :variant="'old'">
    <x-table.head :variant="'old'">
      <x-table.row :variant="'old'">
        <x-table.header-cell :variant="'old'">header1</x-table.header-cell>
        <x-table.header-cell :variant="'old'">header2</x-table.header-cell>
      </x-table.row>
    </x-table.head>
    <x-table.body :variant="'old'">
      <x-table.row :variant="'old'">
        <x-table.cell :variant="'old'">Cell 1</x-table.cell>
        <x-table.cell :variant="'old'">Cell 2</x-table.cell>
      </x-table.row>
    </x-table.body>
  </x-table.index>
  
  <x-typography :variant="'body-medium-bold'">Table variant old dengan tableTitle (isHaveTitle = true)</x-typography>
  <x-table.index :variant="'old'" :isHaveTitle="true">
    <x-slot name="tableTitleSlot">
      <x-container :variant="'content-wrapper'" class="!p-0">Title</x-container>
    </x-slot>
    <x-table.head :variant="'old'">
      <x-table.row :variant="'old'">
        <x-table.header-cell :variant="'old'">header1</x-table.header-cell>
        <x-table.header-cell :variant="'old'">header2</x-table.header-cell>
      </x-table.row>
    </x-table.head>
    <x-table.body :variant="'old'">
      <x-table.row :variant="'old'">
        <x-table.cell :variant="'old'">Cell 1</x-table.cell>
        <x-table.cell :variant="'old'">Cell 2</x-table.cell>
      </x-table.row>
    </x-table.body>
  </x-table.index>

  <x-typography :variant="'body-medium-bold'">Another variants color of Table Title</x-typography>
  <x-table.index :variant="'old'" :isHaveTitle="true" :colorTypeTableTitle="'light-yellow-gradient'">
    <x-slot name="tableTitleSlot">
      <x-container :variant="'content-wrapper'" class="!p-0">Yellow Gradient</x-container>
    </x-slot>
    <x-table.head :variant="'old'">
      <x-table.row :variant="'old'">
        <x-table.header-cell :variant="'old'">header1</x-table.header-cell>
        <x-table.header-cell :variant="'old'">header2</x-table.header-cell>
      </x-table.row>
    </x-table.head>
    <x-table.body :variant="'old'">
      <x-table.row :variant="'old'">
        <x-table.cell :variant="'old'">Cell 1</x-table.cell>
        <x-table.cell :variant="'old'">Cell 2</x-table.cell>
      </x-table.row>
    </x-table.body>
  </x-table.index>

  <x-table.index :variant="'old'" :isHaveTitle="true" :colorTypeTableTitle="'light-blue-gradient'">
    <x-slot name="tableTitleSlot">
      <x-container :variant="'content-wrapper'" class="!p-0">Blue Gradient</x-container>
    </x-slot>
    <x-table.head :variant="'old'">
      <x-table.row :variant="'old'">
        <x-table.header-cell :variant="'old'">header1</x-table.header-cell>
        <x-table.header-cell :variant="'old'">header2</x-table.header-cell>
      </x-table.row>
    </x-table.head>
    <x-table.body :variant="'old'">
      <x-table.row :variant="'old'">
        <x-table.cell :variant="'old'">Cell 1</x-table.cell>
        <x-table.cell :variant="'old'">Cell 2</x-table.cell>
      </x-table.row>
    </x-table.body>
  </x-table.index>

  <x-table.index :variant="'old'" :isHaveTitle="true" :colorTypeTableTitle="'light-red-gradient'">
    <x-slot name="tableTitleSlot">
      <x-container :variant="'content-wrapper'" class="!p-0">Red Gradient</x-container>
    </x-slot>
    <x-table.head :variant="'old'">
      <x-table.row :variant="'old'">
        <x-table.header-cell :variant="'old'">header1</x-table.header-cell>
        <x-table.header-cell :variant="'old'">header2</x-table.header-cell>
      </x-table.row>
    </x-table.head>
    <x-table.body :variant="'old'">
      <x-table.row :variant="'old'">
        <x-table.cell :variant="'old'">Cell 1</x-table.cell>
        <x-table.cell :variant="'old'">Cell 2</x-table.cell>
      </x-table.row>
    </x-table.body>
  </x-table.index>

  <x-table.index :variant="'old'" :isHaveTitle="true" :colorTypeTableTitle="'light-green-gradient'">
    <x-slot name="tableTitleSlot">
      <x-container :variant="'content-wrapper'" class="!p-0">Green Gradient</x-container>
    </x-slot>
    <x-table.head :variant="'old'">
      <x-table.row :variant="'old'">
        <x-table.header-cell :variant="'old'">header1</x-table.header-cell>
        <x-table.header-cell :variant="'old'">header2</x-table.header-cell>
      </x-table.row>
    </x-table.head>
    <x-table.body :variant="'old'">
      <x-table.row :variant="'old'">
        <x-table.cell :variant="'old'">Cell 1</x-table.cell>
        <x-table.cell :variant="'old'">Cell 2</x-table.cell>
      </x-table.row>
    </x-table.body>
  </x-table.index>


</x-container>


@endsection