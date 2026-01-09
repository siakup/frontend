<x-modal.container id="delete-matriks-penilaian">
    <x-slot name="header" class="items-center bg-[#F5F5F5]">
        <div class="modal-header-wrapper">
            <x-typography variant="heading-h5">Hapus Matriks Penilaian</x-typography>
            <button x-on:click.stop="close()"
                class="modal-close-btn">
                <x-icon :name="'delete/black-24'"></x-icon>
            </button>
        </div>
    </x-slot>
    <x-typography variant="body-small-regular" class="text-center">
    Apakah Anda yakin ingin menghapus matriks penilaian kognitif ini?
    </x-typography>
    <x-slot name="footer">
        <div class="w-full flex justify-center gap-4">
            <x-button variant="secondary" buttonClass="modal-btn-action"  x-on:click="$dispatch('close-modal', { id: 'delete-matriks-penilaian' })">Batal</x-button>
            <x-button 
                x-on:click="close()"
                buttonClass="modal-btn-action" 
                variant="primary"
            >
                Simpan
            </x-button>
        </div>
    </x-slot>
</x-modal.container>