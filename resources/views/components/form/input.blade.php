@props([
    'type' => 'text', // text, select, textarea
    'options' => [], // hanya untuk select
    'name' => '', // opsional
    'label' => '', // opsional
    'value' => '', // default value
    'iconUrl' => null, // HTML string atau view component untuk icon
    'placeholder' => '',
    'inputClass' => '',
    'disabled' => false, // prop untuk disable,
    'showRemoveIcon' => false,
])

{{-- <div {{ $attributes->class(['flex flex-col gap-1']) }}>
</div> --}}
{{-- Label --}}
@if ($label)
    <label for="{{ $name }}" class="text-sm font-medium text-gray-700">
        {{ $label }}
    </label>
@endif

{{-- Textarea --}}
@if ($type === 'textarea')
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes->except('class')->merge([
            'class' => \Illuminate\Support\Arr::toCssClasses([
                'rounded-lg',
                'border',
                'border-gray-300',
                'focus:ring',
                'focus:ring-blue-200',
                'outline-0',
                'w-full',
                'text-sm',
                'py-[9px]',
                'px-[12px]',
                'text-gray-800',
                'bg-[#f5f5f5] text-gray-600 cursor-not-allowed' => $disabled,
            ]),
            'disabled' => $disabled ? true : null,
        ]) }}
    >{{ old($name, $value) }}</textarea>

    {{-- Select --}}
@elseif ($type === 'select')
    <select
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes->except('class')->merge([
            'class' => \Illuminate\Support\Arr::toCssClasses([
                'rounded-lg',
                'border',
                'border-gray-300',
                'focus:ring',
                'focus:ring-blue-200',
                'outline-0',
                'w-full',
                'text-sm',
                'py-[9px]',
                'px-[12px]',
                'text-gray-800',
                'bg-[#f5f5f5] text-gray-600 cursor-not-allowed' => $disabled,
            ]),
            'disabled' => $disabled ? true : null,
        ]) }}
    >
        @foreach ($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" @selected(old($name, $value) == $optionValue)>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>

{{-- Input default --}}
@else
  <div
    class="p-4 sm:p-5 border-[1px] border-[#D9D9D9] w-full box-border mx-auto !px-3 rounded-lg leading-5 h-10 flex items-center {{ $attributes->has('readonly') || $attributes->has('disabled') ? '!bg-[#F5F5F5]' : 'bg-white' }}"
    x-data="{
      removeButton: false,
      showRemoveIcon: {{ $showRemoveIcon ? 'true' : 'false' }},
      value: @js($value ?? '')
    }"
    x-modelable="value"
    x-model="{{$attributes->get('x-model')}}"
  >
    <input 
      x-on:input="if('{{ $type }}' === 'number') { value = $event.target.value.replace(/[^0-9]/g, ''); } else { value = $event.target.value } removeButton = value !== '';" 
      placeholder="{{ $placeholder }}"  
      name="{{ $name }}" 
      type="text" 
      id="{{ $name }}" 
      {{-- class="!border-transparent focus:outline-none w-full read-only:bg-[#F5F5F5]"  --}}
      x-model="value"
      {{ $attributes->merge([
      'class' => "!border-transparent focus:outline-none w-full read-only:bg-[#F5F5F5] $inputClass"
    ])->except(['placeholder', 'name', 'type', 'id']) }}
    >
    @if($iconUrl)
      <img 
        class="cursor-pointer" 
        :class="{'hidden': !removeButton || !showRemoveIcon}"
        src="{{ $iconUrl }}" 
        alt="" 
        x-on:click="if(showRemoveIcon) { value = ''; removeButton=false; }"
      >
    @endif
  </div>
@endif
