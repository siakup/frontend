@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Semester)')

<script src="{{ asset('js/controllers/rpsDeskripsiUmum.js') }}" defer></script>

@section('content')
    <x-container :variant="'content-wrapper'">
        <x-typography variant="heading-h6">Buat RPS (Rencana Pembelajaran Semester)</x-typography>
        <x-button.back class="ml-2" href="{{ route('rps.index') }}">RPS (Rencana Pembelajaran Semester)</x-button.back>
        <div class="flex flex-col gap-0">
            @include('rps.layout.navbar-rps')
            <x-container x-data="deskripsiUmum()" variant="content-under-navbar">
                <x-typography variant="body-medium-bold">Informasi RPS</x-typography>
                <x-form.input-container labelClass="w-50">
                    <x-slot name="label">Periode</x-slot>
                    <x-slot name="input">
                        <x-form.dropdown variant="gray" buttonId="dropdownPeriodeButton" dropdownId="dropdownPeriodeList"
                            label="-Pilih Periode Akademik-" :dropdownItem="$periodeList" dropdownContainerClass="w-full"
                            x-model="periode" />
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container labelClass="w-50">
                    <x-slot name="label">Program Studi</x-slot>
                    <x-slot name="input">
                        <x-form.dropdown variant="gray" buttonId="dropdownProdiButton" dropdownId="dropdownProdiList"
                            label="-Pilih Program Studi-" :dropdownItem="$prodiList" dropdownContainerClass="w-full"
                            x-model="prodi" />
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container labelClass="w-50">
                    <x-slot name="label">Mata Kuliah</x-slot>
                    <x-slot name="input">
                        <x-form.dropdown variant="gray" buttonId="dropdownMatkulButton" dropdownId="dropdownMatkulList"
                            label="-Pilih Mata Kuliah-" :dropdownItem="$matkulList" dropdownContainerClass="w-full" :imgSrc="asset('assets/icons/arrow-down/grey-20.svg')"
                            x-model="mata_kuliah" />
                    </x-slot>
                </x-form.input-container>
                <div class="grid grid-cols-2 gap-5">
                    <x-form.input-container labelClass="w-50">
                        <x-slot name="label">Bobot (SKS)</x-slot>
                        <x-slot name="input">
                            <x-form.input disabled type="number" name="bobot" x-model="bobot"></x-form.input>
                        </x-slot>
                    </x-form.input-container>
                    <x-form.input-container labelClass="w-50">
                        <x-slot name="label">Semester</x-slot>
                        <x-slot name="input">
                            <x-form.input disabled name="semester" x-model="semester"></x-form.input>
                        </x-slot>
                    </x-form.input-container>
                    <x-form.input-container labelClass="w-50">
                        <x-slot name="label">Rumpun MK</x-slot>
                        <x-slot name="input">
                            <x-form.input disabled name="rumpun_mk" x-model="rumpun_mk"></x-form.input>
                        </x-slot>
                    </x-form.input-container>
                    <x-form.input-container labelClass="w-50">
                        <x-slot name="label">Level Program</x-slot>
                        <x-slot name="input">
                            <x-form.input disabled name="level_program" x-model="level_program"></x-form.input>
                        </x-slot>
                    </x-form.input-container>
                </div>
                <x-form.input-container class="w-50">
                    <x-slot name="label">Deskripsi Singkat MK</x-slot>
                    <x-slot name="input">
                        <x-form.textarea placeholder="Tulis Deskripsi" id="deskripsi_singkat_mk" :maxChar="100"
                            rows="5" x-model="deskripsi_singkat_mk" />
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container labelClass="w-50" :labelWrap="true">
                    <x-slot name="label">Materi Pembelajaran / Pokok Bahasan</x-slot>
                    <x-slot name="input">
                        <x-form.textarea placeholder="Tulis Deskripsi" id="materi_pembelajaran" :maxChar="100"
                            x-model="materi_pembelajaran" />
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container labelClass="w-50">
                    <x-slot name="label">Pustaka</x-slot>
                    <x-slot name="input">
                        <x-form.textarea placeholder="Tulis Deskripsi" id="pustaka" :maxChar="1000" x-model="pustaka" />
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container labelClass="w-50">
                    <x-slot name="label">Metode Pembelajaran</x-slot>
                    <x-slot name="input">
                        <div class="flex gap-20">
                            <x-form.checklist x-model="kuliah" :id="'kuliah'" :value="'kuliah_on'" label="Kuliah (K)"
                                :name="'kuliah'" />
                            <x-form.checklist x-model="diskusi_latihan" :id="'diskusilatihan'" :value="'diskusi_on'"
                                label="Diskusi & Latihan (DL)" :name="'diskusilatihan'" />
                            <x-form.checklist x-model="tugas" :id="'tugas'" :value="'tugas_on'" label="Tugas (T)"
                                :name="'tugas'" />
                        </div>
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container labelClass="w-50" :labelWrap="true">
                    <x-slot name="label">Media Pembelajaran</x-slot>
                    <x-slot name="input">
                        <div class="grid grid-cols-[1fr_4fr] gap-3">
                            <x-form.checklist x-model="perangkat_lunak" :id="'perangkat_lunak'" :value="'perangkat_lunak_on'"
                                label="Perangkat Lunak" :name="'perangkat_lunak'" />
                            <x-form.textarea placeholder="Tulis Deskripsi" id="isian_perangkat_lunak"
                                x-model="isian_perangkat_lunak" :maxChar="100" rows="3" />
                            <x-form.checklist x-model="perangkat_keras" :id="'perangkat_keras'" :value="'perangkat_keras_on'"
                                label="Perangkat Keras" :name="'perangkat_keras_on'" />
                            <x-form.textarea placeholder="Tulis Deskripsi" id="isian_perangkat_keras"
                                x-model="isian_perangkat_keras" :maxChar="100" rows="3" />
                        </div>
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container labelClass="w-50">
                    <x-slot name="label"></x-slot>
                    <x-slot name="input">
                        <x-dialog variant="warning">
                            <x-typography variant="body-medium-regular">Tim pengajar bisa lebih dari satu</x-typography>
                        </x-dialog>
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container labelClass="self-start w-50">
                    <x-slot name="label">Tim Pengajaran</x-slot>
                    <x-slot name="input">
                        <div class="grid grid-cols-[3fr_1fr] gap-3">
                            <div class="flex flex-col gap-2">
                                <template x-for="(pengajar, index) in pengajarList" :key="index">
                                    <x-form.dropdown variant="gray" label="-Tim Pengajar-" :dropdownItem="$timPengajarList"
                                        dropdownContainerClass="w-full" x-model="pengajarList[index].value" />
                                </template>
                            </div>
                            <div class="self-start">
                                <x-button.primary x-on:click="addPengajar()" :icon="'advisory/white-20'">
                                    Tambah Pengajar
                                </x-button.primary>
                            </div>
                        </div>
                    </x-slot>
                </x-form.input-container>

                <x-form.input-container labelClass="w-50">
                    <x-slot name="label">Mata Kuliah Syarat</x-slot>
                    <x-slot name="input">
                        <x-form.dropdown variant="gray" buttonId="dropdownMatkulSyaratButton"
                            dropdownId="dropdownMatkulSyaratList" label="-Mata Kuliah Syarat-" :dropdownItem="$matkulSyaratList"
                            dropdownContainerClass="w-full" x-model="mata_kuliah_syarat" />
                    </x-slot>
                </x-form.input-container>
                <div class="flex mt-5 justify-end gap-2">
                    <x-button.secondary x-bind:disabled="isDisabled">Batal</x-button.secondary>
                    <x-button.primary x-bind:disabled="isDisabled"
                        x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})">Simpan</x-button.primary>
                </div>
            </x-container>
        </div>

    </x-container>

    <x-modal.confirmation id="save-confirmation" title="Tunggu Sebentar" confirmText="Ya, Simpan Sekarang"
        cancelText="Cek Kembali" :redirectConfirm="route('rps.capaian-pembelajaran')">
        <p>Apakah Anda yakin informasi yang ditambahkan sudah benar?</p>
    </x-modal.confirmation>
@endsection
