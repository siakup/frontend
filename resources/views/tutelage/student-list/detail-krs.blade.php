@extends('layouts.main')

@section('title', 'Kelompok Perwalian')

@section('breadcrumbs')
    <div class="breadcrumb-item">Beranda</div>
    <div class="breadcrumb-item active">Kelompok Perwalian</div>
@endsection

@section('css')
    <style>
        .krs-section{ border-radius:14px; overflow:hidden; background:#fff; }
        .krs-head{ height:80px;border-radius: 14px 14px 0 0 ;display:flex; justify-content:space-between; align-items:center; padding:10px 12px; font-weight:700; }
        .grad-wait{ background:linear-gradient(90deg,#FFFFFF,#FEF3C0); }
        .grad-del{  background:linear-gradient(90deg,#FFFFFF,#99D8FF); }
        .grad-rej{  background:linear-gradient(90deg,#FFFFFF,#F7B6B8); }
        .grad-ok{   background:linear-gradient(90deg,#FFFFFF,#D0DE68); }

        .pill{ display:inline-flex; align-items:center; padding:6px 10px; border-radius:8px; font-size:12px; font-weight:600; }
        .pill-wait{ background:#FDE05D; color:black; }
        .pill-del{ background:#3B82F6; color:#FFFFFF; }
        .pill-ok{  background:#F7B6B8; color:black; }
        .pill-no{  background:#EF4444; color:black; }

        .chk {width: 18px;height: 18px;border-radius: 4px;border: 2px solid #9CA3AF;appearance: none;-webkit-appearance: none;outline: none;cursor: pointer;background: #fff;}
        .chk:hover {border-color: #6B7280;}
        .chk:checked {
            background-color: #EF4444;border-color: #EF4444;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M6.00016 10.2002L3.30016 7.50016L2.3335 8.46683L6.00016 12.1335L14.0002 4.1335L13.0335 3.16683L6.00016 10.2002Z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;background-position: center;background-size: 12px 12px;
        }

        .btn{ display:inline-flex; align-items:center; gap:8px; border:1px solid transparent; border-radius:10px; padding:10px 14px; font-weight:600; font-size:13px; cursor:pointer; }
        .btn-approve{ background:#E62129; color:#fff; }
        .btn-reject{  background:#FFFFFF; color:#E62129; }
        .btn-plain{   background:#fff; color:#374151; border-color:#E5E7EB; }
    </style>
@endsection

@section('content')
    <div class="page-header">
        <div class="page-title-text">Detail Kartu Studi Mahasiswa</div>
    </div>

    <div class="academics-layout">
        @include('tutelage.student-list.layout.navbar-tutelage')

        <div class="academics-slicing-content content-card p-[10px]" style="border-top-left-radius: 0">

            {{-- === Data Mahasiswa === --}}
            <div class="page-title-text">Kartu Rencana Studi Mahasiswa</div>
            <div class="p-[10px]">
                <div class="overflow-hidden rounded-lg border border-[#E8E8E8]">
                    <table class="min-w-full table-fixed text-sm text-[#262626]">
                        <tbody>
                        <tr class="h-[38px]">
                            <td class="w-[313px] bg-[#E8E8E8] px-6 py-3">Nama Mahasiswa</td>
                            <td class="bg-[#F5F5F5] px-6 py-3 font-semibold">{{ $student['nama'] }}</td>
                        </tr>
                        <tr class="h-[38px]">
                            <td class="bg-[#F5F5F5] px-6 py-3">Nomor Induk Mahasiswa</td>
                            <td class="bg-white px-6 py-3 font-semibold">{{ $student['nim'] }}</td>
                        </tr>
                        <tr class="h-[38px]">
                            <td class="bg-[#E8E8E8] px-6 py-3">Status Pembayaran</td>
                            <td class="bg-[#F5F5F5] px-6 py-3 font-semibold">
                                @if($student['status_bayar'] === 'Sudah Membayar')
                                    <span class="text-green-600">Sudah Membayar</span>
                                @else
                                    <span class="text-red-600">Belum Membayar</span>
                                @endif
                            </td>
                        </tr>
                        <tr class="h-[38px]">
                            <td class="bg-[#F5F5F5] px-6 py-3">Indeks Prestasi Kumulatif</td>
                            <td class="bg-white px-6 py-3 font-semibold">{{ $student['ipk'] }}</td>
                        </tr>
                        <tr class="h-[38px]">
                            <td class="bg-[#E8E8E8] px-6 py-3">SKS yang diperbolehkan</td>
                            <td class="bg-[#F5F5F5] px-6 py-3 font-semibold">{{ $student['sks_boleh'] }} SKS</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- === Info KRS === --}}
            <div class="px-[10px] mb-5">
                <div class="mt-4 rounded-lg border border-yellow-300 bg-yellow-50 p-4 text-sm leading-relaxed flex items-center gap-3">
                    {{-- Icon di kiri --}}
                    <img src="{{ asset('assets/icon-caution-warning.svg') }}" alt="caution" class="w-6 h-6 mt-0.5"/>

                    {{-- Konten teks di kanan --}}
                    <div class="flex-1">
                        <x-typography variant="body-medium-bold">Perhatian!</x-typography>
                        <br>
                        <x-typography>
                            Mahasiswa kurang
                            <b>{{ $krsInfo['sisa_sks_kelulusan'] }}</b> SKS untuk lulus
                            {{ $krsInfo['total_sks_kelulusan'] }} SKS.
                        </x-typography>

                        <div class="mt-3">
                            <x-typography variant="body-medium-bold">Rekomendasi wajib:</x-typography>
                            <ul class="list-disc pl-5">
                                @foreach($krsInfo['rekom_wajib'] as $r)
                                    <li>{{ $r }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mt-3">
                            <x-typography variant="body-medium-bold">Rekomendasi ulang:</x-typography>
                            <ul class="list-disc pl-5">
                                @foreach($krsInfo['rekom_ulang'] as $r)
                                    <li>{{ $r }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- === Section Tables === --}}
            @php
                $sections = [
                  'pending'  => ['title'=>'Menunggu Persetujuan','grad'=>'grad-wait','btns'=>['approve'=>'Setujui','reject'=>'Tolak Pengajuan']],
                  'deletion' => ['title'=>'Mengajukan Penghapusan','grad'=>'grad-del','btns'=>['approveDel'=>'Setujui','rejectDel'=>'Tolak Penghapusan']],
                  'rejected' => ['title'=>'Ditolak','grad'=>'grad-rej','btns'=>['cancelReject'=>'Batalkan Penolakan']],
                  'approved' => ['title'=>'Disetujui','grad'=>'grad-ok','btns'=>['revokeApprove'=>'Tolak Persetujuan']],
                ];
                $tables = [
                  'pending'=>$tblPending,
                  'deletion'=>$tblDeletion,
                  'rejected'=>$tblRejected,
                  'approved'=>$tblApproved,
                ];
            @endphp

            @foreach($sections as $key=>$sec)
                <div class="krs-section mb-5 px-[10px]">
                    <div class="krs-head border border-[#d9d9d9] {{ $sec['grad'] }}">
                        <div>Mata Kuliah [{{ $sec['title'] }}]</div>
                        <div class="flex gap-2">
                            @foreach($sec['btns'] as $action => $label)
                                @php
                                    $isApprove = str_contains($action, 'approve');
                                    $isReject  = str_contains($action, 'reject');
                                @endphp

                                @if ($isApprove)
                                    <x-button.primary
                                        data-action="{{ $action }}"
                                        data-table="tbl{{ ucfirst($key) }}"
                                    >
                                        {{ $label }}
                                    </x-button.primary>
                                @elseif ($isReject)
                                    <x-button.secondary
                                        data-action="{{ $action }}"
                                        data-table="tbl{{ ucfirst($key) }}"
                                    >
                                        {{ $label }}
                                    </x-button.secondary>
                                @else
                                    <x-button.secondary
                                        data-action="{{ $action }}"
                                        data-table="tbl{{ ucfirst($key) }}"
                                    >
                                        {{ $label }}
                                    </x-button.secondary>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <x-table id="tbl{{ ucfirst($key) }}" style="border-top-left-radius: 0; border-top-right-radius: 0">
                        <x-table-head>
                            <x-table-row>
                                <x-table-header class="w-[40px]"><input type="checkbox" class="chk" data-select-all="tbl{{ ucfirst($key) }}"></x-table-header>
                                @foreach($cols as $c)<x-table-header>{{ $c }}</x-table-header>@endforeach
                            </x-table-row>
                        </x-table-head>
                        <x-table-body>
                            @forelse($tables[$key] as $r)
                                <x-table-row>
                                    <x-table-cell><input type="checkbox" class="chk" data-row-check="tbl{{ ucfirst($key) }}"></x-table-cell>
                                    <x-table-cell>{{ $r['no'] }}</x-table-cell>
                                    <x-table-cell>{{ $r['kelas'] }}</x-table-cell>
                                    <x-table-cell>{{ $r['mk'] }}</x-table-cell>
                                    <x-table-cell>{{ $r['sks'] }}</x-table-cell>
                                    <x-table-cell>{{ $r['nilai'] }}</x-table-cell>
                                    <x-table-cell>{{ $r['prodi'] }}</x-table-cell>
                                    <x-table-cell>{{ $r['presensi'] }}</x-table-cell>
                                    <x-table-cell>{{ $r['uas'] }}</x-table-cell>
                                    <x-table-cell>{!! $r['status_label'] !!}</x-table-cell>
                                </x-table-row>
                            @empty
                                <x-table-row><x-table-cell colspan="10" class="text-center text-gray-500">Belum Ada Data</x-table-cell></x-table-row>
                            @endforelse
                        </x-table-body>
                    </x-table>
                </div>
            @endforeach

            <div class="border p-5 mx-[10px] my-5 rounded-lg border-[#D9D9D9]">
                <x-button.primary
                    href="{{ route('tutelage-group.student-list.detail-krs.add-course',['id'=>1]) }}"
                    class="w-full"
                    iconPosition="right"
                    icon="{{ asset('assets/icon-plus-white.svg') }}"
                >
                    Tambah Kelas Mata Kuliah
                </x-button.primary>
            </div>

        </div>
    </div>
@endsection
