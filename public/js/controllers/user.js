class User {
  listUser(route) {
    return {
      route: route,

      init () {
        this.$watch(
          () => ({
            sort: this.$store.listPage.sort,
            program_perkuliahan: this.$store.listPage.program_perkuliahan,
            program_studi: this.$store.listPage.program_studi,
            search: this.$store.listPage.search,
          }),
          (newFilters) => {
            this.fetchData({
              sort: newFilters.sort,
              program_perkuliahan: newFilters.program_perkuliahan,
              program_studi: newFilters.program_studi,
              search: newFilters.search
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
              this.$store.listPage.datas = Object.values(response.data.users);
              this.$store.listPage.paginationData = response.data.pagination;
            }
        });
      },
    }
  }

  createUser() {
    return {
      isModalKonfirmasiSimpanOpen: false,
      isModalKonfirmasiHapusOpen: false,
      selectedId: null,
      init() {

      },

      async getUser(route, user) {
        this.$store.createPage.nama = user.nama;
        this.$store.createPage.email = user.email;
        this.$store.createPage.nomor_induk = user.nomor_induk;
        await requestGetData(
          route, {
          search: user.nama,
          display: 'false'
        }, (response) => {
          this.$store.createPage.username = response.data.users[0].username;
      });
        this.$store.createPage.users = [];
        this.$store.createPage.isOptionListOpen = false;
      },

      async saveData(route, redirectUri) {
        requestPostData(route, {
          nip: this.$store.createPage.nomor_induk,
          nama_lengkap: this.$store.createPage.nama,
          username: this.$store.createPage.username,
          email: this.$store.createPage.email,
          status: this.$store.createPage.status,
          peran: this.$store.createPage.peran
        }, (response) => {
          localStorage.setItem('flash_type', response.success ? 'success' : 'error');
          localStorage.setItem('flash_message', response.message || 'Pengguna berhasil dibuat');
          window.location.href = redirectUri;
        }, (xhr, status, error) => {
          let errorMessage = 'Gagal menyimpan data. Silakan coba lagi.';
          if (xhr.responseJSON && xhr.responseJSON.message) {
              errorMessage = xhr.responseJSON.message;
          }

          errorToast(errorMessage);
          console.error('AJAX Error:', error);
        })
      },

      checkValidity() {
        try {
          return this.$store.createPage.nama == '' || this.$store.createpage.email == '' || this.$store.createPage.nomor_induk == '';
        } catch (e) {}
      },

      onDeletePeran() {
        const newPeran = this.$store.createPage.peran.filter((value, i) => i !== this.selectedId);;
        this.$store.createPage.peran = newPeran;
        this.isModalKonfirmasiHapusOpen = false;
        successToast("Peran berhasil dihapus");
      }

    }
  }

  editUser() {
    return {
      isModalKonfirmasiSimpanOpen: false,
      isModalKonfirmasiHapusOpen: false,
      selectedId: null,
      
      init() {

      },

      onDeletePeran() {
        const newPeran = this.$store.editPage.peran.filter((value, i) => i !== this.selectedId);;
        this.$store.editPage.peran = newPeran;
        this.isModalKonfirmasiHapusOpen = false;
        successToast("Peran berhasil dihapus");
      },

      async saveData(route, redirectUri) {
        requestPostData(route, {
          nip: this.$store.editPage.nomor_induk,
          nama_lengkap: this.$store.editPage.nama,
          username: this.$store.editPage.username,
          email: this.$store.editPage.email,
          status: this.$store.editPage.status,
          peran: this.$store.editPage.peran.map(value => ({role_id: value.peranId, institusi_id: value.institutionId}))
        }, (response) => {
          localStorage.setItem('flash_type', response.success ? 'success' : 'error');
          localStorage.setItem('flash_message', response.message || 'Pengguna berhasil diubah');
          window.location.href = redirectUri;
        }, (xhr, status, error) => {
          let errorMessage = 'Gagal menyimpan data. Silakan coba lagi.';
          if (xhr.responseJSON && xhr.responseJSON.message) {
              errorMessage = xhr.responseJSON.message;
          }

          errorToast(errorMessage);
          console.error('AJAX Error:', error);
        }, 'PUT')
      },
    }
  }

  createPeran(institutionRoute, peranList) {
    return {
      peran: '', 
      namaInstitusi: '',
      institusiList: [],
      peranList: peranList,
      institutionRoute,

      async getData() {
        if(this.peran !== '') 
          await requestGetData(
            institutionRoute, 
            { role: this.peran }, 
            (response) => { 
              this.institusiList = response.success ? Object.fromEntries(response.data.map(value => [value.nama, value.id])) : {[response.message]: response.message};
              this.institusiList = {...{'Pilih Institusi': ''}, ...this.institusiList};
            }
          );
      },

      onSavePeran(storeKey = 'createPage') {
        this.$store[storeKey].peran.push({
          peranName: this.peranList.find(value => value.id == this.peran).nama,
          peranId: this.peran,
          institutionName: Object.entries(this.institusiList).find(([key, value]) => value == this.namaInstitusi)[0],
          institutionId: this.namaInstitusi,
          createdAt: new Date()
        });
        
        this.peran = '';
        this.namaInstitusi = '';
        this.institusiList = [];

        this.$store[storeKey].isModalTambahPeranOpen = false;
        successToast()
      }
    }
  }
}

export default new User();