@extends('layouts.main')

@section('title', 'Auto Assign')

@section('javascript')
    <script>
        function autoAssignForm() {
            return {
                loading: false,
                async submit() {
                    this.loading = true;

                    // buka modal loading
                    this.$dispatch('open-modal', { id: 'loading-modal' });

                    try {
                        const form = document.getElementById('autoAssignForm');
                        const formData = new FormData(form);

                        const response = await fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': form.querySelector('input[name=_token]').value,
                                'Accept': 'application/json',
                            },
                            body: formData,
                        });

                        if (!response.ok) throw new Error('Request failed');

                        const result = await response.json();
                        console.log('Success:', result);

                        // reload halaman setelah selesai
                        window.location.reload();
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Gagal assign, coba lagi.');
                        this.loading = false;
                        this.$dispatch('close-modal', { id: 'loading-modal' });
                    }
                }
            }
        };


        document.addEventListener('alpine:init', () => {
            Alpine.data('autoAssign', () => ({
                progress: 0,
                intervalId: null,

                startLoading() {
                    this.progress = 0;
                    this.intervalId = setInterval(() => {
                        if (this.progress < 100) {
                            this.progress += 5;
                        } else {
                            clearInterval(this.intervalId);
                        }
                    }, 300);

                    this.$dispatch('open-modal', { id: 'loading-modal' });
                },

                stopLoading() {
                    clearInterval(this.intervalId);
                    this.$dispatch('close-modal', { id: 'loading-modal' });
                }
            }))
        })
    </script>
@endsection


@section('content')
    <x-container.container variant="content-wrapper" x-data="autoAssign">
        <x-typography variant="heading-h6" bold>
            Auto Assign Peserta Kelas Perkuliahan
        </x-typography>

        <form
            x-data="autoAssignForm()"
            x-on:submit.prevent="submit"
            id="autoAssignForm"
            class="flex flex-col gap-5"
            method="POST"
            action="{{ route('academics.auto-assign.submit') }}"
        >
            @csrf

            <x-container.container class="grid grid-cols-3 grid-rows-4 py-[31px] gap-4">
                <x-typography variant="body-small-semibold">Program Studi</x-typography>
                <div class="col-span-2">
                    <x-form.input name="prodi" type="select" :options="$prodis" />
                </div>

                <x-typography variant="body-small-semibold">Program</x-typography>
                <div class="col-span-2">
                    <x-form.input name="program" type="select" :options="$programs" />
                </div>

                <x-typography variant="body-small-semibold">Periode</x-typography>
                <div class="col-span-2">
                    <x-form.input name="period" type="select" :options="$periods" />
                </div>

                <x-typography variant="body-small-semibold">Angkatan</x-typography>
                <div class="col-span-2">
                    <x-form.input name="angkatan" type="select" :options="$angkatans" />
                </div>
            </x-container>

            <x-container.container class="flex justify-between">
                <div class="flex gap-5">
                    <x-button.secondary type="button" href="{{route('academics.schedule.prodi-schedule.index')}}">Kembali</x-button.secondary>

                    <x-button.primary type="submit" x-on:click="startLoading" x-bind:disabled="loading">
                        <template x-if="!loading">
                            <span>Assign</span>
                        </template>
                        <template x-if="loading">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                        </template>
                    </x-button.primary>
                </div>

                <x-button.primary
                    class="self-end"
                    iconPosition="right"
                    icon="{{ asset('assets/iconRight.svg') }}"
                    href="{{ route('academics.auto-assign.view') }}"
                >
                    Lihat Daftar Kelas
                </x-button.primary>
            </x-container>
        </form>

        <x-container.container>
            <x-table.index>
                <x-table.head>
                    <x-table.row>
                        <x-table.header-cell>No</x-table.header-cell>
                        <x-table.header-cell>Nama Program</x-table.header-cell>
                        <x-table.header-cell>Periode</x-table.header-cell>
                        <x-table.header-cell>Angkatan</x-table.header-cell>
                    </x-table.row>
                </x-table.head>
                <x-table.body>
                    @forelse ($assignments as $index => $row)
                        <x-table.row>
                            <x-table.cell>{{ $index + 1 }}</x-table.cell>
                            <x-table.cell>{{ $row['program'] }}</x-table.cell>
                            <x-table.cell>{{ $row['periode'] }}</x-table.cell>
                            <x-table.cell>{{ $row['angkatan'] }}</x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="4" class="text-center">
                                Tidak ada data
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-table.body>
            </x-table.index>
        </x-container>

        {{-- Modal Loading --}}
        <x-modal.container id="loading-modal" :show="false">
            <div class="flex flex-col items-center justify-center p-6 space-y-4">
                <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden relative">
                    <div class="h-2.5 bg-blue-600 rounded-full transition-all duration-300"
                         :style="'width:' + progress + '%'">
                    </div>
                </div>

                <x-typography variant="body-small-semibold" class="text-gray-700">
                    Loading... <span x-text="progress + '%'"></span>
                </x-typography>
            </div>
        </x-modal.container>


        <x-flash-message type="success" message="Peserta berhasil dihapus"
                         redirect="{{ route('curriculum.equivalence') }}" />

    </x-container>
@endsection
