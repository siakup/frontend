@extends('layouts.main')

@section('title', 'Kalender Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Kalender Akademik</div>
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
        }

        .center .btn-view-event-academic {
            color: #262626;
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

        .sort-dropdown.left {
            top: 25%;
            left: 14%;
            z-index: 999;
            right: auto;
        }

        .sort-dropdown.right {
            top: 25%;
            right: 31%;
            z-index: 999;
            width: max-content;
        }

        .label-status {
            padding: 3.5px 12px;
            background-color: #0097F5;
            color: white;
            font-size: 10px;
            font-weight: 400;
            border-radius: 16px;
        }
    </style>
@endsection

@section('javascript')
    <script>
        function sortTable(value) {
            $.ajax({
                url: "{{ route('calendar.index') }}",
                method: 'GET',
                data: {
                    sort: value
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    window.location.href = "{{ route('academics-event.index') }}" + '?sort=' +
                        encodeURIComponent(value);
                },
                error: function() {
                    $('tbody').html(
                        '<tr><td colspan="7" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>'
                    );
                }
            });
        }
    </script>
@endsection

@section('content')
    <div class="page-header">
        <div class="page-title-text">Kalender Akademik - Universitas Pertamina</div>
    </div>
    <div class="content-card">
        <div class="card-header">
            <div class="page-title-text sub-title">Tahun Akademik 2025-2026</div>
        </div>
        <div class="table-responsive">
            <table class="table" id="list-user" style="--table-cols:7;">
                <thead>
                    <tr>
                        <th>Periode Akademik</th>
                        <th>Semester</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>Aksi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $d->tahun.'-'.$d->semester }}</td>
                            <td>{{ $d->semester === 1 ? 'Ganjil' : ($d->semester === 2 ? 'Genap' : 'Pendek') }}</td>
                            @php
                                $mulai = new DateTime($d->tanggal_mulai);
                                $akhir = new DateTime($d->tanggal_akhir);
                            @endphp
                            <td>{{ $mulai->format('d') . ' ' . bulan((int) $mulai->format('m')) . ' ' . $mulai->format('Y, H:i') }}
                            </td>
                            <td>{{ $akhir->format('d') . ' ' . bulan((int) $akhir->format('m')) . ' ' . $akhir->format('Y, H:i') }}
                            </td>

                            <td>
                                <div class="center">
                                    <a href="{{ route('calendar.show', ['id' => $d->id]) }}"
                                        class="btn-icon btn-view-event-academic" data-id="{{ $d->id }}"
                                        title="View" type="button">
                                        <img src="{{ asset('assets/icon-search.svg') }}" alt="View">
                                        <span>Lihat</span>
                                    </a>
                                </div>
                            </td>
                            <td>
                                @if (new DateTime() >= new DateTime($d->tanggal_mulai) && new DateTime() <= new DateTime($d->tanggal_akhir))
                                    <span class="label-status">Sedang berlangsung</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="right">
            <a href="" class="button button-outline">Generate Riwayat Akademik</a>
        </div>
    </div>
@endsection
