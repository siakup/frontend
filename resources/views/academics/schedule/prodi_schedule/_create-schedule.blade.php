<script src="{{ asset('js/component-helpers/api.js')}}"></script>
<script src="{{ asset('js/properties/clock.js')}}"></script>

<div
  x-data="createScheduleListComponents('{{ route('academics.schedule.prodi-schedule.available-rooms') }}')"
  x-effect="getAvailableRooms"
>
  <x-modal.container-pure-js id="modalAddSchedule">
    <x-slot name="header">
      <x-container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
        <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Tambah Jadwal Kelas</x-typography>
        <x-button.base
            onclick="document.getElementById('modalAddSchedule').remove();
            document.getElementById('add-schedule').innerHTML=''"
            :class="'scale-150'"
        >
            &times;
        </x-button.base>
      </x-container>
    </x-slot>
    <x-slot name="body">
      <x-container 
        :variant="'content-wrapper'" 
        class="flex flex-col gap-4 !p-0"
      >
        <x-form.input-container :class="'min-w-[170px]'">
          <x-slot name="label">Hari</x-slot>
          <x-slot name="input">
            <x-form.dropdown 
              :buttonId="'sortDay'"
              :dropdownId="'dayList'"
              :label="'Pilih Hari'"
              :imgSrc="asset('assets/base/icon-arrow-down.svg')"
              :isIconCanRotate="true"
              :dropdownItem="[
                'Senin' => 'Senin',
                'Selasa' => 'Selasa',
                'Rabu' => 'Rabu',
                'Kamis' => 'Kamis',
                'Jumat' => 'Jumat',
                'Sabtu' => 'Sabtu',
                'Minggu' => 'Minggu',
              ]"
              :buttonStyleClass="'!border-[#D9D9D9] hover:!bg-[#D9D9D9] !text-black !w-full flex items-center justify-between flex-1'"
              :dropdownContainerClass="'!w-full'"
              :isUsedForInputField="true"
              :inputFieldName="'hari'"
              onclick=""
              x-model="hari"
            />
          </x-slot>
        </x-form.input-container>
        <x-form.input-container class="min-w-[170px]" id="jam_mulai">
          <x-slot name="label">Jam Mulai Kelas</x-slot>
          <x-slot name="input">
            <x-form.calendar id="jam-mulai" name="jam_mulai_kelas" x-model="jam_mulai" oninput="" :placeholder="'hh:ii'" />
          </x-slot>
        </x-form.input-container>
        <x-form.input-container class="min-w-[170px]" id="jam_selesai">
          <x-slot name="label">Jam Akhir Kelas</x-slot>
          <x-slot name="input">
            <x-form.calendar id="jam-akhir" name="jam_akhir_kelas" x-model="jam_akhir" oninput="" :placeholder="'hh:ii'" />
          </x-slot>
        </x-form.input-container>
        <x-form.input-container :class="'min-w-[170px]'">
          <x-slot name="label">Ruangan</x-slot>
          <x-slot name="input">
            <x-form.dropdown 
              :buttonId="'sortRooms'"
              :dropdownId="'roomList'"
              :label="'Pilih Ruangan'"
              :imgSrc="asset('assets/base/icon-arrow-down.svg')"
              :isIconCanRotate="true"
              :buttonStyleClass="'!border-[#D9D9D9] hover:!bg-[#D9D9D9] !text-black !w-full flex items-center justify-between flex-1'"
              :dropdownContainerClass="'!w-full'"
              :isUsedForInputField="true"
              :inputFieldName="'ruangan'"
              x-model="ruangan"
              x-data="{ options: null }"
              x-init="$watch('listRuangan', value => options = {...listRuangan})"
            />
          </x-slot>
        </x-form.input-container>
      </x-container>
    </x-slot>
    <x-slot name="footer">
      <x-button.secondary
        onclick="document.getElementById('modalAddSchedule').remove();document.getElementById('add-schedule').innerHTML=''"
        x-bind:disabled="checkScheduleValidity"
      >
        Batal
      </x-button.secondary>
      <x-button.primary x-on:click="addSchedule" x-bind:disabled="checkScheduleValidity">Tambahkan Jadwal</x-button.primary>
    </x-slot>
  </x-modal.container-pure-js>
</div>