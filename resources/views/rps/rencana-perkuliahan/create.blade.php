@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Dosen)')

<script src="{{ asset('js/controllers/rencanaPerkuliahan.js') }}" defer></script>

@section('content')
    <div class="page-header pl-5">
        <x-typography variant="heading-h6">Capaian Pembelajaran Lulusan</x-typography>
    </div>
    <x-button.back class="ml-2 mb-4" href="{{ route('rps.rencana-perkuliahan') }}">Buat RPS (Rencana Pembelajaran Semester)</x-button.back>

    
    <div class="cpl-head border border-[#d9d9d9] ml-3 grad-peach">
        <x-typography variant="body-medium-bold">Tambah Rencana Perkuliahan</x-typography>
    </div>

    <div x-data="rencanaPerkuliahan()">
        <x-container variant="content" class="ml-3 border !rounded-t-none" >
            <x-form.input-container class="w-[255px]" containerClass="mb-5">
                <x-slot name="label">Minggu ke-</x-slot>
                <x-slot name="input">
                    <x-form.input
                        type="number"
                        name="minggu"
                        x-model="minggu"
                    />
                </x-slot>
            </x-form.input-container>
            <x-form.input-container class="w-[260px]" containerClass="!mt-10 mb-10">
                <x-slot name="label">CPMK</x-slot>
                <x-slot name="input">
                    <x-form.checkbox
                        name="cpmk"
                        :options="$cpmkList"
                        class="!gap-x-20"
                        x-model="cpmk"
                    />
                </x-slot>
            </x-form.input-container>
            <x-form.input-container class="w-[210px]">
                <x-slot name="label">Sub CPMK</x-slot>
                <x-slot name="input">
                    <x-form.textarea
                        id="sub_cpmk"
                        placeholder="Tulis Deskripsi"
                        maxChar="500"
                        rows="9"
                        x-model="sub_cpmk"
                    />
                </x-slot>
            </x-form.input-container>
            <x-form.input-container class="w-[210px]" containerClass="!mt-5">
                <x-slot name="label">Konten Perkuliahan</x-slot>
                <x-slot name="input">
                    <x-form.textarea
                        id="sub_cpmk"
                        placeholder="Tulis Deskripsi"
                        maxChar="500"
                        rows="9"
                        x-model="konten"
                    />
                </x-slot>
            </x-form.input-container>
            <x-form.input-container labelClass="!text-wrap w-[220px]" containerClass="!mt-5">
                <x-slot name="label">Total Waktu Kegiatan Tatap Muka dan Terstruktur</x-slot>
                <x-slot name="input">
                    <div class="grid grid-cols-[auto_1fr] gap-x-7 gap-y-5">
                        <x-form.checklist x-model="kuliah" class="!w-fit" id="kuliah_on" value="kuliah_on" label="Kuliah (K)" :name="'kuliah'"/>
                        <div class="flex items-center">
                            <x-form.input
                                x-model="jumlah_waktu_kuliah"
                                x-bind:class="!kuliah ? '!bg-[#F5F5F5] text-[#8C8C8C] cursor-not-allowed' : 'bg-white'"
                                x-bind:disabled="!kuliah"
                                name="jumlah_waktu_kuliah"
                                placeholder="Contoh: 100"
                                type="number"
                                inputClass="!rounded-r-none !border-r-0 !border-[1px] !border-[#BFBFBF] !w-[600px] !focus:ring-0 !focus:outline-none"
                            />
                            <div class="-ml-[2px] border border-[1px] border-[#BFBFBF] rounded-r-lg bg-[#E8E8E8] w-[63px] h-[42px] flex items-center justify-center text-[#8C8C8C] text-sm">
                                Menit
                            </div>
                        </div>
                        <x-form.checklist x-model="diskusi_latihan" class="!w-fit" id="diskusi_latihan_on" value="diskusi_latihan_on" label="Diskusi dan Latihan (DL)" :name="'diskusi_latihan'"/>
                        <div class="flex items-center">
                            <x-form.input
                                x-model="jumlah_waktu_diskusi"
                                x-bind:class="!diskusi_latihan ? '!bg-[#F5F5F5] text-[#8C8C8C] cursor-not-allowed' : 'bg-white'"
                                x-bind:disabled="!diskusi_latihan"
                                name="jumlah_waktu_diskusi"
                                placeholder="Contoh: 100"
                                type="number"
                                inputClass="!rounded-r-none !border-r-0 !border-[1px] !border-[#BFBFBF] !w-[600px] !focus:ring-0 !focus:outline-none"
                            />
                            <div class="-ml-[2px] border border-[1px] border-[#BFBFBF] rounded-r-lg bg-[#E8E8E8] w-[63px] h-[42px] flex items-center justify-center text-[#8C8C8C] text-sm">
                                Menit
                            </div>
                        </div>
                        <x-form.checklist x-model="tugas" class="!w-fit" id="tugas_on" value="tugas_on" label="Tugas (T)" :name="'tugas'"/>
                        <div class="flex items-center">
                            <x-form.input
                                x-model="jumlah_waktu_tugas"
                                x-bind:class="!tugas ? '!bg-[#F5F5F5] text-[#8C8C8C] cursor-not-allowed' : 'bg-white'"
                                x-bind:disabled="!tugas"
                                name="jumlah_waktu_tugas"
                                placeholder="Contoh: 100"
                                type="number"
                                inputClass="!rounded-r-none !border-r-0 !border-[1px] !border-[#BFBFBF] !w-[600px] !focus:ring-0 !focus:outline-none"
                            />
                            <div class="-ml-[2px] border border-[1px] border-[#BFBFBF] rounded-r-lg bg-[#E8E8E8] w-[63px] h-[42px] flex items-center justify-center text-[#8C8C8C] text-sm">
                                Menit
                            </div>
                        </div>   
                    </div>
                </x-slot>
            </x-form.input-container>
            <x-form.input-container class="w-[210px]" containerClass="!mt-5">
                <x-slot name="label">Total Waktu Belajar Mandiri</x-slot>
                <x-slot name="input">
                    <div class="flex items-center">
                        <x-form.input
                            name="total_waktu_belajar_mandiri"
                            placeholder="Contoh: 100"
                            type="number"
                            inputClass="!rounded-r-none !border-r-0 !border-[1px] !border-[#BFBFBF] !w-[829px] !focus:ring-0 !focus:outline-none"
                            x-model="total_waktu_belajar_mandiri"
                        />
                        <div class="-ml-[2px] border border-[1px] border-[#BFBFBF] rounded-r-lg bg-[#E8E8E8] w-[63px] h-[42px] flex items-center justify-center text-[#8C8C8C] text-sm">
                            Menit
                    </div>
                    </div>                    
                </x-slot>
            </x-form.input-container>
            <x-form.input-container class="w-[220px]" containerClass="!mt-5">
                <x-slot name="label">Metode Penilaian</x-slot>
                <x-slot name="input">
                    <div class="grid grid-cols-[auto_1fr] gap-x-7 gap-y-5">
                        <x-form.checklist x-model="metode_tugas" class="!w-fit" id="metode_tugas" value="metode_tugas" label="Tugas" :name="'metode_tugas'"/>
                        <x-form.input
                            x-bind:class="!metode_tugas ? '!bg-[#F5F5F5] text-[#8C8C8C] cursor-not-allowed' : 'bg-white'"
                            x-bind:disabled="!metode_tugas"
                            x-model="isian_tugas"
                            name="isian_tugas"
                            placeholder="Masukkan Nama Penilaian. Contoh: Tugas 1"
                            inputClass="!w-[783px] !border-[1px] !border-[#BFBFBF]"
                        />
                        <x-form.checklist x-model="metode_uts" class="!w-fit" id="metode_uts" value="metode_uts" label="UTS" :name="'metode_uts'"/>
                        <x-form.input
                            x-bind:class="!metode_uts ? '!bg-[#F5F5F5] text-[#8C8C8C] cursor-not-allowed' : 'bg-white'"
                            x-bind:disabled="!metode_uts"
                            x-model="isian_uts"
                            name="isian_uts"
                            placeholder="Masukkan Nama Penilaian. Contoh: Tugas 1"
                            inputClass="!w-[783px] !border-[1px] !border-[#BFBFBF]"
                        />
                        <x-form.checklist x-model="metode_uas" class="!w-fit" id="metode_uas" value="metode_uas" label="UAS" :name="'metode_uas'"/>
                        <x-form.input
                            x-bind:class="!metode_uas ? '!bg-[#F5F5F5] text-[#8C8C8C] cursor-not-allowed' : 'bg-white'"
                            x-bind:disabled="!metode_uas"
                            x-model="isian_uas"
                            name="isian_uas"
                            placeholder="Masukkan Nama Penilaian. Contoh: Tugas 1"
                            inputClass="!w-[783px] !border-[1px] !border-[#BFBFBF]"
                        />
                    </div>
                </x-slot>
            </x-form.input-container>
            <div class="flex mt-5 justify-end gap-2">
                <x-button.secondary x-bind:disabled="isDisabled" x-on:click="$dispatch('open-modal', {id: 'batal-confirmation'})">Batal</x-button.secondary>
                <x-button.primary x-bind:disabled="isDisabled" x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})">Simpan</x-button.primary>
            </div>
        </x-container>  
    </div>
    

    <x-modal.confirmation 
        id="save-confirmation" 
        title="Tunggu Sebentar" 
        confirmText="Ya, Simpan Sekarang"
        cancelText="Cek Kembali"
    >
        <p>Apakah Anda yakin informasi yang ditambahkan sudah benar?</p>

        <div
            x-on:confirmed.window="
            console.log('Data disimpan');
            window.location.href = '/'; 
        ">
        </div>
    </x-modal.confirmation>
    <x-modal.confirmation 
        id="batal-confirmation" 
        title="Tunggu Sebentar" 
        confirmText="Ya, Batalkan"
        cancelText="Tidak, Kembali"
        :redirectConfirm="route('rps.rencana-perkuliahan')"
    >
        <p>Apakah Anda yakin ingin membatalkan pembuatan rencana perkuliahan ini?</p>
    </x-modal.confirmation>
    
@endsection