@extends('layouts.main')

@section('title', 'Dropdown')

@section('content')
    <div class="flex flex-col gap-4 p-4 w-full h-full" x-data="{ periode: '', cpl: '', program: '', tahun: '' }">
        <x-typography variant="body-large-semibold">Dropdown Consume API</x-typography>
        <x-container.container :background="'content-white'" :radius="'md'" :padding="'p-4'" :gap="'gap-5'" class="flex-col">
            <x-typography variant="body-medium-semibold">1. Dropdown Periode Akademik (Gray)</x-typography>
            <div class="flex flex-col items-center gap-3">
                <x-dropdown.periode-akademik x-model="periode" variant="gray" />
                <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                &lt;x-dropdown.periode-akademik x-model="periode" variant="gray" /&gt;</pre>
            </div>
            <x-typography variant="body-medium-semibold">2. Dropdown Periode Akademik (Red)</x-typography>
            <div class="flex flex-col items-center gap-3">
                <x-dropdown.periode-akademik variant="red" x-model="periode" />
                <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                &lt;x-dropdown.periode-akademik variant="red" x-model="periode" /&gt;</pre>
            </div>
            <hr>

            <x-typography variant="body-medium-semibold">3. Dropdown CPL (Gray)</x-typography>
            <div class="flex flex-col items-center gap-3">
                <x-dropdown.cpl x-model="cpl" variant="gray" />
                <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                &lt;x-dropdown.cpl x-model="cpl" variant="gray"/&gt;</pre>
            </div>
            <x-typography variant="body-medium-semibold">4. Dropdown CPL (Red)</x-typography>
            <div class="flex flex-col items-center gap-3">
                <x-dropdown.cpl x-model="cpl" variant="red" />
                <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                &lt;x-dropdown.cpl x-model="cpl" variant="red"  /&gt;</pre>
            </div>
            <hr>

            <x-typography variant="body-medium-semibold">5. Dropdown Program Perkuliahan (Gray)</x-typography>
            <div class="flex flex-col items-center gap-3">
                <x-dropdown.program-perkuliahan x-model="program" variant="gray" />
                <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                &lt;x-dropdown.program-perkuliahan x-model="program" variant="gray" /&gt;</pre>
            </div>
            <x-typography variant="body-medium-semibold">6. Dropdown Program Perkuliahan (Red)</x-typography>
            <div class="flex flex-col items-center gap-3">
                <x-dropdown.program-perkuliahan x-model="program" variant="red" />
                <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                &lt;x-dropdown.program-perkuliahan x-model="program" variant="red" /&gt;</pre>
            </div>
            <hr>

            <x-typography variant="body-medium-semibold">7. Dropdown Tahun Masuk (Gray)</x-typography>
            <div class="flex flex-col items-center gap-3">
                <x-dropdown.tahun-masuk x-model="tahun" variant="gray" />
                <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                &lt;x-dropdown.program-perkuliahan x-model="tahun" variant="gray" /&gt;</pre>
            </div>
            <x-typography variant="body-medium-semibold">8. Dropdown Tahun Masuk (Red)</x-typography>
            <div class="flex flex-col items-center gap-3">
                <x-dropdown.tahun-masuk x-model="tahun" variant="red" />
                <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs w-full overflow-x-auto">
                &lt;x-dropdown.program-perkuliahan x-model="tahun" variant="red" /&gt;</pre>
            </div>
        </x-container.container>
    </div>
@endsection
