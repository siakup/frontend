@props([
    'status' => 'aktif', // aktif, lulus, dan dropout
    'gender' => 'women', // women & men
    'nama' => '',
    'nim' => '',
])

@php
    $listStatus = [
        'aktif' => ['text' => 'Mahasiswa Aktif', 'style' => 'bg-green-400 text-gray-800 text-base'],
        'lulus' => ['text' => 'Mahasiswa Lulus', 'style' => 'bg-blue-500 text-gray-50 text-[15px]'],
        'dropout' => ['text' => 'Mahasiswa Drop Out', 'style' => 'bg-red-500 text-gray-50 text-xs'],
    ];

    $style = $listStatus[$status]['style'];
    $text = $listStatus[$status]['text'];
    $icon = "avatar/$gender/4-32";
@endphp

<div class="flex flex-row w-max h-max">
    <div class="flex flex-row gap-1.5 px-5 py-2 bg-white w-max rounded-l-md items-center">
        <x-icon :name="$icon" class="w-fit h-fit"/>
        <x-typography :variant="'body-medium-regular'">{{ $nama }} ({{ $nim }})</x-typography>
    </div>
    <div class="rounded-r-md px-5 py-3 w-max h-full flex items-center {{ $style }}">
        {{ $text }}
    </div>
</div>