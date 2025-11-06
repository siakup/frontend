class KomponenPenilaian {
    constructor() {
        this.nama = '',
        this.bobot = '',
        this.cpmk = [],

        this.isDisabled = true;

    }

    init() {
        this.$watch(
            () => [
               this.nama,
               this.bobot,
               this.cpmk,
            ],
            () => this.checkDisabled()
        );
    }

    checkDisabled() {
        this.isDisabled =
            this.nama == '' || this.bobot == '' || this.cpmk.length === 0;
    }
}

function komponenPenilaian() {
    return new KomponenPenilaian();
}
