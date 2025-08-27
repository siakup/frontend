@extends('layouts.main')

@section('title', 'Ekuivalensi Kurikulum')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Ekuivalensi Kurikulum</div>
@endsection

@section('css')
<style>
  .right {
    gap: 20px;
  }

  .title {
    display: flex;
    align-items: center;
    justify-items: center;
  }

  .modal-custom-content {
      max-width: 600px;
      z-index: 2;
      align-items: center;
      gap: 16px;
      align-self: auto;
      top: 100px;
  }

  @media (max-width: 900px) {
      .modal-custom-content {
          width: 90vw;
          min-width: unset;
          max-width: 98vw;
          padding: 16px;
      }
      .modal-custom-title { font-size: 18px; }
  }
  .modal-custom {
    align-items: start;
  }
  .modal-custom-footer.create-form {
    align-self: end;
    gap: 20px;
    padding: 20px;
  }

  .modal-custom-footer {
    gap: 20px;
    padding: 20px;
  }

  .modal-custom-body {
    align-self: start;
  }
</style>
@endsection

@section('javascript')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener('click', function(e) {
      const addBtn = e.target.closest('.btn-add-course');
      if (addBtn) {
        document.getElementById('modalKonfirmasiUpload').style.display = 'flex';
      }
    });

    document.getElementById('btnCekKembaliSebelumHapus').addEventListener('click', function() {
      document.getElementById('modalKonfirmasiUpload').removeAttribute('data-id');
      document.getElementById('modalKonfirmasiUpload').style.display = 'none';
    });
  });
</script>
@endsection

@section('content')
    <div class="px-5 flex flex-col gap-5">
        <x-typography variant="heading-h6" bold class="">
            Unggah Ekuivalensi Kurikulum
        </x-typography>
        <div class="flex flex-col gap-5">
            <x-container variant="content" class="flex flex-col gap-5">
                <x-typography variant="heading-h6" class="mb-2 title">
                    Impor Ekuivalensi Kurikulum
                    <img src="{{ asset('assets/base/icon-caution.svg')}}" alt="caution-icon" style="height: 1em; width: auto; margin-left: 12px; vertical-align: middle;">
                </x-typography>

                <div class="flex flex-col gap-5">
                    <x-table>
                        <x-table-head>
                            <x-table-row>
                                <x-table-header class="cursor-pointer">
                                    Kode Mata Kuliah Lama
                                </x-table-header>
                                <x-table-header class="cursor-pointer">
                                    Kode Mata Kuliah Baru
                                </x-table-header>
                            </x-table-row>
                        </x-table-head>

                        <x-table-body>
                            @forelse ($file_data as $data)
                                <x-table-row>
                                    <x-table-cell>{{ $data['Kode MK Lama'] }}</x-table-cell>
                                    <x-table-cell>{{ $data['Kode MK Baru'] }}</x-table-cell>
                                </x-table-row>
                            @empty
                                <x-table-row>
                                    <x-table-cell colspan="6" class="text-center py-4">
                                        Tidak ada data ditemukan
                                    </x-table-cell>
                                </x-table-row>
                            @endforelse
                        </x-table-body>
                    </x-table>
                </div>
              </x-container>
              <x-container variant="content" class="flex flex-col gap-5" >
                <div class="right">
                  <a href="" class="button-clean" id="">
                      <span>Batal</span>
                  </a>
                    <button class="button-outline btn-add-course">Simpan</button>
                </div>
              </x-container>
              <form action="{{route('curriculum.equivalence.save-upload')}}" method="POST">
                @csrf
                @foreach($file_data as $index => $course)
                  <input type="hidden" name="data[{{$index}}][Kode MK Lama]" value="{{$course['Kode MK Lama']}}">
                  <input type="hidden" name="data[{{$index}}][Kode MK Baru]" value="{{$course['Kode MK Baru']}}">
                @endforeach
                <div id="modalKonfirmasiUpload" class="modal-custom" style="display:none;">
                  <div class="modal-custom-backdrop"></div>
                  <div class="modal-custom-content">
                    <div class="modal-custom-header">
                      <span class="text-lg-bd">Tunggu Sebentar</span>
                      <img src="{{ asset('assets/icon-caution.svg')}}" alt="icon-caution">
                    </div>
                    <div class="modal-custom-body">
                      <div>Apakah anda yakin untuk menyimpan Ekuivalensi Kurikulum dari (csv/xlsx)?</div>
                    </div>
                    <div class="modal-custom-footer">
                      <button type="button" class="button button-clean" id="btnCekKembaliSebelumHapus">Cek Kembali</button>
                      <button type="submit" class="button button-outline" id="btnSimpan">Ya, Simpan</button>
                    </div>
                  </div>
                </div>
              </form>
        </div>
    </div>
@endsection


