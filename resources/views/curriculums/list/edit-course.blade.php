@extends('layouts.main')

@section('title', Request::routeIs('curriculum.list.view.show-study') ? 'Lihat Mata Kuliah Kurikulum' : 'Ubah Mata Kuliah Kurikulum')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Kurikulum</div>
@endsection

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{asset('js/custom/curriculum.js')}}"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    setInterval(() => {
      updateStateChangeCourse();
    }, 0);
  })
</script>

@section('content')
<form action="{{route('curriculum.list.edit.update-assign-study', ['id' => $id, 'course_id' => $course_id])}}" method="POST">
  @csrf
  <x-container.container :variant="'content-wrapper'">
    <x-typography :variant="'body-large-semibold'">Ubah Mata Kuliah Kurikulum</x-typography>
    <x-button.back :href="route('curriculum.list.edit.show-study', ['id' => $id])">Ubah Mata Kuliah</x-button.back>
    <x-container.container :class="'!p-0 !overflow-hidden'">
      <x-typography :variant="'body-medium-bold'" :class="'bg-gradient-to-r from-[#FFECED] to-[#FFFFFF] w-full !flex p-[20px]'">Ubah Mata Kuliah Kurikulum</x-typography>
      <table class="w-full">
        <tbody>
          <x-table.row class="text-[#262626]">
            <x-table.cell class="bg-[#E8E8E8] text-start w-[30%]">Nama Kurikulum</x-table.cell>
            <x-table.cell class="text-start bg-[#F5F5F5] font-bold w-[70%]"></x-table.cell>
          </x-table.row>
          <x-table.row class="text-[#262626]">
            <x-table.cell class="bg-[#F5F5F5] text-start w-[30%]">Kode Mata Kuliah</x-table.cell>
            <x-table.cell class="text-start bg-[#FFFFFF] font-bold w-[70%]">{{$data->kode_matakuliah}}</x-table.cell>
          </x-table.row>
          <x-table.row class="text-[#262626]">
            <x-table.cell class="bg-[#E8E8E8] text-start w-[30%]">Mata Kuliah</x-table.cell>
            <x-table.cell class="text-start bg-[#F5F5F5] font-bold w-[70%]">{{$data->nama_matakuliah_id}}</x-table.cell>
          </x-table.row>
          <x-table.row class="text-[#262626]">
            <x-table.cell class="bg-[#F5F5F5] text-start w-[30%]">SKS</x-table.cell>
            <x-table.cell class="text-start bg-[#FFFFFF] font-bold w-[70%]">{{$data->sks}}</x-table.cell>
          </x-table.row>
          <x-table.row class="text-[#262626]">
            <x-table.cell class="bg-[#E8E8E8] text-start w-[30%]">Semester Kurikulum</x-table.cell>
            <x-table.cell class="text-start bg-[#F5F5F5] font-bold w-[70%]">{{$data->semester}}</x-table.cell>
          </x-table.row>
        </tbody>
      </table>
    </x-container>
    <x-container.container :variant="'content-wrapper'">
      <ul class="text-[#0065A3] list-disc italic">
        <li>Setiap perubahan data akan memengaruhi seluruh portofolio mata kuliah</li>
      </ul>
    </x-container>
    <x-container.container>
      <x-form.input-container>
        <x-slot name="label">Semester</x-slot>
        <x-slot name="input">
          <div class="flex flex-col !items-start w-full gap-1">
            <input type="text" id="semester" class="w-full pe-10 box-border ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10" value="{{$data->semester}}" name="semester" placeholder="semester" oninput="onInputSemester(this)">
            <x-typography :variant="'caption-regular'" class="text-[#8C8C8C]">Semester hanya dapat diisi dengan angka 1 sampai 8</x-typography>
          </div>
        </x-slot>
      </x-form.input-container>
    </x-container>
    <x-container.container :class="'!overflow-hidden !p-0'">
      <x-typography :variant="'body-medium-bold'" :class="'bg-gradient-to-r from-[#FFECED] to-[#FFFFFF] w-full !flex p-[20px]'">Capaian Pembelajaran Lulusan</x-typography>
        <x-container.container class="border-none">
          <x-table.index>
            <x-table.head>
              <x-table.row>
                <x-table.header-cell class="cursor-pointer">
                  Kode
                </x-table.header-cell>
                <x-table.header-cell class="cursor-pointer">
                  Capaian
                </x-table.header-cell>
                <x-table.header-cell class="cursor-pointer">
                  <input type="checkbox" id="select-all" oninput="onClickSelectAll(event)">
                </x-table.header-cell>
              </x-table.row>
            </x-table.head>
            <x-table.body>
              @forelse ($cpls as $cpl)
                <x-table.row>
                  <x-table.cell>{{ $cpl->kode_cpl }}</x-table.cell>
                  <x-table.cell class="text-start">{{ $cpl->deskripsi_cpl }}</x-table.cell>
                  <x-table.cell>
                    <input type="checkbox" name="cpl[]" id="select-all" value="{{$cpl->id_cpl}}" @if($cpl->is_select) checked @endif>
                  </x-table.cell>
                </x-table.row>
              @empty
                <x-table.row>
                  <x-table.cell colspan="3" class="text-center py-4">
                    Tidak ada data ditemukan
                  </x-table.cell>
                </x-table.row>
              @endforelse
            </x-table.body>
          </x-table.index>
        </x-container>
        <x-container.container :variant="'content-wrapper'" :class="'!flex !flex-row !justify-end !w-full py-4'">
          <x-button.secondary :href="route('curriculum.list.edit.show-study', ['id' => $id])">Batal</x-button.secondary>
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
    </x-container>
  </x-container>
  <x-modal.container-pure-js id="modalKonfirmasiSimpan">
    <x-slot name="header">
      <x-container.container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
        <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Tunggu Sebentar</x-typography>
        <x-icon :iconUrl="asset('assets/icon-caution.svg')" :class="'w-8 h-8'" />
      </x-container>
    </x-slot>
    <x-slot name="body">Apakah Anda yakin informasi yang diubah sudah benar?</x-slot>
    <x-slot name="footer">
      <x-button.secondary
        onclick="
          document.getElementById('modalKonfirmasiSimpan').classList.add('hidden')
          document.getElementById('modalKonfirmasiSimpan').classList.remove('flex')
        "
      >
        Cek Kembali
      </x-button.secondary>
      <x-button.primary type="submit" id="btnYaSimpan">Ya, Simpan Sekarang</x-button.primary>
    </x-slot>
  </x-modal.container-pure-js>
</form>
@endsection