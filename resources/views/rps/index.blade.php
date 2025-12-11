@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Semester)')

<script src="{{ asset('js/controllers/rps.js') }}" defer></script>

@section('content')
    <div x-data="rps()">
        <x-container.wrapper :gapY="4" :rows="15">
            <x-container.container class="row-start-1 row-end-2">
                <x-typography variant="body-large-semibold">Buat RPS (Rencana Pembelajaran Semester)</x-typography>
            </x-container.container>
            <x-container.container :background="'content-white'" :padding="'p-5'" class="row-start-2 row-end-16 flex-col"
                :gap="'gap-5'">
                <x-container.wrapper :rows="3" height="fitContent" :gapY="3" :padding="'p-0'">
                    <x-form.input-container>
                        <x-slot name="label">Periode Akademik</x-slot>
                        <x-slot name="input">
                            <x-dropdown.periode-akademik x-model="periode"></x-dropdown.periode-akademik>
                        </x-slot>
                    </x-form.input-container>
                    <x-form.input-container>
                        <x-slot name="label">Program Studi</x-slot>
                        <x-slot name="input">
                            <x-form.dropdown variant="gray" buttonId="dropdownProdiButton" dropdownId="dropdownProdiList"
                                dropdownContainerClass="w-full" label="-Pilih Program Studi-" :dropdownItem="$prodiList"
                                x-model="prodi" />
                        </x-slot>
                    </x-form.input-container>
                    <x-form.input-container inputClass="flex flex-row gap-3">
                        <x-slot name="label">Mata Kuliah</x-slot>
                        <x-slot name="input">
                            <x-form.dropdown variant="gray" buttonId="dropdownMatkulButton" dropdownId="dropdownMatkulList"
                                label="-Pilih Mata Kuliah-" :dropdownItem="$matkulList" dropdownContainerClass="w-full"
                                x-model="mata_kuliah" />
                            <x-button variant="primary">Cari</x-button>
                        </x-slot>
                    </x-form.input-container>
                </x-container.wrapper>
                <x-dialog variant="warning" isCloseable>
                    <x-slot name="header">Catatan!</x-slot>
                    Aksi Salin : Menyalin data RPS yang dipilih, akan ditambahkan ke row baru (paling bawah) <br> <br>
                    *Dosen harus merubah periode <b>(sesuai dengan periode yang sedang berjalan atau periode selanjutnya.
                        <br>
                        Tidak muncul pilihan periode yg sama dengan RPS yang di salin sebelumnya)</b>
                </x-dialog>
                <x-table.index>
                    <x-table.head>
                        <x-table.row>
                            <x-table.header-cell>No</x-table.header-cell>
                            <x-table.header-cell>Mata Kuliah</x-table.header-cell>
                            <x-table.header-cell>Dosen Pengampu</x-table.header-cell>
                            <x-table.header-cell>Review Status</x-table.header-cell>
                            <x-table.header-cell>Status</x-table.header-cell>
                            <x-table.header-cell>Tanggal Upload</x-table.header-cell>
                            <x-table.header-cell>Status</x-table.header-cell>
                        </x-table.row>
                    </x-table.head>

                    <x-table.body>
                        @foreach ($rpsList as $index => $rps)
                            <x-table.row :odd="$index % 2 === 1" :last="$loop->last">
                                <x-table.cell text_size="text-xs">{{ $index + 1 }}</x-table.cell>
                                <x-table.cell text_size="text-xs">{{ $rps['mata_kuliah'] }}</x-table.cell>
                                <x-table.cell text_size="text-xs">{{ $rps['dosen'] }}</x-table.cell>
                                <x-table.cell>
                                    <x-button.link variant="caption-regular"> {{ $rps['review_status'] }}</x-button.link>
                                </x-table.cell>
                                <x-table.cell>
                                    @if ($rps['status'] === 'Finalized')
                                        <x-badge variant="green-filled">Finalized</x-badge>
                                    @endif
                                </x-table.cell>
                                <x-table.cell text_size="text-xs">{{ $rps['tanggal_upload'] }}</x-table.cell>
                                <x-table.cell>
                                    <div class="flex-nowrap inline-flex gap-3">
                                        <x-button.base :icon="'copy/black-16'" iconPosition="left" sizeText="caption-regular">
                                            Salin
                                        </x-button.base>
                                        <x-button.base :icon="'edit/red-16'" iconPosition="left" class="text-red-500"
                                            sizeText="caption-regular">
                                            Ubah
                                        </x-button.base>
                                    </div>

                                </x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-table.body>
                </x-table.index>

                <div class="flex mt-5 justify-end gap-2">
                    <x-button.secondary iconPosition="right" :icon="'upload/red-16'">
                        Unggah RPS
                    </x-button.secondary>
                    <x-button.primary :href="route('rps.deskripsi-umum')">Tambah RPS</x-button.primary>
                </div>
            </x-container.container>
        </x-container.wrapper>
    </div>

@endsection
