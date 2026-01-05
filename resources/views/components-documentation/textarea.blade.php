<x-layouts.main>
    <x-layouts.content title="Textarea Documentation">
 
        <x-container.wrapper cols="1" gapY="6" class="textarea-docs-wrapper border-gray-400 rounded lg">
            <x-container.container col="1" background="content-white" radius="lg" padding="p-6" class="rounded-none bg-none no-border">
 
                <x-container.wrapper rows="11" width="full" height="full" gapY="8" x-data="textareaDocs()">
                    {{--  Demo 1  --}}
                    <x-container.container row="1">
                        <x-container.wrapper cols="1" gapY="4">
                            <x-typography variant="body-medium-semibold">
                                1. Penggunaan Dasar
                            </x-typography>
 
                            <x-typography variant="body-small-regular" class="text-gray-500">
                                Implementasi textarea paling dasar.
                            </x-typography>
 
                            <x-form.textarea name="basic" placeholder="Tulis sesuatu di sini..." x-model="form.basic"
                                class="w-full" />
                        </x-container.wrapper>
                    </x-container.container>

                    {{--  Demo 2  --}}
                    <x-container.container row="1">
                        <x-container.wrapper cols="1" gapY="4">
                            <x-typography variant="body-medium-semibold">
                                2. Textarea dengan Deskripsi
                            </x-typography>
 
                            <x-typography variant="body-small-regular" class="text-gray-500">
                                Untuk input teks panjang seperti deskripsi.
                            </x-typography>
 
                            <x-form.textarea name="description" placeholder="Tulis deskripsi di sini..."
                                x-model="form.description" class="w-full" />
                        </x-container.wrapper>
                    </x-container.container>
                    {{--  Demo 3  --}}
                    <x-container.container row="1">
                        <x-container.wrapper cols="1" gapY="4">
                            <x-typography variant="body-medium-semibold">
                                3. Batasan Karakter
                            </x-typography>
 
                            <x-typography variant="body-small-regular" class="text-gray-500">
                                Counter otomatis berubah warna.
                            </x-typography>
 
                            <x-form.textarea name="limited" :maxChar="200" placeholder="Maksimal 200 karakter..."
                                x-model="form.limited" class="w-full" />
                        </x-container.wrapper>
                    </x-container.container>

                    {{--  Demo 4  --}}
                    <x-container.container row="1">
                        <x-container.wrapper cols="1" gapY="4">
                            <x-typography variant="body-medium-semibold">
                                4. Helper Text
                            </x-typography>
 
                            <x-typography variant="body-small-regular" class="text-gray-500">
                                Menampilkan petunjuk tambahan.
                            </x-typography>
 
                            <x-form.textarea name="helper" helperText="Tuliskan catatan Anda..." :maxChar="500"
                                x-model="form.helper" class="w-full" />
                        </x-container.wrapper>
                    </x-container.container>
 
                    {{--  Demo 5  --}}
                    <x-container.container row="1">
                        <x-container.wrapper cols="1" gapY="4">
                            <x-typography variant="body-medium-semibold">
                                5. Custom ID
                            </x-typography>
 
                            <x-typography variant="body-small-regular" class="text-gray-500">
                                Textarea dengan atribut HTML tambahan.
                            </x-typography>
 
                            <x-form.textarea id="customTextarea" name="custom" placeholder="Custom textarea..."
                                x-model="form.custom" class="w-full font-mono" />
                        </x-container.wrapper>
                    </x-container.container>
                    
                                        {{--  Demo 6  --}}
                    <x-container.container row="1">
                        <x-container.wrapper cols="1" gapY="4">
                            <x-typography variant="body-medium-semibold">
                                6. Dengan Label
                            </x-typography>
 
                            <x-typography variant="body-small-regular" class="text-gray-500">
                                Label dan required indicator.
                            </x-typography>
 
                            <x-form.textarea name="with_label" :showLabel="true" label="Deskripsi Produk"
                                :required="true" :maxChar="200" helperText="Informasi produk yang detail"
                                x-model="form.with_label" class="w-full" />
                        </x-container.wrapper>
                    </x-container.container>

                    {{--  Demo 7  --}}
                    <x-container.container row="1">
                        <x-container.wrapper cols="1" gapY="4">
                            <x-typography variant="body-medium-semibold">
                                7. Error State
                            </x-typography>
 
                            <x-typography variant="body-small-regular" class="text-gray-500">
                                Menampilkan pesan error.
                            </x-typography>
 
                            <x-form.textarea name="error_state" :showLabel="true" label="Catatan"
                                error="Field ini wajib diisi" :required="true" :maxChar="100"
                                x-model="form.error_state" class="w-full" />
                        </x-container.wrapper>
                    </x-container.container>
 
                    {{--  Demo 8  --}}
                    <x-container.container row="1">
                        <x-container.wrapper cols="1" gapY="4">
                            <x-typography variant="body-medium-semibold">
                                8. Disabled
                            </x-typography>
 
                            <x-typography variant="body-small-regular" class="text-gray-500">
                                Textarea tidak bisa diedit.
                            </x-typography>
 
                            <x-form.textarea name="disabled" :showLabel="true" label="Data Lama"
                                value="Ini adalah data yang tidak dapat diubah" :disabled="true"
                                helperText="Textarea ini disabled" class="w-full" />
                        </x-container.wrapper>
                    </x-container.container>
                    {{--  Demo 9  --}}
                    <x-container.container row="1">
                        <x-container.wrapper cols="1" gapY="4">
                            <x-typography variant="body-medium-semibold">
                                9. Resizer Control
                            </x-typography>
 
                            <x-typography variant="body-small-regular" class="text-gray-500">
                                Resize dimatikan.
                            </x-typography>
 
                            <x-form.textarea name="no_resize" :resizer="false" :showLabel="true" label="Fixed Size"
                                helperText="Resizing dinonaktifkan" x-model="form.no_resize" class="w-full" />
                        </x-container.wrapper>
                    </x-container.container>
 
                      {{--  Demo 10  --}}
                    <x-container.container row="1">
                        <x-container.wrapper cols="1" gapY="4">
                            <x-typography variant="body-medium-semibold">
                                10. Clear Button
                            </x-typography>
 
                            <x-typography variant="body-small-regular" class="text-gray-500">
                                Tombol clear muncul saat ada teks.
                            </x-typography>
 
                            <x-form.textarea name="with_clear" :showClearButton="true" :maxChar="200"
                                helperText="Klik untuk menghapus" x-model="form.with_clear" class="w-full" />
                        </x-container.wrapper>
                    </x-container.container>

                    {{--  Demo 11  --}}
                    <x-container.container row="1">
                        <x-container.wrapper cols="1" gapY="4">
                            <x-typography variant="body-medium-semibold">
                                11. Preview Mode
                            </x-typography>
 
                            <x-form.textarea name="preview" :maxChar="300" x-model="form.preview" class="w-full" />
 
                            <x-container.container x-show="form.preview" x-cloak class="p-3 border rounded bg-gray-50">
                                <x-typography variant="body-small-semibold">Preview:</x-typography>
                                <x-typography variant="body-small-regular" x-text="form.preview" />
                            </x-container.container>
                        </x-container.wrapper>
                    </x-container.container>
                </x-container.wrapper>
            </x-container.container>
 
        </x-container.wrapper>
 
    </x-layouts.content>
 
</x-layouts.main>
 