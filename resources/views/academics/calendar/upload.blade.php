@extends('layouts.main')

@section('title', 'Upload Mata Kuliah')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Upload Mata Kuliah</div>
@endsection

@include('partials.success-notification-modal', ['route' => route('calendar.upload', ['id' => $id])])
@section('content')
  <x-title-page :title="'Unggah Event'" />
  <x-button.back :href="route('calendar.show', ['id' => $id])">View Event Kalender Akademik</x-button.back>
  <x-white-box :class="'p-4 flex flex-col items-start gap-2.5 self-stretch'">
    <div class="flex items-center justify-center">
      <x-title-page :title="'Impor Event Kalender Akademik'" />
      <img src="{{ asset('assets/base/icon-caution.svg')}}" alt="caution-icon" class="h-[1.5em] w-auto">
    </div>
    <div class="flex gap-10 justify-between px-5">
        <div class="basis-[35%] shrink-0 grow-0 min-w-1/5 max-w-[35%] flex flex-col gap-1">
            <div>
                Allowed Type: [.xlsx, .xls, .csv]
            </div>
            <x-button.link href="{{ route('calendar.template', ['id' => $id,'type' => 'xlsx', 'program_studi' => $id_prodi, 'program_perkuliahan' => $id_program]) }}">Download Sample Data (.xlsx)</x-button.link>
            <x-button.link href="{{ route('calendar.template', ['id' => $id,'type' => 'csv', 'program_studi' => $id_prodi, 'program_perkuliahan' => $id_program]) }}">Download Sample Data (.csv)</x-button.link>
        </div>
        <div class="grow-1 shrink-1 basis-0 min-w-3/4 flex flex-col gap-4 relative items-start w-full">
            <div class="font-medium w-full">Impor CSV Event Akademik File</div>
            <form action="{{ route('calendar.send', ['id' => $id]) }}" method="POST" enctype="multipart/form-data" id="uploadForm">
              @csrf
              <x-form.file :cancelConfirmationModalButtonId="'modalKonfirmasiBatal'" />
            </form>
        </div>
    </div>
    <div class="my-0 mx-auto flex flex-col p-5 max-w-96/100 w-full gap-2.5 rounded-xl border-[1px] border-[#D9D9D9] bg-[#FAFAFA]">
      <div>
        File yang diterima adalah file .csv dengan pemisah antar kolom berupa titik koma "," atau file .xlsx<br>
        Urutan kolom sebagai berikut:
      </div>
      <ul>
        <li class="text-[#E62129]"><span class="font-bold">Program Perkuliahan</span>: jenis program perkuliahan (pilih salah satu) *)</li>
        <li class="text-[#E62129]"><span class="font-bold">Program Studi</span>: nama program studi (pilih berdasarkan program studi yang tercantum pada template) *)</li>
        <li class="text-[#E62129]"><span class="font-bold">Nama Event</span>: nama event yang ditambahkan ke kalender akademik (hapus baris pada suatu nama event yang ada pada template jika tidak sesuai)  *)</li>
        <li class="text-[#E62129]"><span class="font-bold">Tanggal Mulai</span>: tanggal mulai suatu event pada kalender akademik (isi sesuai format yyyy-mm-dd hh:mm:ss dengan yyyy adalah tahun dengan 4 digit, mm dengan nomor bulan dengan 2 digit (jika satuan, tambahkan 0 didepannya), dd dengan tanggal (jika satuan, tambahkan 0 didepannya), hh dengan jam (jika satuan, tambahkan 0 didepannya), mm dengan menit (jika satuan tambahkan 0 didepannya), ss dengan detik (jika satuan, tambahkan 0 didepannya), ) *)</li>
        <li class="text-[#E62129]"><span class="font-bold">Tanggal Selesai</span>: tanggal mulai suatu event pada kalender akademik (isi sesuai format yyyy-mm-dd hh:mm:ss dengan yyyy adalah tahun dengan 4 digit, mm dengan nomor bulan dengan 2 digit (jika satuan, tambahkan 0 didepannya), dd dengan tanggal (jika satuan, tambahkan 0 didepannya), hh dengan jam (jika satuan, tambahkan 0 didepannya), mm dengan menit (jika satuan tambahkan 0 didepannya), ss dengan detik (jika satuan, tambahkan 0 didepannya), ) *)</li>
        
        <li class="text-[#E62129]"><br> *) data perlu diisi, jika tidak diisi salah satu kolom pada baris, data dianggap tidak valid dan data pada baris bersangkutan tidak akan tersimpan</li>
      </ul>
    </div>
    <x-modal.container-pure-js id="modalKonfirmasiBatal">
      <x-slot name="header">
        <span class="text-xl font-bold leading-7">Batalkan Data Impor Event Kalender Akademik (CSV/xlsx)</span>
        <img src="{{ asset('assets/icon-caution.svg')}}" alt="icon-caution">
      </x-slot>
      <x-slot name="body">
        <div>Apakah Anda yakin ingin membatalkan unggah Event Kalender Akademik?</div>
      </x-slot>
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
  </x-white-box>
@endsection
