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

.modal-custom-content {
    max-width: 600px;
    z-index: 2;
    align-items: center;
    align-self: auto;
}

.modal-custom-body {
    padding: 12px 50px 12px 50px;
    width: 100%;
    box-sizing: border-box;
    text-align: center;
}

.modal-custom {
    align-items: start;
}

@media (max-width: 600px) {
    .modal-custom-content {
        width: 90vw;
        min-width: unset;
        max-width: 98vw;
        padding: 16px;
    }
    .modal-custom-title { font-size: 18px; }
}
</style>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const batalButton = document.getElementById("btnBatal");
        const btnKembali = document.getElementById("btnKembali");
        const btnYaBatal = document.getElementById("btnYaBatal");
        const modalBatalUnggah = document.getElementById("modalBatalUnggah");

        if (batalButton) {
            batalButton.addEventListener("click", function () {
                modalBatalUnggah.style.display = "flex";
            });
        }

        if (btnYaBatal) {
            btnYaBatal.addEventListener("click", function () {
                window.location.href = "{{ route('academics-event.upload') }}";
            });
        }

        if (btnKembali) {
            btnKembali.addEventListener("click", function () {
                modalBatalUnggah.style.display = "none";
            });
        }
    });
</script>

@section('content')
    <div class="page-header">
        <div class="page-title-text">Unggah Event Akademik</div>
    </div>
    
    <a href="{{ route('academics-event.index') }}" class="button-no-outline-left">
        <img src="{{ asset('assets/active/icon-arrow-left.svg') }}" alt="Kembali"> Event Akademik
    </a>
    <div class="content-card">
        <div class="text-lg-bd page-title-text">
            <span>Impor Event Akademik</span>
            <img src="{{ asset('assets/base/icon-caution.svg')}}" alt="caution-icon" style="height: 1em; width: auto; margin-left: 12px; vertical-align: middle;">
        </div>
        <form action="{{ route('academics-event.store-upload') }}" method="POST">
            @csrf
            <div class="table-responsive">
                <table class="table" id="list-user" style="--table-cols:9">
                    <thead>
                        <tr>
                            <th style="width: 30%">Nama Event</th>
                            <th style="width: 10%">Event<br/>Nilai</th>
                            <th style="width: 10%">Event<br/>IRS</th>
                            <th style="width: 10%">Event<br/>Lulus</th>
                            <th style="width: 10%">Event Registrasi</th>
                            <th style="width: 10%">Event Yudisium</th>
                            <th style="width: 10%">Event Survei</th>
                            <th style="width: 10%">Event Dosen</th>
                            <th style="width: 15%">Status</th>
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

        <div id="modalBatalUnggah" class="modal-custom" style="display:none;">
            <div class="modal-custom-backdrop"></div>
            <div class="modal-custom-content">
            <div class="modal-custom-header">
                <span class="text-lg-bd">Batalkan impor data (csv/xlsx)?</span>
                <img src="{{ asset('assets/icon-caution.svg')}}" alt="icon-caution">
            </div>
            <div class="modal-custom-body">
                <div>Apakah Anda yakin ingin membatalkan unggah event akademik?</div>
            </div>
            <div class="modal-custom-footer">
                <button type="button" class="button button-clean" id="btnKembali">Kembali</button>
                <button type="button" class="button button-outline" id="btnYaBatal">Batalkan</button>
            </div>
            </div>
        </div>
    </div>
@endsection