<x-layouts.main>
  <x-layouts.content title="Tambah Event Akademik">
    <x-container.wrapper width="full" height="full" cols="1">

      <x-container.container padding="py-4" width="full">
        <x-button.back :href="route('academics-event.index')">Event Akademik</x-button.back>
      </x-container.container>

      <x-container.container padding="p-4" background="content-white" width="full">
        <x-container.wrapper gapY="4" cols="1" class="grid grid-rows-[auto_1fr]" height="fit" width="full">

          <x-container.container width="full">
            <x-typography :variant="'body-medium-bold'">Tambah Event Akademik</x-typography>
          </x-container.container>

          <x-container.container width="full">
            <input type="hidden" id="user_id" value="">
            <x-form.input-container class="" id="name-container">
              <x-slot name="label">Nama Event</x-slot>
              <x-slot name="input">
                <x-container.container  class="flex justify-between w-full !p-0">
                    <input 
                      type="text" 
                      id="name" 
                      class="w-full pe-10 box-border ps-3 border-[1px] border-[#D9D9D9] rounded-md leading-5 h-10" 
                      name="name"
                      value="" 
                      placeholder='Nama Event'
                      oninput="updateSaveButtonState()"
                    />
                </x-container>
              </x-slot>
            </x-form.input-container>
          </x-container.container>

          <x-container.container>
            <x-form.input-container class="" id="flag">
              <x-slot name="label">Flag</x-slot>
              <x-slot name="input">
                <x-container.container class="flex flex-row justify-between py-3 w-full !p-0">
                  <x-form.checklist id="nilai" value="nilai_on" label="Nilai" name="flag[]" />
                  <x-form.checklist id="irs" value="irs_on" label="IRS" name="flag[]" />
                  <x-form.checklist id="lulus" value="lulus_on" label="Lulus" name="flag[]" />
                  <x-form.checklist id="registrasi" value="registrasi_on" label="Registrasi" name="flag[]" />
                  <x-form.checklist id="yudisium" value="yudisium_on" label="Yudisium" name="flag[]" />
                  <x-form.checklist id="survei" value="survei_on" label="Survei" name="flag[]" />
                  <x-form.checklist id="dosen" value="dosen_on" label="Dosen" name="flag[]" />
                </x-container>
              </x-slot>
            </x-form.input-container>
          </x-container.container>

          <x-container.container>
            <x-form.input-container class="" id="status">
              <x-slot name="label">Status</x-slot>
              <x-slot name="input">
                  <x-form.toggle id="statusValue" />
              </x-slot>
            </x-form.input-container>
          </x-container.container>

          <x-container.container width="full" class="justify-end">
            <x-container.wrapper rows="1" cols="2" height="fit" width="max" gapX="4" justify="end">
              
              <x-container.container>      
                <x-button.secondary :href="route('academics-event.index')" class="px-12">Batal</x-button.secondary>
              </x-container.container>

              <x-container.container>
                <x-button.primary
                  onclick="
                    document.getElementById('modalKonfirmasiSimpan').classList.add('flex');
                    document.getElementById('modalKonfirmasiSimpan').classList.remove('hidden');
                  "
                  id="btnSave"
                  class="px-12"
                  
                >
                  Simpan
                </x-button.primary>
              </x-container.container>

            </x-container.wrapper>
          </x-container.container>

        </x-container.wrapper>
      </x-container.container>

    </x-container.wrapper>
      
      <x-modal.container-pure-js id="modalKonfirmasiSimpan">
        <x-slot name="header">
          <x-container.container width="full" class="flex flex-row justify-between items-center !px-0 !ps-5 !gap-0">
            <x-typography variant="body-medium-bold" class="flex-1 text-center">Tunggu Sebentar</x-typography>
            <x-icon name="caution/outline-grey-20" class="w-8 h-8" />
          </x-container>
        </x-slot>
        <x-slot name="body">Apakah Anda yakin informasi yang ditambah sudah benar?</x-slot>
        <x-slot name="footer">
          <x-button.secondary
            onclick="
              document.getElementById('modalKonfirmasiSimpan').classList.add('hidden');
              document.getElementById('modalKonfirmasiSimpan').classList.remove('flex');
            "
          >
            Cek Kembali
          </x-button.secondary>
          <x-button.primary
            onclick="onClickCreateEventAcademic('{{ route('academics-event.store') }}', '{{ route('academics-event.index') }}')"
          >
            Ya, Simpan Sekarang
          </x-button.primary>
        </x-slot>
      </x-modal.container-pure-js>
      
      <script src="{{asset('js/custom/event.js')}}"></script>
  </x-layouts.content>
</x-layouts.main>
