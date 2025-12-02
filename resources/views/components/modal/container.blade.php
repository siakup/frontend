@props([
    'id' => null,
    'show' => false,
    'maxWidth' => '2xl',
    'closeable' => true,
])

@php
    $maxWidthClasses = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
        '3xl' => 'sm:max-w-3xl',
        '4xl' => 'sm:max-w-4xl',
        '5xl' => 'sm:max-w-5xl',
        '6xl' => 'sm:max-w-6xl',
        '7xl' => 'sm:max-w-7xl',
    ][$maxWidth];
@endphp

<div 
  x-data="{
    show: @js($show),
    id: @js($id),
    close() { this.show = false },
    open() { this.show = true },
    closeable: @js($closeable)
  }" 
  x-on:keydown.escape="close()" 
  x-on:open-modal.window="if ($event.detail.id === id) open()"
  x-on:close-modal.window="if ($event.detail.id === id) close()" 
  {!! $id ? 'x-id="[\'' . $id . '\']"' : '' !!} 
  class="fixed inset-0 z-50"
  style="display: none; z-index: 9999" 
  x-show="show" 
  x-cloak
  x-modelable="show"
  x-model="{{$attributes->get('x-model')}}"
>
    <!-- Overlay -->
    <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/50"
        x-on:click="closeable && close()"></div>

    <!-- Modal Container -->
    <div x-show="show" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="fixed inset-0 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="w-full transform overflow-hidden rounded-lg bg-white shadow-xl transition-all {{ $maxWidthClasses }}"
                x-on:click.outside="closeable && close()">
                <!-- Header Slot -->
                @if (isset($header))
                    <div {{ $header->attributes->class(['border-b border-[#d9d9d9] p-5 w-full']) }}>
                        {{ $header }}
                    </div>
                @endif

                <!-- Content Slot -->
                <div {{ $attributes->class(['p-5 sm:p-6 w-full']) }}>
                    {{ $slot }}
                </div>

                <!-- Footer Slot -->
                @if (isset($footer))
                    <div {{ $footer->attributes->class(['p-5 w-full']) }}>
                        {{ $footer }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
