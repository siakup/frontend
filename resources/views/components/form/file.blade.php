@props([
    'name',
    'label' => '',
    'multiple' => false,
    'disabled' => false,
    'inputClass' => '',
    'required' => false,

    // Props Validasi
    'accept' => null,
    'helperText' => null,
    'error' => null,
    'maxSize' => null,
    'minSize' => null,
    'fileNameRule' => null,
    'fileNameMessage' => null,

    // Props UI
    'placeholder' => null,
    'browseText' => null,

    // Variant
    'variant' => null,
])

@php
    $hasServerError = $errors->has($name) || !empty($error);
    $serverErrorMessage = $error ?? $errors->first($name);

    $presets = [
        'image' => [
            'accept' => 'image/png, image/jpeg, image/jpg, image/webp',
            'maxSize' => 5120,
            'helperText' => 'Format: JPG, PNG, WEBP. Maks 5MB.',
            'placeholder' => 'Tarik gambar ke sini',
        ],
        'document' => [
            'accept' => '.pdf, .doc, .docx, .xls, .xlsx',
            'maxSize' => 10240,
            'helperText' => 'Format: Dokumen (PDF, Word, Excel). Maks 10MB.',
            'placeholder' => 'Upload dokumen di sini',
        ],
    ];

    $finalAccept = '*/*';
    $finalMaxSize = null;
    $finalMinSize = null;
    $finalHelperText = '';
    $finalPlaceholder = 'Tarik & letakkan file di sini';
    $finalBrowseText = 'Pilih file';
    $finalFileNameRule = null;
    $finalFileNameMessage = 'Nama file tidak sesuai format.';

    if ($variant) {
        $variantKeys = explode(' ', $variant);
        foreach ($variantKeys as $key) {
            if (isset($presets[$key])) {
                $p = $presets[$key];
                if (isset($p['accept'])) {
                    $finalAccept = $p['accept'];
                }
                if (isset($p['maxSize'])) {
                    $finalMaxSize = $p['maxSize'];
                }
                if (isset($p['minSize'])) {
                    $finalMinSize = $p['minSize'];
                }
                if (isset($p['helperText'])) {
                    $finalHelperText = $p['helperText'];
                }
                if (isset($p['placeholder'])) {
                    $finalPlaceholder = $p['placeholder'];
                }
                if (isset($p['browseText'])) {
                    $finalBrowseText = $p['browseText'];
                }
                if (isset($p['fileNameRule'])) {
                    $finalFileNameRule = $p['fileNameRule'];
                }
                if (isset($p['fileNameMessage'])) {
                    $finalFileNameMessage = $p['fileNameMessage'];
                }
            }
        }
    }

    $appliedAccept = $accept ?? $finalAccept;
    $appliedMaxSize = $maxSize ?? $finalMaxSize;
    $appliedMinSize = $minSize ?? $finalMinSize;
    $appliedHelperText = $helperText ?? $finalHelperText;
    $appliedPlaceholder = $placeholder ?? $finalPlaceholder;
    $appliedBrowseText = $browseText ?? $finalBrowseText;
    $appliedFileNameRule = $fileNameRule ?? $finalFileNameRule;
    $appliedFileNameMessage = $fileNameMessage ?? $finalFileNameMessage;
@endphp

