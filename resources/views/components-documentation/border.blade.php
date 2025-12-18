@extends('layouts.main')

@section('title', 'Border Documentation')

@section('content')
    <x-container.container variant="content-wrapper">
        <x-container.container class="p-6 bg-white border border-gray-200 rounded-lg flex flex-col gap-10">

            {{-- Header --}}
            <div>
                <x-typography variant="body-large-semibold">
                    Komponen Border
                </x-typography>

                <x-typography variant="body-small-regular" class="text-gray-600 mt-1">
                    Border digunakan untuk membungkus konten serta memberikan
                    pemisah visual melalui <strong>radius</strong>, <strong>warna</strong>,
                    dan <strong>ketebalan</strong> garis.
                </x-typography>
            </div>

            {{-- Props --}}
            <div>
                <x-typography variant="body-medium-semibold" class="mb-3">
                    Props
                </x-typography>

                <div class="space-y-2 text-sm text-gray-700 leading-relaxed">
                    <p><strong>variant</strong> — <code>solid</code>, <code>dashed</code>, <code>dotted</code>,
                        <code>double</code>, <code>hidden</code></p>
                    <p><strong>radius</strong> — <code>xs</code>, <code>sm</code>, <code>md</code>, <code>lg</code></p>
                    <p><strong>width</strong> — Ketebalan border (angka)</p>
                    <p><strong>color</strong> — Warna border (Tailwind / custom token)</p>
                </div>
            </div>

            {{-- Radius Scale --}}
            <div>
                <x-typography variant="body-medium-semibold" class="mb-4">
                    Border Radius Scale
                </x-typography>

                <x-border radius="lg" width="2" color="gray-300" class="bg-red-200 p-6">
                    <div class="flex justify-between mb-2">
                        <x-typography variant="body-medium-semibold">
                            radius-lg
                        </x-typography>
                        <x-typography variant="body-medium-semibold">
                            20px
                        </x-typography>
                    </div>
                    <x-typography variant="body-small-regular" class="text-gray-700 mb-6">
                        Digunakan untuk bottom sheet (mobile)
                    </x-typography>

                    <x-border radius="md" width="2" color="gray-300" class="bg-red-100 p-5">
                        <div class="flex justify-between mb-2">
                            <x-typography variant="body-medium-semibold">
                                radius-md
                            </x-typography>
                            <x-typography variant="body-medium-semibold">
                                12px
                            </x-typography>
                        </div>
                        <x-typography variant="body-small-regular" class="text-gray-700 mb-6">
                            Digunakan untuk card section (website)
                        </x-typography>

                        <x-border radius="sm" width="2" color="gray-300" class="bg-red-50 p-4">
                            <div class="flex justify-between mb-2">
                                <x-typography variant="body-medium-semibold">
                                    radius-sm
                                </x-typography>
                                <x-typography variant="body-medium-semibold">
                                    8px
                                </x-typography>
                            </div>
                            <x-typography variant="body-small-regular" class="text-gray-700">
                                Digunakan untuk card section (mobile) atau component (website)
                            </x-typography>
                        </x-border>
                    </x-border>
                </x-border>
            </div>

            {{-- Contoh Penggunaan --}}
            <div>
                <x-typography variant="body-medium-semibold" class="mb-3">
                    Contoh Penggunaan
                </x-typography>

                <pre class="bg-gray-900 text-gray-100 p-4 rounded-lg text-sm overflow-x-auto">
&lt;x-border variant="solid" radius="md" width="2" color="gray-300"&gt;
    &lt;x-container.container padding="p-4" radius="md"&gt;
        Konten di dalam border
    &lt;/x-container.container&gt;
&lt;/x-border&gt;
            </pre>
            </div>

        </x-container.container>
    </x-container.container>
@endsection
