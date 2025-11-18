<script src="{{ asset('js/controllers/rpsCpmk.js') }}" defer></script>

<div x-data="cpmk()">
    <x-modal.container id="create-cpmk" maxWidth="6xl">
        <x-slot name="header" class="items-center bg-gray-200">
            <div class="w-full relative flex items-center justify-center">
                <x-typography variant="heading-h5">Tambah Capaian Pembelajaran Mata Kuliah</x-typography>
                <button x-on:click.stop="close()"
                    class="text-gray-400 hover:text-gray-500 focus:outline-none absolute right-0">
                    <x-icon iconUrl="{{ asset('assets/base/icon-close-cancel.svg') }}" class="h-6 w-6"/>
                </button>
            </div>
        </x-slot>
        <x-container class="!rounded-lg">
            <x-form.input-container labelClass="w-50">
                <x-slot name="label">Kode</x-slot>
                <x-slot  name="input">
                    <x-form.input
                        name="kode"
                        placeholder="Tulis Kode"
                        x-model="kode"
                    />
                </x-slot>
            </x-form.input-container>
            <x-form.input-container labelClass="w-50">
                <x-slot name="label">Deskripsi</x-slot>
                <x-slot  name="input">
                    <x-form.textarea
                        placeholder="Tulis Deskripsi"
                        id="deskripsi_cpmk"
                        :maxChar="100"
                        rows="5"
                        x-model="deskripsi"
                    />
                </x-slot>
            </x-form.input-container>
        </x-container>
        <x-slot name="footer" class="flex justify-end gap-3">
            <x-button.secondary x-bind:disabled="isDisabled" x-data x-on:click="close()">Batal</x-button.secondary>
            <x-button.primary 
                x-bind:disabled="isDisabled"
                x-on:click="
                    $dispatch('close-modal', { id: 'create-cpmk' });
                    $dispatch('open-modal', { id: 'save-confirmation' });
                "
            >
                Simpan
            </x-button.primary>
        </x-slot>

    </x-modal.container>

    <x-modal.confirmation 
            id="save-confirmation" 
            title="Tunggu Sebentar" 
            confirmText="Ya, Simpan Sekarang"
            cancelText="Cek Kembali"
        >
            <p>Apakah Anda yakin informasi yang ditambahkan sudah benar?</p>
    </x-modal.confirmation>
</div>
