@extends('layouts.main')

@section('title', 'Tetapkan Mata Kuliah Kurikulum')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Kurikulum</div>
@endsection

@section('css')
@endsection

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const courseType = document.querySelector('input[name="jenis_mata_kuliah"]');
    const courseName = document.querySelector('input[name="nama"]');
    const sortBtnEventName = document.querySelector('#sortEvent');
    const sortDropdownEventName = document.querySelector('#option-jenis-mata-kuliah');
    const selectAll = document.querySelector('input#select-all[type="checkbox"]');
    const assignValue = document.querySelectorAll('input[name="course-list[]"]');

    selectAll.addEventListener('input', (e) => {
      Array.from(assignValue).forEach(value => {
        value.checked = e.target.checked
      });
    });

    courseName.addEventListener('input', () => {
      updateSaveButtonState();
    });

    function updateSaveButtonState() {
      const courseTypeFilled = courseType.value.trim() !== '';
      const courseNameFilled = courseName.value.trim() !== '';
      if(courseTypeFilled || courseNameFilled) {
        document.querySelector('#btnSimpan').disabled = false;
      } else {
        document.querySelector('#btnSimpan').disabled = true;
      }
    }
  
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
        const dropdownStudy = e.target.closest('#jenis_mata_kuliah');
        if (dropdownStudy == null) {
            sortDropdownEventName.style.display = 'none'
            sortBtnEventName.querySelector('img').src =
                "{{ asset('assets/icon-arrow-down-grey-20.svg') }}";
        }
    });
    document.querySelectorAll('#option-jenis-mata-kuliah .dropdown-item').forEach((dropdownItem) => {
        dropdownItem.addEventListener('click', () => {
            const value = dropdownItem.getAttribute('data-event');
            const span = sortBtnEventName.querySelector('span');
            span.innerHTML = dropdownItem.innerHTML;
            span.style.color = "black";
            courseType.value = value;
            updateSaveButtonState();
        });
    });
  })
</script>

@section('content')
  <div class="page-header">
    <div class="page-title-text">Tetapkan Mata Kuliah</div>
  </div>
  <a href="{{ route('curriculum.list.edit', ['id' => $id]) }}" class="button-no-outline-left">
      <img src="{{ asset('assets/active/icon-arrow-left.svg') }}" alt="Kembali"> Ubah Kurikulum
  </a>
  <div class="content-card">
    <form action="{{route('curriculum.list.edit.assign-study', ['id' => $id])}}" method="GET">
      <div class="form-title-text">Daftar Mata Kuliah</div>
      <div class="form-section">
        <div class="form-group">
            <label for="name">Jenis Mata Kuliah</label>
            <div class="filter-box w-full" id="jenis_mata_kuliah">
                <button type="button" class="button-clean input border-[1px] !border-[#BFBFBF] w-full flex items-center justify-between" id="sortEvent">
                    <span id="selectedEventLabel" class="text-black">{{$jenis_mata_kuliah ? $jenis_mata_kuliah : 'Semua Mata Kuliah'}}</span>
                    <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="Filter">
                </button>
                <div id="option-jenis-mata-kuliah" class="sort-dropdown select !top-[9.2%] !left-[15.2%]" style="display: none;">
                  @foreach($programPerkuliahanList as $programPerkuliahan)
                    <div class="dropdown-item" data-event="{{$programPerkuliahan->name}}">{{$programPerkuliahan->name}}</div>
                  @endforeach
                </div>
                <input type="hidden" value="{{$jenis_mata_kuliah}}" name="jenis_mata_kuliah">
            </div>
        </div>
        <div class="form-group">
            <label for="Curriculum-Name">Mata Kuliah</label>
            <div class="flex items-center border-[1px] border-[#D9D9D9] rounded-lg px-[12px] w-full">
                <input placeholder="Ketik Mata Kuliah" name="nama" type="text" id="Curriculum-Name" class="!border-transparent focus:outline-none" value="{{$nama_mata_kuliah}}">
                <img class="clear hidden" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
            </div>
        </div>
        <div class="button-group flex w-full justify-end">
          <button type="button" class="button button-clean disabled:!bg-white disabled:!border-[#BFBFBF] disabled:!border-[1px]" id="btnBatal" @if($jenis_mata_kuliah == '' && $nama_mata_kuliah == '') disabled @endif>Batal</button>
          <button type="submit" class="button button-outline" id="btnSimpan" @if($jenis_mata_kuliah == '' && $nama_mata_kuliah == '') disabled @endif>Cari</button>
        </div>
    </form>
    </div>
    <x-container class="border-none">
      <form action="{{route('curriculum.list.edit.update-assign-study', ['id' => $id])}}" method="POST">
        @csrf
        <div class="flex flex-col gap-5">
          <x-table>
              <x-table-head>
                  <x-table-row>
                      <x-table-header class="cursor-pointer">
                          <input type="checkbox" id="select-all" class="not-checked:appearance-none not-checked:bg-white not-checked:border-[1px] not-checked:border-black not-checked:w-[12px] not-checked:h-[12px] not-checked:rounded-xs accent-[#E62129]">
                      </x-table-header>
                      <x-table-header class="cursor-pointer">
                          Kode Mata Kuliah
                      </x-table-header>
                      <x-table-header class="cursor-pointer">
                          Nama
                      </x-table-header>
                      <x-table-header class="cursor-pointer">
                          Jumlah SKS
                      </x-table-header>
                      <x-table-header class="cursor-pointer">
                          Program Studi
                      </x-table-header>
                      <x-table-header>Jenis Mata Kuliah</x-table-header>
                  </x-table-row>
              </x-table-head>
              <x-table-body>
                  @forelse ($data as $d)
                      <x-table-row>
                          <x-table-cell>
                            <input type="checkbox" name="course-list[]" value="{{$d->id}}" class="not-checked:appearance-none not-checked:bg-white not-checked:border-[1px] not-checked:border-black not-checked:w-[12px] not-checked:h-[12px] not-checked:rounded-xs accent-[#E62129]" @if($d->is_assigned) checked @endif>
                          </x-table-cell>
                          <x-table-cell>{{ $d->kode }}</x-table-cell>
                          <x-table-cell>{{ $d->nama_id }}</x-table-cell>
                          <x-table-cell>{{ $d->sks }}</x-table-cell>
                          <x-table-cell>{{ current(array_filter($programStudiList, function ($item) use ($d) { return $item->id == $d->id_prodi; }))->nama }}</x-table-cell>
                          <x-table-cell>{{ $d->id_jenis }}</x-table-cell>
                      </x-table-row>
                  @empty
                      <x-table-row>
                          <x-table-cell colspan="6" class="text-center py-4">
                              Tidak ada data ditemukan
                          </x-table-cell>
                      </x-table-row>
                  @endforelse
              </x-table-body>
          </x-table>
          <button type="submit" class="button button-outline self-end !me-0" id="btnSimpan">Tetapkan</button>
        </div>
      </form>
    </x-container>
  </div>
  @include('partials.pagination', [
      'currentPage' => $response->pagination->current_page,
      'lastPage' => $response->pagination->last_page,
      'limit' => 10,
      'routes' => route('curriculum.list.edit.assign-study', ['id' => $id]),
  ])
@endsection