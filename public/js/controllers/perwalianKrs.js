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

  detailStudentData() {
    return {
      isModalOpen: false,
      selectedId: null,
      fileOpen: true,
      loadingKey: null,
      chart: null,
      docs: {
        'Ijazah/Surat Keterangan Lulus': 'ijazah_skl',
        'Foto': 'foto',
        'Akta Kelahiran': 'akta_lahir',
        'Kartu Peserta Ujian': 'kartu_peserta',
        'Bukti Pembayaran': 'bukti_bayar',
        'Sertifikat Prestasi': 'sertifikat_prestasi',
        'Kartu Keluarga': 'kartu_keluarga',
        'Kartu Identitas': 'kartu_identitas',
        'Surat Keterangan Bebas Buta Warna': 'skb_buta_warna',
        'Surat Pernyataan Mahasiswa Baru': 'spm_baru',
        'Rapor': 'rapor',
        'Transkrip Nilai': 'transkrip',
        'Ijazah': 'ijazah',
        'Hasil Tes Skor TKDA/TKA': 'tkda_tka',
        'Hasil Tes Bahasa Inggris (TOEFL/IELTS)': 'english_test',
      },

      async openDoc(key, nim){
        try {
          this.loadingKey = key;

          // === Ganti endpoint route backend ===
          const nim = nim ?? null;
          const url = `/api/students/${nim ?? 'dummy'}/documents/${key}`;

          const res = await fetch(url, { headers: { 'Accept': 'application/json' }});
          if(!res.ok){
            if(res.status === 404){ alert('Dokumen tidak ditemukan'); return; }
            throw new Error('Gagal memuat dokumen');
          }

          // A) backend balas { url: "https://..." }
          // B) backend balas file (blob)
          const contentType = res.headers.get('content-type') || '';
          if(contentType.includes('application/json')){
            const data = await res.json();
            if(data?.url){ window.open(data.url, '_blank'); }
            else { alert('URL dokumen tidak tersedia'); }
          } else {
            const blob = await res.blob();
            const fileUrl = URL.createObjectURL(blob);
            window.open(fileUrl, '_blank');
          }
        } catch(e) {
          console.error(e);
          alert('Terjadi kesalahan saat membuka dokumen.');
        } finally {
          this.loadingKey = null;
        }
      },

      init() {},

      initChart() {
        if(this.chart) return;
        const ctx = this.$el.querySelector('canvas');
        const data = this.$store.detailPage.data.catatanAkademik;
        const labels = data.map(value => `${value.year} ${value.semester == 1 ? 'Ganjil' : (value.semester == 2 ? 'Genap' : 'Pendek') }`);
        const datasets = [
          {
            label: 'IPK',
            data: data.map(value => value.ipk),
            borderColor: '#2563eb',
            backgroundColor: '#2563eb',
            tension: 0.3
          },
          {
            label: 'IPS',
            data: data.map(value => value.ips),
            borderColor: '#84cc16',
            backgroundColor: '#84cc16',
            tension: 0.3
          }
        ]
        
        const chart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: labels,
              datasets: datasets
          },
          options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                  legend: {
                      position: 'bottom',
                      labels: {
                          boxWidth: 12,
                          padding: 15
                      }
                  }
              },
              scales: {
                  y: {
                      min: 1,
                      max: 5,
                      ticks: { stepSize: 1 }
                  }
              }
          }
        });

        this.chart = chart;
      },

      downloadChart() {
        const a = document.createElement('a');
        a.href = this.chart.toBase64Image();
        a.download = 'statistik-ipk-ips.png';
        a.click();
      },

      printChart() {
        const w = window.open('', '_blank');
        w.document.write('<img src="' + this.chart.toBase64Image() + '" />');
        w.print();
      }
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