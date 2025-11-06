@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Dosen)')

<script src="{{ asset('js/controllers/rpsCpl.js') }}" defer></script>

@section('content')
    <div class="page-header pl-5">
        <x-typography variant="heading-h6">Capaian Pembelajaran Lulusan</x-typography>
    </div>
    <x-button.base
        :icon="asset('assets/icon-less-than-red-20.svg')"
        :href="route('rps.capaian-pembelajaran')"
        class="ml-5 mb-3 text-[#E62129]"
    >
        Buat RPS (Rencana Pembelajaran Dosen)
    </x-button.base>

    
    <div class="cpl-head border border-[#d9d9d9] ml-3 grad-peach">
        <x-typography variant="body-medium-bold">Capaian Pembelajaran Lulusan</x-typography>
    </div>

    <div x-data="cpl({{ count($cplList) }}, @js($cplList))">
        <x-container variant="content" class="ml-3 border !rounded-t-none" >
            <x-table>
                <x-table-head>
                    <x-table-row>
                        <x-table-header class="w-[150px]">Kode</x-table-header>
                        <x-table-header>Capaian</x-table-header>
                        <x-table-header class="w-[50px]">
                            <x-form.checklist
                                id="select-all"
                                label=""
                                value=""
                                name="select-all"
                                x-model="selectAll"
                                x-on:change="toggleAll()"
                                
                            />
                        </x-table-header>
                    </x-table-row>
                </x-table-head>

                <x-table-body>
                    @foreach($cplList as $index => $cpl)
                    <x-table-row :odd="$index % 2 === 0">
                        <x-table-cell>{{ $cpl['kode'] }}</x-table-cell>
                        <x-table-cell position="left">{{ $cpl['deskripsi']}}</x-table-cell>
                        <x-table-cell>
                            <x-form.checklist
                                id="{{ $index }}"
                                label=""
                                name="select"
                                x-model="selected"
                                :value="$index"
                                x-on:change="selectAll = selected.length === {{ count($cplList) }}"
                            />
                        </x-table-cell>
                    </x-table-row>
                    @endforeach
                </x-table-body>
            </x-table>
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