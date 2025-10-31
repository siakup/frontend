@extends('layouts.main')

@section('title', Request::routeIs('curriculum.list.view.show-study') ? 'Lihat Mata Kuliah Kurikulum' : 'Ubah Mata Kuliah Kurikulum')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Kurikulum</div>
@endsection

<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="{{ asset('js/custom/curriculum.js') }}"></script>

@include('partials.success-notification-modal', ['route' => route('curriculum.list.edit.show-study', ['id' => $id])])

@section('content')
<x-container :variant="'content-wrapper'">
  <x-typography :variant="'body-large-semibold'">{{Request::routeIs('curriculum.list.view.show-study') ? "Lihat Daftar Mata Kuliah" : "Ubah Mata Kuliah"}}</x-typography>
  <x-button.back :href="Request::routeIs('curriculum.list.view.show-study') ? route('curriculum.list.view', ['id' => $id]) : route('curriculum.list.edit', ['id' => $id])">{{Request::routeIs('curriculum.list.view.show-study') ? "Lihat Detail Kurikulum" : "Ubah Kurikulum"}}</x-button.back>
  <x-container>
    <x-typography :variant="'body-medium-bold'">Daftar Mata Kuliah</x-typography>
    <form action="{{Request::routeIs('curriculum.list.view.show-study') ? route('curriculum.list.view.show-study', ['id' => $id]) : route('curriculum.list.edit.show-study', ['id' => $id])}}" method="GET">
      <x-container :variant="'content-wrapper'" :class="'!px-0'">
        <x-form.input-container :class="'min-w-[160px]'">
          <x-slot name="label">Program Perkuliahan</x-slot>
          <x-slot name="input">
            <x-form.dropdown 
              :buttonId="'jenisMataKuliah'"
              :dropdownId="'listJenisMataKuliah'"
              :label="$jenis_mata_kuliah !== '' ? $jenis_mata_kuliah : 'Pilih Mata Kuliah'"
              :imgSrc="asset('assets/base/icon-arrow-down.svg')"
              :isIconCanRotate="true"
              :dropdownItem="
                array_merge(
                  ...array_map(
                    function($jenis) { return [$jenis => $jenis];  }, 
                    $jenis_mata_kuliah_list
                  )
                )
              "
              :buttonStyleClass="'!border-[#D9D9D9] hover:!bg-[#D9D9D9] !text-black w-full flex items-center justify-between flex-1'"
              :dropdownContainerClass="'w-full'"
              :isUsedForInputField="true"
              :inputFieldName="'jenis_mata_kuliah'"
              :inputValue="$jenis_mata_kuliah"
              onclick="updateSearchFormState()"
            />
          </x-slot>
        </x-form.input-container>
        <x-form.input-container :class="'min-w-[160px]'">
          <x-slot name="label">Nama Mata Kuliah</x-slot>
          <x-slot name="input">
            <x-container class="flex items-center rounded-lg !px-4 !py-2">
              <input 
                placeholder="Ketik Mata Kuliah" 
                name="nama" 
                type="text" 
                id="courseName" 
                class="!border-transparent focus:outline-none w-full" 
                value="{{$nama_mata_kuliah}}"
                oninput="
                  updateSearchFormState();
                  if(this.value == '')
                    this.nextElementSibling.classList.add('hidden');
                  else 
                    this.nextElementSibling.classList.remove('hidden');
                "
              >
              <img 
                class="hidden cursor-pointer" 
                src="{{asset('assets/icon-remove-text-input.svg')}}" 
                alt=""
                onclick="
                  this.previousElementSibling.value = '';
                  this.classList.add('hidden');
                "
              >
            </x-container>
          </x-slot>
        </x-form.input-container>
        <x-container :variant="'content-wrapper'" :class="'!px-0 flex flex-row items-center w-full justify-end'">
          <x-button.secondary disabled="{{$jenis_mata_kuliah == '' && $nama_mata_kuliah == '' ? 'disabled': ''}}">Batal</x-button.secondary>
          <x-button.primary id="btnCari" type="submit" disabled="{{$jenis_mata_kuliah == '' && $nama_mata_kuliah == '' ? 'disabled': ''}}">Cari</x-button.primary>
        </x-container>
      </x-container>
    </form>
    <x-container class="border-none !px-0">
      <x-table>
        <x-table-head>
          <x-table-row>
            <x-table-header class="cursor-pointer">Kode Mata Kuliah</x-table-header>
            <x-table-header class="cursor-pointer">Nama</x-table-header>
            <x-table-header class="cursor-pointer">SKS</x-table-header>
            <x-table-header class="cursor-pointer">Semester</x-table-header>
            <x-table-header>Jumlah CPL</x-table-header>
            <x-table-header>Jenis Mata Kuliah</x-table-header>
            @if(!Request::routeIs('curriculum.list.view.show-study'))
              <x-table-header>Aksi</x-table-header>
            @endif
          </x-table-row>
        </x-table-head>
        <x-table-body>
          @forelse ($data as $d)
            <x-table-row>
              <x-table-cell>{{ $d->kode_matakuliah }}</x-table-cell>
              <x-table-cell>{{ $d->nama_matakuliah_id }}</x-table-cell>
              <x-table-cell>{{ $d->sks }}</x-table-cell>
              <x-table-cell>{{ $d->semester }}</x-table-cell>
              <x-table-cell>{{ count($d->cpls) }}</x-table-cell>
              <x-table-cell>{{ $d->course->jenis }}</x-table-cell>
              @if(!Request::routeIs('curriculum.list.view.show-study'))
                <x-table-cell>
                  <x-container :variant="'content-wrapper'" :class="'flex flex-row gap-10 items-center justify-center'">
                    <x-button.base 
                      :href="route('curriculum.list.edit.edit-study', ['id' => $id, 'course_id' => $d->id])" 
                      :icon="asset('assets/icon-edit.svg')" 
                      class="text-[#E62129] scale-75"
                    >
                      Ubah
                    </x-button.base>
                    <x-button.base
                      :icon="asset('assets/icon-delete-gray-600.svg')"
                      class="text-[#8C8C8C] scale-75"
                      onclick="
                        document.getElementById('modalKonfirmasiHapus').setAttribute('data-id', {{$d->id}});
                        document.getElementById('modalKonfirmasiHapus').classList.add('flex');
                        document.getElementById('modalKonfirmasiHapus').classList.remove('hidden');
                      "
                    >
                      Hapus
                    </x-button.base>
                  </x-container>
                </x-table-cell>
              @endif
            </x-table-row>
          @empty
            <x-table-row>
              <x-table-cell colspan="6" class="text-center py-4">
                Tidak ada data ditemukan
              </x-table-cell>
            </x-table-row>
          @endforelse
        </x-table-body>
      </x-table>
    </x-container>
  </x-container>
  @include('partials.pagination', [
    'currentPage' => $response->pagination->current_page,
    'lastPage' => $response->pagination->last_page,
    'limit' => $response->pagination->per_page,
    'routes' => route('curriculum.list.view.show-study', ['id' => $id]),
  ])
