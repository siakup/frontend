@props(['containerClass' => '', 'labelClass' => '', 'inputClass' => '', 'labelWrap' => false])

<x-container.wrapper cols="12" width="full" justify="between" items="center" class="whitespace-nowrap {{ $containerClass }}">

  <x-container.container col="3" class=" {{ $labelClass }} ">
    <label class="text-gray-800 text-sm font-semibold">
        {{ $label }}
    </label>
  </x-container.container>

  <x-container.container col="9" width="full" class="{{ $inputClass }}">
      {{ $input }}
  </x-container.container>

</x-container.wrapper>
