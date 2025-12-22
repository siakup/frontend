class MahasiswaBimbingan {
  /**
   * Controller untuk halaman list CPL dengan select/unselect
   * @param {number} studentListCount - Total jumlah Mahasiswa
   * @param {array} studentListArray - Array data Mahasiswa
   */
  createMahasiswaBimbingan(studentListCount, studentListArray) {
    return {
      selectAll: false,
      selected: [],
      isDisabled: true,
      studentListCount: studentListCount,
      studentListArray: studentListArray,

      init() {
        this.$watch('selected', value => {
          this.isDisabled = value.length === 0;
          this.selectAll = value.length === this.studentListCount;
        });
      },

      toggleAll() {
            const arr = Array.isArray(this.studentListArray)
                ? this.studentListArray
                : Object.values(this.studentListArray)

            this.selected = this.selectAll
                ? arr.map((_, i) => i)
                : []
        },


      reset() {
        this.selectAll = false;
        this.selected = [];
      }
    }
  }
}

window.MahasiswaBimbingan = new MahasiswaBimbingan()