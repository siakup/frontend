<?php

namespace App\Livewire\MataKuliah;

use App\Traits\ApiResponse;
use Livewire\Component;
use Livewire\WithPagination;

class MataKuliahTable extends Component
{
    use ApiResponse;
    use WithPagination;

    public $search = '';

    public $perPage = 5;

    public $sortBy = 'nama';

    public $sortDirection = 'asc';

    public $programStudi = '';

    public int $page = 1;

    public $mataKuliahList = [];

    public $programStudiList = [];

    protected $listeners = [
        'page-changed' => 'updatePage',
        'per-page-changed' => 'updatePerPage',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 5],
        'sortBy' => ['except' => 'nama'],
        'sortDirection' => ['except' => 'asc'],
        'programStudi' => ['except' => ''],
    ];

    public function mount($mataKuliahList = [], $programStudiList = [])
    {
        $this->mataKuliahList = $mataKuliahList;
        $this->programStudiList = $programStudiList;
    }

    public function render()
    {
        return view('livewire.mata-kuliah.mata-kuliah-table');
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
