@props([
    'type' => 'text',
    'name' => '', 
    'label' => '', 
    'value' => '', 
    'disabled' => false,
    'showRemoveIcon' => false,
    'placeholder' => '',
    'inputClass' => '',
    'error' => null,       
    'helperText' => '', 
])

@php
    $hasServerError = $errors->has($name) || !empty($error);
    $serverErrorMessage = $error ?? $errors->first($name);
    
    $min = $attributes->get('minlength') ?? $attributes->get('min');
    $max = $attributes->get('maxlength') ?? $attributes->get('max');
@endphp

<div class="w-full"
    x-data="{
        value: @js($value ?? ''),
        removeButton: false,
        serverError: @js($serverErrorMessage),
        clientError: '',
        helperText: @js($helperText),
        min: @js($min),
        max: @js($max),
        type: @js($type),

        get hasError() {
            return this.serverError || this.clientError;
        },

        get message() {
            if (this.serverError) return this.serverError;
            if (this.clientError) return this.clientError;
            return this.helperText;
        },

        validate(val) {
            this.clientError = ''; 
            this.serverError = ''; 

            if (!val && !this.min) return;

            if (this.min && val.length < this.min) {
                this.clientError = `Minimal ${this.min} karakter.`;
                return;
            }

            if (this.type === 'email' && val) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(val)) {
                    this.clientError = 'Format email tidak valid.';
                    return;
                }
            }
        },

        handleInput(e) {
            if (this.type === 'number') {
                this.value = e.target.value.replace(/[^0-9]/g, '');
            } else {
                this.value = e.target.value;
            }
            
            this.removeButton = this.value !== '';
            this.validate(this.value);
        }
    }" 
    x-modelable="value" 
    x-init="removeButton = value !== ''"
    
    x-model="{{ $attributes->whereStartsWith('x-model')->first() }}"
>
    @if ($label)
        <label for="{{ $name }}" class="input-label" 
               :class="hasError ? '!text-red-500' : ''">
            {{ $label }}
        </label>
    @endif

    <div {{ $attributes->whereStartsWith('x-')->except('x-model') }}
        class="input-wrap transition-colors duration-200 {{ $disabled || $attributes->has('readonly') ? 'input-disabled' : 'bg-white' }} {{ $inputClass }}"
        :class="hasError ? '!border-red-500 focus-within:!border-red-500' : ''"
    >
        <input
            x-on:input="handleInput($event)"
            x-on:blur="validate(value)"
            placeholder="{{ $placeholder }}" 
            name="{{ $name }}" 
            type="{{ $type === 'number' ? 'text' : $type }}" 
            id="{{ $name }}"
            class="input-base" 
            :class="hasError ? '!text-red-600 !placeholder-red-300' : ''"
            x-model="value" 
            {{ $disabled ? 'disabled' : '' }}
            {{ $attributes->except(['placeholder', 'name', 'type', 'id', 'class', 'error', 'helperText', 'minlength', 'maxlength']) }} 
        />

        @if ($showRemoveIcon)
            <button type="button" 
                    x-show="removeButton && !{{ $disabled ? 'true' : 'false' }}" 
                    x-on:click="value = ''; removeButton = false; clientError = ''; serverError = '';"
                    class="cursor-pointer">
                <x-icon :name="'multiplication-sign-circle/solid-grey-16'"></x-icon>
            </button>
        @endif
        
        <div x-show="hasError" x-cloak class="pr-2">
             <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>

    <div class="mt-1 ml-1 text-xs font-medium transition-colors duration-200 min-h-[1.25rem]"
         :class="hasError ? 'text-red-500' : 'text-gray-500'">
        <span x-text="message"></span>
    </div>
</div>