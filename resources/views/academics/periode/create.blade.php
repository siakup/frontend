<x-layouts.main>
  <x-layouts.content title="Tambah Periode Akademik">
      @section('css')
          <link rel="stylesheet" href="{{ asset('css/plugins/flatpckr.css') }}" />
      @endsection
      
      @section('javascript')
        <script src="{{ asset('js/plugins/flatpckr.js') }}"></script>
        <script src="{{ asset('js/plugins/flatpckr-id.js') }}"></script>
      @endsection
      <x-container.wrapper cols="1" height="full" width="full">

        <x-container.container padding="p-4">
          <x-button.back :href="route('academics-periode.index')">Periode Akademik</x-button.back>
          <form action="{{ route('academics-periode.store') }}" method="POST">
            @csrf
        </x-container.container>

        <x-container.container background="content-white" padding="p-4" class="">
          <x-container.wrapper gapY="4" cols="1" class="grid grid-rows-[auto_1fr]" height="fit" width="full">

            <x-container.container>
              <x-typography variant="body-medium-bold">Buat Periode Akademik</x-typography>
            </x-container.container>

            <x-container.container class="" width="full">
              <input type="hidden" id="user_id" value="" />
              <x-form.input-container class="" id="year">
                <x-slot name="label">Tahun</x-slot>
                <x-slot name="input">
                  <x-form.year
                    :id="'Year-Input'"
                    :name="'year'"
                    onclick="
                      const value = this.getAttribute('data-year');
                      document.getElementById('tahun_akademik').value = `${value}/${+value + 1}`;
                      updateNewStateButton()
                    "
                  />
                </x-slot>
              </x-form.input-container>
            </x-container.container>

            <x-container.container class="">
              <x-form.input-container class="" id="semester">
                <x-slot name="label">Semester</x-slot>
                <x-slot name="input">
                  <x-form.checkbox 
                    :name="'semester'"
                    onchange="updateNewStateButton()"
                    :options="[
                      ['label' => 'Ganjil','value' => 1],
                      ['label' => 'Genap','value' => 2],
                      ['label' => 'Pendek','value' => 3],
                    ]"
                    
                  />
                </x-slot>
              </x-form.input-container>
            </x-container.container>

            <x-container.container class="">
              <x-form.input-container class="" id="tahun_akademik">
                <x-slot name="label">Tahun Akademik</x-slot>
                <x-slot name="input">
                  <x-container.container class="flex justify-between w-full !p-0">
                    <input 
                      type="text" 
                      id="tahun_akademik" 
                      class="w-full pe-10 box-border ps-3 border-[1px] border-[#D9D9D9] rounded-md leading-5 h-10" 
                      readonly 
                      name="tahun_akademik"
                      value="" 
                      placeholder='Auto Fill (Tahun yang dipilih +"/"+ Tahun berikutnya)'
                    />
                  </x-container>
                </x-slot>
              </x-form.input-container>
            </x-container.container>

            <x-container.container class="">
              <x-container.wrapper rows="1" cols="2" height="fit" width="full">

                <x-container.container class="">
                  <x-form.input-container class="" id="tanggal_mulai" :fullWidth="false">
                    <x-slot name="label">Tanggal Mulai</x-slot>
                    <x-slot name="input">
                      <x-form.calendar id="tanggal-mulai" name="tanggal_mulai" oninput="updateNewStateButton()" />
                    </x-slot>
                  </x-form.input-container>
                </x-container.container>

                <x-container.container class="">
                  <x-form.input-container class="" id="tanggal_akhir" :fullWidth="false" :half="true">
                    <x-slot name="label" class="">Tanggal Berakhir</x-slot>
                    <x-slot name="input">
                      <x-form.calendar id="tanggal-akhir" name="tanggal_akhir" oninput="updateNewStateButton()" />
                    </x-slot>
                  </x-form.input-container>
                </x-container.container>

              </x-container.wrapper>
            </x-container.container>

            <x-container.container class="">
              <x-form.input-container class="" id="semester">
                <x-slot name="label">Deskripsi</x-slot>
                <x-slot name="input">
                  <x-form.textarea
                    :placeholder="'Tulis deskripsi disini'"
                    :id="'deskripsi'"
                    :maxChar="280"
                    oninput="updateNewStateButton()"
                  />
                </x-slot>
              </x-form.input-container>
            </x-container.container>

            <x-container.container>
            <x-form.input-container class="" id="status">
              <x-slot name="label">Status</x-slot>
              <x-slot name="input">
                  <x-form.toggle id="academic-periode-status" />
              </x-slot>
            </x-form.input-container>
          </x-container.container>

            <x-container.container class="justify-end" width="full">
              <x-container.wrapper rows="1" cols="2" height="fit" width="max" gapX="4" justify="end">

                <x-container.container class="" width="full">
                  <x-button.secondary :href="route('academics-periode.index')" class="px-12">Batal</x-button.secondary>
                </x-container.container>

                <x-container.container class="" width="full">
                  <x-button.primary 
                    onclick="
                      document.getElementById('modalKonfirmasiSimpan').classList.add('flex');
                      document.getElementById('modalKonfirmasiSimpan').classList.remove('hidden');
                    " 
                    id="btnSimpan" 
                    class="px-12"
                    
                  >
                    Simpan
                  </x-button.primary>
                </x-container.container>
                
              </x-container.wrapper>
            </x-container.container>
            
          </x-container.wrapper>
        </x-container.container>
        <x-modal.container-pure-js id="modalKonfirmasiSimpan">
          <x-slot name="header">
            <x-container.container width="full" class="flex flex-row justify-between items-center !px-0 !ps-5 !gap-0">
              <x-typography variant="body-medium-bold" class="flex-1 text-center">Tunggu Sebentar</x-typography>
              <x-icon name="exclamation-mark/black-20" class="w-8 h-8" />
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
            <x-button.primary type="submit">Ya, Simpan Sekarang</x-button.primary>
          </x-slot>
        </x-modal.container-pure-js>
        <script src="{{asset('js/custom/periode.js')}}"></script>
        <script>
          document.addEventListener('DOMContentLoaded', () => {
            initCalendar();
          });
        </script>
      </x-container.wrapper>
    </x-layouts.content>
</x-layouts.main>

