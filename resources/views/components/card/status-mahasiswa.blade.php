@props([
    'status' => 'aktif', // aktif, lulus, dan dropout
    'gender' => 'women', // women & men
    'nama' => '',
    'nim' => '',
])

@php
    $listStatus = [
        'aktif' => ['text' => 'Mahasiswa Aktif', 'style' => 'aktif'],
        'lulus' => ['text' => 'Mahasiswa Lulus', 'style' => 'lulus'],
        'dropout' => ['text' => 'Mahasiswa Drop Out', 'style' => 'dropout'],
    ];

    $style = $listStatus[$status]['style'];
    $text = $listStatus[$status]['text'];
    $icon = "avatar/$gender/4-32";
@endphp

<div class="card-status-mahasiswa">
    <div class="card-status-mahasiswa data">
        <x-icon :name="$icon" class="w-fit h-fit"/>
        <x-typography :variant="'body-medium-regular'">{{ $nama }} ({{ $nim }})</x-typography>
    </div>
    <div class="card-status-mahasiswa status {{ $style }}">
        {{ $text }}
    </div>
</div>