@extends('layouts.main')

@section('title', 'Kelas Perkuliahan')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Kelas Perkuliahan</div>
@endsection

{{-- <script src="{{ asset('js/controllers/rps.js') }}" defer></script> --}}

@section('content')
    <div class="page-header pl-5">
        <x-typography variant="heading-h6">Kelas Perkuliahan</x-typography>
    </div>
    <x-container variant="content" class="ml-3">
        <x-container variant="content-wrapper">
            <x-form.input-container labelClass="w-[200px]">
                <x-slot name="label">Program Studi</x-slot>
                <x-slot name="input">
                    <x-form.dropdown variant="gray" buttonId="dropdownProdiButton" dropdownId="dropdownProdiList"
                        label="-Pilih Program Studi-" buttonStyleClass="text-sm" x-model="prodi" :dropdownItem="$prodiList"
                        :imgSrc="asset('assets/icon-arrow-down-grey-20.svg')" :isIconCanRotate="true" />
                </x-slot>
            </x-form.input-container>
            <x-form.input-container labelClass="w-[200px]">
                <x-slot name="label">Program Perkuliahan</x-slot>
                <x-slot name="input">
                    <x-form.dropdown variant="gray" buttonId="dropdownProdiButton" dropdownId="dropdownProdiList"
                        label="-Pilih Program Studi-" buttonStyleClass="text-sm" x-model="prodi" :dropdownItem="$prodiList"
                        :imgSrc="asset('assets/icon-arrow-down-grey-20.svg')" :isIconCanRotate="true" />
                </x-slot>
            </x-form.input-container>
            <x-form.input-container labelClass="w-[200px]" inputClass="flex flex-row gap-3">
                <x-slot name="label">Periode Akademik</x-slot>
                <x-slot name="input">
                    <x-form.dropdown variant="gray" buttonId="dropdownPeriodeRpsButton" dropdownId="dropdownPeriodeRpsList"
                        label="-Pilih Periode Akademik-" :dropdownItem="$periodeList" buttonStyleClass="text-sm" :imgSrc="asset('assets/icon-arrow-down-grey-20.svg')"
                        :isIconCanRotate="true" x-model="periode" />
                    <x-button.primary>Cari</x-button.primary>
                </x-slot>
            </x-form.input-container>
        </x-container>

        <x-dialog variant="grey">
            <div class="flex flex-col">

                <x-typography variant="body-small-bold">Keterangan Status Operasi</x-typography>
                <x-typography variant="body-small-regular">Tombol Operasi</x-typography>
                <x-typography variant="body-small-bold">Sesi Perkuliahan</x-typography>
                <x-typography variant="body-small-regular">Tombol Operasi</x-typography>
                <x-typography variant="body-small-bold">Komponen Penilaian</x-typography>
                <x-typography variant="body-small-regular">Tombol Operasi</x-typography>
                <x-typography variant="body-small-bold">Peserta Kelas</x-typography>
                <x-typography variant="body-small-regular">Tombol Operasi</x-typography>
                <x-typography variant="body-small-bold">Nilai Reevaluasi</x-typography>
            </div>
        </x-dialog>

        <x-table>
            <x-table-head>
                <x-table-row>
                    <x-table-header>Nama Kelas</x-table-header>
                    <x-table-header>Kode Mata Ajar</x-table-header>
                    <x-table-header>Nama Mata Ajar</x-table-header>
                    <x-table-header>Peserta/Disetujui/Kapasitas</x-table-header>
                    <x-table-header>Operasi</x-table-header>
                    <x-table-header>Status</x-table-header>
                    <x-table-header>Publish/Unpublish Upload</x-table-header>
                </x-table-row>
            </x-table-head>

            <x-table-body>
                <x-table-row>
                    <x-table-cell text_size="text-xs">
                        Bahasa Inggris II - CS2 -2023
                    </x-table-cell>
                    <x-table-cell text_size="text-xs">
                        101103
                    </x-table-cell>
                    <x-table-cell text_size="text-xs">
                        Nama Mata Ajar
                    </x-table-cell>
                    <x-table-cell text_size="text-xs">
                        58/55/58
                    </x-table-cell>
                    <x-table-cell>
                        <x-button.primary iconPosition="right" icon="{{ asset('assets/icons/schedule/white-20.svg') }}" />
                        <x-button.primary iconPosition="right" icon="{{ asset('assets/icons/grade/white-20.svg') }}" />
                        <x-button.primary iconPosition="right"
                            icon="{{ asset('assets/icons/guidance-counseling/white-20.svg') }}" />
                        <x-button.primary iconPosition="right" icon="{{ asset('assets/icons/compliment/white-20.svg') }}" />
                    </x-table-cell>
                    <x-table-cell text_size="text-xs">
                        Sudah Publish
                    </x-table-cell>
                    <x-table-cell text_size="text-xs">
                        <x-button.base :icon="asset('assets/icons/circle-remove/red-20.svg')" iconPosition="left" class="text-red-500"
                            sizeText="caption-regular">
                        </x-button.base>
                    </x-table-cell>
                </x-table-row>
            </x-table-body>
        </x-table>

        <div class="flex mt-5 justify-end gap-2">
            <x-button.primary iconPosition="right" icon="{{ asset('assets/icons/schedule/white-20.svg') }}">
                Impor Kelas
            </x-button.primary>
            <x-button.primary :href="route('rps.deskripsi-umum')">Import Sesi</x-button.primary>
        </div>
    </x-container>
    <div class="ml-20">
        @include('partials.pagination', [
            'currentPage' => 1,
            'lastPage' => 10,
            'limit' => 3,
            'routes' => '',
        ])
    </div>

@endsection
