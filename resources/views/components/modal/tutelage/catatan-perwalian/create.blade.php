@props([])

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
        <x-form.input-container>
            <x-slot name="label">Catatan Perwalian</x-slot>
            <x-slot name="input">
                <x-form.input name="nip" placeholder="Masukkan Nomor Induk" />
            </x-slot>
        </x-form.input-container>
    </div>
    <x-slot name="footer" class="flex gap-5 justify-end">
        <x-button variant="secondary" @click="close()">Batal</x-button>
        <x-button variant="primary">Simpan</x-button>
    </x-slot>
</x-modal.container>
