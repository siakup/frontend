document.addEventListener('alpine:init', () => {
    Alpine.store('listPage', {
        periode: [],
        paginationData: { currentPage: 1, last: 1, from: 0, limit: 10 },
        isLoading: true,
        search: new URLSearchParams(window.location.search).get('search') || '',
        sort: new URLSearchParams(window.location.search).get('sort') || 'created_at,desc',
        namaSemester: {
            1: 'Ganjil',
            2: 'Genap',
            3: 'Pendek'
        },

        init() {
            this.fetchData();

            this.$watch('search', () => this.fetchData());
            this.$watch('sort', () => this.fetchData());
        },

        async fetchData() {
            this.isLoading = true;

            const params = new URLSearchParams({
                search: this.search,
                sort: this.sort,
                page: new URLSearchParams(window.location.search).get('page') || 1
            });

            try {
                const response = await fetch(`${window.location.pathname}?${params.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) throw new Error('Gagal memuat data');

                const result = await response.json();

                if (result.success) {
                    this.periode = result.data.periode;
                    this.paginationData = result.data.pagination;
                }
            } catch (error) {
                console.error('Error fetching data:', error);
            } finally {
                this.isLoading = false;
            }
        }
    });
});