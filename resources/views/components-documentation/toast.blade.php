@extends('layouts.main')

@section('title', 'Toast Notification Documentation')

@section('content')
    <x-toast />
    <x-container.wrapper variant="content-wrapper">
        <x-typography variant="body-large-semibold">Komponen Toast (Notifikasi)</x-typography>
        <x-container.wrapper class="flex flex-col gap-10 p-6 bg-white border border-gray-200" borderRadius="rounded-lg">
            <div>
                <x-typography variant="body-medium-semibold" class="mb-4">Varian Warna</x-typography>
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

            <hr class="border-gray-200">

            <div>
                <x-typography variant="body-medium-semibold" class="mb-4">Varian Ukuran (Size)</x-typography>
                <x-typography variant="body-small-regular" class="mb-2 text-gray-500">
                    Gunakan properti <code>size: 'sm' | 'md' | 'lg'</code>. Default adalah 'md'.
                </x-typography>

                <div class="flex flex-wrap gap-4 items-center">
                    <x-button type="button" size="sm" variant="outline-primary" x-data
                        x-on:click="$dispatch('toast-show', { type: 'info', message: 'Toast Kecil (sm)', size: 'sm' })">
                        Small
                    </x-button>
                    <x-button type="button" size="md" variant="outline-primary" x-data
                        x-on:click="$dispatch('toast-show', { type: 'success', message: 'Toast Standar (md)', size: 'md' })">
                        Medium
                    </x-button>
                    <x-button type="button" size="lg" variant="outline-primary" x-data
                        x-on:click="$dispatch('toast-show', { type: 'error', message: 'Toast Besar (lg) untuk pesan panjang!', size: 'lg' })">
                        Large
                    </x-button>
                </div>
            </div>

            <hr class="border-gray-200">

            <div>
                <x-typography variant="body-medium-semibold" class="mb-4">Integrasi Controller</x-typography>
                <x-typography variant="body-small-regular" class="mb-2 text-gray-500">
                    Otomatis mendeteksi session flash dari Controller Laravel.
                </x-typography>

                <div class="bg-gray-50 p-4 rounded border border-gray-200">
                    <pre class="text-xs text-blue-600 font-mono overflow-x-auto">
                    return redirect()->back()->with('success', 'Berhasil update data.');
                    return redirect()->back()->with('error', 'Terjadi kesalahan.');
                    return redirect()->back()->with('pending', 'Mohon tunggu.');</pre>
                </div>
            </div>

        </x-container.wrapper>
    </x-container.wrapper>
@endsection
