@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Dosen)')

<script src="{{ asset('js/controllers/RpsDeskripsiUmum.js') }}" defer></script>

@section('content')
    <div class="page-header pl-5">
        <x-typography variant="heading-h6">Buat RPS (Rencana Pembelajaran Dosen)</x-typography>
    </div>
    <x-button.base
        :icon="asset('assets/icon-less-than-red-20.svg')"
        :href="route('rps.index')"
        class="ml-5 mb-3 text-[#E62129]"
    >
        Buat RPS (Rencana Pembelajaran Dosen)
    </x-button.base>

    @include('rps.layout.navbar-rps')

    <div 
        x-data="deskripsiUmum()" 
        
        class="academics-slicing-content content-card p-5 flex flex-col gap-5" 
        style="border-radius: 0 12px 12px 12px !important;"
    >
        <x-typography variant="body-medium-bold">Informasi RPS</x-typography>
        <x-form.input-container class="w-[200px]">
            <x-slot name="label">Periode</x-slot>
            <x-slot name="input">
                <x-form.dropdown
                    variant="gray"
                    buttonId="dropdownPeriodeButton"
                    dropdownId="dropdownPeriodeList"
                    label="-Pilih Periode Akademik-"
                    :dropdownItem="$periodeList"
                    buttonStyleClass="text-sm min-w-[890px] h-[40px]"
                    optionStyleClass="min-w-[250px]"
                    :imgSrc="asset('assets/icon-arrow-down-grey-20.svg')"
                    :isIconCanRotate="true"
                    x-model="periode"
                />
            </x-slot>
        </x-form.input-container>
        <x-form.input-container class="w-[200px]">
            <x-slot name="label">Program Studi</x-slot>
            <x-slot name="input">
                <x-form.dropdown
                    variant="gray"
                    buttonId="dropdownProdiButton"
                    dropdownId="dropdownProdiList"
                    label="-Pilih Program Studi-"
                    :dropdownItem="$prodiList"
                    buttonStyleClass="text-sm min-w-[890px] h-[40px]"
                    optionStyleClass="min-w-[250px]"
                    :imgSrc="asset('assets/icon-arrow-down-grey-20.svg')"
                    :isIconCanRotate="true"
                    x-model="prodi"
                />
            </x-slot>
        </x-form.input-container>
        <x-form.input-container class="w-[200px]">
            <x-slot name="label">Mata Kuliah</x-slot>
            <x-slot name="input">
                <x-form.dropdown
                    variant="gray"
                    buttonId="dropdownMatkulButton"
                    dropdownId="dropdownMatkuleList"
                    label="-Pilih Mata Kuliah-"
                    :dropdownItem="$matkulList"
                    buttonStyleClass="text-sm min-w-[890px] h-[40px]"
                    optionStyleClass="min-w-[250px]"
                    :imgSrc="asset('assets/icon-arrow-down-grey-20.svg')"
                    :isIconCanRotate="true"
                    x-model="mata_kuliah"
                />
            </x-slot>
        </x-form.input-container>
        <div class="grid grid-cols-2 flex gap-2">
            <x-form.input-container class="w-[200px]">
                <x-slot name="label">Bobot (SKS)</x-slot>
                <x-slot name="input">
                    <x-form.input disabled inputClass="!w-[320px] !mx-0" type="number" name="bobot" x-model="bobot"></x-form.input>
                </x-slot>
            </x-form.input-container>
            <x-form.input-container class="w-[200px]">
                <x-slot name="label">Semester</x-slot>
                <x-slot name="input">
                    <x-form.input disabled inputClass="!w-[320px] !mx-0" name="semester" x-model="semester"></x-form.input>
                </x-slot>
            </x-form.input-container>
            <x-form.input-container class="w-[200px]">
                <x-slot name="label">Rumpun MK</x-slot>
                <x-slot name="input">
                    <x-form.input disabled inputClass="!w-[320px] !mx-0" name="rumpun_mk" :value="'Mata Kuliah Prodi'" x-model="rumpun_mk"></x-form.input>
                </x-slot>
            </x-form.input-container>
            <x-form.input-container class="w-[200px]">
                <x-slot name="label">Level Program</x-slot>
                <x-slot name="input">
                    <x-form.input disabled inputClass="!w-[320px] !mx-0" name="level_program" :value="'Sarjana'" x-model="level_program"></x-form.input>
                </x-slot>
            </x-form.input-container>
        </div>
        <x-form.input-container class="w-[200px]">
            <x-slot name="label">Deskripsi Singkat MK</x-slot>
            <x-slot name="input">
                <x-form.textarea
                    placeholder="Tulis Deskripsi"
                    id="deskripsi_singkat_mk"
                    :maxChar="100"
                    rows="5"
                    cols="50"
                    x-model="deskripsi_singkat_mk"
                />
                <span x-text="prodi"></span>
            </x-slot>
        </x-form.input-container>
        <x-form.input-container class="!text-wrap w-[200px]">
            <x-slot name="label" >Materi Pembelajaran / Pokok Bahasan</x-slot>
            <x-slot name="input">
                <x-form.textarea
                    placeholder="Tulis Deskripsi"
                    id="materi_pembelajaran"
                    :maxChar="100"
                    rows="5"
                    x-model="materi_pembelajaran"
                />
            </x-slot>
        </x-form.input-container>
        <x-form.input-container class="w-[200px]">
            <x-slot name="label" >Pustaka</x-slot>
            <x-slot name="input">
                <x-form.textarea
                    placeholder="Tulis Deskripsi"
                    id="pustaka"
                    :maxChar="1000"
                    x-model="pustaka"
                />
            </x-slot>
        </x-form.input-container>
        <x-form.input-container class="w-[200px]">
            <x-slot name="label">Metode Pembelajaran</x-slot>
            <x-slot name="input">
                <div class="flex gap-20">
                    <x-form.checklist x-model="kuliah" class="!w-fit bg-white" :id="'kuliah'" :value="'kuliah_on'" label="Kuliah (K)" :name="'kuliah'"/>
                    <x-form.checklist x-model="diskusi_latihan" class="!w-fit" :id="'diskusilatihan'" :value="'diskusi_on'" label="Diskusi & Latihan (DL)" :name="'diskusilatihan'"/>
                    <x-form.checklist x-model="tugas" class="!w-fit" :id="'tugas'" :value="'tugas_on'" label="Tugas (T)" :name="'tugas'"/>
                </div>
            </x-slot>
        </x-form.input-container>
        <x-form.input-container class="!text-wrap w-[216px]">
            <x-slot name="label">Media Pembelajaran</x-slot>
            <x-slot name="input">
                <div class="grid grid-cols-[auto_1fr] gap-3">
                    <x-form.checklist x-model="perangkat_lunak" class="!w-fit bg-white" :id="'perangkat_lunak'" :value="'perangkat_lunak_on'" label="Perangkat Lunak" :name="'perangkat_lunak'"/>
                    <x-form.textarea
                        placeholder="Tulis Deskripsi"
                        id="isian_perangkat_lunak"
                        x-model="isian_perangkat_lunak"
                        :maxChar="100"
                        rows="3"
                    />
                    <x-form.checklist x-model="perangkat_keras" class="!w-fit" :id="'perangkat_keras'" :value="'perangkat_keras_on'" label="Perangkat Keras" :name="'perangkat_keras_on'"/>
                    <x-form.textarea
                        placeholder="Tulis Deskripsi"
                        id="isian_perangkat_keras"
                        x-model="isian_perangkat_keras"
                        :maxChar="100"
                        rows="3"
                    />
                </div>
            </x-slot>
        </x-form.input-container>
        <x-container variant="content-wrapper" class="!w-[890px] ml-[210px] bg-[#FFFBEB] border-[1px] border-[#FDD835] rounded-lg py-3">
            <div class="flex gap-4">
                <x-icon iconUrl="{{ asset('assets/icon-caution-warning.svg') }}"/>
                <x-typography variant="body-medium-regular">Tim pengajar bisa lebih dari satu</x-typography>
            </div>
        </x-container>
        <x-form.input-container class="w-[200px]" labelClass="self-start">
            <x-slot name="label">Tim Pengajaran</x-slot>

            <x-slot name="input">
                <div class="flex gap-2"> {{-- row utama: label + dropdown stack --}}
                    
                    {{-- Dropdown stack --}}
                    <div class="flex flex-col gap-2">
                        <template x-for="(pengajar, index) in pengajarList" :key="index">
                            <x-form.dropdown
                                variant="gray"
                                label="-Tim Pengajar-"
                                :dropdownItem="$timPengajarList"
                                buttonStyleClass="text-sm min-w-[670px] h-[40px]"
                                optionStyleClass="min-w-[250px]"
                                :imgSrc="asset('assets/icon-arrow-down-grey-20.svg')"
                                :isIconCanRotate="true"
                                x-model="pengajarList[index].value"
                            />
                        </template>
                    </div>

                    {{-- Button tambah pengajar tetap sejajar dropdown pertama --}}
                    <div class="self-start"> 
                        <x-button.primary 
                            x-on:click="addPengajar()" 
                            :icon="asset('assets/icon-perwalian-white-20.svg')">
                            Tambah Pengajar
                        </x-button.primary>
                    </div>
                </div>
            </x-slot>
        </x-form.input-container>

        <x-form.input-container class="w-[200px]">
            <x-slot name="label">Mata Kuliah Syarat</x-slot>
            <x-slot name="input">
                <x-form.dropdown
                    variant="gray"
                    buttonId="dropdownMatkulSyaratButton"
                    dropdownId="dropdownMatkulSyaratList"
                    label="-Mata Kuliah Syarat-"
                    :dropdownItem="$matkulSyaratList"
                    buttonStyleClass="text-sm min-w-[890px] h-[40px]"
                    optionStyleClass="min-w-[250px]"
                    :imgSrc="asset('assets/icon-arrow-down-grey-20.svg')"
                    :isIconCanRotate="true"
                    x-model="mata_kuliah_syarat"
                />
            </x-slot>
        </x-form.input-container>
        <div class="flex mt-5 justify-end gap-2">
            <x-button.secondary x-bind:disabled="isDisabled">Batal</x-button.secondary>
            <x-button.primary  x-bind:disabled="isDisabled" x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})">Simpan</x-button.primary>
        </div>
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
    
    
@endsection