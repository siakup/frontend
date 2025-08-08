<script>
    document.addEventListener('DOMContentLoaded', function() {
        const eventName = document.querySelector('input[name="name_event"]');
        const tanggalMulai = document.querySelector('input[name="tanggal_mulai"]');
        const tanggalSelesai = document.querySelector('input[name="tanggal_selesai"]');
        let tanggalMulaiInput, tanggalSelesaiInput;

        const sortBtnEventName = document.querySelector('#sortEvent');
        const sortDropdownEventName = document.querySelector('#eventList');

        const btnSave = document.getElementById('btnSimpan');
        const btnSaveConfirmation = document.getElementById('btnYaSimpan');
        const btnCancelConfirmation = document.getElementById('btnCekKembali');
        const form = document.querySelector('#modalAddEvent form');

        function updateSaveButtonState() {
            const eventNameFilled = eventName.value.trim() !== '';
            const startDateFilled = tanggalMulai.value !== '' && (tanggalMulaiInput.selectedDates[0] <
                tanggalSelesaiInput.selectedDates[0]);
            const endDateFilled = tanggalSelesai.value !== '' && (tanggalSelesaiInput.selectedDates[0] >
                tanggalMulaiInput.selectedDates[0]);
            if (eventNameFilled && startDateFilled && endDateFilled) {
                btnSave.disabled = false;
            } else {
                btnSave.disabled = true;
            }
        }

        sortBtnEventName.addEventListener('click', function(e) {
            e.stopPropagation();
            sortDropdownEventName.style.display = (sortDropdownEventName.style.display === 'block') ?
                'none' : 'block';
            sortBtnEventName.querySelector('img').src = (sortBtnEventName.querySelector('img').src ===
                    "{{ asset('assets/icon-arrow-up-black-20.svg') }}") ?
                "{{ asset('assets/icon-arrow-down-grey-20.svg') }}" :
                "{{ asset('assets/icon-arrow-up-black-20.svg') }}";
        });

        document.addEventListener('click', (e) => {
            const dropdownStudy = e.target.closest('#eventNameList');
            if (dropdownStudy == null) {
                sortDropdownEventName.style.display = 'none'
                sortBtnEventName.querySelector('img').src =
                    "{{ asset('assets/icon-arrow-down-grey-20.svg') }}";
            }
        });

        document.querySelectorAll('#eventList .dropdown-item').forEach((dropdownItem) => {
            dropdownItem.addEventListener('click', () => {
                const value = dropdownItem.getAttribute('data-event');
                const span = sortBtnEventName.querySelector('span');

                span.innerHTML = dropdownItem.innerHTML;
                span.style.color = "black";
                eventName.value = value;
                updateSaveButtonState();
            });
        });

        document.getElementById('btnBatal').addEventListener('click', function() {
            document.getElementById('modalAddEvent').style.display = 'none';
        });

        tanggalSelesaiInput = flatpickr("#create-tanggal-akhir", {
            locale: 'id',
            enableTime: true,
            dateFormat: "d-m-Y, H:i",
            time_24hr: true,
            onChange: (selectedDates) => {
                if (selectedDates.length > 0 && tanggalMulaiInput) {
                    tanggalMulaiInput.set('maxDate', selectedDates[0]);
                } else if (tanggalMulaiInput) {
                    tanggalMulaiInput.set('maxDate', null);
                }
            },
        });

        tanggalMulaiInput = flatpickr("#create-tanggal-mulai", {
            locale: 'id',
            enableTime: true,
            dateFormat: "d-m-Y, H:i",
            time_24hr: true,
            onChange: (selectedDates) => {
                if (selectedDates.length > 0 && tanggalSelesaiInput) {
                    tanggalSelesaiInput.set('minDate', selectedDates[0]);
                } else if (tanggalSelesaiInput) {
                    tanggalSelesaiInput.set('minDate', null);
                }
            },
        });

        tanggalMulai.addEventListener('change', () => {
            updateSaveButtonState();
        });

        tanggalSelesai.addEventListener('change', () => {
            updateSaveButtonState();
        });

        btnSave.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('modalAddEvent').style.display = 'none';
            document.getElementById('modalKonfirmasiSimpan').style.display = 'flex';
        });

        btnSaveConfirmation.addEventListener('click', function() {
            form.submit();
        });

        btnCancelConfirmation.addEventListener('click', function() {
            document.getElementById('modalKonfirmasiSimpan').style.display = 'none';
            document.getElementById('modalAddEvent').style.display = 'flex';
        });
    });
</script>
<div id="modalAddEvent" class="modal-custom" style="display:none;">
    <div class="modal-custom-backdrop"></div>
    <form action="{{ route('calendar.store', ['id' => $id]) }}" method="POST">
        @csrf
        <input type="hidden" name="id_program" value="{{$id_program}}">
        <input type="hidden" name="id_prodi" value="{{$id_prodi}}">
        <input type="hidden" name="id_periode" value="{{$id_periode}}">
        <div class="modal-custom-content">
            <span class="text-lg-bd">Tambah Event Akademik</span>
            <div class="modal-custom-body">
                <div class="form-group">
                    <label for="name">Nama Event</label>
                    <div class="filter-box" id="eventNameList">
                        <button type="button" class="button-clean input" id="sortEvent">
                            <span id="selectedEventLabel">Pilih Event</span>
                            <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="Filter">
                        </button>
                        <div id="eventList" class="sort-dropdown select" style="display: none;">
                            @foreach ($eventAkademik as $event)
                                <div class="dropdown-item" data-event="{{ $event->id }}">
                                    {{ $event->nama_event }}
                                </div>
                            @endforeach
                        </div>
                        <input type="hidden" value="" name="name_event">
                    </div>
                </div>
                <div class="form-group">
                    <label for="create-tanggal-mulai">Tanggal Mulai</label>
                    <div class="calendar-input">
                        <input type="text" id="create-tanggal-mulai" class="form-control" name="tanggal_mulai"
                            value="" placeholder="dd-mm-yyyy, hh:mm">
                        <img src="{{ asset('assets/base/icon-calendar.svg') }}" alt="Icon Calendar">
                    </div>
                </div>
                <div class="form-group">
                    <label for="create-tanggal-akhir">Tanggal Selesai</label>
                    <div class="calendar-input">
                        <input type="text" id="create-tanggal-akhir" class="form-control" name="tanggal_selesai"
                            value="" placeholder="dd-mm-yyyy, hh:mm">
                        <img src="{{ asset('assets/base/icon-calendar.svg') }}" alt="Icon Calendar">
                    </div>
                </div>
            </div>
            <div class="modal-custom-footer create-form">
                <button type="button" class="button button-clean" id="btnBatal">Batal</button>
                <button type="submit" class="button button-outline" id="btnSimpan" disabled>Simpan</button>
            </div>
        </div>
    </form>
</div>
<div id="modalKonfirmasiSimpan" class="modal-custom" style="display:none;">
    <div class="modal-custom-backdrop"></div>
    <div class="modal-custom-content">
        <div class="modal-custom-header">
            <span class="text-lg-bd">Tunggu Sebentar</span>
            <img src="{{ asset('assets/base/icon-caution.svg') }}" alt="ikon peringatan">
        </div>
        <div class="modal-custom-body">
            <div>Apakah Anda yakin informasi yang ditambah sudah benar?</div>
        </div>
        <div class="modal-custom-footer">
            <button type="button" class="button button-clean" id="btnCekKembali">Cek Kembali</button>
            <button type="button" class="button button-outline" id="btnYaSimpan">Ya, Simpan Sekarang</button>
        </div>
    </div>
</div>
