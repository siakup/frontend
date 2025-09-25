<style>
    .modal-custom {
        position: fixed;
        inset: -120px;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, 0.25);
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

    .modal-custom-content {
        position: relative;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.12);
        width: 80vw;
        min-width: 340px;
        /* max-width: 600px; */
        margin: 0 auto;
        margin-top: 10%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        align-self: stretch;
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

    .form-group input[readonly],
    .form-group textarea[readonly] {
        background: var(--Background-Disable-White, #F5F5F5);
        color: var(--Neutral-Gray-600, #8C8C8C);
        cursor: not-allowed;
        opacity: 1;
    }

    .modal-divider {
        width: calc(100% + 32px);
        height: 1px;
        background: #E5E6E8;
        margin: 24px 0 18px 0;
        border: none;
        position: relative;
        left: -20px;
    }

    .checkbox-group {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: repeat(3, 1fr);
        row-gap: 12px;
        column-gap: 32px;
        justify-items: flex-start;
        padding-top: 12px;
        padding-bottom: 12px;

    }

    .checkbox-group .checkbox-form {
        display: flex;
        gap: 8px;
    }

    .checkbox-group .checkbox-form label {
        font-weight: 400;
        font-size: 14px;
        color: #8C8C8C;
        width: max-content;
    }

    .toggle-info {
        font-weight: 600;
        font-size: 14px;
        color: #8C8C8C;
    }

    .modal-custom-body {
        text-align: start;
        padding-top: 0px;
        padding-bottom: 0px;
    }

    .flag-label {
        align-items: start;
        margin-top: 20px;
    }

    .flag-label .checkbox-group {
        padding-top: 0px;
    }
</style>

<script>
    function loadAvailableRooms() {
        const hari = document.querySelector('input[name="hari"]').value;
        const jamMulai = document.querySelector('input[name="jam_mulai_kelas"]').value;
        const jamSelesai = document.querySelector('input[name="jam_akhir_kelas"]').value;

        if (!hari || !jamMulai || !jamSelesai) {
            errorToast("Isi Hari, Jam Mulai Kelas dan Jam Akhir Kelas terlebih dahulu");
            return;
        }

        $.ajax({
            url: "{{ route('academics.schedule.prodi-schedule.available-rooms') }}",
            method: "GET",
            data: {
                hari: hari,
                jam_mulai: jamMulai,
                jam_selesai: jamSelesai
            },
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                const dropdown = $("#Option-Ruangan");
                dropdown.html("");

                if (response.success && response.data.length > 0) {
                    response.data.forEach(r => {
                        dropdown.append(`
                        <div class="dropdown-item text-black"
                             data-event="${r.id_ruangan}"
                             onclick="onClickDropdownOption(this)">
                            ${r.nama_ruangan}
                        </div>
                    `);
                    });
                } else {
                    dropdown.html(`<div class="dropdown-item text-black">Tidak ada ruangan tersedia</div>`);
                }
            },
            error: function() {
                errorToast("Gagal mengambil data ruangan");
            }
        });
    }

    function updateSaveScheduleButtonState() {
        const hari = document.querySelector('input[name="hari"]').value.trim() !== '';
        const ruangan = document.querySelector('input[name="ruangan"]').value.trim() !== '';
        const jamMulai = document.querySelector('input[name="jam_mulai_kelas"]').value.trim() !== '';
        const jamSelesai = document.querySelector('input[name="jam_akhir_kelas"]').value.trim() !== '';

        if (hari && ruangan && jamMulai && jamSelesai) {
            document.querySelector('#btnBatalJadwal').disabled = false;
            document.querySelector('#btnSimpanJadwal').disabled = false;
        } else {
            document.querySelector('#btnBatalJadwal').disabled = true;
            document.querySelector('#btnSimpanJadwal').disabled = true;
        }
    }

    function onClickDeleteSchedule(e) {
        e.parentElement.parentElement.parentElement.remove();
    }

    function onClickSaveSchedule(e) {
        const hari = document.querySelector('input[name="hari"]').value;
        const ruangan = document.querySelector('input[name="ruangan"]').value;
        const jamMulai = document.querySelector('input[name="jam_mulai_kelas"]').value;
        const jamSelesai = document.querySelector('input[name="jam_akhir_kelas"]').value;

        const classSchedule = document.getElementById('class-schedule').querySelector('tbody');
        const classScheduleBefore = classSchedule.querySelectorAll('tr');
        const newClassSchedule = `<tr class="${Array.from(classScheduleBefore).length % 2 == 0 ? 'bg-white' : 'bg-[#F5F5F5]'} border-b-0">
      <input type="hidden" name="class_schedule[${Array.from(classScheduleBefore).length}]['hari']" value="${hari}" />
      <input type="hidden" name="class_schedule[${Array.from(classScheduleBefore).length}]['ruangan']" value="${ruangan}" />
      <input type="hidden" name="class_schedule[${Array.from(classScheduleBefore).length}]['jam_mulai_kelas']" value="${jamMulai}" />
      <input type="hidden" name="class_schedule[${Array.from(classScheduleBefore).length}]['jam_akhir_kelas']" value="${jamSelesai}" />
      <td class="px-6 py-[24px] text-center align-middle text-sm text-[#262626] border-b border-r border-[#d9d9d9] last:border-r-0">${hari}</td>
      <td class="px-6 py-[24px] text-center align-middle text-sm text-[#262626] border-b border-r border-[#d9d9d9] last:border-r-0">${jamMulai}</td>
      <td class="px-6 py-[24px] text-center align-middle text-sm text-[#262626] border-b border-r border-[#d9d9d9] last:border-r-0">${jamSelesai}</td>
      <td class="px-6 py-[24px] text-center align-middle text-sm text-[#262626] border-b border-r border-[#d9d9d9] last:border-r-0">${ruangan}</td>
      <td class="px-6 py-[24px] text-center align-middle text-sm text-[#262626] border-b border-r border-[#d9d9d9] last:border-r-0">
        <div class="center flex items-center w-full justify-center">
          <button type="button" onclick="onClickDeleteSchedule(this)" class="btn-icon btn-delete !flex !items-center !justify-center gap-1" title="Hapus" >
            <img src="{{ asset('assets/icon-delete-gray-600.svg') }}" alt="Hapus">
            <span class="text-[#8C8C8C]">Hapus</span>
          </button>
        </div>
      </td>
    </tr>`;
        classSchedule.innerHTML = classSchedule.innerHTML + newClassSchedule;
        document.getElementById('modalAddSchedule').remove();
        document.getElementById('add-schedule').innerHTML = ''
        successToast("Berhasil Menambahkan Jadwal Kuliah");
    }

    function onClickDropdownButton(ev, e) {
        ev.stopPropagation();
        e.nextElementSibling.style.display = (e.nextElementSibling.style.display === 'block') ?
            'none' : 'block';
        e.querySelector('img').src = (e.querySelector('img').src ===
                "{{ asset('assets/icon-arrow-up-black-20.svg') }}") ?
            "{{ asset('assets/icon-arrow-down-grey-20.svg') }}" :
            "{{ asset('assets/icon-arrow-up-black-20.svg') }}";
    }

    function onClickDropdownOption(e) {
        const value = e.getAttribute('data-event');
        const span = e.parentElement.previousElementSibling.querySelector('span');
        const input = e.parentElement.nextElementSibling;

        span.innerHTML = e.innerHTML;
        span.style.color = "black";
        input.value = value;
        updateSaveScheduleButtonState();
    }

    document.addEventListener('click', (e) => {
        const sortBtnHariOption = document.querySelector('#sortHari');
        const sortDropdownHariOption = document.querySelector('#Option-Hari');
        const dropdownHari = e.target.closest('#Option-Hari');
        if (dropdownHari == null) {
            sortDropdownHariOption.style.display = 'none'
            sortBtnHariOption.querySelector('img').src =
                "{{ asset('assets/icon-arrow-down-grey-20.svg') }}";
        }
    });

    document.addEventListener('click', (e) => {
        const dropdownHari = e.target.closest('#Option-Ruangan');
        const sortBtnRuanganOption = document.querySelector('#sortRuangan');
        const sortDropdownRuanganOption = document.querySelector('#Option-Ruangan');
        if (dropdownHari == null) {
            sortDropdownRuanganOption.style.display = 'none'
            sortBtnRuanganOption.querySelector('img').src =
                "{{ asset('assets/icon-arrow-down-grey-20.svg') }}";
        }
    });

    function onClickInputDateTimeInput(e) {
        e.querySelector('input').focus();
    }

    function onFocusDateTimeInput(e) {
        const img = e.nextElementSibling;
        img.src = "{{ asset('assets/active/icon-calendar.svg') }}";
    }

    function onBlurDateTimeInput(e) {
        const img = e.nextElementSibling;
        img.src = "{{ asset('assets/base/icon-calendar.svg') }}";
    }

    var jamMulai = document.getElementById('jam-mulai');
    var jamAkhir = document.getElementById('jam-akhir');
    var jamMulaiInput, jamAkhirInput;

    jamMulaiInput = flatpickr("#jam-mulai", {
        enableTime: true,
        dateFormat: "H:i",
        time_24hr: true,
        noCalendar: true,
        onChange: (selectedTime) => {
            if (selectedTime.length > 0) {
                jamAkhirInput.set('minDate', selectedTime[0]);
            } else {
                jamAkhirInput.set('minDate', null);
            }
        }
    });

    jamAkhirInput = flatpickr("#jam-akhir", {
        enableTime: true,
        dateFormat: "H:i",
        time_24hr: true,
        noCalendar: true,
        onChange: (selectedTime) => {
            if (selectedTime.length > 0) {
                jamMulaiInput.set('maxDate', selectedTime[0]);
            } else {
                jamMulaiInput.set('maxDate', null);
            }
        }
    });

    jamMulai.addEventListener('change', () => {
        updateSaveScheduleButtonState();
    });

    jamAkhir.addEventListener('change', () => {
        updateSaveScheduleButtonState();
    });
</script>

<div id="modalAddSchedule" class="modal-custom" style="display:block;">
    <div class="modal-custom-backdrop"></div>
    <div class="modal-custom-content !w-[50vw] !min-h-[50vh] h-max overflow-scroll self-center">
        <div class="modal-custom-header">
            <span class="text-lg-bd">Tambah Jadwal Kelas</span>
            <button type="button" class="modal-close-btn"
                onclick="document.getElementById('modalAddSchedule').remove();document.getElementById('add-schedule').innerHTML=''">
                &times;
            </button>
        </div>
        <div class="modal-custom-body">
            <div class="form-section">
                <div class="form-group w-full">
                    <label for="Select-Hari">Hari</label>
                    <div class="filter-box relative" id="Periode">
                        <button type="button" class="button-clean input" id="sortHari"
                            onclick="onClickDropdownButton(event, this)">
                            <span id="selectedEventLabel">-Pilih Hari-</span>
                            <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="Filter">
                        </button>
                        <div id="Option-Hari" class="sort-dropdown select !left-0 !top-[42px] z-999"
                            style="display: none;">
                            <div class="dropdown-item text-black" data-event="Senin"
                                onclick="onClickDropdownOption(this)">Senin</div>
                            <div class="dropdown-item text-black" data-event="Selasa"
                                onclick="onClickDropdownOption(this)">Selasa</div>
                            <div class="dropdown-item text-black" data-event="Rabu"
                                onclick="onClickDropdownOption(this)">Rabu</div>
                            <div class="dropdown-item text-black" data-event="Kamis"
                                onclick="onClickDropdownOption(this)">Kamis</div>
                            <div class="dropdown-item text-black" data-event="Jumat"
                                onclick="onClickDropdownOption(this)">Jumat</div>
                            <div class="dropdown-item text-black" data-event="Sabtu"
                                onclick="onClickDropdownOption(this)">Sabtu</div>
                            <div class="dropdown-item text-black" data-event="Minggu"
                                onclick="onClickDropdownOption(this)">Minggu</div>
                        </div>
                        <input type="hidden" value="" name="hari">
                    </div>
                </div>

                <div class="form-group w-full">
                    <label for="jam-mulai">Jam Mulai Kelas</label>
                    <div class="border-[1px] border-[#BFBFBF] rounded-lg flex items-center justify-between px-[12px] py-[9px] text-black"
                        onclick="onClickInputDateTimeInput(this)">
                        <input type="text" name="jam_mulai_kelas"
                            class="!bg-transparent !border-none !outline-none !text-black" id="jam-mulai"
                            onfocus="onFocusDateTimeInput(this)" onblur="onBlurDateTimeInput(this)" placeholder="hh:mm">
                        <img src="{{ asset('assets/base/icon-calendar.svg') }}" alt="Icon Calendar">
                    </div>
                </div>

                <div class="form-group w-full">
                    <label for="jam-akhir">Jam Akhir Kelas</label>
                    <div class="border-[1px] border-[#BFBFBF] rounded-lg flex items-center justify-between px-[12px] py-[9px] text-black"
                        onclick="onClickInputDateTimeInput(this)">
                        <input type="text" name="jam_akhir_kelas"
                            class="!bg-transparent !border-none !outline-none !text-black" id="jam-akhir"
                            onfocus="onFocusDateTimeInput(this)" onblur="onBlurDateTimeInput(this)" placeholder="hh:mm">
                        <img src="{{ asset('assets/base/icon-calendar.svg') }}" alt="Icon Calendar">
                    </div>
                </div>

                <div class="form-group w-full">
                    <label for="Select-Ruangan">Ruangan</label>
                    <div class="filter-box relative" id="Ruangan">
                        <button type="button" class="button-clean input" id="sortRuangan"
                            onclick="loadAvailableRooms(); onClickDropdownButton(event, this)">
                            <span id="selectedEventLabel">-Pilih Ruangan-</span>
                            <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="Filter">
                        </button>

                        <div id="Option-Ruangan" class="sort-dropdown select !left-0 !top-[42px] z-999"
                            style="display: none;">
                            @foreach ($ruangans as $ruangan)
                                <div class="dropdown-item text-black" data-event="{{ $ruangan['id_ruangan'] }}"
                                    onclick="onClickDropdownOption(this)">{{ $ruangan['nama_ruangan'] }}</div>
                            @endforeach
                        </div>
                        <input type="hidden" value="" name="ruangan">
                    </div>
                </div>
            </div>
            <div class="button-group self-end">
                <button type="button"
                    class="button button-clean disabled:!bg-white disabled:!border-[#D9D9D9] disabled:!border-1 min-w-[151px] min-h-[40px]"
                    id="btnBatalJadwal"
                    onclick="document.getElementById('modalAddSchedule').remove();document.getElementById('add-schedule').innerHTML=''"
                    disabled>Batal</button>
                <button type="button" class="button button-outline min-w-[151px] min-h-[40px]" id="btnSimpanJadwal"
                    onclick="onClickSaveSchedule(this)" disabled>Tambahkan Jadwal</button>
            </div>
        </div>
    </div>
</div>
