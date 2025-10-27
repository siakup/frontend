@extends('layouts.main')

@section('title', 'Tambah Kurikulum')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Kurikulum</div>
@endsection

<script src="{{ asset('js/custom/curriculum.js') }}"></script>
@section('content')
  <form action="{{route('curriculum.list.store')}}" method="POST">
  @csrf
  <x-container :variant="'content-wrapper'">
    <x-typography :variant="'body-large-semibold'">Tambah Kurikulum</x-typography>
    <x-button.back :href="route('curriculum.list').'?program_studi='.$program_studi">Daftar Kurikulum</x-button.back>
      <x-container>
        <x-typography :variant="'body-medium-bold'">Detail Kurikulum 2025 - {{array_values(array_filter($programStudiList, function($item) use($id_prodi) { return $item->id == $id_prodi; }))[0]->nama}}</x-typography>
        <x-container :variant="'content-wrapper'" :class="'!px-0'">
          <x-form.input-container :class="'min-w-[175px]'">
            <x-slot name="label">Program Studi</x-slot>
            <x-slot name="input">
              <input 
                placeholder="Program Studi" 
                name="" 
                type="text" 
                id="program_studi" 
                class="w-full pe-10 box-border ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10 read-only:bg-[#F5F5F5] read-only:text-[#8C8C8C] read-only:cursor-not-allowed" 
                value="{{array_values(array_filter($programStudiList, function($item) use($id_prodi) { return $item->id == $id_prodi; }))[0]->nama}}" 
                readonly
              />
              <input name="program_studi" type="hidden" id="" value="{{$id_prodi}}" readonly />
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
                onclick="updateSaveButtonState()"
              />
            </x-slot>
          </x-form.input-container>
          <x-form.input-container :class="'min-w-[175px]'">
            <x-slot name="label">Nama Kurikulum</x-slot>
            <x-slot name="input">
              <x-container :class="'w-full  !pe-10 box-border !ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10 flex items-center'">
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
                  value=""
                >
                <img class="hidden cursor-pointer" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="" onclick="this.previousElementSibling.value = '';this.classList.add('hidden');">
              </x-container>
            </x-slot>
          </x-form.input-container>
          <x-form.input-container :class="'min-w-[175px]'">
            <x-slot name="label">Deskripsi</x-slot>
            <x-slot name="input">
              <x-container :class="'w-full !pe-10 box-border !ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10 flex items-center'">
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
                  value=""
                >
                <img class="hidden cursor-pointer" onclick="this.previousElementSibling.value = '';this.classList.add('hidden');" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
              </x-container>
            </x-slot>
          </x-form.input-container>
          <x-form.input-container :class="'min-w-[175px]'">
            <x-slot name="label">SKS Mata Kuliah Wajib</x-slot>
            <x-slot name="input">
              <x-container :class="'w-full !pe-10 box-border !ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10 flex items-center'">
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
                  value=""
                >
                <img onclick="this.previousElementSibling.value = '';this.classList.add('hidden');" class="hidden cursor-pointer" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
              </x-container>
            </x-slot>
          </x-form.input-container>
          <x-form.input-container :class="'min-w-[175px]'">
            <x-slot name="label">SKS Mata Kuliah Pilihan</x-slot>
            <x-slot name="input">
              <x-container :class="'w-full !pe-10 box-border !ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10 flex items-center'">
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
                  value=""
                >
                <img onclick="this.previousElementSibling.value = '';this.classList.add('hidden');" class="hidden cursor-pointer" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
              </x-container>
            </x-slot>
          </x-form.input-container>
          <x-form.input-container :class="'min-w-[175px]'">
            <x-slot name="label">Total SKS</x-slot>
            <x-slot name="input">
              <x-container :class="'w-full !pe-10 box-border !ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10 flex items-center'">
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
                  value=""
                >
                <img onclick="this.previousElementSibling.value = '';this.classList.add('hidden');" class="hidden cursor-pointer" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
              </x-container>
            </x-slot>
          </x-form.input-container>
          <x-form.toggle :id="'statusValue'" />
        </x-container>
      </x-container>
      <x-container :class="'flex flex-col gap-4'">
        <x-typography :variant="'body-medium-bold'">Jenis Mata Kuliah - Minimum SKS</x-typography>
        <x-table :variant="'old'" id="list-matkul">
          <x-table-head :variant="'old'">
            <x-table-row :variant="'old'">
              <x-table-header :variant="'old'">Jenis Mata Kuliah</x-table-header>
              <x-table-header :variant="'old'"></x-table-header>
              <x-table-header :variant="'old'">Minimum SKS</x-table-header>
            </x-table-row>
          </x-table-head>
          <tbody>
            @foreach($jenis_mata_kuliah as $jenis)
              <x-table-row :variant="'old'" class="bg-[#FAFAFA] border-1 border-[#D9D9D9]">
                <x-table-cell :variant="'old'">{{$jenis}}</x-table-cell>
                <x-table-cell :variant="'old'" class="py-[12px] !w-[25%]"></x-table-cell>
                <x-table-cell :variant="'old'">
                  <x-container class="!bg-transparent rounded-lg !py-[9px] flex">
                    <input 
                      class="w-full bg-transparent !border-transparent focus:outline-none text-[14px]" 
                      placeholder="Minimum SKS" 
                      type="number" 
                      value="" 
                      name="{{str_replace(' ', '_', strtolower($jenis))}}" 
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
                </x-table-cell>
              </x-table-row>
            @endforeach
          </tbody>
        </x-table>
      </x-container>
      <x-container class="flex gap-4">
        <x-button.secondary id="btnBatal" :href="route('curriculum.list')" disabled>Batal</x-button.secondary>
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
      <x-modal.container-pure-js id="modalKonfirmasiSimpan">
        <x-slot name="header">
          <x-container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
            <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Tunggu Sebentar</x-typography>
            <x-icon :iconUrl="asset('assets/icon-caution.svg')" :class="'w-8 h-8'" />
          </x-container>
        </x-slot>
        <x-slot name="body">Apakah Anda yakin informasi yang ditambah sudah benar?</x-slot>
        <x-slot name="footer">
          <x-button.secondary 
            id="btnCekKembali"
            onclick="
              documemt.getElementById('modalKonfirmasiSimpan').classList.add('hidden')
              documemt.getElementById('modalKonfirmasiSimpan').classList.remove('flex')
            "
          >
            Cek Kembali
          </x-button.secondary>
          <x-button.primary type="submit" id="btnYaSimpan">Ya, Simpan Sekarang</x-button.primary>
        </x-slot>
      </x-modal.container-pure-js>
    </x-container>  
  </form>
@endsection