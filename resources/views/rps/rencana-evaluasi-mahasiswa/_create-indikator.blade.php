<x-modal.container id="create-indikator" maxWidth="6xl">
    <x-slot name="header" class="items-center bg-gray-200">
        <div class="w-full relative flex items-center justify-center">
            <x-typography variant="heading-h5">Tambah Indikator, Kriteria, dan Bobot Penilaian</x-typography>
            <button x-on:click.stop="close()"
                class="absolute right-0">
                <x-icon iconUrl="{{ asset('assets/base/icon-close-cancel.svg') }}" class="h-6 w-6"/>
            </button>
        </div>
    </x-slot>
    <x-container.container class="flex flex-col gap-4" borderRadius="rounded-lg">
        <x-form.input-container labelClass="w-50">
            <x-slot name="label">Indikator dan Kriteria</x-slot>
            <x-slot name="input">
                <x-form.textarea
                    id="indikator"
                    maxChar="100"
                    rows="5"
                    placeholder="Masukkan Indikator dan Kriteria"
                />
            </x-slot>
        </x-form.input-container>
        <x-form.input-container labelClass="w-50">
            <x-slot name="label">Bobot Penilaian</x-slot>
            <x-slot name="input">
                <div class="flex items-center">
                    <x-form.input
                        name="bobot_penilaian"
                        placeholder="Contoh: 30.00"
                        type="number"
                        inputClass="!rounded-r-none !border-r-0"
                    />
                    <div class="-ml-1 border border border-gray-500 rounded-r-lg bg-gray-300 w-10 h-10.5 flex items-center justify-center text-gray-600 text-sm">
                        %
                    </div>
                </div>
            </x-slot>
            </x-form.input-container>
    </x-container>
    <x-slot name="footer">
        <div class="flex mt-5 justify-end gap-2">
            <x-button.secondary x-on:click="close()">Batal</x-button.secondary>
            <x-button.primary x-on:click="close()">Simpan</x-button.primary>
        </div>
    </x-slot>
</x-modal.container>