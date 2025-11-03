@props([
  'cancelConfirmationModalButtonId',
  'name' => 'file'
])

<script type="module">
  import fileUploadComponent from "{{ asset('js/component-helpers/file.js') }}";

  document.addEventListener('alpine:init', () => {
    Alpine.data('fileUploadComponent', fileUploadComponent);
  });
</script>

@php
  $extraOnClick = $attributes->get('onclick') ?? null;
@endphp

<div 
  class="flex justify-between w-full gap-[100px] items-start"
  :class="{ 'gap-5': drop }"
  x-data="fileUploadComponent('{{$name}}')"
>
  <input type="hidden" name="filename" id="filenameInput" x-model="fileName">
  <div 
    class="rounded-lg border-2 border-dashed border-[#D9D9D9] bg-white px-8 py-4 text-center w-7/10 mb-4 flex-1 flex flex-col gap-3 items-center max-[70%]:max-w-full max-[70%]:w-full max-[70%]:items-stretch"
    :class="{ 
      'border-[#E62129]': drag,
      'bg-[#FDF4F4]': drag,
      'hidden': drop,
      'flex': !drop
    }"
    x-on:dragover.prevent="onDrag"
    x-on:dragleave="onLeaveDrag"
    x-on:drop.prevent="onLeaveDrag();setFileName($event);"
  >
    <div class="text-md-bd flex flex-col items-center w-max">
      <img src="{{ asset('assets/icon-upload-gray-600.svg') }}" alt="upload" class="h-[1.5em] w-auto mb-2" />
      <br>
      Tarik & letakkan file di sini
    </div>
    <div>Atau</div>
    <x-button.secondary 
      :isUsedWithLabelTagForFileInput="true"
      name="{{ $name }}"
      x-on:change="onChangeFile"
      x-ref="fileInput"
      accept=".xlsx,.xls,.csv"
    >
      Pilih File
    </x-button.secondary>
    <div>
      .xsl & .csv | 5MB
    </div>
  </div>
  <div 
    id="filePreview" 
    class="items-center gap-3 py-2 px-3 border-[1px] border-[#DCDCDC] rounded-lg bg-white mb-4 max-w-7/10"
    :class="{
      'flex': drop,
      'hidden': !drop
    }"
  >
    <img src="{{ asset('assets/icon-file-gray.svg') }}" alt="File Icon">
    <x-typography :variant="'body-medium-regular'" x-text="fileName"></x-typography>
    <span class="w-[1.5em] h-[1em] ms-2 cursor-pointer"><img src="{{ asset('assets/icon-eye-gray.svg') }}" alt="Eye Icon"></span>
    <button 
      type="button" 
      id="removeFileBtn" 
      class="cursor-pointer"
      aria-label="Remove"
      x-on:click="onRemoveFile"
    >
      &times;
    </button>
  </div>
  <div class="flex ms-auto items-end gap-3 -mt-[7%]" :class="{ 'w-90/100': drop }">
    <x-button.secondary
      onclick="
        document.getElementById('{{ $cancelConfirmationModalButtonId }}').classList.add('flex');
        document.getElementById('{{ $cancelConfirmationModalButtonId }}').classList.remove('hidden');
      "
      id="btnBatalUnggah"
      x-bind:disabled="!drop"
    >
      Batal
    </x-button.secondary>
    <x-button.primary type="submit" onclick="{{ $extraOnClick }}" :icon="asset('assets/icon-upload-gray-600.svg')" :iconPosition="'right'" x-bind:disabled="!drop">
      Unggah 
    </x-button.primary>
  </div>
</div>