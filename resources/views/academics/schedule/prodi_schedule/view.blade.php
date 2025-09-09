<div id="modalViewProdi" class="mkv-modal" style="display:none">
  <div class="mkv-backdrop" data-close></div>

  <div class="mkv-content">
    <div class="mkv-header">
      <div class="mkv-title">Lihat Jadwal Kuliah Program Studi</div>
      <button type="button" class="mkv-close" data-close aria-label="Tutup">
        ✕
      </button>
    </div>

    <div class="mkv-body prodi-view">
      <style>
        /* ——— Modal primitive ——— */
        .mkv-modal{
        position:fixed; inset:0; z-index:9999;
        display:none; align-items:center; justify-content:center;
        background:rgba(0,0,0,.25);
        }
        .mkv-backdrop{ position:absolute; inset:0; }
        .mkv-content{
        position:relative; background:#fff; border-radius:14px;
        box-shadow:0 4px 24px rgba(0,0,0,.12);
        margin:0 16px; width:840px; max-width:90vw;

        /* biar kalau tinggi > viewport masih bisa scroll, tapi scrollbar disembunyikan */
        max-height:90vh; overflow:auto;
        -ms-overflow-style:none;            /* IE/Edge lama */
        scrollbar-width:none;               /* Firefox */
        }
        .mkv-content::-webkit-scrollbar{ display:none; }  /* Chrome/Safari */

        .mkv-header{
        position:sticky; top:0; z-index:1;           /* header tetap terlihat saat scroll isi */
        display:flex; align-items:center; justify-content:space-between;
        padding:14px 16px; border-bottom:1px solid #F1F5F9; background:#fff;
        padding-bottom:0px;
        }
        .mkv-title{ font-weight:600; font-size:20px; color:#111827;text-align:center; width: 100% }
        .mkv-close{
        width:32px; height:32px; border-radius:8px;
        display:grid; place-items:center; cursor:pointer;
        border:1px solid #E5E7EB; background:#fff; color:#111827;
        }
        .mkv-close:hover{ background:#F9FAFB; }

        /* ——— View styles ——— */
        .prodi-view{padding:16px}
        /* Judul header accordion */
        .prodi-view .acc-head{ font-size:14px; }
        .prodi-view .acc-head .acc-title{
        font-weight:600; color:#111827 !important;   /* paksa tampil */
        }
        .prodi-view .acc-head .acc-right{
        display:flex; align-items:center; gap:8px;
        }
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
        .prodi-view .chev{transition:transform .2s ease}
        .prodi-view .acc-item.open .chev{transform:rotate(180deg)}
        @media(max-width:992px){ .prodi-view .grid-3{grid-template-columns:120px 1fr} .prodi-view .span-2{grid-column:2 / span 1} }
      </style>

      <div class="accordion">
        {{-- INFORMASI KELAS --}}
        <div class="acc-item open" data-acc="info">
            <button class="acc-head" type="button" data-acc-toggle="info">
            <span class="acc-title">Informasi Kelas</span>
            <div class="acc-right">
                <img class="chev" src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="">
            </div>
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

        {{-- DAFTAR PENGAJAR --}}
        <div class="acc-item" data-acc="pengajar">
            <button class="acc-head" type="button" data-acc-toggle="pengajar">
            <span class="acc-title">Daftar Pengajar</span>
            <div class="acc-right">
                <img class="chev" src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="">
            </div>
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

        {{-- DAFTAR JADWAL KELAS --}}
        <div class="acc-item" data-acc="jadwal">
            <button class="acc-head" type="button" data-acc-toggle="jadwal">
            <span class="acc-title">Daftar Jadwal Kelas</span>
            <div class="acc-right">
                <img class="chev" src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="">
            </div>
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
  // ——— Accordion toggle
  document.addEventListener('click', function(e){
    const t = e.target.closest('[data-acc-toggle]');
    if(!t) return;
    t.closest('.acc-item').classList.toggle('open');
  });

  // ——— Modal control
  const modal = document.getElementById('modalViewProdi');
  const open  = ()=>{ modal.style.display='flex'; document.body.style.overflow='hidden'; };
  const close = ()=>{ modal.style.display='none'; document.body.style.overflow=''; };
  modal.addEventListener('click', (e)=>{ if(e.target.matches('[data-close]')) close(); });
  document.addEventListener('keydown', (e)=>{ if(e.key==='Escape' && modal.style.display==='flex') close(); });

  // ——— Helpers render
  const setVal=(id,val='-')=>{ const el=document.getElementById(id); if(el) el.value=((val??'')+'').trim()||'-'; };

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
      if(!mulai && (j.waktu||'').match(/–|-/)){
        const [a,b]=(j.waktu||'').split(/–|-/); mulai=a?.trim(); selesai=b?.trim();
      }
      return `<x-table-row>
        <x-table-cell>${j.hari||'-'}</x-table-cell>
        <x-table-cell>${mulai||'-'}</x-table-cell>
        <x-table-cell>${selesai||'-'}</x-table-cell>
        <x-table-cell>${j.ruang||j.ruangan||'-'}</x-table-cell>
      </x-table-row>`;
    }).join('');
  }

  // ——— API utama yang dipanggil dari index: openViewModal(ID | DATA)
  const SHOW_URL_TMPL = @json(route('academics.schedule.prodi-schedule.show', ['id' => '__ID__']));

window.openViewModal = async function(arg){
  try{
    let data = null, url = null;

    if (typeof arg === 'string') {
      url = arg; // sudah full dari blade
    } else if (typeof arg === 'number' || /^[0-9]+$/.test(String(arg))) {
      // fallback kalau masih kirim ID
      url = SHOW_URL_TMPL.replace('__ID__', String(arg));
    } else if (typeof arg === 'object') {
      data = arg; // payload langsung
    }

    if (!data) {
      // pastikan absolute URL (bukan relatif)
      if (!/^https?:\/\//.test(url)) {
        url = window.location.origin + (url.startsWith('/') ? '' : '/') + url;
      }
      const res = await fetch(url, { headers: { 'Accept':'application/json' } });
      const text = await res.text();
      try { data = JSON.parse(text); } catch(e){
        console.error('Response bukan JSON:\n', text);
        throw e;
      }
      if (data && data.data) data = data.data;
    }

    // ... lanjut isi field seperti sebelumnya
    setVal('vw-program_perkuliahan', data.program_perkuliahan || data.programPerkuliahan);
    setVal('vw-program_studi',       data.program_studi || data.programStudi);
    setVal('vw-periode',             data.periode);
    setVal('vw-mata_kuliah',         data.mata_kuliah || data.nama_mata_kuliah);
    setVal('vw-nama_kelas',          data.nama_kelas);
    setVal('vw-nama_singkat',        data.nama_singkat);
    setVal('vw-kapasitas',           data.kapasitas || data.kapasitas_peserta);
    setVal('vw-kelas_mbkm',          (data.kelas_mbkm ?? data.kelas_mkm ?? data.kelas_mkbm));
    setVal('vw-tanggal_mulai',       data.tanggal_mulai || data.tgl_mulai);
    setVal('vw-tanggal_selesai',     data.tanggal_selesai || data.tgl_selesai);

    renderPengajar(data.pengajar || data.daftar_pengajar || []);
    renderJadwal(data.jadwal || data.daftar_jadwal || []);

    // buka modal
    document.getElementById('modalViewProdi').style.display='flex';
    document.body.style.overflow='hidden';
  }catch(err){
    console.error(err);
    alert('Gagal memuat data jadwal.');
  }
};
})();
</script>
