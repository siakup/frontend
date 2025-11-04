<x-modal.container id="create-cpmk" maxWidth="6xl">
    <x-slot name="header" class="items-center bg-[#F5F5F5]">
        <div class="w-full relative flex items-center justify-center">
            <x-typography variant="heading-h5">Tambah Capaian Pembelajaran Mata Kuliah</x-typography>
            <button x-on:click.stop="close()"
                class="text-gray-400 hover:text-gray-500 focus:outline-none absolute right-0">
                <x-icon iconUrl="{{ asset('assets/base/icon-close-cancel.svg') }}" class="h-[24px] w-[24px]"/>
            </button>
        </div>
    </x-slot>
    <x-container class="!rounded-lg">
        <x-form.input-container class="w-[200px]">
            <x-slot name="label">Kode</x-slot>
            <x-slot  name="input">
                <x-form.input
                    name="kode"
                    placeholder="Tulis Kode"
                    class="w-[850px]"
                />
            </x-slot>
        </x-form.input-container>
        <x-form.input-container class="w-[200px]">
            <x-slot name="label">Deskripsi</x-slot>
            <x-slot  name="input">
                <x-form.textarea
                    placeholder="Tulis Deskripsi"
                    id="deskripsi_cpmk"
                    :maxChar="100"
                    rows="5"
                    cols="50"
                />
            </x-slot>
        </x-form.input-container>
    </x-container>
    <x-slot name="footer" class="flex justify-end gap-3">
        <x-button.secondary x-on:click="$dispatch('close-modal', { id: 'create-cpmk' })">Batal</x-button.secondary>
        <x-button.primary 
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

        <div
            x-on:confirmed.window="
            console.log('Data disimpan');
            window.location.href = '/'; 
        ">
        </div>
</x-modal.confirmation>