@extends('layouts.main')

@section('title', 'Button Documentation')

@section('content')
    <x-container variant="content-wrapper">

        <x-typography variant="heading-h6">Button – Documentation</x-typography>

        {{-- Basic --}}
        <x-typography variant="body-medium-bold" class="mt-6">Primary</x-typography>
        <x-button variant="primary">Primary Button</x-button>

        {{-- Icon Left --}}
        <x-typography variant="body-medium-bold" class="mt-6">Icon Left</x-typography>
        <x-button variant="secondary" icon="filter/red-20" iconPosition="left">
            Filter Data
        </x-button>

        {{-- Icon Right --}}
        <x-typography variant="body-medium-bold" class="mt-6">Icon Right</x-typography>
        <x-button variant="primary" icon="arrow-right/red-20" iconPosition="right">
            Lanjut
        </x-button>

        {{-- Sizes --}}
        <x-typography variant="body-medium-bold" class="mt-6">Sizes</x-typography>
        <div class="flex gap-4">
            <x-button size="sm">Small</x-button>
            <x-button size="md">Medium</x-button>
            <x-button size="lg">Large</x-button>
        </div>

        {{-- File Input --}}
        <x-typography variant="body-medium-bold" class="mt-6">File Input Mode</x-typography>
        <x-button fileInput icon="upload/red-20">
            Upload File
        </x-button>

        {{-- Link Mode --}}
        <x-typography variant="body-medium-bold" class="mt-6">Hyperlink Button</x-typography>
        <x-button href="#" variant="tertiary">
            Ke Dashboard
        </x-button>

        {{-- Link Mode --}}
        <x-typography variant="body-medium-bold" class="mt-6">Text Link</x-typography>
        <x-button href="#" variant="text-link">
            Ke Dashboard
        </x-button>

    </x-container>
@endsection
