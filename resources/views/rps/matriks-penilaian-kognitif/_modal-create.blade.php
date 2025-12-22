<script src="{{ asset('js/controllers/matriksPenilaian.js') }}" defer></script>

<div x-data="matriksPenilaian()">
    <x-modal.container id="create-matriks-penilaian" maxWidth="6xl">
        <x-slot name="header" class="items-center bg-gray-200">
            <div class="modal-header-wrapper">
                <x-typography variant="heading-h5">Tambah Matriks Penilaian Kognitif</x-typography>
                <button x-on:click.stop="close()"
                    class="modal-close-btn">
                    <x-icon :name="'close-cancel/black-24'"></x-icon>
                </button>
            </div>
        </x-slot>
        <div class="content-white flex-col p-4 gap-4 rounded-md">
            <x-form.input-container >
                <x-slot name="label">Range Nilai</x-slot>
                <x-slot name="input">
                    <x-form.input 
                        name="range_nilai"
                        placeholder="Contoh: 30  < X <= 40"
                        x-model="nilai"
                    />
                </x-slot>
            </x-form.input-container>
            <x-form.input-container labelClass="self-start">
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
        </div>
        <x-slot name="footer" class="modal-footer-wrapper">
            <x-button variant="secondary" x-bind:disabled="isDisabled" x-on:click="$dispatch('close-modal', { id: 'create-matriks-penilaian' })">Batal</x-button>
            <x-button variant="primary" 
                x-bind:disabled="isDisabled"
                x-on:click="
                    $dispatch('close-modal', { id: 'create-matriks-penilaian' });
                    $dispatch('open-modal', { id: 'save-confirmation' });
                "
            >
                Simpan
            </x-button>
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