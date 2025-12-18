@props([
    'data' => null,
])
<div x-data="{ tahun: 2021, nama: '', nim: '', selectAll: false }">
    <x-modal.container id="create-mahasiswa-bimbingan" maxWidth="6xl">
        <x-slot name="header" class="items-center bg-gray-200">
            <div class="modal-header-wrapper">
                <x-typography variant="heading-h5">Tambah Mahasiswa Bimbingan</x-typography>
                <button x-on:click.stop="close()" class="modal-close-btn">
                    <x-icon :name="'close-cancel/black-24'" />
                </button>
            </div>
        </x-slot>
        <div class="flex flex-col gap-5">
            <x-form.input-container>
                <x-slot name="label">Tahun Masuk</x-slot>
                <x-slot name="input">
                    <x-form.input name="tahun" x-model="tahun" :disabled="true" />
                    {{-- kenapa harus dropdown??? --}}
                </x-slot>
            </x-form.input-container>
            <x-form.input-container>
                <x-slot name="label">Nama Lengkap</x-slot>
                <x-slot name="input">
                    <x-form.input name="nama" x-model="nama" placeholder="Masukkan Nama Lengkap" />
                </x-slot>
            </x-form.input-container>
            <x-form.input-container inputClass="flex flex-row gap-3">
                <x-slot name="label">Nomor Induk Mahasiswa</x-slot>
                <x-slot name="input">
                    <x-form.input name="nama" placeholder="Masukkan Nomor Induk Mahasiswa" x-model="nim" />
                    <x-button variant="primary" buttonClass="min-w-40!">Cari</x-button>
                </x-slot>
            </x-form.input-container>
            <x-dialog variant="warning">
                <x-slot name="header">Perhatian!</x-slot>
                Berikut list mahasiswa berdasarkan <b>program studi</b> yang dipilih sebelumnya dan yang belum memiliki
                <b>kelompok perwalian</b>
            </x-dialog>

            <x-table.index>
                <x-table.head>
                    <x-table.row>
                        <x-table.header-cell class="w-13">
                            <x-form.checklist id="select-all" label="" value="" name="select-all"
                                containerClass="inline-flex" x-model="selectAll" />
                        </x-table.header-cell>
                        <x-table.header-cell>Nomor Induk Mahasiswa</x-table.header-cell>
                        <x-table.header-cell>Nama Mahasiswa</x-table.header-cell>
                    </x-table.row>
                </x-table.head>
                <x-table.body>
                    @foreach ($data as $index => $list)
                        <x-table.row>
                            <x-table.cell>
                                <x-form.checklist id="{{ $index }}" name="select" x-model="selected"
                                    containerClass="inline-flex" :value="$index" />
                            </x-table.cell>
                            <x-table.cell>{{ $list->nim }}</x-table.cell>
                            <x-table.cell>{{ $list->nama }}</x-table.cell>
                        </x-table.row>
                    @endforeach
                </x-table.body>
            </x-table.index>
        </div>
        <x-slot name="footer" class="flex gap-5 justify-end">
            <x-button variant="secondary" @click="close()">Batal</x-button>
            <x-button variant="primary">Simpan</x-button>
        </x-slot>
    </x-modal.container>

</div>
