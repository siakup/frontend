<x-modal.container id="create-kegiatan" maxWidth="6xl">
    <x-slot name="header" class="items-center bg-gray-200">
        <div class="modal-header-wrapper">
            <x-typography variant="heading-h5">Tambah Jadwal Pelaksanaan</x-typography>
            <button x-on:click.stop="close()" class="modal-close-btn">
                <x-icon :name="'close-cancel/black-24'"></x-icon>
            </button>
        </div>
    </x-slot>
    <div class="content-white flex-col p-4 gap-5 rounded-md">
        <x-form.input-container>
            <x-slot name="label">Nama Kegiatan</x-slot>
            <x-slot name="input">
                <x-form.input name="nama_kegiatan" placeholder="Masukkan Nama Kegiatan" />
            </x-slot>
        </x-form.input-container>
        <x-form.input-container>
            <x-slot name="label">Pelaksanaan Kegiatan</x-slot>
            <x-slot name="input">
                <div class="grid grid-cols-2 gap-2.5 w-full">
                    @for ($i = 1; $i <= 16; $i++)
                        <x-form.checklist id="minggu-{{ $i }}" value="minggu-{{ $i }}"
                            label="Minggu ke-{{ $i }}" name="minggu-{{ $i }}" />
                    @endfor
                </div>
            </x-slot>
        </x-form.input-container>
    </div>
    <x-slot name="footer" class="flex justify-end gap-4">
        <x-button variant="secondary" x-on:click="close()">Batal</x-button>
        <x-button variant="primary" x-on:click="close()">Simpan</x-button>
    </x-slot>
</x-modal.container>
