@extends('layouts.main')

@section('title', 'Tab Component Documentation')

@section('content')
    <x-container variant="content-wrapper">
        @php
            $currentRoute = \Route::currentRouteName();

            // Data Dummy 
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
                    'icon' => '/assets/icons/tab/settings-grey.svg',
                    'icon_active' => '/assets/icons/tab/settings-red.svg',
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
        <x-container class="flex flex-col gap-8 p-6 bg-white border border-gray-200" borderRadius="rounded-lg">

            <x-typography variant="body-medium-semibold">1. Varian: Underline</x-typography>
            <x-tab :tabItems="$tabDemoItems" variant="underline" container-class="shadow-sm" />

            <div class="p-4 border border-gray-300 rounded-b-lg rounded-tr-lg bg-gray-50 text-xs">
                <x-typography variant="body-small-regular" class="text-gray-500 mb-2">Contoh struktur data
                    (Controller):</x-typography>
                <pre class="bg-white p-3 border rounded overflow-x-auto text-gray-700">
                    $tabs = [
                        (object) [
                            'title' => 'Ringkasan',
                            'routeName' => 'dashboard.summary',
                            'routeQuery' => 'dashboard.summary' 
                        ],
                        (object) [
                            'title' => 'Pengaturan',
                            'routeName' => 'dashboard.settings',
                            'routeQuery' => 'dashboard.settings'
                        ]
                    ];</pre>
                <x-typography variant="body-small-regular" class="text-gray-500 my-2">Implementasi Blade:</x-typography>
                <pre class="bg-white p-3 border rounded text-blue-600">&lt;x-tab :tabItems="$tabs" variant="underline" /&gt;</pre>
            </div>
            <hr>

            <x-typography variant="body-medium-semibold">2. Varian: Boxed (Dengan Ikon)</x-typography>
            <x-tab :tabItems="$tabDemoItems" variant="boxed" />

            <div class="p-4 border border-gray-300 rounded-lg mt-4 bg-gray-50 text-xs">
                <pre class="bg-white p-3 border rounded text-blue-600">&lt;x-tab :tabItems="$tabs" variant="boxed" /&gt;</pre>
            </div>
            <hr>

            <x-typography variant="body-medium-semibold">3. Varian: Minimal Underline</x-typography>
            <x-tab :tabItems="$tabDemoItems" variant="minimal-underline" container-class="border-b border-gray-300 pb-0" />

            <div class="p-4 border border-gray-300 rounded-lg mt-4 bg-gray-50 text-xs">
                <pre class="bg-white p-3 border rounded text-blue-600">&lt;x-tab :tabItems="$tabs" variant="minimal-underline" /&gt;</pre>
            </div>
            <hr>

            <x-typography variant="body-medium-semibold">4. Varian: Pill Colored (Kustom Hijau)</x-typography>
            <x-tab :tabItems="$tabDemoItems" variant="pill-colored" bg-active="bg-green-100" text-color-active="text-green-800"
                border-color-active="border-green-800" />

            <div class="p-4 border border-gray-300 rounded-lg mt-4 bg-gray-50 text-xs">
                <pre class="bg-white p-3 border rounded text-blue-600">
                &lt;x-tab
                    :tabItems="$tabs"
                    variant="pill-colored"
                    bg-active="bg-green-100"
                    text-color-active="text-green-800"
                    border-color-active="border-green-800"
                /&gt;</pre>
            </div>
        </x-container>
    </x-container>
@endsection
