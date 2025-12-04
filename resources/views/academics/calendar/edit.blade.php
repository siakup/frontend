<script src="{{ asset('js/custom/calendar-academic.js')}}"></script>

<form action="{{route('calendar.update', ['id' => $id])}}" method="POST">
  @csrf
  @method('PUT')
  <x-modal.container-pure-js id="modalEditEvent">
    <x-slot name="header">
      <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Ubah Kalender Event Akademik</x-typography>
    </x-slot>
    <x-slot name="body">
      <x-form.input-container class="min-w-[120px]">
        <x-slot name="label">Nama Event</x-slot>
        <x-slot name="input">
          <x-form.dropdown 
            :buttonId="'sortEvent'"
            :dropdownId="'eventList'"
            :label="'Pilih Event'"
            :imgSrc="asset('assets/base/icon-arrow-down.svg')"
            :isIconCanRotate="true"
            :dropdownItem="array_column($eventAkademik, 'id', 'nama_event')"
            :buttonStyleClass="'!border-[#D9D9D9] hover:!bg-[#D9D9D9] !text-black w-full flex items-center justify-between flex-1'"
            :dropdownContainerClass="'w-full'"
            :isUsedForInputField="true"
            :inputFieldName="'name_event'"
          />
          <input type="hidden" value="" name="name_event">
          <input type="hidden" value="" name="status">
          <input type="hidden" value="" name="id_calendar">
        </x-slot>
      </x-form.input-container>
      <x-form.input-container class="min-w-[120px]">
        <x-slot name="label">Tanggal Mulai</x-slot>
        <x-slot name="input">
          <x-form.calendar id="tanggal-mulai" name="tanggal_mulai" oninput="updateSaveButtonState(document.getElementById('modalEditEvent'), editTanggalMulaiInput, editTanggalSelesaiInput)" />
        </x-slot>
      </x-form.input-container>
      <x-form.input-container class="min-w-[120px]">
        <x-slot name="label">Tanggal Selesai</x-slot>
        <x-slot name="input">
          <x-form.calendar id="tanggal-akhir" name="tanggal_selesai" oninput="updateSaveButtonState(document.getElementById('modalEditEvent'), editTanggalMulaiInput, editTanggalSelesaiInput)" />
        </x-slot>
      </x-form.input-container>
    </x-slot>
    <x-slot name="footer">
      <x-button.secondary 
        onclick="
          document.getElementById('modalEditEvent').classList.add('hidden');
          document.getElementById('modalEditEvent').classList.remove('flex');
        "
      >
        Batal
      </x-button.secondary>
      <x-button.primary 
        onclick="
          document.querySelector('#modalKonfirmasiEdit').classList.add('flex');
          document.querySelector('#modalKonfirmasiEdit').classList.remove('hidden');
          document.querySelector('#modalEditEvent').classList.add('hidden');
          document.querySelector('#modalEditEvent').classList.remove('flex');
        " 
        disabled 
        id="btnSimpan"
      >
        Simpan
      </x-button.primary>
    </x-slot>
  </x-modal.container-pure-js>
  <x-modal.container-pure-js id="modalKonfirmasiEdit">
    <x-slot name="header">
      <x-container.container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
        <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Tunggu Sebentar</x-typography>
        <x-icon :iconUrl="asset('assets/icon-caution.svg')" :class="'w-8 h-8'" />
      </x-container>
    </x-slot>
    <x-slot name="body">Apakah Anda yakin informasi yang ditambah sudah benar?</x-slot>
    <x-slot name="footer">
      <x-button.secondary 
        onclick="
          document.querySelector('#modalEditEvent').classList.add('flex');
          document.querySelector('#modalEditEvent').classList.remove('hidden');
          document.querySelector('#modalKonfirmasiEdit').classList.add('hidden');
          document.querySelector('#modalKonfirmasiEdit').classList.remove('flex');
        "
      >
        Cek Kembali
      </x-button.secondary>
      <x-button.primary type="submit">Ya, Simpan Sekarang</x-button.primary>
    </x-slot>
  </x-modal.container-pure-js>
</form>