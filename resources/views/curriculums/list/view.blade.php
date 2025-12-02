@extends('layouts.main')

@section('title', 'Lihat Detail Kurikulum')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Kurikulum</div>
@endsection

@include('partials.success-notification-modal')
@section('content')
  <x-container.container :variant="'content-wrapper'">
    <x-typography :variant="'body-large-semibold'">Lihat Detail Kurikulum</x-typography>
    <x-button.back :href="route('curriculum.list').'?program_studi='.$data->program_studi">Daftar Kurikulum</x-button.back>
      <x-container.container>
        <x-typography :variant="'body-medium-bold'">Detail Kurikulum</x-typography>
        <x-container.container :variant="'content-wrapper'" :class="'!px-0'">
          <x-form.input-container :class="'min-w-[175px]'">
            <x-slot name="label">Program Studi</x-slot>
            <x-slot name="input">
              <input 
                placeholder="Program Studi" 
                name="program_studi" 
                type="text" 
                id="program_studi" 
                class="w-full pe-10 box-border ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10 read-only:bg-[#F5F5F5] read-only:text-[#8C8C8C] read-only:cursor-not-allowed" 
                value="{{current(array_filter($programStudiList, function ($item) use ($data) { return $item->id == $data->program_studi; }))->nama}}" 
                readonly
              />
            </x-slot>
          </x-form.input-container>
          <x-form.input-container :class="'min-w-[175px]'">
            <x-slot name="label">Program Perkuliahan</x-slot>
            <x-slot name="input">
              <button type="button" class="flex justify-between  items-center w-full box-border px-3 rounded-lg leading-5 h-10 bg-[#F5F5F5] text-[#8C8C8C] cursor-not-allowed !border-[1px] !border-[#BFBFBF]" disabled>
                {{$data->perkuliahan}}
                <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="Filter">
              </button>
            </x-slot>
          </x-form.input-container>
          <x-form.input-container :class="'min-w-[175px]'">
            <x-slot name="label">Nama Kurikulum</x-slot>
            <x-slot name="input">
              <input 
                placeholder="Nama Kurikulum" 
                name="curriculum_nama" 
                type="text" 
                id="Curriculum-Name" 
                class="w-full pe-10 box-border ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10 read-only:bg-[#F5F5F5] read-only:text-[#8C8C8C] read-only:cursor-not-allowed" 
                value="{{$data->nama_kurikulum}}" 
                readonly
              >
            </x-slot>
          </x-form.input-container>
          <x-form.input-container :class="'min-w-[175px]'">
            <x-slot name="label">Deskripsi</x-slot>
            <x-slot name="input">
              <input 
                placeholder="Deskripsi" 
                name="deskripsi" 
                type="text" 
                id="Deskripsi" 
                class="w-full pe-10 box-border ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10 read-only:bg-[#F5F5F5] read-only:text-[#8C8C8C] read-only:cursor-not-allowed" 
                value="{{$data->deskripsi}}" 
                readonly
              >
            </x-slot>
          </x-form.input-container>
          <x-form.input-container :class="'min-w-[175px]'">
            <x-slot name="label">SKS Mata Kuliah Wajib</x-slot>
            <x-slot name="input">
              <input 
                placeholder="SKS Mata Kuliah Wajib" 
                name="sks_wajib" 
                type="text" 
                id="Wajib" 
                class="w-full pe-10 box-border ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10 read-only:bg-[#F5F5F5] read-only:text-[#8C8C8C] read-only:cursor-not-allowed" 
                value="{{$data->sks_wajib}}" 
                readonly
              >
            </x-slot>
          </x-form.input-container>
          <x-form.input-container :class="'min-w-[175px]'">
            <x-slot name="label">SKS Mata Kuliah Pilihan</x-slot>
            <x-slot name="input">
              <input 
                placeholder="SKS Mata Kuliah Pilihan" 
                name="sks_pilihan" 
                type="text" 
                id="Pilihan" 
                class="w-full pe-10 box-border ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10 read-only:bg-[#F5F5F5] read-only:text-[#8C8C8C] read-only:cursor-not-allowed" 
                value="{{$data->sks_pilihan}}" 
                readonly
              >
            </x-slot>
          </x-form.input-container>
          <x-form.input-container :class="'min-w-[175px]'">
            <x-slot name="label">Total SKS</x-slot>
            <x-slot name="input">
              <input 
                placeholder="Total SKS" 
                name="total_sks" 
                type="text" 
                id="Total" 
                class="w-full pe-10 box-border ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10 read-only:bg-[#F5F5F5] read-only:text-[#8C8C8C] read-only:cursor-not-allowed" 
                value="{{$data->sks_total}}" 
                readonly
              >
            </x-slot>
          </x-form.input-container>
          <x-form.toggle 
            :id="'curriculum-status'" 
            :value="$data->status === 'active'" 
            :variant="'readonly'"
          />
        </x-container>
      </x-container>
      <x-container.container :class="'flex flex-col gap-5'">
        <x-typography :variant="'body-medium-bold'">Jenis Mata Kuliah - Minimum SKS</x-typography>
        <x-table.index :variant="'old'" id="list-matkul">
          <x-table.head :variant="'old'">
            <x-table.row :variant="'old'">
              <x-table.header-cell :variant="'old'">Jenis Mata Kuliah</x-table.header-cell>
              <x-table.header-cell :variant="'old'"></x-table.header-cell>
              <x-table.header-cell :variant="'old'">Minimum SKS</x-table.header-cell>
            </x-table.row>
          </x-table.head>
          <tbody>
            @foreach($data->details as $details)
              <x-table.row :variant="'old'" class="bg-[#FAFAFA] border-1 border-[#D9D9D9]">
                  <x-table.cell :variant="'old'">{{$details->jenis_mata_kuliah}}</x-table.cell>
                  <x-table.cell :variant="'old'" class="py-[12px] !w-[25%]"></x-table.cell>
                  <x-table.cell :variant="'old'">
                    <x-container.container :variant="'content-wrapper'" class="border-[1px] border-[#BFBFBF] bg-[#F5F5F5] rounded-lg !py-[9px] !ps-[39.5px] !pe-[12px]">
                      <input 
                        class="w-full bg-transparent !border-transparent focus:outline-none text-[14px] text-[#8C8C8C]" 
                        placeholder="Minimum SKS" 
                        type="number" 
                        value="{{$details->sks_minimal}}" 
                        disabled 
                      />
                    </x-container>
                  </x-table.cell>
              </x-table.row>
            @endforeach
          </tbody>
        </x-table.index>
      </x-container>
      <x-container.container class="flex justify-end">
        <x-container.container :variant="'content-wrapper'" :class="'flex flex-row items-center justify-end'">
          <x-button.secondary 
            :href="route('curriculum.list.view.show-study', ['id' => $id])" 
            :icon="asset('assets/icon-eye-red.svg')" 
            :iconPosition="'right'"
          >
            Lihat Daftar Mata Kuliah
          </x-button.secondary>
        </x-container>
      </x-container>
  </x-container>
@endsection