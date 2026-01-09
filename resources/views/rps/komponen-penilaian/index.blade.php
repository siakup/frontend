<x-layouts.main>
    @section('title', 'RPS (Rencana Pembelajaran Semester)')
    <x-layouts.content title="Buat RPS (Rencana Pembelajaran Semester)" buttonBack="RPS (Rencana Pembelajaran Semester)"
        :href="route('rps.index')">
        <div class="flex flex-col gap-0">
            @include('rps.layout.navbar-rps')
            <div x-data="{ komponenList: @js($komponenList ?? []) }" class="content-under-navbar">
                <x-typography variant="body-medium-bold">Komponen Penilaian</x-typography>
                @if ($komponenList)
                    <x-table.index>
                        <x-table.head>
                            <x-table.row>
                                <x-table.header-cell class="w-25">Nama Komponen</x-table.header-cell>
                                <x-table.header-cell class="w-25">Bobot Komponen</x-table.header-cell>
                                @foreach ($cpmkList as $cpmk)
                                    <x-table.header-cell class="w-21">{{ $cpmk }}</x-table.header-cell>
                                @endforeach
                            </x-table.row>
                        </x-table.head>

                        <x-table.body>
                            @foreach ($komponenList as $index => $komponen)
                                <x-table.row>
                                    <x-table.cell>{{ $komponen['nama'] }}</x-table.cell>
                                    <x-table.cell>{{ $komponen['bobot'] }}</x-table.cell>
                                    @foreach ($komponen['cpmk'] as $nilaiCpmk)
                                        <x-table.cell>
                                            <div class="flex justify-center items-center">
                                                @if ($nilaiCpmk)
                                                    <x-icon name="tick/black-20" />
                                                @endif
                                            </div>
                                        </x-table.cell>
                                    @endforeach
                                </x-table.row>
                            @endforeach
                        </x-table.body>
                    </x-table.index>
                @else
                    <x-container.container background="content-grey" class="h-22 flex items-center justify-center">
                        <x-typography variant="body-small-bold">Belum Ada Komponen Penilaian, Silahkan Tambah Komponen
                            Terlebih Dahulu</x-typography>
                        </x-container>
                @endif
                <div class="flex justify-end">
                    <x-button.primary x-on:click="$dispatch('open-modal', {id: 'create-komponen-penilaian'})">Tambah
                        Komponen</x-button.primary>
                </div>
                <div class="flex mt-5 justify-end gap-2">
                    <x-button.secondary x-bind:disabled="!komponenList || komponenList.length === 0"
                        x-on:click="$dispatch('open-modal', {id: 'back-confirmation'})">Kembali</x-button.secondary>
                    <x-button.primary x-bind:disabled="!komponenList || komponenList.length === 0"
                        x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})">Simpan</x-button.primary>
                </div>
            </div>
        </div>
        <x-modal.confirmation id="save-confirmation" title="Tunggu Sebentar" confirmText="Ya, Simpan Sekarang"
            cancelText="Cek Kembali" :redirectConfirm="route('rps.rencana-perkuliahan')">
            <p>Apakah Anda yakin ingin menyimpan <b>komponen penilaian</b>?</p>

            <x-dialog variant="warning">
                <x-slot name="header">Perhatian!</x-slot>
                Seluruh perubahan pada halaman ini akan disimpan dan anda secara otomatis dialihkan ke halaman
                berikutnya.
            </x-dialog>
        </x-modal.confirmation>

        <x-modal.confirmation id="back-confirmation" title="Tunggu Sebentar" confirmText="Ya, Kembali"
            cancelText="Tidak" :redirectConfirm="route('rps.capaian-pembelajaran')">
            <p>Apakah Anda yakin ingin kembali ke halaman sebelumnya?</p>

            <x-dialog variant="warning">
                <x-slot name="header">Perhatian!</x-slot>
                Seluruh perubahan pada halaman ini akan disimpan sebagai <b>draft</b> dan anda dapat mengubah kembali
                nanti.
            </x-dialog>
        </x-modal.confirmation>
        <x-modal.rps.assessment-components.create :komponenPenilaian="$komponenPenilaian" :cpmkList="$" />
    </x-layouts.content>
</x-layouts.main>
