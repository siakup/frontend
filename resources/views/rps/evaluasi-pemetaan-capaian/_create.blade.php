<script>
function createEvaluasi() {
    return {
        cpl: '',
    }
}
</script>

<div x-data="createEvaluasi()">
    <x-modal.container id="create-evaluasi-pemetaan" maxWidth="6xl">
        <x-slot name="header" class="items-center bg-[#F5F5F5]">
            <div class="w-full relative flex items-center justify-center">
                <x-typography variant="heading-h5">Tambah Pemetaan Konten Perkuliahan Dengan Capaian Lulusan</x-typography>
                <button x-on:click.stop="close()"
                    class="text-gray-400 hover:text-gray-500 focus:outline-none absolute right-0">
                    <x-icon iconUrl="{{ asset('assets/base/icon-close-cancel.svg') }}" class="h-[24px] w-[24px]"/>
                </button>
            </div>
        </x-slot>
        <x-container class="!rounded-lg mb-5">
            <x-form.input-container containerClass="!gap-6">
                <x-slot name="label">Capaian Pembelajaran Lulusan</x-slot>
                <x-slot name="input">
                    <x-form.dropdown
                        variant="gray"
                        buttonId="dropdownCplButton"
                        dropdownId="dropdownCplList"
                        label="-Pilih CPL-"
                        :dropdownItem="$cplList"
                        buttonStyleClass="text-sm min-w-[800px] h-[40px]"
                        optionStyleClass="min-w-[250px]"
                        :imgSrc="asset('assets/icon-arrow-down-grey-20.svg')"
                        :isIconCanRotate="true"
                        x-model="cpl"
                    />

                </x-slot>
            </x-form.input-container>
        </x-container>
        {{-- <x-table>
            <x-table-head>
                <x-table-row>
                    <x-table-header colspan="2" rowspan="2">Capaian Mata Kuliah (CPMK)</x-table-header>
                    @if($hasEvaluasi)
                        <x-table-header colspan="3">{{ $cpl }}</x-table-header>
                    @endif
                </x-table-row>

                @if ($hasEvaluasi)
                    <x-table-row>
                        <x-table-header>Tugas</x-table-header>
                        <x-table-header>UTS</x-table-header>
                        <x-table-header>UAS</x-table-header>
                    </x-table-row>
                @else
                    <x-table-header colspan="3"></x-table-header>
                @endif
                    
            </x-table-head>

            <x-table-body>
                @foreach ($evaluasiList as $eval)
                <x-table-row>
                    <x-table-cell class="w-[200px] !text-xs">{{ $eval['cpmk'] }}</x-table-cell>
                    <x-table-cell position="left" class="text-xs">{{ $eval['deskripsi'] }}</x-table-cell>
                    @if($hasEvaluasi)
                        <x-table-cell class="text-center">
                            @if ($eval['cpl']['tugas'])
                                <x-icon iconUrl="{{ asset('assets/base/icon-tick.svg') }}" class="h-[20px] w-[20px] mx-auto" />
                            @endif
                        </x-table-cell>
                        <x-table-cell class="text-center">
                            @if ($eval['cpl']['uts'])
                                <x-icon iconUrl="{{ asset('assets/base/icon-tick.svg') }}" class="h-[20px] w-[20px] mx-auto" />
                            @endif
                        </x-table-cell>
                        <x-table-cell class="text-center">
                            @if ($eval['cpl']['uas'])
                                <x-icon iconUrl="{{ asset('assets/base/icon-tick.svg') }}" class="h-[20px] w-[20px] mx-auto" />
                            @endif
                        </x-table-cell>
                    @else
                        @if($loop->first)
                                <x-table-cell rowspan="{{ $loop->count }}" class="bg-[#D9D9D9] font-semibold text-xs">Belum Ada Evaluasi Pemetaan, Silahkan Tambah Evaluasi Pemetaan Terlebih Dahulu</x-table-cell>
                        @endif
                    @endif                    
                </x-table-row>   
                @endforeach
            </x-table-body>
        </x-table> --}}
        <x-slot name="footer" class="flex justify-end gap-3">
            <x-button.secondary x-bind:disabled="isDisabled" x-on:click="$dispatch('close-modal', { id: 'create-evaluasi-pemetaan' })">Batal</x-button.secondary>
            <x-button.primary 
                x-bind:disabled="isDisabled"
                x-on:click="
                    $dispatch('close-modal', { id: 'create-evaluasi-pemetaan' });
                    $dispatch('open-modal', { id: 'save-confirmation' });
                "
            >
                Simpan
            </x-button.primary>
        </x-slot>
    </x-modal.container>
</div>
