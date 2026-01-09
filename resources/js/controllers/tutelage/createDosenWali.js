class DosenWali {
  /**
   * Controller untuk halaman list CPL dengan select/unselect
   * @param {number} dosenListCount - Total jumlah Mahasiswa
   * @param {array} dosenListArray - Array data Mahasiswa
   */
  createDosenWali(dosenListCount, dosenListArray) {
    return {
      selectAll: false,
      selected: [],
      isDisabled: true,
      dosenListCount: dosenListCount,
      dosenListArray: dosenListArray,

      init() {
        this.$watch('selected', value => {
          this.isDisabled = value.length === 0;
          this.selectAll = value.length === this.dosenListCount;
        });
      },

      toggleAll() {
            const arr = Array.isArray(this.dosenListArray)
                ? this.dosenListArray
                : Object.values(this.dosenListArray)

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

window.DosenWali = new DosenWali()