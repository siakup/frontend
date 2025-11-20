@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Semester)')

@section('breadcrumbs')
    <div class="breadcrumb-item active">RPS</div>
@endsection

<script src="{{ asset('js/controllers/rps.js') }}" defer></script>

@section('content')
    <div class="page-header pl-5">
        <x-typography variant="heading-h6">Buat RPS (Rencana Pembelajaran Semester)</x-typography>
    </div>
    <x-container variant="content" class="ml-3" x-data="rps()">
        <x-container variant="content-wrapper" class="mb-5">
            <x-form.input-container labelClass="w-50">
                <x-slot name="label">Periode</x-slot>
                <x-slot name="input">
                    <x-form.dropdown
                        variant="gray"
                        buttonId="dropdownPeriodeRpsButton"
                        dropdownId="dropdownPeriodeRpsList"
                        label="-Pilih Periode Akademik-"
                        :dropdownItem="$periodeList"
                        buttonStyleClass="text-sm"
                        :imgSrc="asset('assets/icons/arrow-down/grey-20.svg')"
                        :isIconCanRotate="true"
                        x-model="periode"
                    />
                </x-slot>
            </x-form.input-container>
            <x-form.input-container labelClass="w-50">
                <x-slot name="label">Program Studi</x-slot>
                <x-slot name="input">
                    <x-form.dropdown
                        variant="gray"
                        buttonId="dropdownProdiButton"
                        dropdownId="dropdownProdiList"
                        label="-Pilih Program Studi-"
                        :dropdownItem="$prodiList"
                        buttonStyleClass="text-sm"
                        :imgSrc="asset('assets/icons/arrow-down/grey-20.svg')"
                        :isIconCanRotate="true"
                        x-model="prodi"
                    />
                </x-slot>
            </x-form.input-container>
            <x-form.input-container labelClass="w-50" inputClass="flex flex-row gap-3">
                <x-slot name="label">Mata Kuliah</x-slot>
                <x-slot name="input">
                    <x-form.dropdown
                        variant="gray"
                        buttonId="dropdownMatkulButton"
                        dropdownId="dropdownMatkulList"
                        label="-Pilih Mata Kuliah-"
                        :dropdownItem="$matkulList"
                        buttonStyleClass="text-sm"
                        dropdownContainerClass="w-full"
                        :imgSrc="asset('assets/icons/arrow-down/grey-20.svg')"
                        :isIconCanRotate="true"
                        x-model="mata_kuliah"
                    />
                    <x-button.primary>Cari</x-button.primary>
                </x-slot>
            </x-form.input-container>
        </x-container>
        <x-dialog variant="warning" isCloseable>
            <x-slot name="header">Catatan!</x-slot>
            Aksi Salin : Menyalin data RPS yang dipilih, akan ditambahkan ke row baru (paling bawah) <br> <br>
            *Dosen harus merubah periode <b>(sesuai dengan periode yang sedang berjalan atau periode selanjutnya. <br>
            Tidak muncul pilihan periode yg sama dengan RPS yang di salin sebelumnya)</b>
        </x-dialog>
        <x-table>
            <x-table-head>
                <x-table-row>
                    <x-table-header>No</x-table-header>
                    <x-table-header>Mata Kuliah</x-table-header>
                    <x-table-header>Dosen Pengampu</x-table-header>
                    <x-table-header>Review Status</x-table-header>
                    <x-table-header>Status</x-table-header>
                    <x-table-header>Tanggal Upload</x-table-header>
                    <x-table-header>Status</x-table-header>
                </x-table-row>
            </x-table-head>

            <x-table-body>
                @foreach($rpsList as $index => $rps)
                <x-table-row :odd="$index % 2 === 1" :last="$loop->last">
                    <x-table-cell text_size="text-xs">{{ $index + 1 }}</x-table-cell>
                    <x-table-cell text_size="text-xs">{{ $rps['mata_kuliah'] }}</x-table-cell>
                    <x-table-cell text_size="text-xs">{{ $rps['dosen'] }}</x-table-cell>
                    <x-table-cell>
                        <x-button.link variant="caption-regular"> {{ $rps['review_status'] }}</x-button.link> 
                    </x-table-cell>
                    <x-table-cell>
                        @if($rps['status']==='Finalized')
                            <x-badge variant="green-filled">Finalized</x-badge>
                        @endif
                    </x-table-cell>
                    <x-table-cell text_size="text-xs">{{ $rps['tanggal_upload'] }}</x-table-cell>
                    <x-table-cell>
                        <div class="flex flex-nowrap inline-flex gap-3">
                            <x-button.base 
                                :icon="asset('assets/icons/copy/black-16.svg')"
                                iconPosition="left"
                                sizeText="caption-regular"
                            >
                                Salin
                            </x-button.base>
                            <x-button.base 
                                :icon="asset('assets/icons/edit/red-16.svg')"
                                iconPosition="left"
                                class="text-red-500"
                                sizeText="caption-regular"
                            >
                                Ubah
                            </x-button.base>
                        </div>
                            
                    </x-table-cell>
                </x-table-row>
                @endforeach
            </x-table-body>
        </x-table>

        <div class="flex mt-5 justify-end gap-2">
            <x-button.secondary iconPosition="right" icon="{{asset('assets/icons/upload/red-20.svg')}}">
                Unggah RPS
            </x-button.secondary>
            <x-button.primary :href="route('rps.deskripsi-umum')">Tambah RPS</x-button.primary>
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
