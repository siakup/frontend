@props([
  'buttonId',
  'dropdownId',
  'label',
  'imgSrc',
  'dropdownItem',
  'buttonStyleClass' => '',
  'dropdownContainerClass' => '',
  'optionStyleClass' => '',
  'isIconCanRotate' => false,
  'isOptionRedirectableToURLQueryParameter' => false,
  'queryParameter' => '',
  'url' => '',
  'isUsedForInputField' => false,
  'inputFieldName' => ''
])

<div class="relative {{ $dropdownContainerClass }}">
    <button 
      class="flex items-center gap-2 py-2 px-4 bg-transparent border-[1px] border-[#E62129] cursor-pointer text-[#E62129] transition-all duration-200 rounded-lg hover:bg-[#FBE8E6] {{ $buttonStyleClass }}"
      id="{{$buttonId}}"
      onclick="onShowOrHideOption(this, '{{ $isIconCanRotate }}')"
      type="button"
    >
        {{$label}}
        <img src="{{ $imgSrc }}" alt="Filter" class="transition-all duration-200">
    </button>
    <div 
      id="{{ $dropdownId }}" 
      class="absolute top-[100%] bg-white border-[1px] border-[#DDD] rounded-md hidden flex-col items-start max-h-[200px] overflow-y-auto w-max z-10 {{ $optionStyleClass }}" 
    >
      @foreach($dropdownItem as $key => $value)
        @php
          $encodedVariabelIsOptionRedirectableToURLQueryParameter = json_encode($isOptionRedirectableToURLQueryParameter);
          $encodedVariabelIsUsedForInputField = json_encode($isUsedForInputField);
          $extraOnClick = $attributes->get('onclick');
          $defaultOnClick = "
            onSelectedOption(
              this, 
              $encodedVariabelIsOptionRedirectableToURLQueryParameter , 
              '$url', 
              '$queryParameter',
              $encodedVariabelIsUsedForInputField,
              '$inputFieldName'
            );";
          $onClick = $defaultOnClick . ($extraOnClick ? "$extraOnClick;" : '');
        @endphp
        <div 
          class="item px-3 py-2 cursor-pointer hover:bg-[#DDD] transition-[background] duration-200 flex justify-between items-center text-sm w-full" 
          onclick="{{$onClick}}"
          data-sort="{{$value}}"
        >
          {{$key}}
        </div>
      @endforeach
    </div>
</div>

<script>
  function onShowOrHideOption(element, isIconCanRotate) {
    const option = element.nextElementSibling;
    option.classList.toggle('hidden');
    option.classList.toggle('flex');
    if(isIconCanRotate) {
      const img = element.querySelector('img');
      img.classList.toggle('rotate-180');
    }
  }

  function onSelectedOption(element, isOptionRedirectableToURLQueryParameter, url, queryParameter, isUsedForInputField, inputFieldName) {
    const sortDropdown = element.parentElement;
    const button = sortDropdown.previousElementSibling;
    button.innerHTML = button.innerHTML.replace(button.innerHTML.split("<")[0], element.innerHTML);

    sortDropdown.querySelectorAll('.item').forEach(i => {
      i.classList.remove('bg-[#E62129]');
      i.classList.remove('text-white');
    });

    const sortKey = element.getAttribute('data-sort');

    element.classList.add('bg-[#E62129]');
    element.classList.add('text-white');

    sortDropdown.classList.add('hidden');
    sortDropdown.classList.remove('flex');

    if(isOptionRedirectableToURLQueryParameter) {
      redirectToURLQueryParameter(sortKey, url, queryParameter);
    }

    if(isUsedForInputField) {
      const input = document.querySelector(`input[name="${inputFieldName}"]`);
      input.value = sortKey;
    }
  }

  function redirectToURLQueryParameter(value, url, queryParameter) {
    const params = new URLSearchParams(window.location.search);
    params.set(queryParameter, encodeURIComponent(value));
    window.location.href = url + "?" + params.toString();
  }

  document.addEventListener('click', function(e) {
      const toggleBtn = document.getElementById('{{ $buttonId }}');
      const dropdown = document.getElementById('{{ $dropdownId }}');
      const isIconCanRotate = @json(boolval($isIconCanRotate));

      if (!toggleBtn.contains(e.target) && !dropdown.contains(e.target)) {
          dropdown.classList.remove('flex');
          dropdown.classList.add('hidden');
          if(isIconCanRotate) toggleBtn.querySelector('img').classList.remove('rotate-180');
      }
  });
</script>