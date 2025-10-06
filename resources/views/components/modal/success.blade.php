@props([
    'id' => null,
    'show' => false,
    'title' => 'Success!',
    'closeText' => 'Close',
])

@php
    $id = $id ?? 'success-modal-' . uniqid();
@endphp

<x-modal.container
    :id="$id"
    :show="$show"
    x-data="{
        open: @js($show),
        closeModal() {
            this.open = false;
            this.$dispatch('close-success');
        }
    }"
    x-show="open"
    x-on:keydown.escape="closeModal()"
    x-transition
>
    <!-- Header -->
    <x-slot name="header" class="relative text-center">
        <x-typography variant="heading-h3">{{ $title }}</x-typography>

        <button
            x-on:click="closeModal()"
            class="absolute top-[20px] right-[20px] cursor-pointer w-8 h-8 flex items-center justify-center"
            type="button"
        >
            <img
                src="{{ asset('assets/icon-tick-circle.svg') }}"
                alt="close"
                class="w-[32px] h-[32px]"
            />
        </button>
    </x-slot>

    <!-- Content -->
    <div class="text-gray-700">
        {{ $slot }}
    </div>

    <!-- Footer -->
    <x-slot name="footer" class="text-center">
        <x-button.primary x-on:click="closeModal()" type="button">
            {{ $closeText }}
        </x-button.primary>
    </x-slot>
</x-modal.container>
