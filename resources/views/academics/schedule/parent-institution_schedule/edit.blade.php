@extends('layouts.main')

@section('title', 'Tambah Jadwal Kuliah Program Studi')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Kurikulum</div>
@endsection

@section('css')
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
@endsection

<script src="{{ asset('js/plugins/flatpckr.js') }}"></script>
<script src="{{ asset('js/plugins/flatpckr-id.js') }}"></script>
<script>
    function onClickShowDropdown(e) {
      e.nextElementSibling.style.display = (e.nextElementSibling.style.display === 'block') ?
          'none' : 'block';
      e.querySelector('img').src = (e.querySelector('img').src ===
              "{{ asset('assets/icon-arrow-up-black-20.svg') }}") ?
          "{{ asset('assets/icon-arrow-down-grey-20.svg') }}" :
          "{{ asset('assets/icon-arrow-up-black-20.svg') }}";
      document.addEventListener('click', (el) => {
        if(!e.nextElementSibling.contains(el.target) && !e.contains(el.target)) {
          e.nextElementSibling.style.display = 'none';
          e.querySelector('img').src = "{{ asset('assets/icon-arrow-down-grey-20.svg') }}"
        }
      })
    }

    function onClickDropdownOption(e) {
      const value = e.getAttribute('data-event');
      const span = e.parentElement.previousElementSibling.querySelector('span');

      span.innerHTML = e.innerHTML;
      span.style.color = "black";
      e.parentElement.nextElementSibling.value = value;
    }

    function onClickDelete(e) {
      e.parentElement.parentElement.parentElement.remove();
    }

    document.addEventListener('DOMContentLoaded', () => {
        const btnToggle   = document.getElementById('toggleButton');
        const icon        = document.getElementById('toggleIcon');
        // const text        = btnToggle.querySelector('.toggle-info');
        const hiddenInput = document.getElementById('statusValue');
        const btnSave     = document.getElementById('btnSimpan');
        const btnConfirm  = document.getElementById('btnYaSimpan');
        const clearButton = document.querySelectorAll('.clear');

        const sksWajib = document.querySelector('input[name="kapasitas_peserta"]');

        function updateSaveButtonState() {
          const programPerkuliahan = document.querySelector('input[name="program_perkuliahan"]').value.trim() !== '';
          const programStudi = document.querySelector('input[name="program_studi"]').value.trim() !== '';
          const periode = document.querySelector('input[name="periode"]').value.trim() !== '';
          const namaMatakuliah = document.querySelector('input[name="nama_matakuliah"]').value.trim() !== '';
          const namaKelas = document.querySelector('input[name="nama_kelas"]').value.trim() !== '';
          const namaSingkat = document.querySelector('input[name="nama_singkat"]').value.trim() !== '';
          const kapasitasPeserta = document.querySelector('input[name="kapasitas_peserta"]').value.trim() !== '';
          const kelasMBKM = document.querySelector('input[name="kelas_mbkm"]').value.trim() !== '';
          const tanggalMulai = document.querySelector('input[name="tanggal_mulai"]').value.trim() !== '';
          const tanggalAkhir = document.querySelector('input[name="tanggal_akhir"]').value.trim() !== '';

          if(programPerkuliahan && programStudi && periode && namaMatakuliah && namaKelas && namaSingkat && kapasitasPeserta && kelasMBKM && tanggalMulai && tanggalAkhir) {
            document.getElementById('btnBatal').disabled = false;
            document.getElementById('btnSimpan').disabled = false;
          } else {
            document.getElementById('btnBatal').disabled = true;
            document.getElementById('btnSimpan').disabled = true;
          }
        }

        updateSaveButtonState();

        sksWajib.addEventListener('input', () => {
          updateSaveButtonState();
          sksWajib.value = sksWajib.value.replace(/[^0-9]/g, '');
          if(sksWajib.value != '') {
            sksWajib.parentElement.querySelector('.clear').classList.remove('hidden');
          } else {
            sksWajib.parentElement.querySelector('.clear').classList.add('hidden');
          }
        });

        Array.from(clearButton).map(btn => {
          btn.addEventListener('click', () => {
            btn.parentElement.querySelector('input').value = '';
            btn.classList.add('hidden');
          })
        })

        btnSave.addEventListener('click', function() {
            document.getElementById('modalKonfirmasiSimpan').style.display = 'block';
        });

        document.getElementById('btnBatal').addEventListener('click', function() {
            window.location.href = "{{ route('academics.schedule.parent-institution-schedule.index') }}";
        });

        // document.getElementById('btnCekKembali').addEventListener('click', function() {
        //     document.getElementById('modalKonfirmasiSimpan').style.display = 'none';
        // });

        const programPerkuliahan = document.querySelector('input[name="program_perkuliahan"]');
        const sortBtnprogramPerkuliahan = document.querySelector('#sortProgramPerkuliahan');
        const sortDropdownprogramPerkuliahan = document.querySelector('#Option-Program-Perkuliahan');

        sortBtnprogramPerkuliahan.addEventListener('click', function(e) {
            e.stopPropagation();
            sortDropdownprogramPerkuliahan.style.display = (sortDropdownprogramPerkuliahan.style.display === 'block') ?
                'none' : 'block';
            sortBtnprogramPerkuliahan.querySelector('img').src = (sortBtnprogramPerkuliahan.querySelector('img').src ===
                    "{{ asset('assets/icon-arrow-up-black-20.svg') }}") ?
                "{{ asset('assets/icon-arrow-down-grey-20.svg') }}" :
                "{{ asset('assets/icon-arrow-up-black-20.svg') }}";
        });

        document.addEventListener('click', (e) => {
            const dropdownStudy = e.target.closest('#program_perkuliahan');
            if (dropdownStudy == null) {
                sortDropdownprogramPerkuliahan.style.display = 'none'
                sortBtnprogramPerkuliahan.querySelector('img').src =
                    "{{ asset('assets/icon-arrow-down-grey-20.svg') }}";
            }
        });

        document.querySelectorAll('#Option-Program-Perkuliahan .dropdown-item').forEach((dropdownItem) => {
            dropdownItem.addEventListener('click', () => {
                const value = dropdownItem.getAttribute('data-event');
                const span = sortBtnprogramPerkuliahan.querySelector('span');

                span.innerHTML = dropdownItem.innerHTML;
                span.style.color = "black";
                programPerkuliahan.value = value;
                updateSaveButtonState();
            });
        });

        const programStudi = document.querySelector('input[name="program_studi"]');
        const sortBtnprogramStudi = document.querySelector('#sortProgramStudi');
        const sortDropdownprogramStudi = document.querySelector('#Option-Program-Studi');

        sortBtnprogramStudi.addEventListener('click', function(e) {
            e.stopPropagation();
            sortDropdownprogramStudi.style.display = (sortDropdownprogramStudi.style.display === 'block') ?
                'none' : 'block';
            sortBtnprogramStudi.querySelector('img').src = (sortBtnprogramStudi.querySelector('img').src ===
                    "{{ asset('assets/icon-arrow-up-black-20.svg') }}") ?
                "{{ asset('assets/icon-arrow-down-grey-20.svg') }}" :
                "{{ asset('assets/icon-arrow-up-black-20.svg') }}";
        });

        document.addEventListener('click', (e) => {
            const dropdownStudy = e.target.closest('#program_perkuliahan');
            if (dropdownStudy == null) {
                sortDropdownprogramStudi.style.display = 'none'
                sortBtnprogramStudi.querySelector('img').src =
                    "{{ asset('assets/icon-arrow-down-grey-20.svg') }}";
            }
        });

        document.querySelectorAll('#Option-Program-Studi .dropdown-item').forEach((dropdownItem) => {
            dropdownItem.addEventListener('click', () => {
                const value = dropdownItem.getAttribute('data-event');
                const span = sortBtnprogramStudi.querySelector('span');

                span.innerHTML = dropdownItem.innerHTML;
                span.style.color = "black";
                programStudi.value = value;
                updateSaveButtonState();
            });
        });

        const periodeList = document.querySelector('input[name="periode"]');
        const sortBtnperiodeList = document.querySelector('#sortPeriode');
        const sortDropdownperiodeList = document.querySelector('#Option-Periode');

        sortBtnperiodeList.addEventListener('click', function(e) {
            e.stopPropagation();
            sortDropdownperiodeList.style.display = (sortDropdownperiodeList.style.display === 'block') ?
                'none' : 'block';
            sortBtnperiodeList.querySelector('img').src = (sortBtnperiodeList.querySelector('img').src ===
                    "{{ asset('assets/icon-arrow-up-black-20.svg') }}") ?
                "{{ asset('assets/icon-arrow-down-grey-20.svg') }}" :
                "{{ asset('assets/icon-arrow-up-black-20.svg') }}";
        });

        document.addEventListener('click', (e) => {
            const dropdownPeriode = e.target.closest('#Option-Periode');
            if (dropdownPeriode == null) {
                sortDropdownperiodeList.style.display = 'none'
                sortBtnperiodeList.querySelector('img').src =
                    "{{ asset('assets/icon-arrow-down-grey-20.svg') }}";
            }
        });

        document.querySelectorAll('#Option-Periode .dropdown-item').forEach((dropdownItem) => {
            dropdownItem.addEventListener('click', () => {
                const value = dropdownItem.getAttribute('data-event');
                const span = sortBtnperiodeList.querySelector('span');

                span.innerHTML = dropdownItem.innerHTML;
                span.style.color = "black";
                periodeList.value = value;
                document.getElementById('chooseCourse').disabled = false;
                updateSaveButtonState();
            });
        });

        const MBKMOption = document.querySelector('input[name="kelas_mbkm"]');
        const sortBtnMBKMOption = document.querySelector('#sortMBKMClass');
        const sortDropdownMBKMOption = document.querySelector('#Option-MBKM-Class');

        sortBtnMBKMOption.addEventListener('click', function(e) {
            e.stopPropagation();
            sortDropdownMBKMOption.style.display = (sortDropdownMBKMOption.style.display === 'block') ?
                'none' : 'block';
            sortBtnMBKMOption.querySelector('img').src = (sortBtnMBKMOption.querySelector('img').src ===
                    "{{ asset('assets/icon-arrow-up-black-20.svg') }}") ?
                "{{ asset('assets/icon-arrow-down-grey-20.svg') }}" :
                "{{ asset('assets/icon-arrow-up-black-20.svg') }}";
        });

        document.addEventListener('click', (e) => {
            const dropdownMBKMClass = e.target.closest('#Option-MBKM-Class');
            if (dropdownMBKMClass == null) {
                sortDropdownMBKMOption.style.display = 'none'
                sortBtnMBKMOption.querySelector('img').src =
                    "{{ asset('assets/icon-arrow-down-grey-20.svg') }}";
            }
        });

        document.querySelectorAll('#Option-MBKM-Class .dropdown-item').forEach((dropdownItem) => {
            dropdownItem.addEventListener('click', () => {
                const value = dropdownItem.getAttribute('data-event');
                const span = sortBtnMBKMOption.querySelector('span');

                span.innerHTML = dropdownItem.innerHTML;
                span.style.color = "black";
                MBKMOption.value = value;
                updateSaveButtonState();
            });
        });

        const tanggalMulai = document.getElementById('tanggal-mulai');
        const tanggalAkhir = document.getElementById('tanggal-akhir');
        let tanggalMulaiInput, tanggalAkhirInput;

        tanggalMulaiInput = flatpickr("#tanggal-mulai", {
            locale: 'id',
            enableTime: true,
            dateFormat: "d-m-Y, H:i",
            time_24hr: true,
            onChange: (selectedDates) => {
                if (selectedDates.length > 0) {
                    tanggalAkhirInput.set('minDate', selectedDates[0]);
                } else {
                    tanggalAkhirInput.set('minDate', null);
                }
            }
        });

        tanggalAkhirInput = flatpickr("#tanggal-akhir", {
            locale: 'id',
            enableTime: true,
            dateFormat: "d-m-Y, H:i",
            time_24hr: true,
            onChange: (selectedDates) => {
                if (selectedDates.length > 0) {
                    tanggalMulaiInput.set('maxDate', selectedDates[0]);
                } else {
                    tanggalMulaiInput.set('maxDate', null);
                }
            }
        });

        tanggalMulai.addEventListener('input', () => {
            updateSaveButtonState();
        });

        tanggalAkhir.addEventListener('input', () => {
            updateSaveButtonState();
        });

        const calendarInput = Array.from(document.getElementsByClassName('calendar-input'));
        calendarInput.map(value => {
            const img = value.querySelector('img');
            const input = value.querySelector('input');
            value.addEventListener('click', () => {
                input.focus();
            });
            input.addEventListener('focus', () => {
                img.src = "{{ asset('assets/active/icon-calendar.svg') }}";
            });
            input.addEventListener('blur', () => {
                img.src = "{{ asset('assets/base/icon-calendar.svg') }}";
            });
        });

        document.getElementById('chooseLecture').addEventListener('click', () => {
          $.ajax({
            url: "{{ route('academics.schedule.prodi-schedule.add-lecture') }}",
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(html) {
              $('#list-lecture').html(html);
              $('#modalListLecture').show();
            },
          });
        });

        document.getElementById('createScheduleClass').addEventListener('click', () => {
          $.ajax({
            url: "{{ route('academics.schedule.prodi-schedule.add-class-schedule') }}",
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(html) {
              $('#add-schedule').html(html);
              $('#modalAddSchedule').show();
            },
          });
        });
    });
