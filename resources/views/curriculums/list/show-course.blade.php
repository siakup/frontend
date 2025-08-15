@extends('layouts.main')

@section('title', 'Ubah Mata Kuliah Kurikulum')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Kurikulum</div>
@endsection

@section('css')
@endsection

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const eventName = document.querySelector('input[name="program_perkuliahan"]');
    const sortBtnEventName = document.querySelector('#sortEvent');
    const sortDropdownEventName = document.querySelector('#Option-Program-Perkuliahan');
  
    sortBtnEventName.addEventListener('click', function(e) {
        e.stopPropagation();
        sortDropdownEventName.style.display = (sortDropdownEventName.style.display === 'block') ?
            'none' : 'block';
        sortBtnEventName.querySelector('img').src = (sortBtnEventName.querySelector('img').src ===
                "{{ asset('assets/icon-arrow-up-black-20.svg') }}") ?
            "{{ asset('assets/icon-arrow-down-grey-20.svg') }}" :
            "{{ asset('assets/icon-arrow-up-black-20.svg') }}";
    });
    document.addEventListener('click', (e) => {
        const dropdownStudy = e.target.closest('#program_perkuliahan');
        if (dropdownStudy == null) {
            sortDropdownEventName.style.display = 'none'
            sortBtnEventName.querySelector('img').src =
                "{{ asset('assets/icon-arrow-down-grey-20.svg') }}";
        }
    });
    document.querySelectorAll('#Option-Program-Perkuliahan .dropdown-item').forEach((dropdownItem) => {
        dropdownItem.addEventListener('click', () => {
            const value = dropdownItem.getAttribute('data-event');
            const span = sortBtnEventName.querySelector('span');
            span.innerHTML = dropdownItem.innerHTML;
            span.style.color = "black";
            eventName.value = value;
            updateSaveButtonState();
        });
    });
  })
</script>

@section('content')
  <div class="page-header">
    <div class="page-title-text">Ubah Mata Kuliah</div>
  </div>
  <a href="{{ route('curriculum.list.edit', ['id' => $id]) }}" class="button-no-outline-left">
      <img src="{{ asset('assets/active/icon-arrow-left.svg') }}" alt="Kembali"> Ubah Kurikulum
  </a>
  <div class="content-card">
    <div class="form-title-text">Daftar Mata Kuliah</div>
    <div class="form-section">
      <div class="form-group">
          <label for="name">Program Perkuliahan</label>
          <div class="filter-box w-full" id="program_perkuliahan">
              <button type="button" class="button-clean input border-[1px] !border-[#BFBFBF] w-full flex items-center justify-between" id="sortEvent">
                  <span id="selectedEventLabel" class="text-black">Semua Mata Kuliah</span>
                  <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="Filter">
              </button>
              <div id="Option-Program-Perkuliahan" class="sort-dropdown select !top-[36%] !left-[15.2%]" style="display: none;">
                <div class="dropdown-item" data-event="">Mata Kuliah Dasar Umum</div>
                <div class="dropdown-item" data-event="">Mata Kuliah Program Studi</div>
              </div>
              <input type="hidden" value="" name="program_perkuliahan">
          </div>
      </div>
      <div class="form-group">
          <label for="Curriculum-Name">Nama Mata Kuliah</label>
          <div class="flex items-center border-[1px] border-[#D9D9D9] rounded-lg px-[12px] w-full">
              <input placeholder="Ketik Mata Kuliah" name="nama" type="text" id="Curriculum-Name" class="!border-transparent focus:outline-none" value="">
              <img class="clear hidden" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
          </div>
      </div>
      <div class="button-group flex w-full justify-end">
        <button type="button" class="button button-clean" id="btnBatal">Batal</button>
        <button type="button" class="button button-outline" id="btnSimpan">Simpan</button>
      </div>
    </div>
  </div>
  @include('partials.pagination', [
      'currentPage' => 1,
      'lastPage' => 10,
      'limit' => 10,
      'routes' => '',
  ])
@endsection