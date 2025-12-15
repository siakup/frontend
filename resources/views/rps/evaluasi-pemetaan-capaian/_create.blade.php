<div x-data="{cpl: '',}">
    <x-modal.container id="create-evaluasi-pemetaan" maxWidth="6xl">
        <x-slot name="header" class="items-center bg-gray-200">
            <x-container.container class="relative items-center justify-center">
                <x-typography variant="heading-h5">Tambah Pemetaan Konten Perkuliahan Dengan Capaian
                    Lulusan</x-typography>
                <button x-on:click.stop="close()" class="right-0">
                    <x-icon :name="'close-cancel/black-24'"></x-icon>
                </button>
            </x-container.container>
        </x-slot>
        <x-container.container class="flex-col" :gap="'gap-3'">
            <x-container.container :background="'content-white'" :padding="'py-3 px-5'">
                <x-form.input-container>
                    <x-slot name="label">Capaian Pembelajaran Lulusan</x-slot>
                    <x-slot name="input">
                        <x-dropdown.cpl x-model="cpl"></x-dropdown.cpl>
                    </x-slot>
                </x-form.input-container>
            </x-container>
            <template x-if="cpl">
                <x-table.index>
                    <x-table.head>
                        <x-table.row>
                            <x-table.header-cell colspan="2" rowspan="2">Capaian Mata Kuliah
                                (CPMK)</x-table.header-cell>
                            <x-table.header-cell colspan="3" x-text="cpl"></x-table.header-cell>
                        </x-table.row>

                        <x-table.row>
                            <x-table.header-cell>Tugas</x-table.header-cell>
                            <x-table.header-cell>UTS</x-table.header-cell>
                            <x-table.header-cell>UAS</x-table.header-cell>
                        </x-table.row>
                    </x-table.head>
                    <x-table.body>
                        @foreach ($evaluasiList as $index => $eval)
                            <x-table.row>
                                <x-table.cell class="w-50">{{ $eval['cpmk'] }}</x-table.cell>
                                <x-table.cell position="left">{{ $eval['deskripsi'] }}</x-table.cell>
                                <x-table.cell>
                                    <x-form.checklist id="tugas-{{ $index }}" name="select_tugas"
                                        x-model="selected" :value="$index" containerClass="justify-center" />
                                </x-table.cell>
                                <x-table.cell>
                                    <x-form.checklist id="uts-{{ $index }}" name="select_uts" x-model="selected"
                                        :value="$index" containerClass="justify-center" />
                                </x-table.cell>
                                <x-table.cell>
                                    <x-form.checklist id="uas-{{ $index }}" name="select_uas" x-model="selected"
                                        :value="$index" containerClass="justify-center" />
                                </x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-table.body>
                </x-table.index>
            </template>

            <template x-if="!cpl">
                <x-table.index>
                    <x-table.head>
                        <x-table.row>
                            <x-table.header-cell colspan="2" rowspan="2">Capaian Mata Kuliah
                                (CPMK)</x-table.header-cell>
                            <x-table.header-cell></x-table.header-cell>
                        </x-table.row>
                    </x-table.head>
                    <x-table.body>
                        @foreach ($evaluasiList as $index => $eval)
                            <x-table.row>
                                <x-table.cell class="w-50">{{ $eval['cpmk'] }}</x-table.cell>
                                <x-table.cell position="left">{{ $eval['deskripsi'] }}</x-table.cell>
                                @if ($loop->first)
                                    <x-table.cell rowspan="{{ $loop->count }}"
                                        class="bg-gray-400!"><b>Belum Ada Evaluasi Pemetaan, Silahkan
                                        Tambah Evaluasi Pemetaan Terlebih Dahulu</b></x-table.cell>
                                @endif
                            </x-table.row>
                        @endforeach
                    </x-table.body>
                </x-table.index>
            </template>
        </x-container.container>

        <x-slot name="footer" class="flex justify-end gap-3">
            <x-button.secondary x-bind:disabled="isDisabled"
                x-on:click="$dispatch('close-modal', { id: 'create-evaluasi-pemetaan' })">Batal</x-button.secondary>
            <x-button.primary x-bind:disabled="isDisabled"
                x-on:click="
                    $dispatch('close-modal', { id: 'create-evaluasi-pemetaan' });
                    $dispatch('open-modal', { id: 'save-confirmation' });
                ">
                Simpan
            </x-button.primary>
        </x-slot>
    </x-modal.container>
</div>
