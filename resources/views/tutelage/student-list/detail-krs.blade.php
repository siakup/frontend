@extends('layouts.main')

@section('title', 'Kelompok Perwalian')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Kelompok Perwalian</div>
@endsection

@section('content')
    <div class="page-header">
        <div class="page-title-text">Kelompok Perwalian</div>
    </div>

    <div class="academics-layout">
        @include('tutelage.student-list.layout.navbar-tutelage')
        <div class="academics-slicing-content content-card">
            <div class="card-header">
                <div class="text-md-rg">Ini beranda SIAKUP. Selamat menjelajah!</div>
            </div>
            disini editnya
        </div>
    </div>
@endsection
