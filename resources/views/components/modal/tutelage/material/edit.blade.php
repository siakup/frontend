@props([
    'data' => null,
    'id' => null,
])

<script type="module">
    document.addEventListener('alpine:init', () => {
        Alpine.store('edit', {
            periode: '',
            event: '',
        });
    });
</script>

<div x-data>
    <x-modal.container id="edit-materi-perwalian" maxWidth="6xl">
        <x-slot name="header" class="items-center bg-gray-200">
            <div class="modal-header-wrapper">
                <x-typography variant="heading-h5">Ubah Materi Perwalian</x-typography>
                <button x-on:click.stop="close()" class="modal-close-btn">
                    <x-icon :name="'close-cancel/black-24'" />
                </button>
            </div>
        </x-slot>
        <div class="flex flex-col gap-5">
            <x-form.input-container>
                <x-slot name="label">Periode Akademik</x-slot>
                <x-slot name="input">
                    <x-dropdown.periode-akademik x-model="$store.edit.periode"></x-dropdown.periode-akademik>
                </x-slot>
            </x-form.input-container>
            <x-form.input-container>
                <x-slot name="label">Event Perwalian</x-slot>
                <x-slot name="input">
                    <x-dropdown.event-perwalian x-model="$store.edit.event"></x-dropdown.event-perwalian>
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
            <x-button variant="primary">Simpan</x-button>
        </x-slot>
    </x-modal.container>
</div>
