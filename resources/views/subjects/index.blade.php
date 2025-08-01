@extends('layouts.main')

@section('title', 'Mata Kuliah')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Mata Kuliah</div>
@endsection

@section('css')

@endsection

@section('javascript')
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection


@section('content')

    <div class="px-5 flex flex-col gap-5">
        <x-typography variant="heading-h6" bold class="">
            Mata Kuliah
        </x-typography>

        <x-container variant="content" class="flex flex-col gap-5">
            <x-typography variant="heading-h6" class="mb-2">
                Daftar Mata Kuliah
            </x-typography>
            <div class="p-5 flex justify-between border-[1px] border-[#d9d9d9] rounded-3xl">
                <input type="text" class="w-full max-w-md border border-gray-300 rounded-lg px-4 py-2"
                    placeholder="Cari mata kuliah...">
                <flux:dropdown>
                    <flux:button icon:trailing="chevron-down">Options</flux:button>

                    <flux:menu>
                        <flux:menu.item icon="plus">New post</flux:menu.item>

                        <flux:menu.separator />

                        <flux:menu.submenu heading="Sort by">
                            <flux:menu.radio.group>
                                <flux:menu.radio checked>Name</flux:menu.radio>
                                <flux:menu.radio>Date</flux:menu.radio>
                                <flux:menu.radio>Popularity</flux:menu.radio>
                            </flux:menu.radio.group>
                        </flux:menu.submenu>

                        <flux:menu.submenu heading="Filter">
                            <flux:menu.checkbox checked>Draft</flux:menu.checkbox>
                            <flux:menu.checkbox checked>Published</flux:menu.checkbox>
                            <flux:menu.checkbox>Archived</flux:menu.checkbox>
                        </flux:menu.submenu>

                        <flux:menu.separator />

                        <flux:menu.item variant="danger" icon="trash">Delete</flux:menu.item>
                    </flux:menu>
                </flux:dropdown>
            </div>

            <x-table>
                <x-table-head>
                    <x-table-row>
                        <x-table-header>Nama</x-table-header>
                        <x-table-header>Email</x-table-header>
                        <x-table-header>Aksi</x-table-header>
                    </x-table-row>
                </x-table-head>

                <x-table-body>
                    @foreach ($users as $user)
                        <x-table-row :odd="$loop->odd" :last="$loop->last">
                            <x-table-cell>{{ $user->name }}</x-table-cell>
                            <x-table-cell>{{ $user->email }}</x-table-cell>
                            <x-table-cell>
                                <a href="#" class="text-blue-600 hover:underline">Edit</a>
                            </x-table-cell>
                        </x-table-row>
                    @endforeach
                </x-table-body>
            </x-table>

            <livewire:button-primary type="button" label="Tambah Mata Kuliah"
                icon="{{ asset('assets/icon-plus-red.svg') }}" icon-position="right" />

        </x-container>

    </div>

@endsection
