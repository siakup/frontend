@extends('layouts.main')

@section('title', 'Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Akademik</div>
@endsection

@section('css')

@endsection

@section('javascript')

@endsection

@section('content')
<div class="academics-layout">
  @include('academics.layouts.navbar-academic')
  <div class="academics-slicing-content content-card">
    
  </div>
  @include('partials.pagination', [
    // "currentPage" => $data['pagination']['current_page'],
    "currentPage" =>  1,
    // "lastPage" => $data['pagination']['last_page'],
    "lastPage" => 10,
    // "limit" => $limit,
    "limit" => 5,
    "routes" => route('academics-event.index')
  ])
</div>
@endsection