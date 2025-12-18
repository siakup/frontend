@extends('layouts.main')

@section('title', 'Spacing Documentation')

@section('content')
    <x-container.container variant="content-wrapper">
        <x-container.container class="p-6 bg-white border border-gray-200 rounded-lg flex flex-col gap-10">

            {{-- Header --}}
            <div>
                <x-typography variant="body-medium-semibold">
                    Spacing
                </x-typography>

                <x-typography variant="body-small-regular" class="text-gray-600 mt-1">
                    Komponen <strong>Spacing</strong> digunakan untuk mengatur jarak
                    internal (<em>padding</em>) dan eksternal (<em>margin</em>) antar
                    elemen UI secara konsisten berdasarkan spacing scale pada design system.
                </x-typography>
            </div>

            {{-- Props --}}
            <div>
                <x-typography variant="body-medium-semibold" class="mb-3">
                    Props
                </x-typography>

                <div class="space-y-2 text-sm text-gray-700">
                    <p>
                        <strong>padding</strong> —
                        <code>p-1x</code>, <code>px-2x</code>, <code>py-3x</code>, dst
                    </p>
                    <p>
                        <strong>margin</strong> —
                        <code>m-1x</code>, <code>mx-2x</code>, <code>my-3x</code>, dst
                    </p>
                </div>
            </div>

            {{-- Spacing Scale --}}
            <div>
                <x-typography variant="body-medium-semibold" class="mb-2">
                    Spacing Scale
                </x-typography>

                <x-typography variant="body-small-regular" class="text-gray-600 mb-6">
                    Skala spacing menggunakan base unit
                    <strong>1x = 4px</strong>.
                </x-typography>

                @php
                    $spacingScales = [
                        '1x' => '4px',
                        '2x' => '8px',
                        '2.5x' => '10px',
                        '3x' => '12px',
                        '4x' => '16px',
                        '5x' => '20px',
                        '6x' => '24px',
                        '7x' => '28px',
                    ];
                @endphp

                <x-border variant="dashed" color="red-300" radius="md" :width="3" class="bg-red-50 p-4">

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                        @foreach ($spacingScales as $label => $px)
                            <div class="flex flex-col items-center gap-2">
                                <x-border radius="sm" width="2" class="bg-red-500">
                                    <x-spacing padding="px-{{ $label }} py-1x" />
                                </x-border>

                                <div class="text-center">
                                    <x-typography variant="body-small-regular">
                                        {{ $label . ' = ' . $px }}
                                    </x-typography>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </x-border>
            </div>

            {{-- Jenis Spacing --}}
            <div>
                <x-typography variant="body-medium-semibold" class="mb-6">
                    Jenis Spacing
                </x-typography>

                <div class="space-y-8">

                    {{-- Padding --}}
                    <div>
                        <x-typography variant="body-small-semibold" class="mb-2">
                            Padding
                        </x-typography>

                        <x-border radius="md" class="bg-gray-50">
                            <x-spacing padding="p-5">
                                <x-typography variant="body-small-regular">
                                    Konten dengan
                                    <code>padding="p-5"</code>
                                </x-typography>
                            </x-spacing>
                        </x-border>
                    </div>

                    {{-- Margin --}}
                    <div>
                        <x-typography variant="body-small-semibold" class="mb-2">
                            Margin
                        </x-typography>

                        <x-border radius="md" class="bg-gray-50">
                            <x-spacing margin="m-5">
                                <x-border radius="sm">
                                    <x-spacing padding="p-3">
                                        <x-typography variant="body-small-regular">
                                            Elemen dengan
                                            <code>margin="m-5"</code>
                                        </x-typography>
                                    </x-spacing>
                                </x-border>
                            </x-spacing>
                        </x-border>
                    </div>

                </div>
            </div>

            {{-- Contoh Penggunaan --}}
            <div>
                <x-typography variant="body-medium-semibold" class="mb-3">
                    Contoh Penggunaan
                </x-typography>

                <pre class="bg-gray-900 text-gray-100 p-4 rounded-lg text-sm overflow-x-auto">
&lt;x-spacing padding="p-4x"&gt;
    Konten dengan padding
&lt;/x-spacing&gt;

&lt;x-spacing margin="m-6x"&gt;
    Konten dengan margin bawah
&lt;/x-spacing&gt;

&lt;x-spacing padding="px-6x py-3x" margin="mt-4x"&gt;
    Padding horizontal &amp; vertical + margin top
&lt;/x-spacing&gt;
            </pre>
            </div>

        </x-container.container>
    </x-container.container>
@endsection
