@props([
    'dataPerwalian' => null,
    'dataMahasiswa' => null,
])

<x-modal.container id="create-catatan-perwalian" maxWidth="6xl">
    <x-slot name="header" class="items-center bg-gray-200">
        <div class="modal-header-wrapper">
            <x-typography variant="heading-h5">Tambah Catatan Perwalian</x-typography>
            <button x-on:click.stop="close()" class="modal-close-btn">
                <x-icon :name="'close-cancel/black-24'" />
            </button>
        </div>
    </x-slot>
    <div class="flex flex-col gap-5">
        <x-table.index>
            <x-table.body>
                <x-table.row>
                    <x-table.header-cell variantColor="odd" position="left">Kelompok Perwalian</x-table.header-cell>
                    <x-table.cell variantColor="odd" position="left"
                        text_size="text-sm">{{ $dataPerwalian->kelompok_perwalian }}</x-table.cell>
                </x-table.row>
                <x-table.row>
                    <x-table.header-cell variantColor="even" position="left">Sesi Perwalian</x-table.header-cell>
                    <x-table.cell variantColor="even" position="left"
                        text_size="text-sm">{{ $dataPerwalian->sesi }}</x-table.cell>
                </x-table.row>
            </x-table.body>
        </x-table.index>
        <x-form.input-container>
            <x-slot name="label">Catatan Perwalian</x-slot>
            <x-slot name="input">
                <x-form.textarea name="catatan" id="catatan-perwalian" placeholder="Masukkan Catatan Perwalian Disini"
                    maxChar="100" rows="4" />
            </x-slot>
        </x-form.input-container>
        <x-form.input-container>
            <x-slot name="label">Unggah Catatan</x-slot>
            <x-slot name="input">
                <x-button :fileInput="true" label="Unggah File" variant="secondary" buttonClass="min-w-full"
                    icon="upload/red-20" />
            </x-slot>
        </x-form.input-container>
    </div>
    <x-slot name="footer" class="flex gap-5 justify-end">
        <x-button variant="secondary" @click="close()">Batal</x-button>
        <x-button variant="primary">Simpan</x-button>
    </x-slot>
</x-modal.container>