</script>
@section('content')
    <div class="page-header">
        <div class="page-title-text">Ubah Jadwal Kuliah Institusi Parent</div>
    </div>
    
    <a href="{{ route('academics.schedule.parent-institution-schedule.index') }}" class="button-no-outline-left">
        <img src="{{ asset('assets/active/icon-arrow-left.svg') }}" alt="Kembali"> Jadwal Kuliah Institusi Parent
    </a>
    <form action="{{route('academics.schedule.parent-institution-schedule.update', ['id' => $id])}}" method="POST">
      @csrf
      @method('PUT')
      <div class="content-card pb-5">
          <div class="form-title-text" style="padding: 20px;">Informasi Kelas</div>
          <div class="form-section">
              <div class="form-group !flex justify-between">
                <div class="form-group w-full">
                  <label for="program_perkuliahan">Program Perkuliahan</label>
                  <div class="filter-box" id="program_perkuliahan">
                      <button type="button" class="button-clean input" id="sortProgramPerkuliahan">
                          <span id="selectedEventLabel" class="text-black">{{$data['program_perkuliahan']}}</span>
                          <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="Filter">
                      </button>
                      <div id="Option-Program-Perkuliahan" class="sort-dropdown select !top-[20%] !left-[15.9%]" style="display: none;">
                          @foreach ($programPerkuliahanList as $programPerkuliahan)
                            <div class="dropdown-item" data-event="{{$programPerkuliahan->name}}">{{$programPerkuliahan->name}}</div>
                          @endforeach
                      </div>
                      <input type="hidden" value="{{$data['program_perkuliahan']}}" name="program_perkuliahan">
                  </div>
                </div>
                <div class="form-group w-full">
                  <label for="program_studi">Program Studi</label>
                  <div class="filter-box" id="program_studi">
                      <button type="button" class="button-clean input" id="sortProgramStudi">
                          <span id="selectedEventLabel" class="text-black">{{current(array_filter($programStudiList, function ($programStudi) use($data) { return $programStudi->id == $data['program_studi']; }))->nama}}</span>
                          <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="Filter">
                      </button>
                      <div id="Option-Program-Studi" class="sort-dropdown select !top-[20%] !left-[64.6%]" style="display: none;">
                          @foreach ($programStudiList as $programStudi)
                            <div class="dropdown-item" data-event="{{$programStudi->id}}">{{$programStudi->nama}}</div>
                          @endforeach
                      </div>
                      <input type="hidden" value="{{$data['program_studi']}}" name="program_studi">
                  </div>
                </div>
              </div>
              <div class="form-group w-full">
                <label for="Periode">Periode</label>
                <div class="filter-box" id="Periode">
                    <button type="button" class="button-clean input" id="sortPeriode">
                        <span id="selectedEventLabel" class="text-black">{{current(array_filter($periodeList, function ($periode) use($data) { return $periode->id == $data['periode']; }))->tahun . '-' . current(array_filter($periodeList, function ($periode) use($data) { return $periode->id == $data['periode']; }))->semester}}</span>
                        <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="Filter">
                    </button>
                    <div id="Option-Periode" class="sort-dropdown select !left-[15.9%] !top-[32.2%]" style="display: none;">
                        @foreach ($periodeList as $periode)
                          <div class="dropdown-item" data-event="{{$periode->id}}">{{$periode->tahun . '-' . $periode->semester}}</div>
                        @endforeach
                    </div>
                    <input type="hidden" value="{{$data['periode']}}" name="periode">
                </div>
              </div>
              <div class="form-group !flex justify-between items-center">
                <div class="form-group items-center w-full">
                  <label for="Course-Name">Nama Mata Kuliah</label>
                  <div class="flex items-center border-[1px] border-[#D9D9D9] rounded-lg px-[12px] !bg-[#F5F5F5]">
                      <input placeholder="Pilih Mata Kuliah" name="nama_matakuliah" type="text" id="Class-Name" class="!border-transparent focus:outline-none !bg-[#F5F5F5]" value="{{$data['nama_matakuliah']}}" readonly>
                      <input placeholder="Pilih Mata Kuliah" name="matakuliah[jenis_matakuliah]" type="hidden" value="{{$data['matakuliah']['jenis_matakuliah']}}">
                      <input placeholder="Pilih Mata Kuliah" name="matakuliah[sks]" type="hidden" value="{{$data['matakuliah']['sks']}}">
                      <input placeholder="Pilih Mata Kuliah" name="matakuliah[kurikulum]" type="hidden" value="{{$data['matakuliah']['kurikulum']}}">
                      <input placeholder="Pilih Mata Kuliah" name="matakuliah[kode_matakuliah]" type="hidden" value={{$data['matakuliah']['kode_matakuliah']}}>
                      <input placeholder="Pilih Mata Kuliah" name="matakuliah[id]" type="hidden" value="{{$data['matakuliah']['id']}}">
                      <img class="clear hidden" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
                  </div>
                </div>
              </div>
              <div class="form-group">
                  <label for="Class-Name">Nama Kelas</label>
                  <div class="flex items-center border-[1px] border-[#D9D9D9] rounded-lg px-[12px]">
                      <input placeholder="Masukan Nama Kelas. Contoh: Makroekonomi-EC2" name="nama_kelas" value="{{$data['nama_kelas']}}" type="text" id="Class-Name" class="!border-transparent focus:outline-none" value="">
                      <img class="clear hidden" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
                  </div>
              </div>
              <div class="form-group">
                  <label for="Slug-Class-Name">Nama Singkat</label>
                  <div class="flex items-center border-[1px] border-[#D9D9D9] rounded-lg px-[12px]">
                      <input placeholder="Masukan Nama Singkat. Contoh: EC2" name="nama_singkat" type="text" id="Slug-Class-Name" class="!border-transparent focus:outline-none" value="{{$data['nama_singkat']}}">
                      <img class="clear hidden" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
                  </div>
              </div>
              <div class="form-group !flex justify-between">
                <div class="form-group w-full">
                  <label for="Participant-Capacity">Kapasitas Peserta</label>
                  <div class="flex items-center border-[1px] border-[#D9D9D9] rounded-lg px-[12px]">
                      <input placeholder="Masukkan Kapasitas. Contoh: 50" name="kapasitas_peserta" type="text" id="Participant-Capacity" class="!border-transparent focus:outline-none" value="{{$data['kapasitas_peserta']}}">
                      <img class="clear hidden" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
                  </div>
                </div>
                <div class="form-group w-full">
                  <label for="mbkm-class">Kelas MBKM</label>
                  <div class="filter-box" id="program_studi">
                      <button type="button" class="button-clean input" id="sortMBKMClass">
                          <span id="selectedEventLabel" class="text-black">{{$data['kelas_mbkm'] ? "Ya" : "Tidak"}}</span>
                          <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="Filter">
                      </button>
                      <div id="Option-MBKM-Class" class="sort-dropdown select !top-[82.6%] !left-[64.6%]" style="display: none;">
                        <div class="dropdown-item" data-event="true">Ya</div>
                        <div class="dropdown-item" data-event="false">Tidak</div>
                      </div>
                      <input type="hidden" value="{{$data['kelas_mbkm'] ? "true" : "false"}}" name="kelas_mbkm">
                  </div>
                </div>
              </div>
              <div class="form-group !flex justify-between">
                <div class="form-group w-full">
                    <label for="tanggal-mulai">Tanggal Mulai</label>
                    <div class="calendar-input">
                        <input type="text" id="tanggal-mulai" class="form-control" name="tanggal_mulai"
                            value="{{$data['tanggal_mulai']}}" placeholder="dd-mm-yyyy, hh:mm">
                        <img src="{{ asset('assets/base/icon-calendar.svg') }}" alt="Icon Calendar">
                    </div>
                </div>
                <div class="form-group w-full">
                    <label for="tanggal-akhir">Tanggal Berakhir</label>
                    <div class="calendar-input">
                        <input type="text" id="tanggal-akhir" class="form-control" name="tanggal_akhir"
                            value="{{$data['tanggal_akhir']}}" placeholder="dd-mm-yyyy, hh:mm">
                        <img src="{{ asset('assets/base/icon-calendar.svg') }}" alt="Icon Calendar">
                    </div>
                </div>
              </div>
          </div>
      </div>
      <div class="content-card pb-5">
          <div class="form-title-text flex items-center justify-between" style="padding: 20px;">
            <p>Daftar Pengajar</p>
            <button type="button" class="button button-outline min-w-max" id="chooseLecture">
              <span>Tambah Pengajar</span>
            </button>
          </div>
          <div class="flex flex-col gap-5 mt-5 px-4">
              <x-table id="selected-lecture">
                <x-table-head>
                  <x-table-row>
                    <x-table-header>Nama Pengajar</x-table-header>
                    <x-table-header>Status Pengajar</x-table-header>
                    <x-table-header>Aksi</x-table-header>
                  </x-table-row>
                </x-table-head>
                <x-table-body>
                  @forelse($data['selected_lecture'] as $key => $lecture)
                  <input type="hidden" name="selected_lecture[{{$key}}]['id']" value="{{$lecture['id']}}" />
                  <input type="hidden" name="selected_lecture[{{$key}}]['nama_pengajar']" value="{{$lecture['nama_pengajar']}}" />
                  <input type="hidden" name="selected_lecture[{{$key}}]['pengajar_program_studi']" value="{{$lecture['pengajar_program_studi']}}" />
                  <x-table-row>
                    <x-table-cell>{{$lecture['nama_pengajar']}}</x-table-cell>
                    <x-table-cell>
                      <div class="filter-box" class="status-pengajar">
                          <button type="button" class="button-clean input" id="sortProgramPerkuliahan" onclick="onClickShowDropdown(this)">
                              <span id="selectedEventLabel" class="text-black">{{$lecture['status_pengajar']}}</span>
                              <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="Filter">
                          </button>
                          <div id="Option-Status-Pengajar" class="sort-dropdown select !static" style="display: none;">
                            <div class="dropdown-item" data-event="Pengajar Utama" onclick="onClickDropdownOption(this)">Pengajar Utama</div>
                            <div class="dropdown-item" data-event="Bukan Pengajar Utama" onclick="onClickDropdownOption(this)">Bukan Pengajar Utama</div>
                          </div>
                          <input type="hidden" value="{{$lecture['status_pengajar']}}" name="selected_lecture[{{$key}}]['status_pengajar']">
                      </div>
                    </x-table-cell>
                    <x-table-cell>
                      <div class="center flex items-center w-full justify-center">
                        <button type="button" onclick="onClickDelete(this)" class="btn-icon btn-delete !flex !items-center !justify-center gap-1" title="Hapus" >
                          <img src="{{ asset('assets/icon-delete-gray-600.svg') }}" alt="Hapus">
                          <span class="text-[#8C8C8C]">Hapus</span>
                        </button>
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
      <div class="content-card pb-5">
          <div class="form-title-text flex items-center justify-between" style="padding: 20px;">
            <p>Daftar Jadwal Kelas</p>
            <button type="button" href="" class="button button-outline min-w-max" id="createScheduleClass">
              <span>Tambah Jadwal Kelas</span>
            </button>
          </div>
          <div class="flex flex-col gap-5 mt-5 px-4">
              <x-table id="class-schedule">
                <x-table-head>
                  <x-table-row>
                    <x-table-header>Hari</x-table-header>
                    <x-table-header>Waktu Mulai Kelas</x-table-header>
                    <x-table-header>Waktu Selesai Kelas</x-table-header>
                    <x-table-header>Ruangan</x-table-header>
                    <x-table-header>Aksi</x-table-header>
                  </x-table-row>
                </x-table-head>
                <x-table-body>
                  @forelse($data['class_schedule'] as $key => $class_schedule)
                  <x-table-row>
                    <x-table-cell>{{$class_schedule['hari']}}</x-table-cell>
                    <x-table-cell>{{$class_schedule['jam_mulai_kelas']}}</x-table-cell>
                    <x-table-cell>{{$class_schedule['jam_akhir_kelas']}}</x-table-cell>
                    <x-table-cell>{{$class_schedule['ruangan']}}</x-table-cell>
                    <x-table-cell>
                      <input type="hidden" name="class_schedule[{{$key}}]['hari']" value="{{$class_schedule['hari']}}" />
                      <input type="hidden" name="class_schedule[{{$key}}]['ruangan']" value="{{$class_schedule['ruangan']}}" />
                      <input type="hidden" name="class_schedule[{{$key}}]['jam_mulai_kelas']" value="{{$class_schedule['jam_mulai_kelas']}}" />
                      <input type="hidden" name="class_schedule[{{$key}}]['jam_akhir_kelas']" value="{{$class_schedule['jam_akhir_kelas']}}" />
                      <div class="center flex items-center w-full justify-center">
                        <button type="button" onclick="onClickDelete(this)" class="btn-icon btn-delete !flex !items-center !justify-center gap-1" title="Hapus" >
                          <img src="{{ asset('assets/icon-delete-gray-600.svg') }}" alt="Hapus">
                          <span class="text-[#8C8C8C]">Hapus</span>
                        </button>
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
      <div class="content-card">
        <div class="button-group self-end">
            <button type="button" class="button button-clean disabled:!bg-white disabled:!border-[#D9D9D9] disabled:!border-1 min-w-[151px] min-h-[40px]" id="btnBatal" disabled>Batal</button>
            <button type="button" class="button button-outline min-w-[151px] min-h-[40px]" id="btnSimpan" disabled>Simpan</button>
        </div>
      </div>
      @include('partials.modal', [
        'modalId' => 'modalKonfirmasiSimpan',
        'modalTitle' => 'Tunggu Sebentar',
        'modalIcon' => asset('assets/base/icon-caution.svg'),
        'modalMessage' => 'Apakah Anda yakin informasi yang ditambah sudah benar?',
        'triggerButton' => 'btnSimpan',
        'cancelButtonLabel' => 'Cek Kembali',
        'actionButtonLabel' => 'Ya, Simpan Sekarang'
      ])
    </form>
    <div id="list-lecture"></div>
    <div id="add-schedule"></div>
@endsection