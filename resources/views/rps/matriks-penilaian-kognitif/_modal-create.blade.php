<script src="{{ asset('js/controllers/matriksPenilaian.js') }}" defer></script>

<div x-data="matriksPenilaian()">
    <x-modal.container id="create-matriks-penilaian" maxWidth="6xl">
        <x-slot name="header" class="items-center bg-[#F5F5F5]">
            <div class="w-full relative flex items-center justify-center">
                <x-typography variant="heading-h5">Tambah Matriks Penilaian Kognitif</x-typography>
                <button x-on:click.stop="close()"
                    class="text-gray-400 hover:text-gray-500 focus:outline-none absolute right-0">
                    <x-icon iconUrl="{{ asset('assets/base/icon-close-cancel.svg') }}" class="h-[24px] w-[24px]"/>
                </button>
            </div>
        </x-slot>
        <x-container.container class="!rounded-lg">
            <x-form.input-container labelClass="w-[200px]">
                <x-slot name="label">Range Nilai</x-slot>
                <x-slot name="input">
                    <x-form.input 
                        name="range_nilai"
                        placeholder="Contoh: 30  < X <= 40"
                        x-model="nilai"
                    />

                </x-slot>
            </x-form.input-container>
            <x-form.input-container labelClass="w-[200px] self-start">
                <x-slot name="label">Kualitas Jawaban</x-slot>
                <x-slot name="input">
                    <x-form.textarea
                        id="kualitas_jawaban"
                        maxChar="100"
                        rows="4"
                        x-model="kualitas_jawaban"
                    />
                </x-slot>
            </x-form.input-container>

        </x-container>
        <x-slot name="footer" class="flex justify-end gap-3">
            <x-button.secondary x-bind:disabled="isDisabled" x-on:click="$dispatch('close-modal', { id: 'create-matriks-penilaian' })">Batal</x-button.secondary>
            <x-button.primary 
                x-bind:disabled="isDisabled"
                x-on:click="
                    $dispatch('close-modal', { id: 'create-matriks-penilaian' });
                    $dispatch('open-modal', { id: 'save-confirmation' });
                "
            >
                Simpan
            </x-button.primary>
        </x-slot>
    </x-modal.container>
</div>


<x-modal.confirmation 
        id="save-confirmation" 
        title="Tunggu Sebentar" 
        confirmText="Ya, Simpan Sekarang"
        cancelText="Cek Kembali"
    >
        <p>Apakah Anda yakin informasi yang ditambahkan sudah benar?</p>
</x-modal.confirmation>