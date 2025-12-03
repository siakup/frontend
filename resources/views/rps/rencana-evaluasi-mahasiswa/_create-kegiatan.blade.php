<x-modal.container id="create-kegiatan" maxWidth="6xl">
    <x-slot name="header" class="items-center bg-gray-200">
        <div class="w-full relative flex items-center justify-center">
            <x-typography variant="heading-h5">Tambah Jadwal Pelaksanaan</x-typography>
            <button x-on:click.stop="close()"
                class="absolute right-0">
                <x-icon iconUrl="{{ asset('assets/base/icon-close-cancel.svg') }}" class="h-6 w-6"/>
            </button>
        </div>
    </x-slot>
    <x-container.container class="flex flex-col gap-4" borderRadius="rounded-lg">
        <x-form.input-container labelClass="w-50">
            <x-slot name="label">Nama Kegiatan</x-slot>
            <x-slot name="input">
                <x-form.input
                    name="nama_kegiatan"
                    placeholder="Masukkan Nama Kegiatan"
                />
            </x-slot>
        </x-form.input-container>
        <x-form.input-container labelClass="w-50">
            <x-slot name="label">Pelaksanaan Kegiatan</x-slot>
            <x-slot name="input">
                <div class="grid grid-cols-2 gap-2">
                @for ($i = 1; $i <= 16; $i++)
                    <x-form.checklist id="minggu-{{ $i }}" value="minggu-{{ $i }}" label="Minggu ke-{{ $i }}" name="minggu-{{ $i }}"/>
                @endfor
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