<div class="file-root" x-data="{
    files: [],
    isDragging: false,
    serverError: @js($serverErrorMessage),
    clientError: '',
    helperText: @js($appliedHelperText),
    maxSize: @js($appliedMaxSize),
    minSize: @js($appliedMinSize),
    accept: @js($appliedAccept),
    fileNameRule: @js($appliedFileNameRule),
    fileNameMessage: @js($appliedFileNameMessage),

    get hasError() {
        return (this.serverError && this.serverError.length > 0) || (this.clientError && this.clientError.length > 0);
    },

    get message() {
        if (this.serverError) return this.serverError;
        if (this.clientError) return this.clientError;
        return this.helperText;
    },

    formatSize(sizeInKB) {
        return sizeInKB >= 1024 ?
            (sizeInKB / 1024).toFixed(1) + ' MB' :
            sizeInKB + ' KB';
    },

    validateFile(file) {
        const fileSizeKB = file.size / 1024;

        if (this.maxSize && fileSizeKB > this.maxSize) {
            this.clientError = `File '${file.name}' terlalu besar. Maksimal ${this.formatSize(this.maxSize)}.`;
            return false;
        }

        if (this.minSize && fileSizeKB < this.minSize) {
            this.clientError = `File '${file.name}' terlalu kecil. Minimal ${this.formatSize(this.minSize)}.`;
            return false;
        }

        if (this.accept !== '*/*') {
            const fileName = file.name.toLowerCase();
            const fileType = file.type;
            const allowedTypes = this.accept.split(',').map(t => t.trim().toLowerCase());

            const isValidType = allowedTypes.some(type => {
                if (type.startsWith('.')) return fileName.endsWith(type);
                if (type.endsWith('/*')) {
                    const mainType = type.replace('/*', '');
                    return fileType.startsWith(mainType);
                }
                return fileType === type;
            });

            if (!isValidType) {
                this.clientError = `Tipe file tidak valid. Format: ${this.accept}`;
                return false;
            }
        }

        if (this.fileNameRule) {
            const regex = new RegExp(this.fileNameRule, 'i');
            if (!regex.test(file.name)) {
                this.clientError = this.fileNameMessage;
                return false;
            }
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
                    this.files = [];
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
}">
    @if ($label)
        <label for="{{ $name }}" class="file-label" :class="hasError ? 'file-label-error' : 'file-label-normal'">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <div class="file-dropzone {{ $inputClass }}"
        :class="{
            'file-dropzone-error': hasError,
            'file-dropzone-idle': !hasError && !isDragging,
            'file-dropzone-drag': isDragging && !hasError,
            'file-dropzone-disabled': @js($disabled)
        }"
        @dragover.prevent="if(!@js($disabled)) isDragging = true" @dragleave.prevent="isDragging = false"
        @drop.prevent="if(!@js($disabled)) { isDragging = false; handleFiles($event.dataTransfer.files); }">
        <input x-ref="fileInput" type="file" name="{{ $name }}" id="{{ $name }}"
            accept="{{ $appliedAccept }}" class="hidden" {{ $multiple ? 'multiple' : '' }}
            {{ $disabled ? 'disabled' : '' }} {{ $required ? 'required' : '' }}
            @change="handleFiles($event.target.files)" />

        <div class="file-placeholder-container" @click="if(!@js($disabled)) browseFiles()">
            <x-icon :name="'upload/grey-24'" :class="'w-8 h-8 mx-auto'" />

            <p class="file-text-title">
                {{ $appliedPlaceholder }}
            </p>
            <p class="file-text-subtitle">
                Atau
            </p>

            <x-button type="button" size="sm" class="file-btn-browse"
                @click.stop="if(!@js($disabled)) browseFiles()" :disabled="$disabled">
                {{ $appliedBrowseText }}
            </x-button>

            <p class="file-text-format">
                {{ $appliedAccept === '*/*' ? 'Semua File' : str_replace(',', ', ', $appliedAccept) }}
            </p>
        </div>
    </div>

    <ul class="file-list-group" x-show="files.length > 0">
        <template x-for="(file, index) in files" :key="index">
            <li class="file-list-item">
                <div class="file-item-wrapper">
                    <x-icon name="file/outline-grey-16" class="w-5 h-5 text-gray-400 flex-shrink-0" />
                    <span class="file-item-name" x-text="file.name"></span>
                    <span class="file-item-size" x-text="formatSize(file.size / 1024)"></span>
                </div>
                <button type="button" @click="removeFile(index)" class="file-btn-remove"
                    :disabled="@js($disabled)">
                    <x-icon name="delete/grey-16" class="w-4 h-4" />
                </button>
            </li>
        </template>
    </ul>

    <div class="file-message" :class="hasError ? 'file-message-error' : 'file-message-normal'">
        <span x-text="message"></span>
    </div>
</div>
