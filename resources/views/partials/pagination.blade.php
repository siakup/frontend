<script>
  document.addEventListener('DOMContentLoaded', () => {
      const select = document.querySelector(".option-pagination-show select");
      const searchButton = document.querySelector('.paginate-search .paginate-button');
    const removeTextButton = document.querySelector('.paginate-search .paginate-remove-search-text'); 
      if (select) {
          select.addEventListener('change', (event) => {
              const url = new URL(window.location.href);
              url.searchParams.set('limit', event.target.value);
              url.searchParams.delete('page');
              window.location.href = url.toString();
          });
    } 
      if (searchButton && removeTextButton) {
          searchButton.addEventListener('click', () => {
              const form = document.querySelector('.paginate-search form');
              if (form) {
                  removeTextButton.style.display = 'inline';
                  form.style.setProperty('display', 'flex', 'important');
              }
        }); 
          removeTextButton.addEventListener('click', () => {
              const input = document.querySelector('.paginate-search form input');
              if (input) input.value = "";
          });
      }
  });
</script>
<div class="pagination-container">
    <div class="option-pagination-show">
        <span>Tampilkan</span>
        <select name="limit" value="{{ $limit }}" id="">
            <option value="5" {{ $limit == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ $limit == 10 ? 'selected' : '' }}>10</option>
            <option value="15" {{ $limit == 15 ? 'selected' : '' }}>15</option>
            <option value="20" {{ $limit == 20 ? 'selected' : '' }}>20</option>
            <option value="25" {{ $limit == 25 ? 'selected' : '' }}>25</option>
        </select>
        <span>Per Halaman</span>
    </div>
    <p>
        Hasil: {{ $currentPage }} dari {{ $lastPage }}
    </p>
    <div class="paginate-navigation !bg-[#f5f5f5] rounded-[6px]">
        @for ($i = 1; $i <= $lastPage; $i++)
            @if ($i === $currentPage || $i === $currentPage - 1 || $i === $currentPage + 1 || $i === 1 || $i === $lastPage)
                @if(isset($isCSR) && $isCSR)
                  <button data-limit="{{$limit}}" data-page="{{$i}}"
                      class="paginate-items {{ $currentPage === $i ? 'active' : '' }}">{{ $i }}</button>
                @else
                  <a href="{{ $routes . '?' . (isset(request()->query()['limit']) ? 'limit=' . request()->query()['limit'] . '&' : '') . 'page=' . $i }}"
                      class="paginate-items {{ $currentPage === $i ? 'active' : '' }}">{{ $i }}</a>
                @endif
            @elseif($i === $lastPage - 1 || $i === 2)
                <span class="paginate-items dont-click{{ $currentPage === $i ? 'active' : '' }}">...</span>
            @endif
        @endfor
    </div>
    @if ($currentPage > 1)
      @if(isset($isCSR) && $isCSR)
        <button data-limit="{{$limit}}" data-page="{{(int) $currentPage - 1}}" class="paginate-button {{ $currentPage === $i ? 'active' : '' }}" id="previousButton">
          <img src="{{ asset('assets/icon-arrow-right-black-12.svg') }}" alt="previous-icon" class="paginate-icon">
          <span>Sebelumnya</span>
        </button>
      @else
        <a href="{{ $routes . '?' . (isset(request()->query()['limit']) ? 'limit=' . request()->query()['limit'] . '&' : '') . 'page=' . ((int) $currentPage - 1) }}"
            class="paginate-button">
            <img src="{{ asset('assets/icon-arrow-right-black-12.svg') }}" alt="previous-icon" class="paginate-icon">
            <span>Sebelumnya</span>
        </a>
      @endif
    @endif
    @if ($currentPage < $lastPage)
      @if(isset($isCSR) && $isCSR)
        <button data-limit="{{$limit}}" data-page="{{(int) $currentPage + 1}}" class="paginate-button {{ $currentPage === $i ? 'active' : '' }}" id="nextButton">
          <span>Selanjutnya</span>
          <img src="{{ asset('assets/icon-arrow-right-black-12.svg') }}" alt="next-icon" class="paginate-icon">
        </button>
      @else
        <a href="{{ $routes . '?' . (isset(request()->query()['limit']) ? 'limit=' . request()->query()['limit'] . '&' : '') . 'page=' . ((int) $currentPage + 1) }}"
            class="paginate-button">
            <span>Selanjutnya</span>
            <img src="{{ asset('assets/icon-arrow-right-black-12.svg') }}" alt="next-icon" class="paginate-icon">
        </a>
      @endif
    @endif
    @if (!isset($showSearch) || $showSearch !== false)
        <div class="paginate-search">
            <div class="paginate-button">
                <img src="{{ asset('assets/icon-search.svg') }}" alt="search-icon" class="paginate-icon">
                <span id="open-search-form">Cari Halaman</span>
            </div>

            <form action="{{ $routes }}" method="GET" class="paginate-search-form" style="display: none;">
                <input type="number" name="page" placeholder="Ketik nomor halaman" min="1"
                    value="{{ request('page') }}" />
                <input type="hidden" name="limit" value="{{ $limit }}" />
            </form>

            <button class="paginate-remove-search-text" style="display: none;">
                <img src="{{ asset('assets/icon-remove-text-input.svg') }}" alt="remove-text-button">
            </button>
        </div>
    @endif
</div>
