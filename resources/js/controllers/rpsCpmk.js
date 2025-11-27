class Cpmk {
    constructor() {
        this.kode = '',
        this.deskripsi = '',

        this.isDisabled = true;

    }

    init() {
        this.$watch(
            () => [
               this.kode,
               this.deskripsi,
            ],
            () => this.checkDisabled()
        );
    }

    checkDisabled() {
        const semuaTerisi =
            this.kode !== '' && this.deskripsi !== '';

        this.isDisabled = !(semuaTerisi );
    }
}

function cpmk() {
    return new Cpmk();
}
