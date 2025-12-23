@props([
    'name',
    'options' => [], 
    'label' => '',  
    'value' => '',
    'error' => null,
    'helperText' => '',
    'required' => false,
    'inputClass' => ''
])

@php
    $hasServerError = $errors->has($name) || !empty($error);
    $serverErrorMessage = $error ?? $errors->first($name);
@endphp

<div class="w-full"
    x-data="{
        value: @js($value ?? ''),
        serverError: @js($serverErrorMessage),
        clientError: '',
        helperText: @js($helperText),
        required: @js($required || $attributes->has('required')),

        get hasError() {
            return this.serverError || this.clientError;
        },

        get message() {
            if (this.serverError) return this.serverError;
            if (this.clientError) return this.clientError;
            return this.helperText;
        },

        validate() {
            this.clientError = '';
            this.serverError = ''; 

            if (this.required && !this.value) {
                this.clientError = 'Pilihan ini wajib diisi.';
                return;
            }
        }
    }"
    x-modelable="value"

    x-model="{{ $attributes->whereStartsWith('x-model')->first() }}"
>
    @if ($label)
        <label class="block text-sm font-semibold mb-2" 
               :class="hasError ? 'text-red-500' : 'text-gray-700'">
            {{ $label }}
            <span x-show="required" class="text-red-500">*</span>
        </label>
    @endif

    <div class="mt-1 ml-1 text-xs font-medium transition-colors duration-200 min-h-[1.25rem]">
    </div>

    <div class="flex flex-wrap gap-y-4 gap-x-8 w-full items-center {{ $inputClass }}">
        @foreach($options as $option)
            <div class="flex items-center gap-2 cursor-pointer group">
                <input 
                    type="radio" 
                    id="{{ $name }}_{{ $option['value'] }}" 
                    name="{{ $name }}"
                    value="{{ $option['value'] }}" 
                    class="accent-[#E62129] w-4 h-4 cursor-pointer"
                    x-model="value"
                    x-on:change="validate()"
                    {{ $attributes->whereStartsWith('x-')->except('x-model') }}
                    {{ $required ? 'required' : '' }}
                />
                
                <label for="{{ $name }}_{{ $option['value'] }}" 
                       class="text-sm cursor-pointer select-none transition-colors duration-200"
                       :class="{
                           'text-red-500': hasError,
                           'text-[#262626] font-medium': !hasError && value == '{{ $option['value'] }}',
                           'text-[#8C8C8C] group-hover:text-gray-600': !hasError && value != '{{ $option['value'] }}'
                       }">
                    {{ $option['label'] }}
                </label>
            </div>
        @endforeach
    </div>

    <div class="mt-1 ml-1 text-xs font-medium transition-colors duration-200 min-h-[1.25rem]"
         :class="hasError ? 'text-red-500' : 'text-gray-500'">
        <span x-text="message"></span>
    </div>
</div>