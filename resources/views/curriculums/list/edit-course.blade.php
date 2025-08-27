@extends('layouts.main')

@section('title', Request::routeIs('curriculum.list.view.show-study') ? 'Lihat Mata Kuliah Kurikulum' : 'Ubah Mata Kuliah Kurikulum')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Kurikulum</div>
@endsection

@section('css')
<style>
  .center {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 24px;
  }
  .center .btn-icon {
      display: flex;
      align-items: center;
      justify-items: center;
      text-decoration: none;
      gap: 2px;
      font-size: 12px;
      width: max-content;
  }
  .center .btn-delete-periode-academic {
      color: #8C8C8C;
  }
  .center .btn-view-periode-academic {
      color: #262626;
  }
  .center .btn-edit-periode-academic {
      color: #E62129;
  }
  .modal-custom-content {
      max-width: 600px;
      z-index: 2;
      align-items: center;
      gap: 16px;
      align-self: auto;
  }
  .modal-custom {
      align-items: start;
  }
  @media (max-width: 900px) {
      .modal-custom-content {
          width: 90vw;
          min-width: unset;
          max-width: 98vw;
          padding: 16px;
      }
      .modal-custom-title {
          font-size: 18px;
      }
  }
</style>
@endsection

<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const selectAll = document.querySelector('input#select-all[type="checkbox"]');
    const cplData = document.querySelectorAll('input[name="cpl[]"]');
    selectAll.addEventListener('input', (e) => {
      Array.from(cplData).forEach(value => {
        value.checked = e.target.checked
      });
    });

    const semester = document.querySelector('input[name="semester"]');
    semester.addEventListener('input', () => {
      updateSaveButtonState();
      semester.value = semester.value.replace(/[^0-9]/g, '');
      const val = parseInt(semester.value, 10);
      if (isNaN(val)) {
        semester.value = '';
      } else if (val < 1) {
        semester.value = '1';
      } else if (val > 8) {
        semester.value = '8';
      } else {
        semester.value = val;
      }
    });



    function updateSaveButtonState() {
      const semesterFilled = semester.value.trim() !== '';
      if(semesterFilled) {
        document.querySelector('#btnSimpan').disabled = false;
      } else {
        document.querySelector('#btnSimpan').disabled = true;
      }
    }

    updateSaveButtonState();
    
    document.getElementById('modalKonfirmasiHapus-btnSimpan').addEventListener('click', function() {
       const dataId = document.getElementById('modalKonfirmasiHapus').getAttribute('data-id');
       const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
       document.getElementById('modalKonfirmasiHapus').removeAttribute(
            'data-id');
        document.getElementById('modalKonfirmasiHapus').style.display = 'none';
        successToast('Berhasil dihapus');
        setTimeout(() => {
          window.location.href = "{{route('curriculum.list.edit.show-study', ['id' => $id])}}"
        }, 5000);
      //  $.ajax({
      //      url: "{{ route('academics-event.delete', ['id' => ':id']) }}".replace(':id',
      //          id),
      //      method: 'DELETE',
      //      headers: {
      //          'X-CSRF-TOKEN': csrfToken,
      //          'X-Requested-With': 'XMLHttpRequest'
      //      },
      //      success: function(response) {
      //          document.getElementById('modalKonfirmasiSimpan').removeAttribute(
      //              'data-id');
      //          document.getElementById('modalKonfirmasiSimpan').style.display = 'none';
      //          successToast('Berhasil dihapus');
      //          setTimeout(() => {
      //              window.location.href =
      //                  "{{ route('academics-event.index') }}";
      //          }, 5000);
      //      },
      //      error: function() {
      //          $('tbody').html(
      //              '<tr><td colspan="7" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>'
      //          );
      //      }
      //  });
    });
  })
</script>

