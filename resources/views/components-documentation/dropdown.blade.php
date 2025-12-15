@extends('layouts.main')

@section('title', 'Dropdown')

@section('content')
    <div class="flex flex-col gap-4 p-4 w-full h-full" x-data="{ periode: '', cpl: '', program: '' }">
        <x-typography variant="body-large-semibold">Dropdown Consume API</x-typography>
        <x-container.container :background="'content-white'" :radius="'md'" :padding="'p-4'" :gap="'gap-5'" class="flex-col">
            <x-typography variant="body-medium-semibold">1. Dropdown Periode Akademik</x-typography>
            <div class="flex flex-col items-center gap-3">
                <x-dropdown.periode-akademik x-model="periode" />
                <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                &lt;x-dropdown.periode-akademik x-model="periode" /&gt;</pre>
            </div>
            <hr>

            <x-typography variant="body-medium-semibold">2. Dropdown CPL</x-typography>
            <div class="flex flex-col items-center gap-3">
                <x-dropdown.cpl x-model="cpl" />
                <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                &lt;x-dropdown.cpl x-model="cpl" /&gt;</pre>
            </div>
            <hr>

            <x-typography variant="body-medium-semibold">3. Dropdown Program Perkuliahan</x-typography>
            <div class="flex flex-col items-center gap-3">
                <x-dropdown.program-perkuliahan x-model="program" />
                <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                &lt;x-dropdown.program-perkuliahan x-model="program" /&gt;</pre>
            </div>
        </x-container.container>
    </div>
@endsection
