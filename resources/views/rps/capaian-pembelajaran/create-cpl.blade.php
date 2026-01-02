<x-layouts.main>
    @section('title', 'RPS (Rencana Pembelajaran Semester)')
    @section('javascript')
        <script type="module">
            document.addEventListener('alpine:init', () => {
                Alpine.data('listCpl', window.CplController.listCpl);
            });
        </script>
    @endsection

    <x-layouts.content title="Capaian Pembelajaran Lulusan" buttonBack="Buat RPS (Rencana Pembelajaran Semester)"
        :href="route('rps.capaian-pembelajaran')">
        <div x-data="listCpl({{ count($cplList) }}, @js($cplList))">
            <x-container.container background="disable-red-gradient-inverse" padding="p-5" width="full" height="full"
                radius="t-md">
                <x-typography variant="body-medium-bold">Capaian Pembelajaran Lulusan</x-typography>
            </x-container.container>
            <x-container.container background="content-white" padding="p-5" radius="b-md" class="flex-col">
                <x-table.index>
                    <x-table.head>
                        <x-table.row>
                            <x-table.header-cell class="w-38">Kode</x-table.header-cell>
                            <x-table.header-cell>Capaian</x-table.header-cell>
                            <x-table.header-cell class="w-13">
                                <x-form.checklist id="select-all" label="" value="" name="select-all"
                                    containerClass="inline-flex" x-model="selectAll" x-on:change="toggleAll()" />
                            </x-table.header-cell>
                        </x-table.row>
                    </x-table.head>

                    <x-table.body>
                        @foreach ($cplList as $index => $cpl)
                            <x-table.row :odd="$index % 2 === 0">
                                <x-table.cell>{{ $cpl['kode'] }}</x-table.cell>
                                <x-table.cell position="left">{{ $cpl['deskripsi'] }}</x-table.cell>
                                <x-table.cell>
                                    <x-form.checklist id="{{ $index }}" name="select" x-model="selected"
                                        containerClass="inline-flex" :value="$index"
                                        x-on:change="selectAll = selected.length === {{ count($cplList) }}" />
                                </x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-table.body>
                </x-table.index>
                <div class="flex mt-5 justify-end gap-2">
                    <x-button.secondary x-bind:disabled="isDisabled" x-on:click="reset()">Batal</x-button.secondary>
                    <x-button.primary x-bind:disabled="isDisabled"
                        x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})">Simpan</x-button.primary>
                </div>
            </x-container.container>
        </div>
    </x-layouts.content>
</x-layouts.main>
