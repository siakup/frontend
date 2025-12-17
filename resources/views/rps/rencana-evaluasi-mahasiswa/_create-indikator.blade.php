<x-modal.container id="create-indikator" maxWidth="6xl">
    <x-slot name="header" class="items-center bg-gray-200">
        <div class="modal-header-wrapper">
            <x-typography variant="heading-h5">Tambah Indikator, Kriteria, dan Bobot Penilaian</x-typography>
            <button x-on:click.stop="close()" class="modal-close-btn">
                <x-icon :name="'close-cancel/black-24'"></x-icon>
            </button>
        </div>
    </x-slot>
    <div class="content-white flex-col p-4 gap-4 rounded-md">
        <x-form.input-container>
            <x-slot name="label">Indikator dan Kriteria</x-slot>
            <x-slot name="input">
                <x-form.textarea id="indikator" maxChar="100" rows="5"
                    placeholder="Masukkan Indikator dan Kriteria" />
            </x-slot>
        </x-form.input-container>
        <x-form.input-container>
            <x-slot name="label">Bobot Penilaian</x-slot>
            <x-slot name="input">
                <div class="flex w-full">
                    <x-form.input name="bobot_penilaian" placeholder="Contoh: 30.00" type="number" />
                    <div
                        class="-ml-10 border border-gray-500 rounded-r-md bg-gray-300 w-10 h-10.5 flex items-center justify-center text-gray-600 text-sm">
                        %
                    </div>
                </div>
            </x-slot>
        </x-form.input-container>
    </div>
    <x-slot name="footer" class="flex justify-end gap-4">
        <x-button variant="secondary" x-on:click="close()">Batal</x-button>
        <x-button variant="primary" x-on:click="close()">Simpan</x-button>
    </x-slot>
</x-modal.container>
