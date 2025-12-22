@props([
    'file' => null
])

<x-modal.container id="preview-file" maxWidth="5xl">
    <iframe 
        src="{{ asset("$file") }}"
        class="w-full h-140" 
        frameborder="0"
    ></iframe>
    <x-slot name="footer">
        <div class="flex justify-end gap-2">
            <x-button variant="secondary" x-on:click="close()">Batal</x-button.secondary>
        </div>
    </x-slot>

</x-modal.container>