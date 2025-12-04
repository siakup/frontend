@props([
    'name',
    'label' => '',
    'multiple' => false,
    'accept' => '*/*',
    'helperText' => '',
    'error' => null,
    'disabled' => false,
    'inputClass' => '',
    'required' => false, 
    'maxSize' => null,  
])

@php
    $hasServerError = $errors->has($name) || !empty($error);
    $serverErrorMessage = $error ?? $errors->first($name);
@endphp

<div class="w-full"
    x-data="{
        files: [],
        isDragging: false,
        serverError: @js($serverErrorMessage),
        clientError: '',
        helperText: @js($helperText),
        maxSize: @js($maxSize),
        
        get hasError() {
            return (this.serverError && this.serverError.length > 0) || (this.clientError && this.clientError.length > 0);
        },

        get message() {
            if (this.serverError) return this.serverError;
            if (this.clientError) return this.clientError;
            return this.helperText;
        },

        validateFile(file) {
            if (this.maxSize && (file.size / 1024) > this.maxSize) {
                this.clientError = `File '${file.name}' terlalu besar. Maksimal ${this.maxSize / 1024} MB.`;
                return false;
            }
            return true;
        },

        handleFiles(fileList) {
            if (!fileList.length) return;
            
            this.clientError = '';
            this.serverError = ''; 

            let newFiles = Array.from(fileList);
            let validFiles = [];

            for (let i = 0; i < newFiles.length; i++) {
                if (this.validateFile(newFiles[i])) {
                    validFiles.push(newFiles[i]);
                } else {
                    if (!@js($multiple)) {
                        this.files = []; // Reset jika single upload
                        $refs.fileInput.value = '';
                    }
                    return; 
                }
            }
            
            if (@js($multiple)) {
                this.files = [...this.files, ...validFiles];
            } else {
                this.files = [validFiles[0]];
            }
        },

        removeFile(index) {
            this.files.splice(index, 1);
            this.clientError = '';
            
            if (this.files.length === 0) {
                $refs.fileInput.value = '';
            }
        },

        browseFiles() {
            $refs.fileInput.click();
        }
    }"
>
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-semibold mb-2" 
               :class="hasError ? 'text-red-500' : 'text-gray-700'">
            {{ $label }}
            @if($required) <span class="text-red-500">*</span> @endif
        </label>
    @endif

    <div 
        class="relative flex flex-col items-center justify-center w-full p-6 border-2 border-dashed rounded-lg transition-colors duration-200 bg-gray-50 {{ $inputClass }}"
        :class="{
            'border-red-500 bg-red-50': hasError,
            'border-gray-300 hover:bg-gray-100': !hasError && !isDragging,
            'border-blue-500 bg-blue-50': isDragging && !hasError,
            'opacity-50 cursor-not-allowed': @js($disabled)
        }"
        @dragover.prevent="if(!@js($disabled)) isDragging = true"
        @dragleave.prevent="isDragging = false"
        @drop.prevent="if(!@js($disabled)) { isDragging = false; handleFiles($event.dataTransfer.files); }"
    >
        <input 
            x-ref="fileInput"
            type="file" 
            name="{{ $name }}" 
            id="{{ $name }}"
            accept="{{ $accept }}"
            class="hidden"
            {{ $multiple ? 'multiple' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            {{ $required ? 'required' : '' }}
            @change="handleFiles($event.target.files)"
        />

        <div class="text-center cursor-pointer" @click="if(!@js($disabled)) browseFiles()">
            <x-icon :name="'upload/grey-24'" :class="'w-8 h-8 mx-auto'" />
            
            <p class="mt-2 text-sm font-semibold text-black-700">
                Tarik & letakkan file di sini
            </p>
            <p class="text-sm text-gray-800 mt-1 mb-3">
                Atau
            </p>
            
            <x-button 
                type="button" 
                size="sm" 
                class="mx-auto bg-gray-100"
                @click.stop="if(!@js($disabled)) browseFiles()" 
                :disabled="$disabled"
            >
                Pilih file
            </x-button>

            <p class="mx-auto text-xs text-gray-500 mt-3">
            {{ $accept === '*/*' ? 'Semua File' : $accept }}
            </p>
        </div>
    </div>

    <ul class="mt-4 space-y-2" x-show="files.length > 0">
        <template x-for="(file, index) in files" :key="index">
            <li class="flex items-center justify-between p-2 bg-white border border-gray-200 rounded-md shadow-sm">
                <div class="flex items-center space-x-2 truncate">
                    <x-icon name="document/outline-grey-16" class="w-5 h-5 text-gray-400 flex-shrink-0" />
                    <span class="text-sm text-gray-700 truncate" x-text="file.name"></span>
                    <span class="text-xs text-gray-500" x-text="(file.size / 1024).toFixed(1) + ' KB'"></span>
                </div>
                <button type="button" @click="removeFile(index)" class="text-gray-400 hover:text-red-500 transition-colors" :disabled="@js($disabled)">
                    <x-icon name="trash/outline-grey-16" class="w-4 h-4" />
                </button>
            </li>
        </template>
    </ul>

    <div class="mt-1 ml-1 text-xs font-medium transition-colors duration-200 min-h-[1.25rem]"
         :class="hasError ? 'text-red-500' : 'text-gray-500'">
        <span x-text="message"></span>
    </div>
</div>