class Cpl {
  /**
   * Controller untuk halaman list CPL dengan select/unselect
   * @param {number} cplListCount - Total jumlah CPL
   * @param {array} cplListArray - Array data CPL
   */
  listCpl(cplListCount, cplListArray) {
    return {
      selectAll: false,
      selected: [],
      isDisabled: true,
      cplListCount: cplListCount,
      cplListArray: cplListArray,

      init() {
        this.$watch('selected', value => {
          this.isDisabled = value.length === 0;
          this.selectAll = value.length === this.cplListCount;
        });
      },

      toggleAll() {
        this.selected = this.selectAll
          ? this.cplListArray.map((_, i) => i)
          : [];
      },

      reset() {
        this.selectAll = false;
        this.selected = [];
      }
    }
  }
}

window.CplController = new Cpl()