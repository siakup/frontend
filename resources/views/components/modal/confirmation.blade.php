@props([
    'id' => null,
    'show' => false,
    'title' => 'Confirm Action',
    'confirmText' => 'Confirm',
    'cancelText' => 'Cancel',
    'iconUrl' => asset('assets/icons/caution/outline-black-24.svg'),
    'redirectConfirm' => null,
])

<x-modal.container :id="$id" :show="$show">
    <!-- Header -->
    <x-slot name="header" class="w-full">
        <div class="w-full relative">
            <x-typography variant="heading-h5"
                class="w-full inline-block text-center text-gray-800">{{ $title }}</x-typography>
            <button x-on:click.stop="$dispatch('close-modal', { id: '{{ $id }}' })"
                class="text-gray-400 hover:text-gray-500 focus:outline-none absolute right-0">
                <x-icon iconUrl="{{ $iconUrl }}" class="w-[32px] h-[32px]" />
            </button>
        </div>
    </x-slot>

    <!-- Content -->
    <div class="text-center text-sm">
        {{ $slot }}
    </div>

    <!-- Footer -->
    <x-slot name="footer">
        <div class="flex justify-center gap-4 w-full">
            <x-button.secondary :label="$cancelText" class="!w-full" x-on:click.stop="
                $dispatch('close-modal', { id: '{{ $id }}' })
            " />
            <x-button.primary :label="$confirmText" class="!w-full" :href="$redirectConfirm"
                x-on:click.stop="
                    $dispatch('close-modal', { id: '{{ $id }}' });
                    $dispatch('on-submit');
                " />
        </div>
    </x-slot>
</x-modal.container>
