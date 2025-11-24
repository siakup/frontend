<x-modal.container id="preview-rps" maxWidth="5xl">
    <iframe 
        src="{{ asset('files/rps.pdf') }}"
        class="w-full h-140" 
        frameborder="0"
    ></iframe>
    <x-slot name="footer">
        <div class="flex justify-end gap-2">
            <x-button.secondary x-on:click="close()">Batal</x-button.secondary>
            <x-button.primary x-on:click="close()">Unggah RPS</x-button.primary>
        </div>
    </x-slot>

</x-modal.container>