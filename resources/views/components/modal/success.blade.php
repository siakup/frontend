@props([
    'id' => null,
    'show' => false,
    'title' => 'Success!',
    'closeText' => 'Close',
])

<x-modal.container :id="$id" :show="$show">
    <!-- Header -->
    <x-slot name="header">
        <div class="modal-header-wrapper">
            <x-typography variant="heading-h3" class="modal-title">
                {{ $title }}
            </x-typography>

            {{-- Tombol Close --}}
            <button 
                x-on:click="$dispatch('close-modal', { id: '{{ $id }}' })"
                class="modal-close-btn"
                type="button"
            >
                <x-icon name="close-cancel/grey-24" class="w-[32px] h-[32px]" />
            </button>
        </div>
    </x-slot>

    <!-- Content -->
    <div class="modal-body">
        {{ $slot }}
    </div>

    <!-- Footer -->
    <x-slot name="footer">
        <div class="modal-footer-wrapper">
            <x-button.primary 
                x-on:click="$dispatch('close-modal', { id: '{{ $id }}' })" 
                type="button"
                class="modal-btn-action"
            >
                {{ $closeText }}
            </x-button.primary>
        </div>
    </x-slot>
</x-modal.container>