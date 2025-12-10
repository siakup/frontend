@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Dosen)')

@section('javascript')
    <script type="module">
        document.addEventListener('alpine:init', () => {
            Alpine.data('listCpl', window.CplController.listCpl);
        });
    </script>
@endsection

@section('content')
    <x-container :variant="'content-wrapper'" class="mb-5">
        <x-typography variant="heading-h6">Capaian Pembelajaran Lulusan</x-typography>
        <x-button.back href="{{ route('rps.capaian-pembelajaran') }}">Buat RPS (Rencana Pembelajaran
            Semester)</x-button.back>
        <div x-data="listCpl({{ count($cplList) }}, @js($cplList))">
            <x-container variant="disable-red-gradient">
                <x-typography variant="body-medium-bold">Capaian Pembelajaran Lulusan</x-typography>
            </x-container>
            <x-container class="rounded-t-none!">
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
            </x-container>
        </div>
    </x-container>

    <x-modal.confirmation id="save-confirmation" title="Tunggu Sebentar" confirmText="Ya, Simpan Sekarang"
        cancelText="Cek Kembali">
        <p>Apakah Anda yakin informasi yang ditambahkan sudah benar?</p>
    </x-modal.confirmation>

@endsection
