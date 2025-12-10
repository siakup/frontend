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
    'required' => false,
    'patternMessage' => 'Format tidak sesuai.',
    'variant' => null,
])

@php
    $hasServerError = $errors->has($name) || !empty($error);
    $serverErrorMessage = $error ?? $errors->first($name);
    $presets = [
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
                if (isset($p['type'])) {
                    $vType = $p['type'];
                }
                if (isset($p['minlength'])) {
                    $vMinLength = $p['minlength'];
                }
                if (isset($p['maxlength'])) {
                    $vMaxLength = $p['maxlength'];
                }
                if (isset($p['min'])) {
                    $vMin = $p['min'];
                }
                if (isset($p['max'])) {
                    $vMax = $p['max'];
                }
                if (isset($p['pattern'])) {
                    $vPattern = $p['pattern'];
                }
                if (isset($p['patternMessage'])) {
                    $vPatternMsg = $p['patternMessage'];
                }
                if (isset($p['helperText'])) {
                    $vHelperText = $p['helperText'];
                }
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
    $finalPatternMessage =
    $patternMessage !== 'Format tidak sesuai.' ? $patternMessage : $vPatternMsg ?? 'Format tidak sesuai.';

@endphp

<div class="input-root" x-data="{
    value: @js($value ?? ''),
    removeButton: false,
    serverError: @js($serverErrorMessage),
    clientError: '',
    helperText: @js($finalHelperText),
    required: @js($required),

    //validasi
    minLength: @js($finalMinLength),
    maxLength: @js($finalMaxLength),
    minVal: @js($finalMin),
    maxVal: @js($finalMax),
    pattern: @js($finalPattern),
    patternMessage: @js($finalPatternMessage),
    type: @js($finalType),

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

        this.removeButton = this.value !== '';
        this.validate(this.value);
    }
}" x-modelable="value" x-init="removeButton = value !== ''"
    x-model="{{ $attributes->whereStartsWith('x-model')->first() }}">
    @if ($label)
        <label for="{{ $name }}" class="input-label" :class="{ 'input-label-error': hasError }">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <div {{ $attributes->whereStartsWith('x-')->except('x-model') }} class="input-group {{ $inputClass }}"
        :class="{
            'input-group-disabled': @js($disabled),
            'input-group-error': hasError,
            'input-group-normal': !hasError && !@js($disabled)
        }">
        <input x-on:input="handleInput($event)" x-on:blur="validate(value)" placeholder="{{ $placeholder }}"
            name="{{ $name }}" type="{{ $finalType === 'number' ? 'text' : $finalType }}"
            id="{{ $name }}" class="input-element" :class="{ 'input-element-error': hasError }" x-model="value"
            {{ $disabled ? 'disabled' : '' }}
            {{ $attributes->except(['placeholder', 'name', 'type', 'id', 'class', 'error', 'helperText', 'patternMessage', 'variant', 'minlength', 'maxlength', 'min', 'max', 'pattern']) }} />

        @if ($showRemoveIcon)
            <button type="button" x-show="removeButton && !{{ $disabled ? 'true' : 'false' }}"
                x-on:click="value = ''; removeButton = false; clientError = ''; serverError = '';"
                class="input-icon-remove">
                <x-icon :name="'multiplication-sign-circle/solid-grey-16'"></x-icon>
            </button>
        @endif

        <div x-show="hasError" x-cloak class="input-icon-error">
            <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>

    {{-- Helper / Error Message --}}
    <div class="input-helper" :class="hasError ? 'input-helper-error' : 'input-helper-normal'">
        <span x-text="message"></span>
    </div>
</div>
