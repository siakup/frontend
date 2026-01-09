
class DeskripsiUmum {
    deskripsiUmum() {
        return {
            bobot: '7',
            semester: 'Semester 2',
            rumpun_mk: 'Mata Kuliah Umum',
            level_program: 'Sarjana',
            deskripsi_singkat_mk: '',
            prodi : '',
            periode : '',
            mata_kuliah : '',
            materi_pembelajaran : '',
            pustaka : '',
            kuliah : false,
            diskusi_latihan : false,
            tugas : false,
            mata_kuliah_syarat : '',
            perangkat_lunak : false,
            isian_perangkat_lunak : '',
            perangkat_keras : false,
            isian_perangkat_keras : '',

            isDisabled : true,
            pengajarList : [
                { id: 0, value: '' } // dropdown pertama
            ],

            init() {
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
            },

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
                    this.prodi !== '';
                
                const minimalSatuChecklist =
                    this.kuliah || this.diskusi_latihan || this.tugas;

                const perangkatValid = 
                    (this.perangkat_lunak && this.isian_perangkat_lunak !== '') || (this.perangkat_keras && this.isian_perangkat_keras !== '') 
                
                const semuaDropdownTerisi = this.pengajarList.every(p => p.value !== '');

                this.isDisabled = !(semuaTerisi && minimalSatuChecklist && perangkatValid && semuaDropdownTerisi);
            },

            addPengajar() {
                const newId = this.pengajarList.length > 0 
                            ? this.pengajarList[this.pengajarList.length - 1].id + 1 
                            : 0;

                this.pengajarList.push({ id: newId, value: '' });
            },


            removePengajar(index) {
                this.pengajarList.splice(index, 1);
            }
        }
    }
}

window.CreateDeskripsiUmum = new DeskripsiUmum()
