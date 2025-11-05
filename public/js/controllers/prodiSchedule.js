class ProdiSchedule {
  createProdiScheduleComponents() {
    return {
      program_perkuliahan: '',
      program_studi: '',
      periode: '',
      nama_matakuliah: '',
      nama_kelas: '',
      nama_singkat: '',
      kapasitas_peserta: '',
      kelas_mbkm: false,
      tanggal_mulai: '',
      tanggal_akhir: '',
      createConfirmationModalOpen: false,
      scheduleList: [],
      lectureList: [],
  
      init() {
        this.$nextTick(() => {Alpine.store('createPage', { 
          scheduleList: this.scheduleList,
          lectureList: this.lectureList,
        })});
        this.$watch('scheduleList', value => { this.$store.createPage.scheduleList = value});
        this.$watch('lectureList', value => { this.$store.createPage.lectureList = value});
      },
  
      get checkValidity() {
        return this.program_perkuliahan == '' ||
          this.program_studi == '' ||
          this.periode == '' ||
          this.nama_kelas == '' ||
          this.nama_singkat == '' ||
          this.kapasitas_peserta == '' ||
          this.tanggal_mulai == '' ||
          this.tanggal_akhir == '';
      },
  
      showModal(route, parentId, childId) {
        requestDisplayTemplate(
          route,
          parentId,
          childId
        );
      },
  
      onDeleteScheduleClass(index) {
        const newSchedule = this.scheduleList.filter((value, i) => i !== index);
        this.scheduleList = newSchedule;
      },
  
      onDeleteLecture(index) {
        const newLecture = this.lectureList.filter((value, i) => i !== index);
        this.lectureList = newLecture
      },

      onPostProdiSchedule() {
        console.log(this.program_perkuliahan, this.program_studi, this.periode, this.nama_kelas, this.nama_singkat, this.kapasitas_peserta, this.tanggal_mulai, this.tanggal_akhir);
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
        Alpine.store('createPage').lectureList.push({
          id: this.pengajar[index].id,
          nama: this.pengajar[index].nama,
          pengajar_program_studi: this.pengajar[index].pengajar_program_studi ?? '',
          status_pengajar: ''
        });

        document.getElementById('modalListLecture').remove();
        document.getElementById('list-lecture').innerHTML='';
        successToast('Berhasil Menambahkan Pengajar');
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
        Alpine.store('createPage').scheduleList.push({
          hari: this.hari,
          jam_mulai: this.jam_mulai,
          jam_akhir: this.jam_akhir, 
          ruangan: this.ruangan
        });

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

export default new ProdiSchedule();