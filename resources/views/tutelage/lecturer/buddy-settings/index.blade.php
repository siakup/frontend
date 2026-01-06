<x-layouts.main>
    @section('title', 'Kelompok Perwalian')
    <x-layouts.content title="Kelompok Perwalian - Nama Dosen">

        <x-container.container class="flex-col" height="full" x-data="{ periode: '', tahun_masuk: '', status_buddy: '', buddy: [] }">
            @include('tutelage.lecturer.layout.navbar')
            <x-container.container background="content-under-navbar" height="full">
                <x-typography variant="body-large-bold">Pengaturan Buddy</x-typography>
                <x-form.input-container>
                    <x-slot name="label">Periode Akademik</x-slot>
                    <x-slot name="input">
                        <x-dropdown.periode-akademik x-model="periode"></x-dropdown.periode-akademik>
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container>
                    <x-slot name="label">Tahun Masuk</x-slot>
                    <x-slot name="input">
                        <x-dropdown.tahun-masuk x-model="tahun_masuk" />
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container inputClass="flex flex-row gap-3">
                    <x-slot name="label">Status Buddy </x-slot>
                    <x-slot name="input">
                        <x-dropdown.status-buddy x-model="status_buddy" />
                        <x-button variant="primary" buttonClass="min-w-38">Filter</x-button>
                    </x-slot>
                </x-form.input-container>
                <x-dialog variant="warning" isCloseable>
                    <x-slot name="header">Informasi!</x-slot>
                    Ada <b>20</b> mahasiswa yang <b>belum</b> memiliki buddy.
                </x-dialog>
                <x-table.index>
                    <x-table.head>
                        <x-table.row>
                            <x-table.header-cell>NIM</x-table.header-cell>
                            <x-table.header-cell>Nama Mahasiswa</x-table.header-cell>
                            <x-table.header-cell>Institusi</x-table.header-cell>
                            <x-table.header-cell>Buddy</x-table.header-cell>
                        </x-table.row>
                    </x-table.head>
                    <x-table.body>
                        @foreach ($dataPeserta as $index => $peserta)
                            <x-table.row>
                                <x-table.cell>{{ $peserta->nim }}</x-table.cell>
                                <x-table.cell>{{ $peserta->nama }}</x-table.cell>
                                <x-table.cell>{{ $peserta->institusi }}</x-table.cell>
                                <x-table.cell>
                                    <x-form.dropdown label="---Pilih Buddy---" buttonId="buttonBuddy"
                                        dropdownId="dropdownBuddy" variant="gray" :dropdownItem="$dataMahasiswa"
                                        x-model="buddy[{{ $index }}]" x-init="buddy[{{ $index }}] ??= ''" />
                                </x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-table.body>
                </x-table.index>
                <div class="flex mt-2 justify-end gap-5">
                    <x-button variant="secondary" x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})">Batalkan Perubahan
                    </x-button>
                    <x-button variant="primary" x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})">Simpan
                        Perubahan</x-button>
                </div>
            </x-container.container>
        </x-container.container>

    </x-layouts.content>
    @section('modals')
        <x-modal.confirmation id="save-confirmation" title="Tunggu Sebentar" confirmText="Ya, Simpan Sekarang"
            cancelText="Cek Kembali">
            Apakah Anda yakin ingin menyimpan perubahan ini?
        </x-modal.confirmation>
        <x-modal.confirmation id="back-confirmation" title="Tunggu Sebentar" confirmText="Ya, Batalkan"
            cancelText="Tidak, Kembali">
            Apakah Anda yakin ingin membatalkan perubahan ini?
        </x-modal.confirmation>
    @endsection
</x-layouts.main>
