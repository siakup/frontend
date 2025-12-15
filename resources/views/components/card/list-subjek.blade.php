@props([
    'nomor' => null,
    'name' => '',
    'nim' => '',
    'subjek' => '',
    'latest_chat_at' => '',
    'latest_chat_by' => '',
])

{{-- Versi siakup mahasiswa cukup diubah saja dari mahasiswa jadi dosen dan tidak ada NIM --}}
<div class="grid grid-rows-4 gap-1 w-max">
    <div class="flex flex-row items-center gap-2">
        <x-typography :tag="'span'"
            class="bg-green-600 text-white rounded-xs h-6 w-6 p-1 flex justify-center items-center"
            :variant="'caption-regular'">{{ $nomor }}</x-typography>
        <x-typography :variant="'caption-semibold'">{{ $name }} - {{ $nim }}</x-typography>
        <x-typography :variant="'caption-regular'" class="text-gray-600">Mahasiswa</x-typography>
    </div>
    <x-typography :variant="'body-medium-semibold'" class="text-blue-500 self-center">{{ $subjek }}</x-typography>
    <div class="flex flex-row items-center">
        <x-icon :name="'sub/grey-16'" />
        <x-typography :tag="'span'" class="bg-disable-gray rounded-md py-1 px-1.5" :variant="'pixie-regular'">Balasan
            terakhir
            {{ $latest_chat_at }} dari {{ $latest_chat_by }}</x-typography>
    </div>
    <div class="self-center w-full bg-gray-500 h-px opacity-25"></div>
</div>
