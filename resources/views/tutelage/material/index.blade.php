<x-layouts.main>
    @section('title', 'Materi Perwalian')
    @section('javascript')
        <script type="module">
            document.addEventListener('alpine:init', () => {
                Alpine.store('index', {
                    periode: '',
                    event_perwalian: '',
                });
            });
        </script>
    @endsection
    <x-layouts.content title="Materi Perwalian">

        <x-container.container class="flex-col" background="content-white" padding="p-5" gap="gap-5"
            x-data="{}">
            <x-form.input-container>
                <x-slot name="label">Periode Akademik</x-slot>
                <x-slot name="input">
                    <x-dropdown.periode-akademik x-model="$store.index.periode"></x-dropdown.periode-akademik>
                </x-slot>
            </x-form.input-container>
            <x-form.input-container inputClass="gap-3">
                <x-slot name="label">Event Perwalian</x-slot>
                <x-slot name="input">
                    <x-dropdown.event-perwalian x-model="$store.index.event_perwalian"></x-dropdown.event-perwalian>
                    <x-button buttonClass="min-w-38" variant="primary">Cari</x-button>
                </x-slot>
            </x-form.input-container>
            <x-table.index>
                <x-table.head>
                    <x-table.row>
                        <x-table.header-cell>No</x-table.header-cell>
                        <x-table.header-cell>Periode Akademik</x-table.header-cell>
                        <x-table.header-cell>Event Perwalian</x-table.header-cell>
                        <x-table.header-cell>Materi</x-table.header-cell>
                    </x-table.row>
                </x-table.head>
                <x-table.body>
                    @foreach ($materiPerwalian as $index => $data)
                        <x-table.row :odd="$index % 2 === 0">
                            <x-table.cell>{{ $index + 1 }}</x-table.cell>
                            <x-table.cell>{{ $data->periode }}</x-table.cell>
                            <x-table.cell>{{ $data->event }}</x-table.cell>
                            <x-table.cell>
                                <div class="flex-nowrap inline-flex gap-3">
                                    <x-button.base :icon="'search/black-16'" sizeText="caption-regular"
                                        x-on:click="$dispatch('open-modal', {id: 'preview-file'})">
                                        Lihat
                                    </x-button.base>
                                    <x-button.base :icon="'edit/red-16'" class="text-red-500" sizeText="caption-regular"
                                        x-on:click="$dispatch('open-modal', {id: 'edit-materi-perwalian'})">
                                        Ubah
                                    </x-button.base>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforeach
                </x-table.body>
            </x-table.index>
            <div class="flex justify-end">
                <x-button variant="primary" x-on:click="$dispatch('open-modal', {id: 'create-materi-perwalian'})">Tambah
                    Materi</x-button>
            </div>
        </x-container.container>
    </x-layouts.content>
    @section('modals')
        <x-modal.tutelage.material.create />
        <x-modal.tutelage.material.edit />
        <x-modal.preview cancelText="Kembali" :file="'files/rps.pdf'" />
    @endsection
</x-layouts.main>
