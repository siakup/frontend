@props([
    'id' => null,
    'show' => false,
    'maxWidth' => '2xl',
    'closeable' => true,
])

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
  class="modal-root"
  x-show="show" 
  x-cloak
  x-modelable="show"
  x-model="{{$attributes->get('x-model')}}"
  x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
  x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
  x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
>
    <!-- Overlay -->
    <div x-show="show" 
        x-transition:enter="modal-overlay-enter" 
        x-transition:enter-start="modal-overlay-enter-start"
        x-transition:enter-end="modal-overlay-enter-end" 
        x-transition:leave="modal-overlay-leave"
        x-transition:leave-start="modal-overlay-leave-start" 
        x-transition:leave-end="modal-overlay-leave-end" 
        class="modal-backdrop"
        x-on:click="closeable && close()">
    </div>

    <!-- Modal Container -->
    <div x-show="show" 
        x-transition:enter="modal-card-enter"
        x-transition:enter-start="modal-card-enter-start"
        x-transition:enter-end="modal-card-enter-end" 
        x-transition:leave="modal-card-leave"
        x-transition:leave-start="modal-card-leave-start"
        x-transition:leave-end="modal-card-leave-end"
        class="modal-scroll-area">
        
        <div class="modal-layout-center">
            <div class="modal-card modal-max-w-{{ $maxWidth }}"
                x-on:click.outside="closeable && close()">
                
                <!-- Header Slot -->
                @if (isset($header))
                    <div {{ $header->attributes->class(['modal-slot-header']) }}>
                        {{ $header }}
                    </div>
                @endif

                <!-- Content Slot -->
                <div {{ $attributes->class(['modal-slot-content']) }}>
                    {{ $slot }}
                </div>

                <!-- Footer Slot -->
                @if (isset($footer))
                    <div {{ $footer->attributes->class(['modal-slot-footer']) }}>
                        {{ $footer }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>