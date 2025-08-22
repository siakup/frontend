<div class="filter-box">
    <button class="button-clean" id="{{ $buttonId }}">
        {{$label}}
        <img src="{{ $imgSrc }}" alt="Filter">
    </button>
    <div id="{{ $dropdownId }}" class="sort-dropdown {{ $dropdownClass }}" style="display: none;">
      @foreach($dropdownItem as $key => $value)
        <div class="dropdown-item" data-sort="{{$value}}">{{$key}}</div>
      @endforeach
    </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    
    const sortBtn = document.getElementById('{{ $buttonId }}');
    const sortDropdown = document.getElementById('{{ $dropdownId }}');
    const isIconCanRotate = @json(boolval($isIconCanRotate))
  
    function sortTable(value) {
      const params = new URLSearchParams(window.location.search);
      params.set('{{ isset($queryParameter) ? $queryParameter : "sort"}}', encodeURIComponent(value));
      window.location.href = "{{$url}}?" + params.toString();
    }
    
    sortBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        sortDropdown.style.display = (sortDropdown.style.display === 'block') ? 'none' : 'block';
        if(isIconCanRotate) {
          sortBtn.querySelector('img').src = (sortBtn.querySelector('img').src === "{{ $imgInvertSrc }}") ? "{{ $imgSrc }}" : "{{ $imgInvertSrc }}";
        }
    });

    document.querySelectorAll('#{{ $dropdownId }} .dropdown-item').forEach(item => {
        item.addEventListener('click', function() {
            sortDropdown.querySelectorAll('.dropdown-item').forEach(i => i.classList.remove(
                'active'));
            const sortKey = this.getAttribute('data-sort');
            this.classList.add('active');
            sortDropdown.style.display = 'none';
            sortTable(sortKey);
        });
    });

    document.addEventListener('click', function(e) {
        const toggleBtn = document.getElementById('{{ $buttonId }}');
        const dropdown = document.getElementById('{{ $dropdownId }}');
        if (!toggleBtn.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.style.display = 'none';
            if(isIconCanRotate) sortBtn.querySelector('img').src = "{{ $imgSrc }}";
        }
    });

  })
</script>