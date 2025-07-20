@extends('layouts.main')

@section('title', 'Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Akademik</div>
@endsection

@section('css')
<style>
    .content-card{
        display: flex;
        padding: 20px 20px;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
        flex-shrink: 0;
        align-self: stretch;
    }

    .content-inside-card{
        margin: 0 auto 0 auto;  
        display: block;
        padding: 20px;
        align-items: center;
        max-width: 96%;
        width:100%;
        gap: 10px;
        border-radius: 12px;
        border: 1px solid var(--Surface-Border-Primary, #D9D9D9);
        background: var(--Neutral-Gray-100, #FAFAFA);
    }

    .upload-flex-row {
        display: flex;
        flex-direction: row; 
        gap: 40px;
        justify-content: space-between;
    }

    .upload-info-col {
        flex: 0 0 35%;       
        min-width: 20%;
        max-width: 35%;
    }

    .upload-area {
        flex: 1 1 0;
        min-width: 60%;
        display: flex;
        flex-direction: column;
        /* align-items: stretch; */
        position: relative;
        align-items: flex-start;
        width: 100%;
    
    }

    .upload-card {
        border-radius: var(--radius-sm, 8px);
        border: 2px dashed var(--Surface-Border-Primary, #D9D9D9);
        background: var(--Neutral-Gray-50, #FFF);
        padding: 32px 16px;
        text-align: center;
        width:60%;
        margin-bottom: 16px;
        margin-right: 0;
        margin-left: 0;
        flex: 1;
    }

    .upload-area-title {
        font-weight: 500;
        margin-bottom: 16px;
        text-align: left;
        width: 100%;
        display: block;
    }
     
    .upload-card-and-buttons {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        width: 120%;
        gap: 120px;
    }

    .upload-btn-group {
        display: flex;
        flex-direction: row;
        margin-left: auto;
        justify-content: flex-end;
        margin-top: -7%;
    }

    @media (max-width: 70%) {
        .upload-flex-row {
            flex-direction: row;
            gap: 16px;
        }
        .upload-area, .upload-card {
            max-width: 100%;
            width: 100%;
            align-items: stretch;
        }
    }

    a{
        color: var(--Blue-Honolulu-Blue-500, #0076BE);
        font-size: 16px;
        text-decoration: none;
        margin-bottom: 4px;
        display: block;
    }

    .button-clean{
        cursor:pointer; 
        display:inline-block; 
        min-height: 20px;
    }

    li{
        color: var(--Red-Red-500, #E62129);
    }

    #btnUnggah:enabled img {
        filter: brightness(0) invert(1);
    }

    .file-preview {
        display: flex;
        align-items: center;
        /* gap: 12px; */
        padding: 8px 12px;
        border: 1px solid #dcdcdc;
        border-radius: 8px;
        background-color: #fff;
        font-size: 0.95rem;
        margin-bottom: 1rem;
        max-width: 70%;
    }

    .file-name {
        flex: 1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .remove-file {
        background: none;
        border: none;
        font-size: 1.2rem;
        cursor: pointer;
        color: #888;
    }

    #filePreview:where(:not([style*="display: none"])) + .upload-btn-group{
        width: 90%;
    }

    .eye-icon{
        width: 1.5em;
        height: 1em;
        margin-left: 8px;
        cursor: pointer;
    }
</style>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const batalButton = document.getElementById("btnBatalUnggah");
        const unggahButton = document.getElementById("btnUnggah");
        const fileInput = document.querySelector("input[type='file'][name='file']");
        const filePreview = document.getElementById("filePreview");
        const fileNameSpan = document.getElementById("fileName");
        const removeFileBtn = document.getElementById("removeFileBtn");

        if (batalButton) {
            batalButton.addEventListener("click", function () {
                window.location.href = "{{ route('academics-event.index') }}";
            });
        }

        if (fileInput && unggahButton) {
            fileInput.addEventListener("change", function () {
                if (fileInput.files.length) {
                    unggahButton.disabled = false;
                    fileNameSpan.textContent = fileInput.files[0].name;
                    filePreview.style.display = "flex";
                    document.querySelector('.upload-card').style.display = 'none';
                } else {
                    unggahButton.disabled = true;
                    filePreview.style.display = "none";
                }
            });
        }

        if (removeFileBtn) {
            removeFileBtn.addEventListener("click", function () {
                fileInput.value = "";
                unggahButton.disabled = true;
                filePreview.style.display = "none";
                document.querySelector('.upload-card').style.display = 'block';
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
        <div class="text-lg-bd">
            <span>Import Event Akademik</span>
            <img src="{{ asset('assets/base/icon-caution.svg')}}" alt="caution-icon" style="height: 1em; width: auto; margin-left: 12px; vertical-align: middle;">
        </div>
        <div class="upload-flex-row">
            <div class="upload-info-col">
                <div class="text-md-rg">
                    Allowed Type: [.xlsx, .xls, .csv]
                </div>
                <a href="#">Download Sample Data (.xlsx)</a>
                <a href="#">Download Sample Data (.csv)</a>
            </div>
            <div class="upload-area">
                <div class="upload-area-title">Unggah File Event Akademik</div>
                <div class="upload-card-and-buttons">
                    <form action="{{ route('academics-event.store-upload') }}" method="POST" enctype="multipart/form-data" style="display: contents;">
                    @csrf
                    <div class="upload-card">
                        <div class="text-md-bd">
                            <img src="{{ asset('assets/icon-upload-gray-600.svg') }}" alt="upload" style="height: 1.5em; width: auto; margin-bottom: 8px;"><br>
                            Tarik & letakkan file di sini
                        </div>
                        <div style="margin-bottom: 12px;">Atau</div>
                        <label class="button button-clean">
                            Pilih File
                            <input type="file" name="file" accept=".xlsx,.xls,.csv" style="display:none;">
                        </label>
                        <div class="text-sm-lg">
                            .xsl & .csv | 5MB
                        </div>
                    </div>
                    <div id="filePreview" class="file-preview" style="display: none;">
                        <span class="file-icon"><img src="{{ asset('assets/icon-file-gray.svg') }}" alt="File Icon"></span>
                        <span id="fileName" class="file-name">file.csv</span>
                        <span class="eye-icon"><img src="{{ asset('assets/icon-eye-gray.svg') }}" alt="Eye Icon"></span>
                        <button type="button" id="removeFileBtn" class="remove-file" aria-label="Remove">&times;</button>
                    </div>

                    <div class="upload-btn-group">
                        <button type="button" class="button button-clean" id="btnBatalUnggah">Batal</button>
                        <button type="submit" class="button button-outline" id="btnUnggah" disabled>
                            Unggah <span style="font-size:1.1em;"><img src="{{ asset('assets/icon-upload-gray-600.svg') }}"></span>
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="content-inside-card">
            <div style="font-weight: 500; margin-bottom: 12px;">
                File yang diterima adalah file .csv dengan pemisah antar kolom berupa titik koma ";"<br>
                Urutan kolom sebagai berikut:
            </div>
            <ul style="text-sm-rg-red">
                <li>kode: kode mata kuliah *)</li>
                <li>nama: nama mata kuliah *)</li>
                <li>sks: jumlah sks mata kuliah *)</li>
                <li>semester: semester mata kuliah *)</li>
                <li>tujuan: tujuan mata kuliah</li>
                <li>deskripsi: deskripsi singkat mata kuliah</li>
                <li>jenis: jenis mata kuliah, pilih salah satu dari Mata Kuliah </li>
                <li>jenis: jenis mata kuliah, pilih salah satu dari Mata Kuliah Dasar Umum, Mata Kuliah Program Studi, Mata Kuliah Sains Dasar, Mata Kuliah Universitas Pertamina *)</li>
                <li>koordinator: NIP Dosen koordinator</li>
                <li>spesial: y/n, y jika mata kuliah spesial, n jika tidak *)</li>
                <li>dibuka: y/n, y jika mata kuliah dibuka untuk prodi lain, n jika tidak *)</li>
                <li>wajib: y/n, y jika mata kuliah wajib, n jika tidak *)</li>
                <li>mbkm: y/n, y jika mata kuliah MBKM, n jika tidak *)</li>
                <li>aktif: y/n, y jika mata kuliah aktif, n jika tidak *)</li>
                <li>prasyarat mata kuliah: kode mata kuliah prasyarat</li>
                <li>namasingkat: nama singkat atau akronim mata kuliah *)</li>
                <li>*) required, jika ada nilai kosong, upload ulang akan mengganti data sebelumnya, prasyarat mata kuliah hanya 1</li>
            </ul>
            <div class="text-md-rg" style="margin-top: 7%;">
                kode; nama; sks; semester; tujuan; deskripsi; jenis; koordinator; spesial; dibuka; wajib; mbkm; aktif; prasyarat; namasingkat<br>
                UP001; Kalkulus; 3; 1; ; ; Mata Kuliah Dasar Umum; 116024; n; y; n; y; n; ; K; y<br>
                UP002; Kimia Dasar; 2; 1; ; ; Mata Kuliah Dasar Umum; 116024; n; y; n; y; n; ; y; UP003-UP321; KD2; y
            </div>
            <div class="text-md-rg" style="margin-top: 7%;">
                <span>Jumlah Data : 0</span><br>
                <span>Jumlah Data Sukses: 0</span><br>
                <span>Jumlah Data Gagal: 0</span>
            </div>
        </div>
    </div>
@endsection