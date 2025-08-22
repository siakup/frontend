@extends('layouts.main')

@section('title', 'Tambah Ekuivalensi')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Tambah Ekuivalensi</div>
@endsection

@section('javascript')

@endsection

@section('content')
    <div class="px-5 flex flex-col gap-5 box-border">
        <x-typography variant="heading-h6" bold class="">
            Tambah Ekuivalensi
        </x-typography>
        <x-button.back href="{{ route('curriculum.equivalence') }}">
            Ekuivalensi Kurikulum
        </x-button.back>
        <x-container class="flex flex-col gap-5">
            <x-typography variant="heading-h6" bold class="">
                Tambah Ekuivalensi
            </x-typography>
            <div class="border-[#D9D9D9] border rounded-xl">
                <div class="flex">
                    <div class="rounded-tl-xl border-[#D9D9D9] border-r py-2 px-5 bg-[#E8E8E8] w-1/5">
                        <x-typography class="text-nowrap">Program Studi</x-typography>
                    </div>
                    <div class="rounded-tr-xl py-2 px-5 bg-[#E8E8E8] w-4/5">
                        <x-typography variant="body-small-bold">{{ $prodi }}</x-typography>
                    </div>
                </div>
                <div class="flex border-t border-t-[#D9D9D9] ">
                    <div class="rounded-bl-xl border-[#D9D9D9] border-r py-2 px-5 bg-[#F5F5F5] w-1/5">
                        <x-typography class="text-nowrap">Program Perkuliahan</x-typography>
                    </div>
                    <div class="rounded-br-xl py-2 px-5 bg-[#F5F5F5] w-4/5">
                        <x-typography variant="body-small-bold">{{ $programPerkuliahan }}</x-typography>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-5 items-center">
                <div class="col-span-2">
                    <x-typography variant="body-small-regular" class="font-semibold">
                        Mata Kuliah Kurikulum Lama
                    </x-typography>
                </div>
                <div class="col-span-10">
                    <x-form.input name="code" type="text" placeholder="MK Kurikulum Lama" />
                </div>
            </div>

            <x-button.primary class="self-end" label="Tambah Mata Kuliah" />

            <div class="grid grid-cols-12 gap-5 items-center">
                <div class="col-span-2">
                    <x-typography variant="body-small-regular" class="font-semibold">
                        Mata Kuliah Kurikulum Baru
                    </x-typography>
                </div>
                <div class="col-span-10">
                    <x-form.input name="name" type="text" placeholder="MK Kurikulum Baru" />
                </div>
            </div>

            <x-button.primary class="self-end" label="Tambah Mata Kuliah" />

        </x-container>
    </div>
@endsection


@section('modals')

@endsection
