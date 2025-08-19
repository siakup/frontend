@props([
    'id' => null,
    'show' => false,
    'title' => 'Confirm Action',
    'confirmText' => 'Confirm',
    'cancelText' => 'Cancel',
    'iconUrl' => asset('assets/icon-caution.svg'),
])

<x-modal.container :id="$id" :show="$show">
    <!-- Header -->
    <x-slot name="header" class="w-full">
        <div class="w-full relative">
            <x-typography variant="heading-h5"
                class="w-full inline-block text-center text-gray-800">{{ $title }}</x-typography>
            <button x-on:click.stop="close()"
                class="text-gray-400 hover:text-gray-500 focus:outline-none absolute right-0">
                <x-icon iconUrl="{{ $iconUrl }}" class="w-[32px] h-[32px]" />
            </button>
        </div>
    </x-slot>

    <!-- Content -->
    <x-typography variant="body-small-regular" class="text-center">
        {{ $slot }}
    </x-typography>

    <!-- Footer -->
    <x-slot name="footer">
        <div class="flex justify-center gap-4 w-full">
            <x-button.secondary :label="$cancelText" class="w-full" x-on:click.stop="close()" />
            <x-button.primary :label="$confirmText" class="w-full"
                x-on:click.stop="
                    close();
                    $dispatch('on-submit');
                " />
        </div>
    </x-slot>
</x-modal.container>