</x-container>

<x-modal.container-pure-js id="modalKonfirmasiHapus">
  <x-slot name="header">
    <x-container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
      <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Hapus Daftar Mata Kuliah</x-typography>
      <x-icon :iconUrl="asset('assets/icon-delete-gray-800.svg')" :class="'w-8 h-8'" />
    </x-container>
  </x-slot>
  <x-slot name="body">Apakah Anda yakin ingin menghapus menghapus ini?</x-slot>
  <x-slot name="footer">
    <x-button.secondary 
      onclick="
        document.getElementById('modalKonfirmasiHapus').classList.add('hidden');
        document.getElementById('modalKonfirmasiHapus').classList.remove('flex');
        document.getElementById('modalKonfirmasiHapus').removeAttribute('data-id')
      "
    >
      Batal
    </x-button.secondary>
    <x-button.primary 
      onclick="
        const id = document.getElementById('modalKonfirmasiHapus').getAttribute('data-id');
        onDeleteCourse(
          '{{ route('curriculum.list.edit.show-study', ['id' => ':id']) }}'.replace(':id', id),
          '{{ route('academics-event.delete', ['id' => ':id']) }}'.replace(':id', id)
        )
      "
    >
      Hapus
    </x-button.primary>
  </x-slot>
</x-modal.container-pure-js>
@endsection