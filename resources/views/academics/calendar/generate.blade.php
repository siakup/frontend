@extends('layouts.main')

@section('title', 'Riwayat Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Generate Riwayat Akademik</div>
@endsection

@section('javascript')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('riwayatAkademik', () => ({
                loading: false,
                progress: 0,
                intervalId: null,
                showDownload: false,

                startLoading() {
                    this.loading = true;
                    this.progress = 0;
                    this.showDownload = false;

                    this.intervalId = setInterval(() => {
                        if (this.progress < 100) {
                            this.progress += 10;
                        } else {
                            clearInterval(this.intervalId);
                            this.stopLoading();
                            // Tunggu sebentar sebelum menampilkan success modal
                            setTimeout(() => {
                                this.$dispatch('open-modal', { id: 'success-modal' });
                            }, 300);
                        }
                    }, 400);

                    this.$dispatch('open-modal', { id: 'loading-modal' });
                },

                stopLoading() {
                    this.loading = false;
                    clearInterval(this.intervalId);
                    this.$dispatch('close-modal', { id: 'loading-modal' });
                },

                confirmSuccess() {
                    this.$dispatch('close-modal', { id: 'success-modal' });
                    this.showDownload = true;
                }
            }))
        })

    </script>
@endsection


@section('content')
    <x-container.container variant="content-wrapper" x-data="riwayatAkademik">
        <x-typography variant="heading-h6">
            Generate Riwayat Akademik
        </x-typography>

        <x-button.back href="{{route('calendar.index')}}">Kalender Akademik</x-button.back>

        <x-container.container class="flex flex-col gap-5">
            <x-typography variant="heading-h6">Tahun Akademik 2025-2026</x-typography>

            <div class="grid grid-cols-2 gap-5 items-start">
                {{-- tabel kiri --}}
                <div>
                    <x-table.index>
                        <x-table.head>
                            <x-table.row>
                                <x-table.header-cell class="bg-[#E9EDF4]" colspan="2">
                                    Periode Akademik Sebelumnya 2025-2026
                                </x-table.header-cell>
                            </x-table.row>
                        </x-table.head>
                        <x-table.body>
                            @foreach($dataSebelumnya as $idx => $row)
                                <x-table.row :odd="$idx % 2 === 1" :last="$idx === count($dataSebelumnya) - 1">
                                    <x-table.cell class="text-left">{{ $row['indikator'] }}</x-table.cell>
                                    <x-table.cell>{{ $row['nilai'] }}</x-table.cell>
                                </x-table.row>
                            @endforeach
                        </x-table.body>
                    </x-table.index>
                </div>

                {{-- tabel kanan --}}
                <div>
                    <x-table.index>
                        <x-table.head>
                            <x-table.row>
                                <x-table.header-cell class="bg-[#E9EDF4]" colspan="2">
                                    Periode Akademik Aktif 2025-1
                                </x-table.header-cell>
                            </x-table.row>
                        </x-table.head>
                        <x-table.body>
                            @foreach($dataAktif as $idx => $row)
                                <x-table.row :odd="$idx % 2 === 1" :last="$idx === count($dataAktif) - 1">
                                    <x-table.cell class="text-left">{{ $row['indikator'] }}</x-table.cell>
                                    <x-table.cell>{{ $row['nilai'] }}</x-table.cell>
                                </x-table.row>
                            @endforeach

                            {{-- tombol unduh --}}
                            <x-table.row>
                                <x-table.cell colspan="2" class="py-6 px-2 bg-[#FBE8E6]">
                                    <div class="flex items-center justify-between">
                                        <x-typography variant="body-small-semibold">
                                            Download jumlah mahasiswa
                                        </x-typography>
                                        <a href="" class="flex items-center gap-2 text-red-500">
                                            Download
                                            <img src="{{ asset('assets/icon-download-red-500.svg') }}" alt="download" />
                                        </a>
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                        </x-table.body>
                    </x-table.index>
                </div>
            </div>

            <div class="flex gap-5 justify-end">
                <x-button.secondary href="{{route('calendar.index')}}">Kembali</x-button.secondary>

                <x-button.primary x-on:click="startLoading" x-bind:disabled="loading">
                    <template x-if="!loading">
                        <span>Generate</span>
                    </template>
                    <template x-if="loading">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                  d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                    </template>
                </x-button.primary>
            </div>
        </x-container>

        {{-- Modal Loading --}}
        <x-modal.container id="loading-modal" :show="false">
            <div class="flex flex-col items-center justify-center p-6 space-y-4">
                <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden relative">
                    <div class="h-2.5 bg-blue-600 rounded-full transition-all duration-300"
                         :style="'width:' + progress + '%'"></div>
                </div>

                <x-typography variant="body-small-semibold" class="text-gray-700">
                    Loading... <span x-text="progress + '%'"></span>
                </x-typography>
            </div>
        </x-modal.container>

        {{-- Modal Success --}}
        <x-modal.container id="success-modal" :show="false">
            <div class="flex flex-col items-center justify-center p-6 space-y-6">
                <!-- Header -->
                <x-slot name="header" class="relative text-center">
                    <x-typography variant="heading-h3">Selesai</x-typography>

                    <button
                        x-on:click="confirmSuccess()"
                        class="absolute top-[20px] right-[20px] cursor-pointer w-8 h-8 flex items-center justify-center"
                        type="button"
                    >
                        <img
                            src="{{ asset('assets/icon-tick-circle.svg') }}"
                            alt="close"
                            class="w-[32px] h-[32px]"
                        />
                    </button>
                </x-slot>

                {{-- Content --}}
                <x-typography class="text-center text-gray-700">
                    Proses Generate Riwayat Akademik telah berhasil untuk 200 mahasiswa.
                    Data mahasiswa tersebut dapat diunduh melalui OneDrive.
                </x-typography>

                <!-- Footer -->
                <x-slot name="footer" class="text-center">
                    <x-button.primary x-on:click="confirmSuccess()" type="button">
                        Oke
                    </x-button.primary>
                </x-slot>
            </div>
        </x-modal.container>

    </x-container>
@endsection
