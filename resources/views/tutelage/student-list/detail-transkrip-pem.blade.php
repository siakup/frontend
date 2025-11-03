@extends('layouts.main')

@section('title', 'Kelompok Perwalian')

@section('breadcrumbs')
  <div class="breadcrumb-item">Beranda</div>
  <div class="breadcrumb-item active">Kelompok Perwalian</div>
@endsection

@section('content')
<div class="page-header">
  <div class="page-title-text">Detail Kartu Studi Mahasiswa</div>
</div>

<div class="academics-layout">
    @include('tutelage.student-list.layout.navbar-tutelage', ["id" => $id])

    <div class="academics-slicing-content content-card p-[10px]">

        {{-- Header --}}
        <x-typography variant="heading-h5" bold class="p-3">
            Transkrip Penilaian Ekstrakulikuler Mahasiswa
        </x-typography>

        {{-- Info Mahasiswa --}}
        <div class="p-[10px]">
            <x-table>
                <x-table-body>
                    <x-table-row class="h-[38px]">
                        <x-table-cell position="left" class="w-[313px] bg-[#E8E8E8] px-6 py-3">Nomor Induk Mahasiswa</x-table-cell>
                        <x-table-cell position="left" class="bg-[#F5F5F5] px-6 py-3 font-semibold">{{ $student['nim'] }}</x-table-cell>
                    </x-table-row>
                    <x-table-row class="h-[38px]">
                        <x-table-cell position="left" class="bg-[#F5F5F5] px-6 py-3">Nama Mahasiswa</x-table-cell>
                        <x-table-cell position="left" class="bg-white px-6 py-3 font-semibold">{{ $student['nama'] }}</x-table-cell>
                    </x-table-row>
                    <x-table-row class="h-[38px]">
                        <x-table-cell position="left" class="bg-[#E8E8E8] px-6 py-3">Program Studi</x-table-cell>
                        <x-table-cell position="left" class="bg-[#F5F5F5] px-6 py-3 font-semibold">{{ $student['prodi'] }}</x-table-cell>
                    </x-table-row>
                    <x-table-row class="h-[38px]">
                        <x-table-cell position="left" class="bg-[#F5F5F5] px-6 py-3">Tahun Masuk</x-table-cell>
                        <x-table-cell position="left" class="bg-white px-6 py-3 font-semibold">{{ $student['tahun_masuk'] }}</x-table-cell>
                    </x-table-row>
                    <x-table-row class="h-[38px]">
                        <x-table-cell position="left" class="bg-[#E8E8E8] px-6 py-3">Total PEM</x-table-cell>
                        <x-table-cell position="left" class="bg-[#F5F5F5] px-6 py-3 font-semibold">{{ $student['total_pem'] }}</x-table-cell>
                    </x-table-row>
                </x-table-body>
            </x-table>
        </div>

        {{-- TOEFL --}}
        <div class="p-6">
            <div class="mb-4">
                <x-typography variant="body-medium-bold">
                    TOEFL
                </x-typography>
            </div>
            <x-container variant="content-grey" class="flex items-center justify-center">
                <x-typography variant="body-small-bold" class="text-center">
                    Belum Ada Data
                </x-typography>
            </x-container>
        </div>

        {{-- Loop per semester --}}
        @foreach($pem as $pemData)
        <div class="p-6">
            <div class="mb-4">
                <x-typography variant="body-medium-bold">
                    Daftar Keanggotaan {{ $pemData['organisasi'] ?? '' }}
                </x-typography>
            </div>     

            @if (!isset($pemData['kegiatan']) || empty($pemData['kegiatan']))
                <x-container variant="content-grey" class="flex items-center justify-center">
                    <x-typography variant="body-small-bold" class="text-center">
                        Belum Ada Data
                    </x-typography>
                </x-container>
            @else
            <x-table class="text-sm text-center">
                <x-table-head>
                <x-table-row>
                    <x-table-header>Semester</x-table-header>
                    <x-table-header>Nama Kegiatan</x-table-header>
                    <x-table-header>Jabatan</x-table-header>
                    <x-table-header>Status</x-table-header>
                    <x-table-header>Nilai</x-table-header>
                </x-table-row>
                </x-table-head>

                <x-table-body>
                @foreach($pemData['kegiatan'] as $row)
                    <x-table-row>
                    <x-table-cell>{{ $row['semester'] }}</x-table-cell>
                    <x-table-cell>{{ $row['nama'] }}</x-table-cell>
                    <x-table-cell>{{ $row['jabatan'] }}</x-table-cell>
                    <x-table-cell>{{ $row['status'] }}</x-table-cell>
                    <x-table-cell>{{ $row['nilai'] ?? '-' }}</x-table-cell>
                    </x-table-row>
                @endforeach
                </x-table-body>
            </x-table>
            @endif
        </div>
        @endforeach

    </div>

    {{-- Tombol --}}
    <div class="p-6">
        <x-container variant="content">
            <x-button.primary wireClick="printPem" href="javascript:window.print()">
                Cetak
            </x-button.primary>
        </x-container>
    </div>

    {{-- Pagination --}}
    @include('partials.pagination', [
            'currentPage' => 1,
            'lastPage' => 10,
            'limit' => 3,
            'routes' => '',
        ])
</div>


</div>
@endsection
