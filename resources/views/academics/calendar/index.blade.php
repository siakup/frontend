@extends('layouts.main')

@section('title', 'Kalender Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Kalender Akademik</div>
@endsection

@section('css')
<style>
  .page-title-text.sub-title {
    font-size: 16px;
  }
  .card-header.option-list {
    justify-content: left;
  }
  .card-header {
    padding-left: 0px;
  }
  .sort-dropdown.left {
      top: 29%;
      left: 29.7%;
      z-index: 999;
      right: auto;
  }
  .sort-dropdown.right {
      top: 41%;
      right: 39%;
      z-index: 999;
  }
</style>
@endsection

@section('javascript')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // sort dropdown
    const sortBtnCampusProgram = document.querySelector('#sortButton.campus');
    const sortDropdownCampusProgram  = document.querySelector('#sortDropdown.campus');
    const sortBtnStudyProgram = document.querySelector('#sortButton.study');
    const sortDropdownStudyProgram  = document.querySelector('#sortDropdown.study');

    // Toggle dropdown on button click
    sortBtnCampusProgram.addEventListener('click', function (e) {
        e.stopPropagation();
        sortDropdownCampusProgram.style.display = (sortDropdownCampusProgram.style.display === 'block') ? 'none' : 'block';
        sortBtnCampusProgram.querySelector('img').src = (sortBtnCampusProgram.querySelector('img').src === "{{ asset('assets/active/icon-arrow-up.svg') }}") ? "{{ asset('assets/active/icon-arrow-down.svg') }}" : "{{ asset('assets/active/icon-arrow-up.svg') }}";
    });
    sortDropdownCampusProgram.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function () {
            sortDropdownCampusProgram.querySelectorAll('.dropdown-item').forEach(i => i.classList.remove('active'));
            const sortKey = this.getAttribute('data-sort');
            
            this.classList.add('active');
            sortDropdownCampusProgram.style.display = 'none';
            sortTable(sortKey); // Panggil AJAX sortTable
        });
    });

    sortBtnStudyProgram.addEventListener('click', function (e) {
        e.stopPropagation();
        sortDropdownStudyProgram.style.display = (sortDropdownStudyProgram.style.display === 'block') ? 'none' : 'block';
        sortBtnStudyProgram.querySelector('img').src = (sortBtnStudyProgram.querySelector('img').src === "{{ asset('assets/active/icon-arrow-up.svg') }}") ? "{{ asset('assets/active/icon-arrow-down.svg') }}" : "{{ asset('assets/active/icon-arrow-up.svg') }}";
    });
    sortDropdownStudyProgram.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function () {
            sortDropdownStudyProgram.querySelectorAll('.dropdown-item').forEach(i => i.classList.remove('active'));
            const sortKey = this.getAttribute('data-sort');
            
            this.classList.add('active');
            sortDropdownStudyProgram.style.display = 'none';
            sortTable(sortKey); // Panggil AJAX sortTable
        });
    });

    document.addEventListener('click', (e) => {
      const dropdownCampus = e.target.closest('#CampusProgramSection');
      const dropdownStudy = e.target.closest('#StudyProgramSection');
      
      if(dropdownCampus == null) {
        sortDropdownCampusProgram.style.display = 'none';
        sortBtnCampusProgram.querySelector('img').src = "{{ asset('assets/active/icon-arrow-down.svg') }}";
      }
      if(dropdownStudy == null){
        sortDropdownStudyProgram.style.display = 'none'
        sortBtnStudyProgram.querySelector('img').src = "{{ asset('assets/active/icon-arrow-down.svg') }}";
      }
    });
  })
</script>
@endsection

@section('content')
    <div class="page-header">
        <div class="page-title-text">Kalender Akademik - Universitas Pertamina</div>
    </div>
    <div class="content-card">
      <div class="card-header">
        <div class="page-title-text sub-title">Tahun Akademik 2025-2026</div>
      </div>
      <div class="card-header option-list">
        <div class="card-header" id="CampusProgramSection">
          <div class="page-title-text sub-title">Program Perkuliahan</div>
          <button class="button-clean campus" id="sortButton">
              <span>Reguler</span>
              <img src="{{ asset('assets/active/icon-arrow-down.svg') }}" alt="Filter">
          </button>
          <div id="sortDropdown" class="sort-dropdown left campus" style="display: none;">
              <div class="dropdown-item" data-sort="reguler">Reguler</div>
              <div class="dropdown-item" data-sort="double-degree">Double Degree</div>
              <div class="dropdown-item" data-sort="international">International</div>
              <div class="dropdown-item" data-sort="karyawan">Karyawan</div>
          </div>
        </div>
        <div class="card-header" id="StudyProgramSection">
          <div class="page-title-text sub-title">Program Studi</div>
          <button class="button-clean study" id="sortButton">
              <span>Ilmu Komputer</span>
              <img src="{{ asset('assets/active/icon-arrow-down.svg') }}" alt="Filter">
          </button>
          <div id="sortDropdown" class="sort-dropdown right study" style="display: none;">
              <div class="dropdown-item" data-sort="Ilkom">Ilmu Komputer</div>
              <div class="dropdown-item" data-sort="Tekkim">Teknik Kimia</div>
              <div class="dropdown-item" data-sort="Teksip">Teknik Sipil</div>
              <div class="dropdown-item" data-sort="Tekin">Teknik Industri</div>
          </div>
        </div>
      </div>
      <div class="table-responsive">
          <table class="table" id="list-user" style="--table-cols:7;">
              <thead>
                  <tr>
                      <th>Periode Akademik</th>
                      <th>Semester</th>
                      <th>Tanggal Mulai</th>
                      <th>Tanggal Berakhir</th>
                      <th>Aksi</th>
                      <th>Status</th>
                  </tr>
              </thead>
              <tbody>
                 
              </tbody>
          </table>
      </div>
      <div class="right">
        <a href="" class="button button-outline">Generate Riwayat Akademik</a>
      </div>
    </div>
@endsection
