<link rel="stylesheet" href="{{ asset('css/plugins/flatpckr.css') }}" />
<style>
  .table {
    color: black;
  }
    .form-section {
        display: flex;
        flex-direction: column;
        gap: 32px;
    }

    .modal-custom {
        position: fixed;
        inset: -120px;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0,0,0,0.25); 
    }

    .modal-custom-content {
        position: relative;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.12);
        width: 65vw;
        min-width: 340px;
        /* max-width: 600px; */
        margin: 0 auto;
        margin-top: 10%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        align-self: stretch;
    }

    .modal-custom-backdrop {
        position: fixed;
        inset: 0;
        z-index: 1;
        display: none;
    }

    .modal-custom-body {
        padding: 20px 12px 12px 20px;
        width: 100%;
        box-sizing: border-box;
    }

    .modal-custom-header {
        border-radius: 12px 12px 0px 0px;
        border: 1px solid var(--Surface-Border-Primary, #D9D9D9);
        background: var(--Neutral-gray-50, #FFF);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        align-self: stretch;
    }

    .modal-close-btn {
        position: absolute;
        top: 16px;
        right: 20px;
        background: none;
        border: none;
        font-size: 2rem;
        color: #888;
        cursor: pointer;
        z-index: 10;
        transition: color 0.2s;
    }

    .modal-close-btn:hover {
        color: #e74c3c;
    }
    .modal-custom-header {
        position: relative;
    }

    .form-group {
        display: grid;
        grid-template-columns: 180px 1fr;
        align-items: center;
        margin-bottom: 0;
    }

    .checkbox-group {
        display: flex;
        flex-wrap: wrap;
        gap: 40px 32px; /* row-gap column-gap */
        width: 100%;
        margin: 0;
        padding: 0;
        align-items: center;
        box-sizing: border-box;
    }

    .checkbox-form {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    #toggleButton {
        width: max-content !important;
    }

    .button-group {
        display: flex;
        gap: 20px;
        justify-content: flex-end;
        margin: 20px;
    }

    .checkbox-form label {
        width: max-content;
        font-weight: 400;
    }

    .checkbox-form input {
        accent-color: #E62129;
        border-radius: 3px;
    }

    .checkbox-form input[type="checkbox"]:not(:checked) {
        accent-color: #BFBFBF;
    }

    .checkbox-form input[type="checkbox"]:not(:checked) + label {
        color: #8C8C8C;
    }

    .button-group{
        display: flex;
        gap: 20px;
        justify-content: flex-end;
        margin: 20px;
    }

    .button{
        padding: 8px 54.5px;
        margin: 0px;"
    }

    button.input {
        border: 1px solid #D9D9D9;
        color: #D9D9D9;
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }

    .btn-toggle {
        display: flex;
        align-items: center;
        gap: 12px;
        background: none;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 0;
        width: auto; 
    }

    .modal-custom-footer {
        display: flex;
        justify-content: center;
        gap: 24px;
        width: 100%;
        padding: 0 20px 24px 20px;
        box-sizing: border-box;
    }

    .modal-custom-footer .button {
        min-width: 220px;
        padding: 14px 0;
    }

    .form-group input[readonly]#tanggal-mulai,
    .form-group input[readonly]#tanggal-akhir {
        background: transparent !important;
        outline: none;
        border: none;
        width: 200px;
        color: #262626;
    }

    .form-group input[readonly] {
        background: white;
        color: #262626;
    }

    /* Custom tanggal terpilih */
    .flatpickr-day.selected,
    .flatpickr-day.startRange,
    .flatpickr-day.endRange {
        background-color: #dc2626 !important;
        /* merah */
        color: #fff !important;
        border-radius: 12px !important;
    }

    /* Hover efek */
    .flatpickr-day:hover {
        background-color: #fecaca !important;
        /* merah muda */
        color: #dc2626 !important;
    }

    /* Styling jam & menit */
    .flatpickr-time input {
        border-radius: 8px !important;
        color: #dc2626 !important;
        padding: 4px;
        font-weight: bold;
    }

    .flatpickr-time-separator {
        text-align: center;
    }

    /* Style dropdown jam & menit fokus */
    .flatpickr-time input:focus {
        outline: none;
        box-shadow: 0 0 3px #dc2626;
    }

    /* Style container jam & menit */
    .flatpickr-time {
        border-top: 1px solid #eee;
    }

    .calendar-input {
        border: 1px solid #BFBFBF !important;
        display: flex !important;
        align-items: center !important;
        padding: 5px;
        padding-right: 10px;
        border-radius: 8px;
        color: #262626;
    }
</style>

<script src="{{ asset('js/plugins/flatpckr.js') }}"></script>
<script src="{{ asset('js/plugins/flatpckr-id.js') }}"></script>
<script>
    function onClickShowDetail(e) {
      const sibling = e.nextElementSibling;
      sibling.classList.toggle('!max-h-[999px]');
      sibling.classList.toggle('!max-h-0')
      e.querySelector('img').classList.toggle('rotate-180');
      e.querySelector('img').classList.toggle('rotate-0');
    }
</script>
<div id="modalViewParentInstitutionSchedule" class="modal-custom" style="display: block">
  <div class="modal-custom-backdrop"></div>
  <div class="modal-custom-content !h-[80vh] !max-w-[80vw] overflow-scroll self-center">
    <div class="modal-custom-header">
        <span class="text-lg-bd">Lihat Jadwal Kuliah Program Studi</span>
        <button type="button" class="modal-close-btn" onclick="document.getElementById('modalViewParentInstitutionSchedule').remove();document.getElementById('view-schedule').innerHTML=''">
            &times;
        </button>
    </div>
    <div class="modal-custom-body">
      <div class="content-card !border-none pb-5">
            <div class="form-title-text flex items-center justify-between cursor-pointer" style="padding: 20px;" onclick="onClickShowDetail(this)">
              <p>Informasi Kelas</p>
              <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="Filter" class="rotate-0 transition-transform duration-500 ease-in-out">
            </div>
            <div class="form-section !max-h-[999px] h-max overflow-hidden transition-[max-height] duration-500 ease-in-out">
                <div class="form-group !flex justify-between">
                  <div class="form-group w-full">
                    <label for="program_perkuliahan">Program Perkuliahan</label>
                    <div class="filter-box" id="program_perkuliahan">
                        <button type="button" class="button-clean input !bg-[#F5F5F5] !text-[#8C8C8C]" id="sortProgramPerkuliahan">
                            <span id="selectedEventLabel" class="!bg-[#F5F5F5] !text-[#8C8C8C]">{{$data->perkuliahan}}</span>
                            <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="Filter">
                        </button>
                        <div id="Option-Program-Perkuliahan" class="sort-dropdown select !top-[20%] !left-[15.9%]" style="display: none;">
                            @foreach ($programPerkuliahanList as $programPerkuliahan)
                              <div class="dropdown-item" data-event="{{$programPerkuliahan->name}}">{{$programPerkuliahan->name}}</div>
                            @endforeach
                        </div>
                        <input type="hidden" value="{{$data->perkuliahan}}" name="program_perkuliahan">
                    </div>
                  </div>
                  <div class="form-group w-full">
                    <label for="program_studi">Program Studi</label>
                    <div class="filter-box" id="program_studi">
                        <button type="button" class="button-clean input !bg-[#F5F5F5] !text-[#8C8C8C]" id="sortProgramStudi">
                            <span id="selectedEventLabel" class="!bg-[#F5F5F5] !text-[#8C8C8C]">{{current(array_filter($programStudiList, function ($programStudi) use($data) { return $programStudi->id == $data->id_prodi; }))->nama}}</span>
                            <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="Filter">
                        </button>
                        <div id="Option-Program-Studi" class="sort-dropdown select !top-[20%] !left-[64.6%]" style="display: none;">
                            @foreach ($programStudiList as $programStudi)
                              <div class="dropdown-item" data-event="{{$programStudi->id}}">{{$programStudi->nama}}</div>
                            @endforeach
                        </div>
                        <input type="hidden" value="{{$data->id_prodi}}" name="program_studi">
                    </div>
                  </div>
                </div>
                <div class="form-group w-full">
                  <label for="Periode">Periode</label>
                  <div class="filter-box" id="Periode">
                      <button type="button" class="button-clean input !bg-[#F5F5F5] !text-[#8C8C8C]" id="sortPeriode">
                          <span id="selectedEventLabel" class="!bg-[#F5F5F5] !text-[#8C8C8C]">{{current(array_filter($periodeList, function ($periode) use($data) { return $periode->id == $data->id_periode_akademik; }))->tahun . '-' . current(array_filter($periodeList, function ($periode) use($data) { return $periode->id == $data->id_periode_akademik; }))->semester}}</span>
                          <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="Filter">
                      </button>
                      <div id="Option-Periode" class="sort-dropdown select !left-[15.9%] !top-[32.2%]" style="display: none;">
                          @foreach ($periodeList as $periode)
                            <div class="dropdown-item" data-event="{{$periode->id}}">{{$periode->tahun . '-' . $periode->semester}}</div>
                          @endforeach
                      </div>
                      <input type="hidden" value="{{$data->id_periode_akademik}}" name="periode">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Course-Name">Nama Mata Kuliah</label>
                  <div class="flex items-center border-[1px] border-[#BFBFBF] rounded-lg px-[12px] !bg-[#F5F5F5]">
                      <input placeholder="Pilih Mata Kuliah" name="nama_matakuliah" type="text" id="Class-Name" class="!border-transparent focus:outline-none !bg-[#F5F5F5] !text-[#8C8C8C]" value="{{$data->nama_matakuliah}}" readonly>
                      <img class="clear hidden" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
                  </div>
                </div>
                <div class="form-group">
                    <label for="Class-Name">Nama Kelas</label>
                    <div class="flex items-center border-[1px] border-[#BFBFBF] bg-[#F5F5F5] rounded-lg px-[12px]">
                        <input placeholder="Masukan Nama Kelas. Contoh: Makroekonomi-EC2" name="nama_kelas" value="{{$data->nama_jadwal}}" type="text" id="Class-Name" class="!border-transparent focus:outline-none !bg-[#F5F5F5] !text-[#8C8C8C]" value="" readonly>
                        <img class="clear hidden" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Slug-Class-Name">Nama Singkat</label>
                    <div class="flex items-center border-[1px] border-[#BFBFBF] bg-[#F5F5F5] rounded-lg px-[12px]">
                        <input placeholder="Masukan Nama Singkat. Contoh: EC2" name="nama_singkat" type="text" id="Slug-Class-Name" class="!border-transparent focus:outline-none !bg-[#F5F5F5] !text-[#8C8C8C]" value="{{$data->singkatan_jadwal}}" readonly>
                        <img class="clear hidden" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
                    </div>
                </div>
                <div class="form-group !flex justify-between">
                  <div class="form-group w-full">
                    <label for="Participant-Capacity">Kapasitas Peserta</label>
                    <div class="flex items-center border-[1px] border-[#BFBFBF] bg-[#F5F5F5] rounded-lg px-[12px]">
                        <input placeholder="Masukkan Kapasitas. Contoh: 50" name="kapasitas_peserta" type="text" id="Participant-Capacity" class="!border-transparent focus:outline-none !bg-[#F5F5F5] !text-[#8C8C8C]" value="{{$data->jumlah_peserta}}" readonly>
                        <img class="clear hidden" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
                    </div>
                  </div>
                  <div class="form-group w-full">
                    <label for="mbkm-class">Kelas MBKM</label>
                    <div class="filter-box" id="program_studi">
                        <button type="button" class="button-clean input !bg-[#F5F5F5] !text-[#8C8C8C]" id="sortMBKMClass">
                            <span id="selectedEventLabel" class="!bg-[#F5F5F5] !text-[#8C8C8C]">{{$data->is_mbkm ? "Ya" : "Tidak"}}</span>
                            <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="Filter">
                        </button>
                        <div id="Option-MBKM-Class" class="sort-dropdown select !top-[82.6%] !left-[64.6%]" style="display: none;">
                          <div class="dropdown-item" data-event="true">Ya</div>
                          <div class="dropdown-item" data-event="false">Tidak</div>
                        </div>
                        <input type="hidden" value="{{$data->is_mbkm ? "true" : "false"}}" name="kelas_mbkm">
                    </div>
                  </div>
                </div>
                <div class="form-group !flex justify-between">
                  <div class="form-group w-full">
                      <label for="tanggal-mulai">Tanggal Mulai</label>
                      <div class="calendar-input !bg-[#F5F5F5] !text-[#8C8C8C]">
                          <input type="text" id="tanggal-mulai" class="form-control !bg-[#F5F5F5] !text-[#8C8C8C] !border-none" name="tanggal_mulai"
                              value="{{date("d-m-Y, H:i", strtotime($data->tanggal_mulai))}}" placeholder="dd-mm-yyyy, hh:mm">
                          <img src="{{ asset('assets/base/icon-calendar.svg') }}" alt="Icon Calendar">
                      </div>
                  </div>
                  <div class="form-group w-full">
                      <label for="tanggal-akhir">Tanggal Berakhir</label>
                      <div class="calendar-input !bg-[#F5F5F5] !text-[#8C8C8C]">
                          <input type="text" id="tanggal-akhir" class="form-control !bg-[#F5F5F5] !text-[#8C8C8C] !border-none" name="tanggal_akhir"
                              value="{{date("d-m-Y, H:i", strtotime($data->tanggal_akhir))}}" placeholder="dd-mm-yyyy, hh:mm">
                          <img src="{{ asset('assets/base/icon-calendar.svg') }}" alt="Icon Calendar">
                      </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="w-full h-[1px] bg-[#262626]"></div>
        <div class="content-card !border-none pb-5">
          <div class="form-title-text flex items-center justify-between cursor-pointer" style="padding: 20px;" onclick="onClickShowDetail(this)">
            <p>Daftar Pengajar</p>
            <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="Filter" class="rotate-180 transition-transform duration-500 ease-in-out">
          </div>
          <div class="flex flex-col gap-5 mt-5 px-4 !max-h-0 h-max overflow-hidden transition-[max-height] duration-500 ease-in-out">
              <x-table id="selected-lecture">
                <x-table-head>
                  <x-table-row>
                    <x-table-header>Nama Pengajar</x-table-header>
                    <x-table-header>Status Pengajar</x-table-header>
                  </x-table-row>
                </x-table-head>
                <x-table-body>
                  @forelse($data->lecturerSchedule as $key => $lecture)
                  <input type="hidden" name="selected_lecture[{{$key}}]['id']" value="{{$lecture->id_pengajar}}" />
                  <input type="hidden" name="selected_lecture[{{$key}}]['nama_pengajar']" value="{{$lecture->nama_pengajar}}" />
                  {{-- <input type="hidden" name="selected_lecture[{{$key}}]['pengajar_program_studi']" value="{{$lecture['status_pengajar']}}" /> --}}
                  <x-table-row>
                    <x-table-cell>{{$lecture->nama_pengajar}}</x-table-cell>
                    <x-table-cell>
                      <div class="filter-box" class="status-pengajar">
                          <button type="button" class="button-clean input !bg-[#F5F5F5] !text-[#8C8C8C]" id="sortProgramPerkuliahan">
                              <span id="selectedEventLabel" class="!bg-[#F5F5F5] !text-[#8C8C8C]">{{$lecture->status_pengajar}}</span>
                              <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="Filter">
                          </button>
                          <div id="Option-Status-Pengajar" class="sort-dropdown select !static" style="display: none;">
                            <div class="dropdown-item" data-event="Pengajar Utama">Pengajar Utama</div>
                            <div class="dropdown-item" data-event="Bukan Pengajar Utama">Bukan Pengajar Utama</div>
                          </div>
                          <input type="hidden" value="{{$lecture->status_pengajar}}" name="selected_lecture[{{$key}}]['status_pengajar']">
                      </div>
                    </x-table-cell>
                  </x-table-row>
                  @empty
                    @include('academics.periode.error-filter')
                  @endforelse
                </x-table-body>
              </x-table>
          </div>
      </div>
      <div class="w-full h-[1px] bg-[#262626]"></div>
      <div class="content-card !border-none pb-5">
          <div class="form-title-text flex items-center justify-between cursor-pointer" style="padding: 20px;" onclick="onClickShowDetail(this)">
            <p>Daftar Jadwal Kelas</p>
            <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="Filter" class="rotate-180 transition-transform duration-500 ease-in-out">
          </div>
          <div class="flex flex-col gap-5 mt-5 px-4 !max-h-0 h-max overflow-hidden transition-[max-height] duration-500 ease-in-out">
              <x-table id="class-schedule">
                <x-table-head>
                  <x-table-row>
                    <x-table-header>Hari</x-table-header>
                    <x-table-header>Waktu Mulai Kelas</x-table-header>
                    <x-table-header>Waktu Selesai Kelas</x-table-header>
                    <x-table-header>Ruangan</x-table-header>
                  </x-table-row>
                </x-table-head>
                <x-table-body>
                  @forelse($data->classSchedule as $key => $class_schedule)
                  <x-table-row>
                    <x-table-cell>{{$class_schedule->hari}}</x-table-cell>
                    <x-table-cell>{{date("H:i", strtotime($class_schedule->mulai_kelas))}}</x-table-cell>
                    <x-table-cell>{{date("H:i", strtotime($class_schedule->selesai_kelas))}}</x-table-cell>
                    <x-table-cell>{{$class_schedule->nama_ruangan}}</x-table-cell>
                  </x-table-row>
                  @empty
                    @include('academics.periode.error-filter')
                  @endforelse
                </x-table-body>
              </x-table>
          </div>
      </div>
    </div>
  </div>
</div>