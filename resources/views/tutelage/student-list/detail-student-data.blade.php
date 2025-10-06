@extends('layouts.main')

@section('title', 'Kelompok Perwalian')

@section('breadcrumbs')
  <div class="breadcrumb-item">Beranda</div>
  <div class="breadcrumb-item active">Kelompok Perwalian</div>
@endsection

@section('css')

<style>

.mkv-modal {
  position: fixed;
  inset: 0;
  z-index: 99999;
  display: flex;
  align-items: center;
  justify-content: center;
}

.mkv-modal.hidden { display: none; }

.mkv-backdrop {
  position: absolute;
  inset: 0;
  background: rgba(0,0,0,0.5);
  z-index: 1;
}

.mkv-content {
  position: relative;
  z-index: 2;
  background: #fff;
  border-radius: 14px;
  box-shadow: 0 4px 24px rgba(0,0,0,.12);
  margin: 0 16px;
  width: 840px;
  max-width: 95vw;
  max-height: 90vh;
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

.mkv-header {
  position: sticky;
  top: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 14px 16px;
  border-bottom: 1px solid #F1F5F9;
  background: #F5F5F5;
}

.mkv-title {
  font-weight: 600;
  font-size: 20px;
  text-align: center;
  width: 100%;
}

.mkv-close {
  position: absolute;
  right: 16px;
  top: 12px;
  width: 32px;
  height: 32px;
  border-radius: 8px;
  display: grid;
  place-items: center;
  cursor: pointer;
  border: 1px solid #E5E7EB;
  background: #fff;
  color: #111827;
}

.mkv-close:hover { background: #F9FAFB; }

.mkv-body {
  padding: 20px;
  overflow-y: auto;
}


  .no-scrollbar::-webkit-scrollbar { display: none; }
  .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
  body.modal-open { overflow: hidden !important; }
</style>

@endsection

@section('content')
<div class="page-header">
  <div class="page-title-text">Detail Kartu Studi Mahasiswa</div>
</div>

<div class="academics-layout">
  @include('tutelage.student-list.layout.navbar-tutelage', ["id" => $id])

    <div class="academics-slicing-content content-card p-[10px]">

        <div class="p-[10px] space-y-4">

        <div x-data="{ open: true }" class="rounded-lg border border-[#E8E8E8] overflow-hidden">
        <button type="button"
                @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-3 font-semibold"
                style="background: linear-gradient(to right, #FFFFFF, #FFECED);">
            <span class="text-[#262626]">Data Pribadi</span>
            <span class="inline-flex items-center gap-2 text-sm text-[#E62129]">
            <span x-text="open ? 'Tutup' : 'Buka'"></span>
            <img src="{{ asset('assets/icon-arrow-right-red.svg') }}"
                alt="arrow"
                class="w-4 h-4 transition-transform duration-200"
                :class="open ? 'rotate-[-90deg]' : 'rotate-90'">
            </span>
        </button>

        <div x-show="open" x-collapse>
            <table class="min-w-full table-fixed text-sm text-[#262626]">
            <tbody>
                <tr class="h-[38px]">
                <td class="w-[320px] px-6 py-3 font-normal bg-[#E8E8E8]">Nama Mahasiswa</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $student['nama'] ?? 'Fauzan Akmal Mukhlas' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Nomor Induk Mahasiswa</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $student['nim'] ?? '105221015' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Judul Tugas Akhir</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $student['judul_ta'] ?? '-' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Nomor Induk Kependudukan</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $student['nik'] ?? '3333333333333333' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Kota Lahir</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $student['kota_lahir'] ?? 'Jakarta Selatan' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Tanggal Lahir</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $student['tgl_lahir'] ?? '01 – 02 – 2025' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Agama</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $student['agama'] ?? 'Islam' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Jenis Kelamin</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $student['jenis_kelamin'] ?? 'Pria' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Kewarganegaraan</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $student['kewarganegaraan'] ?? 'WNI' }}</td>
                </tr>
                <tr class="h-[38px] align-top">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Alamat Asal (Jalan)</td>
                <td class="px-6 py-3 font-semibold bg-white">
                    {{ $student['alamat_asal'] ?? 'Jl. Teuku Nyak Arief, RT.7/RW.8, Simprug, Kec. Kby. Lama, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta' }}
                </td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">RT</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $student['rt'] ?? '007' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">RW</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $student['rw'] ?? '008' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Dusun</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $student['dusun'] ?? 'Durian' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Kelurahan</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $student['kelurahan'] ?? 'Simprug' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Kecamatan</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $student['kecamatan'] ?? 'Kebayoran Lama' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Kota Kabupaten</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $student['kota'] ?? 'Jakarta Selatan' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Provinsi</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $student['provinsi'] ?? 'Daerah Khusus Ibukota Jakarta' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Kode Pos</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $student['kode_pos'] ?? '12220' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Jenis Tinggal</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $student['jenis_tinggal'] ?? 'Bersama Orang Tua' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Jenis Tinggal Lainnya</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $student['jenis_tinggal_lain'] ?? 'Asrama' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Alat Transportasi</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $student['transport'] ?? 'Angkutan Umum' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Alat Transportasi Lainnya (Isi Jika Pilih Lainnya)</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $student['transport_lain'] ?? '-' }}</td>
                </tr>
                <tr class="align-top">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Alamat Domisili</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">
                    {{ $student['alamat_domisili'] ?? 'ASRAMA SASAK DALAM 2, ASRAMA MAHASISWA H.SUGIANTO, JL. SASAK II NO.5 15, RT.5/RW.2, KLP. DUA, KEC. KB. JERUK, KOTA JAKARTA BARAT, DKI JAKARTA 11550 LEWAT JL. ARTERI PERMATA HIJAU DAN JL. PANJANG ARTERI KLP. DUA RAYA.' }}
                </td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Nomor Telepon Rumah</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $student['telp_rumah'] ?? '0909090909' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Nomor Telepon Seluler</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $student['telp_seluler'] ?? '090909090909' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Nomor Telepon Darurat</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $student['telp_darurat'] ?? '0909090909090' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Email</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $student['email'] ?? 'siup@universitaspertamina.ac.id' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Penerima KPS</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ ($student['kps'] ?? false) ? 'Ya' : 'Tidak' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Nomor KPS (Jika Ya)</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $student['no_kps'] ?? '-' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Kebutuhan Khusus</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ ($student['kebutuhan_khusus'] ?? false) ? 'Ya' : 'Tidak' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Nama Ibu Kandung</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $student['ibu_kandung'] ?? 'Maulini' }}</td>
                </tr>
            </tbody>
            </table>
        </div>
        </div>


        {{-- === Data Orang Tua === --}}
        <div x-data="{ open: false }" class="rounded-lg border border-[#E8E8E8] overflow-hidden">
        <button type="button"
                @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-3 font-semibold"
                style="background: linear-gradient(to right, #FFFFFF, #FFECED);">
            <span class="text-[#262626]">Data Orang Tua</span>
            <span class="inline-flex items-center gap-2 text-sm text-[#E62129]">
            <span x-text="open ? 'Tutup' : 'Buka'"></span>
            <img src="{{ asset('assets/icon-arrow-right-red.svg') }}"
                alt="arrow"
                class="w-4 h-4 transition-transform duration-200"
                :class="open ? 'rotate-[-90deg]' : 'rotate-90'">
            </span>
        </button>

        <div x-show="open" x-collapse>
            <table class="min-w-full table-fixed text-sm text-[#262626]">
            <tbody>
                {{-- Ayah --}}
                <tr class="h-[38px]">
                <td class="w-[320px] px-6 py-3 font-normal bg-[#E8E8E8]">Nama Ayah</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $ortu['nama_ayah'] ?? 'Agus' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Nomor Induk Kependudukan Ayah</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $ortu['nik_ayah'] ?? '3039202920292' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Tanggal Lahir Ayah</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $ortu['tgl_lahir_ayah'] ?? '10 - 10 - 2010' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Riwayat Pendidikan Ayah</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $ortu['pendidikan_ayah'] ?? 'SMA' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Pendidikan Ayah Lainnya (Isi Jika Pilih Lainnya)</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $ortu['pendidikan_ayah_lain'] ?? '-' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Pekerjaan Ayah</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $ortu['pekerjaan_ayah'] ?? 'Karyawan Swasta' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Pekerjaan Ayah Lainnya (Isi Jika Pilih Lainnya)</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $ortu['pekerjaan_ayah_lain'] ?? '-' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Penghasilan Ayah</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $ortu['penghasilan_ayah'] ?? 'Rp. 2.000.000 - Rp. 4.999.999' }}</td>
                </tr>

                {{-- Ibu --}}
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Nama Ibu</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $ortu['nama_ibu'] ?? 'Maulini' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Nomor Induk Kependudukan Ibu</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $ortu['nik_ibu'] ?? '3938292972722' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Tanggal Lahir Ibu</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $ortu['tgl_lahir_ibu'] ?? '09 - 09 - 2009' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Riwayat Pendidikan Ibu</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $ortu['pendidikan_ibu'] ?? 'SD' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Pendidikan Ibu Lainnya (Isi Jika Pilih Lainnya)</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $ortu['pendidikan_ibu_lain'] ?? '-' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Pekerjaan Ibu</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $ortu['pekerjaan_ibu'] ?? 'Tidak Bekerja' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Pekerjaan Ibu Lainnya (Isi Jika Pilih Lainnya)</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $ortu['pekerjaan_ibu_lain'] ?? '-' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Penghasilan Ibu</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $ortu['penghasilan_ibu'] ?? 'Kurang dari Rp. 500.000' }}</td>
                </tr>

                {{-- Data Tambahan --}}
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Jumlah Tanggungan Orang Tua</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $ortu['tanggungan'] ?? '2' }}</td>
                </tr>
                <tr class="align-top">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Alamat Orang Tua</td>
                <td class="px-6 py-3 font-semibold bg-white">
                    {{ $ortu['alamat'] ?? 'Jl. Teuku Nyak Arief, RT.7/RW.8, Simprug, Kec. Kby. Lama, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12220' }}
                </td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Alamat Alternatif Orang Tua</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $ortu['alamat_alt'] ?? '-' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Nomor HP Orang Tua</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $ortu['hp'] ?? '9232932323' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Kecamatan Orang Tua</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $ortu['kecamatan'] ?? 'Kebayoran Lama' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Kota Orang Tua</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $ortu['kota'] ?? 'Jakarta Selatan' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Provinsi Orang Tua</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $ortu['provinsi'] ?? 'Daerah Khusus Ibukota Jakarta' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Email Orang Tua</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $ortu['email'] ?? 'maulini@gmail.com' }}</td>
                </tr>
            </tbody>
            </table>
        </div>
        </div>


        {{-- === Data SMTA === --}}
        <div x-data="{ open: false }" class="rounded-lg border border-[#E8E8E8] overflow-hidden">
        <button type="button"
                @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-3 font-semibold"
                style="background: linear-gradient(to right, #FFFFFF, #FFECED);">
            <span class="text-[#262626]">Data SMTA</span>
            <span class="inline-flex items-center gap-2 text-sm text-[#E62129]">
            <span x-text="open ? 'Tutup' : 'Buka'"></span>
            <img src="{{ asset('assets/icon-arrow-right-red.svg') }}"
                alt="arrow"
                class="w-4 h-4 transition-transform duration-200"
                :class="open ? 'rotate-[-90deg]' : 'rotate-90'">
            </span>
        </button>

        <div x-show="open" x-collapse>
            <table class="min-w-full table-fixed text-sm text-[#262626]">
            <tbody>
                <tr class="h-[38px]">
                <td class="w-[320px] px-6 py-3 font-normal bg-[#E8E8E8]">Nomor Induk Siswa Nasional</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $smta['nisn'] ?? '9218328323' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Tahun Lulus</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $smta['tahun_lulus'] ?? '2024' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Asal Sekolah</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $smta['asal_sekolah'] ?? 'SMK Taruna Bangsa' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Provinsi Sekolah</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $smta['provinsi'] ?? 'Daerah Khusus Ibukota Jakarta' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Kota Sekolah</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $smta['kota'] ?? 'Jakarta Barat' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Kecamatan Sekolah</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $smta['kecamatan'] ?? 'Kebon Jeruk' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Jenis Sekolah</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $smta['jenis'] ?? 'SMKS' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Jurusan Sekolah</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $smta['jurusan'] ?? 'SMK Teknik' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Nomor Ijazah</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $smta['no_ijazah'] ?? 'M-SMK-1292/2911' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Nilai UAN Matematika</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $smta['uan_mtk'] ?? '84.50' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Nilai UAN Bahasa Inggris</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $smta['uan_inggris'] ?? '84.50' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Nilai UAN Fisika</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $smta['uan_fisika'] ?? '84.50' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Nilai Rapor Matematika</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $smta['rapor_mtk'] ?? '84.50' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Nilai Rapor Bahasa Inggris</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $smta['rapor_inggris'] ?? '85.40' }}</td>
                </tr>
            </tbody>
            </table>
        </div>
        </div>

        {{-- === Data Kesehatan === --}}
        <div x-data="{ open: false }" class="rounded-lg border border-[#E8E8E8] overflow-hidden">
        <button type="button"
                @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-3 font-semibold"
                style="background: linear-gradient(to right, #FFFFFF, #FFECED);">
            <span class="text-[#262626]">Data Kesehatan</span>
            <span class="inline-flex items-center gap-2 text-sm text-[#E62129]">
            <span x-text="open ? 'Tutup' : 'Buka'"></span>
            <img src="{{ asset('assets/icon-arrow-right-red.svg') }}"
                alt="arrow"
                class="w-4 h-4 transition-transform duration-200"
                :class="open ? 'rotate-[-90deg]' : 'rotate-90'">
            </span>
        </button>

        <div x-show="open" x-collapse>
            <table class="min-w-full table-fixed text-sm text-[#262626]">
            <tbody>
                <tr class="h-[38px]">
                <td class="w-[320px] px-6 py-3 font-normal bg-[#E8E8E8]">Keterangan Bebas Buta Warna</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $health['buta_warna'] ?? 'Tidak Buta Warna' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Keterangan Napza</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $health['napza'] ?? 'Bebas NAPZA' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Riwayat Kesehatan Pribadi</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $health['riwayat_pribadi'] ?? 'Ya' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Riwayat Kesehatan Keluarga</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $health['riwayat_keluarga'] ?? 'Ya' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#E8E8E8]">Pernyataan Kesehatan</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $health['pernyataan_kesehatan'] ?? '-' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Pernyataan Napza</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $health['pernyataan_napza'] ?? '-' }}</td>
                </tr>
            </tbody>
            </table>
        </div>
        </div>

        {{-- === Dokumen Pendukung === --}}
        <div x-data="dokPendukung()" class="rounded-lg border border-[#E8E8E8] overflow-hidden">
        <button type="button"
                @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-3 font-semibold"
                style="background: linear-gradient(to right, #FFFFFF, #FFECED);">
            <span class="text-[#262626]">Dokumen Pendukung</span>
            <span class="inline-flex items-center gap-2 text-sm text-[#E62129]">
            <span x-text="open ? 'Tutup' : 'Buka'"></span>
            <img src="{{ asset('assets/icon-arrow-right-red.svg') }}"
                alt="arrow"
                class="w-4 h-4 transition-transform duration-200"
                :class="open ? 'rotate-[-90deg]' : 'rotate-90'">
            </span>
        </button>

        <div x-show="open" x-collapse>
            <table class="min-w-full table-fixed text-sm text-[#262626]">
            <tbody>
                @php
                // mapping label => key backend
                $docs = [
                    'Ijazah/Surat Keterangan Lulus' => 'ijazah_skl',
                    'Foto' => 'foto',
                    'Akta Kelahiran' => 'akta_lahir',
                    'Kartu Peserta Ujian' => 'kartu_peserta',
                    'Bukti Pembayaran' => 'bukti_bayar',
                    'Sertifikat Prestasi' => 'sertifikat_prestasi',
                    'Kartu Keluarga' => 'kartu_keluarga',
                    'Kartu Identitas' => 'kartu_identitas',
                    'Surat Keterangan Bebas Buta Warna' => 'skb_buta_warna',
                    'Surat Pernyataan Mahasiswa Baru' => 'spm_baru',
                    'Rapor' => 'rapor',
                    'Transkrip Nilai' => 'transkrip',
                    'Ijazah' => 'ijazah',
                    'Hasil Tes Skor TKDA/TKA' => 'tkda_tka',
                    'Hasil Tes Bahasa Inggris (TOEFL/IELTS)' => 'english_test',
                ];
                @endphp

                @foreach($docs as $label => $key)
                @php $i = $loop->index; $left = $i%2===0 ? '#E8E8E8' : '#F5F5F5'; $right = $i%2===0 ? '#F5F5F5' : '#FFFFFF'; @endphp
                <tr class="h-[38px]">
                    <td class="w-[320px] px-6 py-3 font-normal" style="background: {{ $left }};">{{ $label }}</td>
                    <td class="px-6 py-3 font-semibold" style="background: {{ $right }};">
                    <template x-if="loadingKey === '{{ $key }}'">
                        <span class="text-gray-500">Memuat…</span>
                    </template>
                    <template x-if="loadingKey !== '{{ $key }}'">
                        <a href="#"
                        @click.prevent="openDoc('{{ $key }}')"
                        class="underline text-[#1D4ED8] hover:opacity-80">Dokumen</a>
                    </template>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        </div>

        <script>
        function dokPendukung(){
            return {
            open: true,
            loadingKey: null,

            async openDoc(key){
                try{
                this.loadingKey = key;

                // === Ganti endpoint route backend ===
                const nim = @json($student['nim'] ?? null);
                const url = `/api/students/${nim ?? 'dummy'}/documents/${key}`;

                const res = await fetch(url, { headers: { 'Accept': 'application/json' }});
                if(!res.ok){

                    if(res.status === 404){ alert('Dokumen tidak ditemukan'); return; }
                    throw new Error('Gagal memuat dokumen');
                }

                // A) backend balas { url: "https://..." }
                // B) backend balas file (blob)
                const contentType = res.headers.get('content-type') || '';
                if(contentType.includes('application/json')){
                    const data = await res.json();
                    if(data?.url){ window.open(data.url, '_blank'); }
                    else { alert('URL dokumen tidak tersedia'); }
                } else {
                    const blob = await res.blob();
                    const fileUrl = URL.createObjectURL(blob);
                    window.open(fileUrl, '_blank');
                }
                } catch(e){
                console.error(e);
                alert('Terjadi kesalahan saat membuka dokumen.');
                } finally{
                this.loadingKey = null;
                }
            }
            }
        }
        </script>

        {{-- === Status Administrasi Akademik === --}}
        <div x-data="{ open: false }" class="rounded-lg border border-[#E8E8E8] overflow-hidden">
        <button type="button"
                @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-3 font-semibold"
                style="background: linear-gradient(to right, #FFFFFF, #FFECED);">
            <span class="text-[#262626]">Status Administrasi Akademik</span>
            <span class="inline-flex items-center gap-2 text-sm text-[#E62129]">
            <span x-text="open ? 'Tutup' : 'Buka'"></span>
            <img src="{{ asset('assets/icon-arrow-right-red.svg') }}"
                alt="arrow"
                class="w-4 h-4 transition-transform duration-200"
                :class="open ? 'rotate-[-90deg]' : 'rotate-90'">
            </span>
        </button>

        <div x-show="open" x-collapse>
            <table class="min-w-full table-fixed text-sm text-[#262626]">
            <tbody>
                <tr class="h-[38px]">
                <td class="w-[320px] px-6 py-3 font-normal bg-[#E8E8E8]">Status Administrasi</td>
                <td class="px-6 py-3 font-semibold bg-[#F5F5F5]">{{ $statusAdmin['administrasi'] ?? 'Belum Membayar' }}</td>
                </tr>
                <tr class="h-[38px]">
                <td class="px-6 py-3 font-normal bg-[#F5F5F5]">Status Akademik</td>
                <td class="px-6 py-3 font-semibold bg-white">{{ $statusAdmin['akademik'] ?? 'Tidak Aktif' }}</td>
                </tr>
            </tbody>
            </table>
        </div>
        </div>



        {{-- === Statistik IPK Mahasiswa === --}}
        <div x-data="{ open: false }" class="rounded-lg border border-[#E8E8E8] overflow-hidden">
            <button type="button"
                    @click="open = !open"
                    class="w-full flex items-center justify-between px-4 py-3 font-semibold"
                    style="background: linear-gradient(to right, #FFFFFF, #FFECED);">
                <span class="text-[#262626]">Statistik IPK Mahasiswa</span>
                <span class="inline-flex items-center gap-2 text-sm text-[#E62129]">
                    <span x-text="open ? 'Tutup' : 'Buka'"></span>
                    <img src="{{ asset('assets/icon-arrow-right-red.svg') }}" alt="arrow"
                        class="w-4 h-4 transition-transform duration-200"
                        :class="open ? 'rotate-[-90deg]' : 'rotate-90'">
                </span>
            </button>

            <div x-show="open" x-collapse class="p-4">
                <div class="w-full">
                    <h3 class="text-center font-semibold mb-4">Statistik IPK dan IPS Mahasiswa</h3>

                    <div class="w-full h-[400px]">
                        <canvas id="chartIpkIps" class="w-full h-full"></canvas>
                    </div>

                    <div class="mt-5 flex justify-end gap-3">
                        <button onclick="printChart()"
                                class="h-9 px-4 rounded-lg bg-[#E62129] text-white hover:opacity-90">
                            Cetak Grafik
                        </button>
                        <button onclick="downloadChart()"
                                class="h-9 px-4 rounded-lg bg-[#E62129] text-white hover:opacity-90">
                            Unduh Grafik
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
        document.addEventListener('alpine:init', () => {
            const ctx = document.getElementById('chartIpkIps').getContext('2d');

            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [
                        '2021 Ganjil','2021 Genap','2021 Pendek',
                        '2022 Ganjil','2022 Genap','2022 Pendek',
                        '2023 Ganjil','2023 Genap','2023 Pendek',
                        '2024 Ganjil'
                    ],
                    datasets: [
                        {
                            label: 'IPK',
                            data: [3.0, 3.35, 3.1, 3.43, 3.3, 3.1, 3.47, 3.2, 3.6, 3.7],
                            borderColor: '#2563eb',
                            backgroundColor: '#2563eb',
                            tension: 0.3
                        },
                        {
                            label: 'IPS',
                            data: [3.0, 3.31, 3.0, 3.57, 3.41, 3.2, 3.62, 3.79, 3.5, 3.8],
                            borderColor: '#84cc16',
                            backgroundColor: '#84cc16',
                            tension: 0.3
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                padding: 15
                            }
                        }
                    },
                    scales: {
                        y: {
                            min: 1,
                            max: 5,
                            ticks: { stepSize: 1 }
                        }
                    }
                }
            });

            window.downloadChart = function(){
                const a = document.createElement('a');
                a.href = chart.toBase64Image();
                a.download = 'statistik-ipk-ips.png';
                a.click();
            }

            window.printChart = function(){
                const w = window.open('', '_blank');
                w.document.write('<img src="' + chart.toBase64Image() + '" />');
                w.print();
            }
        });
        </script>
        @endpush


        {{-- === Catatan Akademis Mahasiswa === --}}
        <div x-data="{ open: false }" class="rounded-lg border border-[#E8E8E8] overflow-hidden">

            <button type="button"
                    @click="open = !open"
                    class="w-full flex items-center justify-between px-4 py-3 font-semibold"
                    style="background: linear-gradient(to right, #FFFFFF, #FFECED);">
                <span class="text-[#262626]">Catatan Akademis Mahasiswa</span>
                <span class="inline-flex items-center gap-2 text-sm text-[#E62129]">
                    <span x-text="open ? 'Tutup' : 'Buka'"></span>
                    <img src="{{ asset('assets/icon-arrow-right-red.svg') }}" alt="arrow"
                        class="w-4 h-4 transition-transform duration-200"
                        :class="open ? 'rotate-[-90deg]' : 'rotate-90'">
                </span>
            </button>

            <div x-show="open" x-collapse>
                <x-table id="tblAcademicNotes" class="text-sm">
                    <x-table-head>
                        <x-table-row>
                            <x-table-header class="w-[160px]">Tahun / Term</x-table-header>
                            <x-table-header class="w-[100px]">IPS</x-table-header>
                            <x-table-header class="w-[100px]">IPK</x-table-header>
                            <x-table-header class="w-[140px]">SKS Diambil</x-table-header>
                            <x-table-header class="w-[140px]">SKS Diperoleh</x-table-header>
                            <x-table-header class="w-[160px]">Opsi</x-table-header>
                        </x-table-row>
                    </x-table-head>

                    <x-table-body>
                        @forelse($academicNotes as $row)
                            <x-table-row>
                                <x-table-cell>{{ $row['term'] }}</x-table-cell>
                                <x-table-cell>{{ $row['ips'] }}</x-table-cell>
                                <x-table-cell>{{ $row['ipk'] }}</x-table-cell>
                                <x-table-cell>{{ $row['sks_diambil'] }} SKS</x-table-cell>
                                <x-table-cell>{{ $row['sks_diperoleh'] }} SKS</x-table-cell>
                                <x-table-cell>
                                    <button
                                        class="btn-detail inline-flex items-center gap-2 underline text-[#1D4ED8] hover:opacity-80"
                                        data-term="{{ $row['term'] }}"
                                        data-detail='@json($row['detail'])'>
                                        <img src="{{ asset('assets/icon-search-blue.svg') }}" class="w-4 h-4" alt="detail">
                                        <span>Detail Akademis</span>
                                    </button>
                                </x-table-cell>
                            </x-table-row>
                        @empty
                            <x-table-row>
                                <x-table-cell colspan="6" class="text-center text-gray-500">
                                    Belum Ada Data
                                </x-table-cell>
                            </x-table-row>
                        @endforelse
                    </x-table-body>
                </x-table>
            </div>
        </div>

        {{-- === Modal === --}}
        <div id="modalDetail" class="mkv-modal hidden ">
        <div class="mkv-backdrop" onclick="closeModal()"></div>

        <div class="mkv-content ">
            <div class="mkv-header">
            <div class="mkv-title" id="modalTitle">Detail Akademis</div>
            <button type="button" class="mkv-close" onclick="closeModal()">✕</button>
            </div>

            <div class="mkv-body">
            <div class="overflow-hidden rounded-lg border border-[#E8E8E8]">
                <table class="min-w-full table-fixed text-sm text-[#262626] text-center">
                <thead>
                    <tr class="h-[38px] bg-[#E8E8E8]">
                    <th class="px-6 py-3 text-left font-semibold">Nama Mata Kuliah</th>
                    <th class="px-6 py-3 text-left font-semibold">Nama Kelas</th>
                    <th class="px-6 py-3 text-center font-semibold w-[80px]">Nilai</th>
                    </tr>
                </thead>
                <tbody id="modalDetailBody">
                    {{-- diisi pake JS --}}
                </tbody>
                </table>
            </div>

            <div class="mt-5 flex justify-end">
                <button onclick="closeModal()"
                class="h-9 px-4 rounded-lg border border-[#E62129] text-[#E62129]">
                Kembali
                </button>
            </div>
            </div>
        </div>
        </div>


        @push('scripts')
        <script>
        function closeModal() {
        document.getElementById('modalDetail').classList.add('hidden');
        document.body.classList.remove('modal-open');
        }

        document.querySelectorAll('.btn-detail').forEach(btn => {
        btn.addEventListener('click', () => {
            const term = btn.dataset.term;
            const detail = JSON.parse(btn.dataset.detail || '[]');

            // judul
            document.getElementById('modalTitle').innerText = `Detail Akademis - ${term}`;

            // isi
            const tbody = document.getElementById('modalDetailBody');
            tbody.innerHTML = '';
            if (detail.length === 0) {
            tbody.innerHTML = `
                <tr>
                <td colspan="3" class="px-6 py-3 text-center text-gray-500">
                    Belum ada detail mata kuliah.
                </td>
                </tr>`;
            } else {
            detail.forEach((d, i) => {
                const bgLeft  = i % 2 === 0 ? '#F5F5F5' : '#FFFFFF';
                const bgRight = i % 2 === 0 ? '#FFFFFF' : '#F5F5F5';

                tbody.innerHTML += `
                <tr class="h-[38px]">
                    <td class="px-6 py-3 font-normal" style="background:${bgLeft}">${d.mk}</td>
                    <td class="px-6 py-3 font-normal" style="background:${bgRight}">${d.kelas}</td>
                    <td class="px-6 py-3 text-center font-semibold" style="background:${bgLeft}">${d.nilai}</td>
                </tr>`;
            });
            }

            document.getElementById('modalDetail').classList.remove('hidden');
            document.body.classList.add('modal-open');
        });
        });
        </script>
        @endpush


        <div class="pt-2 flex justify-end ml-auto">
            <a href="{{ url()->previous() }}"
                class="inline-flex items-center justify-center h-9 px-4 rounded-lg border border-[#E62129] text-[#E62129]">
                Kembali
            </a>
        </div>

        </div>

    </div>
</div>

@endsection
