@extends('layouts.main')

@section('title', 'Input Form Documentation')

@section('content')
    <x-container variant="content-wrapper">
        <x-typography variant="body-large-semibold">Komponen Input Form</x-typography>

        <div x-data="{
            textVal: '',
            searchVal: '',
            numberVal: '',
            form: {
                nip: '',
                email: '',
                username: '',
                password: ''
            }
        }">
            <x-container class="flex flex-col gap-10 p-6 bg-white border border-gray-200" borderRadius="rounded-lg">

                <div>
                    <x-typography variant="body-medium-semibold" class="mb-4">1. Penggunaan Dasar</x-typography>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.input name="basic" placeholder="Input Biasa" />
                            <div class="mt-2 text-xs text-gray-500 font-mono bg-gray-100 p-2 rounded">
                                &lt;x-form.input name="basic" /&gt;
                            </div>
                        </div>

                        <div>
                            <x-form.input name="fullname" label="Nama Lengkap" placeholder="John Doe" />
                            <div class="mt-2 text-xs text-gray-500 font-mono bg-gray-100 p-2 rounded">
                                &lt;x-form.input label="Nama" ... /&gt;
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr class="border-gray-200">

                <div>
                    <x-typography variant="body-medium-semibold" class="mb-2">2. Validasi NIP (Min/Max Length)</x-typography>
                    <x-typography variant="body-small-regular" class="mb-4 text-gray-500">
                        Coba ketik kurang dari 5 karakter atau lebih dari 18 karakter. Helper text akan berubah jadi error.
                    </x-typography>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.input 
                                name="nip" 
                                label="NIP (Angka 5-18 digit)" 
                                placeholder="19900101..." 
                                minlength="5" 
                                maxlength="18"
                                helperText="Wajib diisi, 5-18 karakter." 
                                x-model="form.nip" 
                                :showRemoveIcon="true"
                            />
                        </div>
                        <div class="flex items-center">
                            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                        &lt;x-form.input 
                            name="nip" 
                            label="NIP" 
                            minlength="5" 
                            maxlength="18" 
                            helperText="Wajib diisi, 5-18 karakter." 
                            x-model="form.nip" 
                        /&gt;</pre>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-200">

                <div>
                    <x-typography variant="body-medium-semibold" class="mb-2">3. Validasi Email</x-typography>
                    <x-typography variant="body-small-regular" class="mb-4 text-gray-500">
                        Gunakan <code>type="email"</code>. Validasi format email berjalan otomatis.
                    </x-typography>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.input 
                                type="email"
                                name="email" 
                                label="Email Institusi" 
                                placeholder="nama@domain.com"
                                helperText="Gunakan email kantor yang valid."
                                x-model="form.email"
                            />
                        </div>
                        <div class="flex items-center">
                            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                        &lt;x-form.input 
                            type="email"
                            name="email" 
                            label="Email" 
                            helperText="Gunakan email kantor valid." 
                        /&gt;</pre>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-200">

                <div>
                    <x-typography variant="body-medium-semibold" class="mb-2">4. Input Angka Saja</x-typography>
                    <x-typography variant="body-small-regular" class="mb-4 text-gray-500">
                        Gunakan <code>type="number"</code>. Input huruf akan ditolak otomatis.
                    </x-typography>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.input 
                                type="number"
                                name="age" 
                                label="Usia" 
                                placeholder="0"
                                x-model="numberVal"
                            />
                        </div>
                        <div class="flex items-center">
                            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                            &lt;x-form.input 
                                type="number"
                                label="Usia" 
                            /&gt;</pre>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-200">
            </x-container>
        </div>
    </x-container>
@endsection