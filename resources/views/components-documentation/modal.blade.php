@extends('layouts.main')

@section('title', 'Modal Documentation')

@section('content')

    <x-container variant="content-wrapper">
        <x-typography variant="body-large-semibold">Komponen Modal</x-typography>

        <div x-data="{}" class="space-y-10">
            
            <x-container class="flex flex-col gap-6 p-6 bg-white border border-gray-200" borderRadius="rounded-lg">
                <div>
                    <x-typography variant="body-medium-semibold" class="mb-2">1. Base Modal</x-typography>

                    <div class="flex gap-4">
                        <x-button.primary x-data x-on:click="$dispatch('open-modal', { id: 'demo-base-modal' })">
                            Buka Base Modal
                        </x-button.primary>
                    </div>
                    <x-modal.container id="demo-base-modal" maxWidth="lg">
                        <x-slot name="header">
                            <h2 class="text-lg font-bold text-gray-900">Judul Modal</h2>
                        </x-slot>

                        <div class="py-4">
                            <p class="text-gray-600">
                                Ini adalah konten body modal. Anda bisa memasukkan form, teks, atau komponen lain di sini.
                            </p>
                        </div>

                        <x-slot name="footer">
                            <div class="flex justify-end gap-2 w-full">
                                <x-button.secondary x-on:click="$dispatch('close-modal', { id: 'demo-base-modal' })">
                                    Tutup
                                </x-button.secondary>
                                <x-button.primary>Simpan</x-button.primary>
                            </div>
                        </x-slot>
                    </x-modal.container>
                </div>

                <div class="mt-2 p-4 border border-gray-300 rounded-lg bg-gray-50 text-xs">
                    <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                    &lt;!-- Trigger --&gt;
                    &lt;button x-on:click="$dispatch('open-modal', { id: 'my-modal' })"&gt;Open&lt;/button&gt;

                    &lt;!-- Component --&gt;
                    &lt;x-modal.container id="my-modal" maxWidth="lg"&gt;
                        &lt;x-slot name="header"&gt; Judul &lt;/x-slot&gt;
                        
                        Isi konten...

                        &lt;x-slot name="footer"&gt; Tombol... &lt;/x-slot&gt;
                    &lt;/x-modal.container&gt;</pre>
                </div>
            </x-container>

            <x-container class="flex flex-col gap-6 p-6 bg-white border border-gray-200" borderRadius="rounded-lg">
                <div>
                    <x-typography variant="body-medium-semibold" class="mb-2">2. Confirmation Modal</x-typography>

                    <div class="flex gap-4">
                        <x-button.primary x-data class="!bg-red-600 !border-red-600" x-on:click="$dispatch('open-modal', { id: 'demo-confirm-modal' })">
                            Hapus Data
                        </x-button.primary>
                    </div>

                    <x-modal.confirmation 
                        id="demo-confirm-modal"
                        title="Hapus Data?"
                        confirmText="Ya, Hapus"
                        cancelText="Batal"
                    >
                        Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.
                    </x-modal.confirmation>
                </div>

                <div class="mt-2 p-4 border border-gray-300 rounded-lg bg-gray-50 text-xs">
                    <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                    &lt;x-modal.confirmation 
                        id="delete-modal"
                        title="Konfirmasi Hapus"
                        confirmText="Ya, Hapus"
                        cancelText="Batal"
                    &gt;
                        Pesan konfirmasi anda disini...
                    &lt;/x-modal.confirmation&gt;</pre>
                </div>
            </x-container>

            <x-container class="flex flex-col gap-6 p-6 bg-white border border-gray-200" borderRadius="rounded-lg">
                <div>
                    <x-typography variant="body-medium-semibold" class="mb-2">3. Success Modal</x-typography>

                    <div class="flex gap-4">
                        <x-button.primary x-data class="!bg-green-600 !border-green-600" x-on:click="$dispatch('open-modal', { id: 'demo-success-modal' })">
                            Tampilkan Sukses
                        </x-button.primary>
                    </div>

                    <x-modal.success 
                        id="demo-success-modal"
                        title="Berhasil Disimpan!"
                        closeText="Mengerti"
                    >
                        Data perubahan telah berhasil disimpan ke database.
                    </x-modal.success>
                </div>

                <div class="mt-2 p-4 border border-gray-300 rounded-lg bg-gray-50 text-xs">
                    <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                    &lt;x-modal.success 
                        id="success-modal"
                        title="Sukses!"
                        closeText="Tutup"
                    &gt;
                        Pesan sukses...
                    &lt;/x-modal.success&gt;</pre>
                </div>
            </x-container>

            <x-container class="flex flex-col gap-6 p-6 bg-white border border-gray-200" borderRadius="rounded-lg">
                <div>
                    <x-typography variant="body-medium-semibold" class="mb-2">4. Layout Modal Js</x-typography>

                    <div class="flex gap-4">
                        <button 
                            onclick="document.getElementById('demo-raw-modal').classList.remove('hidden'); document.getElementById('demo-raw-modal').classList.add('flex');"
                            class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700 text-sm">
                            Buka Raw Modal
                        </button>
                    </div>

                    <x-modal.container-pure-js id="demo-raw-modal" class="hidden">
                        <x-slot name="header">
                            <span class="font-bold text-lg">Raw Modal Title</span>
                        </x-slot>
                        
                        <x-slot name="body">
                            <p>Ini adalah modal tanpa Alpine.js. Klik background hitam untuk menutup.</p>
                        </x-slot>

                        <x-slot name="footer">
                            <button 
                                onclick="document.getElementById('demo-raw-modal').classList.add('hidden'); document.getElementById('demo-raw-modal').classList.remove('flex');"
                                class="text-blue-600 hover:underline">
                                Tutup Manual
                            </button>
                        </x-slot>
                    </x-modal.container-pure-js>
                </div>

                <div class="mt-2 p-4 border border-gray-300 rounded-lg bg-gray-50 text-xs">
                    <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                    &lt;x-modal.container-pure-js id="my-raw-modal"&gt;
                        &lt;x-slot name="header"&gt;...&lt;/x-slot&gt;
                        &lt;x-slot name="body"&gt;...&lt;/x-slot&gt;
                        &lt;x-slot name="footer"&gt;...&lt;/x-slot&gt;
                    &lt;/x-modal.container-pure-js&gt;</pre>
                </div>
            </x-container>

        </div>

    </x-container>
@endsection
