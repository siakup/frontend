@extends('layouts.main')

@section('title', 'Mata Kuliah')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Mata Kuliah</div>
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
            Unggah Mata Kuliah
        </x-typography>
        <div class="flex flex-col gap-5">
            <x-container variant="content" class="flex flex-col gap-5">
                <x-typography variant="heading-h6" class="mb-2 title">
                    Impor Mata Kuliah
                    <img src="{{ asset('assets/base/icon-caution.svg')}}" alt="caution-icon" style="height: 1em; width: auto; margin-left: 12px; vertical-align: middle;">
                </x-typography>
        
                <div class="flex flex-col gap-5">
                    <x-table>
                        <x-table-head>
                            <x-table-row>
                                <x-table-header class="cursor-pointer">
                                    Kode Mata Kuliah
                                </x-table-header>
                                <x-table-header class="cursor-pointer">
                                    Nama Mata Kuliah
                                </x-table-header>
                                <x-table-header class="cursor-pointer">
                                    Jumlah SKS
                                </x-table-header>
                                <x-table-header class="cursor-pointer">
                                    Semester
                                </x-table-header>
                                <x-table-header>Jenis Mata Kuliah</x-table-header>
                            </x-table-row>
                        </x-table-head>
        
                        <x-table-body>
                            @forelse ($file_data as $matkul)
                                <x-table-row>
                                    <x-table-cell>{{ $matkul['kode'] }}</x-table-cell>
                                    <x-table-cell>{{ $matkul['nama'] }}</x-table-cell>
                                    <x-table-cell>{{ $matkul['sks'] }}</x-table-cell>
                                    <x-table-cell>{{ $matkul['semester'] }}</x-table-cell>
                                    <x-table-cell>
                                        <span
                                            class="px-2 py-1 rounded-full text-xs
                                    {{ $matkul['jenis'] === 'Wajib' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                            {{ $matkul['jenis'] }}
                                        </span>
                                    </x-table-cell>
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
                  <button class="button-outline btn-add-course">Simpan</a>
                </div>
              </x-container>
              <form action="{{route('study.save-upload')}}" method="POST">
                @csrf
                @foreach($file_data as $index => $course)
                  <input type="hidden" name="data[{{$index}}][kode]" value="{{$course['kode']}}">
                  <input type="hidden" name="data[{{$index}}][nama]" value="{{$course['nama']}}">
                  <input type="hidden" name="data[{{$index}}][sks]" value="{{$course['sks']}}">
                  <input type="hidden" name="data[{{$index}}][semester]" value="{{$course['semester']}}">
                  <input type="hidden" name="data[{{$index}}][jenis]" value="{{$course['jenis']}}">
                @endforeach
                <div id="modalKonfirmasiUpload" class="modal-custom" style="display:none;">
                  <div class="modal-custom-backdrop"></div>
                  <div class="modal-custom-content">
                    <div class="modal-custom-header">
                      <span class="text-lg-bd">Tunggu Sebentar</span>
                      <img src="{{ asset('assets/icon-caution.svg')}}" alt="icon-caution">
                    </div>
                    <div class="modal-custom-body">
                      <div>Apakah anda yakin untuk menyimpan Mata Kuliah dari (csv/xlsx)?</div>
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


