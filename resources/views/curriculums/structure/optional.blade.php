@extends('layouts.main')

@section('title', 'Kurikulum Mata Kuliah Pilihan')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Daftar Kurikulum</div>
@endsection

@section('css')
  <style>
    .card-header.option-list {
        justify-content: left;
    }
    .sort-dropdown {
      top: 16.2% !important;
      left: 34.2% !important;
    }
    .center {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 24px;
    }
    .center .btn-icon {
        display: flex;
        align-items: center;
        justify-items: center;
        text-decoration: none;
        gap: 2px;
        font-size: 12px;
        width: max-content;
    }
    .center .btn-delete-periode-academic {
        color: #8C8C8C;
    }
    .center .btn-view-periode-academic {
        color: #262626;
    }
    .center .btn-edit-periode-academic {
        color: #E62129;
    }
    .sub-title {
      padding: 10px 20px !important;
    }
  </style>
@endsection

@section('javascript')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const sortBtnCampusProgram = document.querySelector('#sortButton.campus');
      const sortDropdownCampusProgram = document.querySelector('#sortDropdown.campus');
      const detailClickable = document.querySelectorAll('.detail-clickable');
      const showDetailClickable = document.querySelectorAll('.detail-show');

      sortBtnCampusProgram.addEventListener('click', function(e) {
          e.stopPropagation();
          sortDropdownCampusProgram.style.display = (sortDropdownCampusProgram.style.display ===
              'block') ? 'none' : 'block';
          sortBtnCampusProgram.querySelector('img').src = (sortBtnCampusProgram.querySelector('img')
                  .src === "{{ asset('assets/active/icon-arrow-up.svg') }}") ?
              "{{ asset('assets/active/icon-arrow-down.svg') }}" :
              "{{ asset('assets/active/icon-arrow-up.svg') }}";
      });
      sortDropdownCampusProgram.querySelectorAll('.dropdown-item').forEach(item => {
          item.addEventListener('click', function() {
              sortDropdownCampusProgram.querySelectorAll('.dropdown-item').forEach(i => i
                  .classList.remove('active'));
              const url = new URL(window.location.href);
              const sortKey = this.getAttribute('data-sort');
              url.searchParams.set('program_perkuliahan', sortKey);
              window.location.href = url.toString();
          });
      });
      document.addEventListener('click', (e) => {
          const dropdownCampus = e.target.closest('#CampusProgramSection');
          if (dropdownCampus == null) {
              sortDropdownCampusProgram.style.display = 'none'
              sortBtnCampusProgram.querySelector('img').src =
                  "{{ asset('assets/active/icon-arrow-down.svg') }}";
          }
      });

      function resetDetail(showDetailClickable) {
        showDetailClickable.map(detail => {
          const image = detail.parentElement.querySelector('.detail-clickable img');
          console.log(image);
          if(detail.classList.contains('grid')) {
            detail.classList.remove('grid');
            detail.classList.add('hidden');
            image.src = "{{asset('assets/icon-arrow-down-black-20.svg')}}"
          }
        });
      }

      Array.from(detailClickable).map(clickable => {
        clickable.addEventListener('click', (e) => {
          const image = e.target.querySelector('img');
          const sibling = e.target.parentElement.querySelector('.detail-show');
          resetDetail(Array.from(showDetailClickable).filter(detail => detail !== sibling));
          if(sibling.classList.contains('hidden')) {
            sibling.classList.remove('hidden');
            sibling.classList.add('grid');
            image.src = "{{asset('assets/icon-arrow-up-black-20.svg')}}"
          } else {
            sibling.classList.remove('grid');
            sibling.classList.add('hidden');
            image.src = "{{asset('assets/icon-arrow-down-black-20.svg')}}"
          }
        });
      });
    });
  </script>
@endsection

@section('content')
  <div class="page-header">
    <div class="page-title-text">Kurikulum</div>
  </div>
  <div class="academics-layout">
    @include('curriculums.layout.navbar-curriculum')
    <div class="academics-slicing-content content-card">
      <x-typography variant="heading-h6" class="mb-2 p-[20px]">
        Struktur Kurikulum
      </x-typography>
      <div class="card-header option-list">
        <div class="card-header center" id="CampusProgramSection">
            <div class="page-title-text sub-title">Program Perkuliahan</div>
            <button class="button-clean campus" id="sortButton">
                <span>{{ $id_program ? array_values(array_filter($programPerkuliahanList, function($item) use($id_program) { return $item->id == $id_program; }))[0]->nama : "Semua" }}</span>
                <img src="{{ asset('assets/active/icon-arrow-down.svg') }}" alt="Filter">
            </button>
            <div id="sortDropdown" class="sort-dropdown campus" style="display: none;">
              @foreach($programPerkuliahanList as $programPerkuliahan)
                <div class="dropdown-item" data-sort="{{$programPerkuliahan->id}}">{{$programPerkuliahan->nama}}</div>
              @endforeach
            </div>
        </div>
      </div>
      @include('curriculums.structure.layout.navbar-curriculum-structure')
      <div class="academics-slicing-content content-card" style="background-color: #E8E8E8; border-top: ">
        @foreach($data as $d)
          <div class="flex flex-col gap-[10px]">
            <div class="flex py-[18px] justify-between px-[12px] detail-clickable cursor-pointer">
              <div class="flex gap-1">
                <h1 class="font-bold">Semester {{$d['semester']}}</h1>
                <p>(Total {{$d['total_sks']}} SKS)</p>
              </div>
              <img src="{{asset('assets/icon-arrow-down-black-20.svg')}}" alt="">
            </div>
            <div class="hidden grid-cols-3 grid-rows-3 gap-[10px] px-[12px] detail-show">
              @foreach($d['matkul_list'] as $matkulList)
                <div class="w-full rounded-xl border-[#E8E8E8] bg-white p-[20px] bg-cover bg-center bg-no-repeat" style="background-image: url('/images/bg-study-list.png')">
                  <h1 class="font-bold text-xl">{{$matkulList['nama_matkul']}}</h1>
                  <span class="text-sm flex gap-1">
                    <p class="font-bold">{{$matkulList['sks']}} SKS </p> | <p>{{$matkulList['kode']}}</p>
                  </span>
                </div>
              @endforeach
            </div>
          </div>
        @endforeach
      </div>
      <div class="right">
          <a href="" class="button button-outline">Tambah Kurikulum</a>
      </div>
    </div>
  </div>
@endsection