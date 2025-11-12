class PerwalianKRS {
  listPerwalianKRS(route) {
    return {
      route: route,
      statusList: {
        disetujui: {
          color: '#D0DE68',
          text: 'Menunjukkan jumlah mata kuliah yang telah <b>disetujui</b>.',
          textColor: '#262626',
        },
        ditolak: {
          color: '#EB474D',
          text: 'Menunjukkan jumlah mata kuliah yang telah <b>ditolak</b>.',
          textColor: '#FFFFFF',
        },
        menunggu: {
          color: '#FDE05D',
          text: 'Menunjukkan jumlah mata kuliah yang <b>menunggu persetujuan</b>.',
          textColor: '#262626',
        },
        hapus: {
          color: '#0097F5',
          text: 'Menunjukkan jumlah mata kuliah yang <b>mengajukan penghapusan</b>.',
          textColor: '#FFFFFF',
        },
      },

      init() {
        this.$watch(
          () => ({
            sort: this.$store.listPage.sort,
            periode: this.$store.listPage.periode,
            year: this.$store.listPage.year,
            filter: this.$store.listPage.filter,
          }),
          (newFilters) => {
            this.fetchData({
              sort: newFilters.sort,
              periode: newFilters.periode,
              year: newFilters.year,
              filter: newFilters.filter
            });
          }
        );
      },

      async fetchData(sortData) {
        await requestGetData(
          this.route, {
            ...sortData,
            display: 'false'
          }, (response) => {
            if (this.$store.listPage) {
              this.$store.listPage.datas = Object.values(response.data.students);
              this.$store.listPage.paginationData = response.data.pagination;
            }
        });
      }
    }
  }

  detailKRSPerwalianKRS() {
    return {
      cols: [
        'No','Nama Kelas','Nama Mata Kuliah','SKS','Nilai',
        'Prodi Lain','Presensi Kehadiran','Status UAS','Status'
      ],
      sections: {
        pending: {
          title: 'Menunggu Persetujuan',
          grad: 'wait',
          btns: {
            approve: 'Setujui',
            reject: 'Tolak Pengajuan'
          }
        },
        deletion: {
          title: 'Mengajukan Penghapusan',
          grad: 'del',
          btns: {
            approveDel: 'Setujui',
            rejectDel: 'Tolak Penghapusan'
          }
        },
        rejected: {
          title: 'Ditolak',
          grad: 'rej',
          btns: {cancelReject: 'Batalkan Penolakan'}
        },
        approved: {
          title: 'Disetujui',
          grad: 'ok',
          btns: {revokeApprove: 'Tolak Persetujuan'}
        }
      },

      init() { }
    }
  }

  detailTranskripResmi() {
    return {
      init() { }
    }
  }

  detailTranskripHistoris() {
    return {
      init() { }
    }
  }

  detailTranskripKurikulum() {
    return {
      init() { }
    }
  }

  detailTranskripPEM() {
    return {
      init() { }
    }
  }
}

export default new PerwalianKRS();