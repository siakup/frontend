@props(['routes', 'placeholder', 'fieldKey', 'search'])
<script>
  function refreshTable(searchKey, routes) {
      $.ajax({
          url: routes,
          method: 'GET',
          data: {
              search: searchKey
          },
          headers: {
              'X-Requested-With': 'XMLHttpRequest'
          },
          success: function(response) {
              window.location.href = routes + '?search=' +
                  encodeURIComponent(searchKey);
          },
          error: function() {
              $('tbody').html(
                  '<tr><td colspan="7" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>'
              );
          }
      });
  }

  function createLoadingIndicator() {
    const loadingIndicator = document.createElement('div');
    loadingIndicator.className = 'dropdown-item text-center';
    loadingIndicator.innerHTML = 'Sedang mencari...';

    return loadingIndicator;
  }

  function handleSearch(e, routes, fieldKey) {
    const dropdown = e.nextElementSibling.nextElementSibling;
    const keyword = e.value.trim();
    const loadingIndicator = createLoadingIndicator();
    
    document.addEventListener('click', function(el) {
        if (!dropdown.contains(el.target) && !e.contains(el.target)) {
            dropdown.style.display = 'none';
        }
    });

    if (keyword.length < 1) {
        dropdown.style.display = 'none';
        return;
    }

    dropdown.innerHTML = '';
    dropdown.appendChild(loadingIndicator);
    dropdown.style.display = 'block';

    $.ajax({
        url: routes,
        method: 'GET',
        data: {
            search: keyword
        },
        dataType: 'json',
        success: function(data) {
            if (!data.success || !Array.isArray(data.data) || data.data.length === 0) {
                dropdown.innerHTML =
                    '<div class="dropdown-item text-center">Tidak ada hasil ditemukan</div>';
                return;
            }
            dropdown.innerHTML = '';
            data.data.forEach(value => {
                const item = document.createElement('div');
                item.className = 'dropdown-item';
                item.textContent = value[fieldKey];
                item.onclick = () => {
                    dropdown.querySelectorAll('.dropdown-item').forEach(
                        i => i.classList.remove('active'));
                    item.classList.add('active');
                    e.value = value[fieldKey];
                    dropdown.style.display = 'none';
                    refreshTable(value[fieldKey], routes);
                };
                dropdown.appendChild(item);
            });
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            dropdown.innerHTML =
                '<div class="dropdown-item text-center text-danger">Terjadi kesalahan, silakan coba lagi</div>';
        }
    });
  }
</script>

<div class="w-full">
  <div class="relative flex items-center">
      <input 
        type="text" 
        placeholder="{{$placeholder}}" 
        {{
          $attributes->merge([
            'class' => "px-[12px] py-[8px] border-[1px] border-solid border-[#D9D9D9] rounded-lg text-sm read-only:bg-[#F5F5F5] read-only:text-[#8C8C8C] read-only:border-[#E8E8E8] read-only:cursor-not-allowed",
          ])
        }}
        @if($attributes->has('id'))
          id="{{$attributes->get('id')}}"
        @else
          id="searchInput"
        @endif
        @if($attributes->has('oninput'))
          oninput="{{ $attributes->get('oninput') }}"
        @else
          oninput="handleSearch(this, '{{$routes}}', '{{$fieldKey}}')"
        @endif
        autocomplete="off"
        value="{{ $search }}"
      />
      <img src="{{ asset('assets/search-left.svg') }}" alt="search" class="search-icon-right absolute right-3 w-6 h-6 pointer-events-none filter invert-[46%] sepia-[9%] saturate-[316%] hue-rotate-[182deg] brightness-[94%] contrast-[90%]" />
      <div class="search-dropdown rounded-lg overflow-hidden" id="searchDropdown"></div>
  </div>
</div>