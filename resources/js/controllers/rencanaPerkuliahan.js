class RencanaPerkuliahan {
    createRencanaPerkuliahan() {
        return {
            minggu : '1',
            sub_cpmk : '',
            konten : '',
            cpmk : '',
            kuliah : false,
            diskusi_latihan : false,
            tugas : false,
            jumlah_waktu_kuliah : '',
            jumlah_waktu_diskusi : '',
            jumlah_waktu_tugas : '',
            total_waktu_belajar_mandiri : '',
            metode_tugas : '',
            metode_uts : '',
            metode_uas : '',
            isian_tugas : '',
            isian_uts : '',
            isian_uas : '',

            isDisabled : true,
            init() {
                this.$watch(
                    () => [
                    this.minggu,
                    this.sub_cpmk,
                    this.konten,
                    this.cpmk,
                    this.total_waktu_belajar_mandiri,
                    this.kuliah,
                    this.diskusi_latihan,
                    this.tugas,
                    this.jumlah_waktu_diskusi,
                    this.jumlah_waktu_kuliah,
                    this.jumlah_waktu_tugas,
                    this.metode_tugas,
                    this.metode_uts,
                    this.metode_uas,
                    this.isian_tugas,
                    this.isian_uts,
                    this.isian_uas,

                    ],
                    () => this.checkDisabled()
                );
            },
    
            checkDisabled() {
                const semuaTerisi = 
                    this.sub_cpmk !== '' && this.konten !== '' && 
                    this.cpmk !== '' && this.minggu !== '' &&
                    this.total_waktu_belajar_mandiri !== '';
            
                const kegiatanValid = 
                    (this.kuliah && this.jumlah_waktu_kuliah !== '') || 
                    (this.tugas && this.jumlah_waktu_tugas !== '') ||
                    (this.diskusi_latihan && this.jumlah_waktu_diskusi !== '');

                const metodeValid = 
                    (this.metode_tugas && this.isian_tugas !== '') || 
                    (this.metode_uts && this.isian_uts !== '') ||
                    (this.metode_uas && this.isian_uas !== '');
                
                this.isDisabled = !(semuaTerisi && kegiatanValid && metodeValid); 
            }
        }
    }
    
    
}

window.RencanaPerkuliahan = new RencanaPerkuliahan()
