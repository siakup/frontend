@props([
    'placeholder' => 'Tulis Deskripsi',
    'id' => null,
    'name' => 'deskripsi',
    'rows' => '10',
    'value' => null,
    'maxChar' => null,
    'helperText' => '',
    
    'showLabel' => false,
    'label' => '',
    
    'resizer' => true,
    
    'disabled' => false,
    'error' => null,
    'required' => false,
    
    'helperContainer' => true,
    'showHelperText' => true,
    'wordCounter' => true,
    
    'showClearButton' => false,

    
    'state' => 'default',
])

@php
    $extraOnClick = $attributes->get('oninput');
    $initialLength = $value ? strlen($value) : 0;
    
    $hasServerError = $errors->has($name) || !empty($error);
    $serverErrorMessage = $error ?? $errors->first($name);
    
    $finalState = $state;
    if ($hasServerError) {
        $finalState = 'error';
    } elseif ($disabled) {
        $finalState = 'disabled';
    }
    
    $resizerClass = $resizer ? 'resize-y' : 'resize-none';
    
    $textareaAttributes = $attributes->merge([
        'class' => 'textarea w-full ' . $resizerClass . ' state-' . $finalState,
    ]);

    if (! $attributes->has('x-model')) {
        $textareaAttributes = $textareaAttributes->merge(['x-model' => 'textValue']);
    }

    $hasExternalModel = $attributes->has('x-model');
@endphp

<x-container.container class="textarea-container state-{{ $finalState }}" w-full>
    {{-- Label --}}
    @if ($showLabel && $label)
        <x-typography for="{{ $id ?? $name }}" class="text-sm font-semibold textarea-label">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </x-typography>
    @endif

    {{-- Textarea Wrapper with Clear Button --}}
    <x-container.container class="relative">
        <textarea rows="{{ $rows }}" {{ $textareaAttributes }}
            name="{{ $name }}" placeholder="{{ $placeholder }}" id="{{ $id ?? $name }}"
            x-on:input="window.onInputTextArea($event.target, @json($maxChar)); {{ $extraOnClick }}"
            x-ref="textarea"
            @if($maxChar) data-maxchar="{{ $maxChar }}" @endif
            {{ $disabled ? 'disabled' : '' }}>{{ $value }}
        </textarea>

        {{-- Clear Button  --}}
        @if ($showClearButton)
            <x-button
                type="button"
                size="sm"
                variant="tertiary"
                icon="multiplication-sign-circle/outline-grey-16"
                class="absolute right-2 top-2"
                x-show="$refs.textarea && $refs.textarea.value"
                x-cloak
                x-on:click="window.clearTextArea($refs.textarea)"
                aria-label="Clear textarea"
            />
        @endif
    </x-container.container>

    {{-- Helper Container --}}
    @if ($helperContainer && ($showHelperText || ($wordCounter && $maxChar)))
        <x-container.container class="textarea-helper p-0" width="full">
            @if ($showHelperText && ($helperText || $hasServerError))
                <span class="textarea-helper-text">
                    {{ $hasServerError ? $serverErrorMessage : $helperText }}
                </span>
            @endif

            @if ($wordCounter && $maxChar)
                <span class="textarea-maxchar textarea-helper-text">
                    {{ $initialLength }}/{{ $maxChar }}
                </span>
            @endif
        </x-container.container>
    @endif
</x-container.container>
