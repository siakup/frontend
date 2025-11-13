{{-- @extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Dosen)')

@section('content')
    <div class="page-header pl-5">
        <x-typography variant="heading-h6">Buat RPS (Rencana Pembelajaran Dosen)</x-typography>
    </div>
    <x-button.back class="ml-2 mb-4" href="{{ route('rps.index') }}">RPS (Rencana Pembelajaran Semester)</x-button.back>
    @include('rps.layout.navbar-rps')

    <div x-data class="academics-slicing-content content-card p-5 flex flex-col gap-5" style="border-radius: 0 12px 12px 12px !important;">
        <x-typography variant="body-medium-bold">Evaluasi Pemetaan Konten Perkuliahan Dengan Capaian Lulusan</x-typography>
        <x-typography variant="body-small-semibold" class="mt-4">Capaian Pembelajaran Lulusan (CPL)</x-typography>

        @if($isPemetaan)
            @foreach ($groupedEvaluasi as $cpl => $evaluasiList)
                <x-table>
                    <x-table-head>
                        <x-table-row>
                            <x-table-header colspan="2" rowspan="2">Capaian Mata Kuliah (CPMK)</x-table-header>
                            <x-table-header colspan="3">{{ $cpl }}</x-table-header>
                        </x-table-row>
                        <x-table-row>
                            <x-table-header>Tugas</x-table-header>
                            <x-table-header>UTS</x-table-header>
                            <x-table-header>UAS</x-table-header>
                        </x-table-row>
                    </x-table-head>

                    <x-table-body>
                        @foreach ($evaluasiList as $eval)
                            <x-table-row>
                                <x-table-cell class="w-[200px] !text-xs">{{ $eval['cpmk'] }}</x-table-cell>
                                <x-table-cell position="left" class="text-xs">{{ $eval['deskripsi'] }}</x-table-cell>

                                <x-table-cell class="text-center">
                                    @if ($eval['rincian']['tugas'])
                                        <x-icon iconUrl="{{ asset('assets/base/icon-tick.svg') }}" class="h-[20px] w-[20px] mx-auto" />
                                    @endif
                                </x-table-cell>
                                <x-table-cell class="text-center">
                                    @if ($eval['rincian']['uts'])
                                        <x-icon iconUrl="{{ asset('assets/base/icon-tick.svg') }}" class="h-[20px] w-[20px] mx-auto" />
                                    @endif
                                </x-table-cell>
                                <x-table-cell class="text-center">
                                    @if ($eval['rincian']['uas'])
                                        <x-icon iconUrl="{{ asset('assets/base/icon-tick.svg') }}" class="h-[20px] w-[20px] mx-auto" />
                                    @endif
                                </x-table-cell>
                            </x-table-row>
                        @endforeach
                    </x-table-body>
                </x-table>
            @endforeach
        @else
            <x-table>
                <x-table-head>
                    <x-table-row>
                        <x-table-header colspan="2">Capaian Mata Kuliah (CPMK)</x-table-header>
                        <x-table-header></x-table-header>
                    </x-table-row>
                </x-table-head>
                <x-table-body>
                    @foreach ($evaluasiList as $eval)
                        <x-table-row>
                            <x-table-cell class="w-[200px] !text-xs">{{ $eval['cpmk'] }}</x-table-cell>
                            <x-table-cell position="left" class="text-xs">{{ $eval['deskripsi'] }}</x-table-cell>
                            @if($loop->first)
                                <x-table-cell rowspan="{{ $loop->count }}" class="bg-[#D9D9D9] font-semibold text-xs">Belum Ada Evaluasi Pemetaan, Silahkan Tambah Evaluasi Pemetaan Terlebih Dahulu</x-table-cell>
                            @endif
                        </x-table-row>
                    @endforeach
                </x-table-body>
            </x-table>
        @endif

        <div class="flex justify-end">
            <x-button.primary x-on:click="$dispatch('open-modal', {id: 'create-evaluasi-pemetaan'})">Tambah Evaluasi Pemetaan</x-button.primary>
        </div>
        <div class="flex mt-5 justify-end gap-2">
            <x-button.secondary x-on:click="$dispatch('open-modal', {id: 'back-confirmation'})">Kembali</x-button.secondary>
            <x-button.primary x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})">Simpan</x-button.primary>
        </div>
    </div>
    @include('rps.evaluasi-pemetaan-capaian._create')

    <x-modal.confirmation 
        id="save-confirmation" 
        title="Tunggu Sebentar" 
        confirmText="Ya, Simpan Sekarang"
        cancelText="Cek Kembali"
        :redirectConfirm="route('rps.rencana-perkuliahan')"
    >
        <p>Apakah Anda yakin ingin menyimpan <b>komponen penilaian</b>?</p>

        <x-container variant="content-wrapper" class="bg-[#FFFBEB] border-[1px] border-[#FDD835] rounded-lg py-3 mt-4">
            <div class="flex gap-4">
                <x-icon iconUrl="{{ asset('assets/icon-caution-warning.svg') }}"/>
                <div class="flex flex-col text-left">
                    <x-typography variant="body-small-bold">Perhatian!</x-typography>
                    <x-typography variant="body-small-regular">Seluruh perubahan pada halaman ini akan disimpan dan anda secara otomatis dialihkan ke halaman berikutnya.</x-typography>
                </div>
            </div>
        </x-container>
    </x-modal.confirmation>

    <x-modal.confirmation 
        id="back-confirmation" 
        title="Tunggu Sebentar" 
        confirmText="Ya, Kembali"
        cancelText="Tidak"
        :redirectConfirm="route('rps.capaian-pembelajaran')"
    >
        <p>Apakah Anda yakin ingin kembali ke halaman sebelumnya?</p>

        <x-container variant="content-wrapper" class="bg-[#FFFBEB] border-[1px] border-[#FDD835] rounded-lg py-3 mt-4">
            <div class="flex gap-4">
                <x-icon iconUrl="{{ asset('assets/icon-caution-warning.svg') }}"/>
                <div class="flex flex-col text-left">
                    <x-typography variant="body-small-bold">Perhatian!</x-typography>
                    <p>Seluruh perubahan pada halaman ini akan disimpan sebagai <b>draft</b> dan anda dapat mengubah kembali nanti.</p>
            </div>
        </x-container>
    </x-modal.confirmation>
@endsection --}}