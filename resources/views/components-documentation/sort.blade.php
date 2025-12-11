@extends('layouts.main')

@section('title', 'Sort')

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
    <x-container.wrapper :gapY="4" :rows="12">
        <x-container.container class="row-start-1 row-end-2">
            <x-typography variant="body-large-semibold">Button (Sort dan Filter)</x-typography>
        </x-container.container>
        <x-container.container :background="'content-white'" :radius="'md'" :padding="'p-4'" :gap="'gap-5'"
            class="row-start-2 row-end-13 flex-row gap-5 justify-start">
            <x-typography variant="body-medium-regular">Klik pada button untuk memunculkan option</x-typography>

            {{-- type: untuk menentukan apakah filter atau sort --}}
            <x-button.sort :options="$filterList" :type="'filter'" x-model="filter"></x-button.sort>
            <x-button.sort :options="$sortList" :type="'sort'" x-model="sort"></x-button.sort>
        </x-container.container>
    </x-container.wrapper>
@endsection
