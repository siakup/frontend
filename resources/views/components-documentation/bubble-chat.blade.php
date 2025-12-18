@extends('layouts.main')

@section('title', 'Bubble Chat Documentation')

@section('content')
    <x-container.container variant="content-wrapper">
        <x-container.container class="p-6 bg-white border border-gray-200 rounded-lg flex flex-col gap-10">

            {{-- Header --}}
            <div>
                <x-typography variant="body-large-semibold">
                    Komponen Bubble Chat
                </x-typography>

                <x-typography variant="body-small-regular" class="text-gray-600 mt-1">
                    Komponen <strong>Bubble Chat</strong> digunakan untuk menampilkan
                    percakapan berbentuk balon chat antara <em>sender</em> dan
                    <em>receiver</em>, lengkap dengan avatar, nama, role, pesan,
                    dan timestamp.
                </x-typography>
            </div>

            {{-- Props --}}
            <div>
                <x-typography variant="body-medium-semibold" class="mb-3">
                    Props & State
                </x-typography>

                <div class="space-y-3 text-sm text-gray-700 leading-relaxed">
                    <p>
                        <strong>type</strong> —
                        Tipe chat.
                        Nilai: <code>sender</code> | <code>receiver</code>
                    </p>
                    <p>
                        <strong>name</strong> —
                        Nama pengirim pesan
                    </p>
                    <p>
                        <strong>role</strong> —
                        Role / label user (contoh: Admin, User)
                    </p>
                    <p>
                        <strong>message</strong> —
                        Isi pesan chat
                    </p>
                    <p>
                        <strong>timestamp</strong> —
                        Waktu pesan (diformat menggunakan
                        <code>window.formatter.formatDateTime()</code>)
                    </p>
                    <p>
                        <strong>imgProfile</strong> —
                        URL foto profil
                    </p>
                    <p>
                        <strong>x-data</strong> —
                        Alpine state untuk binding data chat
                    </p>
                    <p>
                        <strong>slot</strong> —
                        Konten tambahan (opsional), misalnya action atau status
                    </p>
                </div>
            </div>

            {{-- Preview --}}
            <x-border :radius="'md'" class="bg-gray-100 p-3">
                <x-typography variant="body-medium-semibold" class="mb-4">
                    Preview Bubble Chat
                </x-typography>
                <div class="space-y-6">
                    {{-- Receiver --}}
                    <x-border radius="md" class="bg-gray-50 p-4">
                        <x-bubble-chat x-data="{
                            type: 'receiver',
                            name: 'Albert Einsten',
                            role: 'Mahasiswa',
                            message: 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Consectetur adipiscing elit quisque faucibus ex sapien vitae. Ex sapien vitae pellentesque sem placerat in id. Placerat in id cursus mi pretium tellus duis. Pretium tellus duis convallis tempus leo eu aenean.',
                            timestamp: new Date(),
                            imgProfile: '{{ asset('assets/icons/human/women.svg') }}'
                        }" />
                    </x-border>

                    {{-- Sender --}}
                    <x-border radius="md" class="bg-gray-50 p-4">
                        <x-bubble-chat x-data="{
                            type: 'sender',
                            name: 'Meredita Susanty, M.Sc',
                            role: 'Dosen',
                            message: 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Elit quisque faucibus ex sapien vitae pellentesque sem. Sem placerat in id cursus mi pretium tellus. Tellus duis convallis tempus leo eu aenean sed. Sed diam urna tempor pulvinar vivamus fringilla lacus. Lacus nec metus bibendum egestas iaculis massa nisl. Nisl malesuada lacinia integer nunc posuere ut hendrerit.',
                            timestamp: new Date(),
                            imgProfile: '{{ asset('assets/icons/human/women.svg') }}'
                        }" />
                    </x-border>
                </div>
            </x-border>


            {{-- Behavior --}}
            <div>
                <x-typography variant="body-medium-semibold" class="mb-3">
                    Behavior
                </x-typography>

                <ul class="list-disc pl-5 text-sm text-gray-700 space-y-2">
                    <li>
                        Posisi chat otomatis:
                        <code>sender</code> → kanan,
                        <code>receiver</code> → kiri
                    </li>
                    <li>
                        Avatar selalu ditampilkan di sisi awal bubble
                    </li>
                    <li>
                        Style bubble mengikuti variant
                        <code>content-sender</code> dan
                        <code>content-receiver</code>
                    </li>
                    <li>
                        Timestamp ditampilkan di bawah pesan
                    </li>
                </ul>
            </div>

            {{-- Contoh Penggunaan --}}
            <div>
                <x-typography variant="body-medium-semibold" class="mb-3">
                    Contoh Penggunaan
                </x-typography>

                <pre class="bg-gray-900 text-gray-100 p-4 rounded-lg text-sm overflow-x-auto">
&lt;x-bubble-chat
    x-data="{
        type: 'sender',
        name: 'Admin',
        role: 'Support',
        message: 'Pesanan sudah kami proses.',
        timestamp: new Date(),
        imgProfile: '/images/avatar.png'
    }"
/&gt;
            </pre>
            </div>

        </x-container.container>
    </x-container.container>
@endsection
