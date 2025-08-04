@props([
    'id' => null,
    'show' => false,
    'title' => 'Success!',
    'closeText' => 'Close',
])

<x-modal.container :id="$id" :show="$show">
    <!-- Header -->
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-medium text-green-600">{{ $title }}</h3>
            <button x-on:click="close()" class="text-gray-400 hover:text-gray-500">
                close
            </button>
        </div>
    </x-slot>

    <!-- Content -->
    <div class="text-gray-700">
        {{ $slot }}
    </div>

    <!-- Footer -->
    <x-slot name="footer">
        <div class="flex justify-end">
            <button x-on:click="close()" class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">
                {{ $closeText }}
            </button>
        </div>
    </x-slot>
</x-modal.container>
