<x-modal.container id="delete-matriks-penilaian">
    <x-slot name="header" class="items-center bg-[#F5F5F5]">
        <div class="w-full relative flex items-center justify-center">
            <x-typography variant="heading-h5">Hapus Matriks Penilaian</x-typography>
            <button x-on:click.stop="close()"
                class="text-gray-400 hover:text-gray-500 focus:outline-none absolute right-0">
                <x-icon iconUrl="{{ asset('assets/base/icon-delete.svg') }}" class="h-[24px] w-[24px]"/>
            </button>
        </div>
    </x-slot>
    <x-typography variant="body-small-regular" class="text-center">
       <p>Apakah Anda yakin ingin menghapus matriks penilaian kognitif ini?</p> 
    </x-typography>
    <x-slot name="footer">
        <div class="flex justify-center gap-3 w-full">
            <x-button.secondary class="w-full" x-on:click="$dispatch('close-modal', { id: 'delete-matriks-penilaian' })">Batal</x-button.secondary>
            <x-button.primary 
                x-on:click="close()"
                class="w-full"
            >
                Simpan
            </x-button.primary>
        </div>
    </x-slot>
</x-modal.container>