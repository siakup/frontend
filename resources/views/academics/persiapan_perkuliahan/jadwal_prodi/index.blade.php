resources/views/layouts/main.blade.php

@extends('layouts.main')

@section('title', 'Jadwal Kuliah Program Studi')

@section('breadcrumbs')
  <div class="breadcrumb-item">Beranda</div>
  <div class="breadcrumb-item active">Jadwal Kuliah</div>
@endsection

@section('css')
<style>
  .card-header.option-list{ justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; }
  .sub-title{ padding:10px 20px !important; }
  .filter-group{ display:flex; align-items:center; gap:10px; }
  .button-clean{ display:inline-flex; align-items:center; gap:8px; padding:8px 12px; border:1px solid #E5E7EB; border-radius:8px; background:#fff; }
  .sort-dropdown{ position:absolute; z-index:30; display:none; min-width:220px; background:#fff; border:1px solid #E5E7EB; border-radius:10px; box-shadow:0 10px 30px rgba(0,0,0,.06); }
  .sort-dropdown .dropdown-item{ padding:10px 14px; cursor:pointer; }
  .sort-dropdown .dropdown-item:hover{ background:#F8FAFC; }
  .CampusWrap, .StudyWrap{ position:relative; }
  .sort-dropdown.campus{ top:48px; left:0; }
  .sort-dropdown.study{  top:48px; left:0; }
  .searchbox{ position:relative; }
  .searchbox input{ padding-left:36px; }
  .searchbox img{ position:absolute; left:10px; top:10px; }
  .action-right{ display:flex; gap:8px; align-items:center; }
  .btn-icon{ display:inline-flex; align-items:center; gap:6px; font-size:12px; text-decoration:none; }
  .btn-view{ color:#262626; }
  .btn-edit{ color:#E62129; }
  .btn-delete{ color:#8C8C8C; }
  .footerbar{ display:flex; gap:12px; justify-content:space-between; align-items:center; flex-wrap:wrap; }
</style>
@endsection

@section('javascript')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const campusBtn   = document.querySelector('#sortButtonCampus');
  const campusDrop  = document.querySelector('#sortDropdownCampus');
  const studyBtn    = document.querySelector('#sortButtonStudy');
  const studyDrop   = document.querySelector('#sortDropdownStudy');

  // toggle dropdowns
  campusBtn?.addEventListener('click', function(e){
    e.stopPropagation();
    campusDrop.style.display = campusDrop.style.display==='block' ? 'none' : 'block';
    studyDrop.style.display = 'none';
    toggleArrow(this);
  });
  studyBtn?.addEventListener('click', function(e){
    e.stopPropagation();
    studyDrop.style.display = studyDrop.style.display==='block' ? 'none' : 'block';
    campusDrop.style.display = 'none';
    toggleArrow(this);
  });

  // choose items
  campusDrop?.querySelectorAll('.dropdown-item').forEach(el=>{
    el.addEventListener('click', function(){
      const url = new URL(window.location.href);
      url.searchParams.set('program_perkuliahan', this.dataset.sort);
      url.searchParams.set('page', 1);
      window.location.href = url.toString();
    });
  });
  studyDrop?.querySelectorAll('.dropdown-item').forEach(el=>{
    el.addEventListener('click', function(){
      const url = new URL(window.location.href);
      url.searchParams.set('program_studi', this.dataset.sort);
      url.searchParams.set('page', 1);
      window.location.href = url.toString();
    });
  });

  // close on outside click
  document.addEventListener('click', (e)=>{
    if(!e.target.closest('.CampusWrap')) { campusDrop.style.display='none'; resetArrow(campusBtn); }
    if(!e.target.closest('.StudyWrap'))  { studyDrop.style.display='none';  resetArrow(studyBtn);  }
  });

  // search
  document.querySelector('#btnSearch')?.addEventListener('click', function(){
    const q = document.querySelector('#q').value || '';
    const url = new URL(window.location.href);
    if(q) url.searchParams.set('q', q); else url.searchParams.delete('q');
    url.searchParams.set('page', 1);
    window.location.href = url.toString();
  });

  // sort popover (dummy — tinggal kirim query sort)
  document.querySelector('#btnSort')?.addEventListener('click', function(){
    const url = new URL(window.location.href);
    // contoh: sort=matkul_asc
    url.searchParams.set('sort', 'matkul_asc');
    window.location.href = url.toString();
  });

  function toggleArrow(btn){
    const img = btn.querySelector('img');
    if(!img) return;
    img.src = img.src.includes('icon-arrow-up.svg')
      ? "{{ asset('assets/active/icon-arrow-down.svg') }}"
      : "{{ asset('assets/active/icon-arrow-up.svg') }}";
  }
  function resetArrow(btn){
    const img = btn?.querySelector('img');
    if(img) img.src = "{{ asset('assets/active/icon-arrow-down.svg') }}";
  }
});
</script>
@endsection

@section('content')
<div class="page-header">
  <div class="page-title-text">Jadwal Kuliah</div>
</div>

<div class="academics-layout">
  {{-- jika ada navbar khusus, bisa include di sini --}}
  @include('academics.persiapan_perkuliahan.jadwal_prodi.navbar-jadwal-prodi')
  <div class="academics-slicing-content content-card">


    {{-- JUDUL --}}

    <x-typography variant="heading-h6" class="mb-2 p-[20px]">
      Jadwal Kuliah Program Studi
    </x-typography>

    {{-- FILTER BAR --}}
    <div class="card-header option-list">
      <div class="filter-group CampusWrap">
        <div class="page-title-text sub-title">Program Perkuliahan</div>
        
      </div>

      <div class="filter-group StudyWrap">
        <div class="page-title-text sub-title">Program Studi</div>
        <button class="button-clean" id="sortButtonStudy">
          <span>
            @php
              $labelProdi = '';
              foreach (($programStudiList ?? []) as $ps) { if((int)$ps->id === (int)$id_prodi){ $labelProdi = $ps->nama; break; } }
            @endphp
            {{ $labelProdi }}
          </span>
          <img src="{{ asset('assets/active/icon-arrow-down.svg') }}" alt="Filter">
        </button>
        <div class="sort-dropdown study" id="sortDropdownStudy">
          @foreach($programStudiList ?? [] as $ps)
            <div class="dropdown-item" data-sort="{{ $ps->id }}">{{ $ps->nama }}</div>
          @endforeach
        </div>
      </div>

      {{-- Search + Urutkan + Actions --}}
      <div class="action-right" style="margin-left:auto;">
        <div class="searchbox">
          <img src="{{ asset('assets/icon-search.svg') }}" width="18" />
          <input id="q" type="text" class="input" placeholder="Nama Pengajar / Nama Mata Kuliah / Hari" value="{{ $q ?? '' }}">
        </div>
        <a href="javascript:void(0)" class="button button-outline" id="btnSearch">Cari</a>

        <a href="javascript:void(0)" class="button-clean" id="btnSort">
          <span>Urutkan</span>
          <img src="{{ asset('assets/active/icon-arrow-down.svg') }}" alt="Sort">
        </a>

        <form method="POST" action="{{ route('academics.persiapan-perkuliahan.jadwal-prodi.import-fet1') }}" enctype="multipart/form-data">
          @csrf
          <label class="button-clean" style="cursor:pointer;">
            <span>Impor File FET_1</span>
            <img src="{{ asset('assets/icon-upload-red-500.svg') }}" alt="Impor">
            <input type="file" name="file" hidden onchange="this.form.submit()">
          </label>
        </form>

        <a href="{{ route('academics.persiapan-perkuliahan.jadwal-prodi.create') }}" class="button button-outline">
          Tambah Jadwal Baru +
        </a>
      </div>
    </div>

    {{-- TABEL LIST --}}
    <x-container class="border-none">
      <div class="flex flex-col gap-5">
        <x-table>
          <x-table-head>
            <x-table-row>
              <x-table-header>Semester</x-table-header>
              <x-table-header>Mata Kuliah</x-table-header>
              <x-table-header>Nama Kelas</x-table-header>
              <x-table-header>Kapasitas</x-table-header>
              <x-table-header>Jadwal</x-table-header>
              <x-table-header>Pengajar</x-table-header>
              <x-table-header>Aksi</x-table-header>
            </x-table-row>
          </x-table-head>

          <x-table-body>
            @php
              // dukung dua bentuk: paginator Laravel atau array biasa
              $rows = $items instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator
                ? $items->items()
                : (isset($items['data']) ? $items['data'] : ($items ?? []));
            @endphp

            @forelse($rows as $r)
              <x-table-row>
                <x-table-cell>{{ $r['semester'] ?? '-' }}</x-table-cell>
                <x-table-cell>
                  <div class="font-medium">{{ $r['mata_kuliah'] ?? '-' }}</div>
                </x-table-cell>
                <x-table-cell>{{ $r['nama_kelas'] ?? '-' }}</x-table-cell>
                <x-table-cell>{{ $r['kapasitas'] ?? '-' }}</x-table-cell>
                <x-table-cell>
                  @foreach(($r['jadwal'] ?? []) as $j)
                    <div class="mb-1">
                      <span style="display:inline-block; min-width:56px">{{ $j['hari'] ?? '-' }}</span>
                      • {{ $j['waktu'] ?? '-' }}
                      <span class="text-gray-500">[{{ $j['ruang'] ?? '-' }}]</span>
                    </div>
                  @endforeach
                </x-table-cell>
                <x-table-cell>{{ $r['pengajar'] ?? '-' }}</x-table-cell>
                <x-table-cell>
                  <div class="flex items-center justify-center gap-4">
                    <a class="btn-icon btn-view" title="Lihat"
                       href="{{ route('academics.persiapan-perkuliahan.jadwal-prodi.show', $r['id']) }}">
                      <img src="{{ asset('assets/icon-search.svg') }}" alt="Lihat"><span>Lihat</span>
                    </a>
                    <a class="btn-icon btn-edit" title="Ubah"
                       href="{{ route('academics.persiapan-perkuliahan.jadwal-prodi.edit', $r['id']) }}">
                      <img src="{{ asset('assets/icon-edit.svg') }}" alt="Edit"><span>Ubah</span>
                    </a>
                    <form method="POST"
                          action="{{ route('academics.persiapan-perkuliahan.jadwal-prodi.delete', $r['id']) }}"
                          onsubmit="return confirm('Yakin hapus jadwal ini?')">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn-icon btn-delete" title="Hapus">
                        <img src="{{ asset('assets/icon-delete-gray-600.svg') }}" alt="Hapus"><span>Hapus</span>
                      </button>
                    </form>
                  </div>
                </x-table-cell>
              </x-table-row>
            @empty
              <x-table-row>
                <x-table-cell colspan="7" class="text-center py-6">Tidak ada data.</x-table-cell>
              </x-table-row>
            @endforelse
          </x-table-body>
        </x-table>
      </div>
    </x-container>
  </div>
    @include('partials.pagination', [
        'currentPage' => 1,
        'lastPage' => 10,
        'limit' => 3,
        'routes' => '',
    ])
    {{-- @if (isset($data['data']))
    @endif --}}
</div>
@endsection
