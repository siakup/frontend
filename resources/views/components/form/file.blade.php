@props([
  'cancelConfirmationModalButtonId',
  'name' => 'file'
])
<script>
  function onChangeFile(element) {
    const uploadCard = element.parentElement.parentElement;
    const container = uploadCard.parentElement;
    const unggahButton = container.querySelector('#btnUnggah');
    const batalButton = container.querySelector('#btnBatalUnggah');
    const fileNameSpan = container.querySelector('#fileName');
    const filenameInput = container.querySelector("#filenameInput");
    const filePreview = container.querySelector('#filePreview');

    if (element.files.length) {
      unggahButton.disabled = false;
      batalButton.disabled = false;

      fileNameSpan.textContent = element.files[0].name;
      filenameInput.value = element.files[0]?.name || '';

      filePreview.classList.add("flex");
      filePreview.classList.remove("hidden");
      filePreview.nextElementSibling.classList.add('w-90/100');

      container.classList.add('gap-5');

      uploadCard.classList.add('hidden');
      uploadCard.classList.remove('flex');
    } else {
      unggahButton.disabled = true;
      batalButton.disabled = true;

      filePreview.classList.add('hidden');
      filePreview.classList.remove('flex');
      filePreview.nextElementSibling.classList.remove('w-90/100');
      
      uploadCard.classList.add('flex');
      uploadCard.classList.remove('hidden');

      container.classList.remove('gap-5');
    }
  }

  function onRemoveFile(element, name) {
    const uploadCard = element.parentElement.previousElementSibling;
    const container = element.parentElement.parentElement;
    const fileInput = container.querySelector(`input[type='file'][name='${name}']`)
    const unggahButton = container.querySelector('#btnUnggah')
    const batalButton = container.querySelector('#btnBatalUnggah');
    const filePreview = container.querySelector('#filePreview');

    fileInput.value = "";

    unggahButton.disabled = true;
    batalButton.disabled = true;

    filePreview.classList.add('hidden');
    filePreview.classList.remove('flex');
    filePreview.nextElementSibling.classList.remove('w-90/100');
    
    uploadCard.classList.add('flex');
    uploadCard.classList.remove('hidden');

    container.classList.remove('gap-5');
  }
</script>

<div class="flex justify-between w-full gap-[100px] items-start">
  <input type="hidden" name="filename" id="filenameInput">
  <div class="rounded-lg border-2 border-dashed border-[#D9D9D9] bg-white px-8 py-4 text-center w-7/10 mb-4 flex-1 flex flex-col gap-3 items-center max-[70%]:max-w-full max-[70%]:w-full max-[70%]:items-stretch">
    <div class="text-md-bd flex flex-col items-center w-max">
      <img src="{{ asset('assets/icon-upload-gray-600.svg') }}" alt="upload" class="h-[1.5em] w-auto mb-2" />
      <br>
      Tarik & letakkan file di sini
    </div>
    <div>Atau</div>
    <x-button.secondary 
      :isUsedWithLabelTagForFileInput="true"
      name="{{ $name }}"
      onchange="onChangeFile(this)"
      accept=".xlsx,.xls,.csv"
    >
      Pilih File
    </x-button.secondary>
    <div>
      .xsl & .csv | 5MB
    </div>
  </div>
  <div id="filePreview" class="hidden items-center gap-3 py-2 px-3 border-[1px] border-[#DCDCDC] rounded-lg bg-white mb-4 max-w-7/10">
    <img src="{{ asset('assets/icon-file-gray.svg') }}" alt="File Icon">
    <span id="fileName" class="file-name">file.csv</span>
    <span class="w-[1.5em] h-[1em] ms-2 cursor-pointer"><img src="{{ asset('assets/icon-eye-gray.svg') }}" alt="Eye Icon"></span>
    <button 
      type="button" 
      id="removeFileBtn" 
      class="cursor-pointer"
      aria-label="Remove"
      onclick="onRemoveFile(this)"
    >
      &times;
    </button>
  </div>
  <div class="flex ms-auto items-end gap-3 -mt-[7%]">
    <x-button.secondary
      onclick="
        document.getElementById('{{ $cancelConfirmationModalButtonId }}').classList.add('flex');
        document.getElementById('{{ $cancelConfirmationModalButtonId }}').classList.remove('hidden');
      "
      id="btnBatalUnggah"
      disabled
    >
      Batal
    </x-button.secondary>
    <x-button.primary
      id="btnUnggah"
      type="submit"
      :icon="asset('assets/icon-upload-gray-600.svg')"
      :iconPosition="'right'"
      disabled
    >
      Unggah 
    </x-button.primary>
  </div>
</div>