@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Dosen)')

<script src="{{ asset('js/controllers/rpsCpl.js') }}" defer></script>

@section('content')
    <div class="page-header pl-5">
        <x-typography variant="heading-h6">Capaian Pembelajaran Lulusan</x-typography>
    </div>
    <x-button.back class="ml-2 mb-4" href="{{ route('rps.capaian-pembelajaran') }}">Buat RPS (Rencana Pembelajaran Semester)</x-button.back>

    
    <div class="cpl-head border border-gray-400 ml-3 grad-peach">
        <x-typography variant="body-medium-bold">Capaian Pembelajaran Lulusan</x-typography>
    </div>

    <div x-data="cpl({{ count($cplList) }}, @js($cplList))">
        <x-container.container variant="content" class="ml-3" borderRadius="rounded-b-3xl" >
            <x-table.index>
                <x-table.head>
                    <x-table.row>
                        <x-table.header-cell class="w-38">Kode</x-table.header-cell>
                        <x-table.header-cell>Capaian</x-table.header-cell>
                        <x-table.header-cell class="w-13">
                            <x-form.checklist
                                id="select-all"
                                label=""
                                value=""
                                name="select-all"
                                x-model="selectAll"
                                x-on:change="toggleAll()"
                                
                            />
                        </x-table.header-cell>
                    </x-table.row>
                </x-table.head>

                <x-table.body>
                    @foreach($cplList as $index => $cpl)
                    <x-table.row :odd="$index % 2 === 0">
                        <x-table.cell>{{ $cpl['kode'] }}</x-table.cell>
                        <x-table.cell position="left">{{ $cpl['deskripsi']}}</x-table.cell>
                        <x-table.cell>
                            <x-form.checklist
                                id="{{ $index }}"
                                name="select"
                                x-model="selected"
                                :value="$index"
                                x-on:change="selectAll = selected.length === {{ count($cplList) }}"
                            />
                        </x-table.cell>
                    </x-table.row>
                    @endforeach
                </x-table.body>
            </x-table.index>
            <div class="flex mt-5 justify-end gap-2">
                <x-button.secondary x-bind:disabled="isDisabled">Batal</x-button.secondary>
                <x-button.primary x-bind:disabled="isDisabled" x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})">Simpan</x-button.primary>
            </div>
        </x-container>  
    </div>
    

    <x-modal.confirmation 
        id="save-confirmation" 
        title="Tunggu Sebentar" 
        confirmText="Ya, Simpan Sekarang"
        cancelText="Cek Kembali"
    >
        <p>Apakah Anda yakin informasi yang ditambahkan sudah benar?</p>

        <div
            x-on:confirmed.window="
            console.log('Data disimpan');
            window.location.href = '/'; 
        ">
        </div>
    </x-modal.confirmation>
    
@endsection