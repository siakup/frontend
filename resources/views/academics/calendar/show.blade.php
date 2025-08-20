@extends('layouts.main')

@section('title', 'Kalender Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Lihat Event Kalender Akademik</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/plugins/flatpckr.css') }}" />
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
        }

        .center .btn-delete-event-academic {
            color: #8C8C8C;
        }

        .center .btn-view-event-academic {
            color: #262626;
        }

        .center .btn-edit-event-academic {
            color: #E62129;
        }

        .page-title-text.sub-title {
            font-size: 16px;
        }

        .card-header.option-list {
            justify-content: left;
        }

        .card-header {
            padding-left: 0px;
        }

        #StudyProgramSection {
            display: flex;
            flex-direction: row;
            gap: 8px;
            padding: 20px;
        }

        .sub-title {
            font-size: 14px;
            font-weight: 400;
        }

        .sub-title-value {
            font-weight: bold;
            font-size: 14px;
        }

        .table-title {
            background-color: #E9EDF4;
            border-bottom: 1px solid #D9D9D9;
            display: flex;
            justify-content: center;
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            padding: 16px;
        }

        .button-outline {
            text-decoration: none;
        }

        .right {
            gap: 20px;
        }

        .left {
            gap: 20px;
            margin-left: 20px;
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

        button.button {
            padding: 8px 54.5px !important;
            margin: 0px;
        }

        .text-lg-bd {
            padding: 20px;
            text-align: left;
            align-self: start;
        }

        button.input {
            border: 1px solid #D9D9D9;
            color: #D9D9D9;
            width: 100%;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }

        .form-group .filter-box {
            width: 100%;
            z-index: 999;
        }

        .sort-dropdown.select {
            position: absolute;
            top: 43%;
            left: 29.3%;
            width: 67.5%;
        }

        /* Custom tanggal terpilih */
        .flatpickr-day.selected,
        .flatpickr-day.startRange,
        .flatpickr-day.endRange {
            background-color: #dc2626 !important;
            /* merah */
            color: #fff !important;
            border-radius: 12px !important;
        }

        /* Hover efek */
        .flatpickr-day:hover {
            background-color: #fecaca !important;
            /* merah muda */
            color: #dc2626 !important;
        }

        /* Styling jam & menit */
        .flatpickr-time input {
            border-radius: 8px !important;
            color: #dc2626 !important;
            padding: 4px;
            font-weight: bold;
        }

        .flatpickr-time-separator {
            text-align: center;
        }

        /* Style dropdown jam & menit fokus */
        .flatpickr-time input:focus {
            outline: none;
            box-shadow: 0 0 3px #dc2626;
        }

        /* Style container jam & menit */
        .flatpickr-time {
            border-top: 1px solid #eee;
        }

        .calendar-input {
            border: 1px solid #BFBFBF !important;
            display: flex !important;
            align-items: center !important;
            border-radius: 8px;
            width: 100%;
            color: #262626;
        }

        .calendar-input img {
            margin-right: 10px;
        }

        .calendar-input input {
            background-color: white !important;
            outline: none !important;
            border: none !important;
        }
    </style>
@endsection

@section('javascript')
    <script src="{{ asset('js/plugins/flatpckr.js') }}"></script>
    <script src="{{ asset('js/plugins/flatpckr-id.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const calendarInput = Array.from(document.getElementsByClassName('calendar-input'));
            calendarInput.map(value => {
                const img = value.querySelector('img');
                const input = value.querySelector('input');
                value.addEventListener('click', () => {
                    input.focus();
                });
                input.addEventListener('focus', () => {
                    img.src = "{{ asset('assets/active/icon-calendar.svg') }}";
                });
                input.addEventListener('blur', () => {
                    img.src = "{{ asset('assets/base/icon-calendar.svg') }}";
                });
            });

            document.addEventListener('click', function(e) {
                const addBtn = e.target.closest('.btn-add-event');
                
                if (addBtn) {
                    document.getElementById('modalAddEvent').style.display = 'flex';
                }
            });

            document.getElementById('modalKonfirmasiHapus-btnSimpan').addEventListener('click', function() {
              const id = document.getElementById('modalKonfirmasiHapus').getAttribute('data-id');
              const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                $.ajax({
                    url: "{{ route('calendar.delete', ['id' => 'ID_REPLACE']) }}".replace(
                        'ID_REPLACE', id),
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        document.getElementById('modalKonfirmasiHapus').removeAttribute(
                            'data-id');
                        document.getElementById('modalKonfirmasiHapus').style.display = 'none';
                        successToast('Berhasil dihapus');
                        setTimeout(() => {
                            window.location.href =
                                "{{ route('calendar.show', ['id' => 'ID_REPLACE']) }}".replace('ID_REPLACE', "{{$id}}");
                        }, 5000);
                    },
                    error: function() {
                        $('tbody').html(
                            '<tr><td colspan="7" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>'
                        );
                    }
                });
            });
        });
    </script>
@endsection

@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            successToast("{{ session('success') ?? 'Berhasil disimpan' }}");
            setTimeout(() => {
                window.location.href = "{{ route('calendar.show', ['id' => $id]) }}";
            }, 3000);
        })
    </script>
@endif

