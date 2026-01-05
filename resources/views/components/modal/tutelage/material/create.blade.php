@props([
    'data' => null,
])

<script type="module">
    document.addEventListener('alpine:init', () => {
        Alpine.store('create', {
            periode: '',
            event: '',
        });
    });
</script>

<div x-data>
    <x-modal.container id="create-materi-perwalian" maxWidth="6xl">
        <x-slot name="header" class="items-center bg-gray-200">
            <div class="modal-header-wrapper">
                <x-typography variant="heading-h5">Tambah Materi Perwalian</x-typography>
                <button x-on:click.stop="close()" class="modal-close-btn">
                    <x-icon :name="'close-cancel/black-24'" />
                </button>
            </div>
        </x-slot>
        <div class="flex flex-col gap-5">
            <x-form.input-container>
                <x-slot name="label">Periode Akademik</x-slot>
                <x-slot name="input">
                    <x-dropdown.periode-akademik x-model="$store.create.periode"></x-dropdown.periode-akademik>
                </x-slot>
            </x-form.input-container>
            <x-form.input-container>
                <x-slot name="label">Event Perwalian</x-slot>
                <x-slot name="input">
                    <x-dropdown.event-perwalian x-model="$store.create.event"></x-dropdown.event-perwalian>
                </x-slot>
            </x-form.input-container>
            <x-form.input-container>
                <x-slot name="label">Unggah Catatan</x-slot>
                <x-slot name="input">
                    <x-button :fileInput="true" label="Unggah File" variant="secondary" buttonClass="min-w-full"
                        icon="upload/red-20" />
                </x-slot>
            </x-form.input-container>
        </div>
        <x-slot name="footer" class="flex gap-5 justify-end">
            <x-button variant="secondary" @click="close()">Batal</x-button>
            <x-button variant="primary" x-on:click="$dispatch('close-modal', { id: 'create-materi-perwalian' });$dispatch('open-modal', {id: 'save-confirmation'})">Simpan</x-button>
        </x-slot>
    </x-modal.container>
    <x-modal.confirmation id="save-confirmation" title="Tunggu Sebentar" confirmText="Ya, Simpan Sekarang"
        cancelText="Cek Kembali">
        Apakah Anda yakin ingin menyimpan catatan Perwalian ini?
    </x-modal.confirmation>
</div>
