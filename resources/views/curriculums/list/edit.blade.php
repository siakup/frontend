@extends('layouts.main')

@section('title', 'Ubah Kurikulum')

<script src="{{ asset('js/custom/curriculum.js')}}"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    updateSaveButtonState();
  });
</script>

@include('partials.success-notification-modal', ['route' => route('curriculum.list.edit', ['id' => $id])])
@section('content')
<form action="{{route('curriculum.list.update', ['id' => $id])}}" method="POST">
  @csrf
  <x-container.container :variant="'content-wrapper'">
    <x-typography :variant="'body-large-semibold'">Ubah Kurikulum</x-typography>
    <x-button.back :href="route('curriculum.list').'?program_studi='.$data->program_studi">Daftar Kurikulum</x-button.back>
    <x-container.container>
      <x-typography :variant="'body-medium-bold'">Detail Kurikulum</x-typography>
      <x-container.container :variant="'content-wrapper'" :class="'!px-0'">
        <x-form.input-container :class="'min-w-[175px]'">
          <x-slot name="label">Program Studi</x-slot>
          <x-slot name="input">
            <input 
              placeholder="Program Studi" 
              name="" 
              type="text" 
              id="program_studi" 
              class="w-full pe-10 box-border ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10 read-only:bg-[#F5F5F5] read-only:text-[#8C8C8C] read-only:cursor-not-allowed" 
              value="{{array_values(array_filter($programStudiList, function($item) use($data) { return $item->id == $data->program_studi; }))[0]->nama}}" 
              readonly
            />
            <input name="program_studi" type="hidden" id="" value="{{$data->program_studi}}" readonly />
          </x-slot>
        </x-form.input-container>
        <x-form.input-container :class="'min-w-[175px]'">
          <x-slot name="label">Program Perkuliahan</x-slot>
          <x-slot name="input">
            <x-form.dropdown 
              :buttonId="'sortCampusProgram'"
              :dropdownId="'campusProgramList'"
              :label="'Pilih Program Perkuliahan'"
              :imgSrc="asset('assets/base/icon-arrow-down.svg')"
              :isIconCanRotate="true"
              :dropdownItem="array_column($programPerkuliahanList, 'name', 'name')"
              :buttonStyleClass="'!border-[#D9D9D9] hover:!bg-[#D9D9D9] !text-black w-full flex items-center justify-between flex-1'"
              :dropdownContainerClass="'w-full'"
              :isUsedForInputField="true"
              :inputFieldName="'program_perkuliahan'"
              :inputValue="$data->perkuliahan"
              onclick="updateSaveButtonState()"
            />
          </x-slot>
        </x-form.input-container>
        <x-form.input-container :class="'min-w-[175px]'">
          <x-slot name="label">Nama Kurikulum</x-slot>
          <x-slot name="input">
            <x-container.container :class="'w-full  !pe-10 box-border !ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10 flex items-center'">
              <input 
                oninput="
                  updateSaveButtonState();
                  if(this.value == '') {
                    this.nextElementSibling.classList.add('hidden');
                  } else {
                    this.nextElementSibling.classList.remove('hidden');
                  }
                " 
                placeholder="Nama Kurikulum" 
                name="curriculum_nama" 
                type="text" 
                id="Curriculum-Name" 
                class="!border-transparent focus:outline-none w-full" 
                value="{{ $data->nama_kurikulum }}"
              >
              <img class="hidden cursor-pointer" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="" onclick="this.previousElementSibling.value = '';this.classList.add('hidden');">
            </x-container>
          </x-slot>
        </x-form.input-container>
        <x-form.input-container :class="'min-w-[175px]'">
          <x-slot name="label">Deskripsi</x-slot>
          <x-slot name="input">
            <x-container.container :class="'w-full !pe-10 box-border !ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10 flex items-center'">
              <input 
                oninput="
                  updateSaveButtonState();
                  if(this.value == '') {
                    this.nextElementSibling.classList.add('hidden');
                  } else {
                    this.nextElementSibling.classList.remove('hidden');
                  }
                " 
                placeholder="Deskripsi" 
                name="deskripsi" 
                type="text" 
                id="Deskripsi" 
                class="!border-transparent focus:outline-none w-full" 
                value="{{ $data->deskripsi }}"
              >
              <img class="hidden cursor-pointer" onclick="this.previousElementSibling.value = '';this.classList.add('hidden');" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
            </x-container>
          </x-slot>
        </x-form.input-container>
        <x-form.input-container :class="'min-w-[175px]'">
          <x-slot name="label">SKS Mata Kuliah Wajib</x-slot>
          <x-slot name="input">
            <x-container.container :class="'w-full !pe-10 box-border !ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10 flex items-center'">
              <input 
                oninput="
                  updateSaveButtonState();
                  this.value = this.value.replace(/[^0-9]/g, '');
                  if(this.value == '') {
                    this.nextElementSibling.classList.add('hidden');
                  } else {
                    this.nextElementSibling.classList.remove('hidden');
                  }
                " 
                placeholder="SKS Mata Kuliah Wajib" 
                name="sks_wajib" 
                type="text" 
                id="Wajib" 
                class="!border-transparent focus:outline-none w-full" 
                value="{{ $data->sks_wajib }}"
              >
              <img onclick="this.previousElementSibling.value = '';this.classList.add('hidden');" class="hidden cursor-pointer" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
            </x-container>
          </x-slot>
        </x-form.input-container>
        <x-form.input-container :class="'min-w-[175px]'">
          <x-slot name="label">SKS Mata Kuliah Pilihan</x-slot>
          <x-slot name="input">
            <x-container.container :class="'w-full !pe-10 box-border !ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10 flex items-center'">
              <input 
                oninput="
                  updateSaveButtonState();
                  this.value = this.value.replace(/[^0-9]/g, '');
                  if(this.value == '') {
                    this.nextElementSibling.classList.add('hidden');
                  } else {
                    this.nextElementSibling.classList.remove('hidden');
                  }
                " 
                placeholder="SKS Mata Kuliah Pilihan" 
                name="sks_pilihan" 
                type="text" 
                id="Pilihan" 
                class="!border-transparent focus:outline-none w-full" 
                value="{{$data->sks_pilihan}}"
              >
              <img onclick="this.previousElementSibling.value = '';this.classList.add('hidden');" class="hidden cursor-pointer" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
            </x-container>
          </x-slot>
        </x-form.input-container>
        <x-form.input-container :class="'min-w-[175px]'">
          <x-slot name="label">Total SKS</x-slot>
          <x-slot name="input">
            <x-container.container :class="'w-full !pe-10 box-border !ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10 flex items-center'">
              <input 
                oninput="
                  updateSaveButtonState();
                  this.value = this.value.replace(/[^0-9]/g, '');
                  if(this.value == '') {
                    this.nextElementSibling.classList.add('hidden');
                  } else {
                    this.nextElementSibling.classList.remove('hidden');
                  }
                " 
                placeholder="Total SKS" 
                name="total_sks" 
                type="text" 
                id="Total" 
                class="!border-transparent focus:outline-none w-full" 
                value="{{$data->sks_total}}"
              />
              <img onclick="this.previousElementSibling.value = '';this.classList.add('hidden');" class="hidden cursor-pointer" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
            </x-container>
          </x-slot>
        </x-form.input-container>
        <x-form.toggle :id="'academic-periode-status'" :value="$data->status === 'active'" />
      </x-container>
    </x-container>
    <x-container.container :class="'flex flex-col gap-4'">
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
          @foreach($jenis_mata_kuliah as $jenis)
            <x-table.row class="bg-[#FAFAFA] border-1 border-[#D9D9D9]">
                <x-table.cell :variant="'old'">{{$jenis}}</x-table.cell>
                <x-table.cell :variant="'old'" class="py-[12px] !w-[25%]"></x-table.cell>
                <x-table.cell :variant="'old'">
                  <x-container.container class="!bg-transparent rounded-lg !py-[9px] flex">
                    @php
                      $filter = current(array_filter($data->details, function ($detail) use($jenis) { return $detail->jenis_mata_kuliah == $jenis; }));
                    @endphp
                    <input 
                      name="minimum_sks[{{$jenis}}]" 
                      class="w-full bg-transparent !border-transparent focus:outline-none text-[14px]" 
                      placeholder="Minimum SKS" 
                      type="number" 
                      value="{{$filter ? $filter->sks_minimal : 0}}" 
                      oninput="
                        this.value = this.value.replace(/[^0-9]/g, '');
                        if(this.value == '') {
                          this.nextElementSibling.classList.add('hidden');
                        } else {
                        this.nextElementSibling.classList.remove('hidden');
                        }
                      "
                    />
                    <img onclick="this.previousElementSibling.value = '';this.classList.add('hidden');" class="hidden cursor-pointer" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
                  </x-container> 
                </x-table-cel>
            </x-table.row>
          @endforeach
        </tbody>
      </x-table.index>
      <x-typography :variant="'body-medium-bold'">Daftar Mata Kuliah yang telah di assign</x-typography>
      <x-table.index>
        <x-table.head>
            <x-table.row>
                <x-table.header-cell class="cursor-pointer">
                    <input type="checkbox" id="select-all" class="" checked disabled>
                </x-table.header-cell>
                <x-table.header-cell class="cursor-pointer">
                    Kode Mata Kuliah
                </x-table.header-cell>
                <x-table.header-cell class="cursor-pointer">
                    Nama
                </x-table.header-cell>
                <x-table.header-cell class="cursor-pointer">
                    Jumlah SKS
                </x-table.header-cell>
                <x-table.header-cell class="cursor-pointer">
                    Program Studi
                </x-table.header-cell>
                <x-table.header-cell>Jenis Mata Kuliah</x-table.header-cell>
            </x-table.row>
        </x-table.head>
        <x-table.body>
            @forelse ($assignCourseData as $d)
                <x-table.row class="!bg-[#EFF4CD]">
                    <x-table.cell>
                      <input type="checkbox" name="course-list[]" value="{{$d['id']}}" checked disabled>
                    </x-table.cell>
                    <x-table.cell>{{ $d['kode_mata_kuliah'] }}</x-table.cell>
                    <x-table.cell>{{ $d['nama'] }}</x-table.cell>
                    <x-table.cell>{{ $d['sks'] }}</x-table.cell>
                    <x-table.cell>{{ $d['program_studi'] }}</x-table.cell>
                    <x-table.cell>{{ $d['jenis_mata_kuliah']}}</x-table.cell>
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
    </x-container>
    <x-container.container :class="'flex flex-row justify-between items-center'">
      <x-container.container :variant="'content-wrapper'" class="flex flex-row items-center !px-0 w-full">
        <x-button.secondary :href="route('curriculum.list').'?program_studi='.$data->program_studi" id="btnBatal" disabled>Batal</x-button.secondary>
        <x-button.primary 
          id="btnSimpan" 
          disabled
          onclick="
            document.getElementById('modalKonfirmasiSimpan').classList.add('flex');
            document.getElementById('modalKonfirmasiSimpan').classList.remove('hidden');
          "
        >
          Simpan
        </x-button.primary>
      </x-container>
      <x-container.container :variant="'content-wrapper'" class="flex flex-row items-center !px-0 justify-end">
        <x-button.secondary :href="route('curriculum.list.edit.show-study', ['id' => $id])" :icon="asset('assets/icon-eye-red.svg')" :iconPosition="'right'">
          Lihat Daftar Mata Kuliah
        </x-button.secondary>
        <x-button.primary :href="route('curriculum.list.edit.assign-study', ['id' => $id])" :icon="asset('assets/icon-mata-kuliah-white.svg')" :iconPosition="'right'">
          Tetapkan Mata Kuliah
        </x-button.primary>
      </x-container>
    </x-container>
  </x-container>
  <x-modal.container-pure-js id="modalKonfirmasiSimpan">
    <x-slot name="header">
      <x-container.container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
        <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Tunggu Sebentar</x-typography>
        <x-icon :iconUrl="asset('assets/icon-caution.svg')" :class="'w-8 h-8'" />
      </x-container>
    </x-slot>
    <x-slot name="body">Apakah anda yakin informasi yang diubah sudah benar?</x-slot>
    <x-slot name="footer" class="modal-custom-footer w-full gap-[16px] pl-[20px] pb-[20px]">
      <x-button.secondary 
        id="btnCekKembali"
        onclick="
          document.getElementById('modalKonfirmasiSimpan').classList.add('hidden');
          document.getElementById('modalKonfirmasiSimpan').classList.remove('flex');
        "
      >
        Cek Kembali
      </x-button.secondary>
      <x-button.primary type="submit" id="btnYa">Ya, Simpan Sekarang</x-button.primary>
    </x-slot>
  </x-modal.container-pure-js>
</form>
@endsection