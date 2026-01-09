<x-layouts.main>
    <x-layouts.content title="Pagination Documentation">
        <x-container.wrapper cols="1" gapY="6" class="pagination-docs-wrapper border-gray-400 rounded lg">
            
            <x-container.container col="1" background="content-white" radius="lg" class="pagination-docs-inner">
                
                <x-container.wrapper rows="3" width="full" height="full" gapY="8" class="p-6">
                    
                    {{-- Part 1: Left --}}
                    <x-container.container row="1">
                        <x-container.wrapper cols="1" gapY="4">
                            <x-typography variant="body-medium-semibold">
                                1. Part 1: Per-Page Select
                            </x-typography>

                            <x-typography variant="body-small-regular" class="text-gray-500">
                                Bagian kiri dari pagination. Digunakan untuk memilih jumlah item yang ditampilkan per halaman.
                            </x-typography>
                            
                            <x-container.container background="bg-gray-50" padding="p-6" radius="lg" class="border border-dashed border-gray-300 flex items-center gap-2">
                                <x-typography variant="body-small-regular">Tampilkan</x-typography>
                                <x-pagination :part="'left'" />
                                <x-typography variant="body-small-regular">Per Halaman</x-typography>
                            </x-container.container>

                            <x-container.container background="bg-gray-900" padding="p-4" radius="lg" class="w-full h-fit">
                                <x-typography variant="body-small-regular" class="text-gray-300 text-xs font-mono">
                                    &lt;x-pagination :part="'left'" /&gt;
                                </x-typography>
                            </x-container.container>
                        </x-container.wrapper>
                    </x-container.container>

                    {{-- Part 2: Center --}}
                    <x-container.container row="1">
                        <x-container.wrapper cols="1" gapY="4" >
                            <x-typography variant="body-medium-semibold">
                                2. Part 2: Result & Pages
                            </x-typography>

                            <x-typography variant="body-small-regular" class="text-gray-500">
                                Bagian tengah berisi tombol navigasi (Sebelumnya dan Selanjutnya), serta daftar halaman.
                            </x-typography>

                            <x-container.container background="bg-gray-50" padding="p-6" radius="lg" class="border border-dashed border-gray-300 overflow-x-auto">
                                <x-container.container class="flex flex-col items-center gap-4 w-full"
                                    x-data="{ 
                                        limit: 10, 
                                        page: 1, 
                                        total: 100,
                                        get start() { return (this.page - 1) * this.limit + 1; },
                                        get end() { return Math.min(this.page * this.limit, this.total); }
                                    }"
                                    @pagination-change="page = $event.detail.page; limit = $event.detail.limit; total = $event.detail.total"
                                >
                                    {{-- Manual Result Text + Pagination --}}
                                    <x-container.container class="flex items-center gap-4">
                                        {{-- Result Text External --}}
                                        <x-typography variant="body-small-regular" class="pagination-result-text hidden lg:block" style="min-width: 140px; text-align: right;"
                                            x-text="'Hasil: ' + ((page-1)*limit + 1) + ' - ' + Math.min(page*limit, total) + ' dari ' + total"
                                        >
                                        </x-typography>
                                        
                                        {{-- The Pagination Component --}}
                                        <x-pagination :part="'center'" :defaultPerPageOptions="[5,10,20]" />
                                    </x-container.container>
                                </x-container.container>
                            </x-container.container>

                            <x-container.container background="bg-gray-900" padding="p-4" radius="lg" class="w-full h-fit">
                                <x-typography variant="body-small-regular" class="text-gray-300 text-xs font-mono">
                                    &lt;div class="flex items-center gap-4"&gt;<br>
                                    &nbsp;&nbsp;&lt;span&gt;Hasil: ...&lt;/span&gt;<br>
                                    &nbsp;&nbsp;&lt;x-pagination :part="'center'" /&gt;<br>
                                    &lt;/div&gt;
                                </x-typography>
                            </x-container.container>
                        </x-container.wrapper>
                    </x-container.container>

                    {{-- Part 3: Right --}}
                    <x-container.container row="1">
                        <x-container.wrapper cols="1" gapY="4">
                            <x-typography variant="body-medium-semibold">
                                3. Part 3: Search Page
                            </x-typography>

                            <x-typography variant="body-small-regular" class="text-gray-500">
                                Bagian kanan yang hanya berisi tombol pencarian halaman.
                            </x-typography>

                            <x-container.container background="bg-gray-50" gap="gap-4" padding="p-6" radius="lg" class="border border-dashed border-gray-300">
                                <x-pagination :part="'right'" />
                            </x-container.container>

                            <x-container.container background="bg-gray-900" padding="p-4" radius="lg" class="w-full h-fit">
                                <x-typography variant="body-small-regular" class="text-gray-300 text-xs font-mono">
                                    &lt;x-pagination :part="'right'" /&gt;
                                </x-typography>
                            </x-container.container>
                        </x-container.wrapper>
                    </x-container.container>

                </x-container.wrapper>
            </x-container.container>
        </x-container.wrapper>
    </x-layouts.content>
</x-layouts.main>
