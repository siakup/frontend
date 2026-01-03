@props([
    'file' => null,
    'confirmText' => '', //primary
    'cancelText' => '', //secondary
    'redirectTo' => null,
])

<x-modal.container id="preview-file" maxWidth="5xl">
    <iframe src="{{ asset("$file") }}" class="w-full h-140" frameborder="0"></iframe>
    <x-slot name="footer">
        <div class="flex justify-end gap-2">
            @if ($cancelText !== '')
                <x-button variant="secondary" x-on:click="close()">{{ $cancelText }}</x-button.secondary>
            @endif
            @if ($confirmText !== '')
                <x-button variant="primary" :href="$redirectTo">{{ $confirmText }}</x-button.secondary>
            @endif
        </div>
    </x-slot>

</x-modal.container>
