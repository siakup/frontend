@extends('layouts.main')

@section('title', 'Tab Component Documentation')

@section('content')
    <x-container.wrapper :rows="12">
        @php
            $currentRoute = \Route::currentRouteName();

            $tabDemoItems = [
                (object) [
                    'title' => 'Ringkasan',
                    'routeName' => $currentRoute,
                    'routeQuery' => $currentRoute,
                    'param' => ['tab' => 'summary'],
                ],
                (object) [
                    'title' => 'Pengaturan',
                    'routeName' => $currentRoute,
                    'routeQuery' => 'settings.index',
                    'param' => ['tab' => 'settings'],
                ],
                (object) [
                    'title' => 'Pengguna',
                    'routeName' => $currentRoute,
                    'routeQuery' => 'users.index',
                    'param' => ['tab' => 'users'],
                ],
                (object) [
                    'title' => 'Analitik',
                    'routeName' => $currentRoute,
                    'routeQuery' => 'analytics.index',
                    'param' => ['tab' => 'analytics'],
                ],
            ];
        @endphp
        <x-container.container class="row-span-12 flex-col" :background="'content-white'" :padding="'p-5'" :gap="'gap-3'">

            <x-typography variant="body-medium-semibold">1. Varian: Underline (Lebar Mengikuti Parent)</x-typography>
            <x-tab :tabItems="$tabDemoItems" variant="underline" container-class="shadow-sm" :widthMax="true" />
            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                &lt;x-tab :tabItems="$tabs" variant="underline" :widthMax="true"/&gt;</pre>
            <hr>

            <x-typography variant="body-medium-semibold">2. Varian: Underline (Lebar Sesuai Konten)</x-typography>
            <x-tab :tabItems="$tabDemoItems" variant="underline" container-class="shadow-sm" :widthMax="false" />
            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                &lt;x-tab :tabItems="$tabs" variant="underline" :widthMax="false" /&gt;</pre>
            <hr>

            <x-typography variant="body-medium-semibold">3. Varian: Boxed (Dengan Ikon) (Lebar Mengikuti
                Parent)</x-typography>
            <x-tab :tabItems="$tabDemoItems" variant="boxed" :widthMax="true" />
            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                &lt;x-tab :tabItems="$tabs" variant="boxed" :widthMax="true" /&gt;</pre>
            <hr>

            <x-typography variant="body-medium-semibold">4. Varian: Boxed (Dengan Ikon) (Lebar Sesuai Konten)</x-typography>
            <x-tab :tabItems="$tabDemoItems" variant="boxed" :widthMax="false" />
            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                &lt;x-tab :tabItems="$tabs" variant="boxed" :widthMax="false"  /&gt;</pre>
            <hr>

            <x-typography variant="body-medium-semibold">5. Varian: Minimal Underline (Lebar Mengikuti
                Parent)</x-typography>
            <x-tab :tabItems="$tabDemoItems" variant="minimal-underline" container-class="border-b border-gray-300 pb-0"
                :widthMax="true" />
            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                &lt;x-tab :tabItems="$tabs" variant="minimal-underline" :widthMax="true" /&gt;</pre>
            <hr>

            <x-typography variant="body-medium-semibold">6. Varian: Minimal Underline (Lebar Sesuai Konten)</x-typography>
            <x-tab :tabItems="$tabDemoItems" variant="minimal-underline" container-class="border-b border-gray-300 pb-0"
                :widthMax="false" />
            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                &lt;x-tab :tabItems="$tabs" variant="minimal-underline" :widthMax="false" /&gt;</pre>
            <hr>

            <x-typography variant="body-medium-semibold">7. Varian: Pill Colored (Kustom Hijau) (Lebar Mengikuti
                Parent)</x-typography>
            <x-tab :tabItems="$tabDemoItems" variant="pill-colored" bg-active="bg-green-100" text-color-active="text-green-800"
                border-color-active="border-green-800" :widthMax="true" />
            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                 &lt;x-tab
                    :tabItems="$tabs"
                    variant="pill-colored"
                    bg-active="bg-green-100"
                    text-color-active="text-green-800"
                    border-color-active="border-green-800"
                    :widthMax="true"
                /&gt;</pre>

            <x-typography variant="body-medium-semibold">8. Varian: Pill Colored (Kustom Hijau) (Lebar Sesuai Konten)</x-typography>
            <x-tab :tabItems="$tabDemoItems" variant="pill-colored" bg-active="bg-green-100" text-color-active="text-green-800"
                border-color-active="border-green-800" :widthMax="false" />
            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                 &lt;x-tab
                    :tabItems="$tabs"
                    variant="pill-colored"
                    bg-active="bg-green-100"
                    text-color-active="text-green-800"
                    border-color-active="border-green-800"
                    :widthMax="false"
                /&gt;</pre>
        </x-container.container>
    </x-container.wrapper>
@endsection
