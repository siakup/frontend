@extends('layouts.main')

@section('title', 'Toast Notification Documentation')

@section('content')
    <x-toast />

    <x-container.wrapper variant="content-wrapper">
        <x-typography variant="body-large-semibold">Komponen Toast (Notifikasi)</x-typography>

        <x-container.wrapper class="flex flex-col gap-10 p-6 bg-white border border-gray-200">

            <div>
                <x-typography variant="body-medium-semibold" class="mb-4">1. Varian Warna</x-typography>
                <div class="flex flex-wrap gap-4">
                    <x-button type="button" class="!bg-green-600 !border-green-600 text-white" x-data
                        x-on:click="$dispatch('toast-show', { type: 'success', message: 'Data berhasil disimpan.' })">
                        Sukses
                    </x-button>

                    <x-button type="button" class="!bg-red-600 !border-red-600 text-white" x-data
                        x-on:click="$dispatch('toast-show', { type: 'error', message: 'Gagal menghapus data.' })">
                        Error
                    </x-button>

                    <x-button type="button" class="!bg-yellow-500 !border-yellow-500 text-white" x-data
                        x-on:click="$dispatch('toast-show', { type: 'pending', message: 'Sedang memproses...' })">
                        Pending
                    </x-button>

                    <x-button type="button" class="!bg-gray-800 !border-gray-800 text-white" x-data
                        x-on:click="$dispatch('toast-show', { type: 'info', message: 'Informasi sistem.' })">
                        Neutral
                    </x-button>
                </div>
            </div>

            <hr class="border-gray-200" />

        </x-container.wrapper>
    </x-container.wrapper>
@endsection
