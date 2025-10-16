@extends('layouts.main')

@section('title', 'Upload Mata Kuliah')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Upload Mata Kuliah</div>
@endsection

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
            <x-button.link href="{{ route('academics-event.template', ['type' => 'xlsx']) }}">Download Sample Data (.xlsx)</x-button.link>
            <x-button.link href="{{ route('academics-event.template', ['type' => 'csv']) }}">Download Sample Data (.csv)</x-button.link>
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
        File yang diterima adalah file .csv dengan pemisah antar kolom berupa titik koma ","<br>
        Urutan kolom sebagai berikut:
      </div>
      <ul>
        <li class="text-[#E62129]">kode: kode mata kuliah*)</li>
        <li class="text-[#E62129]">nama: nama mata kuliah *)</li>
        <li class="text-[#E62129]">sks: jumlah sks mata kuliah *)</li>
        <li class="text-[#E62129]">semester: semester mata kuliah *)</li>
        <li class="text-[#E62129]">tujuan: tujuan mata kuliah</li>
        <li class="text-[#E62129]">deskripsi: deskripsi singkat mata kuliah</li>
        <li class="text-[#E62129]">jenis: jenis mata kuliah, pilih salah satu dari Mata Kuliah Dasar Teknik, Mata Kuliah Dasar Umum, Mata Kuliah Program Studi, Mata Kuliah Sains Dasar, Mata Kuliah Universitas Pertamina*)</li>
        <li class="text-[#E62129]">koordinator: NIP Dosen koordinator</li>
        <li class="text-[#E62129]">spesial: y/n, y jika mata kuliah spesial, n jika tidak *)</li>
        <li class="text-[#E62129]">dibuka: y/n, y jika mata kuliah dibuka untuk prodi lain, n jika tidak *)</li>
        <li class="text-[#E62129]">wajib: y/n, y jika mata kuliah wajib, n jika tidak *)</li>
        <li class="text-[#E62129]">mbkm: y/n, y jika mata kuliah MBKM, n jika tidak *)</li>
        <li class="text-[#E62129]">aktif: y/n, y jika mata kuliah aktif, n jika tidak *)</li>
        <li class="text-[#E62129]">prasyarat mata kuliah: kode mata kuliah prasyarat</li>
        <li class="text-[#E62129]">namasingkat: nama singkat atau akronim mata kuliah *)</li>
        <li class="text-[#E62129]">*) regured, ika ma kliai nsongi, ika ad ulang akan menganti data sebelumnya, prasyarat mata kuliah hanya 1</li>
      </ul>
      <div>
        kode; nama; sks; semester; tujuan; deskripsi; jenis; koordinator; spesial; dibuka; wajib; mbkm; aktif;
        prasyarat; namasingkat<br>
        UP001; Kalkulus; 3; 1; '', ', Mata Kuliah Dasar Umum; 116020; n; y; y; n; у; "*; K; у<br>
        UP002; Kimia Dasar 2; 2; 1; *', * Mata Kuliah Dasar Umum; 116024; n; y; y; n; y; UP003-UP321; KD2; y<br>
      </div>
      <div>
        <span>Jumlah Data : 0</span><br>
        <span>Jumlah Data Sukses: 0</span><br>
        <span>Jumlah Data Gagal:</span>
      </div>
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
