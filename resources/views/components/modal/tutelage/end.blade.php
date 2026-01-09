<div div x-data="{ dosen: '' }" x-on:open-modal.window="if($event.detail.id === 'end-perwalian') dosen = $event.detail.dosen">
    <x-modal.container id="end-perwalian">
        <x-slot name="header" class="items-center bg-gray-200">
            <div class="modal-header-wrapper">
                <x-typography variant="heading-h5">Akhiri Kelompok Perwalian</x-typography>
                <button x-on:click.stop="close()" class="modal-close-btn">
                    <x-icon :name="'delete/black-24'" />
                </button>
            </div>
        </x-slot>
        <div class="text-center">
             Apakah anda yakin untuk mengakhiri kelompok perwalian <b x-text="dosen"></b>?
        </div>
        <x-slot name="footer" class="flex gap-4">
            <x-button variant="secondary" @click="close()" buttonClass="w-full!">Batal</x-button>
            <x-button variant="primary" buttonClass="w-full!">Akhiri Perwalian</x-button>
        </x-slot>
    </x-modal.container>
</div>
