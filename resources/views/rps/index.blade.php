@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Dosen)')

@section('breadcrumbs')
    <div class="breadcrumb-item active">RPS</div>
@endsection


@section('content')
    <x-title-page :title="'Buat RPS (Rencana Pembelajaran Dosen)'" />

    <x-white-box :class="''">
        <div class="p-4">
            <x-container variant="content-wrapper" class="bg-[#FFFBEB] border-[1px] border-[#FDD835] rounded-lg m-4 py-4">
                <div class="flex gap-4">
                    <div class="mt-10">
                        <x-icon iconUrl="{{ asset('assets/icon-caution-warning.svg') }}"/>
                    </div>
                    <div class="flex flex-col">
                        <x-typography variant="body-small-bold">Catatan!</x-typography>
                        <x-typography variant="body-small-regular" class="mb-5">Aksi Salin : Menyalin data RPS yang dipilih, akan ditambahkan ke row baru (paling bawah)</x-typography>
                        <x-typography variant="body-small-regular">
                            *Dosen harus merubah periode (sesuai dengan periode yang sedang berjalan atau periode selanjutnya. 
                            Tidak muncul pilihan periode yg sama dengan RPS yang di salin sebelumnya)
                        </x-typography>
                    </div>
                </div>
            </x-container>
            <x-table class="text-xs">
                <x-table-head>
                    <x-table-row>
                        <x-table-header>No</x-table-header>
                        <x-table-header>Mata Kuliah</x-table-header>
                        <x-table-header>Dosen Pengampu</x-table-header>
                        <x-table-header>Review Status</x-table-header>
                        <x-table-header>Status</x-table-header>
                        <x-table-header>Tanggal Upload</x-table-header>
                        <x-table-header>Status</x-table-header>
                    </x-table-row>
                </x-table-head>

                <x-table-body>
                    @foreach($rpsList as $index => $rps)
                    <x-table-row :odd="$index % 2 === 1" :last="$loop->last">
                        <x-table-cell>{{ $index + 1 }}</x-table-cell>
                        <x-table-cell>{{ $rps['mata_kuliah'] }}</x-table-cell>
                        <x-table-cell>{{ $rps['dosen'] }}</x-table-cell>
                        <x-table-cell>
                            <x-button.link> {{ $rps['review_status'] }}</x-button.link> 
                        </x-table-cell>
                        <x-table-cell>
                            @if($rps['status']==='Finalized')
                            <x-badge class="inline-flex bg-[#D0DE68]">Finalized</x-badge>
                            @endif
                        </x-table-cell>
                        <x-table-cell>{{ $rps['tanggal_upload'] }}</x-table-cell>
                        <x-table-cell>
                            <div class="flex flex-wrap gap-3">
                                <x-button.base 
                                    :icon="asset('assets/base/icon-copy-16.svg')"
                                    iconPosition="left"
                                >
                                    Salin
                                </x-button.base>
                                <x-button.base 
                                    :icon="asset('assets/icon-edit.svg')"
                                    iconPosition="left"
                                    class="text-[#E62129]"
                                >
                                    Ubah
                                </x-button.base>
                            </div>
                            
                        </x-table-cell>
                    </x-table-row>
                    @endforeach
                </x-table-body>
            </x-table>

            <div class="flex mt-5 justify-end gap-2">
                <x-button.secondary iconPosition="right" icon="{{asset('assets/icon-upload-red-500.svg')}}">
                    Unggah RPS
                </x-button.secondary>
                <x-button.primary>Tambah RPS</x-button.primary>
            </div>
        </div>
    </x-white-box>
    @include('partials.pagination', [
        'currentPage' => 1,
        'lastPage' => 10,
        'limit' => 3,
        'routes' => '',
    ])
@endsection