@section('content')
    <div class="page-header">
        <div class="page-title-text">Lihat Event Kalender Akademik - Universitas Pertamina - Periode Akademik {{$period->tahun}} - {{$period->semester}} ({{$period->semester == 1 ? 'Ganjil' : ($period->semester == 2 ? 'Genap' : 'Pendek')}})</div>
    </div>
    <a href="{{ route('calendar.index') }}" class="button-no-outline-left">
        <img src="{{ asset('assets/active/icon-arrow-left.svg') }}" alt="Kembali"> Kalender Akademik
    </a>
    <div class="content-card">
        <div class="card-header option-list">
          <div class="card-header option-list">
            <div class="card-header" id="CampusProgramSection">
                <div class="page-title-text sub-title">Program Perkuliahan</div>
                @include('partials.dropdown-filter', [
                  'buttonId' => 'sortButtonCampus',
                  'dropdownId' => 'sortCampus',
                  'dropdownItem' => array_column($programPerkuliahanList, 'id', 'nama'),
                  'label' => count(array_filter($programPerkuliahanList, function($item) use($id_program) { return $item->id == $id_program; })) > 0 ? array_values(array_filter($programPerkuliahanList, function($item) use($id_program) { return $item->id == $id_program; }))[0]->nama : "",
                  'url' => route('calendar.show', ['id' => $id]),
                  'imgSrc' => asset('assets/active/icon-arrow-down.svg'),
                  'dropdownClass' => '!top-[21%] !left-[19.8%]',
                  'isIconCanRotate' => true,
                  'imgInvertSrc' => asset('assets/active/icon-arrow-up.svg')
                ])
            </div>
            <div class="card-header" id="StudyProgramSection">
                <div class="page-title-text sub-title">Program Studi</div>
                @include('partials.dropdown-filter', [
                  'buttonId' => 'sortButtonStudy',
                  'dropdownId' => 'sortStudy',
                  'dropdownItem' => array_column($programStudiList, 'id', 'nama'),
                  'label' =>  count(array_filter($programStudiList, function($item) use($id_prodi) { return $item->id == $id_prodi; })) > 0 ? array_values(array_filter($programStudiList, function($item) use($id_prodi) { return $item->id == $id_prodi; }))[0]->nama : "",
                  'url' => route('calendar.show', ['id' => $id]),
                  'imgSrc' => asset('assets/active/icon-arrow-down.svg'),
                  'dropdownClass' => '!top-[11%] !left-[74%]',
                  'isIconCanRotate' => true,
                  'imgInvertSrc' => asset('assets/active/icon-arrow-up.svg')
                ])
            </div>
          </div>
        </div>
        <div class="table-responsive">
            <div class="table-title">Event Kalender Akademik</div>
            <table class="table" id="list-user" style="--table-cols:4;">
                <thead>
                    <tr>
                        <th>Nama Event</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        @php
                            $tanggalMulai = new DateTime($d->tanggal_awal);
                            $tanggalSelesai = new DateTime($d->tanggal_akhir);

                            $tglMulaiStr =
                                $tanggalMulai->format('d') .
                                ' ' .
                                bulan((int) $tanggalMulai->format('m')) .
                                ' ' .
                                $tanggalMulai->format('Y, H:i');

                            $tglSelesaiStr =
                                $tanggalSelesai->format('d') .
                                ' ' .
                                bulan((int) $tanggalSelesai->format('m')) .
                                ' ' .
                                $tanggalSelesai->format('Y, H:i');
                        @endphp
                        <tr>
                            <td>{{ $d->nama_event }}</td>
                            <td>{{ $tglMulaiStr }}</td>
                            <td>{{ $tglSelesaiStr }}</td>
                            <td>
                                <div class="center">
                                    <button class="btn-icon btn-edit-event-academic" data-id="{{ $d->id }}"
                                        title="Edit" type="button">
                                        <img src="{{ asset('assets/icon-edit.svg') }}" alt="Edit">
                                        <span>Ubah</span>
                                    </button>
                                    <button class="btn-icon btn-delete-event-academic" data-id="{{ $d->id }}"
                                        title="Delete" type="button">
                                        <img src="{{ asset('assets/icon-delete-gray-600.svg') }}" alt="Delete">
                                        <span>Hapus</span>
                                    </button>
                                    <button class="btn-icon" data-id="{{ $d->id }}" title="Sync" type="button">
                                        <img src="{{ asset('assets/icon-sync.svg') }}" alt="Sync">
                                        <span>Sync</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-header">
            <div class="left">
                <a href="{{ route('calendar.index') }}" class="button-clean">Kembali</a>
            </div>
            <div class="right">
                <a href="{{ route('calendar.upload', ['id' => $id]) }}" class="button-clean" id="">
                    <span>Impor Event Kalender Akademik</span>
                    <img src="{{ asset('assets/icon-upload-red-500.svg') }}" alt="Filter">
                </a>
                <button class="button-outline btn-add-event">Tambah Event</a>
            </div>
        </div>

        @include('academics.calendar.create', ['id' => $id]);
        @include('academics.calendar.edit', ['id' => $id, 'data' => $data]);
        @include('partials.modal', [
          'modalId' => 'modalKonfirmasiHapus',
          'modalTitle' => 'Hapus Event Kalender Akademik',
          'modalIcon' => asset('assets/icon-delete-gray-800.svg'),
          'modalMessage' => 'Apakah Anda yakin ingin menghapus event kalender akademik ini?',
          'triggerButton' => 'btn-delete-event-academic',
          'cancelButtonLabel' => 'Batal',
          'actionButtonLabel' => 'Hapus'
        ]);
    </div>
@endsection
