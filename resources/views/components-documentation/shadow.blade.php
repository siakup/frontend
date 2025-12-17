@extends('layouts.main')

@section('title', 'Shadow Documentation')

@section('content')

    <x-container.container variant="content-wrapper">
        <x-container.container class="p-6 bg-white border border-gray-200 rounded-lg flex flex-col gap-10">

            {{-- Title --}}
            <div>
                <x-typography variant="body-medium-semibold">
                    Shadow
                </x-typography>
                <x-typography variant="body-small-regular" class="text-gray-600 mt-1">
                    Komponen Shadow digunakan untuk memberikan elevasi visual dan hirarki
                    pada elemen UI.
                </x-typography>
            </div>

            {{-- Props --}}
            <div>
                <x-typography variant="body-medium-semibold" class="mb-3">
                    Props
                </x-typography>

                <div class="space-y-2 text-sm text-gray-700">
                    <p><strong>variant</strong> — <code>low</code>, <code>medium</code>, <code>high</code></p>
                    <p><strong>radius</strong> — <code>sm</code>, <code>md</code>, <code>lg</code>, <code>none</code></p>
                    <p><strong>inverse</strong> — <code>true</code> / <code>false</code></p>
                    <p><strong>inherit</strong> — mengikuti radius parent</p>
                </div>
            </div>

            {{-- Jenis Shadow --}}
            <div>
                <x-typography variant="body-medium-semibold" class="mb-6">
                    Jenis Shadow
                </x-typography>

                <div class="space-y-8">

                    {{-- Shadow Low --}}
                    <div class="mb-3">
                        <x-typography variant="body-small-semibold" class="mb-2">
                            Shadow Low
                        </x-typography>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Normal --}}
                            <x-shadow variant="low" radius="lg">
                                <x-border radius="inherit">
                                    <x-container.container padding="p-5" background="bg-gray-50">
                                        <x-typography variant="body-medium-semibold">
                                            $shadow-low
                                        </x-typography>
                                        <x-typography variant="body-small-regular" class="text-gray-600">
                                            X: 0 · Y: 4 · Blur: 8 · Opacity: 20%
                                        </x-typography>
                                    </x-container.container>
                                </x-border>
                            </x-shadow>

                            {{-- Inverse --}}
                            <x-shadow variant="low" inverse radius="lg">
                                <x-border radius="inherit">
                                    <x-container.container padding="p-5" background="bg-gray-50">
                                        <x-typography variant="body-medium-semibold">
                                            $shadow-low--inverse
                                        </x-typography>
                                        <x-typography variant="body-small-regular" class="text-gray-600">
                                            X: 0 · Y: -4 · Blur: 8 · Opacity: 20%
                                        </x-typography>
                                    </x-container.container>
                                </x-border>
                            </x-shadow>
                        </div>
                    </div>

                    {{-- Shadow Medium --}}
                    <div class="mb-3">
                        <x-typography variant="body-small-semibold" class="mb-2">
                            Shadow Medium
                        </x-typography>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Normal --}}
                            <x-shadow variant="medium">
                                <x-border radius="inherit">
                                    <x-container.container padding="p-5" background="bg-gray-50">
                                        <x-typography variant="body-medium-semibold">
                                            $shadow-medium
                                        </x-typography>
                                        <x-typography variant="body-small-regular" class="text-gray-600">
                                            X: 0 · Y: 8 · Blur: 24 · Opacity: 15%
                                        </x-typography>
                                    </x-container.container>
                                </x-border>
                            </x-shadow>

                            {{-- Inverse --}}
                            <x-shadow variant="medium" inverse>
                                <x-border radius="inherit">
                                    <x-container.container padding="p-5" background="bg-gray-50">
                                        <x-typography variant="body-medium-semibold">
                                            $shadow-medium--inverse
                                        </x-typography>
                                        <x-typography variant="body-small-regular" class="text-gray-600">
                                            X: 0 · Y: -8 · Blur: 24 · Opacity: 15%
                                        </x-typography>
                                    </x-container.container>
                                </x-border>
                            </x-shadow>
                        </div>
                    </div>

                    {{-- Shadow High --}}
                    <div class="mb-3">
                        <x-typography variant="body-small-semibold" class="mb-2">
                            Shadow High
                        </x-typography>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Normal --}}
                            <x-shadow variant="high" radius="sm">
                                <x-border radius="inherit">
                                    <x-container.container padding="p-5" background="bg-gray-50">
                                        <x-typography variant="body-medium-semibold">
                                            $shadow-high
                                        </x-typography>
                                        <x-typography variant="body-small-regular" class="text-gray-600">
                                            X: 0 · Y: 16 · Blur: 36 · Opacity: 10%
                                        </x-typography>
                                    </x-container.container>
                                </x-border>
                            </x-shadow>

                            {{-- Inverse --}}
                            <x-shadow variant="high" inverse radius="sm">
                                <x-border radius="inherit">
                                    <x-container.container padding="p-5" background="bg-gray-50">
                                        <x-typography variant="body-medium-semibold">
                                            $shadow-high--inverse
                                        </x-typography>
                                        <x-typography variant="body-small-regular" class="text-gray-600">
                                            X: 0 · Y: -16 · Blur: 36 · Opacity: 10%
                                        </x-typography>
                                    </x-container.container>
                                </x-border>
                            </x-shadow>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Contoh penggunaan --}}
            <div>
                <x-typography variant="body-medium-semibold" class="mb-3">
                    Contoh Penggunaan
                </x-typography>

                <pre class="bg-gray-900 text-gray-100 p-4 rounded-lg text-sm overflow-x-auto">
                Normal Shadow:
                &lt;x-shadow variant="high" radius="sm"&gt;
                    &lt;x-border radius="inherit"&gt;
                        &lt;x-container.container
                            padding="p-5"
                            background="bg-gray-50"&gt;
                            &lt;x-typography variant="body-medium-semibold"&gt;
                                $shadow-high
                            &lt;/x-typography&gt;
                            &lt;x-typography variant="body-small-regular" class="text-gray-600"&gt;
                                X: 0 · Y: 16 · Blur: 36 · Opacity: 10%
                            &lt;/x-typography&gt;
                        &lt;/x-container.container&gt;
                    &lt;/x-border&gt;
                &lt;/x-shadow&gt;

                Inverse Shadow:
                &lt;x-shadow variant="high" inverse radius="sm"&gt;
                    &lt;x-border radius="inherit"&gt;
                        &lt;x-container.container padding="p-5" background="bg-gray-50"&gt;
                            &lt;x-typography variant="body-medium-semibold"&gt;
                                $shadow-high--inverse
                            &lt;/x-typography&gt;
                            &lt;x-typography variant="body-small-regular" class="text-gray-600"&gt;
                                X: 0 · Y: -16 · Blur: 36 · Opacity: 10%
                            &lt;/x-typography&gt;
                        &lt;/x-container.container&gt;
                    &lt;/x-border&gt;
                &lt;/x-shadow&gt;
            </pre>
            </div>

        </x-container.container>
    </x-container.container>

@endsection
