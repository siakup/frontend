<style>
    .modal-custom {
        position: fixed;
        inset: -120px;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0,0,0,0.25); 
    }

    .modal-custom-backdrop {
        position: fixed;
        inset: 0;
        z-index: 1;
        display: none;
    }

    .modal-custom-body {
        padding: 20px 12px 12px 20px;
        width: 100%;
        box-sizing: border-box;
    }

    .modal-custom-content {
        position: relative;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.12);
        width: 80vw;
        min-width: 340px;
        /* max-width: 600px; */
        margin: 0 auto;
        margin-top: 10%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        align-self: stretch;
    }

    .modal-custom-header {
        border-radius: 12px 12px 0px 0px;
        border: 1px solid var(--Surface-Border-Primary, #D9D9D9);
        background: var(--Neutral-gray-50, #FFF);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        align-self: stretch;
    }

    .modal-close-btn {
        position: absolute;
        top: 16px;
        right: 20px;
        background: none;
        border: none;
        font-size: 2rem;
        color: #888;
        cursor: pointer;
        z-index: 10;
        transition: color 0.2s;
    }

    .modal-close-btn:hover {
        color: #e74c3c;
    }
    .modal-custom-header {
        position: relative;
    }

    .form-group input[readonly],
    .form-group textarea[readonly] {
        background: var(--Background-Disable-White, #F5F5F5);
        color: var(--Neutral-Gray-600, #8C8C8C);
        cursor: not-allowed;
        opacity: 1;
    }

    .modal-divider {
        width: calc(100% + 32px); 
        height: 1px;
        background: #E5E6E8;
        margin: 24px 0 18px 0;
        border: none;
        position: relative;
        left: -20px;
    }

    .checkbox-group {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      grid-template-rows: repeat(3, 1fr);
      row-gap: 12px;
      column-gap: 32px;
      justify-items: flex-start;
      padding-top: 12px;
      padding-bottom: 12px;
      
    }

    .checkbox-group .checkbox-form {
      display: flex;
      gap: 8px;
    }

    .checkbox-group .checkbox-form label {
      font-weight: 400;
      font-size: 14px;
      color: #8C8C8C;
      width: max-content;
    }

    .toggle-info {
      font-weight: 600;
      font-size: 14px;
      color: #8C8C8C;
    }

    .modal-custom-body {
      text-align: start;
      padding-top: 0px;
      padding-bottom: 0px;
    }

    .flag-label {
      align-items: start;
      margin-top: 20px;
    }

    .flag-label .checkbox-group {
      padding-top: 0px;
    }
</style>

<script>
  function onClickShowDropdown(e) {
    e.nextElementSibling.style.display = (e.nextElementSibling.style.display === 'block') ?
        'none' : 'block';
    e.querySelector('img').src = (e.querySelector('img').src ===
            "{{ asset('assets/icon-arrow-up-black-20.svg') }}") ?
        "{{ asset('assets/icon-arrow-down-grey-20.svg') }}" :
        "{{ asset('assets/icon-arrow-up-black-20.svg') }}";
    document.addEventListener('click', (el) => {
      if(!e.nextElementSibling.contains(el.target) && !e.contains(el.target)) {
        e.nextElementSibling.style.display = 'none';
        e.querySelector('img').src = "{{ asset('assets/icon-arrow-down-grey-20.svg') }}"
      }
    })
  }

  function onClickDropdownOption(e) {
    const value = e.getAttribute('data-event');
    const span = e.parentElement.previousElementSibling.querySelector('span');

    span.innerHTML = e.innerHTML;
    span.style.color = "black";
    e.parentElement.nextElementSibling.value = value;
  }

  function onClickDelete(e) {
    e.parentElement.parentElement.parentElement.remove();
  }

  function onSearchInput(e) {
    $.ajax({
      url: "{{ route('academics.schedule.parent-institution-schedule.add-lecture') }}?search=" + e.value,
      method: 'GET',
      headers: {
          'X-Requested-With': 'XMLHttpRequest'
      },
      success: function(html) {
          const div = document.createElement('div');
          div.innerHTML = html;
          const table = div.querySelector('table');
          $('#Lecture-List').html(table);
          const paginationContainer = div.querySelector('.pagination-container');
          $('#Pagination').html(paginationContainer);
      },
    });
  }

  function onClickLectureOption(e) {
    const selectedLecture = document.getElementById('selected-lecture').querySelector('tbody');
    const lectureData = JSON.parse(e.getAttribute('data-lecture'));
    const lectureBefore = selectedLecture.querySelectorAll('tr');
    if (Array.from(lectureBefore).map(value => value.querySelector('input').value).filter(value => value == lectureData.id).length == 0) {
      const newLectureList = `<tr class="${Array.from(lectureBefore).length % 2 == 0 ? 'bg-white' : 'bg-[#F5F5F5]'} border-b-0">
        <input type="hidden" name="selected_lecture[${Array.from(lectureBefore).length}]['id']" value="${lectureData.id}" />
        <input type="hidden" name="selected_lecture[${Array.from(lectureBefore).length}]['nama_pengajar']" value="${lectureData.nama_pengajar}" />
        <input type="hidden" name="selected_lecture[${Array.from(lectureBefore).length}]['pengajar_program_studi']" value="${lectureData.pengajar_program_studi}" />
        <td class="px-6 py-[24px] text-center align-middle text-sm text-[#262626] border-b border-r border-[#d9d9d9] last:border-r-0">${lectureData.nama_pengajar}</td>
        <td class="px-6 py-[24px] text-center align-middle text-sm text-[#262626] border-b border-r border-[#d9d9d9] last:border-r-0">
          <div class="filter-box" class="status-pengajar">
              <button type="button" class="button-clean input" id="sortProgramPerkuliahan" onclick="onClickShowDropdown(this)">
                  <span id="selectedEventLabel">-Pilih Status Pengajar-</span>
                  <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="Filter">
              </button>
              <div id="Option-Status-Pengajar" class="sort-dropdown select !static" style="display: none;">
                <div class="dropdown-item" data-event="Pengajar Utama" onclick="onClickDropdownOption(this)">Pengajar Utama</div>
                <div class="dropdown-item" data-event="Bukan Pengajar Utama" onclick="onClickDropdownOption(this)">Bukan Pengajar Utama</div>
              </div>
              <input type="hidden" value="" name="selected_lecture[${Array.from(lectureBefore).length}]['status_pengajar']">
          </div>
        </td>
        <td class="px-6 py-[24px] text-center align-middle text-sm text-[#262626] border-b border-r border-[#d9d9d9] last:border-r-0">
          <div class="center flex items-center w-full justify-center">
            <button type="button" onclick="onClickDelete(this)" class="btn-icon btn-delete !flex !items-center !justify-center gap-1" title="Hapus" >
              <img src="{{ asset('assets/icon-delete-gray-600.svg') }}" alt="Hapus">
              <span class="text-[#8C8C8C]">Hapus</span>
            </button>
          </div>
        </td>
      </tr>`;
      selectedLecture.innerHTML = selectedLecture.innerHTML + newLectureList;
      successToast("Berhasil Menambahkan Pengajar");
    }
  }
</script>

<script>
  function initPagination () {
    const select = document.querySelector(".option-pagination-show select");
    const searchButton = document.querySelector('.paginate-search .paginate-button');
    const removeTextButton = document.querySelector('.paginate-search .paginate-remove-search-text');
    const pageButton = document.getElementsByClassName('paginate-items');
    const previousButton = document.querySelector('#previousButton');
    const nextButton = document.querySelector('#nextButton');
    const input = document.querySelector('input[name="search"]');
  
    Array.from(pageButton).map((page) => {
      if(!page.classList.contains('dont-click'))
        page.addEventListener('click', function(e) {
          const limit = e.target.getAttribute('data-limit');
          const page = e.target.getAttribute('data-page');
          
          const url = new URL("{{route('academics.schedule.parent-institution-schedule.add-lecture')}}");
          url.searchParams.set('limit', limit);
          url.searchParams.set('page', page);
  
          $.ajax({
            url: url.toString(),
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(html) {
                const div = document.createElement('div');
                div.innerHTML = html;
                const table = div.querySelector('table');
                $('#Lecture-List').html(table);
                const paginationContainer = div.querySelector('.pagination-container');
                $('#Pagination').html(paginationContainer);
                input.value = '';
                initPagination();
            },
          });
        })
    })
  
    if(previousButton) {
      previousButton.addEventListener('click', function () {
        const limit = previousButton.getAttribute('data-limit');
        const page = previousButton.getAttribute('data-page');
  
        const url = new URL("{{route('academics.schedule.parent-institution-schedule.add-lecture')}}");
        url.searchParams.set('limit', limit);
        url.searchParams.set('page', page);
  
        $.ajax({
          url: url.toString(),
          method: 'GET',
          headers: {
              'X-Requested-With': 'XMLHttpRequest'
          },
          success: function(html) {
              const div = document.createElement('div');
              div.innerHTML = html;
              const table = div.querySelector('table');
              $('#Lecture-List').html(table);
              const paginationContainer = div.querySelector('.pagination-container');
              $('#Pagination').html(paginationContainer);
              input.value = '';
              initScript();
              initPagination();
          },
        });
      })
    }
  
    if(nextButton) {
      nextButton.addEventListener('click', function () {
        const limit = nextButton.getAttribute('data-limit');
        const page = nextButton.getAttribute('data-page');
  
        const url = new URL("{{route('academics.schedule.parent-institution-schedule.add-lecture')}}");
        url.searchParams.set('limit', limit);
        url.searchParams.set('page', page);
  
        $.ajax({
          url: url.toString(),
          method: 'GET',
          headers: {
              'X-Requested-With': 'XMLHttpRequest'
          },
          success: function(html) {
              const div = document.createElement('div');
              div.innerHTML = html;
              const table = div.querySelector('table');
              $('#Lecture-List').html(table);
              const paginationContainer = div.querySelector('.pagination-container');
              $('#Pagination').html(paginationContainer);
              input.value = '';
              initScript();
              initPagination();
          },
        });
      })
    }
  
    if (select) {
      select.addEventListener('change', (event) => {
          const url = new URL("{{route('academics.schedule.parent-institution-schedule.add-lecture')}}");
          url.searchParams.set('limit', event.target.value);
          url.searchParams.delete('page');
          $.ajax({
            url: url.toString(),
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(html) {
                const div = document.createElement('div');
                div.innerHTML = html;
                const table = div.querySelector('table');
                $('#Lecture-List').html(table);
                const paginationContainer = div.querySelector('.pagination-container');
                $('#Pagination').html(paginationContainer);
                input.value = '';
                initScript();
                initPagination();
            },
          });
      });
    } 
  }
  initPagination();
</script>

<div id="modalListLecture" class="modal-custom" style="display:block;">
    <div class="modal-custom-backdrop"></div>
    <div class="modal-custom-content !h-[80vh] overflow-scroll self-center">
        <div class="modal-custom-header">
            <span class="text-lg-bd">Tambah Pengajar</span>
            <button type="button" class="modal-close-btn" onclick="document.getElementById('modalListLecture').remove();document.getElementById('list-lecture').innerHTML=''">
                &times;
            </button>
        </div>
        <div class="modal-custom-body">
          <div class="form-title-text flex items-center justify-between" style="padding: 20px;">
            <p>Cari Pengajar</p>
            <div class="search-section font-medium flex gap-[20px]">
                <div class="search-container" style="display: flex; align-items: center;">
                    <input type="text" name="search" placeholder="Ketik NIP/Nama Pengajar/Pengajar Program Studi"
                        class="search-filter" id="searchInput" autocomplete="off"
                         style="width: 400px;" value="{{$request->input('search', '')}}" oninput="onSearchInput(this)">
                </div>
                <button type="button" href="" class="button button-outline !w-full !min-w-[151px]" id="" onclick="onSearchInput(this.previousElementSibling.querySelector('input'))" disabled>
                    Cari
                </button>
            </div>
          </div>  
          <div class="flex flex-col gap-5 mt-5 px-4">
              <x-table id="Lecture-List">
                <x-table-head>
                  <x-table-row>
                    <x-table-header>NIP</x-table-header>
                    <x-table-header>Nama Pengajar</x-table-header>
                    <x-table-header>Pengajar Program Studi</x-table-header>
                    <x-table-header>Aksi</x-table-header>
                  </x-table-row>
                </x-table-head>
                <x-table-body>
                  @forelse($pengajar as $lecture)
                    <x-table-row>
                      <x-table-cell>{{ $lecture['nip'] }}</x-table-cell>
                      <x-table-cell>{{ $lecture['nama_pengajar'] }}</x-table-cell>
                      <x-table-cell>{{ $lecture['pengajar_program_studi'] }}</x-table-cell>
                      <x-table-cell>
                        <button type="button" href="" class="button button-outline !w-full add-lecture" onclick="onClickLectureOption(this)" data-lecture='@json($lecture)' id="">
                          Pilih Pengajar Ini
                        </button>
                      </x-table-cell>
                    </x-table-row>
                  @empty
                    @include('academics.periode.error-filter')
                  @endforelse
                </x-table-body>
              </x-table>
          </div>
        </div>
        <div class="self-start text-black w-full" id="Pagination">
          @if(isset($pengajar) && count($pengajar) > 0)
            @include('partials.pagination', [
                'currentPage' => (int) $page,
                'lastPage' => $lastPage,
                'limit' => $limit,
                'routes' => route('academics.schedule.parent-institution-schedule.add-lecture'),
                'isCSR' => true,
                'showSearch' => false
            ])
          @endif
        </div>
    </div>
</div>

