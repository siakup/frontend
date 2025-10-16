<script>
  let tanggalMulaiInput, tanggalSelesaiInput;
  document.addEventListener('DOMContentLoaded', () => {
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
  })

  function updateSaveButtonState() {
    const eventName = document.querySelector('input[name="name_event"]');
    const tanggalMulai = document.querySelector('input[name="tanggal_mulai"]');
    const tanggalSelesai = document.querySelector('input[name="tanggal_selesai"]');
    const btnSave = document.getElementById('btnSimpan');

    const eventNameFilled = eventName.value.trim() !== '';
    const startDateFilled = tanggalMulai.value !== '' && (tanggalMulaiInput.selectedDates[0] < tanggalSelesaiInput.selectedDates[0]);
    const endDateFilled = tanggalSelesai.value !== '' && (tanggalSelesaiInput.selectedDates[0] > tanggalMulaiInput.selectedDates[0]);

    if (eventNameFilled && startDateFilled && endDateFilled) {
        btnSave.disabled = false;
    } else {
        btnSave.disabled = true;
    }
  }
</script>

<form action="{{ route('calendar.store', ['id' => $id]) }}" method="POST">
  @csrf
  <x-modal.container-pure-js id="modalAddEvent">
    <x-slot name="header">
      <span class="text-lg-bd">Tambah Event Akademik</span>
    </x-slot>
    <x-slot name="body">
      <x-form.input-container>
        <x-slot name="label">Nama Event</x-slot>
        <x-slot name="input">
          <x-form.dropdown 
            :buttonId="'sortEvent'"
            :dropdownId="'eventList'"
            :label="'Pilih Event'"
            :imgSrc="asset('assets/base/icon-arrow-down.svg')"
            :isIconCanRotate="true"
            :dropdownItem="array_column($eventAkademik, 'id', 'nama_event')"
            :buttonStyleClass="'!border-[#D9D9D9] hover:!bg-[#D9D9D9] !text-black'"
            :isUsedForInputField="true"
            :inputFieldName="'name_event'"
            onclick="updateSaveButtonState()"
          />
          <input type="hidden" value="" name="name_event">
          <input type="hidden" value="" name="status">
          <input type="hidden" value="" name="id_calendar">
        </x-slot>
      </x-form.input-container>
      <x-form.input-container>
        <x-slot name="label">Tanggal Mulai</x-slot>
        <x-slot name="input">
          <x-form.calendar id="create-tanggal-mulai" name="tanggal_mulai" oninput="updateSaveButtonState()" />
        </x-slot>
      </x-form.input-container>
      <x-form.input-container>
        <x-slot name="label">Tanggal Selesai</x-slot>
        <x-slot name="input">
          <x-form.calendar id="create-tanggal-akhir" name="tanggal_selesai" oninput="updateSaveButtonState()" />
        </x-slot>
      </x-form.input-container>
    </x-slot>
    <x-slot name="footer">
      <x-button.secondary 
        onclick="
          document.getElementById('modalAddEvent').classList.add('hidden');
          document.getElementById('modalAddEvent').classList.remove('flex');
        "
      >
        Batal
      </x-button.secondary>
      <x-button.primary 
        onclick="
          document.querySelector('#modalKonfirmasiSimpan-addEvent').classList.add('flex');
          document.querySelector('#modalKonfirmasiSimpan-addEvent').classList.remove('hidden');
          document.querySelector('#modalAddEvent').classList.add('hidden');
          document.querySelector('#modalAddEvent').classList.remove('flex');
        " 
        disabled 
        id="btnSimpan"
      >
        Simpan
      </x-button.primary>
    </x-slot>
  </x-modal.container-pure-js>
  <x-modal.container-pure-js id="modalKonfirmasiSimpan-addEvent">
    <x-slot name="header">
      <span class="text-lg-bd">Tunggul Sebentar</span>
      <img src="{{asset('assets/base/icon-caution.svg')}}" alt="ikon peringatan" />
    </x-slot>
    <x-slot name="body">
      Apakah Anda yakin informasi yang ditambah sudah benar?
    </x-slot>
    <x-slot name="footer">
      <x-button.secondary 
        onclick="
          document.getElementById('modalKonfirmasiSimpan-addEvent').classList.add('hidden');
          document.getElementById('modalKonfirmasiSimpan-addEvent').classList.remove('flex');
          document.getElementById('modalAddEvent').classList.add('flex');
          document.getElementById('modalAddEvent').classList.remove('hidden');
        "
      >
        Cek Kembali
      </x-button.secondary>
      <x-button.primary 
        type="submit"
      >
        Ya, Simpan Sekarang
      </x-button.primary>
    </x-slot>
  </x-modal.container-pure-js>
</form>
