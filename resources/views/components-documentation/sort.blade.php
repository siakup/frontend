@extends('layouts.main')

@section('title', 'Button: Sort & Filter')

@php
    $filterList = [
        'SKS Lulus < 138 SKS' => 'sks_lulus_<_138',
        'SKS Lulus >= 138 SKS' => 'sks_lulus_<=_138',
        'SKS Lulus MK Wajib < 100 SKS' => 'sks_mk_wajib_<_100',
        'SKS Lulus MK Wajib >= 100 SKS' => 'sks_mk_wajib_>=_100',
        'IPK < 1.75' => 'ipk_<_1.75',
        'IPK >= 1.75' => 'ipk_>=_1.75',
        'IPS < 1.75' => 'ips_<_1.75',
        'IPS >= 1.75' => 'ips_>=_1.75',
        'Nilai PEM < 3000' => 'pem_<_3000',
        'Nilai PEM >= 3000' => 'pem_>=_3000',
    ];

    $sortList = [
        'SKS Lulus Terendah' => 'sks_lulus, asc',
        'SKS Lulus Tertinggi' => 'sks_lulus, desc',
        'SKS Lulus MK Wajib Terendah' => 'sks_lulus_mk_wajib, asc',
        'SKS Lulus MK Wajib Tertinggi' => 'sks_lulus_mk_wajib, desc',
        'IPK Terendah' => 'ipk, asc',
        'IPK Tertinggi' => 'ipk, desc',
        'IPS Terendah' => 'ips, asc',
        'IPS Tertinggi' => 'ips, desc',
        'Nilai PEM Terendah' => 'pem, asc',
        'Nilai PEM Tertinggi' => 'pem, desc',
    ];
@endphp

@section('content')
    <div class="flex flex-col gap-4 p-4 w-full h-full" x-data="{ filter: '', sort: '' }">
        <x-typography variant="body-large-semibold">Button (Sort dan Filter)</x-typography>
        <x-container.container :background="'content-white'" :radius="'md'" :padding="'p-4'" :gap="'gap-5'" class="flex-col">
            <x-typography variant="body-medium-semibold">1. Button Filter</x-typography>
            <div class="flex flex-col items-center gap-2">
                <x-button.sort :options="$filterList" :type="'filter'" x-model="filter" />
                <span class="text-xs" x-text="'Value: ' + filter"></span>
                <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                &lt;x-button.sort :options="$filterList" :type="'filter'" x-model="filter" /&gt;</pre>
            </div>
            <hr>

            <x-typography variant="body-medium-semibold">2. Button Sort</x-typography>
            <div class="flex flex-col items-center gap-2">
                <x-button.sort :options="$sortList" :type="'sort'" x-model="sort"></x-button.sort>
                <span class="text-xs" x-text="'Value: ' + sort"></span>
                <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                &lt;x-button.sort :options="$sortList" :type="'sort'" x-model="sort" /&gt;</pre>
            </div>
        </x-container.container>
    </div>
@endsection
