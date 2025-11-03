@extends('layouts.main')

@section('title', 'Ekuivalensi Kurikulum')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Ekuivalensi Kurikulum</div>
@endsection

@section('content')
  <x-container :variant="'content-wrapper'">
    <x-typography :variant="'body-large-semibold'">Unggah Ekuivalensi Kurikulum</x-typography>
    <x-button.back :href="route('curriculum.equivalence.upload')">Unggah Ekuivalensi Kurikulum</x-button.back>
    <x-container :class="'flex flex-col gap-4'">
      <x-container :variant="'content-wrapper'" class="flex flex-row items-center !px-0">
        <x-typography :variant="'body-medium-bold'">Impor Ekuivalensi Kurikulum</x-typography>
        <x-icon :iconUrl="asset('assets/icon-caution.svg')" :class="'w-auto h-[1.5em]'" />
      </x-container>
      <x-table>
        <x-table-head>
          <x-table-row>
            <x-table-header>Kode Mata Kuliah Lama</x-table-header>
            <x-table-header>Kode Mata Kuliah Baru</x-table-header>
          </x-table-row>
        </x-table-head>
        <tbody>
          @foreach($datas as $data)
            <x-table-row>
                <x-table-cell>{{$data['Kode MK Lama']}}</x-table-cell>
                <x-table-cell>{{$data['Kode MK Baru']}}</x-table-cell>
            </x-table-row>
            @endforeach
        </tbody>
      </x-table>
      <x-container :variant="'content-wrapper'" class="flex flex-row !p-0 items-center justify-end gap-3 w-full">
        <x-button.secondary :href="route('curriculum.equivalence.upload')">Batal</x-button.secondary>
        <x-button.primary
          onclick="
            document.getElementById('modalKonfirmasiUpload').classList.add('flex');
            document.getElementById('modalKonfirmasiUpload').classList.remove('hidden');
          "
        >
          Simpan
        </x-button.primary>
      </x-container>
    </x-container>
  </x-container>
  <form action="{{route('curriculum.equivalence.save-upload')}}" method="POST">
    @csrf
    @foreach($datas as $index => $course)
      <input type="hidden" name="data[{{$index}}][kode_mk_lama]" value="{{$course['Kode MK Lama']}}">
      <input type="hidden" name="data[{{$index}}][kode_mk_baru]" value="{{$course['Kode MK Baru']}}">
    @endforeach
    <x-modal.container-pure-js id="modalKonfirmasiUpload">
      <x-slot name="header">
        <x-container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
          <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Tunggu Sebentar</x-typography>
          <x-icon :iconUrl="asset('assets/icon-caution.svg')" :class="'w-8 h-8'" />
        </x-container>
      </x-slot>
      <x-slot name="body">Apakah anda yakin untuk menyimpan Ekuivalensi Kurikulum dari (csv/xlsx)?
      </x-slot>
      <x-slot name="footer">
        <x-button.secondary
          onclick="
            document.getElementById('modalKonfirmasiUpload').removeAttribute('data-id');
            document.getElementById('modalKonfirmasiUpload').classList.add('hidden');
            document.getElementById('modalKonfirmasiUpload').classList.remove('flex');
          "
        >
          Tidak
        </x-button.secondary>
        <x-button.primary type="submit">Ya, Simpan</x-button.primary>
      </x-slot>
    </x-modal.container-pure-js>
  </form>
@endsection

