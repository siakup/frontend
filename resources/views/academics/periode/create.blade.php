<x-layouts.main>
  @section('css')
      <link rel="stylesheet" href="{{ asset('css/plugins/flatpckr.css') }}" />
  @endsection

  @section('javascript')
    <script src="{{ asset('js/plugins/flatpckr.js') }}"></script>
    <script src="{{ asset('js/plugins/flatpckr-id.js') }}"></script>
  @endsection

  <x-layouts.content>
    <x-container.wrapper width="full" height="full" rows="4" cols="1">

      <x-container.container row="1" height="max" padding="py-4">
        <x-breadcrumb path="academics/periode"/>
      </x-container.container>

      <x-container.container row="1" height="max" padding="py-4">
        <x-typography :variant="'body-large-semibold'">Tambah Periode Akademik</x-typography>
      </x-container.container>

      <x-container.container row="1" height="max" padding="py-4"> 
        <x-button.back :href="route('academics-periode.index')">Periode Akademik</x-button.back>
        <form action="{{ route('academics-periode.store') }}" method="POST">
      </x-container.container>

      <x-container.container row="1" height="full" width="full" padding="p-4" background="bg-white" class="border border-gray-400">
        @csrf
        <x-container.wrapper gapY="4" rows="8" width="full" height="full" justify="stretch">

          <x-container.container row="1">
            <x-typography :variant="'body-medium-bold'">Buat Periode Akademik</x-typography>
          </x-container.container>
            
          <x-container.container row="1">
            <x-form.input-container id="year">
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

          <x-container.container row="1">
            <x-form.input-container id="semester">
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

          <x-container.container row="1" class="">
            <x-form.input-container id="tahun-akademik">
              <x-slot name="label">Tahun Akademik</x-slot>
              <x-slot name="input">
                <x-container.container :variant="'content-wrapper'" :class="'flex justify-between w-full !p-0'">
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

          <x-container.container row="1" class="">
            <x-container.wrapper cols="2" width="full">

              <x-container.container>
                <x-form.input-container inputClass="w-fit col-start-7" id="tanggal-mulai">
                  <x-slot name="label">Tanggal Mulai</x-slot>
                  <x-slot name="input">
                    <x-form.calendar id="tanggal-mulai" name="tanggal_mulai" oninput="updateNewStateButton()" />
                  </x-slot>
                </x-form.input-container>
              </x-container.container>
      
              <x-container.container>
                <x-form.input-container labelClass="col-start-2" inputClass="w-fit col-start-7" id="tanggal-akhir">
                  <x-slot name="label">Tanggal Berakhir</x-slot>
                  <x-slot name="input">
                    <x-form.calendar id="tanggal-akhir" name="tanggal_akhir" oninput="updateNewStateButton()" />
                  </x-slot>
                </x-form.input-container>
              </x-container.container>

            </x-container.wrapper>
          </x-container.container>

          <x-container.container row="1" class="">
            <x-form.input-container  id="semester">
              <x-slot name="label">Deskripsi</x-slot>
              <x-slot name="input">
                <x-form.textarea
                  :placeholder="'Tulis deskripsi disini'"
                  :id="'deskripsi'"
                  :maxChar="280"
                  :helperText="'Maksimal 280 Karakter'"
                  oninput="updateNewStateButton()"
                />
              </x-slot>
            </x-form.input-container>
          </x-container.container>

          <x-container.container row="1" class="">
            <x-form.input-container  id="semester">
              <x-slot name="label">Status</x-slot>
              <x-slot name="input">
              <x-form.toggle :id="'academic-periode-status'"/>
              </x-slot>
            </x-form.input-container>
          </x-container.container>

          <x-container.container row="1" class="justify-end">
            <x-container.wrapper cols="2" gapX="4">

              <x-container.container>
                <x-button.secondary href="route('academics-periode.index')" class="!w-full px-12">Batal</x-button.secondary>
              </x-container.container>

              <x-container.container class="">
                <x-button.primary 
                  onclick="
                    document.getElementById('modalKonfirmasiSimpan').classList.add('flex');
                    document.getElementById('modalKonfirmasiSimpan').classList.remove('hidden');
                  " 
                  id="btnSimpan" 
                  class="!w-full px-12"
                  disabled
                >
                  Simpan
                </x-button.primary>
              </x-container.container>

            </x-container.wrapper>
          </x-container.container>

        </x-container.container>
      </x-container.wrapper>
    </x-container.wrapper>

    <x-modal.container-pure-js id="modalKonfirmasiSimpan">
      <x-slot name="header">
        <x-container.container :variant="'content-wrapper'" class="flex flex-row justify-between items-center !px-0 !ps-5 !gap-0">
          <x-typography :variant="'body-medium-bold'" class="'flex-1 text-center'">Tunggu Sebentar</x-typography>
          <x-icon :name="'exclamation-mark/black-20'" :class="'w-8 h-8'" />
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
        <x-button.primary :type="'submit'">Ya, Simpan Sekarang</x-button.primary>
      </x-slot>
    </x-modal.container-pure-js>

      <script src="{{asset('js/custom/periode.js')}}"></script>
      <script>
        document.addEventListener('DOMContentLoaded', () => {
          initCalendar();
        });
      </script>

  </x-layouts.content>
</x-layouts.main>
