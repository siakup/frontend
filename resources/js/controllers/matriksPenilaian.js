class MatriksPenilaian {
    constructor() {
        this.nilai = '',
        this.kualitas_jawaban = '',
        this.isDisabled = true;

    }

    init() {
        this.$watch(
            () => [
               this.nilai,
               this.kualitas_jawaban,
            ],
            () => this.checkDisabled()
        );
    }

    checkDisabled() {
        this.isDisabled =
            this.nilai == '' || this.kualitas_jawaban == '';
    }
}

function matriksPenilaian() {
    return new MatriksPenilaian();
}
