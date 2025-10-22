@extends('layouts.main')

@section('title', 'Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Akademik</div>
@endsection

@section('content')
  <x-title-page :title="'Tambah Event Akademik'" />
  <x-button.back class="ml-4" :href="route('academics-event.index')">Event Akademik</x-button.back>
  <x-white-box :class="''">
    <x-title-page :title="'Tambah Event Akademik'" />
    <div class="px-4 flex flex-col gap-8">
      <input type="hidden" id="user_id" value="">
      <x-form.input-container class="min-w-[150px]" id="name-container">
        <x-slot name="label">Nama Event</x-slot>
        <x-slot name="input">
          <div class="flex justify-between w-full">
              <input 
                type="text" 
                id="name" 
                class="w-full pe-10 box-border ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10" 
                name="name"
                value="" 
                placeholder='Nama Event'
                oninput="updateSaveButtonState()"
              />
          </div>
        </x-slot>
      </x-form.input-container>
      <x-form.input-container class="min-w-[150px]" id="flag">
        <x-slot name="label">Flag</x-slot>
        <x-slot name="input">
          <div class="flex gap-8 justify-items-start py-3">
            <x-form.checklist :id="'nilai'" :value="'nilai'" :label="'Nilai'" :name="'flag[]'" />
            <x-form.checklist :id="'irs'" :value="'irs'" :label="'IRS'" :name="'flag[]'" />
            <x-form.checklist :id="'lulus'" :value="'lulus'" :label="'Lulus'" :name="'flag[]'" />
            <x-form.checklist :id="'registrasi'" :value="'registrasi'" :label="'Registrasi'" :name="'flag[]'" />
            <x-form.checklist :id="'yudisium'" :value="'yudisium'" :label="'Yudisium'" :name="'flag[]'" />
            <x-form.checklist :id="'survei'" :value="'survei'" :label="'Survei'" :name="'flag[]'" />
            <x-form.checklist :id="'dosen'" :value="'dosen'" :label="'Dosen'" :name="'flag[]'" />
          </div>
        </x-slot>
      </x-form.input-container>
      <x-form.toggle :id="'statusValue'" />
      <div class="flex gap-5 justify-end m-5">
        <x-button.secondary :href="route('academics-event.index')">Batal</x-button.secondary>
        <x-button.primary
          onclick="
            document.getElementById('modalKonfirmasiSimpan').classList.add('flex');
            document.getElementById('modalKonfirmasiSimpan').classList.remove('hidden');
          "
          id="btnSave"
          disabled
        >
          Simpan
        </x-button.primary>
      </div>
    </div>
  </x-white-box>

  <x-modal.container-pure-js id="modalKonfirmasiSimpan">
    <x-slot name="header">
      <span class="text-lg-bd">Tunggu Sebentar</span>
      <img src="{{ asset('assets/base/icon-caution.svg') }}" alt="ikon peringatan">
    </x-slot>
    <x-slot name="body">
      Apakah Anda yakin informasi yang ditambah sudah benar?
    </x-slot>
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

  <script>
    function onClickCreateEventAcademic(requestedRoute, redirectedRoute) {
      const nama = $('#name').val();
      const flags = [];
      $('input[name="flag[]"]:checked').each(function() {
        flags.push($(this).val());
      });
      const status = $('#statusValue').val();

      $.ajax({
          url: requestedRoute,
          method: "POST",
          data: {
            _token: "{{ csrf_token() }}",
            name: nama,
            flag: flags,
            status: status
          },
          success: function(response) {
              $('#modalKonfirmasiSimpan').addClass('hidden').removeClass('flex');
              successToast('Berhasil disimpan');
              setTimeout(function() {
                  window.location.href = redirectedRoute;
              }, 1200);
          },
          error: function(xhr) {
              $('#modalKonfirmasiSimpan').addClass('hidden').removeClass('flex');
              let msg = 'Gagal menyimpan data';
              if (xhr.responseJSON && xhr.responseJSON.message) {
                  msg = xhr.responseJSON.message;
              }
              errorToast(msg);
          }
      });
    }

    function updateSaveButtonState() {
      const btnSave = document.getElementById('btnSave');
      const eventFilled = document.getElementById('name').value.trim() !== '';

      if (eventFilled) {
        btnSave.disabled = false;
      } else {
        btnSave.disabled = true;
      }
    }
  </script>
@endsection