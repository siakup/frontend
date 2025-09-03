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

  function initScript() {
    const input = document.querySelector('input[name="search"]');
    input.addEventListener('input', () => {
      $.ajax({
        url: "{{ route('academics.schedule.parent-institution-schedule.add-course') }}?search=" + input.value,
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
            initScript();
            initPagination();
        },
      });
    });
  }

  function onSelectCourse(e) {
    const dataCourse = JSON.parse(e.getAttribute('data-course'));
    document.querySelector('input[name="nama_matakuliah"]').value = dataCourse.nama_matakuliah;
    document.querySelector('input[name="matakuliah[jenis_matakuliah]"]').value = dataCourse.jenis_matakuliah;
    document.querySelector('input[name="matakuliah[sks]"]').value = dataCourse.sks;
    document.querySelector('input[name="matakuliah[kurikulum]"]').value = dataCourse.kurikulum;
    document.querySelector('input[name="matakuliah[kode_matakuliah]"]').value = dataCourse.kode_matakuliah;
    document.querySelector('input[name="matakuliah[id]"]').value = dataCourse.id;
    successToast("Berhasil Menambahkan Mata Kuliah");
  }

  initScript();
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
          
          const url = new URL("{{route('academics.schedule.parent-institution-schedule.add-course')}}");
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
    })
  
    if(previousButton) {
      previousButton.addEventListener('click', function () {
        const limit = previousButton.getAttribute('data-limit');
        const page = previousButton.getAttribute('data-page');
  
        const url = new URL("{{route('academics.schedule.parent-institution-schedule.add-course')}}");
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
  
        const url = new URL("{{route('academics.schedule.parent-institution-schedule.add-course')}}");
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
          const url = new URL("{{route('academics.schedule.parent-institution-schedule.add-course')}}");
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

<div id="modalListCourse" class="modal-custom" style="display:block;">
    <div class="modal-custom-backdrop"></div>
    <div class="modal-custom-content !max-w-[80vw] max-wi !h-[80vh] overflow-scroll self-center">
        <div class="modal-custom-header">
            <span class="text-lg-bd">Daftar Mata Kuliah - Semester Ganjil</span>
            <button type="button" class="modal-close-btn" onclick="document.getElementById('modalListCourse').remove();document.getElementById('list-course').innerHTML=''">
                &times;
            </button>
        </div>
        <div class="modal-custom-body">
          <div class="form-title-text flex items-center justify-between" style="padding: 20px;">
            <p>Cari Mata Kuliah</p>
            <div class="search-section font-medium flex gap-[20px]">
                <div class="search-container" style="display: flex; align-items: center;">
                    <input type="text" name="search" placeholder="Ketik Mata Kuliah/Kode Mata Kuliah"
                        class="search-filter" id="searchInput" autocomplete="off"
                         style="width: 400px;" value="{{$request->input('search', '')}}">
                </div>
                <button type="button" href="" class="button button-outline !w-full !min-w-[151px]" id="" disabled>
                    Cari
                </button>
            </div>
          </div>  
          <div class="flex flex-col gap-5 mt-5 px-4">
              <x-table id="Lecture-List">
                <x-table-head>
                  <x-table-row>
                    <x-table-header>Kode Mata Kuliah</x-table-header>
                    <x-table-header>Nama Mata Kuliah</x-table-header>
                    <x-table-header>Jenis Mata Kuliah</x-table-header>
                    <x-table-header>SKS</x-table-header>
                    <x-table-header>Kurikulum</x-table-header>
                    <x-table-header>Aksi</x-table-header>
                  </x-table-row>
                </x-table-head>
                <x-table-body>
                  @forelse($mata_kuliah_list as $course)
                    <x-table-row>
                      <x-table-cell>{{ $course['kode_matakuliah'] }}</x-table-cell>
                      <x-table-cell>{{ $course['nama_matakuliah'] }}</x-table-cell>
                      <x-table-cell>{{ $course['jenis_matakuliah'] }}</x-table-cell>
                      <x-table-cell>{{ $course['sks'] }}</x-table-cell>
                      <x-table-cell>{{ $course['kurikulum'] }}</x-table-cell>
                      <x-table-cell>
                        <button type="button" href="" class="button button-outline !w-full" onclick="onSelectCourse(this)" data-course='@json($course)' id="">
                          Pilih Mata Kuliah Ini
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
          @if(isset($mata_kuliah_list) && count($mata_kuliah_list) > 0)
            @include('partials.pagination', [
                'currentPage' => (int) $page,
                'lastPage' => $lastPage,
                'limit' => $limit,
                'routes' => route('academics.schedule.parent-institution-schedule.add-course'),
                'isCSR' => true,
                'showSearch' => false
            ])
          @endif
        </div>
    </div>
</div>

