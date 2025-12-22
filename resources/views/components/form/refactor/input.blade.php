@props([
    'type' => 'text',
    'name' => '',
    'label' => '',
    'value' => '',
    'disabled' => false,
    'placeholder' => '',
    'error' => null,
    'helperText' => '',
    'required' => false,
    'patternMessage' => 'Format tidak sesuai.',
    'variant' => null,
    'size' => 'lg',
    
    // Prefix/Suffix
    'showPrefix' => false,
    'prefix' => 'Rp',
    
    'showSuffix' => false,
    'suffix' => 'Years',
    
    // Icons & Clear
    'showIconLeft' => false,
    'iconLeft' => null,
    
    'showIconRight' => false,
    'iconRight' => null,
    
    'showClearData' => false,
    'showClearData2' => true,
])

@php
    $hasServerError = $errors->has($name) || !empty($error);
    $serverErrorMessage = $error ?? $errors->first($name);
    
    $presets = [
        'nip' => [
            'minlength' => 5,
            'maxlength' => 30,
            'helperText' => 'Wajib diisi, angka 5-30 digit.',
            'pattern' => '[0-9]+',
            'patternMessage' => 'NIP hanya boleh berisi angka.',
        ],
        'ktp' => [
            'minlength' => 16,
            'maxlength' => 16,
            'helperText' => 'NIK harus 16 digit angka sesuai KTP.',
            'pattern' => '[0-9]+',
            'patternMessage' => 'NIK hanya boleh berisi angka.',
        ],
        'username' => [
            'minlength' => 3,
            'maxlength' => 20,
            'pattern' => '[a-z0-9_]+',
            'patternMessage' => 'Hanya huruf kecil, angka, dan underscore (_).',
            'helperText' => 'Huruf kecil, angka, underscore. Min 3.',
        ],
        'email' => [
            'type' => 'email',
            'helperText' => 'Pastikan format email valid (user@domain.com).',
        ],
        'password' => [
            'type' => 'password',
            'minlength' => 8,
            'helperText' => 'Minimal 8 karakter.',
        ],
        'phone' => [
            'type' => 'tel',
            'pattern' => '[0-9]+',
            'minlength' => 10,
            'maxlength' => 15,
            'helperText' => 'Nomor HP (10-15 digit).',
            'patternMessage' => 'Hanya boleh berisi angka.',
        ],
    ];

    $vType = null;
    $vMinLength = null;
    $vMaxLength = null;
    $vMin = null;
    $vMax = null;
    $vPattern = null;
    $vPatternMsg = null;
    $vHelperText = '';

    if ($variant) {
        $variantKeys = explode(' ', $variant);
        foreach ($variantKeys as $key) {
            if (isset($presets[$key])) {
                $p = $presets[$key];
                if (isset($p['type'])) $vType = $p['type'];
                if (isset($p['minlength'])) $vMinLength = $p['minlength'];
                if (isset($p['maxlength'])) $vMaxLength = $p['maxlength'];
                if (isset($p['min'])) $vMin = $p['min'];
                if (isset($p['max'])) $vMax = $p['max'];
                if (isset($p['pattern'])) $vPattern = $p['pattern'];
                if (isset($p['patternMessage'])) $vPatternMsg = $p['patternMessage'];
                if (isset($p['helperText'])) $vHelperText = $p['helperText'];
            }
        }
    }

    $finalMinLength = $attributes->get('minlength') ?? $vMinLength;
    $finalMaxLength = $attributes->get('maxlength') ?? $vMaxLength;
    $finalMin = $attributes->get('min') ?? $vMin;
    $finalMax = $attributes->get('max') ?? $vMax;
    $finalPattern = $attributes->get('pattern') ?? $vPattern;
    $finalType = $type !== 'text' ? $type : $vType ?? 'text';
    $finalHelperText = $helperText !== '' ? $helperText : $vHelperText;
    $finalPatternMessage = $patternMessage !== 'Format tidak sesuai.' ? $patternMessage : $vPatternMsg ?? 'Format tidak sesuai.';

    $sizeClass = "input-refactor-group-{$size}";
    $prefixSizeClass = "input-refactor-prefix-{$size}";
    $suffixSizeClass = "input-refactor-suffix-{$size}";
    $elementSizeClass = "input-refactor-element-{$size}";
    $clearSizeClass = "input-refactor-clear-{$size}";
@endphp

