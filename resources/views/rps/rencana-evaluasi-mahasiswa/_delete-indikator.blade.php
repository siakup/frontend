<x-modal.container id="delete-indikator">
    <x-slot name="header" class="items-center bg-gray-200">
        <div class="w-full relative flex items-center justify-center">
            <x-typography variant="heading-h5">Hapus Indikator dan Kriteria</x-typography>
            <button x-on:click.stop="close()"
                class="text-gray-400 hover:text-gray-500 focus:outline-none absolute right-0">
                <x-icon iconUrl="{{ asset('assets/icons/delete/black-24.svg') }}"/>
            </button>
        </div>
    </x-slot>
    <x-typography variant="body-small-regular" class="text-center">
       <p>Apakah Anda yakin ingin menghapus indikator, kriteria, dan bobot penilaian ini?</p>
    </x-typography>
    <x-slot name="footer">
        <div class="flex justify-center gap-3 w-full">
            <x-button.secondary class="w-full" x-on:click="close()">Batal</x-button.secondary>
            <x-button.primary 
                x-on:click="close()"
                class="!w-full"
            >
                Hapus
            </x-button.primary>
        </div>
    </x-slot>
</x-modal.container>