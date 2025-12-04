@extends('layouts.main')

@section('title', 'Radio Form Documentation')

@section('content')
    <x-container variant="content-wrapper">
        <x-typography variant="body-large-semibold">Komponen Radio Button</x-typography>

        <div x-data="{
            gender: '',
            status: 'tetap',
            preference: '',
            role: ''
        }">
            <x-container class="flex flex-col gap-10 p-6 bg-white border border-gray-200" borderRadius="rounded-lg">

                <div>
                    <x-typography variant="body-medium-semibold" class="mb-4">1. Penggunaan Dasar</x-typography>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.checkbox 
                                name="gender_basic" 
                                label="Jenis Kelamin" 
                                :options="[
                                    ['value' => 'L', 'label' => 'Laki-laki'],
                                    ['value' => 'P', 'label' => 'Perempuan']
                                ]"
                                x-model="gender"
                            />
                            
                            <div class="mt-2 text-sm text-gray-600">
                                Selected: <span x-text="gender || '-'"></span>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                            &lt;x-form.checkbox 
                                name="gender" 
                                label="Jenis Kelamin" 
                                :options="[
                                    ['value' => 'L', 'label' => 'Laki-laki'],
                                    ['value' => 'P', 'label' => 'Perempuan']
                                ]"
                                x-model="gender"
                            /&gt;</pre>
                        </div>
                    </div>
                </div>
                
                <hr class="border-gray-200">

                <div>
                    <x-typography variant="body-medium-semibold" class="mb-4">2. Helper Text & Default Value</x-typography>
                    <x-typography variant="body-small-regular" class="mb-2 text-gray-500">
                        Opsi 'Pegawai Tetap' terpilih secara default karena <code>value="tetap"</code> diset di awal.
                    </x-typography>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.checkbox 
                                name="status_pegawai" 
                                label="Status Kepegawaian" 
                                :options="[
                                    ['value' => 'tetap', 'label' => 'Pegawai Tetap'],
                                    ['value' => 'kontrak', 'label' => 'Kontrak Tahunan'],
                                    ['value' => 'magang', 'label' => 'Internship']
                                ]"
                                helperText="Pilih status kepegawaian saat ini."
                                x-model="status"
                            />
                        </div>
                        <div class="flex items-center">
                            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                            &lt;x-form.checkbox 
                                name="status" 
                                label="Status" 
                                :options="..." 
                                helperText="Pilih status kepegawaian."
                                value="tetap"
                            /&gt;</pre>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-200">

                <div>
                    <x-typography variant="body-medium-semibold" class="mb-4">3. Validasi Required (Client Side)</x-typography>
                    <x-typography variant="body-small-regular" class="mb-2 text-gray-500">
                        Tambahkan props <code>required</code>. Jika user mencoba memilih lalu membatalkannya (atau logic form submit), pesan error akan muncul. 
                        <br><em>(Catatan: Radio button native sulit di-uncheck user, biasanya validasi ini muncul saat form submit pertama kali kosong).</em>
                    </x-typography>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.checkbox 
                                name="preference" 
                                label="Preferensi Waktu" 
                                :options="[
                                    ['value' => 'pagi', 'label' => 'Pagi (08:00 - 12:00)'],
                                    ['value' => 'siang', 'label' => 'Siang (13:00 - 16:00)']
                                ]"
                                required
                                helperText="Wajib dipilih."
                                x-model="preference"
                            />
                            <button @click="preference = ''" class="text-xs text-red-500 underline mt-2">
                                Reset (Simulasi Kosong)
                            </button>
                        </div>
                        <div class="flex items-center">
                            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                            &lt;x-form.checkbox 
                                name="preference" 
                                label="Preferensi" 
                                :options="..." 
                                required
                            /&gt;</pre>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-200">

                <div>
                    <x-typography variant="body-medium-semibold" class="mb-4">4. Error State (Backend/Manual)</x-typography>
                    <x-typography variant="body-small-regular" class="mb-2 text-gray-500">
                        Simulasi jika ada error dari backend (misal: kuota penuh untuk role tersebut).
                    </x-typography>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-form.checkbox 
                                name="role" 
                                label="Pilih Role Access" 
                                :options="[
                                    ['value' => 'admin', 'label' => 'Administrator'],
                                    ['value' => 'editor', 'label' => 'Editor Content'],
                                    ['value' => 'viewer', 'label' => 'Viewer Only']
                                ]"
                                value="admin"
                                error="Role Administrator sudah penuh untuk departemen ini."
                                x-model="role"
                            />
                        </div>
                        <div class="flex items-center">
                            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                            &lt;x-form.checkbox 
                                name="role" 
                                error="Pesan error dari server..." 
                            /&gt;</pre>
                        </div>
                    </div>
                </div>

            </x-container>
        </div>

    </x-container>
@endsection