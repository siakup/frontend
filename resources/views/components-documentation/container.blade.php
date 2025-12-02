@extends('layouts.main')

@section('title', 'Container Documentation')

@section('content')
<x-container.wrapper align="rows" number="20" gap="3">
  <div class="row-span-4 bg-red-500 w-full h-full grid grid-cols-30"></div>
  <div class="row-span-3 bg-green-700 w-full h-full"></div>
</x-wrapper>
@endsection