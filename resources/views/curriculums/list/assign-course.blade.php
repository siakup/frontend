@extends('layouts.main')

@section('title', 'Tetapkan Mata Kuliah Kurikulum')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Kurikulum</div>
@endsection

@section('css')
@endsection

<script src="{{asset('js/custom/curriculum.js')}}"></script>

@section('content')
<x-container.container :variant="'content-wrapper'">
  <x-typography :variant="'body-large-semibold'">Tetapkan Mata Kuliah</x-typography>
  <x-button.back :href="route('curriculum.list.edit', ['id' => $id])">Ubah Kurikulum</x-button.back>
  <x-container.container>
    <form action="{{route('curriculum.list.edit.assign-study', ['id' => $id])}}" method="GET">
      <x-typography :variant="'body-medium-bold'">Daftar Mata Kuliah</x-typography>
      <x-container.container :variant="'content-wrapper'" :class="'!px-0'">
       <x-form.input-container :class="'min-w-[130px]'">
          <x-slot name="label">Jenis Mata Kuliah</x-slot>
          <x-slot name="input">
            <x-form.dropdown 
              :buttonId="'sortCampusProgram'"
              :dropdownId="'campusProgramList'"
              :label="$jenis_mata_kuliah ? $jenis_mata_kuliah : 'Semua Mata Kuliah'"
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
        <x-form.input-container :class="'min-w-[130px]'">
          <x-slot name="label">Mata Kuliah</x-slot>
          <x-slot name="input">
            <x-container.container class="flex items-center rounded-lg !px-4 !py-2">
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
        <x-container.container :variant="'content-wrapper'" class="flex flex-row w-full justify-end !px-0">
          <x-button.secondary 
            type="button" 
            id="btnBatal"
          >
            Batal
          </x-button.secondary>
          <x-button.primary 
            type="submit" 
            id="btnCari" 
            disabled="{{$jenis_mata_kuliah == '' && $nama_mata_kuliah == '' ? true : false}}"
          >
            Cari
          </x-button.primary>
        </x-container>
      </x-container> 
    </form>
  </x-container>
  <form action="{{route('curriculum.list.edit.update-assign-study', ['id' => $id])}}" method="POST">
  @csrf
  <x-container.container :class="'border-none flex flex-col gap-4'">
      <x-table.index>
          <x-table.head>
              <x-table.row>
                  <x-table.header-cell class="cursor-pointer">
                      <input oninput="onClickSelectAll(event, `input[name='course-list[]']`)" type="checkbox" id="select-all" class="not-checked:appearance-none not-checked:bg-white not-checked:border-[1px] not-checked:border-black not-checked:w-[12px] not-checked:h-[12px] not-checked:rounded-xs accent-[#E62129]">
                  </x-table.header-cell>
                  <x-table.header-cell class="cursor-pointer">Kode Mata Kuliah</x-table.header-cell>
                  <x-table.header-cell class="cursor-pointer">Nama</x-table.header-cell>
                  <x-table.header-cell class="cursor-pointer">Jumlah SKS</x-table.header-cell>
                  <x-table.header-cell class="cursor-pointer">Program Studi</x-table.header-cell>
                  <x-table.header-cell>Jenis Mata Kuliah</x-table.header-cell>
              </x-table.row>
          </x-table.head>
          <x-table.body>
              @forelse ($data as $d)
                  <x-table.row>
                      <x-table.cell>
                        <input type="checkbox" name="course-list[]" value="{{$d->id}}" class="not-checked:appearance-none not-checked:bg-white not-checked:border-[1px] not-checked:border-black not-checked:w-[12px] not-checked:h-[12px] not-checked:rounded-xs accent-[#E62129]" @if($d->is_assigned) checked @endif>
                      </x-table.cell>
                      <x-table.cell>{{ $d->kode }}</x-table.cell>
                      <x-table.cell>{{ $d->nama_id }}</x-table.cell>
                      <x-table.cell>{{ $d->sks }}</x-table.cell>
                      <x-table.cell>{{ current(array_filter($programStudiList, function ($item) use ($d) { return $item->id == $d->id_prodi; })) ? current(array_filter($programStudiList, function ($item) use ($d) { return $item->id == $d->id_prodi; }))->nama : "" }}</x-table.cell>
                      <x-table.cell>{{ $d->id_jenis }}</x-table.cell>
                  </x-table.row>
              @empty
                  <x-table.row>
                      <x-table.cell colspan="6" class="text-center py-4">
                          Tidak ada data ditemukan
                      </x-table.cell>
                  </x-table.row>
              @endforelse
          </x-table.body>
      </x-table.index>
      <x-button.primary :class="'self-end'" type="submit" id="btnSimpan">Tetapkan</x-button.primary>
    </x-container>
  </form>
  @include('partials.pagination', [
      'currentPage' => $response->pagination->current_page,
      'lastPage' => $response->pagination->last_page,
      'limit' => 10,
      'routes' => route('curriculum.list.edit.assign-study', ['id' => $id]),
  ])
</x-container>
@endsection