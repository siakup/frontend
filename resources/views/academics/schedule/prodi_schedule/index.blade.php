@extends('layouts.main')

@section('title', 'Jadwal Kuliah Program Studi')

@section('breadcrumbs')
  <div class="breadcrumb-item">Beranda</div>
  <div class="breadcrumb-item active">Jadwal Kuliah</div>
@endsection

@section('css')
<style>
  .card-header.option-list{ justify-content:flex-start; align-items:center; flex-wrap:wrap; gap:12px; }
  .sub-title{ padding:10px 20px !important; }
  .filter-group{ display:flex; align-items:center; gap:10px; }
  .button-clean{ display:inline-flex; align-items:center; gap:8px; padding:8px 12px; border:1px solid #E5E7EB; border-radius:8px; background:#fff; }
  .sort-dropdown{ position:absolute; z-index:30; display:none; min-width:220px; background:#fff; border:1px solid #E5E7EB; border-radius:10px; box-shadow:0 10px 30px rgba(0,0,0,.06); }
  .sort-dropdown .dropdown-item{ padding:10px 14px; cursor:pointer; }
  .sort-dropdown .dropdown-item:hover{ background:#EB474D; }
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
<script src="{{ asset('js/delete-modal.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const campusBtn   = document.querySelector('#sortButtonCampus');
  const campusDrop  = document.querySelector('#sortDropdownCampus');
  const studyBtn    = document.querySelector('#sortButtonStudy');
  const studyDrop   = document.querySelector('#sortDropdownStudy');

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

    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            this.form.submit();
        }
    });

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

  document.addEventListener('click', (e)=>{
    if(!e.target.closest('.CampusWrap')) { campusDrop.style.display='none'; resetArrow(campusBtn); }
    if(!e.target.closest('.StudyWrap'))  { studyDrop.style.display='none';  resetArrow(studyBtn);  }
  });

  document.querySelector('#btnSearch')?.addEventListener('click', function(){
    const q = document.querySelector('#q').value || '';
    const url = new URL(window.location.href);
    if(q) url.searchParams.set('q', q); else url.searchParams.delete('q');
    url.searchParams.set('page', 1);
    window.location.href = url.toString();
  });

  document.querySelector('#btnSort')?.addEventListener('click', function(){
    const url = new URL(window.location.href);
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
  @include('academics.schedule.prodi_schedule.navbar-jadwal-prodi')
  <div class="academics-slicing-content content-card p-[20px]">



    <x-typography variant="heading-h6" class="mb-2 p-[20px]">
      Jadwal Kuliah Program Studi
    </x-typography>

    <div class="card-header option-list">
      <div class="card-header">
        <div class="page-title-text sub-title">Program Perkuliahan</div>
        @include('partials.dropdown-filter', [
            'buttonId' => 'sortButtonCampus',
            'dropdownId' => 'sortCampus',
            'dropdownItem' => [
                'Reguler' => '1',
                'Double Degree' => '2',
                'International' => '3',
            ],
            'label' =>  'Reguler',
            'url' => route('academics.schedule.prodi-schedule.index'),
            'imgSrc' => asset('assets/active/icon-arrow-down.svg'),
            'dropdownClass' => '!top-[27%] !left-[20.5%]',
            'isIconCanRotate' => true,
            'imgInvertSrc' => asset('assets/active/icon-arrow-up.svg')
        ])
      </div>

      <div class="card-header">
        <div class="page-title-text sub-title">Program Studi</div>
        @include('partials.dropdown-filter', [
            'buttonId' => 'sortButtonStudy',
            'dropdownId' => 'sortStudy',
            'dropdownItem' => [
                'Kimia' => '1',
                'Teknik Kimia' => '2',
                'Teknik Perminyakan' => '3',
            ],
            'label' =>  'Kimia',
            'url' => route('academics.schedule.prodi-schedule.index'),
            'imgSrc' => asset('assets/active/icon-arrow-down.svg'),
            'dropdownClass' => '!top-[27%] !left-[43.7%]',
            'isIconCanRotate' => true,
            'imgInvertSrc' => asset('assets/active/icon-arrow-up.svg')
        ])
      </div>

</div>
<x-container class="">
    <div class="card-header">
 <form method="GET" action="{{ route('academics.schedule.prodi-schedule.index') }}">
     <div class="search-section">
         <div class="search-container" style="display: flex; align-items: center;">
             <input type="text" name="search" placeholder="Nama Pengajar / Nama Mata Kuliah / Hari"
                 class="search-filter" id="searchInput" autocomplete="off"
                 value="{{ request('search') }}" style="width: 400px;">

             <button type="submit"
                 style="background: none; border: none; padding: 0; margin-left: -35px; cursor: pointer;">
                 <img src="{{ asset('assets/search-left.svg') }}" alt="search"
                     style="width: 20px; height: 20px;">
             </button>
         </div>
     </div>
 </form>



 @include('partials.dropdown-filter', [
     'buttonId' => 'sortButton',
     'dropdownId' => 'sortDropdown',
     'dropdownItem' => [
     'Semester 1' => 'semester_1',
     'Semester 2' => 'semester_2',
     'Semester 3' => 'semester_3',
     'Semester 4' => 'semester_4',
     'Semester 5' => 'semester_5',
     'Semester 6' => 'semester_6',
     'Semester 7' => 'semester_7',
     'Semester 8' => 'semester_8',
     'A-Z' => 'nama, asc',
     'Z-A' => 'nama, desc',
     'Terbaru' => 'created_at,desc',
     'Terlama' => 'created_at,asc'
     ],
     'label' => empty($_GET) ? 'Urutkan' : ($sort === 'active' ? 'Aktif' : ($sort === 'inactive' ? 'Tidak Aktif' : ($sort === 'nama,asc' ? 'A-Z' : ($sort === 'nama,desc' ? 'Z-A' : ($sort === 'created_at,desc' ? 'Terbaru' : 'Terlama'))))),
     'url' => route('academics.schedule.prodi-schedule.index'),
     'imgSrc' => asset('assets/icon-filter.svg'),
     'dropdownClass' => '!top-[44%] !right-[3.7%]',
     'isIconCanRotate' => false,
     'imgInvertSrc' => ''
 ])
</div>
</x-container>
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
    </x-table-header>

    <x-table-body>
    @php
        $rows = $items instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator
        ? $items->items()
        : (isset($items['data']) ? $items['data'] : ($items ?? []));
    @endphp

        @forelse ($rows as $r)
            <x-table-row
                data-row-id="{{ $r['id'] }}"
                data-row-name="{{ $r['nama_kelas'] ?? $r['mata_kuliah'] ?? 'Jadwal' }}"
            >
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
                    <div class="center">
                    <a href="javascript:void(0)"
                    class="btn-icon btn-view-periode-academic"
                    title="Lihat"
                    onclick="openViewModal('{{ route('academics.schedule.prodi-schedule.show', $r['id']) }}')">
                    <img src="{{ asset('assets/icon-search.svg') }}" alt="Lihat">
                    <span>Lihat</span>
                    </a>

                    <a class="btn-icon btn-edit-periode-academic" title="Ubah" href=""
                    style="text-decoration: none; color: inherit;">
                    <img src="{{ asset('assets/icon-edit.svg') }}" alt="Edit"><span style="color: #E62129">Ubah</span>
                    </a>



                    <button type="button" class="btn-icon btn-delete"
                            data-delete-url="{{ route('academics.schedule.prodi-schedule.destroy', $r['id']) }}"
                            data-delete-name="{{ $r['nama_kelas'] ?? $r['mata_kuliah'] }}"
                            title="Hapus">
                    <img src="{{ asset('assets/icon-delete-gray-600.svg') }}" alt="Hapus">
                    <span class="text-[#8C8C8C]">Hapus</span>
                    </button>

                </div>
                </x-table-cell>
                {{-- <x-table-cell>{{ $r['pengajar'] ?? '-' }}</x-table-cell>
                <x-table-cell>
                <div class="center">
                    <a href="javascript:void(0)"
                    class="btn-icon btn-view-periode-academic"
                    title="Lihat"
                    onclick="openViewModal('{{ route('academics.schedule.prodi-schedule.show', $r['id']) }}')">
                    <img src="{{ asset('assets/icon-search.svg') }}" alt="Lihat">
                    <span>Lihat</span>
                    </a>

                    <a class="btn-icon btn-edit-periode-academic" title="Ubah" href=""
                    style="text-decoration: none; color: inherit;">
                    <img src="{{ asset('assets/icon-edit.svg') }}" alt="Edit"><span style="color: #E62129">Ubah</span>
                    </a>



                    <button type="button" class="btn-icon btn-delete"
                            data-delete-url="{{ route('academics.schedule.prodi-schedule.destroy', $r['id']) }}"
                            data-delete-name="{{ $r['nama_kelas'] ?? $r['mata_kuliah'] }}"
                            title="Hapus">
                    <img src="{{ asset('assets/icon-delete-gray-600.svg') }}" alt="Hapus">
                    <span class="text-[#8C8C8C]">Hapus</span>
                    </button>

                </div>
                </x-table-cell> --}}
            </x-table-row>
        @empty
            @include('academics.periode.error-filter')
        @endforelse
    </x-table-body>

    </x-table>
</div>
  <div class="card-header">
      <div class="right gap-5">
          <a href="{{route('academics.schedule.prodi-schedule.import-fet1')}}" class="button-clean" id="">
              <span>Impor File FET</span>
              <img src="{{ asset('assets/icon-upload-red-500.svg') }}" alt="Filter">
          </a>
          <button onclick="window.location.href='{{ route('academics.schedule.prodi-schedule.create') }}'" class="button-outline btn-add-event">Tambah Jadwal Baru</button>
      </div>
  </div>
</div>
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

@include('academics.schedule.prodi_schedule.delete')
@include('academics.schedule.prodi_schedule.view')


@endsection
