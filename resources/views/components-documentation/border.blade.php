@extends('layouts.main')

@section('title', 'Border Documentation')

@section('content')

<x-container.container variant="content-wrapper">
    <x-container.container class="p-6 bg-white border border-gray-200 rounded-lg flex flex-col gap-10">

        {{-- Title --}}
        <x-typography variant="body-large-semibold" class="mb-4">
            Komponen Border
        </x-typography>

        {{-- Props --}}
        <div>
            <x-typography variant="body-medium-semibold" class="mb-3">
                Props
            </x-typography>

            <div class="space-y-3 text-gray-700 text-sm leading-relaxed">
                <p><span class="font-semibold">variant</span> — Tipe garis border. Nilai: <code>solid</code>, <code>dashed</code>, <code>dotted</code>, <code>double</code>, <code>hidden</code>. Default: <code>solid</code>.</p>
                <p><span class="font-semibold">radius</span> — Border radius. Nilai: <code>sm</code>, <code>md</code>, <code>lg</code>, <code>none</code>. Default: <code>md</code>.</p>
                <p><span class="font-semibold">color</span> — Warna border, menggunakan variable Tailwind/Custom. Default: <code>gray-300</code>.</p>
                <p><span class="font-semibold">width</span> — Lebar border (px). Default: <code>1</code>.</p>
                <p><span class="font-semibold">inherit</span> — Mengikuti radius parent. Nilai: <code>true</code> / <code>false</code>. Default: <code>true</code>.</p>
            </div>
        </div>

        {{-- Preview Variants --}}
        <div>
            <x-typography variant="body-medium-semibold" class="mb-4">
                Preview Variants
            </x-typography>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- radius-lg --}}
                <x-border radius="lg" width="2" color="gray-500">
                    <x-container.container :background="'bg-red-200'" radius="inherit" padding="p-6">
                        <x-typography variant="body-medium-semibold">radius-lg (20px)</x-typography>
                        <x-typography variant="body-small-regular" class="text-gray-700">
                            Digunakan untuk bottom sheet (mobile)
                        </x-typography>
                    </x-container.container>
                </x-border>

                {{-- radius-md --}}
                <x-border radius="md" width="2" color="gray-300">
                    <x-container.container :background="'bg-red-100'" radius="md" padding="p-5">
                        <x-typography variant="body-medium-semibold">radius-md (12px)</x-typography>
                        <x-typography variant="body-small-regular" class="text-gray-700">
                            Digunakan untuk card section (website)
                        </x-typography>
                    </x-container.container>
                </x-border>

                {{-- radius-sm --}}
                <x-border radius="sm" width="2" color="gray-200">
                    <x-container.container :background="'bg-red-50'" radius="sm" padding="p-4">
                        <x-typography variant="body-medium-semibold">radius-sm (8px)</x-typography>
                        <x-typography variant="body-small-regular" class="text-gray-700">
                            Digunakan untuk card section (mobile), atau component (website)
                        </x-typography>
                    </x-container.container>
                </x-border>

            </div>
        </div>

        {{-- Contoh penggunaan --}}
        <div>
            <x-typography variant="body-medium-semibold" class="mb-3">
                Contoh Penggunaan
            </x-typography>

            <pre class="bg-gray-900 text-gray-100 p-4 rounded-lg text-sm overflow-x-auto">
                &lt;x-border radius="md" width="2" color="gray-300"&gt;
                    &lt;x-container.container padding="p-4" radius="md"&gt;
                        Konten di dalam border
                    &lt;/x-container.container&gt;
                &lt;/x-border&gt;
            </pre>
        </div>

    </x-container.container>
</x-container.container>

@endsection
