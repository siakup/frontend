@props([
    'type' => 'text', // text, select, textarea
    'options' => [], // hanya untuk select
    'name' => '', // opsional
    'label' => '', // opsional
    'value' => '', // default value
    'iconUrl' => null, // HTML string atau view component untuk icon
    'disabled' => false, // prop untuk disable
])

<div {{ $attributes->class(['flex flex-col gap-1']) }}>
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
        <div class="relative">
            <input
                type="{{ $type }}"
                name="{{ $name }}"
                id="{{ $name }}"
                value="{{ old($name, $value) }}"
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
                        'pr-10' => $iconUrl,
                        'bg-[#f5f5f5] text-gray-600 cursor-not-allowed' => $disabled,
                    ]),
                    'disabled' => $disabled ? true : null,
                ]) }}
            />

            @if ($iconUrl)
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <x-icon iconUrl="{{ $iconUrl }}" />
                </div>
            @endif
        </div>
    @endif
</div>
