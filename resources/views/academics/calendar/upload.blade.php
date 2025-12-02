@extends('layouts.main')

@section('title', 'Upload Mata Kuliah')

@include('partials.success-notification-modal', ['route' => route('calendar.upload', ['id' => $id])])
@section('content')
  <x-container.container :variant="'content-wrapper'">
    <x-typography :variant="'body-large-semibold'">Unggah Event</x-typography>
    <x-button.back :href="route('calendar.show', ['id' => $id])">View Event Kalender Akademik</x-button.back>
    <x-container.container :class="'flex flex-col items-start gap-2.5 self-stretch'">
      <x-container.container :variant="'content-wrapper'" class="flex flex-row items-center justify-start !px-0">
        <x-typography :variant="'body-medium-bold'">Impor Event Kalender Akademik</x-typography>
        <x-icon :iconUrl="asset('assets/icon-caution.svg')" :class="'w-auto h-[1.5em]'" />
      </x-container>
      <x-container.container :variant="'content-wrapper'" class="flex flex-row gap-10 justify-between !px-0">
          <x-container.container :variant="'content-wrapper'" class="basis-[35%] shrink-0 grow-0 min-w-1/5 max-w-[35%] flex flex-col !gap-1 !px-0">
            <x-typography>Allowed Type: [.xlsx, .xls, .csv]</x-typography>  
            <x-button.link href="{{ route('calendar.template', ['id' => $id,'type' => 'xlsx', 'program_studi' => $id_prodi, 'program_perkuliahan' => $id_program]) }}">Download Sample Data (.xlsx)</x-button.link>
            <x-button.link href="{{ route('calendar.template', ['id' => $id,'type' => 'csv', 'program_studi' => $id_prodi, 'program_perkuliahan' => $id_program]) }}">Download Sample Data (.csv)</x-button.link>
          </x-container>
          <x-container.container :variant="'content-wrapper'" class="grow-1 shrink-1 basis-0 min-w-3/4 flex flex-col !gap-4 relative items-start w-full !px-0">
            <x-typography :variant="'body-medium-regular'">Impor CSV Event Akademik File</x-typography>
            <form action="{{ route('calendar.send', ['id' => $id]) }}" method="POST" enctype="multipart/form-data" id="uploadForm">
              @csrf
              <x-form.file :cancelConfirmationModalButtonId="'modalKonfirmasiBatal'" />
            </form>
          </x-container>
      </x-container>
      <x-container.container class="my-0 mx-auto flex flex-col p-5 !gap-2.5 bg-[#FAFAFA]">
        <x-typography :variant="'body-small-regular'">
          File yang diterima adalah file .csv dengan pemisah antar kolom berupa titik koma "," atau file .xlsx<br>
          Urutan kolom sebagai berikut:
        </x-typography>
        <ul>
          <li class="text-[#E62129]">
            <x-typography :variant="'body-small-bold'">Program Perkuliahan</x-typography>
            <x-typography :variant="'body-small-regular'">: jenis program perkuliahan (pilih salah satu) *)</x-typography>
          </li>
          <li class="text-[#E62129]">
            <x-typography :variant="'body-small-bold'">Program Studi</x-typography>
            <x-typography :variant="'body-small-regular'">: nama program studi (pilih berdasarkan program studi yang tercantum pada template) *)</x-typography>
          </li>
          <li class="text-[#E62129]">
            <x-typography :variant="'body-small-bold'">Nama Event</x-typography>
            <x-typography :variant="'body-small-regular'">: nama event yang ditambahkan ke kalender akademik (hapus baris pada suatu nama event yang ada pada template jika tidak sesuai)  *)</x-typography>
          </li>
          <li class="text-[#E62129]">
            <x-typography :variant="'body-small-bold'">Tanggal Mulai</x-typography>
            <x-typography :variant="'body-small-regular'">: tanggal mulai suatu event pada kalender akademik (isi sesuai format yyyy-mm-dd hh:mm:ss dengan yyyy adalah tahun dengan 4 digit, mm dengan nomor bulan dengan 2 digit (jika satuan, tambahkan 0 didepannya), dd dengan tanggal (jika satuan, tambahkan 0 didepannya), hh dengan jam (jika satuan, tambahkan 0 didepannya), mm dengan menit (jika satuan tambahkan 0 didepannya), ss dengan detik (jika satuan, tambahkan 0 didepannya), ) *)</x-typography>
          </li>
          <li class="text-[#E62129]">
            <x-typography :variant="'body-small-bold'">Tanggal Selesai</x-typography>
            <x-typography :variant="'body-small-regular'">: tanggal mulai suatu event pada kalender akademik (isi sesuai format yyyy-mm-dd hh:mm:ss dengan yyyy adalah tahun dengan 4 digit, mm dengan nomor bulan dengan 2 digit (jika satuan, tambahkan 0 didepannya), dd dengan tanggal (jika satuan, tambahkan 0 didepannya), hh dengan jam (jika satuan, tambahkan 0 didepannya), mm dengan menit (jika satuan tambahkan 0 didepannya), ss dengan detik (jika satuan, tambahkan 0 didepannya), ) *)</x-typography>
          </li>
          
          <li class="text-[#E62129]">
            <br> 
            <x-typography :variant="'body-small-regular'">*) data perlu diisi, jika tidak diisi salah satu kolom pada baris, data dianggap tidak valid dan data pada baris bersangkutan tidak akan tersimpan</x-typography>
          </li>
        </ul>
      </x-container>
    </x-container>
  </x-container>
  <x-modal.container-pure-js id="modalKonfirmasiBatal">
    <x-slot name="header">
      <x-container.container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
        <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Batalkan Data Impor Event Kalender Akademik (CSV/xlsx)</x-typography>
        <x-icon :iconUrl="asset('assets/icon-caution.svg')" :class="'w-8 h-8'" />
      </x-container>
    </x-slot>
    <x-slot name="body">Apakah Anda yakin ingin membatalkan unggah Event Kalender Akademik?</x-slot>
    <x-slot name="footer">
      <x-button.secondary
        onclick="
          document.getElementById('modalKonfirmasiBatal').classList.add('hidden');
          document.getElementById('modalKonfirmasiBatal').classList.remove('flex');
        "
      >
        Kembali
      </x-button.secondary>
      <x-button.primary :href="route('calendar.show', ['id' => $id])">Batalkan</x-button.primary>
    </x-slot>
  </x-modal.container-pure-js>
@endsection
