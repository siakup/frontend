@extends('layouts.main')

@section('title','Tambah Jadwal Kuliah Program Studi')

@section('css')
<style>
  .section-card{border:1px solid #E5E7EB;border-radius:12px;background:#fff;margin-bottom:20px}
  .section-title{padding:12px 16px;font-weight:600;border-bottom:1px solid #F1F5F9}
  .section-body{padding:16px}

  .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}
  .form-grid .full{grid-column:1/-1}
  .form-group label{display:block;margin-bottom:6px;font-size:14px;font-weight:500;color:#374151}

  .input{width:100%;height:40px;border:1px solid #E5E7EB;border-radius:8px;padding:0 12px;background:#fff}
  .filter-box{position:relative}
  .filter-box .input{display:flex;align-items:center;justify-content:space-between}
  .sort-dropdown.select{
    position:absolute;left:0;right:0;top:44px;z-index:30;display:none;
    background:#fff;border:1px solid #E5E7EB;border-radius:10px;box-shadow:0 10px 30px rgba(0,0,0,.06)
  }
  .sort-dropdown.select .dropdown-item{padding:10px 14px;cursor:pointer}
  .sort-dropdown.select .dropdown-item:hover{background:#F8FAFC}

  .input-group{display:grid;grid-template-columns:1fr auto;gap:8px}
  .btn-right-outline{
    border:1px solid #E62129;color:#E62129;background:#fff;border-radius:8px;
    height:40px;padding:0 12px;display:inline-flex;align-items:center
  }
  .button{background:#E62129;color:#fff;border-radius:8px;padding:8px 16px;border:none;cursor:pointer}
  .button-outline{border:1px solid #E62129;color:#E62129;background:#fff;border-radius:8px;padding:8px 16px;cursor:pointer}

  .table-mini{width:100%;border-collapse:separate;border-spacing:0}
  .table-mini th,.table-mini td{border-bottom:1px solid #F1F5F9;padding:10px 12px;text-align:left;font-size:14px}
  .right{display:flex;gap:10px;justify-content:flex-end}
  .form-footer{display:flex;justify-content:flex-end;gap:12px;margin-top:20px}
</style>
@endsection

@section('content')
<div class="container">
  <h2 class="text-xl font-semibold ml-6 mb-4">Tambah Jadwal Kuliah Program Studi</h2>

  <a href="{{ route('academics.schedule.prodi-schedule.index') }}" class="button-no-outline-left">
      <img src="{{ asset('assets/active/icon-arrow-left.svg') }}" alt="Kembali"> Jadwal Kuliah
  </a>

  {{-- === Form Start === --}}
  <form method="POST" action="{{ route('academics.schedule.prodi-schedule.store') }}">
    @csrf

    {{-- Informasi Kelas --}}
    <div class="section-card mt-[72px]">
    <div class="section-title">Informasi Kelas</div>
    <div class="section-body w-full">
        <div class="form-grid">

        {{-- 1) Periode (FULL) --}}
        <div class="form-group full">
            <label>Periode</label>
            <div class="filter-box">
            <button type="button" class="button-clean input" data-dd-btn="periode">
                <span data-dd-label="periode">Pilih Periode</span>
                <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" />
            </button>
            <div class="sort-dropdown select w-full" data-dd-menu="periode">
                @foreach(($periodeList ?? []) as $it)
                <div class="dropdown-item" data-dd-value="periode" data-id="{{ $it->id }}">{{ $it->nama }}</div>
                @endforeach
            </div>
            <input type="hidden" name="periode_id">
            </div>
        </div>

        {{-- 2) Program Perkuliahan (kolom kiri) --}}
        <div class="form-group">
            <label>Program Perkuliahan</label>
            <div class="filter-box">
            <button type="button" class="button-clean input" data-dd-btn="pp">
                <span data-dd-label="pp">Pilih Program Perkuliahan</span>
                <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" />
            </button>
            <div class="sort-dropdown select" data-dd-menu="pp">
                @foreach(($programPerkuliahanList ?? []) as $it)
                <div class="dropdown-item" data-dd-value="pp" data-id="{{ $it->id }}">{{ $it->nama }}</div>
                @endforeach
            </div>
            <input type="hidden" name="program_perkuliahan_id">
            </div>
        </div>

        {{-- 2) Program Studi (kolom kanan) --}}
        <div class="form-group">
            <label>Program Studi</label>
            <div class="filter-box">
            <button type="button" class="button-clean input" data-dd-btn="prodi">
                <span data-dd-label="prodi">Pilih Program Studi</span>
                <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" />
            </button>
            <div class="sort-dropdown select" data-dd-menu="prodi">
                @foreach(($programStudiList ?? []) as $it)
                <div class="dropdown-item" data-dd-value="prodi" data-id="{{ $it->id }}">{{ $it->nama }}</div>
                @endforeach
            </div>
            <input type="hidden" name="program_studi_id">
            </div>
        </div>

        {{-- 3) Nama Mata Kuliah + tombol (FULL, 1fr | auto) --}}
        <div class="form-group full">
            <label>Nama Mata Kuliah</label>
            <div class="input-group">
            <div class="filter-box">
                <button type="button" class="button-clean input" data-dd-btn="mk">
                <span data-dd-label="mk">Pilih Mata Kuliah</span>
                <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" />
                </button>
                <div class="sort-dropdown select" data-dd-menu="mk">
                @foreach(($mataKuliahList ?? []) as $it)
                    <div class="dropdown-item" data-dd-value="mk" data-id="{{ $it->id }}">{{ $it->nama }}</div>
                @endforeach
                </div>
                <input type="hidden" name="mata_kuliah_id">
            </div>
            <button type="button" class="btn-right-outline">Pilih Mata Kuliah</button>
            </div>
        </div>

        {{-- 4) Nama Kelas (FULL) --}}
        <div class="form-group full">
            <label>Nama Kelas</label>
            <input type="text" name="nama_kelas" class="input" placeholder="Masukkan Nama Kelas, Contoh: MatkomEcon-EC2">
        </div>

        {{-- 5) Nama Singkat (FULL) --}}
        <div class="form-group full">
            <label>Nama Singkat</label>
            <input type="text" name="nama_singkat" class="input" placeholder="Masukkan Nama Singkat, Contoh: EC2">
        </div>

        {{-- 6) Kapasitas & Kelas MBKM (2 kolom) --}}
        <div class="form-group">
            <label>Kapasitas Peserta</label>
            <input type="number" name="kapasitas" class="input" placeholder="Masukkan Kapasitas, contoh: 50">
        </div>
        <div class="form-group">
            <label>Kelas MK/M</label>
            <div class="filter-box">
            <button type="button" class="button-clean input" data-dd-btn="kelas">
                <span data-dd-label="kelas">Pilih Kelas MK/M</span>
                <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" />
            </button>
            <div class="sort-dropdown select" data-dd-menu="kelas">
                @foreach(($kelasOptions ?? ['MK A','MK B','MK C']) as $opt)
                <div class="dropdown-item" data-dd-value="kelas" data-id="{{ $opt }}">{{ $opt }}</div>
                @endforeach
            </div>
            <input type="hidden" name="kelas_mkm">
            </div>
        </div>

        {{-- 7) Tanggal Mulai & Tanggal Berakhir (2 kolom) --}}
        <div class="form-group">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="input">
        </div>
        <div class="form-group">
            <label>Tanggal Berakhir</label>
            <input type="date" name="tanggal_selesai" class="input">
        </div>

        </div>
    </div>
    </div>


    {{-- Daftar Pengajar --}}
    <div class="section-card">
      <div class="section-title">Daftar Pengajar</div>
      <div class="section-body">
        <div class="right mb-3">
          <button type="button" class="button-outline">Tambah Pengajar</button>
        </div>
        <table class="table-mini">
          <thead><tr><th>Nama Pengajar</th><th>Status Pengajar</th><th>Aksi</th></tr></thead>
          <tbody><tr><td colspan="3" class="text-center text-gray-400">Belum ada data</td></tr></tbody>
        </table>
      </div>
    </div>

    {{-- Daftar Jadwal Kelas --}}
    <div class="section-card">
      <div class="section-title">Daftar Jadwal Kelas</div>
      <div class="section-body">
        <div class="right mb-3">
          <button type="button" class="button-outline">Tambah Jadwal Kelas</button>
        </div>
        <table class="table-mini">
          <thead><tr><th>Hari</th><th>Waktu Mulai Kelas</th><th>Waktu Selesai Kelas</th><th>Ruangan</th><th>Aksi</th></tr></thead>
          <tbody><tr><td colspan="5" class="text-center text-gray-400">Belum ada data</td></tr></tbody>
        </table>
      </div>
    </div>

    {{-- Footer --}}
    <div class="form-footer">
      <a href="{{ route('academics.schedule.prodi-schedule.index') }}" class="button-outline">Batal</a>
      <button type="submit" class="button">Simpan</button>
    </div>
  </form>
</div>
@endsection

@section('javascript')
<script>
document.addEventListener('click',(e)=>{
  const btn=e.target.closest('[data-dd-btn]');
  if(btn){
    const key=btn.getAttribute('data-dd-btn');
    const menu=document.querySelector(`[data-dd-menu="${key}"]`);
    menu.style.display=(menu.style.display==='block')?'none':'block';
    e.stopPropagation();
  }
  const item=e.target.closest('.dropdown-item');
  if(item){
    const key=item.getAttribute('data-dd-value');
    const id=item.getAttribute('data-id');
    const menu=item.parentElement;
    const label=document.querySelector(`[data-dd-label="${key}"]`);
    if(label) label.textContent=item.textContent;
    const hidden=menu.parentElement.querySelector('input[type="hidden"]');
    if(hidden) hidden.value=id;
    menu.style.display='none';
  }
  if(!e.target.closest('.filter-box')){
    document.querySelectorAll('.sort-dropdown.select').forEach(d=>d.style.display='none');
  }
});
</script>
@endsection
