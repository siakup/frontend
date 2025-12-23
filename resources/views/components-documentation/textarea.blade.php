@extends('layouts.main')

@section('title', 'Textarea Documentation')

@section('content')

    <x-container.wrapper cols="2" x-data="textareaDocs()">
        <x-container.container col="1">
            <x-container.wrapper rows="11" class="gap-2">

                {{-- Demo 1 — Penggunaan Dasar --}}
                <x-container.wrapper>
                    <x-typography variant="body-medium-semibold" class="mb-2">1. Penggunaan Dasar</x-typography>
                    <x-typography variant="body-small-regular" class="mb-2 text-gray-500">Textarea ini adalah implementasi dasar penggunaan textarea.</x-typography>
                    <x-container.wrapper class="relative textarea-container">
                        <x-form.textarea name="basic" placeholder="Tulis sesuatu di sini..." x-model="form.basic" rows="4" />
                    </x-container.wrapper>
                </x-container.wrapper>

                {{-- Demo 2 — Deskripsi --}}
                <x-container.wrapper>
                    <x-typography variant="body-medium-semibold" class="mb-2">2. Textarea dengan Deskripsi</x-typography>
                    <x-typography variant="body-small-regular" class="mb-2 text-gray-500">Gunakan textarea untuk input teks panjang seperti deskripsi atau komentar.</x-typography>
                    <x-container.wrapper class="relative textarea-container">
                        <x-form.textarea name="description" placeholder="Tulis deskripsi di sini..." x-model="form.description" rows="6" />
                    </x-container.wrapper>
                </x-container.wrapper>

                {{-- Demo 3 — Batasan Karakter --}}
                <x-container.wrapper>
                    <x-typography variant="body-medium-semibold" class="mb-2">3. Textarea dengan Batasan Karakter</x-typography>
                    <x-typography variant="body-small-regular" class="mb-2 text-gray-500">Tambahkan properti <code>maxChar</code> untuk membatasi jumlah karakter; counter otomatis berubah warna saat mencapai batas.</x-typography>
                    <x-container.wrapper class="relative textarea-container">
                        <x-form.textarea name="limited" placeholder="Maksimal 200 karakter..." x-model="form.limited" :maxChar="200" rows="5" />
                    </x-container.wrapper>
                </x-container.wrapper>

                {{-- Demo 4 — Helper Text --}}
                <x-container.wrapper>
                    <x-typography variant="body-medium-semibold" class="mb-2">4. Textarea dengan Helper Text</x-typography>
                    <x-typography variant="body-small-regular" class="mb-2 text-gray-500">Gunakan <code>helperText</code> untuk petunjuk tambahan.</x-typography>
                    <x-container.wrapper class="relative textarea-container">
                        <x-form.textarea name="helper" placeholder="Tulis catatan Anda..." x-model="form.helper" :maxChar="500" helperText="Tuliskan catatan dengan detail untuk referensi di masa mendatang" rows="6" />
                    </x-container.wrapper>
                </x-container.wrapper>

                {{-- Demo 5 — Custom ID/Atribut --}}
                <x-container.wrapper>
                    <x-typography variant="body-medium-semibold" class="mb-2">5. Textarea dengan Custom ID</x-typography>
                    <x-typography variant="body-small-regular" class="mb-2 text-gray-500">Gunakan atribut HTML tambahan sesuai kebutuhan (mis. <code>id</code>, class, dll).</x-typography>
                    <x-container.wrapper class="relative textarea-container">
                        <x-form.textarea id="customTextarea" name="custom" placeholder="Custom textarea..." x-model="form.custom" rows="5" class="font-mono" />
                    </x-container.wrapper>
                </x-container.wrapper>

                {{-- Demo 6 — Label --}}
                <x-container.wrapper>
                    <x-typography variant="body-medium-semibold" class="mb-2">6. Textarea dengan Label</x-typography>
                    <x-typography variant="body-small-regular" class="mb-2 text-gray-500">Gunakan <code>showLabel</code> dan <code>label</code> untuk menampilkan label; tambahkan <code>required</code> jika perlu.</x-typography>
                    <x-container.wrapper class="relative textarea-container">
                        <x-form.textarea name="with_label" :showLabel="true" label="Deskripsi Produk" placeholder="Tulis deskripsi produk..." x-model="form.error" :maxChar="200" :required="true" helperText="Informasi produk yang detail" rows="4" />
                    </x-container.wrapper>
                </x-container.wrapper>

                {{-- Demo 7 — Error State --}}
                <x-container.wrapper>
                    <x-typography variant="body-medium-semibold" class="mb-2">7. Textarea dengan Error State</x-typography>
                    <x-typography variant="body-small-regular" class="mb-2 text-gray-500">Contoh textarea dengan state error.</x-typography>
                    <x-container.wrapper class="relative textarea-container">
                        <x-form.textarea name="error_state" :showLabel="true" label="Catatan" placeholder="Masukkan teks..." :maxChar="100" error="Field ini wajib diisi" :required="true" rows="4" />
                    </x-container.wrapper>
                </x-container.wrapper>

                {{-- Demo 8 — Disabled --}}
                <x-container.wrapper>
                    <x-typography variant="body-medium-semibold" class="mb-2">8. Textarea Disabled</x-typography>
                    <x-typography variant="body-small-regular" class="mb-2 text-gray-500">Textarea yang tidak dapat diedit dengan prop <code>disabled</code>.</x-typography>
                    <x-container.wrapper class="relative textarea-container">
                        <x-form.textarea name="disabled" :showLabel="true" label="Data Lama" value="Ini adalah data yang tidak dapat diubah" placeholder="Disabled textarea..." :disabled="true" helperText="Textarea ini tidak dapat diubah" rows="3" />
                    </x-container.wrapper>
                </x-container.wrapper>

                {{-- Demo 9 — Resizer Control --}}
                <x-container.wrapper>
                    <x-typography variant="body-medium-semibold" class="mb-2">9. Resizer Control</x-typography>
                    <x-typography variant="body-small-regular" class="mb-2 text-gray-500">Kontrol kemampuan resize dengan prop <code>resizer</code>.</x-typography>
                    <x-container.wrapper class="relative textarea-container">
                        <x-form.textarea name="no_resize" :showLabel="true" label="Fixed Size Textarea" placeholder="Textarea ini tidak bisa di-resize..." :resizer="false" helperText="Resizing dinonaktifkan" rows="4" />
                    </x-container.wrapper>
                </x-container.wrapper>

                {{-- Demo 10 — Clear Button --}}
                <x-container.wrapper>
                    <x-typography variant="body-medium-semibold" class="mb-2">10. Clear Button</x-typography>
                    <x-typography variant="body-small-regular" class="mb-2 text-gray-500">Clear button muncul otomatis saat ada teks. Klik untuk menghapus semua teks.</x-typography>
                    <x-container.wrapper class="relative textarea-container">
                        <x-form.textarea name="with_clear" x-model="form.with_clear" :showLabel="true" label="Feedback" placeholder="Tulis feedback..." :showClearButton="true" :maxChar="200" helperText="Clear button muncul saat ada teks" rows="4" />
                    </x-container.wrapper>
                </x-container.wrapper>

                {{-- Demo 11 — Preview Mode --}}
                <x-container.wrapper>
                    <x-typography variant="body-medium-semibold" class="mb-2">11. Preview Mode</x-typography>
                    <x-typography variant="body-small-regular" class="mb-2 text-gray-500">Contoh textarea untuk mode preview dengan berbagai fitur aktif.</x-typography>
                    <x-container.wrapper class="relative textarea-container">
                        <x-form.textarea name="preview" placeholder="Tulis sesuatu untuk melihat counter..." x-model="form.preview" :maxChar="300" helperText="Teks akan ditampilkan dalam preview" rows="6" value="ini review mode" />
                    </x-container.wrapper>
                    <x-container.wrapper x-show="form.preview" class="mt-3 p-3 bg-gray-50 border border-gray-200 rounded" x-cloak>
                        <x-typography variant="body-small-semibold" class="mb-1 text-gray-700">Preview:</x-typography>
                        <x-typography variant="body-small-regular" class="text-gray-600" x-text="form.preview"></x-typography>
                    </x-container.wrapper>
                </x-container.wrapper>

            </x-container.wrapper>
        </x-container.container>
    </x-container.wrapper>

@endsection
