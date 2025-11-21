<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class CustomPagination extends Component
{
    use WithPagination;

    public $totalItems;

    public $currentPage;

    public $perPage;

    public $perPageInput;

    public $defaultPerPageOptions = [5, 10, 25, 50];

    public $totalPages;

    public function mount($paginator)
    {
        $this->totalItems = $paginator->total();
        $this->currentPage = $paginator->currentPage();
        $this->perPage = $paginator->perPage();
        $this->perPageInput = $this->perPage;
        $this->calculateTotalPages();
    }

    public function calculateTotalPages()
    {
        $this->totalPages = max(1, ceil($this->totalItems / $this->perPage));
        // Pastikan current page tidak melebihi total pages
        if ($this->currentPage > $this->totalPages) {
            $this->currentPage = $this->totalPages;
        }
    }

    public function gotoPage($page)
    {
        $this->currentPage = $page;
        $this->dispatch('page-changed', page: $page);
    }

    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
            $this->dispatch('page-changed', page: $this->currentPage);
        }
    }

    public function nextPage()
    {
        if ($this->currentPage < $this->totalPages) {
            $this->currentPage++;
            $this->dispatch('page-changed', page: $this->currentPage);
        }
    }

    public function changePerPage()
    {
        // Validasi input
        $validPerPage = max(1, min(100, (int) $this->perPageInput));
        $this->perPage = $validPerPage;
        $this->perPageInput = $validPerPage;

        // Hitung ulang total pages
        $this->calculateTotalPages();

        // Reset ke halaman pertama jika perPage berubah
        $this->currentPage = 1;

        $this->dispatch('per-page-changed', perPage: $validPerPage, page: 1);
    }

    public function setPerPage($value)
    {
        $this->perPageInput = $value;
        $this->changePerPage();
    }

    public function render()
    {
        return view('livewire.custom-pagination');
    }
}