@section('content')
<form action="{{route('curriculum.list.edit.update-study', ['id' => $id, 'course_id' => $course_id])}}" method="POST">
  @csrf
  <div class="page-header">
    <div class="page-title-text">Ubah Mata Kuliah Kurikulum</div>
  </div>
  <a href="{{ route('curriculum.list.edit.show-study', ['id' => $id]) }}" class="button-no-outline-left">
      <img src="{{ asset('assets/active/icon-arrow-left.svg') }}" alt="Kembali"> Ubah Mata Kuliah
  </a>
  <div class="content-card !overflow-hidden">
    <div class="form-title-text bg-gradient-to-r from-[#FFECED] to-[#FFFFFF] !p-[20px]">Ubah Mata Kuliah Kurikulum</div>
    <table class="w-full">
      <tbody>
        <tr class="text-[#262626]">
          <td class="bg-[#E8E8E8] px-[20px] py-[8px] w-[30%]">Nama Kurikulum</th>
          <td class="px-[20px] py-[8px] bg-[#F5F5F5] font-bold w-[70%]">Ilmu Komputer</td>
        </tr>
        <tr class="text-[#262626]">
          <td class="bg-[#F5F5F5] px-[20px] py-[8px] w-[30%]">Kode Mata Kuliah</th>
          <td class="px-[20px] py-[8px] bg-[#FFFFFF] font-bold w-[70%]">10004</td>
        </tr>
        <tr class="text-[#262626]">
          <td class="bg-[#E8E8E8] px-[20px] py-[8px] w-[30%]">Mata Kuliah</th>
          <td class="px-[20px] py-[8px] bg-[#F5F5F5] font-bold w-[70%]">Agama Katolik dan Etika</td>
        </tr>
        <tr class="text-[#262626]">
          <td class="bg-[#F5F5F5] px-[20px] py-[8px] w-[30%]">SKS</th>
          <td class="px-[20px] py-[8px] bg-[#FFFFFF] font-bold w-[70%]">2</td>
        </tr>
        <tr class="text-[#262626]">
          <td class="bg-[#E8E8E8] px-[20px] py-[8px] w-[30%]">Semester Kurikulum</th>
          <td class="px-[20px] py-[8px] bg-[#F5F5F5] font-bold w-[70%]">1</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="content-card !bg-transparent !border-none px-[30px]">
    <ul class="text-[#0065A3] list-disc italic">
      <li>Setiap perubahan data akan memengaruhi seluruh portofolio mata kuliah</li>
    </ul>
  </div>
  <div class="content-card px-[20px] py-[12px]">
    <div class="form-group">
      <label for="semester">Semester</label>
      <div class="input-by-search input flex flex-col !items-start">
        <input type="text" id="semester" class="form-control" value="1" name="semester" placeholder="semester">
        <p class="text-[#8C8C8C] text-[12px]">Semester hanya dapat diisi dengan angka 1 sampai 8</p>
      </div>
    </div>
  </div>
  <div class="content-card !overflow-hidden">
    <div class="form-title-text bg-gradient-to-r from-[#FFECED] to-[#FFFFFF] !p-[20px]">Capaian Pembelajaran Lulusan</div>
     <x-container class="border-none">
        <div class="flex flex-col gap-5">
          <x-table>
              <x-table-head>
                  <x-table-row>
                      <x-table-header class="cursor-pointer">
                          Kode
                      </x-table-header>
                      <x-table-header class="cursor-pointer">
                          Capaian
                      </x-table-header>
                      <x-table-header class="cursor-pointer">
                          <input type="checkbox" id="select-all">
                      </x-table-header>
                  </x-table-row>
              </x-table-head>
              <x-table-body>
                  @forelse ($data as $d)
                      <x-table-row>
                          <x-table-cell>{{ $d['kode'] }}</x-table-cell>
                          <x-table-cell class="text-start">{{ $d['capaian'] }}</x-table-cell>
                          <x-table-cell>
                            <input type="checkbox" name="cpl[]" id="select-all" value="{{$d['id']}}" @if($d['is_select']) checked @endif>
                          </x-table-cell>
                      </x-table-row>
                  @empty
                      <x-table-row>
                          <x-table-cell colspan="3" class="text-center py-4">
                              Tidak ada data ditemukan
                          </x-table-cell>
                      </x-table-row>
                  @endforelse
              </x-table-body>
          </x-table>
        </div>
      </x-container>
      <div class="flex justify-end">
        <div class="button-group flex">
          <button type="button" class="button button-clean disabled:!bg-white disabled:!border-[#D9D9D9] disabled:!border-1 !min-w-[151px]" id="btnBatal">Batal</button>
          <button type="button" class="button button-outline !min-w-[151px] btnSimpan" id="btnSimpan" disabled>Simpan</button>
        </div>
      </div>
  </div>
    @include('partials.modal', [
      'modalId' => 'modalKonfirmasiSimpan',
      'modalTitle' => 'Tunggu Sebentar',
      'modalIcon' => asset('assets/base/icon-caution.svg'),
      'modalMessage' => 'Apakah Anda yakin informasi yang diubah sudah benar?',
      'triggerButton' => 'btnSimpan',
      'cancelButtonLabel' => 'Cek Kembali',
      'actionButtonLabel' => 'Ya, Simpan Sekarang'
    ])
</form>
@endsection