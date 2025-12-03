@extends('layouts.main')

@section('title', 'File Upload Documentation')

@section('content')
    <x-container variant="content-wrapper">
        <x-typography variant="body-large-semibold">Komponen File Upload</x-typography>

        <div x-data="{}">
            <x-container class="flex flex-col gap-10 p-6 bg-white border border-gray-200" borderRadius="rounded-lg">

                <div>
                    <x-typography variant="body-medium-semibold" class="mb-4">1. Penggunaan Dasar</x-typography>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.file 
                                name="document" 
                                label="Upload Dokumen" 
                            />
                        </div>

                        <div class="flex items-center">
                            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                            &lt;x-form.file 
                                name="document" 
                                label="Upload Dokumen" 
                            /&gt;</pre>
                        </div>
                    </div>
                </div>
                
                <hr class="border-gray-200">

                <div>
                    <x-typography variant="body-medium-semibold" class="mb-4">2. Helper Text & Filter Format</x-typography>
                    <x-typography variant="body-small-regular" class="mb-2 text-gray-500">
                        Gunakan props <code>accept</code> untuk membatasi tipe file (misal: gambar saja) dan <code>helperText</code> untuk panduan.
                    </x-typography>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.file 
                                name="avatar" 
                                label="Foto Profil" 
                                accept="image/png, image/jpeg"
                                helperText="Format: JPG, PNG. Maks 2MB."
                            />
                        </div>
                        <div class="flex items-center">
                            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                            &lt;x-form.file 
                                name="avatar" 
                                label="Foto Profil" 
                                accept="image/png, image/jpeg"
                                helperText="Format: JPG, PNG. Maks 2MB."
                            /&gt;</pre>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-200">

                <div>
                    <x-typography variant="body-medium-semibold" class="mb-4">3. Multiple File Upload</x-typography>
                    <x-typography variant="body-small-regular" class="mb-2 text-gray-500">
                        Tambahkan props <code>multiple</code> untuk mengizinkan upload banyak file sekaligus.
                    </x-typography>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.file 
                                name="attachments[]" 
                                label="Lampiran Pendukung" 
                                multiple
                                helperText="Bisa upload lebih dari satu file."
                            />
                        </div>
                        <div class="flex items-center">
                            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                            &lt;x-form.file 
                                name="attachments[]" 
                                label="Lampiran" 
                                multiple
                            /&gt;</pre>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-200">

                <div>
                    <x-typography variant="body-medium-semibold" class="mb-4">4. Error State (Validasi Server)</x-typography>
                    <x-typography variant="body-small-regular" class="mb-2 text-gray-500">
                        Simulasi tampilan ketika terjadi error validasi dari server (misal: file terlalu besar).
                    </x-typography>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.file 
                                name="cv" 
                                label="Curriculum Vitae" 
                                error="File terlalu besar (Maks 5MB)."
                            />
                        </div>
                        <div class="flex items-center">
                            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                            &lt;x-form.file 
                                name="cv" 
                                label="Curriculum Vitae" 
                                error="File terlalu besar..." 
                            /&gt;</pre>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-200">

                <div>
                    <x-typography variant="body-medium-semibold" class="mb-4">5. Disabled State</x-typography>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.file 
                                name="readonly_doc" 
                                label="Dokumen Terkunci" 
                                disabled
                                helperText="Upload dinonaktifkan."
                            />
                        </div>
                        <div class="flex items-center">
                            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                            &lt;x-form.file 
                                name="doc" 
                                disabled 
                            /&gt;</pre>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-200">

                <div>
                    <x-typography variant="body-medium-semibold" class="mb-4">6. Validasi (Required & Max Size)</x-typography>
                    <x-typography variant="body-small-regular" class="mb-2 text-gray-500">
                        Fitur validasi di sisi client. Props <code>required</code> akan menambahkan tanda bintang (*). 
                        Props <code>maxSize</code> (dalam KB) akan menolak file yang melebihi batas sebelum diupload.
                    </x-typography>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.file 
                                name="ktp" 
                                label="Upload KTP (Wajib)" 
                                required
                                helperText="Kolom ini wajib diisi."
                            />
                        </div>

                        <div>
                            <x-form.file 
                                name="large_file" 
                                label="File Terbatas (Max 5MB)" 
                                :maxSize="5120"
                                helperText="Coba upload file > 5MB untuk melihat error."
                            />
                        </div>
                    </div>

                    <div class="mt-4 flex items-center">
                        <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                        &lt;!-- Required --&gt;
                        &lt;x-form.file name="ktp" label="Upload KTP" required /&gt;

                        &lt;!-- Max Size (5MB = 5120 KB) --&gt;
                        &lt;x-form.file name="file" label="File" :maxSize="5120" /&gt;</pre>
                    </div>
                </div>
            </x-container>
        </div>
    </x-container>
@endsection