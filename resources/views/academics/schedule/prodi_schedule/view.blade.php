<div id="modalViewProdi" class="modal-custom" style="display:none">
  <div class="modal-custom-backdrop" data-close></div>

  <div class="modal-custom-content" style="width:840px;max-width:90vw">
    <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 16px;border-bottom:1px solid #F1F5F9">
      <div style="font-weight:600">Lihat Jadwal Kuliah Program Studi</div>
      <button type="button" class="btn-close" data-close
              style="width:32px;height:32px;border:1px solid #E5E7EB;border-radius:8px;background:#fff;display:grid;place-items:center;cursor:pointer">✕</button>
    </div>

    <div class="modal-custom-body prodi-view" style="padding:16px">
      <style>
        .modal-custom{position:fixed;inset:0;z-index:9999;display:none;align-items:center;justify-content:center;background:rgba(0,0,0,.25)}
        .modal-custom-backdrop{position:absolute;inset:0}
        .modal-custom-content{position:relative;background:#fff;border-radius:14px;box-shadow:0 4px 24px rgba(0,0,0,.12);margin:0 16px;max-height:90vh;overflow:auto}
        .prodi-view .grid-3{display:grid;grid-template-columns:180px minmax(0,1fr) minmax(0,1fr);column-gap:16px;row-gap:12px;align-items:center}
        .prodi-view .row{display:contents;}
        .prodi-view .label{font-size:14px;font-weight:500;color:#374151}
        .prodi-view .cell{display:block}
        .prodi-view .span-2{grid-column:2 / span 2;}
        .prodi-view .mini-label{font-size:12px;color:#6B7280;margin-bottom:6px}
        .prodi-view .input{width:100%;height:40px;border:1px solid #E5E7EB;border-radius:8px;background:#F5F7FA;color:#6B7280;padding:0 12px}
        .prodi-view .accordion{border:1px solid #E5E7EB;border-radius:12px;background:#fff;overflow:hidden}
        .prodi-view .acc-item + .acc-item{border-top:1px solid #F1F5F9}
        .prodi-view .acc-head{width:100%;text-align:left;background:#fff;padding:12px 16px;font-weight:600;display:flex;align-items:center;justify-content:space-between;cursor:pointer}
        .prodi-view .acc-body{padding:16px;display:none}
        .prodi-view .acc-item.open .acc-body{display:block}
        .prodi-view .chev{transition:transform .2s}
        .prodi-view .acc-item.open .chev{transform:rotate(180deg)}
        @media(max-width:992px){ .prodi-view .grid-3{grid-template-columns:120px 1fr} .prodi-view .span-2{grid-column:2 / span 1} }
      </style>

      <div class="accordion">
        <div class="acc-item open" data-acc="info">
          <button class="acc-head" type="button" data-acc-toggle="info">
            <span>Informasi Kelas</span>
            <img class="chev" src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="">
          </button>
          <div class="acc-body">
            <div class="grid-3">
              <div class="row">
                <div class="label">Program Perkuliahan</div>
                <div class="cell"><input id="vw-program_perkuliahan" class="input" readonly></div>
                <div class="cell">
                  <div class="mini-label">Program Studi</div>
                  <input id="vw-program_studi" class="input" readonly>
                </div>
              </div>

              <div class="row">
                <div class="label">Periode</div>
                <div class="cell span-2"><input id="vw-periode" class="input" readonly></div>
              </div>

              <div class="row">
                <div class="label">Nama Mata Kuliah</div>
                <div class="cell span-2"><input id="vw-mata_kuliah" class="input" readonly></div>
              </div>

              <div class="row">
                <div class="label">Nama Kelas</div>
                <div class="cell span-2"><input id="vw-nama_kelas" class="input" readonly></div>
              </div>

              <div class="row">
                <div class="label">Nama Singkat</div>
                <div class="cell span-2"><input id="vw-nama_singkat" class="input" readonly></div>
              </div>

              <div class="row">
                <div class="label">Kapasitas Peserta</div>
                <div class="cell"><input id="vw-kapasitas" class="input" readonly></div>
                <div class="cell">
                  <div class="mini-label">Kelas MBKM</div>
                  <input id="vw-kelas_mbkm" class="input" readonly>
                </div>
              </div>

              <div class="row">
                <div class="label">Tanggal Mulai</div>
                <div class="cell"><input id="vw-tanggal_mulai" class="input" readonly></div>
                <div class="cell">
                  <div class="mini-label">Tanggal Selesai</div>
                  <input id="vw-tanggal_selesai" class="input" readonly>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="acc-item" data-acc="pengajar">
          <button class="acc-head" type="button" data-acc-toggle="pengajar">
            <span>Daftar Pengajar</span>
            <img class="chev" src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="">
          </button>
          <div class="acc-body">
            <x-table>
              <x-table-head>
                <x-table-row>
                  <x-table-header>Nama Pengajar</x-table-header>
                  <x-table-header>Status Pengajar</x-table-header>
                </x-table-row>
              </x-table-head>
              <x-table-body id="vw-pengajar-tbody">
                <x-table-row>
                  <x-table-cell colspan="2" class="text-center text-gray-400">Belum ada data</x-table-cell>
                </x-table-row>
              </x-table-body>
            </x-table>
          </div>
        </div>

        <div class="acc-item" data-acc="jadwal">
          <button class="acc-head" type="button" data-acc-toggle="jadwal">
            <span>Daftar Jadwal Kelas</span>
            <img class="chev" src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="">
          </button>
          <div class="acc-body">
            <x-table>
              <x-table-head>
                <x-table-row>
                  <x-table-header>Hari</x-table-header>
                  <x-table-header>Waktu Mulai Kelas</x-table-header>
                  <x-table-header>Waktu Selesai Kelas</x-table-header>
                  <x-table-header>Ruangan</x-table-header>
                </x-table-row>
              </x-table-head>
              <x-table-body id="vw-jadwal-tbody">
                <x-table-row>
                  <x-table-cell colspan="4" class="text-center text-gray-400">Belum ada data</x-table-cell>
                </x-table-row>
              </x-table-body>
            </x-table>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
(function(){
  // accordion
  document.addEventListener('click', function(e){
    const t = e.target.closest('[data-acc-toggle]');
    if(!t) return;
    t.closest('.acc-item').classList.toggle('open');
  });

  // modal open/close
  const modal = document.getElementById('modalViewProdi');
  const open = ()=>{ modal.style.display='flex'; document.body.style.overflow='hidden'; };
  const close= ()=>{ modal.style.display='none'; document.body.style.overflow=''; };

  modal.addEventListener('click', (e)=>{ if(e.target.matches('[data-close]')) close(); });
  document.addEventListener('keydown', (e)=>{ if(e.key==='Escape' && modal.style.display==='flex') close(); });

  // render helpers
  const setVal=(id,val='-')=>{ const el=document.getElementById(id); if(el) el.value=(val??'-')||'-'; };
  function renderPengajar(list){
    const tb=document.getElementById('vw-pengajar-tbody');
    if(!Array.isArray(list)||!list.length){
      tb.innerHTML=`<x-table-row><x-table-cell colspan="2" class="text-center text-gray-400">Belum ada data</x-table-cell></x-table-row>`;
      return;
    }
    tb.innerHTML=list.map(p=>{
      const status=(p.status==='utama'||/utama/i.test(p.status))?'Pengajar Utama':'Bukan Pengajar Utama';
      return `<x-table-row><x-table-cell>${p.nama||'-'}</x-table-cell><x-table-cell>${status}</x-table-cell></x-table-row>`;
    }).join('');
  }
  function renderJadwal(list){
    const tb=document.getElementById('vw-jadwal-tbody');
    if(!Array.isArray(list)||!list.length){
      tb.innerHTML=`<x-table-row><x-table-cell colspan="4" class="text-center text-gray-400">Belum ada data</x-table-cell></x-table-row>`;
      return;
    }
    tb.innerHTML=list.map(j=>{
      let mulai=j.mulai||'', selesai=j.selesai||'';
      if(!mulai && typeof j.waktu==='string' && j.waktu.includes('–')){
        const [a,b]=j.waktu.split('–'); mulai=a?.trim(); selesai=b?.trim();
      }
      return `<x-table-row>
          <x-table-cell>${j.hari||'-'}</x-table-cell>
          <x-table-cell>${mulai||'-'}</x-table-cell>
          <x-table-cell>${selesai||'-'}</x-table-cell>
          <x-table-cell>${j.ruang||j.ruangan||'-'}</x-table-cell>
        </x-table-row>`;
    }).join('');
  }

  window.openViewModal=function(data){
    setVal('vw-program_perkuliahan', data.program_perkuliahan || data.programPerkuliahan || '-');
    setVal('vw-program_studi',       data.program_studi || data.programStudi || '-');
    setVal('vw-periode',             data.periode || '-');
    setVal('vw-mata_kuliah',         data.mata_kuliah || data.nama_mata_kuliah || '-');
    setVal('vw-nama_kelas',          data.nama_kelas || '-');
    setVal('vw-nama_singkat',        data.nama_singkat || '-');
    setVal('vw-kapasitas',           data.kapasitas || data.kapasitas_peserta || '-');
    setVal('vw-kelas_mbkm',          (data.kelas_mbkm ?? data.kelas_mkm ?? data.kelas_mkbm) || '-');
    setVal('vw-tanggal_mulai',       data.tanggal_mulai || data.tgl_mulai || '-');
    setVal('vw-tanggal_selesai',     data.tanggal_selesai || data.tgl_selesai || '-');

    renderPengajar(data.pengajar || data.daftar_pengajar || []);
    renderJadwal(data.jadwal || data.daftar_jadwal || []);
    open();
  };

  document.addEventListener('click', async (e)=>{
    const btn=e.target.closest('[data-view-prodi]');
    if(!btn) return;

    const raw=btn.getAttribute('data-detail');
    if(raw){ try{ return openViewModal(JSON.parse(raw)); }catch(_){} }

    const url=btn.getAttribute('data-view-url');
    if(url){
      try{
        const res=await fetch(url,{headers:{'Accept':'application/json'}});
        const json=await res.json();
        return openViewModal(json?.data ?? json);
      }catch(err){ alert('Gagal memuat data view.'); }
    }
  });
})();
</script>
