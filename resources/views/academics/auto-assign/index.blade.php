@extends('layouts.main')

@section('title', 'Auto Assign')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Auto Assign</div>
@endsection

@section('javascript')
    <script>
        function autoAssignForm() {
            return {
                loading: false,
                async submit() {
                    this.loading = true;

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
                    }
                }
            }
        }
    </script>
@endsection


@section('content')
    <x-container variant="content-wrapper">
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

            <x-container class="grid grid-cols-3 grid-rows-4 py-[31px] gap-4">
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

            <x-container class="flex justify-between">
                <div class="flex gap-5">
                    <x-button.secondary type="button" href="{{route('academics.schedule.prodi-schedule.index')}}">Kembali</x-button.secondary>

                    <x-button.primary type="submit" x-bind:disabled="loading">
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

        <x-container>
            <x-table>
                <x-table-head>
                    <x-table-row>
                        <x-table-header>No</x-table-header>
                        <x-table-header>Nama Program</x-table-header>
                        <x-table-header>Periode</x-table-header>
                        <x-table-header>Angkatan</x-table-header>
                    </x-table-row>
                </x-table-head>
                <x-table-body>
                    @forelse ($assignments as $index => $row)
                        <x-table-row>
                            <x-table-cell>{{ $index + 1 }}</x-table-cell>
                            <x-table-cell>{{ $row['program'] }}</x-table-cell>
                            <x-table-cell>{{ $row['periode'] }}</x-table-cell>
                            <x-table-cell>{{ $row['angkatan'] }}</x-table-cell>
                        </x-table-row>
                    @empty
                        <x-table-row>
                            <x-table-cell colspan="4" class="text-center">
                                Tidak ada data
                            </x-table-cell>
                        </x-table-row>
                    @endforelse
                </x-table-body>
            </x-table>
        </x-container>

    </x-container>
@endsection
