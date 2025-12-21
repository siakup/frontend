@extends('layouts.main')

@section('title', 'Indicator Documentation')

@section('content')

    {{-- terdapat 5 parameter --}}
    {{-- variant: jenis indikator ("sks" dan "absensi"). Defaultnya "sks" --}}
    {{-- currentValue: integer — Nilai saat ini untuk progress dan counter --}}
    {{-- totalValue: integer — Nilai total untuk menghitung persentase. Gunakan > 0 --}}
    {{-- isCompleted: boolean — Jika true akan menampilkan state "completed" (monokrom). Default false --}}
    {{-- semester: integer|null — Jika diberikan, menampilkan badge semester; kosongkan untuk menyembunyikan --}}

    <x-container.container variant="content-wrapper" class="flex flex-col gap-8">

        <x-typography variant="body-large-semibold">Penggunaan Indicator</x-typography>

        {{-- Grid 3 kolom --}}
        <div class="grid grid-cols-3 gap-10 items-start">
            <div class="flex flex-col gap-10">

                {{-- SKS Section --}}
                <div class="flex flex-col gap-6">
                    <x-typography variant="heading-h5">Indicator SKS</x-typography>

                    <x-indicator variant="sks" :currentValue="0" :totalValue="144" semester="1" />
                    <x-indicator variant="sks" :currentValue="18" :totalValue="144" semester="2" />
                    <x-indicator variant="sks" :currentValue="36" :totalValue="144" semester="3" />
                    <x-indicator variant="sks" :currentValue="72" :totalValue="144" semester="4" />
                    <x-indicator variant="sks" :currentValue="100" :totalValue="144" semester="5" />
                    <x-indicator variant="sks" :currentValue="144" :totalValue="144" semester="6" />
                    <x-indicator variant="sks" :currentValue="144" :totalValue="144" semester="8" :isCompleted="true" />
                </div>
            </div>

            <div>
                {{-- Absensi Section --}}
                <div class="flex flex-col gap-6">
                    <x-typography variant="heading-h5">Indicator Absensi</x-typography>

                    <x-indicator variant="absensi" :currentValue="0" :totalValue="100" />
                    <x-indicator variant="absensi" :currentValue="50" :totalValue="100" />
                    <x-indicator variant="absensi" :currentValue="80" :totalValue="100" />
                    <x-indicator variant="absensi" :currentValue="96" :totalValue="100" />
                    <x-indicator variant="absensi" :currentValue="99" :totalValue="100" />
                    <x-indicator variant="absensi" :currentValue="100" :totalValue="100" />
                    <x-indicator variant="absensi" :currentValue="100" :totalValue="100" :isCompleted="true" />
                </div>
            </div>

        </div>

    </x-container.container>
@endsection