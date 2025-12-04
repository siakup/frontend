@props([
    'id' => null,
    'show' => false,
    'title' => 'Confirm Action',
    'confirmText' => 'Confirm',
    'cancelText' => 'Cancel',
    'iconUrl' => 'caution/outline-black-24', 
    'redirectConfirm' => null,
])

<x-modal.container x-data="{show: false}" :id="$id" x-modelable="show" x-model="{{$attributes->get('x-model')}}">
    <!-- Header -->
    <x-slot name="header">
        <div class="modal-header-wrapper">
            <x-typography variant="heading-h5" class="modal-title">
                {{ $title }}
            </x-typography>
            
            <button 
                x-on:click.stop="$dispatch('close-modal', { id: '{{ $id }}' })"
                class="modal-close-btn"
            >
                <x-icon :name="$iconUrl" class="w-[32px] h-[32px]" />
            </button>
        </div>
    </x-slot>

    <!-- Content -->
    <div class="modal-body text-sm text-gray-600">
        {{ $slot }}
    </div>

    <!-- Footer -->
    <x-slot name="footer">
        <div class="modal-footer-wrapper">
            <x-button.secondary 
                :label="$cancelText" 
                class="modal-btn-action" 
                x-on:click.stop="$dispatch('close-modal', { id: '{{ $id }}' })" 
            />
            
            <x-button.primary 
                :label="$confirmText" 
                class="modal-btn-action" 
                :href="$redirectConfirm"
                x-on:click.stop="
                    $dispatch('close-modal', { id: '{{ $id }}' });
                    $dispatch('on-submit');
                " 
            />
        </div>
    </x-slot>
</x-modal.container>