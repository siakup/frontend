@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Semester)')

@section('content')
    <div class="flex flex-col gap-4 p-4 w-full h-full">
        <x-typography variant="heading-h6">Capaian Pembelajaran Lulusan</x-typography>
        <x-button.back href="{{ route('rps.rencana-perkuliahan') }}">Buat RPS (Rencana Pembelajaran Semester)</x-button.back>
        <div class="flex flex-col gap-0">
            <div class="white-red-gradient p-5 rounded-t-md border border-gray-400">
                <x-typography variant="body-medium-bold">Tambah Rencana Perkuliahan</x-typography>
            </div>
            <div x-data="window.RencanaPerkuliahan.createRencanaPerkuliahan()" class="flex flex-col gap-5 content-white rounded-b-md p-5">
                <x-form.input-container>
                    <x-slot name="label">Minggu ke-</x-slot>
                    <x-slot name="input">
                        <x-form.input type="number" name="minggu" x-model="minggu" disabled />
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container>
                    <x-slot name="label">CPMK</x-slot>
                    <x-slot name="input">
                        <x-form.checkbox name="cpmk" :options="$cpmkList" x-model="cpmk" />
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container>
                    <x-slot name="label">Sub CPMK</x-slot>
                    <x-slot name="input">
                        <x-form.textarea id="sub_cpmk" placeholder="Tulis Deskripsi" maxChar="500" rows="9"
                            x-model="sub_cpmk" />
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container>
                    <x-slot name="label">Konten Perkuliahan</x-slot>
                    <x-slot name="input">
                        <x-form.textarea id="sub_cpmk" placeholder="Tulis Deskripsi" maxChar="500" rows="9"
                            x-model="konten" />
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container :labelWrap="true">
                    <x-slot name="label">Total Waktu Kegiatan Tatap Muka dan Terstruktur</x-slot>
                    <x-slot name="input">
                        <div class="grid grid-cols-[1fr_3fr] gap-x-7 gap-y-5 w-full h-full">
                            <x-form.checklist x-model="kuliah" id="kuliah_on" value="kuliah_on" label="Kuliah (K)"
                                :name="'kuliah'" />
                            <div class="flex w-full">
                                <x-form.input x-model="jumlah_waktu_kuliah" x-bind:disabled="!kuliah" type="number"
                                    placeholder="Contoh: 100" />
                                <div class="-ml-16 w-16 input-suffix">
                                    Menit
                                </div>
                            </div>
                            <x-form.checklist x-model="diskusi_latihan" id="diskusi_latihan_on" value="diskusi_latihan_on"
                                label="Diskusi dan Latihan (DL)" :name="'diskusi_latihan'" />
                            <div class="flex w-full">
                                <x-form.input x-model="jumlah_waktu_diskusi" x-bind:disabled="!diskusi_latihan"
                                    name="jumlah_waktu_diskusi" placeholder="Contoh: 100" type="number" />
                                <div class="-ml-16 w-16 input-suffix">
                                    Menit
                                </div>
                            </div>
                            <x-form.checklist x-model="tugas" id="tugas_on" value="tugas_on" label="Tugas (T)"
                                :name="'tugas'" />
                            <div class="flex w-full">
                                <x-form.input x-model="jumlah_waktu_tugas" x-bind:disabled="!tugas"
                                    name="jumlah_waktu_tugas" placeholder="Contoh: 100" type="number" />
                                <div class="-ml-16 w-16 input-suffix">
                                    Menit
                                </div>
                            </div>
                        </div>
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container>
                    <x-slot name="label">Total Waktu Belajar Mandiri</x-slot>
                    <x-slot name="input">
                        <div class="flex w-full">
                            <x-form.input name="total_waktu_belajar_mandiri" placeholder="Contoh: 100" type="number"
                                x-model="total_waktu_belajar_mandiri" />
                            <div class="-ml-16 w-16 input-suffix">
                                Menit
                            </div>
                        </div>
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container :labelWrap="true">
                    <x-slot name="label">Metode Penilaian</x-slot>
                    <x-slot name="input">
                        <div class="grid grid-cols-[1fr_3fr] gap-x-7 gap-y-5 items-center w-full h-full">
                            <x-form.checklist x-model="metode_tugas" id="metode_tugas" value="metode_tugas"
                                        label="Tugas" :name="'metode_tugas'" />
                            <x-form.input x-bind:disabled="!metode_tugas" x-model="isian_tugas" name="isian_tugas"
                                placeholder="Masukkan Nama Penilaian. Contoh: Tugas 1" />
                            <x-form.checklist x-model="metode_uts" id="metode_uts" value="metode_uts" label="UTS"
                                :name="'metode_uts'" />
                            <x-form.input x-bind:disabled="!metode_uts" x-model="isian_uts" name="isian_uts"
                                placeholder="Masukkan Nama Penilaian. Contoh: Tugas 1" inputClass= />
                            <x-form.checklist x-model="metode_uas" id="metode_uas" value="metode_uas" label="UAS"
                                :name="'metode_uas'" />
                            <x-form.input x-bind:disabled="!metode_uas" x-model="isian_uas" name="isian_uas"
                                placeholder="Masukkan Nama Penilaian. Contoh: Tugas 1" />
                        </div>
                    </x-slot>
                </x-form.input-container>
                <div class="flex mt-5 justify-end gap-2">
                    <x-button.secondary x-bind:disabled="isDisabled"
                        x-on:click="$dispatch('open-modal', {id: 'batal-confirmation'})">Batal</x-button.secondary>
                    <x-button.primary x-bind:disabled="isDisabled"
                        x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})">Simpan</x-button.primary>
                </div>
            </div>
        </div>
    </div>




    <x-modal.confirmation id="save-confirmation" title="Tunggu Sebentar" confirmText="Ya, Simpan Sekarang"
        cancelText="Cek Kembali">
        <p>Apakah Anda yakin informasi yang ditambahkan sudah benar?</p>

        <div
            x-on:confirmed.window="
            console.log('Data disimpan');
            window.location.href = '/'; 
        ">
        </div>
    </x-modal.confirmation>
    <x-modal.confirmation id="batal-confirmation" title="Tunggu Sebentar" confirmText="Ya, Batalkan"
        cancelText="Tidak, Kembali" :redirectConfirm="route('rps.rencana-perkuliahan')">
        <p>Apakah Anda yakin ingin membatalkan pembuatan rencana perkuliahan ini?</p>
    </x-modal.confirmation>

@endsection
