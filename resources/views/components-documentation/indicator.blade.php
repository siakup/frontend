@extends('layouts.main')

@section('title', 'Indicator Documentation')

@section('content')

    {{-- terdapat 5 parameter --}}
    {{-- variant: jenis indikator ("sks" dan "absensi"). Defaultnya "sks" --}}
    {{-- currentValue: integer — Nilai saat ini untuk progress dan counter --}}
    {{-- totalValue: integer — Nilai total untuk menghitung persentase. Gunakan > 0 --}}
    {{-- isCompleted: boolean — Jika true akan menampilkan state "completed" (monokrom). Default false --}}
    {{-- semester: integer|null — Jika diberikan, menampilkan badge semester; kosongkan untuk menyembunyikan --}}

    <x-container.wrapper>
        <x-container.container col="1">
            <x-typography variant="body-large-semibold">Penggunaan Indicator</x-typography>
        </x-container.container>

        <x-container.container col="1">
            <x-container.wrapper cols="2">
                <x-container.container col="1">
                    <x-container.wrapper rows="7" class="gap-6">
                        <x-container.container row="1">
                            <x-indicator variant="sks" :currentValue="0" :totalValue="144" semester="1" />
                        </x-container.container>
                        <x-container.container row="1">
                            <x-indicator variant="sks" :currentValue="18" :totalValue="144" semester="2" />
                        </x-container.container>
                        <x-container.container row="1">
                            <x-indicator variant="sks" :currentValue="36" :totalValue="144" semester="3" />
                        </x-container.container>
                        <x-container.container row="1">
                            <x-indicator variant="sks" :currentValue="72" :totalValue="144" semester="4" />
                        </x-container.container>
                        <x-container.container row="1">
                            <x-indicator variant="sks" :currentValue="100" :totalValue="144" semester="6" />
                        </x-container.container>
                        <x-container.container row="1">
                            <x-indicator variant="sks" :currentValue="144" :totalValue="144" semester="8" />
                        </x-container.container>
                        <x-container.container row="1">
                            <x-indicator variant="sks" :currentValue="144" :totalValue="144" semester="8"
                                isCompleted="true" />
                        </x-container.container>
                    </x-container.wrapper>
                </x-container.container>

                <x-container.container col=1>
                    <x-container.wrapper rows="7" class="gap-6">
                        <x-container.container row="1">
                            <x-indicator variant="absensi" :currentValue="0" :totalValue="100" />
                        </x-container.container>
                        <x-container.container row="1">
                            <x-indicator variant="absensi" :currentValue="50" :totalValue="100" />
                        </x-container.container>
                        <x-container.container row="1">
                            <x-indicator variant="absensi" :currentValue="80" :totalValue="100" />
                        </x-container.container>
                        <x-container.container row="1">
                            <x-indicator variant="absensi" :currentValue="96" :totalValue="100" />
                        </x-container.container>
                        <x-container.container row="1">
                            <x-indicator variant="absensi" :currentValue="99" :totalValue="100" />
                        </x-container.container>
                        <x-container.container row="1">
                            <x-indicator variant="absensi" :currentValue="100" :totalValue="100" />
                        </x-container.container>
                        <x-container.container row="1">
                            <x-indicator variant="absensi" :currentValue="100" :totalValue="100" isCompleted="true" />
                        </x-container.container>
                    </x-container.wrapper>
                </x-container.container>
            </x-container.wrapper>
        </x-container.container>
    </x-container.wrapper>

@endsection