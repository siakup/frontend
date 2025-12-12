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

            <x-typography variant="body-medium-semibold">1. Varian: Underline</x-typography>
            <x-tab :tabItems="$tabDemoItems" variant="underline" container-class="shadow-sm" />
            <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">&lt;x-tab :tabItems="$tabs" variant="underline" /&gt;</pre>
            <hr>

            <x-typography variant="body-medium-semibold">2. Varian: Boxed (Dengan Ikon)</x-typography>
            <x-tab :tabItems="$tabDemoItems" variant="boxed" />

            <div class="flex items-center">
                <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                 &lt;x-tab :tabItems="$tabs" variant="boxed" /&gt;</pre>
            </div>
            <hr>

            <x-typography variant="body-medium-semibold">3. Varian: Minimal Underline</x-typography>
            <x-tab :tabItems="$tabDemoItems" variant="minimal-underline" container-class="border-b border-gray-300 pb-0" />

            <div class="flex items-center">
                <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                 &lt;x-tab :tabItems="$tabs" variant="minimal-underline" /&gt;</pre>
            </div><hr>

            <x-typography variant="body-medium-semibold">4. Varian: Pill Colored (Kustom Hijau)</x-typography>
            <x-tab :tabItems="$tabDemoItems" variant="pill-colored" bg-active="bg-green-100" text-color-active="text-green-800"
                border-color-active="border-green-800" />

            <div class="flex items-center">
                <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                 &lt;x-tab
                    :tabItems="$tabs"
                    variant="pill-colored"
                    bg-active="bg-green-100"
                    text-color-active="text-green-800"
                    border-color-active="border-green-800"
                /&gt;</pre>
            </div>
        </x-container.container>
    </x-container.wrapper>
@endsection
