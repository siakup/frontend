class DeskripsiUmum {
    constructor() {
        this.bobot = '7';
        this.semester = 'Semester 2';
        this.rumpun_mk = 'Mata Kuliah Umum';
        this.level_program = 'Sarjana';
        this.deskripsi_singkat_mk = '';
        this.prodi = '',
        this.periode = '',
        this.mata_kuliah = '',
        this.materi_pembelajaran = '',
        this.pustaka = '',
        this.kuliah = false,
        this.diskusi_latihan = false,
        this.tugas = false,
        this.mata_kuliah_syarat = '',
        this.perangkat_lunak = false,
        this.isian_perangkat_lunak = '',
        this.perangkat_keras = false,
        this.isian_perangkat_keras = '',

        this.isDisabled = true,
        this.pengajarList = [
            { id: 0, value: '' } // dropdown pertama
        ];

    }

    // --- Lifecycle Alpine ---
    init() {
        // Watcher otomatis jalan tiap ada perubahan value
        this.$watch(
            () => [
                this.bobot,
                this.semester,
                this.rumpun_mk,
                this.level_program,
                this.deskripsi_singkat_mk,
                this.periode,
                this.prodi,
                this.mata_kuliah,
                this.materi_pembelajaran,
                this.pustaka,
                this.kuliah,
                this.diskusi_latihan,
                this.tugas,
                this.mata_kuliah_syarat,
                this.perangkat_keras,
                this.isian_perangkat_keras,
                this.perangkat_lunak,
                this.isian_perangkat_lunak,
            ],
            () => this.checkDisabled()
        );

        this.$watch('pengajarList', () => {
            this.checkDisabled();
        }, { deep: true });
    }

    // --- Modul 1: Cek disabled button ---
    checkDisabled() {
        const semuaTerisi =
            this.bobot !== '' &&
            this.semester !== '' &&
            this.rumpun_mk !== '' &&
            this.level_program !== '' &&
            this.deskripsi_singkat_mk !== '' &&
            this.periode !== '' &&
            this.mata_kuliah !== '' &&
            this.materi_pembelajaran !== '' &&
            this.pustaka !== '' &&
            this.mata_kuliah_syarat !== '' &&
            this.prodi !== '';
        
        const minimalSatuChecklist =
            this.kuliah || this.diskusi_latihan || this.tugas;

        const perangkatValid = 
            (this.perangkat_lunak && this.isian_perangkat_lunak !== '') || (this.perangkat_keras && this.isian_perangkat_keras !== '') 
        
        const semuaDropdownTerisi = this.pengajarList.every(p => p.value !== '');

        this.isDisabled = !(semuaTerisi && minimalSatuChecklist && perangkatValid && semuaDropdownTerisi);
    }

    // --- Modul 2: Tambah dropdown dinamis ---
    addPengajar() {
        const newId = this.pengajarList.length > 0 
                    ? this.pengajarList[this.pengajarList.length - 1].id + 1 
                    : 0;

        this.pengajarList.push({ id: newId, value: '' });
    }


    removePengajar(index) {
        this.pengajarList.splice(index, 1);
    }
}

function deskripsiUmum() {
    return new DeskripsiUmum();
}
