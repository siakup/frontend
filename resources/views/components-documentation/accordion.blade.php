<x-layouts.main>
    <x-layouts.content title="Accordion Documentation">
        <x-container.wrapper rows="3" class="gap-2">
            {{-- Red Gradient --}}
            <x-container.container row="1" class="flex flex-col gap-3 w">
                <x-typography variant="body-medium-semibold">Red Gradient (Default)</x-typography>
                <x-accordion label="Accordion Red Gradient (Default)" variant="red-gradient">
                    <x-container.wrapper cols="1">
                        <x-container.container row="1">
                            <x-typography variant="body-small-regular">
                                Ini adalah konten untuk accordion dengan varian default (red-gradient).
                                Anda bisa memasukkan teks, gambar, atau komponen lain di sini.
                            </x-typography>
                        </x-container.container>
                    </x-container.wrapper>
                </x-accordion>
            </x-container.container>

            {{-- White Background --}}
            <x-container.container row="1" class="flex flex-col gap-3">
                <x-typography variant="body-medium-semibold">White Background</x-typography>
                <x-accordion label="Accordion White Background" variant="white-background">
                    <x-container.wrapper cols="1">
                        <x-container.container row="1">
                            <x-typography variant="body-small-regular">
                                Ini adalah konten untuk accordion dengan varian white-background.
                                Anda bisa memasukkan teks, gambar, atau komponen lain di sini.
                            </x-typography>
                        </x-container.container>
                    </x-container.wrapper>
                </x-accordion>
            </x-container.container>

            {{-- Default Open --}}
            <x-container.container row="1" class="flex flex-col gap-3">
                <x-typography variant="body-medium-semibold">Default Open</x-typography>
                <x-accordion label="Accordion Default Open" :isDefaultOpen="true">
                    <x-container.wrapper cols="1">
                        <x-container.container row="1">
                            <x-typography variant="body-small-regular">
                                Accordion ini terbuka secara otomatis saat halaman dimuat.
                                Anda bisa memasukkan teks, gambar, atau komponen lain di sini.
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, odio praesentium nesciunt eius aut consequuntur voluptates. Quas adipisci dolorem ab repellendus tenetur, repellat similique tempore quod rem unde nemo! Reiciendis.
                            </x-typography>
                        </x-container.container>
                    </x-container.wrapper>
                </x-accordion>
            </x-container.container>
        </x-container.wrapper>
    </x-layouts.content>
</x-layouts.main>
