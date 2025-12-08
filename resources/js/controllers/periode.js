class Periode {
  listPeriode(route) {
    return {
      route: route,
      init () {
        this.$watch(
          () => ({
            sort: this.$store.listPage.sort,
            search: this.$store.listPage.search,
          }),
          (newFilters) => {
            this.fetchData({
              sort: newFilters.sort,
              search: newFilters.search
            });
          }
        );
      },

      async fetchData(sortData) {
        await window.api.requestGetData(
          this.route, {
            ...sortData,
            display: 'false'
          }, (response) => {
            if (this.$store.listPage) {
              this.$store.listPage.periode = Object.values(response.data.periode);
              this.$store.listPage.paginationData = response.data.pagination;
            }
        });
      },
    }
  }
}

window.PeriodeController = new Periode()