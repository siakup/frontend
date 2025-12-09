@extends('layouts.main')

@section('title', 'Switch Documentation')

@section('content')

    <x-container.container variant="content-wrapper">
        <x-container.container class="p-6 bg-white border border-gray-200 rounded-lg flex flex-col gap-10">
            <x-typography variant="body-large-semibold" class="mb-4">
                Komponen Switch
            </x-typography>

            <div>
                <x-typography variant="body-medium-semibold" class="mb-3">
                    Props
                </x-typography>

                <div class="space-y-3 text-gray-700 text-sm leading-relaxed">
                    <p>
                        <span class="font-semibold">name</span>
                        — Nama field yang dikirim pada form. Value yang dikirim adalah <code>1</code> (ON) dan
                        <code>0</code> (OFF).
                    </p>

                    <p>
                        <span class="font-semibold">value</span>
                        — Nilai default switch. Menerima <code>true</code> (ON) atau <code>false</code> (OFF).
                    </p>

                    <p>
                        <span class="font-semibold">externalOnLabel</span>
                        — Label teks yang ditampilkan di luar switch ketika ON. Default: <code>Aktif</code>.
                    </p>

                    <p>
                        <span class="font-semibold">externalOffLabel</span>
                        — Label teks yang ditampilkan di luar switch ketika OFF. Default: <code>Tidak Aktif</code>.
                    </p>

                    <p>
                        <span class="font-semibold">disabled</span>
                        — Jika bernilai <code>true</code>, switch tidak bisa ditekan.
                    </p>

                    <p>
                        <span class="font-semibold">x-model</span>
                        — (Opsional) Jika diberikan, switch akan sinkron dengan state Alpine.
                        Jika tidak diberikan, switch tetap bekerja normal berdasarkan nilai <code>value</code>.
                    </p>
                </div>
            </div>

            <div>
                <x-typography variant="body-medium-semibold" class="mb-4">
                    Preview Variants
                </x-typography>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                    <x-container.container
                        class="border-2 border-dashed border-purple-300 p-6 rounded-lg flex flex-col gap-6">

                        {{-- ON --}}
                        <div x-data="{ status: true }" class="flex items-center gap-3">
                            <x-form.switch name="switch_on" :value="true" x-model="status" />
                            <span>SWITCH ON</span>
                        </div>

                        {{-- OFF --}}
                        <div x-data="{ status: false }" class="flex items-center gap-3">
                            <x-form.switch name="switch_off" :value="false" x-model="status" />
                            <span>SWITCH OFF</span>
                        </div>

                        {{-- ON + DISABLED --}}
                        <div x-data="{ status: true }" class="flex items-center gap-3">
                            <x-form.switch name="switch_on_disabled" :value="true" disabled x-model="status" />
                            <span>SWITCH ON + DISABLED</span>
                        </div>

                        {{-- OFF + DISABLED --}}
                        <div x-data="{ status: false }" class="flex items-center gap-3">
                            <x-form.switch name="switch_off_disabled" :value="false" disabled x-model="status" />
                            <span>SWITCH OFF + DISABLED</span>
                        </div>

                    </x-container.container>
                </div>
            </div>

            <div>
                <x-typography variant="body-medium-semibold" class="mb-3">
                    Contoh Penggunaan Dasar
                </x-typography>

                <pre class="bg-gray-900 text-gray-100 p-4 rounded-lg text-sm overflow-x-auto">
                &lt;x-form.switch name="is_active" :value="true" /&gt;
                </pre>
            </div>

            <div>
                <x-typography variant="body-medium-semibold" class="mb-3">
                    Contoh dengan Alpine x-model
                </x-typography>

                <pre class="bg-gray-900 text-gray-100 p-4 rounded-lg text-sm overflow-x-auto">
                &lt;div x-data="{ status: true }"&gt;
                    &lt;x-form.switch name="status" x-model="status" /&gt;

                    &lt;div class="mt-2"&gt;
                        Status sekarang: 
                        &lt;span x-text="status ? 'AKTIF' : 'NON AKTIF'"&gt;&lt;/span&gt;
                    &lt;/div&gt;
                &lt;/div&gt;
                </pre>

                <div class="border p-4 rounded-lg mt-3">
                    <div x-data="{ status: true }" class="space-y-3">
                        <x-form.switch name="status_example" x-model="status" />

                        <div>
                            Status sekarang: <span x-text="status ? 'AKTIF' : 'NON AKTIF'" class="font-semibold"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <x-typography variant="body-medium-semibold" class="mb-3">
                    Contoh dalam Form
                </x-typography>

                <pre class="bg-gray-900 text-gray-100 p-4 rounded-lg text-sm overflow-x-auto">
                &lt;form method="POST" action="/save"&gt;
                    @csrf

                    &lt;x-form.switch 
                        name="notifications" 
                        :value="true"
                        externalOnLabel="Aktif" 
                        externalOffLabel="Tidak Aktif" 
                    /&gt;

                    &lt;button type="submit" class="mt-4 btn-primary"&gt;
                        Simpan
                    &lt;/button&gt;
                &lt;/form&gt;
                </pre>
            </div>

        </x-container.container>
    </x-container.container>

@endsection
