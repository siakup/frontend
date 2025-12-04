class PeriodeAkademik {
    listPeriodeAkademik() {
        return {
            route: 'http://127.0.0.1:8004/api/period/list',
            dataPeriode: {}, // Pastikan object, bukan array
            loading: false,
            
            init() {
                this.fetchData();
            },
            
            async fetchData(sortData) {
                this.loading = true;
                
                await requestGetData(
                    this.route, 
                    {
                        display: 'false'
                    }, 
                    (response) => {
                        this.dataPeriode = this.transformData(response.data);
                        console.log('Data Periode:', this.dataPeriode); // Debug
                        this.loading = false;
                    }
                );
            },
            
            transformData(data) {
                const result = {};
                
                data.forEach(item => {
                    let semesterLabel;
                    switch(item.semester) {
                        case 1:
                            semesterLabel = 'Ganjil';
                            break;
                        case 2:
                            semesterLabel = 'Genap';
                            break;
                        case 3:
                            semesterLabel = 'Pendek';
                            break;
                        default:
                            semesterLabel = `Semester ${item.semester}`;
                    }
                    const label = `${item.tahun} - ${semesterLabel}`;
                    result[label] = item.id;
                });
                
                return result;
            }
        }
    }
}

window.periodeAkademik = new PeriodeAkademik();