@props([
    'name' => 'textarea',
    'placeholder' => 'Placeholder',
    'value' => '',
    'rows' => '4',
    'disabled' => false,
    'error' => null,
    'required' => false,
    
    // Label
    'showLabel' => true,
    'label' => 'Label',
    
    // Resizer
    'resizer' => true,
    
    // Helper Container
    'helperContainer' => true,
    'helperText' => '',
    'showHelperText' => true,
    
    // Word Counter
    'wordCounter' => true,
    'maxChar' => null,
    
    // State
    'state' => 'default', // default, error, disabled
])

@php
    $hasServerError = $errors->has($name) || !empty($error);
    $serverErrorMessage = $error ?? $errors->first($name);
    
    // Determine final state
    $finalState = $state;
    if ($hasServerError) {
        $finalState = 'error';
    } elseif ($disabled) {
        $finalState = 'disabled';
    }
    
    $stateClass = match($finalState) {
        'error' => 'textarea-refactor-element-error',
        'disabled' => 'textarea-refactor-element-disabled',
        default => 'textarea-refactor-element-normal',
    };
    
    $resizerClass = $resizer ? 'textarea-refactor-element-resize' : 'textarea-refactor-element-no-resize';
    
    $initialLength = $value ? strlen($value) : 0;
@endphp

<div class="textarea-refactor-root" 
    x-data="{
        value: @js($value ?? ''),
        serverError: @js($serverErrorMessage ?? ''),
        clientError: '',
        helperText: @js($helperText ?? ''),
        maxChar: @js($maxChar),
        required: @js($required),
        charCount: @js($initialLength),

        get hasError() {
            return (this.serverError && this.serverError.length > 0) || (this.clientError && this.clientError.length > 0);
        },

        get message() {
            if (this.serverError) return this.serverError;
            if (this.clientError) return this.clientError;
            return this.helperText;
        },

        get isLimitReached() {
            return this.maxChar && this.charCount >= this.maxChar;
        },

        validate(val) {
            this.clientError = '';
            this.serverError = '';

            if (this.required && (!val || val === '')) {
                this.clientError = 'This field is required.';
                return;
            }

            if (this.maxChar && val.length > this.maxChar) {
                this.clientError = `Maximum ${this.maxChar} characters.`;
                return;
            }
        },

        handleInput(e) {
            this.value = e.target.value;
            
            // Limit character count
            if (this.maxChar && this.value.length > this.maxChar) {
                this.value = this.value.slice(0, this.maxChar);
                e.target.value = this.value;
            }
            
            this.charCount = this.value.length;
            this.validate(this.value);

            // Auto-resize
            e.target.style.height = 'auto';
            e.target.style.height = e.target.scrollHeight + 'px';
        }
    }" 
    x-modelable="value"
    x-init="
        if (maxChar) {
            $nextTick(() => {
                const textarea = $el.querySelector('textarea');
                if (textarea) {
                    textarea.style.height = 'auto';
                    textarea.style.height = textarea.scrollHeight + 'px';
                }
            });
        }
    "
    x-model="{{ $attributes->whereStartsWith('x-model')->first() }}">
    
    {{-- Label --}}
    @if ($showLabel && $label)
        <label for="{{ $name }}" class="textarea-refactor-label" :class="{ 'textarea-refactor-label-error': hasError }">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    {{-- Textarea Wrapper with Clear Button --}}
    <div class="textarea-refactor-wrapper">
        {{-- Textarea Element --}}
        <textarea
            name="{{ $name }}"
            id="{{ $name }}"
            rows="{{ $rows }}"
            placeholder="{{ $placeholder }}"
            class="textarea-refactor-element {{ $stateClass }} {{ $resizerClass }}"
            :class="{ 'textarea-refactor-element-error': hasError }"
            x-model="value"
            x-on:input="handleInput($event)"
            x-on:blur="validate(value)"
            {{ $disabled ? 'disabled' : '' }}
            {{ $attributes->except(['name', 'id', 'rows', 'placeholder', 'class', 'showLabel', 'label', 'resizer', 'helperContainer', 'helperText', 'showHelperText', 'wordCounter', 'maxChar', 'state', 'error']) }}
        ></textarea>

        {{-- Clear Button --}}
        <button 
            type="button"
            class="textarea-refactor-clear"
            x-show="value && value.length > 0 && !{{ $disabled ? 'true' : 'false' }}"
            x-on:click="value = ''; charCount = 0; clientError = ''; serverError = ''; $el.previousElementSibling.focus();"
            x-cloak
        >
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>

    {{-- Helper Container --}}
    @if ($helperContainer && ($showHelperText || $wordCounter))
        <div class="textarea-refactor-helper-container">
            {{-- Helper Text --}}
            @if ($showHelperText)
                <span 
                    class="textarea-refactor-helper-text"
                    :class="hasError ? 'textarea-refactor-helper-text-error' : 'textarea-refactor-helper-text-normal'"
                    x-text="message"
                ></span>
            @endif

            {{-- Word Counter --}}
            @if ($wordCounter && $maxChar)
                <span 
                    class="textarea-refactor-counter"
                    :class="isLimitReached ? 'textarea-refactor-counter-limit' : 'textarea-refactor-counter-normal'"
                >
                    <span x-text="charCount"></span>/<span>{{ $maxChar }}</span>
                </span>
            @endif
        </div>
    @endif
</div>
