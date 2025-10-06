@extends('layouts.main')

@section('title', 'Kelompok Perwalian')

@section('breadcrumbs')
  <div class="breadcrumb-item">Beranda</div>
  <div class="breadcrumb-item active">Kelompok Perwalian</div>
@endsection

@section('css')

<style>
  .krs-section{ border-radius:14px; overflow:hidden; background:#fff; }
  .krs-head{ height:80px;border-radius:14px;display:flex; justify-content:space-between; align-items:center; padding:10px 12px; font-weight:700; }
  .grad-wait{ background:linear-gradient(90deg,#FFFFFF,#FEF3C0); }
  .grad-del{  background:linear-gradient(90deg,#FFFFFF,#99D8FF); }
  .grad-rej{  background:linear-gradient(90deg,#FFFFFF,#F7B6B8); }
  .grad-ok{   background:linear-gradient(90deg,#FFFFFF,#D0DE68); }

  .pill{ display:inline-flex; align-items:center; padding:6px 10px; border-radius:8px; font-size:12px; font-weight:600; }
  .pill-wait{ background:#FDE05D; color:black; }
  .pill-del{ background:#3B82F6; color:#FFFFFF; }
  .pill-ok{  background:#F7B6B8; color:black; }
  .pill-no{  background:#EF4444; color:black; }

  .chk {width: 18px;height: 18px;border-radius: 4px;border: 2px solid #9CA3AF;appearance: none;-webkit-appearance: none;outline: none;cursor: pointer;isplay: inline-flex;align-items: center;justify-content: center;background: #fff;}


  .chk:hover {border-color: #6B7280;}


  .chk:checked {background-color: #EF4444;border-color: #EF4444;color: #fff;content: "✓";
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M6.00016 10.2002L3.30016 7.50016L2.3335 8.46683L6.00016 12.1335L14.0002 4.1335L13.0335 3.16683L6.00016 10.2002Z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: center;
  background-size: 12px 12px;
}

  .btn{ display:inline-flex; align-items:center; gap:8px; border:1px solid transparent; border-radius:10px; padding:10px 14px; font-weight:600; font-size:13px; cursor:pointer; }
  .btn-approve{ background:#E62129; color:#fff; }
  .btn-reject{  background:#FFFFFF; color:#E62129; }
  .btn-plain{   background:#fff; color:#374151; border-color:#E5E7EB; }
  .krs-foot{ display:flex; gap:10px; padding:12px; border-top:1px solid #F1F5F9; flex-wrap:wrap; }
</style>
@endsection

@section('content')
<div class="page-header">
  <div class="page-title-text">Detail Kartu Studi Mahasiswa</div>
</div>

<div class="academics-layout">
  @include('tutelage.student-list.layout.navbar-tutelage', [
    "id" => $id
    ])

  <div class="academics-slicing-content content-card p-[10px]">

    {{-- === Tabel Data Mahasiswa === --}}
        <div class="page-title-text">
            Kartu Rencana Studi Mahasiswa
        </div>

        <div class="p-[10px]">
            <div class="overflow-hidden rounded-lg border border-[#E8E8E8]">
                <table class="min-w-full table-fixed text-sm text-[#262626]">
                    <tbody>
                    <tr class="h-[38px]">
                        <td class="w-[313.25px] bg-[#E8E8E8] px-6 py-3 font-normal">Nama Mahasiswa</td>
                        <td class="w-[752.75px] bg-[#F5F5F5] px-6 py-3 font-semibold">
                        {{ $student['nama'] ?? '-' }}
                        </td>
                    </tr>
                    <tr class="h-[38px]">
                        <td class="bg-[#F5F5F5] px-6 py-3 font-normal">Nomor Induk Mahasiswa</td>
                        <td class="bg-white px-6 py-3 font-semibold">
                        {{ $student['nim'] ?? '-' }}
                        </td>
                    </tr>
                    <tr class="h-[38px]">
                        <td class="bg-[#E8E8E8] px-6 py-3 font-normal">Status Pembayaran</td>
                        <td class="bg-[#F5F5F5] px-6 py-3 font-semibold">
                        @if(($student['status_bayar'] ?? '') === 'Sudah Membayar')
                            <span class="text-green-600 font-semibold">Sudah Membayar</span>
                        @else
                            <span class="text-red-600 font-semibold">Belum Membayar</span>
                        @endif
                        </td>
                    </tr>
                    <tr class="h-[38px]">
                        <td class="bg-[#F5F5F5] px-6 py-3 font-normal">Indeks Prestasi Kumulatif</td>
                        <td class="bg-white px-6 py-3 font-semibold">
                        {{ $student['ipk'] ?? '-' }}
                        </td>
                    </tr>
                    <tr class="h-[38px]">
                        <td class="bg-[#E8E8E8] px-6 py-3 font-normal">SKS yang diperbolehkan</td>
                        <td class="bg-[#F5F5F5] px-6 py-3 font-semibold">
                        {{ $student['sks_boleh'] ?? 0 }} SKS
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>




        {{-- === Section PERHATIAN === --}}
        <div class="px-[10px] mb-5">
            
            <div class="mt-4 rounded-lg border border-yellow-300 bg-yellow-50 p-4 text-sm leading-relaxed">
              <p class="font-semibold text-black-700">Perhatian!</p>

              <p>
                Mahasiswa kurang
                <span class="font-semibold">{{ $krsInfo['sisa_sks_kelulusan'] ?? 0 }} SKS</span>
                untuk memenuhi syarat kelulusan {{ $krsInfo['total_sks_kelulusan'] ?? 144 }} SKS.
              </p>
    
              <p class="mt-2">
                <span class="font-semibold">Abaikan rekomendasi di bawah ini</span>
                karena kurikulum belum disetujui Ketua Program Studi.
              </p>
    
              <div class="mt-3">
                <p class="font-semibold">Rekomendasi mata kuliah wajib harus diambil:</p>
                <ul class="list-disc pl-5">
                  @forelse($krsInfo['rekom_wajib'] ?? [] as $r)
                    <li>{{ $r }}</li>
                  @empty
                    <li>-</li>
                  @endforelse
                </ul>
              </div>
    
              <div class="mt-3">
                <p class="font-semibold">Rekomendasi mata kuliah mengulang:</p>
                <ul class="list-disc pl-5">
                  @forelse($krsInfo['rekom_ulang'] ?? [] as $r)
                    <li>{{ $r }}</li>
                  @empty
                    <li>-</li>
                  @endforelse
                </ul>
              </div>
            </div>
        </div>
        

        @php
        // helper pill
        function pill($txt,$type){
            $map=['wait'=>'pill-wait','del'=>'pill-del','ok'=>'pill-ok','no'=>'pill-no'];
            return '<span class="pill '.$map[$type].'">'.$txt.'</span>';
        }

        // ===== Dummy data sesuai gambar =====
        $tblPending = [
            ['no'=>1,'kelas'=>'Kerja Praktik - Ade Irawan - 2024 - I','mk'=>'52402 – Kerja Praktik','sks'=>2,'nilai'=>'-','prodi'=>'Tidak','presensi'=>'100%','uas'=>'OK','status'=>pill('Menunggu Persetujuan','wait')],
            ['no'=>2,'kelas'=>'Proyek Multidisiplin – CS7 – 2024','mk'=>'52401 – Proyek Multidisiplin','sks'=>3,'nilai'=>'-','prodi'=>'Tidak','presensi'=>'100%','uas'=>'OK','status'=>pill('Menunggu Persetujuan','wait')],
            ['no'=>3,'kelas'=>'Teori Bahasa dan Automata – CS2 – 2024','mk'=>'52401 – Teori Bahasa dan Automata','sks'=>3,'nilai'=>'-','prodi'=>'Tidak','presensi'=>'100%','uas'=>'OK','status'=>pill('Menunggu Persetujuan','wait')],
            ['no'=>4,'kelas'=>'Cipta Karsa – CS7 – 2024','mk'=>'52401 – Cipta Karsa','sks'=>2,'nilai'=>'-','prodi'=>'Tidak','presensi'=>'100%','uas'=>'OK','status'=>pill('Menunggu Persetujuan','wait')],
        ];
        $tblDeletion = [
            ['no'=>1,'kelas'=>'Pancasila – CS7 – 2024','mk'=>'52401 – Pancasila','sks'=>2,'nilai'=>'-','prodi'=>'Tidak','presensi'=>'100%','uas'=>'OK','status'=>pill('Mengajukan Penghapusan','del')],
        ];
        $tblRejected = []; // kosong
        $tblApproved = []; // kosong

        // kolom seragam
        $cols = ['No','Nama Kelas','Nama Mata Kuliah','SKS','Nilai','Prodi Lain','Presensi Kehadiran','Status UAS','Status'];
        @endphp

        {{-- ================= 1) MENUNGGU PERSETUJUAN ================= --}}
        <div class="krs-section mb-5 px-[10px]" data-section="pending">
            <div class="krs-head grad-wait">
                <div>Mata Kuliah [Menunggu Persetujuan]</div>
                <div class="flex gap-2">
                    <button class="btn btn-approve" data-action="approve" data-table="tblPending">Setujui</button>
                    <button class="btn btn-reject"  data-action="reject"  data-table="tblPending">Tolak Pengajuan</button>
                </div>
            </div>

            <x-table id="tblPending">
                <x-table-head>

                    <x-table-row>
                        <x-table-header class="w-[40px]">
                        <input type="checkbox" class="chk" data-select-all="tblPending">
                        </x-table-header>
                        @foreach($cols as $c)<x-table-header>{{ $c }}</x-table-header>@endforeach
                    </x-table-row>
                    
                </x-table-head>

                <x-table-body>

                    @forelse($tblPending as $r)
                        <x-table-row data-row='@json($r)'>
                        <x-table-cell><input type="checkbox" class="chk" data-row-check="tblPending"></x-table-cell>
                        <x-table-cell>{{ $r['no'] }}</x-table-cell>
                        <x-table-cell>{{ $r['kelas'] }}</x-table-cell>
                        <x-table-cell class="text-gray-600">{{ $r['mk'] }}</x-table-cell>
                        <x-table-cell>{{ $r['sks'] }}</x-table-cell>
                        <x-table-cell>{{ $r['nilai'] }}</x-table-cell>
                        <x-table-cell>{{ $r['prodi'] }}</x-table-cell>
                        <x-table-cell>{{ $r['presensi'] }}</x-table-cell>
                        <x-table-cell>{{ $r['uas'] }}</x-table-cell>
                        <x-table-cell>{!! $r['status'] !!}</x-table-cell>
                        </x-table-row>
                    @empty
                        <x-table-row><x-table-cell colspan="10" class="text-center text-gray-500">Belum Ada Data</x-table-cell></x-table-row>
                    @endforelse

                </x-table-body>
            </x-table>
        </div>

        {{-- ================= 2) MENGAJUKAN PENGHAPUSAN ================= --}}
        <div class="krs-section mb-5 px-[10px]" data-section="deletion">
        <div class="krs-head grad-del">
            <div>Mata Kuliah [Mengajukan Penghapusan]</div>
            <div class="flex gap-2">
            <button class="btn btn-approve" data-action="approveDel" data-table="tblDeletion">Setujui</button>
            <button class="btn btn-reject"  data-action="rejectDel"  data-table="tblDeletion">Tolak Penghapusan</button>
            </div>
        </div>

        <x-table id="tblDeletion">
            <x-table-head>
            <x-table-row>
                <x-table-header class="w-[40px]"><input type="checkbox" class="chk" data-select-all="tblDeletion"></x-table-header>
                @foreach($cols as $c)<x-table-header>{{ $c }}</x-table-header>@endforeach
            </x-table-row>
            </x-table-head>
            <x-table-body>
            @forelse($tblDeletion as $r)
                <x-table-row data-row='@json($r)'>
                <x-table-cell><input type="checkbox" class="chk" data-row-check="tblDeletion"></x-table-cell>
                <x-table-cell>{{ $r['no'] }}</x-table-cell>
                <x-table-cell>{{ $r['kelas'] }}</x-table-cell>
                <x-table-cell class="text-gray-600">{{ $r['mk'] }}</x-table-cell>
                <x-table-cell>{{ $r['sks'] }}</x-table-cell>
                <x-table-cell>{{ $r['nilai'] }}</x-table-cell>
                <x-table-cell>{{ $r['prodi'] }}</x-table-cell>
                <x-table-cell>{{ $r['presensi'] }}</x-table-cell>
                <x-table-cell>{{ $r['uas'] }}</x-table-cell>
                <x-table-cell>{!! $r['status'] !!}</x-table-cell>
                </x-table-row>
            @empty
                <x-table-row><x-table-cell colspan="10" class="text-center text-gray-500">Belum Ada Data</x-table-cell></x-table-row>
            @endforelse
            </x-table-body>
        </x-table>
        </div>

        {{-- ================= 3) DITOLAK ================= --}}
        <div class="krs-section mb-5 px-[10px]" data-section="rejected">
        <div class="krs-head grad-rej">
            <div>Mata Kuliah [Ditolak]</div>
            <div class="flex gap-2">
            <button class="btn btn-plain" data-action="cancelReject" data-table="tblRejected">Batalkan Penolakan</button>
            </div>
        </div>

        <x-table id="tblRejected">
            <x-table-head>
            <x-table-row>
                <x-table-header class="w-[40px]"><input type="checkbox" class="chk" data-select-all="tblRejected"></x-table-header>
                @foreach($cols as $c)<x-table-header>{{ $c }}</x-table-header>@endforeach
            </x-table-row>
            </x-table-head>
            <x-table-body>
            @forelse($tblRejected as $r)
                <x-table-row data-row='@json($r)'>
                <x-table-cell><input type="checkbox" class="chk" data-row-check="tblRejected"></x-table-cell>
                <x-table-cell>{{ $r['no'] }}</x-table-cell>
                <x-table-cell>{{ $r['kelas'] }}</x-table-cell>
                <x-table-cell class="text-gray-600">{{ $r['mk'] }}</x-table-cell>
                <x-table-cell>{{ $r['sks'] }}</x-table-cell>
                <x-table-cell>{{ $r['nilai'] }}</x-table-cell>
                <x-table-cell>{{ $r['prodi'] }}</x-table-cell>
                <x-table-cell>{{ $r['presensi'] }}</x-table-cell>
                <x-table-cell>{{ $r['uas'] }}</x-table-cell>
                <x-table-cell>{!! $r['status'] !!}</x-table-cell>
                </x-table-row>
            @empty
                <x-table-row><x-table-cell colspan="10" class="text-center text-gray-500">Belum Ada Data</x-table-cell></x-table-row>
            @endforelse
            </x-table-body>
        </x-table>
        </div>

        {{-- ================= 4) DISETUJUI ================= --}}
        <div class="krs-section px-[10px]" data-section="approved">
        <div class="krs-head grad-ok">
            <div>Mata Kuliah [Disetujui]</div>
            <div class="flex gap-2">
            <button class="btn btn-approve" data-action="revokeApprove" data-table="tblApproved">Tolak Persetujuan</button>
            </div>
        </div>

        <x-table id="tblApproved">
            <x-table-head>
            <x-table-row>
                <x-table-header class="w-[40px]"><input type="checkbox" class="chk" data-select-all="tblApproved"></x-table-header>
                @foreach($cols as $c)<x-table-header>{{ $c }}</x-table-header>@endforeach
            </x-table-row>
            </x-table-head>
            <x-table-body>
            @forelse($tblApproved as $r)
                <x-table-row data-row='@json($r)'>
                <x-table-cell><input type="checkbox" class="chk" data-row-check="tblApproved"></x-table-cell>
                <x-table-cell>{{ $r['no'] }}</x-table-cell>
                <x-table-cell>{{ $r['kelas'] }}</x-table-cell>
                <x-table-cell class="text-gray-600">{{ $r['mk'] }}</x-table-cell>
                <x-table-cell>{{ $r['sks'] }}</x-table-cell>
                <x-table-cell>{{ $r['nilai'] }}</x-table-cell>
                <x-table-cell>{{ $r['prodi'] }}</x-table-cell>
                <x-table-cell>{{ $r['presensi'] }}</x-table-cell>
                <x-table-cell>{{ $r['uas'] }}</x-table-cell>
                <x-table-cell>{!! $r['status'] !!}</x-table-cell>
                </x-table-row>
            @empty
                <x-table-row><x-table-cell colspan="10" class="text-center text-gray-500">Belum Ada Data</x-table-cell></x-table-row>
            @endforelse
            </x-table-body>
        </x-table>
        </div>


    
    </div>
  </div>
</div>
@endsection
