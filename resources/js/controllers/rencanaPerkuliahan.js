class RencanaPerkuliahan {
    constructor() {
        this.minggu = '',
        this.sub_cpmk = '',
        this.konten = '',
        this.cpmk = '',
        this.kuliah = false,
        this.diskusi_latihan = false,
        this.tugas = false,
        this.jumlah_waktu_kuliah = '',
        this.jumlah_waktu_diskusi = '',
        this.jumlah_waktu_tugas = '',
        this.total_waktu_belajar_mandiri = '',
        this.metode_tugas = '',
        this.metode_uts = '',
        this.metode_uas = '',
        this.isian_tugas = '',
        this.isian_uts = '',
        this.isian_uas = '',

        this.isDisabled = true;

    }

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
    }
    

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

function rencanaPerkuliahan() {
    return new RencanaPerkuliahan();
}
