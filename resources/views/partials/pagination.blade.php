<x-layouts.main>
    <x-layouts.content title="Textarea Documentation"> </x-layouts.content>

    <x-container.wrapper cols="1" gapY="4" class="pagination-container">
        <x-container.container class="option-pagination-show flex items-center gap-3">
        <span>Tampilkan</span>
        <select name="limit" value="{{ $limit }}" id="">
          <option value="5" {{ $limit == 5 ? 'selected' : '' }}>5</option>
          <option value="10" {{ $limit == 10 ? 'selected' : '' }}>10</option>
          <option value="15" {{ $limit == 15 ? 'selected' : '' }}>15</option>
          <option value="20" {{ $limit == 20 ? 'selected' : '' }}>20</option>
          <option value="25" {{ $limit == 25 ? 'selected' : '' }}>25</option>
        </select>
        <span>Per Halaman</span>
      </x-container.container>

      <x-container.container class="pagination-info">
        <p>Hasil: {{ $currentPage }} dari {{ $lastPage }}</p>
      </x-container.container>

      <x-container.container class="paginate-navigation bg-gray-50 rounded-md">
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
        </x-container.container>
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
          <x-container.container class="paginate-search">
            <x-container.container class="paginate-button">
              <img src="{{ asset('assets/icon-search.svg') }}" alt="search-icon" class="paginate-icon">
              <span id="open-search-form">Cari Halaman</span>
            </x-container.container>

            <form action="{{ $routes }}" method="GET" class="paginate-search-form" style="display: none;">
              <input type="number" name="page" placeholder="Ketik nomor halaman" min="1"
                value="{{ request('page') }}" />
              <input type="hidden" name="limit" value="{{ $limit }}" />
            </form>

            <button class="paginate-remove-search-text" style="display: none;">
              <img src="{{ asset('assets/icon-remove-text-input.svg') }}" alt="remove-text-button">
            </button>
          </x-container.container>
        @endif
      </x-container.wrapper>

</x-layouts.main>
