@extends('layouts.main')
@section('title','Tambah Jadwal Kuliah Program Studi')

@section('content')
<link rel="stylesheet" href="{{ asset('css/plugins/flatpckr.css') }}" />
<style>
    .prodi-create .page-wrap{width:100%;}
    .prodi-create .content-card{width:100%;max-width:none;}
    .prodi-create .section-card{border:1px solid #E5E7EB;border-radius:12px;background:#fff;margin-bottom:20px}
    .prodi-create .section-title{padding:12px 16px;font-weight:600;border-bottom:1px solid #F1F5F9}
    .prodi-create .section-body{padding:16px}
    .prodi-create .grid-3{display:grid;grid-template-columns:180px minmax(0,1fr) minmax(0,1fr);column-gap:16px;row-gap:12px;align-items:center}
    .prodi-create .row{display:contents;}
    .prodi-create .label{font-size:14px;font-weight:500;color:#374151}
    .prodi-create .cell{display:block}
    .prodi-create .span-2{grid-column:2 / span 2;}
    .prodi-create .mini-label{font-size:12px;color:#6B7280;margin-bottom:6px}
    .prodi-create .input{width:100%;height:40px;border:1px solid #E5E7EB;border-radius:8px;background:#fff;padding:0 12px}
    .prodi-create .input.muted{background:#F5F7FA;color:#6B7280;border-color:#E5E7EB}
    .prodi-create .filter-box{position:relative}
    .prodi-create .filter-box .input{display:flex;align-items:center;justify-content:space-between}
    .prodi-create .sort-dropdown.select{
    position:absolute;left:783;right:0;top:44px;z-index:30;display:none;
    background:#fff;border:1px solid #E5E7EB;border-radius:10px;box-shadow:0 10px 30px rgba(0,0,0,.06)
    }
    .prodi-create .sort-dropdown.select .dropdown-item{padding:10px 14px;cursor:pointer}
    .prodi-create .sort-dropdown.select .dropdown-item:hover{background:#EB474D}
    .prodi-create .date-input{position:relative}
    .prodi-create .date-input input{padding-right:38px}
    .prodi-create .date-input .icon{position:absolute;right:10px;top:50%;transform:translateY(-50%);width:18px;height:18px;cursor:pointer}

    .prodi-create .btn{border-radius:8px;padding:8px 16px;line-height:24px;cursor:pointer;border:1px solid transparent}
    .prodi-create .btn-primary{background:#E62129;color:#fff;border-color:#E62129}
    .prodi-create .btn-primary:disabled{background:#E5E7EB;border-color:#E5E7EB;color:#9CA3AF;cursor:not-allowed}
    .prodi-create .btn-secondary{background:#fff;border:1px solid #E5E7EB;color:#6B7280}
    .prodi-create .btn-outline{background:#fff;border:1px solid #E62129;color:#E62129}
    .prodi-create .form-footer{display:flex;justify-content:flex-end;gap:12px;margin-top:20px}

    .prodi-create .table-mini{width:100%;border-collapse:separate;border-spacing:0;border-radius: 20px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,.06);margin-top:20px}
    .prodi-create .table-mini thead th{background:#D9D9D9;color:#262626;font-weight:600;border-bottom:1px solid #E5E7EB;padding:10px 12px;text-align:left;font-size:14px;}
    .prodi-create .table-mini td{border-bottom:1px solid #F1F5F9;padding:10px 12px;text-align:left;font-size:14px}

    .prodi-create .inline-field .filter-box{ flex:1; }
    .prodi-create .inline-field{display:grid;grid-template-columns: auto 1fr;align-items:center;gap:16px;}
    .prodi-create .inline-title{font-weight:600;color:#262626;white-space:nowrap;}

    .prodi-create .mk-wrap{display:flex; align-items:center; gap:12px;}
    .prodi-create .mk-wrap .input{ flex:1; }
    .prodi-create .mk-wrap .btn{ flex-shrink:0; }

    @media(max-width:992px){
    .prodi-create .grid-3{grid-template-columns:120px 1fr}
    .prodi-create .span-2{grid-column:2 / span 1}
    .prodi-create .form-footer .btn{flex:1}
    }

    .prodi-create .filter-box .input { cursor: pointer; transition: border-color .15s, box-shadow .15s; }
    .prodi-create .input { transition: border-color .15s, box-shadow .15s, background-color .15s; }
    .prodi-create .input.is-hover,
    .prodi-create .filter-box .input:hover {
    box-shadow: 0 0 0 3px rgba(230,33,41,.10);
    }
    .prodi-create .input.is-focus,
    .prodi-create .input:focus {
    box-shadow: 0 0 0 3px rgba(230,33,41,.15);
    outline: none;
    }
    .prodi-create .filter-box .input img { transition: transform .2s ease; }
    .prodi-create .filter-box .input.open img { transform: rotate(180deg); }

    .prodi-create .sort-dropdown.select .dropdown-item:hover{
    background: #EB474D;
    }

    .prodi-create .btn-primary:not(:disabled):hover{ background:#E62129; border-color:#E62129; }
    .prodi-create .btn-secondary:hover{ background:#F9FAFB; border-color:#D1D5DB; }

    .prodi-create .date-input .icon{ transition: filter .15s; }
    .prodi-create .date-input .icon.is-hover{ filter: brightness(0) saturate(100%) invert(23%) sepia(92%) saturate(2960%) hue-rotate(346deg) brightness(94%) contrast(93%); }


</style>

<div class="prodi-create page-wrap">
  <div class="page-header"><div class="page-title-text">Tambah Jadwal Kuliah Program Studi</div></div>
  <a href="{{ route('academics.schedule.prodi-schedule.index') }}" class="button-no-outline-left">
    <img src="{{ asset('assets/active/icon-arrow-left.svg') }}" alt="Kembali"> Jadwal Kuliah
  </a>

  <form method="POST" action="{{ route('academics.schedule.prodi-schedule.store') }}" class="content-card" style="border:none;background:transparent;">
    @csrf

    <div class="section-card">
      <div class="section-title">Informasi Kelas</div>
      <div class="section-body">
        <div class="grid-3">
            <div class="row">
                <div class="label">Periode</div>
                <div class="cell span-2">
                <div class="filter-box">
                    <button type="button" class="input muted" data-dd-btn="periode" id="btnPeriode">
                    <span data-dd-label="periode">Pilih Periode</span>
                    <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="">
                    </button>
                    <div class="sort-dropdown select" data-dd-menu="periode">
                    @foreach(($periodeList ?? []) as $it)
                        <div class="dropdown-item" data-dd-value="periode" data-id="{{ $it->id }}">{{ $it->nama }}</div>
                    @endforeach
                    </div>
                    <input type="hidden" name="periode_id" id="periode_id">
                </div>
                </div>
            </div>

            <div class="row">
                <div class="label">Program Perkuliahan</div>
                <div class="cell">
                    <div class="filter-box">
                    <button type="button" class="input" data-dd-btn="pp">
                        <span data-dd-label="pp">Pilih Program Perkuliahan</span>
                        <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="">
                    </button>
                    <div class="sort-dropdown select" data-dd-menu="pp">
                        @foreach(($programPerkuliahanList ?? []) as $it)
                        <div class="dropdown-item" data-dd-value="pp" data-id="{{ $it->id }}">{{ $it->nama }}</div>
                        @endforeach
                    </div>
                    <input type="hidden" name="program_perkuliahan_id" id="program_perkuliahan_id">
                    </div>
                </div>

                <div class="cell">
                    <div class="inline-field">
                    <div class="label mr-30">Program Studi</div>
                    <div class="filter-box">
                        <button type="button" class="input" data-dd-btn="prodi">
                        <span data-dd-label="prodi">Pilih Program Studi</span>
                        <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="">
                        </button>
                        <div class="sort-dropdown select" data-dd-menu="prodi">
                        @foreach(($programStudiList ?? []) as $it)
                            <div class="dropdown-item" data-dd-value="prodi" data-id="{{ $it->id }}">{{ $it->nama }}</div>
                        @endforeach
                        </div>
                        <input type="hidden" name="program_studi_id" id="program_studi_id">
                    </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="label">Nama Mata Kuliah</div>
                <div class="cell span-2">
                    <div class="mk-wrap">
                    <input type="text" id="mk_display" class="input muted" placeholder="Pilih Mata Kuliah" readonly>
                    <input type="hidden" name="mata_kuliah_id" id="mata_kuliah_id">
                    <button type="button" id="btnOpenMk" class="btn btn-primary">Pilih Mata Kuliah</button>
                    </div>
                </div>
            </div>

          <div class="row">
            <div class="label">Nama Kelas</div>
            <div class="cell span-2">
              <input type="text" name="nama_kelas" id="nama_kelas" class="input" placeholder="Masukkan Nama Kelas, Contoh: Makroekonomi-EC2">
            </div>
          </div>

          <div class="row">
            <div class="label">Nama Singkat</div>
            <div class="cell span-2">
              <input type="text" name="nama_singkat" id="nama_singkat" class="input" placeholder="Masukkan Nama Singkat, Contoh: EC2">
            </div>
          </div>

          <div class="row">
            <div class="label">Kapasitas Peserta</div>
            <div class="cell">
              <input type="number" name="kapasitas" id="kapasitas" class="input" placeholder="Masukkan Kapasitas, Contoh: 50">
            </div>
            <div class="cell">
                <div class="inline-field">
                    <div class="label mr-34">Kelas MBKM</div>
                    <div class="filter-box">
                        <button type="button" class="input" data-dd-btn="kelas">
                        <span data-dd-label="kelas">Pilih Kelas MBKM</span>
                        <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="">
                        </button>
                        <div class="sort-dropdown select" data-dd-menu="kelas">
                        @foreach(($kelasOptions ?? ['Ya','Tidak']) as $opt)
                            <div class="dropdown-item" data-dd-value="kelas" data-id="{{ $opt }}">{{ $opt }}</div>
                        @endforeach
                        </div>
                        <input type="hidden" name="kelas_mkm" id="kelas_mkm">
                    </div>
                </div>
            </div>
          </div>

          <div class="row">
            <div class="label">Tanggal Mulai</div>
            <div class="cell">
              <div class="date-input">
                <input type="text" id="tanggal_mulai" name="tanggal_mulai" class="input" placeholder="dd-mm-yyyy">
                <img class="icon" data-cal="#tanggal_mulai" src="{{ asset('assets/base/icon-calendar.svg') }}" alt="cal">
              </div>
            </div>
            <div class="cell">
                <div class="inline-field">
                    <div class="label mr-25">Tanggal Berakhir</div>
                    <div class="date-input">
                        <input type="text" id="tanggal_selesai" name="tanggal_selesai" class="input" placeholder="dd-mm-yyyy">
                        <img class="icon" data-cal="#tanggal_selesai" src="{{ asset('assets/base/icon-calendar.svg') }}" alt="cal">
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section-card">
      <div class="section-title">Daftar Pengajar</div>
      <div class="section-body">
        <div style="display:flex;justify-content:flex-end;margin-bottom:8px">
          <button type="button" class="btn btn-primary">Tambah Pengajar</button>
        </div>
        <table class="table-mini">
          <thead><tr><th>Nama Pengajar</th><th>Status Pengajar</th><th>Aksi</th></tr></thead>
          <tbody><tr><td colspan="3" class="text-center text-gray-400">Belum ada data</td></tr></tbody>
        </table>
      </div>
    </div>

    <div class="section-card">
      <div class="section-title">Daftar Jadwal Kelas</div>
      <div class="section-body">
        <div style="display:flex;justify-content:flex-end;margin-bottom:8px">
          <button type="button" class="btn btn-primary">Tambah Jadwal Kelas</button>
        </div>
        <table class="table-mini">
          <thead><tr><th>Hari</th><th>Waktu Mulai Kelas</th><th>Waktu Selesai Kelas</th><th>Ruangan</th><th>Aksi</th></tr></thead>
          <tbody><tr><td colspan="5" class="text-center text-gray-400">Belum ada data</td></tr></tbody>
        </table>
      </div>
    </div>

    <div class="form-footer">
      <a href="{{ route('academics.schedule.prodi-schedule.index') }}" class="btn btn-secondary">Batal</a>
      <button type="submit" id="btnSave" class="btn btn-primary" disabled>Simpan</button>
    </div>
  </form>
</div>

@include('academics.schedule.prodi_schedule._modal-pilih-mk');

<script src="{{ asset('js/plugins/flatpckr.js') }}"></script>
<script src="{{ asset('js/plugins/flatpckr-id.js') }}"></script>
<script>
(function(){
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
      const hidden=menu.parentElement.querySelector('input[type="hidden"]');
      if(label) label.textContent=item.textContent.trim();
      if(hidden) hidden.value=id;
      menu.style.display='none';
      updateSave();
    }
    if(!e.target.closest('.filter-box')){
      document.querySelectorAll('.sort-dropdown.select').forEach(d=>d.style.display='none');
    }
  });
  const fpMulai = flatpickr("#tanggal_mulai",{locale:'id',dateFormat:"d-m-Y"});
  const fpSelesai = flatpickr("#tanggal_selesai",{locale:'id',dateFormat:"d-m-Y"});
  fpMulai.config.onChange.push((sel)=>{ if(sel.length) fpSelesai.set('minDate', sel[0]); updateSave(); });
  fpSelesai.config.onChange.push((sel)=>{ if(sel.length) fpMulai.set('maxDate', sel[0]); updateSave(); });
  document.querySelectorAll('.date-input .icon').forEach(ic=>{
    ic.addEventListener('click',()=>{ const t=ic.getAttribute('data-cal'); (t=="#tanggal_mulai"?fpMulai:fpSelesai).open(); });
  });

  const requiredHidden = ['periode_id','program_perkuliahan_id','program_studi_id','mata_kuliah_id','kelas_mkm'];
  const requiredInputs = ['nama_kelas','nama_singkat','kapasitas','tanggal_mulai','tanggal_selesai'];
  requiredInputs.forEach(id=> document.getElementById(id)?.addEventListener('input',updateSave));

  function updateSave(){
    const filledHidden = requiredHidden.every(id => document.getElementById(id)?.value);
    const filledInputs = requiredInputs.every(id => (document.getElementById(id)?.value||'').trim() !== '');
    document.getElementById('btnSave').disabled = !(filledHidden && filledInputs);
  }

    const allInputs = document.querySelectorAll('.prodi-create .input');
    allInputs.forEach(el=>{
    el.addEventListener('mouseenter', ()=> el.classList.add('is-hover'));
    el.addEventListener('mouseleave', ()=> el.classList.remove('is-hover'));
    el.addEventListener('focus',     ()=> el.classList.add('is-focus'));
    el.addEventListener('blur',      ()=> el.classList.remove('is-focus'));
    });

    document.addEventListener('click',(e)=>{
    const btn = e.target.closest('.prodi-create .filter-box [data-dd-btn]');
    document.querySelectorAll('.prodi-create .filter-box .input.open')
        .forEach(b=>b.classList.remove('open'));
    if(btn){
        btn.classList.toggle('open');
    }
    });

    document.querySelectorAll('.prodi-create .date-input .icon').forEach(ic=>{
    ic.addEventListener('mouseenter', ()=> ic.classList.add('is-hover'));
    ic.addEventListener('mouseleave', ()=> ic.classList.remove('is-hover'));
    });

    const btnMk = document.getElementById('btnOpenMk');
    btnMk.addEventListener('click',()=>{
        document.getElementById('modalAddEvent').style.display='block';
    });

})();
</script>
@endsection
