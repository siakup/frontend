<script src="{{asset('custom/js/calendar-academic.js')}}"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    initCalendar();
  });
</script>
<form action="{{ route('calendar.store', ['id' => $id]) }}" method="POST">
  @csrf
  <x-modal.container-pure-js id="modalAddEvent">
    <x-slot name="header">
      <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Tambah Kalender Event Akademik</x-typography>
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
            onclick="updateSaveButtonState(document.getElementById('modalAddEvent'), tanggalMulaiInput, tanggalSelesaiInput)"
          />
          <input type="hidden" value="" name="name_event">
          <input type="hidden" value="{{$id_program}}" name="id_program">
          <input type="hidden" value="{{$id_prodi}}" name="id_prodi">
        </x-slot>
      </x-form.input-container>
      <x-form.input-container class="min-w-[120px]">
        <x-slot name="label">Tanggal Mulai</x-slot>
        <x-slot name="input">
          <x-form.calendar id="create-tanggal-mulai" name="tanggal_mulai" oninput="updateSaveButtonState(document.getElementById('modalAddEvent'), tanggalMulaiInput, tanggalSelesaiInput)" />
        </x-slot>
      </x-form.input-container>
      <x-form.input-container class="min-w-[120px]">
        <x-slot name="label">Tanggal Selesai</x-slot>
        <x-slot name="input">
          <x-form.calendar id="create-tanggal-akhir" name="tanggal_selesai" oninput="updateSaveButtonState(document.getElementById('modalAddEvent'), tanggalMulaiInput, tanggalSelesaiInput)" />
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
      <x-container.container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
        <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Tunggu Sebentar</x-typography>
        <x-icon :iconUrl="asset('assets/icon-caution.svg')" :class="'w-8 h-8'" />
      </x-container>
    </x-slot>
    <x-slot name="body">Apakah Anda yakin informasi yang ditambah sudah benar?</x-slot>
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
