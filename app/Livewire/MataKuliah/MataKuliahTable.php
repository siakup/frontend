<?php

namespace App\Livewire\MataKuliah;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class MataKuliahTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5; // Reduced for testing
    public $sortBy = 'nama';
    public $sortDirection = 'asc';
    public $programStudi = '';
    protected $listeners = [
        'page-changed' => 'updatePage',
        'per-page-changed' => 'updatePerPage'
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 5],
        'sortBy' => ['except' => 'nama'],
        'sortDirection' => ['except' => 'asc'],
        'programStudi' => ['except' => '']
    ];

    // Extended dummy data
    protected $mataKuliahData = [
        ['kode' => 'MK001', 'nama' => 'Algoritma dan Pemrograman', 'sks' => 3, 'semester' => 1, 'jenis' => 'Wajib', 'prodi' => 'Teknik Informatika'],
        ['kode' => 'MK002', 'nama' => 'Struktur Data', 'sks' => 3, 'semester' => 2, 'jenis' => 'Wajib', 'prodi' => 'Teknik Informatika'],
        ['kode' => 'MK003', 'nama' => 'Basis Data', 'sks' => 3, 'semester' => 3, 'jenis' => 'Wajib', 'prodi' => 'Sistem Informasi'],
        ['kode' => 'MK004', 'nama' => 'Pemrograman Web', 'sks' => 3, 'semester' => 4, 'jenis' => 'Wajib', 'prodi' => 'Sistem Informasi'],
        ['kode' => 'MK005', 'nama' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 5, 'jenis' => 'Wajib', 'prodi' => 'Teknik Komputer'],
        ['kode' => 'MK006', 'nama' => 'Kecerdasan Buatan', 'sks' => 3, 'semester' => 6, 'jenis' => 'Pilihan', 'prodi' => 'Teknik Informatika'],
        ['kode' => 'MK007', 'nama' => 'Sistem Operasi', 'sks' => 3, 'semester' => 3, 'jenis' => 'Wajib', 'prodi' => 'Teknik Komputer'],
        ['kode' => 'MK008', 'nama' => 'Pemrograman Mobile', 'sks' => 3, 'semester' => 5, 'jenis' => 'Pilihan', 'prodi' => 'Sistem Informasi'],
        ['kode' => 'MK009', 'nama' => 'Data Mining', 'sks' => 3, 'semester' => 6, 'jenis' => 'Pilihan', 'prodi' => 'Teknik Informatika'],
        ['kode' => 'MK010', 'nama' => 'Keamanan Jaringan', 'sks' => 3, 'semester' => 5, 'jenis' => 'Pilihan', 'prodi' => 'Teknik Komputer'],
        ['kode' => 'MK011', 'nama' => 'Pengembangan Aplikasi Mobile', 'sks' => 3, 'semester' => 7, 'jenis' => 'Pilihan', 'prodi' => 'Sistem Informasi'],
        ['kode' => 'MK012', 'nama' => 'Cloud Computing', 'sks' => 3, 'semester' => 8, 'jenis' => 'Pilihan', 'prodi' => 'Teknik Informatika'],
        ['kode' => 'MK013', 'nama' => 'Machine Learning', 'sks' => 3, 'semester' => 8, 'jenis' => 'Pilihan', 'prodi' => 'Teknik Informatika'],
        ['kode' => 'MK014', 'nama' => 'Analisis Sistem Informasi', 'sks' => 3, 'semester' => 4, 'jenis' => 'Wajib', 'prodi' => 'Sistem Informasi'],
        ['kode' => 'MK015', 'nama' => 'Rekayasa Perangkat Lunak', 'sks' => 3, 'semester' => 6, 'jenis' => 'Wajib', 'prodi' => 'Teknik Informatika'],
        ['kode' => 'MK016', 'nama' => 'Pengembangan Game', 'sks' => 3, 'semester' => 7, 'jenis' => 'Pilihan', 'prodi' => 'Sistem Informasi'],
        ['kode' => 'MK017', 'nama' => 'Big Data', 'sks' => 3, 'semester' => 8, 'jenis' => 'Pilihan', 'prodi' => 'Teknik Informatika'],
        ['kode' => 'MK018', 'nama' => 'Internet of Things (IoT)', 'sks' => 3, 'semester' => 7, 'jenis' => 'Pilihan', 'prodi' => 'Teknik Komputer'],
        ['kode' => 'MK019', 'nama' => 'Etika Profesi TI', 'sks' => 2, 'semester' => 1, 'jenis' => 'Wajib', 'prodi' => 'Teknik Informatika'],
        ['kode' => 'MK020', 'nama' => 'Manajemen Proyek TI', 'sks' => 3, 'semester' => 6, 'jenis' => 'Wajib', 'prodi' => 'Sistem Informasi'],
        ['kode' => 'MK021', 'nama' => 'Sistem Informasi Geografis', 'sks' => 3, 'semester' => 5, 'jenis' => 'Pilihan', 'prodi' => 'Teknik Informatika'],
        ['kode' => 'MK022', 'nama' => 'Analisis Data Besar', 'sks' => 3, 'semester' => 7, 'jenis' => 'Pilihan', 'prodi' => 'Sistem Informasi'],
        ['kode' => 'MK023', 'nama' => 'Pengembangan Aplikasi Berbasis Cloud', 'sks' => 3, 'semester' => 8, 'jenis' => 'Pilihan', 'prodi' => 'Teknik Informatika'],
        ['kode' => 'MK024', 'nama' => 'Sistem Keamanan Informasi', 'sks' => 3, 'semester' => 6, 'jenis' => 'Wajib', 'prodi' => 'Teknik Komputer']
    ];

    public function render()
    {
        $collection = collect($this->mataKuliahData);

        // Apply search filter
        if ($this->search) {
            $collection = $collection->filter(function ($item) {
                return str_contains(strtolower($item['nama']), strtolower($this->search)) ||
                       str_contains(strtolower($item['kode']), strtolower($this->search));
            });
        }

        // Apply program studi filter
        if ($this->programStudi) {
            $collection = $collection->where('prodi', $this->programStudi);
        }

        // Apply sorting
        if ($this->sortBy) {
            $collection = $this->sortDirection === 'asc'
                ? $collection->sortBy($this->sortBy)
                : $collection->sortByDesc($this->sortBy);
        }

        // Paginate the results
        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = $this->perPage;
        $results = $collection->slice(($page - 1) * $perPage, $perPage)->values();
        $paginated = new LengthAwarePaginator(
            $results,
            $collection->count(),
            $perPage,
            $page,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return view('livewire.mata-kuliah.mata-kuliah-table', [
            'mataKuliahList' => $paginated,
            'prodiOptions' => array_unique(array_column($this->mataKuliahData, 'prodi'))
        ]);
    }

    public function sort($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingProgramStudi()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function updatePage($page)
    {
        $this->gotoPage($page);
    }

    public function updatePerPage($perPage, $page)
    {
        $this->perPage = $perPage;
        $this->gotoPage($page); // Pindah ke halaman yang diminta
    }
}
