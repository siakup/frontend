class ParentInstitutionSchedule {
  listParentInstitutionScheduleComponents(route) {
    return {
      route: route,
      modalConfirmationDeleteOpen: false,
      modalViewProdiScheduleOpen: false,
      idSelectedProdiSchedule: null,

      init() {
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

      showView() {
        requestDisplayTemplate(
          this.route+'/'+this.idSelectedProdiSchedule,
          "#view-parent-institution-schedule",
          "#modalViewParentInstitution"
        );
      },

      async fetchData(sortData) {
        await requestGetData(
          route, {
            ...sortData,
            display: 'false'
          }, (response) => {
            if (this.$store.listPage) {
              this.$store.listPage.data = Object.values(response.data.schedules);
              this.$store.listPage.paginationData = response.data.pagination;
            }
        });
      }
    }
  }

  previewUploadParentInstitutionScheduleComponents(datas) {
    return {
      isModalConfirmationOpen: false,
      datas: datas,
      sendValidateData() {
        console.log(this.datas);
      }
    }
  }

  uploadParentInstitutionScheduleComponents() {
    return {
      init() {},
      checkValidity() {
        return this.$store.uploadPage.periode == '' 
        || this.$store.uploadPage.program_studi == ''; 
      }
    }
  }

  createParentInstitutionSchedule() {
    return {
      createConfirmationModalOpen: false,

      init() { },
  
      get checkValidity() {
        return this.$store.createPage.program_perkuliahan == '' ||
          this.$store.createPage.program_studi == '' ||
          this.$store.createPage.periode == '' ||
          this.$store.createPage.course == [] ||
          this.$store.createPage.nama_kelas == '' ||
          this.$store.createPage.nama_singkat == '' ||
          this.$store.createPage.kapasitas_peserta == '' ||
          this.$store.createPage.tanggal_mulai == '' ||
          this.$store.createPage.tanggal_akhir == '';
      },
  
      showModal(route, parentId, childId) {
        requestDisplayTemplate(
          route,
          parentId,
          childId
        );
      },
  
      onDeleteScheduleClass(index) {
        const newSchedule = this.$store.createPage.scheduleList.filter((value, i) => i !== index);
        this.$store.createPage.scheduleList = newSchedule;
      },
  
      onDeleteLecture(index) {
        const newLecture = this.$store.createPage.lectureList.filter((value, i) => i !== index);
        this.$store.createPage.lectureList = newLecture
      },

      onPostProdiSchedule() {
        console.log(this.$store.createPage.program_perkuliahan, this.$store.createPage.program_studi, this.$store.createPage.periode, this.$store.createPage.course, this.$store.createPage.nama_kelas, this.$store.createPage.nama_singkat, this.$store.createPage.kapasitas_peserta, this.$store.createPage.kelas_mbkm, this.$store.createPage.tanggal_mulai, this.$store.createPage.tanggal_akhir, this.$store.createPage.scheduleList, this.$store.createPage.lectureList);
      }
  
    }
  }

  editParentInstitutionScheduleComponents() {
    return {
      editConfirmationModalOpen: false,

      init() { },
  
      get checkValidity() {
        return this.$store.editPage.program_perkuliahan == '' ||
          this.$store.editPage.program_studi == '' ||
          this.$store.editPage.periode == '' ||
          this.$store.editPage.course == [] ||
          this.$store.editPage.nama_kelas == '' ||
          this.$store.editPage.nama_singkat == '' ||
          this.$store.editPage.kapasitas_peserta == '' ||
          this.$store.editPage.tanggal_mulai == '' ||
          this.$store.editPage.tanggal_akhir == '';
      },
  
      showModal(route, parentId, childId) {
        requestDisplayTemplate(
          route,
          parentId,
          childId
        );
      },
  
      onDeleteScheduleClass(index) {
        const newSchedule = this.$store.editPage.scheduleList.filter((value, i) => i !== index);
        this.$store.editPage.scheduleList = newSchedule;
      },
  
      onDeleteLecture(index) {
        const newLecture = this.$store.editPage.lectureList.filter((value, i) => i !== index);
        this.$store.editPage.lectureList = newLecture
      },

      onUpdateParentInstitutionSchedule() {
        console.log(this.$store.editPage.program_perkuliahan, this.$store.editPage.program_studi, this.$store.editPage.periode, this.$store.editPage.course, this.$store.editPage.nama_kelas, this.$store.editPage.nama_singkat, this.$store.editPage.kapasitas_peserta, this.$store.editPage.kelas_mbkm, this.$store.editPage.tanggal_mulai, this.$store.editPage.tanggal_akhir, this.$store.editPage.scheduleList, this.$store.editPage.lectureList);
      }
  
    }
  }

  lectureViewComponents(pengajar, pagination) {
    return {
      pengajar: pengajar,
      paginationData: pagination,

      init() {
        this.$nextTick(() => {
          Alpine.store('lectureModal', { 
            pengajar: this.pengajar,
            paginationData: this.paginationData
          })
        });
      },

      chooseLecture(index) {
        const data = {
          id: this.pengajar[index].id,
          nama: this.pengajar[index].nama,
          pengajar_program_studi: this.pengajar[index].pengajar_program_studi ?? '',
          status_pengajar: ''
        };

        if(this.$store.createPage) {
          this.$store.createPage.lectureList.push(data);
        } else if(this.$store.editPage) {
          this.$store.editPage.lectureList.push(data);
        }

        document.getElementById('modalListLecture').remove();
        document.getElementById('list-lecture').innerHTML='';
        successToast('Berhasil Menambahkan Pengajar');
      }
    }
  }
  
  courseViewComponents(mataKuliahList, pagination) {
    return {
      mataKuliahList: mataKuliahList,
      paginationData: pagination,

      init() {
        this.$nextTick(() => {
          Alpine.store('courseModal', { 
            mataKuliahList: this.mataKuliahList,
            paginationData: this.paginationData
          })
        });
      },

      chooseCourse(index) {
        const data = {
          id_matakuliah: this.mataKuliahList[index].id_matakuliah,
          nama_matakuliah_id: this.mataKuliahList[index].nama_matakuliah_id,
          sks: this.mataKuliahList[index].sks ?? '',
          id_jenis: this.mataKuliahList[index].id_jenis ?? '',
          id_kurikulum: this.mataKuliahList[index].id_kurikulum ?? '',
          kode_matakuliah: this.mataKuliahList[index].kode_matakuliah,
        };

        if(this.$store.createPage) {
          this.$store.createPage.course = data;
        } else if(this.$store.editPage) {
          this.$store.editPage.course = data;
        }

        document.getElementById('modalListCourse').remove();
        document.getElementById('list-course').innerHTML='';
        successToast('Berhasil Menambahkan Mata Kuliah');
      }
    }
  }

  createScheduleListComponents(availableRoomsRoute) {
    return {
      hari: '',
      jam_mulai: '',
      jam_akhir: '',
      ruangan: '',
      listRuangan: null,

      addSchedule() {
        const data = {
          hari: this.hari,
          jam_mulai: this.jam_mulai,
          jam_akhir: this.jam_akhir, 
          ruangan: this.ruangan
        }

        if(this.$store.createPage) {
          this.$store.createPage.scheduleList.push(data);
        } else if(this.$store.editPage) {
          this.$store.editPage.scheduleList.push(data);
        }

        document.getElementById('modalAddSchedule').remove();
        document.getElementById('add-schedule').innerHTML='';
        successToast('Berhasil Menambahkan Jadwal Kuliah');
      },

      get checkScheduleValidity() { 
        return this.hari == '' || 
          this.jam_mulai == '' || 
          this.jam_akhir == '' || 
          this.ruangan == ''; 
      },

      async getAvailableRooms() {
        if(this.hari && this.jam_mulai && this.jam_akhir) {
          await requestGetData(availableRoomsRoute, {
            hari: this.hari,
            jam_mulai: this.jam_mulai,
            jam_selesai: this.jam_akhir
          }, (response) => {
            this.listRuangan = response.success 
              ? Object.fromEntries(response.data.map(value => [value.nama_ruangan, value.id_ruangan]))
              : {[response.message]: response.message};
            
          });
        }
      }
    };
  }
}

export default new ParentInstitutionSchedule();