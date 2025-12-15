@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Dosen)')

@section('content')
    <x-container.wrapper :rows="15" :gapY="4">
        <x-typography variant="heading-h6">Buat RPS (Rencana Pembelajaran Dosen)</x-typography>
        <x-button.back href="{{ route('rps.index') }}">RPS (Rencana Pembelajaran Semester)</x-button.back>
        <x-container.container class="flex-col">
            @include('rps.layout.navbar-rps')
            <x-container.container x-data :background="'content-under-navbar'">
                <x-typography variant="body-medium-bold">Capaian Pembelajaran (CP)</x-typography>

                {{-- Capaian Pembelajaran Lulusan --}}
                <x-typography variant="body-small-semibold" class="mt-2">Capaian Pembelajaran Lulusan (CPL)</x-typography>
                <x-table.index>
                    <x-table.head>
                        <x-table.row>
                            <x-table.header-cell>CPL</x-table.header-cell>
                            <x-table.header-cell>Deskripsi</x-table.header-cell>
                        </x-table.row>
                    </x-table.head>

                    <x-table.body>
                        @foreach ($cplList as $index => $cpl)
                            <x-table.row :odd="$index % 2 === 0">
                                <x-table.cell>{{ $cpl['cpl'] }}</x-table.cell>
                                <x-table.cell position="left">{{ $cpl['deskripsi'] }}</x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-table.body>
                </x-table.index>
                <div class="flex justify-end">
                    <x-button.primary :href="route('rps.capaian-pembelajaran.create')">Tambah CPL</x-button.primary>
                </div>

                {{-- Capaian Pembelajaran Mata Kuliah --}}
                <x-typography variant="body-small-semibold" class="mt-2">Capaian Pembelajaran Mata Kuliah
                    (CPMK)</x-typography>
                <x-table.index>
                    <x-table.head>
                        <x-table.row>
                            <x-table.header-cell class="w-50">CPMK</x-table.header-cell>
                            <x-table.header-cell>Deskripsi</x-table.header-cell>
                        </x-table.row>
                    </x-table.head>

                    <x-table.body>
                        @foreach ($cpmkList as $index => $cpmk)
                            <x-table.row :odd="$index % 2 === 0" :last="$loop->last">
                                <x-table.cell>{{ $cpmk['cpmk'] }}</x-table.cell>
                                <x-table.cell position="left">{{ $cpmk['deskripsi'] }}</x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-table.body>
                </x-table.index>
                <div class="flex justify-end">
                    <x-button.primary x-data x-on:click="$dispatch('open-modal', {id: 'create-cpmk'})">Tambah
                        CPMK</x-button.primary>
                </div>

                <div class="flex mt-5 justify-end gap-2">
                    <x-button.secondary>Batal</x-button.secondary>
                    <x-button.primary x-data
                        x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})">Simpan</x-button.primary>
                </div>
            </x-container.container>
        </x-container.container>
    </x-container.wrapper>

    @include('rps.capaian-pembelajaran._modal-create-cpmk')

    <x-modal.confirmation id="save-confirmation" title="Tunggu Sebentar" confirmText="Ya, Simpan Sekarang"
        cancelText="Cek Kembali" :redirectConfirm="route('rps.komponen-penilaian')">
        <p>Apakah Anda yakin informasi yang ditambahkan sudah benar?</p>
    </x-modal.confirmation>

@endsection
