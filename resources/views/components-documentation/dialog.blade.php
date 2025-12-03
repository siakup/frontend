@extends('layouts.main')

@section('title', 'Dialog/Call Out Documentation')

@section('content')
    {{-- Dialog memiliki 4 variant (warning, info, success, dan danger) --}}
    {{-- isCloseable pada dialog dipergunakan untuk menampilkan close button untuk menutup dialog --}}
    {{-- Terdapat slot untuk header, dipergunakan untuk message utama seperti "Perhatian!" atau "Catatan!" --}}

    <x-container.container variant="content-wrapper">
        <x-typography variant="body-large-semibold">Penggunaan Dialog</x-typography>
        <x-container.container class="flex flex-col gap-5" borderRadius="rounded-lg">

            <x-typography variant="body-medium-semibold">Warning</x-typography>
            <x-typography variant="body-small-regular">Dengan Header (Bisa Ditutup)</x-typography>
            <x-dialog variant="warning" isCloseable>
                <x-slot name="header">Perhatian!</x-slot>
                Disini adalah konten dialog
            </x-dialog>
            <x-typography variant="body-small-regular">Tanpa Header</x-typography>
            <x-dialog variant="warning">
                Disini adalah konten dialog
            </x-dialog>

            <x-typography variant="body-medium-semibold">Info</x-typography>
            <x-typography variant="body-small-regular">Dengan Header (Bisa Ditutup)</x-typography>
            <x-dialog variant="info" isCloseable>
                <x-slot name="header">Perhatian!</x-slot>
                Disini adalah konten dialog
            </x-dialog>
            <x-typography variant="body-small-regular">Tanpa Header</x-typography>
            <x-dialog variant="info">
                Disini adalah konten dialog
            </x-dialog>

            <x-typography variant="body-medium-semibold">Danger</x-typography>
            <x-typography variant="body-small-regular">Dengan Header (Bisa Ditutup)</x-typography>
            <x-dialog variant="danger" isCloseable>
                <x-slot name="header">Perhatian!</x-slot>
                Disini adalah konten dialog
            </x-dialog>
            <x-typography variant="body-small-regular">Tanpa Header</x-typography>
            <x-dialog variant="danger">
                Disini adalah konten dialog
            </x-dialog>

            <x-typography variant="body-medium-semibold">Success</x-typography>
            <x-typography variant="body-small-regular">Dengan Header (Bisa Ditutup)</x-typography>
            <x-dialog variant="success" isCloseable>
                <x-slot name="header">Perhatian!</x-slot>
                Disini adalah konten dialog
            </x-dialog>
            <x-typography variant="body-small-regular">Tanpa Header</x-typography>
            <x-dialog variant="success">
                Disini adalah konten dialog
            </x-dialog>
        </x-container>

    </x-container>
@endsection
