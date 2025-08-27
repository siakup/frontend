@extends('layouts.main')

@section('title', 'Pemetaan CPL')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Pemetaan CPL</div>
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

            .modal-custom-title {
                font-size: 18px;
            }
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
        document.addEventListener('DOMContentLoaded', function() {
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
            Unggah Pemetaan CPL
        </x-typography>
        <div class="flex flex-col gap-5">
            <x-container variant="content" class="flex flex-col gap-5">
                <x-typography variant="heading-h6" class="mb-2 title">
                    Impor Pemetaan CPL
                    <img src="{{ asset('assets/base/icon-caution.svg') }}" alt="caution-icon"
                        style="height: 1em; width: auto; margin-left: 12px; vertical-align: middle;">
                </x-typography>

                <div class="flex flex-col gap-5">
                    <x-table>
                        <x-table-head>
                            <x-table-row>
                                <x-table-header class="cursor-pointer">
                                    Kode Mata Kuliah
                                </x-table-header>
                                <x-table-header class="cursor-pointer">
                                    Kode CPL
                                </x-table-header>
                                <x-table-header class="cursor-pointer">
                                    Bobot
                                </x-table-header>
                            </x-table-row>
                        </x-table-head>

                        <x-table-body>
                            @forelse ($file_data as $row)
                                <x-table-row>
                                    <x-table-cell>{{ $row['kode_matakuliah'] }}</x-table-cell>
                                    <x-table-cell>{{ $row['kode_cpl'] }}</x-table-cell>
                                    <x-table-cell>{{ $row['bobot'] }}</x-table-cell>
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
            <x-container variant="content" class="flex flex-col gap-5">
                <div class="right">
                    <x-button.secondary label="Batal" />
                    <x-button.primary label="Simpan" />
                </div>
            </x-container>
            <form action="{{ route('study.save-upload') }}" method="POST">
                @csrf
                @foreach ($file_data as $index => $row)
                    <input type="hidden" name="data[{{ $index }}][kode_matakuliah]"
                        value="{{ $row['kode_matakuliah'] }}">
                    <input type="hidden" name="data[{{ $index }}][kode_cpl]" value="{{ $row['kode_cpl'] }}">
                    <input type="hidden" name="data[{{ $index }}][bobot]" value="{{ $row['bobot'] }}">
                @endforeach

                <div id="modalKonfirmasiUpload" class="modal-custom" style="display:none;">
                    <div class="modal-custom-backdrop"></div>
                    <div class="modal-custom-content">
                        <div class="modal-custom-header">
                            <span class="text-lg-bd">Tunggu Sebentar</span>
                            <img src="{{ asset('assets/icon-caution.svg') }}" alt="icon-caution">
                        </div>
                        <div class="modal-custom-body">
                            <div>Apakah anda yakin untuk menyimpan data CPL dari (csv/xlsx)?</div>
                        </div>
                        <div class="modal-custom-footer">
                            <button type="button" class="button button-clean" id="btnCekKembaliSebelumHapus">
                                Cek Kembali
                            </button>
                            <button type="submit" class="button button-outline" id="btnSimpan">
                                Ya, Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
