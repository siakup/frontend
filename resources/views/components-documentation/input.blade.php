@extends('layouts.main')

@section('title', 'Input Form Documentation')

@section('content')
    <x-container.wrapper :rows="12">
        <x-typography variant="body-large-semibold">Komponen Input Form</x-typography>
        <div x-data="{
            form: {
                basic: '',
                nip: '',
                nik: '',
                username: '',
                email: '',
                password: '',
                phone: '',
                custom_user: '',
                manual_regex: ''
            }
        }"
        
        class="row-span-11">
            <x-container.container class="flex-col" :background="'content-white'" :gap="'gap-10'" :padding="'p-6'">

                <div>
                    <x-typography variant="body-medium-semibold" class="mb-4">1. Penggunaan Dasar</x-typography>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.input name="basic" label="Input Standar" placeholder="Ketik sesuatu..."
                                x-model="form.basic" />
                        </div>
                        <div class="flex items-center">
                            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                            &lt;x-form.input 
                                name="basic" 
                                label="Input Standar" 
                                x-model="form.basic" 
                            /&gt;</pre>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-200">

                <div>
                    <x-typography variant="body-medium-semibold" class="mb-2">2. Variant: Identitas (NIP &
                        KTP)</x-typography>
                    <x-typography variant="body-small-regular" class="mb-4 text-gray-500">
                        Otomatis memvalidasi input agar hanya menerima angka.
                        <code>nip</code> (5-30 digit) dan <code>ktp</code> (Wajib 16 digit).
                    </x-typography>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.input name="nip" label="NIP (Variant)" variant="nip" placeholder="199801..."
                                x-model="form.nip" />
                        </div>
                        <div>
                            <x-form.input name="nik" label="NIK / KTP (Variant)" variant="ktp" placeholder="3201..."
                                x-model="form.nik" />
                        </div>
                    </div>

                    <div class="mt-4 flex items-center">
                        <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                        &lt;!-- Validasi: Angka, Min 5, Max 30 --&gt;
                        &lt;x-form.input name="nip" label="NIP" variant="nip" /&gt;

                        &lt;!-- Validasi: Angka, Exact 16 Digit --&gt;
                        &lt;x-form.input name="nik" label="NIK" variant="ktp" /&gt;</pre>
                    </div>
                </div>

                <hr class="border-gray-200">

                <div>
                    <x-typography variant="body-medium-semibold" class="mb-2">3. Variant: Akun (Username &
                        Email)</x-typography>
                    <x-typography variant="body-small-regular" class="mb-4 text-gray-500">
                        <code>username</code> membatasi input (a-z, 0-9, underscore). <code>email</code> memvalidasi format
                        email standar.
                    </x-typography>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.input name="username" label="Username" variant="username" placeholder="user_123"
                                x-model="form.username" required {{-- Contoh penggabungan dengan required --}} />
                        </div>
                        <div>
                            <x-form.input name="email" label="Email" variant="email" placeholder="mail@example.com"
                                x-model="form.email" />
                        </div>
                    </div>

                    <div class="mt-4 flex items-center">
                        <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                        &lt;x-form.input name="username" variant="username" required /&gt;
                        &lt;x-form.input name="email" variant="email" /&gt;</pre>
                    </div>
                </div>

                <hr class="border-gray-200">

                <div>
                    <x-typography variant="body-medium-semibold" class="mb-2">4. Variant: Password & Phone</x-typography>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.input name="password" label="Password" variant="password" placeholder="******"
                                x-model="form.password" />
                        </div>
                        <div>
                            <x-form.input name="phone" label="Nomor HP" variant="phone" placeholder="0812..."
                                x-model="form.phone" />
                        </div>
                    </div>
                </div>

                <hr class="border-gray-200">

                <div>
                    <x-typography variant="body-medium-semibold" class="mb-2">5. Override Variant
                        (Kustomisasi)</x-typography>
                    <x-typography variant="body-small-regular" class="mb-4 text-gray-500">
                        Anda bisa menggunakan variant sebagai dasar, lalu <strong>menimpa</strong> aturan tertentu secara
                        manual.
                        <br>Contoh: Menggunakan variant <code>username</code> tapi membatasi <code>maxlength="10"</code>
                        (Defaultnya 20).
                    </x-typography>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.input name="custom_user" label="Username Pendek (Max 10)" variant="username"
                                maxlength="10" helperText="Username khusus, maksimal 10 huruf."
                                x-model="form.custom_user" />
                        </div>
                        <div class="flex items-center">
                            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                            &lt;x-form.input 
                                name="user" 
                                variant="username" 
                                maxlength="10" 
                                helperText="Username khusus."
                            /&gt;</pre>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-200">

                <div>
                    <x-typography variant="body-medium-semibold" class="mb-2">6. Validasi Manual (Regex)</x-typography>
                    <x-typography variant="body-small-regular" class="mb-4 text-gray-500">
                        Jika tidak ada variant yang cocok, Anda bisa membuat validasi sendiri menggunakan props
                        <code>pattern</code>.
                    </x-typography>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.input name="kode_barang" label="Kode Barang (Format: BRG-Angka)"
                                placeholder="BRG-001" pattern="BRG-[0-9]{3}"
                                patternMessage="Format harus 'BRG-' diikuti 3 angka." helperText="Contoh: BRG-123"
                                x-model="form.manual_regex" />
                        </div>
                        <div class="flex items-center">
                            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                        &lt;x-form.input 
                            label="Kode Barang" 
                            pattern="BRG-[0-9]{3}"
                            patternMessage="Format salah."
                        /&gt;</pre>
                        </div>
                    </div>
                </div>

            </x-container.container>
        </div>
    </x-container.wrapper>
@endsection
