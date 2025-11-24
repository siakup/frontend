@extends('layouts.main')

@section('title', 'Badge/Tag Documentation')

@section('content')
    {{-- Terdapat empat parameter atau props pada badge/tag --}}
    {{-- variant: variasi dari badge (12 variasi) --}}
    {{-- size: ukuran dari badge (terdapat tiga ukuran yaitu xl, lg, dan md) --}}
    {{-- border: radius border dari badge (default dan pill) --}}

    <x-container variant="content-wrapper">
        <x-typography variant="body-large-semibold">Penggunaan badge/tag pada element</x-typography>
        <x-container class="flex flex-col gap-5" borderRadius="rounded-lg">

            {{-- Red Bordered --}}
            <x-typography variant="body-medium-semibold">Red Bordered</x-typography>
            <div class="flex flex-row gap-5">
                <x-badge variant="red-bordered" size="xl" border="default">Label</x-badge>
                <x-badge variant="red-bordered" size="lg" border="default">Label</x-badge>
                <x-badge variant="red-bordered" size="md" border="default">Label</x-badge>
                <x-badge variant="red-bordered" size="xl" border="pill">Label</x-badge>
                <x-badge variant="red-bordered" size="lg" border="pill">Label</x-badge>
                <x-badge variant="red-bordered" size="md" border="pill">Label</x-badge>
            </div>

            {{-- Red Monochrome --}}
            <x-typography variant="body-medium-semibold">Red Monochrome</x-typography>
            <div class="flex flex-row gap-5">
                <x-badge variant="red-monochrome" size="xl" border="default">Label</x-badge>
                <x-badge variant="red-monochrome" size="lg" border="default">Label</x-badge>
                <x-badge variant="red-monochrome" size="md" border="default">Label</x-badge>
                <x-badge variant="red-monochrome" size="xl" border="pill">Label</x-badge>
                <x-badge variant="red-monochrome" size="lg" border="pill">Label</x-badge>
                <x-badge variant="red-monochrome" size="md" border="pill">Label</x-badge>
            </div>

            {{-- Red Filled --}}
            <x-typography variant="body-medium-semibold">Red Filled</x-typography>
            <div class="flex flex-row gap-5">
                <x-badge variant="red-filled" size="xl" border="default">Label</x-badge>
                <x-badge variant="red-filled" size="lg" border="default">Label</x-badge>
                <x-badge variant="red-filled" size="md" border="default">Label</x-badge>
                <x-badge variant="red-filled" size="xl" border="pill">Label</x-badge>
                <x-badge variant="red-filled" size="lg" border="pill">Label</x-badge>
                <x-badge variant="red-filled" size="md" border="pill">Label</x-badge>
            </div>

            {{-- Yellow Bordered --}}
            <x-typography variant="body-medium-semibold">Yellow Bordered</x-typography>
            <div class="flex flex-row gap-5">
                <x-badge variant="yellow-bordered" size="xl" border="default">Label</x-badge>
                <x-badge variant="yellow-bordered" size="lg" border="default">Label</x-badge>
                <x-badge variant="yellow-bordered" size="md" border="default">Label</x-badge>
                <x-badge variant="yellow-bordered" size="xl" border="pill">Label</x-badge>
                <x-badge variant="yellow-bordered" size="lg" border="pill">Label</x-badge>
                <x-badge variant="yellow-bordered" size="md" border="pill">Label</x-badge>
            </div>

            {{-- Yellow Monochrome --}}
            <x-typography variant="body-medium-semibold">Yellow Monochrome</x-typography>
            <div class="flex flex-row gap-5">
                <x-badge variant="yellow-monochrome" size="xl" border="default">Label</x-badge>
                <x-badge variant="yellow-monochrome" size="lg" border="default">Label</x-badge>
                <x-badge variant="yellow-monochrome" size="md" border="default">Label</x-badge>
                <x-badge variant="yellow-monochrome" size="xl" border="pill">Label</x-badge>
                <x-badge variant="yellow-monochrome" size="lg" border="pill">Label</x-badge>
                <x-badge variant="yellow-monochrome" size="md" border="pill">Label</x-badge>
            </div>

            {{-- Yellow Filled --}}
            <x-typography variant="body-medium-semibold">Yellow Filled</x-typography>
            <div class="flex flex-row gap-5">
                <x-badge variant="yellow-filled" size="xl" border="default">Label</x-badge>
                <x-badge variant="yellow-filled" size="lg" border="default">Label</x-badge>
                <x-badge variant="yellow-filled" size="md" border="default">Label</x-badge>
                <x-badge variant="yellow-filled" size="xl" border="pill">Label</x-badge>
                <x-badge variant="yellow-filled" size="lg" border="pill">Label</x-badge>
                <x-badge variant="yellow-filled" size="md" border="pill">Label</x-badge>
            </div>

            {{-- Blue Bordered --}}
            <x-typography variant="body-medium-semibold">Blue Bordered</x-typography>
            <div class="flex flex-row gap-5">
                <x-badge variant="blue-bordered" size="xl" border="default">Label</x-badge>
                <x-badge variant="blue-bordered" size="lg" border="default">Label</x-badge>
                <x-badge variant="blue-bordered" size="md" border="default">Label</x-badge>
                <x-badge variant="blue-bordered" size="xl" border="pill">Label</x-badge>
                <x-badge variant="blue-bordered" size="lg" border="pill">Label</x-badge>
                <x-badge variant="blue-bordered" size="md" border="pill">Label</x-badge>
            </div>

            {{-- Blue Monochrome --}}
            <x-typography variant="body-medium-semibold">Blue Monochrome</x-typography>
            <div class="flex flex-row gap-5">
                <x-badge variant="blue-monochrome" size="xl" border="default">Label</x-badge>
                <x-badge variant="blue-monochrome" size="lg" border="default">Label</x-badge>
                <x-badge variant="blue-monochrome" size="md" border="default">Label</x-badge>
                <x-badge variant="blue-monochrome" size="xl" border="pill">Label</x-badge>
                <x-badge variant="blue-monochrome" size="lg" border="pill">Label</x-badge>
                <x-badge variant="blue-monochrome" size="md" border="pill">Label</x-badge>
            </div>

            {{-- Blue Filled --}}
            <x-typography variant="body-medium-semibold">Blue Filled</x-typography>
            <div class="flex flex-row gap-5">
                <x-badge variant="blue-filled" size="xl" border="default">Label</x-badge>
                <x-badge variant="blue-filled" size="lg" border="default">Label</x-badge>
                <x-badge variant="blue-filled" size="md" border="default">Label</x-badge>
                <x-badge variant="blue-filled" size="xl" border="pill">Label</x-badge>
                <x-badge variant="blue-filled" size="lg" border="pill">Label</x-badge>
                <x-badge variant="blue-filled" size="md" border="pill">Label</x-badge>
            </div>

            {{-- Green Bordered --}}
            <x-typography variant="body-medium-semibold">Green Bordered</x-typography>
            <div class="flex flex-row gap-5">
                <x-badge variant="green-bordered" size="xl" border="default">Label</x-badge>
                <x-badge variant="green-bordered" size="lg" border="default">Label</x-badge>
                <x-badge variant="green-bordered" size="md" border="default">Label</x-badge>
                <x-badge variant="green-bordered" size="xl" border="pill">Label</x-badge>
                <x-badge variant="green-bordered" size="lg" border="pill">Label</x-badge>
                <x-badge variant="green-bordered" size="md" border="pill">Label</x-badge>
            </div>

            {{-- Green Monochrome --}}
            <x-typography variant="body-medium-semibold">Green Monochrome</x-typography>
            <div class="flex flex-row gap-5">
                <x-badge variant="green-monochrome" size="xl" border="default">Label</x-badge>
                <x-badge variant="green-monochrome" size="lg" border="default">Label</x-badge>
                <x-badge variant="green-monochrome" size="md" border="default">Label</x-badge>
                <x-badge variant="green-monochrome" size="xl" border="pill">Label</x-badge>
                <x-badge variant="green-monochrome" size="lg" border="pill">Label</x-badge>
                <x-badge variant="green-monochrome" size="md" border="pill">Label</x-badge>
            </div>

            {{-- Green Filled --}}
            <x-typography variant="body-medium-semibold">Green Filled</x-typography>
            <div class="flex flex-row gap-5">
                <x-badge variant="green-filled" size="xl" border="default">Label</x-badge>
                <x-badge variant="green-filled" size="lg" border="default">Label</x-badge>
                <x-badge variant="green-filled" size="md" border="default">Label</x-badge>
                <x-badge variant="green-filled" size="xl" border="pill">Label</x-badge>
                <x-badge variant="green-filled" size="lg" border="pill">Label</x-badge>
                <x-badge variant="green-filled" size="md" border="pill">Label</x-badge>
            </div>

        </x-container>

    </x-container>
@endsection