<div class="input-refactor-root" 
    x-data="{
        value: @js($value ?? ''),
        showClearButton: false,
        serverError: @js($serverErrorMessage ?? ''),
        clientError: '',
        helperText: @js($finalHelperText ?? ''),
        required: @js($required),

        minLength: @js($finalMinLength ?? null),
        maxLength: @js($finalMaxLength ?? null),
        minVal: @js($finalMin ?? null),
        maxVal: @js($finalMax ?? null),
        pattern: @js($finalPattern ?? null),
        patternMessage: @js($finalPatternMessage ?? 'Format tidak sesuai.'),
        type: @js($finalType ?? 'text'),

        get hasError() {
            return (this.serverError && this.serverError.length > 0) || (this.clientError && this.clientError.length > 0);
        },

        get message() {
            if (this.serverError) return this.serverError;
            if (this.clientError) return this.clientError;
            return this.helperText;
        },

        validate(val) {
            this.clientError = '';
            this.serverError = '';

            if (this.required && (!val || val === '')) {
                this.clientError = 'Kolom ini wajib diisi.';
                return;
            }

            if (!val) return;

            if (this.type === 'number') {
                const num = parseFloat(val);
                if (this.minVal !== null && num < this.minVal) {
                    this.clientError = `Nilai minimal ${this.minVal}.`;
                    return;
                }
                if (this.maxVal !== null && num > this.maxVal) {
                    this.clientError = `Nilai maksimal ${this.maxVal}.`;
                    return;
                }
            } else {
                if (this.minLength && val.length < this.minLength) {
                    this.clientError = `Minimal ${this.minLength} karakter.`;
                    return;
                }
                if (this.maxLength && val.length > this.maxLength) {
                    this.clientError = `Maksimal ${this.maxLength} karakter.`;
                    return;
                }
            }

            if (this.type === 'email') {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(val)) {
                    this.clientError = 'Format email tidak valid.';
                    return;
                }
            }

            if (this.pattern) {
                const regex = new RegExp('^' + this.pattern + '$');
                if (!regex.test(val)) {
                    this.clientError = this.patternMessage;
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

            this.showClearButton = this.value !== '';
            this.validate(this.value);
        },

        clearInput() {
            this.value = '';
            this.showClearButton = false;
            this.clientError = '';
            this.serverError = '';
        }
    }" 
    x-modelable="value" 
    x-init="showClearButton = value !== ''"
    x-model="{{ $attributes->whereStartsWith('x-model')->first() }}">
    
    {{-- Label --}}
    @if ($label)
        <label for="{{ $name }}" class="input-refactor-label" :class="{ 'input-refactor-label-error': hasError }">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    {{-- Input Group --}}
    <div class="input-refactor-group {{ $sizeClass }}"
        :class="{
            'input-refactor-group-disabled': @js($disabled),
            'input-refactor-group-error': hasError,
            'input-refactor-group-normal': !hasError && !@js($disabled)
        }">
        
        {{-- Prefix Container --}}
        @if ($showPrefix)
            <div class="input-refactor-prefix {{ $prefixSizeClass }}">
                {{ $prefix }}
            </div>
        @endif

        {{-- Icon Left --}}
        @if ($showIconLeft && $iconLeft)
            <div class="input-refactor-icon-left">
                <x-icon :name="$iconLeft" />
            </div>
        @endif

        {{-- Input Element --}}
        <input 
            x-on:input="handleInput($event)" 
            x-on:blur="validate(value)" 
            placeholder="{{ $placeholder }}"
            name="{{ $name }}" 
            type="{{ $finalType === 'number' ? 'text' : $finalType }}"
            id="{{ $name }}" 
            class="input-refactor-element {{ $elementSizeClass }}" 
            :class="{ 
                'input-refactor-element-error': hasError,
                'input-refactor-element-disabled': @js($disabled)
            }" 
            x-model="value"
            {{ $disabled ? 'disabled' : '' }}
            {{ $attributes->except(['placeholder', 'name', 'type', 'id', 'class', 'error', 'helperText', 'patternMessage', 'variant', 'minlength', 'maxlength', 'min', 'max', 'pattern', 'size', 'showPrefix', 'prefix', 'showSuffix', 'suffix', 'showIconLeft', 'iconLeft', 'showIconRight', 'iconRight', 'showClearData', 'showClearData2']) }} 
        />

        {{-- Clear Button (First Position) --}}
        @if ($showClearData)
            <button 
                type="button" 
                x-show="showClearButton && !{{ $disabled ? 'true' : 'false' }}"
                x-on:click="clearInput()"
                class="input-refactor-clear {{ $clearSizeClass }}">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </button>
        @endif

        {{-- Error Icon --}}
        <div x-show="hasError" x-cloak class="input-refactor-icon-error">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>

        {{-- Icon Right --}}
        @if ($showIconRight && $iconRight)
            <div class="input-refactor-icon-right">
                <x-icon :name="$iconRight" />
            </div>
        @endif

        {{-- Clear Button (Second Position) --}}
        @if ($showClearData2)
            <button 
                type="button" 
                x-show="showClearButton && !{{ $disabled ? 'true' : 'false' }}"
                x-on:click="clearInput()"
                class="input-refactor-clear {{ $clearSizeClass }}">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </button>
        @endif

        {{-- Suffix Container --}}
        @if ($showSuffix)
            <div class="input-refactor-suffix {{ $suffixSizeClass }}">
                {{ $suffix }}
            </div>
        @endif
    </div>

    {{-- Helper / Error Message --}}
    <div class="input-refactor-helper" :class="hasError ? 'input-refactor-helper-error' : 'input-refactor-helper-normal'">
        <span x-text="message"></span>
    </div>
</div>
