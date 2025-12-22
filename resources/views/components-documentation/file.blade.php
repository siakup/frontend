@extends('layouts.main')

@section('title', 'File Upload Documentation')

@section('content')
    <x-container.container  variant="content-wrapper">
        <x-typography variant="body-large-semibold">Komponen File Upload</x-typography>

        <div class="mb-8">
            <x-typography variant="body-medium-regular">
                Komponen upload file dengan fitur <strong>Drag & Drop</strong>, preview daftar file, dan dukungan validasi.
                Menggunakan Alpine.js untuk manajemen state file di sisi client.
            </x-typography>
        </div>

        {{-- Demo Playground --}}
        <div x-data="{}">
            <x-container class="flex flex-col gap-10 p-6 bg-white border border-gray-200" borderRadius="rounded-lg">

                <div>
                    <x-typography variant="body-medium-semibold" class="mb-4">1. Penggunaan Dasar</x-typography>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.file name="document" label="Upload Dokumen" />
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
                    <x-typography variant="body-medium-semibold" class="mb-4">2. Pembatasan Tipe File
                        (Accept)</x-typography>
                    <x-typography variant="body-small-regular" class="mb-2 text-gray-500">
                        Gunakan props <code>accept</code> untuk membatasi jenis file di jendela dialog file sistem.
                    </x-typography>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.file name="avatar" label="Hanya Gambar (Image/*)" accept="image/*"
                                helperText="Menerima semua jenis gambar." />
                        </div>

                        <div>
                            <x-form.file name="laporan" label="Laporan (Excel/CSV)" accept=".csv, .xls, .xlsx"
                                helperText="Hanya file spreadsheet." />
                        </div>
                    </div>

                    <div class="mt-4 flex items-center">
                        <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                        &lt;!-- Terima Gambar Saja --&gt;
                        &lt;x-form.file name="avatar" accept="image/*" /&gt;

                        &lt;!-- Terima Ekstensi Spesifik --&gt;
                        &lt;x-form.file name="laporan" accept=".csv, .xls, .xlsx" /&gt;</pre>
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
                            <x-form.file name="attachments[]" label="Lampiran Pendukung" multiple
                                helperText="Bisa upload lebih dari satu file." />
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
                    <x-typography variant="body-medium-semibold" class="mb-4">4. Error State (Validasi
                        Server)</x-typography>
                    <x-typography variant="body-small-regular" class="mb-2 text-gray-500">
                        Simulasi tampilan ketika terjadi error validasi dari server.
                    </x-typography>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.file name="cv" label="Curriculum Vitae" error="File terlalu besar (Maks 5MB)." />
                        </div>
                        <div class="flex items-center">
                            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                        &lt;x-form.file 
                            name="cv" 
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
                            <x-form.file name="readonly_doc" label="Dokumen Terkunci" disabled
                                helperText="Upload dinonaktifkan." />
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
                    <x-typography variant="body-medium-semibold" class="mb-4">6. Validasi (Required & Max
                        Size)</x-typography>
                    <x-typography variant="body-small-regular" class="mb-2 text-gray-500">
                        Validasi sisi client. <code>required</code> menambahkan bintang merah.
                        <code>maxSize</code> (KB) membatasi ukuran file sebelum upload.
                    </x-typography>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.file name="ktp" label="Upload KTP (Wajib)" required
                                helperText="Kolom ini wajib diisi." />
                        </div>

                        <div>
                            <x-form.file name="large_file" label="File Terbatas (Max 5MB)" :maxSize="5120"
                                helperText="Coba upload file > 5MB untuk melihat error." />
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

                @if (view()->exists('components.form.file') && isset($variant))
                    <div>
                        <hr class="border-gray-200 mb-10">
                        <x-typography variant="body-medium-semibold" class="mb-4">7. Variant System</x-typography>
                        <x-typography variant="body-small-regular" class="mb-2 text-gray-500">
                            Gunakan <code>variant</code> untuk menerapkan preset validasi otomatis.
                        </x-typography>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-form.file name="ktp_var" label="Upload KTP" variant="ktp" />
                            </div>
                            <div>
                                <x-form.file name="prop_var" label="Proposal (Doc)" variant="document" />
                            </div>
                        </div>
                        <div class="mt-4">
                            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                            &lt;x-form.file name="ktp" variant="ktp" /&gt;
                            &lt;x-form.file name="proposal" variant="document" /&gt;</pre>
                        </div>
                    </div>
                @endif

            </x-container>
        </div>
    </x-container.container>
@endsection
