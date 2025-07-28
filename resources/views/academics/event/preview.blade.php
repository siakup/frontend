@extends('layouts.main')

@section('title', 'Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Akademik</div>
@endsection

@section('css')
<style>
.button-group {
    display: flex;
    justify-content: flex-end;
    margin-top: 1rem;
}

.active-lable {
    background-color: #D0DE68;
    border-radius: 4px;
    padding: 4px 29px;
}

.inactive-lable {
    background-color: #FAFBEE;
    color: #98A725;
    border-radius: 4px;
    padding: 4px 10px;
}
</style>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const batalButton = document.getElementById("btnBatal");

        if (batalButton) {
            batalButton.addEventListener("click", function () {
                window.location.href = "{{ route('academics-event.upload') }}";
            });
        }
    });
</script>

@section('content')
    <div class="page-header">
        <div class="page-title-text">Tambah Event Akademik</div>
    </div>
    
    <a href="{{ route('academics-event.index') }}" class="button-no-outline-left">
        <img src="{{ asset('assets/active/icon-arrow-left.svg') }}" alt="Kembali"> Event Akademik
    </a>
    <div class="content-card">
        <div class="text-lg-bd page-title-text">
            <span>Import Event Akademik</span>
            <img src="{{ asset('assets/base/icon-caution.svg')}}" alt="caution-icon" style="height: 1em; width: auto; margin-left: 12px; vertical-align: middle;">
        </div>
        <form action="{{ route('academics-event.store-upload') }}" method="POST">
            @csrf
            <div class="table-responsive">
                <table class="table" id="list-user" style="--table-cols:9">
                    <thead>
                        <tr>
                            <th style="width: 45%;">Nama Event</th>
                            <th style="width: 30%;">Event <br> Nilai</th>
                            <th style="width: 30%;">Event <br> IRS</th>
                            <th style="width: 35%;">Event <br> Lulus</th>
                            <th style="width: 35%;">Event <br> Registrasi</th>
                            <th style="width: 35%;">Event <br> Yudisium</th>
                            <th style="width: 30%;">Event <br> Survei</th>
                            <th style="width: 30%;">Event <br> Dosen</th>
                            <th style="width: 35%;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(array_slice($data, 1) as $row)
                        <tr>
                        @foreach($row as $index => $cell)
                            @if ($loop->last)
                            <td>
                                <input type="hidden" name="data[{{ $loop->parent->index }}][{{ $index }}]" value="{{ $cell }}">
                                <span class="{{ $cell === 'active' ? 'active' : 'inactive' }}-lable status-lable">
                                    {{ $cell === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            @else
                            <td>
                                <input type="hidden" name="data[{{ $loop->parent->index }}][{{ $index }}]" value="{{ $cell }}">
                                {{ $cell === 'y' ? 'Ya' : ($cell === 'n' ?'Tidak' : $cell) }}
                            </td>
                            @endif
                        @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="button-group">
                <button type="button" class="button button-clean" id="btnBatal">Batal</button>
                <button type="submit" class="button button-outline" id="btnSimpan">Simpan Event Akademik</button>
            </div>
        </form>
    </div>
@endsection